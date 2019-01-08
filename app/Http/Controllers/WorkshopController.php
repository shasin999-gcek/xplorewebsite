<?php

namespace App\Http\Controllers;

use App\Workshop;
use Illuminate\Http\Request;
use App\Category;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function show($category, $slug)
    {
        //
        $workshop = Workshop::with('category')->where('slug', $slug)->firstOrFail();

        if($workshop->category->short_name != $category)
        {
            abort(404);
        }

        return view('workshop_show', ['workshop' => $workshop]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function edit(Workshop $workshop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workshop $workshop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workshop $workshop)
    {
        //
    }

    public function getWorkshopsByCategory($category) {

        $workshop_group = Category::with('workshops')->where('short_name', $category)->firstOrFail();
        $workshop_group->workshops->each(function($workshop) {
            $workshop->duration = $workshop->starts_on->format('d') . ' - ' . $workshop->ends_on->format('d') . ' ' . $workshop->ends_on->format('M'); 
        });

        $data = [
            'workshop_group' => $workshop_group,
            'active_menu' => 'workshop'
        ];

        return view('workshop_index',$data);
    }
}
