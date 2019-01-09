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
                @if ($errors->has('password'))
                    <div class="alert alert-danger alert-with-icon">
                        
                        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="tim-icons icon-simple-remove"></i>
                        </button>
                        
                        <span><b> Error! - </b> {{ $errors->first(password') }}</span>
                    </div>
                @endif
                @if ($errors->has('password_confirmation'))
                    <div class="alert alert-danger alert-with-icon">
                        
                        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="tim-icons icon-simple-remove"></i>
                        </button>
                        
                        <span><b> Error! - </b> {{ $errors->first('password_confirmation') }}</span>
                    </div>
                @endif
               
              
              <div class="card card-register">
                <div class="card-header">
                  <img class="card-img" src="{{ asset('img/square1.png') }}" alt="Card image">
                  <h4 class="card-title">Reset</h4>
                </div>
                <div class="card-body">
                  <form class="form" method="POST" action="{{ route('password.request') }}">
                  {{ csrf_field() }}

                  <input type="hidden" name="token" value="{{ $token }}">
                    <div class="input-group {{ $errors->has('email') ? ' has-error' : '' }}">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="tim-icons icon-email-85"></i>
                        </div>
                      </div>
                      <input type="email" placeholder="Email" class="form-control" name="email" value="{{ $email or old('email') }}"
required autofocus>
                    </div>
                    <div class="input-group {{ $errors->has('password') ? ' has-error' : '' }}">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="tim-icons icon-lock-circle"></i>
                        </div>
                      </div>
                      <input id="password" type="password" class="form-control" name="password" required>
                    </div>
                    <div class="input-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="tim-icons icon-lock-circle"></i>
                        </div>
                      </div>
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                    </div>
                </div>
                <div class="card-footer text-center">
                  <button  type="submit" class="btn btn-info btn-round btn-lg">Reset Password</button>
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