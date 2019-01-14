@extends('layouts.master',['bodyclass' => 'index-page','navbar' => ' ', 'nofooter' => ' '])

@section('content')
<div class="wrapper">
    <div class="section section-tabs">
        <div class="container">        
          <div class="row">
            <div class="col-md-12 ml-auto col-xl-12 mr-auto">
                <hr class="line-info">
                <h2>Banking Partner</h2>
            </div>
          </div>
          <div class="row row-grid justify-content-center">
            <div class="col-md-10 ml-auto col-xl-2 mr-auto">              
              <img class="img-fluid floating" src="{{asset('img/bank.png')}}" width="300" height="300">
            </div>
            
          </div>
          <div class="row">
            <div class="col-md-12 ml-auto col-xl-12 mr-auto">
                <hr class="line-info">
                <h2>Promotion Partners</h2>
            </div>
          </div>
          <div class="row row-grid justify-content-center">
            <div class="col-md-10 ml-auto col-xl-4 mr-auto text-center">
              <img class="img-fluid floating" src="{{ asset('img/icfoss.png') }}"/>
            </div>
            <div class="col-md-10 ml-auto col-xl-4 mr-auto text-center">
              <img class="img-fluid floating" src="{{ asset('img/eventoz.png') }}"/>
            </div>
           {{-- <div class="col-md-10 ml-auto col-xl-4 mr-auto text-center">
              <img class="img-fluid floating" src="{{ asset('img/budha.jpg') }}"/>
            </div> --}}
          </div>
        </div>
      </div>
      <section class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-plain">
              <div class="card-header">
                <h1 class="profile-title text-left">Contact</h1>
              </div>
              <div class="card-body">
                <form>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Your Name</label>
                        <input type="text" class="form-control" value=" ">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Email address</label>
                        <input type="email" class="form-control" placeholder=" ">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" value=" ">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Subject</label>
                        <input type="text" class="form-control" value=" ">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Message</label>
                        <input type="text" class="form-control" placeholder="Hello there!">
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary btn-round float-right" rel="tooltip" data-original-title="Can't wait for your message" data-placement="right">Send text</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>   
@endsection