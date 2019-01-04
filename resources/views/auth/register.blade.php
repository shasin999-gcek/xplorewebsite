@extends('layouts.master',['bodyclass' => 'register-page','active_menu' => 'login' ,'navbar' => ' '])
@section('content')
<div class="wrapper">
    <div class="page-header">
      <div class="page-header-image"></div>
      <div class="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-5 col-md-6 offset-lg-0 offset-md-3">
              <div id="square7" class="square square-7"></div>
              <div id="square8" class="square square-8"></div>

              @if ($errors->has('name'))
                            <div class="alert alert-danger alert-with-icon">
                                <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="tim-icons icon-simple-remove"></i>
                                </button>
                                
                                <span><b> Error! - </b> {{ $errors->first('name') }} </span>
                            </div>
                                @endif
                 @if ($errors->has('email'))
                                    
                @endif
                @if ($errors->has('mobile_number'))
                <div class="alert alert-danger alert-with-icon">
                                <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="tim-icons icon-simple-remove"></i>
                                </button>
                                
                                <span><b> Error! - </b> {{ $errors->first('mobile_number') }} </span>
                            </div>
                                @endif
                @if ($errors->has('password'))
                <div class="alert alert-danger alert-with-icon">
                                <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="tim-icons icon-simple-remove"></i>
                                </button>
                                
                                <span><b> Error! - </b> {{ $errors->first('password') }} </span>
                            </div>
                                @endif    
                                @if ($errors->has('email'))
                <div class="alert alert-danger alert-with-icon">
                                <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="tim-icons icon-simple-remove"></i>
                                </button>
                                
                                <span><b> Error! - </b> {{ $errors->first('email') }} </span>
                            </div>
                                @endif            
              
              <div class="card card-register">
                <div class="card-header">
                  <img class="card-img" src="{{ asset('img/square1.png') }}" alt="Card image">
                  <h4 class="card-title">Register</h4>
                </div>
                <div class="card-body">
                  <form class="form" method="POST" action="{{ route('register') }}">
                  {{ csrf_field() }}
                  <div class="input-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="tim-icons icon-single-02"></i>
                      </div>
                    </div>
                    <input id="name" type="text" class="form-control" name="name" placeholder="Full Name" value="{{ old('name') }}" required autofocus>
                  </div>
                  <div class="input-group {{ $errors->has('mobile_number') ? ' has-error' : '' }}">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="tim-icons icon-mobile"></i>
                      </div>
                    </div>
                    <input id="mobile_number" type="text" class="form-control" name="mobile_number" placeholder="Mobile Number" value="{{ old('mobile_number') }}" required>
                  </div>
                  <div class="input-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="tim-icons icon-email-85"></i>
                      </div>
                    </div>
                    <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>
                  </div>
                  <div class="input-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="tim-icons icon-lock-circle"></i>
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                  </div>
                  <div class="input-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="tim-icons icon-lock-circle"></i>
                      </div>
                    </div>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                  </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-info btn-round btn-lg">Register</button>
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
  @endsection