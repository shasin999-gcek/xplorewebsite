@extends('layouts.master',['bodyclass' => 'index-page','navbar' => 'navbar-transparent fixed-top','nofooter' => 'd-none'])

@section('content')
<div class="wrapper">
<div class="owl-carousel owl-theme">
  @if($management_event->count() > 0)
    @foreach($management_event->events as $event)
      <div class="owl-slide d-flex align-items-center cover" style="background-image: linear-gradient(rgba(3, 3, 3, 0.72), rgba(9, 9, 9, 0.82)), url('{{ asset('storage/' . $event->thumbnail_image) }}');">
        <div class="container">
          <div class="row justify-content-center justify-content-md-start">
            <div class="col-10 col-md-6 static">
              <div class="owl-slide-text">
                <h2 class="owl-slide-animated owl-slide-title">
                  {{ $event->name }}
                </h2>
                <div class="owl-slide-animated owl-slide-subtitle mb-3">
                   {{ $event->description }}
                </div>
                <a class="btn btn-info btn-lg owl-slide-animated owl-slide-cta" href="{{ route('display_event', ['category' => $event->category->short_name, 'slug' => $event->slug]) }}" role="button">
                  Read More
                </a>
              </div><!-- /owl-slide-text -->
            </div>
          </div>
        </div>
      </div><!-- /slide1 -->
    @endforeach
  @endif 
</div>  
</div>
@endsection