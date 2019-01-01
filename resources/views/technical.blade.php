@extends('layouts.master',['bodyclass' => 'index-page','navbar' => 'navbar-transparent'])

@section('content')
<div class="wrapper">
    <div class="page-header header-filter">
      
      <div class="container">
        <div class="content-center brand" style="width:65%">
                <object data="{{ asset('img/technical.svg') }}" type="image/svg+xml">
                    <img src="{{ asset('img/technical.svg') }}" class="img-fluid img-responsive" >
                  </object>
          
          
        </div>
      </div>
    </div>
    <div class="main">
        
            <section class="section section-lg section-coins">
                    <img src="{{ asset('img/path3.png') }}" class="path">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-4">
                          <hr class="line-info">
                          <h1>Choose the Branch
                            <span class="text-info">that fits your needs</span>
                          </h1>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="card card-coin card-plain">
                            <div class="card-header">
                              <img src="{{ asset('img/cse.svg') }}" class="img-center img-fluid">
                            </div>
                            <div class="card-body">
                              <div class="row">
                                <div class="col-md-12 text-center">
                                  <h4 class="text-uppercase">Computer Science & Engineering</h4>
                                  <hr class="line-primary">
                                </div>
                              </div>
                            </div>
                            <div class="card-footer text-center">
                              <a href=""><button class="skew-button"><span>WORKSHOP</span></button></a>
                              <a href="{{ route('events','cse') }}" class="skew-button"><span>EVENT</span></a>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="card card-coin card-plain">
                            <div class="card-header">
                              <img src="{{ asset('img/civil.svg') }}" class="img-center img-fluid">
                            </div>
                            <div class="card-body">
                              <div class="row">
                                <div class="col-md-12 text-center">
                                  <h4 class="text-uppercase">Civil Engineering</h4>
                                  <hr class="line-success">
                                </div>
                              </div>
                              
                            </div>
                            <div class="card-footer text-center">
                                    <button class="skew-button"><span>WORKSHOP</span></button>
                                    <a href="{{ route('events','ce') }}" class="skew-button"><span>EVENT</span></a>
                            </div>
                          </div>
                        </div>
                        
                      </div>
                      <div style="margin-top:10%">
                            <div class="row">
                                    <div class="col-md-6">
                                            <div class="card card-coin card-plain">
                                              <div class="card-header">
                                                <img src="{{ asset('img/ece.svg') }}" class="img-center img-fluid">
                                              </div>
                                              <div class="card-body">
                                                <div class="row">
                                                  <div class="col-md-12 text-center">
                                                    <h4 class="text-uppercase">Electronics and Communication</h4>
                                                    
                                                    <hr class="line-info">
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="card-footer text-center">
                                                    <button class="skew-button"><span>WORKSHOP</span></button>
                                                    <a href="{{ route('events','ece') }}" class="skew-button"><span>EVENT</span></a>
                                              </div>
                                            </div>
                                    </div>
                                    <div class="col-md-6">
                                            <div class="card card-coin card-plain">
                                              <div class="card-header">
                                                <img src="{{ asset('img/eee.svg') }}" class="img-center img-fluid">
                                              </div>
                                              <div class="card-body">
                                                <div class="row">
                                                  <div class="col-md-12 text-center">
                                                    <h4 class="text-uppercase">Electrical & Electronics</h4>
                                                    
                                                    <hr class="line-info">
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="card-footer text-center">
                                                    <button class="skew-button"><span>WORKSHOP</span></button>
                                                    <a href="{{ route('events','eee') }}" class="skew-button"><span>EVENT</span></a>
                                              </div>
                                            </div>
                                    </div>
                              </div>
                    </div>
                    <div style="margin-top:10%">
                            <div class="row">
                                    <div class="col-md-6 offset-md-3">
                                            <div class="card card-coin card-plain">
                                              <div class="card-header">
                                                <img src="{{ asset('img/me.svg') }}" class="img-center img-fluid">
                                              </div>
                                              <div class="card-body">
                                                <div class="row">
                                                  <div class="col-md-12 text-center">
                                                    <h4 class="text-uppercase">Mechanical Engineering</h4>
                                                    
                                                    <hr class="line-info">
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="card-footer text-center">
                                                    <button class="skew-button"><span>WORKSHOP</span></button>
                                                    <a href="{{ route('events','me') }}" class="skew-button"><span>EVENT</span></a>
                                              </div>
                                            </div>
                                    </div>
                                    
                              </div>
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
          
      <!--  End Modal -->
    </div>
@endsection