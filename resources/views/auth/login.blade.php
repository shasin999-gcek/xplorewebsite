@extends('layouts.master',['bodyclass' => 'register-page','active_menu' => 'login' ,'navbar' => ' fixed-top'])

@section('content')
<div class="wrapper">
    <div class="page-header">
      <div class="page-header-image"></div>
      <div class="content">
        <div class="container">
          <div class="row">
            
            <div class="col-lg-5 col-md-6 offset-lg-6 offset-md-3" >
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
                        
                        <span><b> Error! - </b> {{ $errors->first('password') }}</span>
                    </div>
                @endif
              
              <div class="card card-register">
                <div class="card-header">
                  <img class="card-img" src="{{ asset('img/square1.png') }}" alt="Card image">
                  <h4 class="card-title">Login</h4>
                </div>
                <div class="card-body">
                  <form class="form" method="POST" action="{{ route('login') }}">
                  {{ csrf_field() }}
                    <div class="input-group {{ $errors->has('email') ? ' has-error' : '' }}">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="tim-icons icon-email-85"></i>
                        </div>
                      </div>
                      <input type="email" placeholder="Email" class="form-control" name="email">
                    </div>
                    <div class="input-group {{ $errors->has('password') ? ' has-error' : '' }}">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="tim-icons icon-lock-circle"></i>
                        </div>
                      </div>
                      <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                    <div class="form-check text-left">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                        <span class="form-check-sign"></span>
                        Remember me
                      </label>
                    </div>
                  
                </div>
                <div class="card-footer">
                  <button  type="submit" class="btn btn-info btn-round btn-lg">Login</button>
                  <a class="btn btn-danger btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                 </a><br>
                  <h5 style="text-align:center">Not a user? <a class="btn btn-info btn-link" href="{{ route('register') }}">Register Now</a></h5>
                  
                </div>
                </form>
              </div>
            </div>
          </div>
          <div id="square1" class="square square-1"></div>
          <div id="square2" class="square square-2"></div>
          <div id="square3" class="square square-3"></div>
          
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
