@extends('layouts.master',['bodyclass' => 'index-page','navbar' => 'navbar-transparent fixed-top'])

@section('content')
<div class="wrapper">
    <div class="page-header header-filter image-back" style="height:auto;max-height:unset">
      <div class="container-fluid px-0">
        <div class="d-flex flex-cultural flex-nowrap">
                <div class="flex-fill">
                    <div class="flex-disp">
                        <img src="{{ asset('img/sunburn.png') }}" class="img-fluid"/>
                    </div>
                </div>
                <div class="flex-fill">
                    <div class="flex-disp">
                        <img src="{{ asset('img/probro.png') }}" class="img-fluid"/>
                        <a href="{{ route('display_event', ['category' => 'show', 'slug' => 'sunburn-progressive-brothers']) }}" class="btn btn-danger btn-lg cultural-btn">Show Details</a>
                    </div>
                </div>
                <div class="flex-fill">
                    <div class="flex-disp">
                        <img src="{{ asset('img/masaco.png') }}" class="img-fluid"/>
                        <a href="{{ route('display_event', ['category' => 'show', 'slug' => 'masala-coffee']) }}" class="btn btn-danger btn-lg cultural-btn">Show Details</a>
                    </div>
                </div>
            </div>
        <div class="category-absolute">
            <img src="{{ asset('img/catch.png') }}" class="img-raised"/>   
        </div>
        
        </div>
    </div>
    <div class="main">
        <div class="container-fluid px-0">
            <div class="d-flex flex-wrap">
            @if($cultural_event->count() > 0)
            @foreach($cultural_event->events as $event)

                <div class="flex-fill">
                    <div class="flex-disp">
                        <img src="{{ asset('storage/' . $event->poster_image) }}" class="img-fluid"/>
                        <a href="{{ route('display_event', ['category' => $event->category->short_name, 'slug' => $event->slug]) }}" class="btn btn-danger btn-lg cultural-btn">Show Details</a>
                    </div>
                </div>
            @endforeach
            @endif   
                
            </div>
        </div>
        
    </div>

        </div>
            
          
    </div>
    
@endsection