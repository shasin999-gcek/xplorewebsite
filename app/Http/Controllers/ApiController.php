<?php

namespace App\Http\Controllers;

use App\User;
use function foo\func;
use Illuminate\Http\Request;
use App\Event;
use App\Workshop;
use App\Banner;

class ApiController extends Controller
{
    public function getEvents(Request $request)
    {
        if($request->has('category'))
        {
            $event = Event::join('categories', 'categories.id', '=', 'events.category_id')
                ->where('short_name', $request['category'])
                ->get([
                    'events.id as event_id',
                    'events.name as event_name', 
                    'slug as event_slug',
                    'type as event_type',
                    'categories.name as c_name', 
                    'categories.short_name as c_short_name', 
                    'description as event_desc',
                    'poster_image as event_img',
                    'pdf_path as event_file',
                    'thumbnail_image', 
                    'reg_fee as event_reg_fee',
                    'date',
                    'f_price_money',
                    's_price_money',
                    't_price_money',
                ]);

            $event->each(function($e) {
                $e->event_date = $e->date->format('d M');
                $e->event_time = $e->date->format('h:i A');
                unset($e->date);
                $e->event_img = asset('storage/' . $e->event_img);
                $e->thumbnail_image = asset('storage/' . $e->thumbnail_image);
                $e->event_file = asset('storage/' . $e->event_file);
                $e->event_page_link = route('display_event', ['category' => $e->c_short_name, 'slug' => $e->event_slug]);
            });  
            
            return $event;

        }

        return ['errorMsg' => 'Please specify a category'];
    }

    public function getWorkshops(Request $request)
    {
       
        $workshops = Workshop::join('categories', 'categories.id', '=', 'workshops.category_id')
            ->get([
                'workshops.id as ws_id',
                'workshops.name as ws_name',
                'slug as ws_slug',
                'categories.name as c_name',
                'categories.short_name as c_short_name',
                'description as ws_desc',
                'poster_image as ws_img',
                'pdf_path as ws_file',
                'thumbnail_image',
                'reg_fee as ws_reg_fee',
                'starts_on',
                'ends_on'
            ]);

        $workshops->each(function ($w) {
            $w->ws_date = $w->starts_on->format('d-').$w->ends_on->format('d M');
            $w->ws_time = $w->starts_on->format('h:i A');
            unset($w->starts_on);
            unset($w->ends_on);
            $w->ws_img = asset('storage/' . $w->ws_img);
            $w->thumbnail_image = asset('storage/' . $w->thumbnail_image);
            $w->ws_file = asset('storage/' . $w->ws_file);
            $w->ws_page_link = route('display_workshop', ['category' => $w->c_short_name, 'slug' => $w->ws_slug]);
        });

        return $workshops;
        
    }


    public function getRegistrations(Request $request)
    {
        if($request->has('uid'))
        {
            $user = User::where('firebase_uid', $request['uid'])->firstOrFail();
            $regs = [];
            foreach ($user->s_events_api as $e) {
                $temp = [];
                $temp['e_id'] = $e->id;
                $temp['e_name'] = $e->name;
                $temp['e_by'] = $e->category->name;
                $temp['e_reg_fee'] = $e->reg_fee;
                $temp['e_date'] = $e->date->format('d M');
                $temp['e_time'] = $e->date->format('h:i A');
                $temp['e_img'] = asset('storage/' . $e->poster_image);
                $temp['user'] = $user->name;
                $temp['order_id'] = $e->pivot->order_id;
                $temp['ticket-link'] = route('event.ticket', $e->pivot->order_id);
                array_push($regs, $temp);
            }

            foreach ($user->s_workshops_api as $e) {
                $temp = [];
                $temp['e_id'] = $e->id;
                $temp['e_name'] = $e->name;
                $temp['e_by'] = $e->category->name;
                $temp['e_reg_fee'] = $e->reg_fee;
                $temp['e_date'] = $e->starts_on->format('d-') . $e->ends_on->format('d M');
                $temp['e_time'] = $e->starts_on->format('h:i A');
                $temp['e_img'] = asset('storage/' . $e->poster_image);
                $temp['user'] = $user->name;
                $temp['order_id'] = $e->pivot->order_id;
                $temp['ticket-link'] = route('workshop.ticket', $e->pivot->order_id);
                array_push($regs, $temp);
            }

            return $regs;
        }

        return ['errorMsg' => 'Please specify a firebase user id'];
    }


