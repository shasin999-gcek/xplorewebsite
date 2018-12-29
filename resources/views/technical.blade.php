@extends('layouts.master')

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
                              <img src="{{ asset('img/CSE.svg') }}" class="img-center img-fluid">
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
                              <button class="skew-button"><span>WORKSHOP</span></button>
                              <button class="skew-button"><span>EVENT</span></button>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="card card-coin card-plain">
                            <div class="card-header">
                              <img src="{{ asset('img/CE.svg') }}" class="img-center img-fluid">
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
                                    <button class="skew-button"><span>EVENT</span></button>
                            </div>
                          </div>
                        </div>
                        
                      </div>
                      <div style="margin-top:10%">
                            <div class="row">
                                    <div class="col-md-6">
                                            <div class="card card-coin card-plain">
                                              <div class="card-header">
                                                <img src="{{ asset('img/ECE.svg') }}" class="img-center img-fluid">
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
                                                    <button class="skew-button"><span>EVENT</span></button>
                                              </div>
                                            </div>
                                    </div>
                                    <div class="col-md-6">
                                            <div class="card card-coin card-plain">
                                              <div class="card-header">
                                                <img src="{{ asset('img/EEE.svg') }}" class="img-center img-fluid">
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
                                                    <button class="skew-button"><span>EVENT</span></button>
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