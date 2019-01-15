@extends('layouts.master',['bodyclass' => 'profile-page','navbar' => 'navbar-transparent fixed-top'])

@section('content')

<div class="wrapper">
<div class="page-header">
          <img src="{{ asset('img/dots.png') }}" class="dots">
          <img src="{{ asset('img/path4.png')}}" class="path">
          <div class="container align-items-center">
            <div class="row">
              <div class="col-lg-6 col-md-6">
                <h1 class="profile-title text-left">About Xplore'19</h1>
                <h5 class="text-on-back">01</h5>
                <p class="profile-description">Xplore’19 bears the agenda “The Conflation of Sustainable and Pioneering Technology to beget an Empowered Society”. 
                        Xplore envisions itself to become one of the largest techno-management cultural festival in India by attracting the most prominent and diverse voices from various facets of the society to collaborate and integrate innovation.
                        Xplore promises a host of conclaves, competitions and workshops centered around various interdisciplinary themes enriching  the experience of innovation, competition and learning.</p>                
              </div>
              <div class="col-lg-4 col-md-6 ml-auto mr-auto ">
                <div class="content-center brand no-mob" style="width:100%">
                        <img src="{{ asset('img/Xplore.svg')}}" class="img-fluid img-responsive" width="300" height="300">
                        <img src="{{ asset('img/logo.svg') }}" class="img-fluid img-responsive" width="250" height="200">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="section">
                <div class="container">
                        <div class="row justify-content-between">
                          <div class="col-md-6">
                            <div class="row justify-content-between align-items-center">
                                <div class="content-center brand no-mob" style="width:100%">
                                    <img src="{{ asset('img/clg.png')}}" class="img-fluid img-responsive" width="300" height="300">
                                </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <h1 class="profile-title text-left">About GCEK</h1>
                            <h5 class="text-on-back">02</h5>
                            <p class="profile-description text-left">Established in 1986, Government College of Engineering Kannur is one of the Elite Institutes owned by the Government of Kerala. The College is functioning in a sprawling 68-acre scenic campus, having sound and self-sufficient infrastructure, at Mangattuparamba, near the National Highway, 15 k.m from the headquarters of Kannur district. It offers Bachelors, Masters & Doctoral Programmes in the field of engineering education and research. The institute is recognized by Kerala Technological University as a ‘Centre of Excellence in Systems, Energy & Environment’ and it is also approved as a Technology Business Incubation Centre under the MSME (Ministry of Small and Medium Enterprises, Govt. of India). Research works are being carried out in collaboration with Delft University, The Netherlands, to display the cutting edge technologies from all over the globe. Over the years, the institute has created its own niche in the society through its achievements in Engineering & Research.</p>
                            <div class="btn-wrapper pt-3">
                              <a href="https://gcek.ac.in" class="btn btn-simple btn-primary">
                                <i class="tim-icons icon-book-bookmark"></i> Visit Website
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
        </div>
        <section>
                
        </section>