    public function getEventById(Request $request)
    {
        if($request->has('event_id')) {
            $event_id = $request->get('event_id');
            $event = Event::join('categories', 'categories.id', '=', 'events.category_id')
                ->findOrFail($event_id, [
                    'events.id as event_id',
                    'events.name as event_name', 
                    'slug as event_slug',
                    'type as event_type',
                    'categories.name as c_name', 
                    'categories.short_name as c_short_name', 
                    'description as event_desc',
                    'poster_image as event_img',
                    'pdf_path as event_file',
                    'thumbnail_image', 
                    'reg_fee as event_reg_fee',
                    'date',
                    'f_price_money',
                    's_price_money',
                    't_price_money',
                ]);
            
            $event->event_date = $event->date->format('d M');
            $event->event_time = $event->date->format('h:i A');
            unset($event->date);
            $event->event_img = asset('storage/' . $event->event_img);
            $event->thumbnail_image = asset('storage/' . $event->thumbnail_image);
            $event->event_file = asset('storage/' . $event->event_file);
            $event->event_page_link = route('display_event', ['category' => $event->c_short_name, 'slug' => $event->event_slug]);

            return $event;
        } 

        return ['errorMsg' => 'Please specify a event id'];        
    }

    public function getWorkshopById(Request $request)
    {
        if($request->has('workshop_id')) {
            $workshop_id = $request->get('workshop_id');
            $workshop = Workshop::join('categories', 'categories.id', '=', 'workshops.category_id')
                ->findOrFail($workshop_id, [
                    'workshops.id as ws_id',
                    'workshops.name as ws_name',
                    'slug as ws_slug',
                    'categories.name as c_name',
                    'categories.short_name as c_short_name',
                    'description as ws_desc',
                    'poster_image as ws_img',
                    'pdf_path as ws_file',
                    'thumbnail_image',
                    'reg_fee as ws_reg_fee',
                    'starts_on',
                    'ends_on'
                ]);

            $workshop->ws_date = $workshop->starts_on->format('d-').$workshop->ends_on->format('d M');
            $workshop->ws_time = $workshop->starts_on->format('h:i A');
            unset($workshop->starts_on);
            unset($workshop->ends_on);
            $workshop->ws_img = asset('storage/' . $workshop->ws_img);
            $workshop->thumbnail_image = asset('storage/' . $workshop->thumbnail_image);
            $workshop->ws_file = asset('storage/' . $workshop->ws_file);
            $workshop->ws_page_link = route('display_workshop', ['category' => $workshop->c_short_name, 'slug' => $workshop->ws_slug]);

            return $workshop;
        } 

        return ['errorMsg' => 'Please specify a workshop id'];        
    }

    public function getAllEvents()
    {
        return Event::get(['id', 'name']);
    }

    public function getAllWorkshops()
    {
        return Workshop::get(['id', 'name']);
    }

    public function getBanners(Request $request)
    {
        $banners = Banner::all();
        $banners->each(function($b) {
            $b->banner_image = asset('storage/' . $b->banner_image);
        });

        if($request->has('uid'))
        {
            $banners->each(function($b) use($request) {
                $b->user_name = User::where('firebase_uid', $request->uid)->first()->name;
            });
        }
        
        return $banners;
    }

    public function getAllWorkshopInfo()
    {
        return Workshop::all();
    }

    public function getUserProfile(Request $request)
    {
        if(!$request->has('uid'))
        {
            return ['errorMsg' => 'Please specify a uid'];   
        }

        $user = User::where('firebase_uid', $request['uid'])->firstOrFail();
        
        return $user;
    }

    public function getUserById(Request $request)
    {
        if(!$request->has('id'))
        {
            return ['errorMsg' => 'Please specify mail id of the user'];   
        }

        $user = User::findOrFail($request['id']);

        return $user;
    }

}
