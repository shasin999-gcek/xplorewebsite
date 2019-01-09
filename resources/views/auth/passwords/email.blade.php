@extends('layouts.master',['bodyclass' => 'register-page','active_menu' => 'login' ,'navbar' => ' fixed-top'])

@section('content')
<div class="wrapper">
    <div class="page-header">
      <div class="page-header-image"></div>
      <div class="content">
        <div class="container">
          <div class="row">
            
            <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4" >
              <div id="square7" class="square square-7"></div>
              <div id="square8" class="square square-8"></div>
              @if ($errors->has('email'))
                    <div class="alert alert-danger alert-with-icon">
                        
                        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="tim-icons icon-simple-remove"></i>
                        </button>
                        
                        <span><b> Error! - </b> {{ $errors->first('email') }}</span>
                    </div>
                @endif
               
              
              <div class="card card-register">
                <div class="card-header">
                  <img class="card-img" src="{{ asset('img/square1.png') }}" alt="Card image">
                  <h4 class="card-title">Reset</h4>
                </div>
                <div class="card-body">
                  <form class="form" method="POST" action="{{ route('password.email') }}">
                  {{ csrf_field() }}
                    <div class="input-group {{ $errors->has('email') ? ' has-error' : '' }}">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="tim-icons icon-email-85"></i>
                        </div>
                      </div>
                      <input type="email" placeholder="Email" class="form-control" name="email">
                    </div>
                </div>
                <div class="card-footer text-center">
                  <button  type="submit" class="btn btn-info btn-round btn-lg">Send Password Link</button>
                </div>
                </form>
              </div>
            </div>
          </div>
          <div id="square1" class="square square-1"></div>
         
          
        </div>
      </div>
    </div>
     <section>
                  <div class="flowers-container">
                      <div class="flowers-left"></div>
                      <div class="flowers-right"></div>
                    </div>
              </section> 



@endsection