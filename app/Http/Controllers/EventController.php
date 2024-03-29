<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Category;
use App\EventRegistration;
use DB;
use Auth;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($short_name)
    {
        return Category::where('short_name', $short_name)->with('events')->first();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($category, $slug)
    {
        //
        $event = Event::with('category')->where('slug', $slug)->firstOrFail();

        if($event->category->short_name != $category)
        {
            abort(404);
        }

        $alreadyRegistered = null;
        if(Auth::user())
        {
            $user_id = Auth::user()->id;
            $event_id = $event->id;
            $alreadyRegistered = EventRegistration::where([
                ['user_id', $user_id],
                ['event_id', $event_id], 
                ['is_reg_success', true]
            ])->first();    
        }

        $data = [
            'event' => $event,
            'alreadyRegistered' => $alreadyRegistered
        ];

        if($category == 'cultural-shows') 
        {
            return view('cultural_shows', $data);
        }

        return view('event_show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getEventsByCategory($category) {

        $event_group = Category::with('events')->where('short_name', $category)->firstOrFail();
        $data = [
            'event_group' => $event_group,
            'active_menu' => 'event'
        ];
        return view('event_index',$data);
    }

    public function showProgBrothers()
    {
        $event = Event::with('category')->where('slug', 'progressive-brothers-sunburn-campus')->firstOrFail();


        $alreadyRegistered = null;
        if(Auth::user())
        {
            $user_id = Auth::user()->id;
            $event_id = $event->id;
            $alreadyRegistered = EventRegistration::where([
                ['user_id', $user_id],
                ['event_id', $event_id], 
                ['is_reg_success', true]
            ])->first();    
        }

        $data = [
            'event' => $event,
            'alreadyRegistered' => $alreadyRegistered
        ];

        
        return view('cultural_shows', $data);
    
    }
}
