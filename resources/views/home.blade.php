@extends('layouts.master',['bodyclass' => 'index-page','active_menu' => 'login','navbar' => ' '])


@section('content')
<div class="wrapper">
        <img src="assets/img/dots.png" class="dots">
        
        <div style="padding-top:10vh" class="container">
            <div class="row">
            
            
          <div class="col-md-4 ml-auto mr-auto">
              <div class="card card-plain" style="margin-top: 30%">
              <div class="card-header">
                <img class="img-center img-fluid rounded-circle" src="{{ asset('img/user.png') }}" width="150" height="150">
                <h4 class="title" style="text-align: center;">Elon Musk</h4>
              </div>
              <div class="card-body text-center">
                <h5>akkiakshay1997@gmail.com</h5>
                <h5>8129151079</h5>
                
              </div>
            </div>
            </div><div class="col-md-8 ml-auto mr-auto">
              <section class="section section-lg " style="padding: 0;">
                <div class="container">
                  <div class="row">
                    <div class="col-md-9">
                      <hr class="line-info">
                      <h1>Registered <span>Events</span> and <span>Workshop</span>
                      </h1>
                    </div>
                  </div>
                  
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card card-plain">
                              <div class="card-header">
                                <img class="card-img" src="assets/img/management.png">
                                <div class="card-body">
                                  <h3>Event Name</h3>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-plain">
                              <div class="card-header">
                                <img class="card-img" src="assets/img/management.png">
                                <div class="card-body">
                                  <h3>Event Name</h3>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-plain">
                              <div class="card-header">
                                <img class="card-img" src="assets/img/management.png">
                                <div class="card-body">
                                  <h3>Event Name</h3>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div><div class="row">
                        <div class="col-md-4">
                            <div class="card card-plain">
                              <div class="card-header">
                                <img class="card-img" src="assets/img/management.png">
                                <div class="card-body">
                                  <h3>Event Name</h3>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-plain">
                              <div class="card-header">
                                <img class="card-img" src="assets/img/management.png">
                                <div class="card-body">
                                  <h3>Event Name</h3>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-plain">
                              <div class="card-header">
                                <img class="card-img" src="assets/img/management.png">
                                <div class="card-body">
                                  <h3>Event Name</h3>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
              </section>
  </div></div></div>
@endsection
