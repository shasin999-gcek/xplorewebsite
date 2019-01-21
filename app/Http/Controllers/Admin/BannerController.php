<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\Http\Requests\StoreBanner;
use App\Workshop;
use App\Banner;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class BannerController extends Controller
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
        $banners = Banner::all();
        $data = [
            'banners' => $banners,
            'active_menu' => 'banners'
        ];

        return view('admin.banners_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banners_create', ['active_menu' => 'banners']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBanner $request)
    {
        $e_w_id = $request['e_w_id'];
        $type = $request['type'];

        $event = Event::findOrFail($e_w_id);

        if($type == 'W') {
            $e_w_page_link = route('display_workshop', [
                'category' => $event->category->short_name,
                'slug' => $event->slug
            ]);
        } else {
            $e_w_page_link = route('display_event', [
                'category' => $event->category->short_name,
                'slug' => $event->slug
            ]);
        }

        $banner_img = $request->file('banner_image');
        $banner_img_path = $banner_img->store('public/banners');

        // store the data to the database
        $banner = new Banner();
        $banner->banner_image =   str_replace_first('public/', '', $banner_img_path);
        $banner->e_w_id = $e_w_id;
        $banner->type = $type;
        $banner->e_w_page_link = $e_w_page_link;
        $banner->saveOrFail();

        return redirect()->route('admin.banners.index');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        // delete associated poster and thumbnail also
        Storage::delete('public/' . $banner->banner_image);

        $banner->delete();

        return redirect()->route('admin.banners.index');
    }

}
