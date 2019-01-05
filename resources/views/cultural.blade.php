@extends('layouts.master',['bodyclass' => 'index-page','navbar' => 'navbar-transparent fixed-top'])

@section('content')
<div class="wrapper">
    <div class="page-header header-filter image-back" >
      <div class="container">
        <div class="category-absolute">
            <img src="{{ asset('img/catch.png') }}" class="img-raised"/>   
        </div>
      </div>
    </div>
    <div class="main">
        <div class="section-full-page full-page-background" data-image="{{ asset('img/mainback.png') }}">
            <div class="content">

            </div>
    </div>

        </div>
            
          
      <!--  End Modal -->
    </div>
    
@endsection