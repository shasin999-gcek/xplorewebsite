@extends('layouts.master',['bodyclass' => 'register-page','active_menu' => 'login','navbar' => ''])

@section('content')
<div class="wrapper">
        <img src="{{ asset('img/dots.png') }}" class="dots">
        
        <div style="padding-top:10vh" class="container">
            <div class="row">
            
            
          <div class="col-md-4 ml-auto mr-auto">
              <img src="{{ asset('storage/' . $event->poster_image) }}" class="img-raised img-responsive">
              <div class="btn-wrapper profile">
                        <a target="_blank" href="https://twitter.com/creativetim" class="btn btn-icon btn-neutral btn-round btn-simple" data-toggle="tooltip" data-original-title="Follow us">
                          <i class="fab fa-twitter"></i>
                        </a>
                        <a target="_blank" href="https://www.facebook.com/creativetim" class="btn btn-icon btn-neutral btn-round btn-simple" data-toggle="tooltip" data-original-title="Like us">
                          <i class="fab fa-facebook-square"></i>
                        </a>
                        <a target="_blank" href="https://dribbble.com/creativetim" class="btn btn-icon btn-neutral  btn-round btn-simple" data-toggle="tooltip" data-original-title="Follow us">
                          <i class="fab fa-dribbble"></i>
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
                    <p>{{ $event->description }}</p><br><br>
					<h4> First Price :  {{ $event->f_price_money }} <br>
					Second Price :  {{ $event->s_price_money }} <br>
					Third Price :  {{ $event->t_price_money }}</h4>

                    <br><br>
					<h3> Registration Fee: {{ $event->reg_fee }}</h3>
                    <button class="btn btn-info btn-lg ">Buy Ticket</button><br>

                    

                </div>
              </section>
  </div></div></div>