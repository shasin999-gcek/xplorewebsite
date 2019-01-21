@extends('layouts.master',['bodyclass' => 'register-page','active_menu' => 'login','navbar' => ''])

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
                    <h4>Date: {{ $event->date->format('D d-M-Y h:i A') }} </h4> <br>

                    <br><br>
					<h3> Registration Fee: {{ $event->reg_fee }}</h3>

                    @if(Route::has('login'))
                        @auth
                            @isset($alreadyRegistered)
                                <a class="btn btn-primary" href="{{ route('event.ticket', $alreadyRegistered->order_id) }}">Download Ticket</a>
                            @else
                                @if(!$event->is_reg_closed)
                                    {{--<button class="btn btn-info " onclick="event.preventDefault(); document.getElementById('event_reg_form').submit();">Buy Ticket using Paytm</button>--}}
                                    {{--<form id="event_reg_form" method="post" action="{{ route('event.register') }}" style="display: none;">--}}
                                    {{--{{ csrf_field() }}--}}
                                    {{--<input type="text" name="event_id" value="{{ $event->id }}">--}}
                                    {{--</form>--}}
                                    <button class="btn btn-default" onclick="event.preventDefault(); document.getElementById('event_reg_form-insta').submit();">Buy Ticket</button><br>
                                    {{--<small> *Please login to paytm for uninterrupted transaction </small><br>--}}
                                    <form id="event_reg_form-insta" method="post" action="{{ route('event.register-insta') }}" style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="text" name="event_id" value="{{ $event->id }}">
                                    </form>
                                @else
                                    <button class="btn btn-default" disabled>Registration Closed</button><br>
                                @endif    
                            @endisset
                        @else
                            @if(!$event->is_reg_closed)
                                <a href="{{ route('login') }}" class=" btn btn-lg btn-warning"  >
                                <i class="tim-icons icon-cloud-download-93"></i> Login to Buy Ticket </a><br>
                            @else
                                <button class="btn btn-default" disabled>Registration Closed</button><br>
                            @endif 
                        @endauth
                    @endif

                </div>
              </section>
  </div></div></div>
  @endsection