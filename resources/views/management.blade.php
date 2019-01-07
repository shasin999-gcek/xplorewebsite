@extends('layouts.master',['bodyclass' => 'index-page','navbar' => 'navbar-transparent fixed-top','nofooter' => 'd-none'])

@section('content')
<div class="wrapper">
<div class="owl-carousel owl-theme">
                <div class="owl-slide d-flex align-items-center cover" style="background-image: linear-gradient(rgba(3, 3, 3, 0.72), rgba(9, 9, 9, 0.82)), url('assets/img/business.jpg');">
                  <div class="container">
                    <div class="row justify-content-center justify-content-md-start">
                      <div class="col-10 col-md-6 static">
                        <div class="owl-slide-text">
                          <h2 class="owl-slide-animated owl-slide-title">
                            Event Name 1
                          </h2>
                          <div class="owl-slide-animated owl-slide-subtitle mb-3">
                            Event Description 1
                          </div>
                          <a class="btn btn-info btn-lg owl-slide-animated owl-slide-cta" href="" role="button">
                            Buy Ticket !
                          </a>
                        </div><!-- /owl-slide-text -->
                      </div>
                    </div>
                  </div>
                </div><!-- /slide1 -->
                 
                <div class="owl-slide d-flex align-items-center cover" style="background-image: linear-gradient(rgba(3, 3, 3, 0.72), rgba(9, 9, 9, 0.82)), url('assets/img/cul1.jpg');">
                    <div class="container">
                      <div class="row justify-content-center justify-content-md-start">
                        <div class="col-10 col-md-6 static">
                          <div class="owl-slide-text">
                            <h2 class="owl-slide-animated owl-slide-title">
                            Event Name 2
                            </h2>
                            <div class="owl-slide-animated owl-slide-subtitle mb-3">
                            Event Description 2
                            </div>
                            <a class="btn btn-info btn-lg owl-slide-animated owl-slide-cta" href="" role="button">
                            Buy Ticket 2
                            </a>
                          </div><!-- /owl-slide-text -->
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="owl-slide d-flex align-items-center cover" style="background-image: linear-gradient(rgba(3, 3, 3, 0.72), rgba(9, 9, 9, 0.82)), url('assets/img/cul2.jpg');">
                    <div class="container">
                      <div class="row justify-content-center justify-content-md-start">
                        <div class="col-10 col-md-6 static">
                          <div class="owl-slide-text">
                            <h2 class="owl-slide-animated owl-slide-title">
                            Event Name 3
                            </h2>
                            <div class="owl-slide-animated owl-slide-subtitle mb-3">
                            Event Description 3
                            </div>
                            <a class="btn btn-info btn-lg owl-slide-animated owl-slide-cta" href="" role="button">
                            Buy Ticket 3
                            </a>
                          </div><!-- /owl-slide-text -->
                        </div>
                      </div>
                    </div>
                  </div>  
              </div>
@endsection