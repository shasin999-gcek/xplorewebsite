@extends('layouts.master',['bodyclass' => 'index-page','navbar' => ' ', 'nofooter' => ' '])

@section('content')
<div class="wrapper">
    <div class="section section-tabs">
        <div class="container">        
          <div class="row">
            <div class="col-md-12 ml-auto col-xl-12 mr-auto">
                <hr class="line-info">
                <h2>Title Sponsor</h2>
            </div>
          </div>
          <div class="row row-grid justify-content-center">
            <div class="col-md-10 ml-auto col-xl-4 mr-auto text-center">              
              <a href="https://byjus.com"><img class="img-fluid floating" src="{{asset('img/byju.png')}}" width="300" height="300"></a>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 ml-auto col-xl-12 mr-auto">
                <hr class="line-info">
                <h2>Associate Sponsor</h2>
            </div>
          </div>
          <div class="row row-grid justify-content-center">
            <div class="col-md-10 ml-auto col-xl-4 mr-auto text-center  ">              
              <img class="img-fluid floating" src="{{asset('img/westind.png')}}" width="300" height="300">
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 ml-auto col-xl-12 mr-auto">
                <hr class="line-info">
                <h2>Banking Partner</h2>
            </div>
          </div>
          <div class="row row-grid justify-content-center">
            <div class="col-md-10 ml-auto col-xl-2 mr-auto text-center">              
              <img class="img-fluid floating" src="{{asset('img/bank.png')}}" width="300" height="300">
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 ml-auto col-xl-12 mr-auto text-center">
              <h4>Morazha-Kalliasseri Service Co-op Bank</h4>
            </div>   
          </div>
          <div class="row">
            <div class="col-md-12 ml-auto col-xl-12 mr-auto">
                <hr class="line-info">
                <h2>Media Partners</h2>
            </div>
          </div>
          <div class="row row-grid justify-content-center"> 
            <div class="col-md-10 ml-auto col-xl-4 mr-auto text-center">
              <img class="img-fluid floating" src="{{ asset('img/club.png') }}"/>
              
            </div>
            <div class="col-md-10 ml-auto col-xl-4 mr-auto text-center">
              <a href="https://digitalbuddha.in/"><img class="img-fluid floating" src="{{ asset('img/buddha.png') }}"/></a>
              
            </div>     
          </div>
          
          <div class="row">
            <div class="col-md-12 ml-auto col-xl-12 mr-auto">
                <hr class="line-info">
                <h2>Travel Partner</h2>
            </div>
          </div>
          <div class="row row-grid justify-content-center">
            <div class="col-md-10 ml-auto col-xl-2 mr-auto text-center">              
              <img class="img-fluid floating" src="{{asset('img/goyathra.png')}}" width="300" height="300">
            </div>
          </div>
           <div class="row">
            <div class="col-md-12 ml-auto col-xl-12 mr-auto text-center">
              <h4>Go Yaathra 24x7 Taxi Services</h4>
            </div>   
          </div>
          <div class="row">
            <div class="col-md-12 ml-auto col-xl-12 mr-auto">
                <hr class="line-info">
                <h2>Entertainment Partner</h2>
            </div>
          </div>
          <div class="row row-grid justify-content-center"> 
            <div class="col-md-10 ml-auto col-xl-4 mr-auto text-center">
              <img class="img-fluid floating" src="{{ asset('img/vismaya.png') }}"/>
              
            </div>    
          </div>
          <div class="row">
            <div class="col-md-12 ml-auto col-xl-12 mr-auto">
                <hr class="line-info">
                <h2>Proshow Partner</h2>
            </div>
          </div>
          <div class="row row-grid justify-content-center">
            <div class="col-md-10 ml-auto col-xl-4 mr-auto text-center">              
              <img class="img-fluid floating" src="{{asset('img/bucket.png')}}" width="300" height="300">
            </div>
            
          </div>
          <div class="row">
            <div class="col-md-12 ml-auto col-xl-12 mr-auto">
                <hr class="line-info">
                <h2>Promotional Partner</h2>
            </div>
          </div>
          <div class="row row-grid justify-content-center"> 
            <div class="col-md-10 ml-auto col-xl-4 mr-auto text-center">
              <img class="img-fluid floating" src="{{ asset('img/eventoz.png') }}"/>
              <h4 class="my-2">Eventoz</h4>
            </div>    
          </div>
          <div class="row">
            <div class="col-md-12 ml-auto col-xl-12 mr-auto">
                <hr class="line-info">
                <h2>Event Partners</h2>
            </div>
          </div>
          <div class="row row-grid justify-content-center">
            <div class="col-md-12 ml-auto my-3 text-center col-xl-4 mr-auto">              
              <img class="img-fluid floating" src="{{asset('img/tnm.jpg')}}" width="300" height="300">
            </div>
            <div class="col-md-12 ml-auto my-3 text-center col-xl-4 mr-auto">              
              <img class="img-fluid floating" src="{{asset('img/icfoss.png')}}" width="300" height="300">
            </div>
            <div class="col-md-12 ml-auto my-3 text-center col-xl-4 mr-auto">              
              <img class="img-fluid floating" src="{{asset('img/ulccs.png')}}" width="300" height="300">
            </div>
            <div class="col-md-12 ml-auto my-3 text-center col-xl-4 mr-auto">              
              <img class="img-fluid floating" src="{{asset('img/ultratech.jpg')}}" width="300" height="300">
            </div>
            <div class="col-md-12 ml-auto my-3 text-center col-xl-4 mr-auto">              
              <img class="img-fluid floating" src="{{asset('img/qfactory.jpg')}}" width="300" height="300">
            </div>
            <div class="col-md-12 ml-auto my-3 text-center col-xl-4 mr-auto">              
              <img class="img-fluid floating" src="{{asset('img/appin.jpg')}}" width="300" height="300">
            </div>
            <div class="col-md-12 ml-auto my-3 text-center col-xl-4 mr-auto">              
              <img class="img-fluid floating" src="{{asset('img/q4q.jpg')}}" width="300" height="300">
            </div>
            <div class="col-md-12 ml-auto my-3 text-center col-xl-4 mr-auto">              
              <img class="img-fluid floating my-5" src="{{asset('img/cadd.jpg')}}" >
            </div>
          </div>
         
        </div>
      </div>
        
@endsection