@extends('layouts.master',['bodyclass' => 'register-page bkg-yellow','active_menu' => 'login','navbar' => 'bkg-yellow'])

@section('metatags')
  <meta property="og:tags">

  <meta property="og:title" content="{{ $event->name }} By {{ $event->category->name }}"/>

  <meta property="og:description" content="{{ str_before($event->description, '.') }}">


  <meta property="og:type" content="article"/>
  <meta property="og:image" content="{{ asset('storage/' . $event->poster_image) }}"/>
  <meta property="og:site_name" content="Xplore 19"/>
  <meta property="og:url" content="{{ route('display_event', ['category' => $event->category->short_name, 'slug' => $event->slug]) }}"/>

  <meta property="fb:app_id" content="300872960546512"/>
  <meta property="fb:pages" content="335205793240413"/>

  <meta property="article:author" content="https://www.facebook.com/xplore19"/> 
  <meta property="article:publisher" content="https://www.facebook.com/xplore19"/>

@endsection


@section('content')
<div class="wrapper">
        <img src="{{ asset('img/dots.png') }}" class="dots">
        
        <div style="padding-top:10vh" class="container">
            <div class="row">
            
            
          <div class="col-md-4 ml-auto mr-auto text-center">
              <img src="{{ asset('storage/' . $event->poster_image) }}" class="img-raised img-responsive">
              <hr>
              <a href="{{ asset('storage/' . $event->pdf_path) }}" class="btn btn-simple">Download PDF</a>
              <div class="btn-wrapper profile">
                        <a target="_blank" href="#" class="btn btn-icon btn-neutral btn-round btn-simple" data-toggle="tooltip" data-original-title="Follow us">
                          <i class="fab fa-twitter"></i>
                        </a>
                        <a target="_blank" href="#" class="btn btn-icon btn-neutral btn-round btn-simple" data-toggle="tooltip" data-original-title="Like us">
                          <i class="fab fa-facebook-square"></i>
                        </a>
                        
                      </div>
            </div>
            <div class="col-md-8 ml-auto mr-auto">
              <section class="section section-lg " style="padding: 0; margin-bottom: 5%">
                <div class="container">
                  <div class="row">
                    <div class="col-md-9">
                      <hr class="line-info">
                      <h1>{{ $event->name }}
                      </h1>
                    </div>
                  </div>
                  
                </div>
                <div class="container">
                    <p style="white-space: pre-line;">{{ $event->description }}</p><br><br>
                    <h4>Date: {{ $event->date->format('D d-M-Y h:i:s') }} </h4> <br>

                    <br><br>
					<h3> Registration Fee: {{ $event->reg_fee }}</h3>

              <button class="btn btn-info btn-lg " onclick="event.preventDefault(); document.getElementById('event_reg_form').submit();">Buy Ticket</button><br>

              <form id="event_reg_form" method="post" action="{{ route('event.register') }}" style="display: none;">
                {{ csrf_field() }}
                <input type="text" name="event_id" value="{{ $event->id }}">
              </form>

                </div>
              </section>
  </div></div></div>
  @endsection