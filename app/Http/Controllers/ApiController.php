<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class ApiController extends Controller
{
    public function getEventLists(Request $request)
    {
        if($request->has('category') && $request->has('event_slug'))
        {
            $event = Event::join('categories', 'categories.id', '=', 'events.category_id')
                ->where('short_name', 'cse')
                ->get([
                    'events.name as event_name', 
                    'slug as event_slug',
                    'type as event_type',
                    'categories.name as c_name', 
                    'categories.short_name as c_short_name', 
                    'description as event_description', 
                    'poster_image', 
                    'thumbnail_image', 
                    'reg_fee',
                    'f_price_money',
                    's_price_money',
                    't_price_money',
                ]);

            $event->each(function($e) {
                $e->poster_image = asset('storage/' . $e->poster_image);
                $e->thumbnail_image = asset('storage/' . $e->thumbnail_image);
                $e->event_page_link = route('display_event', ['category' => $e->c_short_name, 'slug' => $e->event_slug]);
            });  
            
            return $event;

        }

        if($request->has('category'))
        {
            
        }
    }
}
