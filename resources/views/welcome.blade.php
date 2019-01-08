@extends('layouts.master',['bodyclass' => 'index-page','navbar' => 'navbar-transparent fixed-top', 'nofooter' => ' '])

@section('content')
<div class="wrapper multiple-stars">
    <div class="page-header header-filter">
      <div class="gear"></div>
      
      <div class="stars stars-1"></div>
      <div class="stars stars-2"></div>
      <div class="stars stars-3"></div>
      <div class="stars stars-4"></div>
      <div class="ec"></div>
      <div class="electrical"></div>
      <div class="city"></div>
      <div class="objects">
                
                <div class="earth-moon">
                    
                    <img class="object_moon" src="http://salehriaz.com/404Page/img/moon.svg" width="80px">
                </div>
                <div class="box_astronaut">
                    <img class="object_astronaut" src="http://salehriaz.com/404Page/img/astronaut.svg" width="70px">
                </div>
      </div>
      <div class="glowing_stars">
                <div class="star"></div>
                <div class="star"></div>
                <div class="star"></div>
                <div class="star"></div>
                <div class="star"></div>

            </div>
      <div class="container">
        <div class="content-center brand">
          <div class="rocket"></div>
          <img src="{{ asset('img/Xplore.svg') }}" class="img-fluid img-responsive" width="300" height="300">
          <img src="{{ URL::asset('img/logo.svg') }}" class="img-fluid img-responsive" width="250" height="200">
          <h5>Dabble in the Extraordinary</h5>
        </div>
      </div>
    </div>
    <div class="main">
        
        <div class="section section-management" style="margin-top: 20vh">
            <div class="container">
              <div class="rellax squares square-1" data-rellax-percentage="0.5" data-rellax-speed="5" ></div>
              <div class="rellax squares square-2" data-rellax-percentage="0.5" data-rellax-speed="1"></div>
              <div class="rellax squares square-3" data-rellax-percentage="0.5" data-rellax-speed="5"></div>
              <div class="rellax squares square-4" data-rellax-percentage="0.5" data-rellax-speed="2"></div>
              <div class="row row-grid justify-content-between align-items-center">
                <div class="col-lg-6">
                  <h3 class="display-3 text-white">Management Conclave
                    <span class="text-white"></span>
                  </h3>
                  <p class="text-white mb-3">Management Conclave of Xplore’19 will offer a platform that brings together industry leaders, budding entrepreneurs, inspiring personalities, and motivated students to discuss, debate and re-think business and society through motley of competitions & events.</p>
                  <div class="btn-wrapper">
                    <a href="{{ " class="btn btn-info">Show Details</a>
                  </div>
                </div>
                <div class="col-lg-6 mb-lg-auto">
                    <img src="{{ URL::asset('img/management.png') }}" alt="Raised image" class="img-fluid rounded shadow-lg" style="">
                </div>
              </div>
            </div>
        </div>
        
          <div class="section section-cultural" style="margin-top: 20vh">
              <div class="container">
                <div class="rellax squares square-1"  data-rellax-speed="3" ></div>
                <div class="rellax squares square-2"  data-rellax-speed="2"></div>
                <div class="rellax squares square-3"  data-rellax-speed="1"></div>
                <div class="rellax squares square-4"  data-rellax-speed="2"></div>
                <div class="row row-grid justify-content-between align-items-center">
                  <div class="col-lg-6 mb-lg-auto">
                      <img src="{{ URL::asset('img/cultural.jpg') }}" alt="Raised image" class="img-fluid rounded shadow-lg" style="">
                  </div>
                  <div class="col-lg-6">
                    <div class="px-md-5">
                        <h3 class="display-3 text-white">Cultural Fest
                            <span class="text-white"></span>
                          </h3>
                          <p class="text-white mb-3">The Cultural Conclave of Xplore'19 is a cathartic and therapeutic medium to let go of all the inhibitions and set the stage ablaze with immense talent. With a broad spectrum of events, ranging from varied genres like dramatics to literary, sizzling dance competitions to heated sports matches, the conclave offers a perfect blend of arts, sports, and culture. The interesting repertoire of pro-nights and shows, enriched with the presence of gifted artists, serves just right to tantalize everyone.</p>
                          <div class="btn-wrapper">
                            <a href="" class="btn btn-warning">Show Details</a>
                          </div>
                    </div>
                    </div>
                </div>
              </div>
            </div>  
            <section class="section section-lg section-technical">
                <img src="assets/img/path3.png" class="path">
                <div class="container">
                  <div class="row">
                    <div class="col-md-6">
                      <hr class="line-info">
                      <h1>Technical Fest
                        <span class="text-info">Explore the Disruptive Technology</span>
                      </h1>
                    </div>
                  </div>
                  
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="owl-carousel">
                          <div ><div ><img src="{{ asset('img/cultural.jpg') }}" class="img-fluid" ></div></div>
                          <div ><div ><img src="{{ asset('img/cultural.jpg') }}" class="img-fluid" ></div></div>
                          <div ><div ><img src="{{ asset('img/cultural.jpg') }}" class="img-fluid" ></div></div>
                          <div ><div ><img src="{{ asset('img/cultural.jpg') }}" class="img-fluid" ></div></div>
                          <div ><div ><img src="{{ asset('img/cultural.jpg') }}" class="img-fluid" ></div></div>
                        </div>
                    </div>
                </div>
              </section> 
              <section>
                  <div class="flowers-container">
                      <div class="flowers-left"></div>
                      <div class="flowers-right"></div>
                    </div>
              </section> 
              
      <!-- Form Modal -->
      
      <!--  End Modal -->
    </div>
@endsection

