<?php

namespace App\Http\Controllers\Admin;

use App\Workshop;
use App\Category;
use App\Http\Requests\StoreWorkshop;
use App\Http\Controllers\Controller;

use Toolkito\Larasap\Facebook\Api AS FacebookApi;
use Illuminate\Support\Facades\Storage;

use DateTime;
use Illuminate\Http\Request;

class WorkshopController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $workshops = Workshop::with('category')->get();
        $data = [
            'workshops' => $workshops,
            'active_menu' => 'workshops'
        ];

        return view('admin.workshops_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $data = [
            'active_menu' => 'workshops',
            'categories' => $categories
        ];

        return view('admin.workshops_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkshop $request)
    {
        // find category from id else 404
        $workshop_category = Category::findOrFail($request['category_id']);

        // new Workshop instance
        $workshop = new Workshop();
        $workshop->name = $request['name'];
        $workshop->slug = str_slug($request['name']);
        $workshop->description = $request['description'];
        $workshop->reg_fee = $request['reg_fee'];
        $workshop->starts_on = DateTime::createFromFormat('Y-m-d\TH:i', $request['starts_on']);
        $workshop->ends_on = DateTime::createFromFormat('Y-m-d\TH:i', $request['ends_on']);
      
        // associate Category with Workshop (autopopulate category_id)
        $workshop->category()->associate($workshop_category);

        // store files in public/workshops directory
        $poster_img = $request->file('poster_image');
        $thumbnail_img = $request->file('thumbnail_image');
        $pdf_file = $request->file('pdf_file');


        $poster_img_path = $poster_img->store('public/workshops');
        $thumbnail_img_path = $thumbnail_img->store('public/workshops');
        $pdf_file_path = $pdf_file->store('public/workshops');

        // store the filepath's to the database
        $workshop->poster_image =   str_replace_first('public/', '', $poster_img_path);
        $workshop->thumbnail_image =   str_replace_first('public/', '', $thumbnail_img_path);
        $workshop->pdf_path =   str_replace_first('public/', '', $pdf_file_path);

        $workshop->saveOrFail();

        return redirect()->route('admin.workshops.show', $workshop->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function show(Workshop $workshop)
    {
        //
        $data = [
            'active_menu' => 'workshops',
            'workshop' => $workshop
        ];
        return view('admin.workshops_show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Workshop  $Workshop
     * @return \Illuminate\Http\Response
     */
    public function edit(Workshop $workshop)
    {
        //
        $categories = Category::all();

        $data = [
            'active_menu' => 'workshops',
            'workshop' => $workshop,
            'categories' => $categories
        ];

        return view('admin.workshops_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function update(StoreWorkshop $request, Workshop $workshop)
    {
        // find category from id else 404
        $workshop_category = Category::findOrFail($request['category_id']);

        $workshop->name = $request['name'];
        $workshop->slug = str_slug($request['name']);
        $workshop->description = $request['description'];
        $workshop->reg_fee = $request['reg_fee'];
        $workshop->starts_on = DateTime::createFromFormat('Y-m-d\TH:i', $request['starts_on']);
        $workshop->ends_on = DateTime::createFromFormat('Y-m-d\TH:i', $request['ends_on']);
        
        // associate Category with Workshop (autopopulate category_id)
        $workshop->category()->associate($workshop_category);

        // delete previous image files before storing new file
        Storage::delete('public/' . $workshop->poster_image);
        Storage::delete('public/' . $workshop->thumbnail_image);
        Storage::delete('public/' . $workshop->pdf_path);
       
        // store files in public/workshops directory
        $poster_img = $request->file('poster_image');
        $thumbnail_img = $request->file('thumbnail_image');
        $pdf_file = $request->file('pdf_file');


        $poster_img_path = $poster_img->store('public/workshops');
        $thumbnail_img_path = $thumbnail_img->store('public/workshops');
        $pdf_file_path = $pdf_file->store('public/workshops');

        // store the filepath's to the database
        $workshop->poster_image =   str_replace_first('public/', '', $poster_img_path);
        $workshop->thumbnail_image =   str_replace_first('public/', '', $thumbnail_img_path);
        $workshop->pdf_path =   str_replace_first('public/', '', $pdf_file_path);

        $workshop->saveOrFail();

        return redirect()->route('admin.workshops.show', $workshop->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workshop $workshop)
    {
        // delete associated poster and thumbnail also
        Storage::delete('public/' . $workshop->poster_image);
        Storage::delete('public/' . $workshop->thumbnail_image);
        Storage::delete('public/' . $workshop->pdf_path);

        $workshop->delete();

        return redirect()->route('admin.workshops.index');
    }

    public function toggleRegistration(Request $request, Workshop $workshop)
    {
        if($request->has('action'))
        {
            $action = $request->action;
            if($action == 'CLOSE')
            {
                $workshop->is_reg_closed = true;
            }
            else if($action == 'OPEN')
            {
                $workshop->is_reg_closed = false;
            }

            $workshop->saveOrFail();

            return ['status' => 'Success', 'msg' => 'Success'];
        }

        return ['status' => 'Error', 'msg' => 'Invalid Request Params'];
    }

    /**
     * @param Workshop $workshop
     * @return array
     * @throws \Throwable
     */
    public function share_on_facebook(Workshop $workshop)
    {
        $link =  route('display_workshop', $workshop->slug);
        $message =  "Workshop Name: " . $workshop->name . "\Workshop Category: " . $workshop->category->name;

        try {
            $post_id = FacebookApi::sendLink($link, $message);

            // create facebook post url and save to database
            $shared_post_url = 'https://www.facebook.com/' . $post_id;
            $workshop->shared_post_url = $shared_post_url;
            $workshop->saveOrFail();

            return ['shared_post_url' => $shared_post_url];
        } catch (\Exception $e) {
            return ['error_msg' => $e->getMessage()];
        }

    }
}
