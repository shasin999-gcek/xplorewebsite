@extends('layouts.master',['bodyclass' => 'index-page','navbar' => 'navbar-transparent'])

@section('content')
<div class="wrapper">
    <div class="page-header header-filter">
        <img src="assets/img/path3.png" class="path">
      <div class="container">
        <div class="content-center brand">  
            <img src="{{ asset('img/'.$event_group->short_name.'.png') }}" class="img-center img-fluid" width="400" height="400">
            <br>
            <h1 class="h1-seo">EVENTS</h1>
        </div>
      </div>
    </div>
    <div class="main">
        <div class="section" >
            <div class="container">
            @foreach($event_group->events as $event)
                <div class="row row-grid justify-content-between align-items-center event-div" style="margin-top:10%">
                        <div class="col-md-12 " >
                                <div class="blog-slider">   
                                        <div class="blog-slider__item">
                                          <div class="blog-slider__img">
                                            
                                            <img src="{{ asset('storage/' . $event->thumbnail_image) }}" alt="">
                                          </div>
                                          <div class="blog-slider__content">
                                            <span class="blog-slider__code">{{$event->type}}</span>
                                            <div class="blog-slider__title">{{$event->name}}</div>
                                            <!-- <div class="blog-slider__text">{!! $event->description !!} </div> -->
                                            @if($event->slug == 'hack-the-night')
                                                  <a href="https://goo.gl/forms/4yGFzrvUMYiMpVwZ2" class="blog-slider__button">Register</a>
                                            @else
                                                <a href="{{ route('display_event', ['category' => $event->category->short_name, 'slug' => $event->slug]) }}" class="blog-slider__button">READ MORE</a>
                                            @endif
                                          </div>
                                        </div>
                                    </div>
                        </div>
                </div>
                @endforeach 
            </div>
        </div>
         
              <section>
                  <div class="flowers-container">
                      <div class="flowers-left"></div>
                      <div class="flowers-right"></div>
                    </div>
              </section> 
              
      <!-- Form Modal -->
      
      <!--  End Modal -->
    </div>
 @endsection   