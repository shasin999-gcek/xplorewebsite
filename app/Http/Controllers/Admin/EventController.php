<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\EventCategory;
use App\Http\Requests\StoreEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
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
        $categories = EventCategory::all();
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
        $event_category = EventCategory::findOrFail($request['category_id']);

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

        // associate EventCategory with Event (autopopulate category_id)
        $event->category()->associate($event_category);

        $poster_image = $request->file('poster_image');
        $path = $poster_image->store('public/event_posters');

        $event->poster_image_name =   str_replace_first('public/', '', $path);

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
        $categories = EventCategory::all();

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
        $event_category = EventCategory::findOrFail($request['category_id']);

        $event->name = $request['name'];
        $event->slug = str_slug($request['name']);
        $event->type = $request['type'];
        $event->description = $request['description'];
        $event->reg_fee = $request['reg_fee'];
        $event->f_price_money = $request['f_price'];
        $event->s_price_money = $request['s_price'];
        $event->t_price_money = $request['t_price'];

        // associate EventCategory with Event (autopopulate category_id)
        $event->category()->associate($event_category);

        // delete previous file before storing new file
        Storage::delete('public/' . $event->poster_image_name);

        $poster_image = $request->file('poster_image');
        $path = $poster_image->store('public/event_posters');

        $event->poster_image_name =   str_replace_first('public/', '', $path);

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
        //
        Storage::delete('public/' . $event->poster_image_name);
        $event->delete();

        return redirect()->route('admin.events.index');
    }

    /**
     * @param Event $event
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function share_on_facebook(Event $event)
    {
        $request_uri = 'https://graph.facebook.com/v3.2/' . env('FBPAGE_ID') . '/feed';

        try {
            $client = new Client(); //GuzzleHttp\Client
            $result = $client->post($request_uri, [
                'query' => [
                    'message' => $event->name,
                    'link' => 'https://www.manoramanews.com/news/kerala/2018/12/27/opposition-closed-councillor-in-room.html', // urldecode(route('display_event', $event->slug)),
                    'access_token' => env('FBPAGE_ACCESS_TOKEN')
                ]
            ]);

            $json_data= json_decode($result->getBody()->getContents());
            $post_id = $json_data->id;

            // create facebook post url and save to database
            $shared_post_url = 'https://www.facebook.com/' . $post_id;
            $event->shared_post_url = $shared_post_url;
            $event->saveOrFail();

            return ['shared_post_url' => $shared_post_url];
        } catch (RequestException $e) {
           return $e->getResponse();
        }


    }
}
