<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\Category;
use App\Http\Requests\StoreEvent;
use App\Http\Controllers\Controller;

use Toolkito\Larasap\Facebook\Api AS FacebookApi;
use Illuminate\Support\Facades\Storage;


class EventController extends Controller
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
        $events = Event::with('category')->get();
        $data = [
            'events' => $events,
            'active_menu' => 'events'
        ];

        return view('admin.events_index', $data);
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
            'active_menu' => 'events',
            'categories' => $categories
        ];

        return view('admin.events_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEvent $request)
    {
        // find category from id else 404
        $event_category = Category::findOrFail($request['category_id']);

        // new Event instance
        $event = new Event();
        $event->name = $request['name'];
        $event->slug = str_slug($request['name']);
        $event->type = $request['type'];
        $event->description = $request['description'];
        $event->reg_fee = $request['reg_fee'];
        $event->f_price_money = $request['f_price'];
        $event->s_price_money = $request['s_price'];
        $event->t_price_money = $request['t_price'];

        // associate Category with Event (autopopulate category_id)
        $event->category()->associate($event_category);

        // store the poster, pdf and thumbnail images in public/events directory
        $poster_img = $request->file('poster_image');
        $thumbnail_img = $request->file('thumbnail_image');
        $pdf_file = $request->file('pdf_file');

        $poster_img_path = $poster_img->store('public/events');
        $thumbnail_img_path = $thumbnail_img->store('public/events');
        $pdf_file_path = $pdf_file->store('public/events');

        // store the filepath's to the database
        $event->poster_image =   str_replace_first('public/', '', $poster_img_path);
        $event->thumbnail_image =   str_replace_first('public/', '', $thumbnail_img_path);
        $event->pdf_path =   str_replace_first('public/', '', $pdf_file_path);

        $event->saveOrFail();

        return redirect()->route('admin.events.show', $event->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
        $data = [
            'active_menu' => 'events',
            'event' => $event
        ];
        return view('admin.events_show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
        $categories = Category::all();

        $data = [
            'active_menu' => 'events',
            'event' => $event,
            'categories' => $categories
        ];

        return view('admin.events_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEvent $request, Event $event)
    {
        // find category from id else 404
        $event_category = Category::findOrFail($request['category_id']);

        $event->name = $request['name'];
        $event->slug = str_slug($request['name']);
        $event->type = $request['type'];
        $event->description = $request['description'];
        $event->reg_fee = $request['reg_fee'];
        $event->f_price_money = $request['f_price'];
        $event->s_price_money = $request['s_price'];
        $event->t_price_money = $request['t_price'];

        // associate Category with Event (autopopulate category_id)
        $event->category()->associate($event_category);

        // delete previous files before storing new file
        Storage::delete('public/' . $event->poster_image);
        Storage::delete('public/' . $event->thumbnail_image);
        Storage::delete('public/' . $event->pdf_path);
       
        // store the poster, pdf and thumbnail images in public/events directory
        $poster_img = $request->file('poster_image');
        $thumbnail_img = $request->file('thumbnail_image');
        $pdf_file = $request->file('pdf_file');

        $poster_img_path = $poster_img->store('public/events');
        $thumbnail_img_path = $thumbnail_img->store('public/events');
        $pdf_file_path = $pdf_file->store('public/events');

        // store the filepath's to the database
        $event->poster_image =   str_replace_first('public/', '', $poster_img_path);
        $event->thumbnail_image =   str_replace_first('public/', '', $thumbnail_img_path);
        $event->pdf_path =   str_replace_first('public/', '', $pdf_file_path);

        $event->saveOrFail();

        return redirect()->route('admin.events.show', $event->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        // delete associated poster and thumbnail also
        Storage::delete('public/' . $event->poster_image);
        Storage::delete('public/' . $event->thumbnail_image);
        Storage::delete('public/' . $event->pdf_path);

        $event->delete();

        return redirect()->route('admin.events.index');
    }


    /**
     * @param Event $event
     * @return array
     * @throws \Throwable
     */
    public function share_on_facebook(Event $event)
    {
        $link =  route('display_event', $event->slug);
        $message =  "Event Name: " . $event->name . "\nEvent Category: " . $event->category->name;

        try {
            $post_id = FacebookApi::sendLink($link, $message);

            // create facebook post url and save to database
            $shared_post_url = 'https://www.facebook.com/' . $post_id;
            $event->shared_post_url = $shared_post_url;
            $event->saveOrFail();

            return ['shared_post_url' => $shared_post_url];
        } catch (\Exception $e) {
            return ['error_msg' => $e->getMessage()];
        }

    }
}
