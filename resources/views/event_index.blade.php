@extends('layouts.master')

@section('content')
<div class="wrapper">
    <div class="page-header header-filter">
        <img src="assets/img/path3.png" class="path">
      <div class="container">
        <div class="content-center brand">  
            <img src="{{ asset('img/'.$event_group->short_name.'.svg') }}" class="img-center img-fluid" width="400" height="400">
            <br>
            <h1 class="h1-seo">Events</h1>
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
                                            <span class="blog-slider__code">26 December 2019</span>
                                            <div class="blog-slider__title">{{$event->name}}</div>
                                            <div class="blog-slider__text">{!! $event->description !!} </div>
                                            <a href="" class="blog-slider__button">READ MORE</a>
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