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
        
@endsection