@extends('layouts.master',['bodyclass' => 'index-page bg-purple','navbar' => 'navbar-transparent fixed-top','active_menu' => ' '])

@section('content')
<div class="wrapper multiple-stars">
    <div class="page-header header-filter">
        
        <div class="objects">
                    
                    <div class="earth-moon">
                        
                        <img class="object_moon" src="http://salehriaz.com/404Page/img/moon.svg" width="80px">
                    </div>
                    <div class="box_astronaut">
                        <img class="object_astronaut" src="http://salehriaz.com/404Page/img/astronaut.svg" width="70px">
                    </div>
        </div>
        <div class="glowing_stars">
                    <div class="star"></div>
                    <div class="star"></div>
                    <div class="star"></div>
                    <div class="star"></div>
                    <div class="star"></div>

                </div>
        <div class="container">
            <div class="content-center brand">
                <img class="image-404" src="http://salehriaz.com/404Page/img/404.svg" width="300px">
                <a href="{{ url('/') }}" class="btn-go-home">GO BACK HOME</a>
            </div>
        </div>
    </div>

@endsection

            