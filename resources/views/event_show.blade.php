@extends('layouts.master',['bodyclass' => 'register-page ','active_menu' => 'login','navbar' => ''])

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
              <a href="{{ asset('storage/' . $event->pdf_path) }}" class="btn btn-warning">Download PDF</a><br>
              <small>*Instructions and Regulations</small>
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
                    <h4>Date: {{ $event->date->format('D d-M-Y') }} </h4> <br>
					<h4> First Price :  {{ $event->f_price_money }} <br>
					Second Price :  {{ $event->s_price_money }} <br>
					@if($event->t_price_money != 0)Third Price :  {{ $event->t_price_money }}</h4>@endif

                    <br><br>
          <h3> Registration Fee: {{ $event->reg_fee }}</h3>
          
          @if(Route::has('login'))
              @auth
                  @isset($alreadyRegistered)
                    <a class="btn btn-primary" href="{{ route('event.ticket', $alreadyRegistered->order_id) }}">Download Ticket</a>
                  @else
                    <button class="btn btn-info btn-lg " onclick="event.preventDefault(); document.getElementById('event_reg_form').submit();">Buy Ticket</button><br>

                    <form id="event_reg_form" method="post" action="{{ route('event.register') }}" style="display: none;">
                      {{ csrf_field() }}
                      <input type="text" name="event_id" value="{{ $event->id }}">
                    </form>
                  @endisset
              @else
              <a href="{{ route('login') }}" class=" btn btn-lg btn-warning"  >
                <i class="tim-icons icon-cloud-download-93"></i> Login to Buy Ticket </a><br>
                @endauth
                @endif
                </div>
              </section>
  </div></div></div>
  @endsection