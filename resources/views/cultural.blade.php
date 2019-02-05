@extends('layouts.master',['bodyclass' => 'index-page','navbar' => 'navbar-transparent fixed-top','nofooter' => 'd-none'])

@section('content')
<div class="wrapper">
    <div class="page-header header-filter image-back" style="height:auto;max-height:unset">
      <div class="container-fluid px-0">
        <div class="d-flex flex-cultural flex-nowrap">
                <div class="grid-width">
                    <div class="flex-disp">
                        <img src="{{ asset('img/mix.png') }}" class="img-fluid image-over"/>
                        <div class="overlay">
                            <a href="{{ route('display_event', ['category' => 'cultural-shows', 'slug' => 'sunburn-campus-masala-coffee-combo']) }}" class="btn btn-info btn-lg">Show Details</a>
                        </div> 
                    </div>
                </div>
                <div class="grid-width">
                    <div class="flex-disp">
                        <img src="{{ asset('img/probro.png') }}" class="img-fluid image-over"/>
                        <div class="overlay">
                            <a href="{{ route('display_event', ['category' => 'cultural-shows', 'slug' => 'progressive-brothers-sunburn-campus']) }}" class="btn btn-info btn-lg">Show Details</a>
                        </div>            
                    </div>
                </div>
                <div class="grid-width">
                    <div class="flex-disp">
                        <img src="{{ asset('img/masaco.png') }}" class="img-fluid image-over"/>
                        <div class="overlay">
                            <a href="{{ route('display_event', ['category' => 'cultural-shows', 'slug' => 'masala-coffee']) }}" class="btn btn-info btn-lg">Show Details</a>
                        </div>            
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
            <div class="d-flex flex-wrap justify-content-start">
            @if($cultural_event->count() > 0)
            @foreach($cultural_event->events as $event)

                <div class="grid-width">
                    <div class="flex-disp">
                        <img src="{{ asset('storage/' . $event->thumbnail_image) }}" class="img-fluid image-grid"  height="400"/>
                        <div class="overlay">
                            <h2>{{ $event->name }} </h2>
                            <a href="{{ route('display_event', ['category' => $event->category->short_name, 'slug' => $event->slug]) }}" class="btn btn-info btn-lg">Show Details</a>
                        </div>
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