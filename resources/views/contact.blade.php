@extends('layouts.master',['bodyclass' => 'index-page','navbar' => ' ', 'nofooter' => ' '])

@section('content')
<div class="wrapper">
    <div class="section section-tabs">
        <div class="container">        
          <div class="row">
            <div class="col-md-10 ml-auto col-xl-4 mr-auto">
              <!-- Nav tabs -->
              <div class="card">
                <div class="card-header">
                  <h3 class="h3-contact">Aswin Divakar</h3>
                  <small class="text-uppercase font-weight-bold">General Convenor</small>
                </div>
                <div class="card-body">
                  <h5>Phone : +919846435358</h5>
                  <h5>Email : aswindivakar100@gmail.com</h5>
               
                </div>
              </div>
            </div>
            <div class="col-md-10 ml-auto col-xl-4 mr-auto">
              
              <!-- Tabs with Background on Card -->
              <div class="card">
                <div class="card-header">
                <h3 class="h3-contact">Dr. Manoj Kumar M V</h3>
                <small class="text-uppercase font-weight-bold">Chairman : Programme Committee</small>
                </div>
                <div class="card-body">
                  <!-- Tab panes -->
                  <h5>Phone : 9744430507</h5>
                  <h5>Email : yemvoe1975@gmail.com</h5>
                </div>
              </div>
              <!-- End Tabs on plain Card -->
            </div>
            <div class="col-md-10 ml-auto col-xl-4 mr-auto">
              <!-- Nav tabs -->
              <div class="card">
                <div class="card-header">
                  <h3 class="h3-contact">Vishnu KM</h3>
                  <small class="text-uppercase font-weight-bold">Convenor : Programme Committee</small>
                </div>
                <div class="card-body">
                  <!-- Tab panes -->
                  <h5>Phone : 7560904236</h5>
                  <h5>Email : kmvishnumanyeri@gmail.com</h5>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-10 ml-auto col-xl-4 mr-auto">
              <!-- Nav tabs -->
              <div class="card">
                <div class="card-header">
                <h3 class="h3-contact">Prof. Anil kumar S S</h3>
                <small class="text-uppercase font-weight-bold">Chairman : Finance And Sponsorship Committee</small>
                </div>
                <div class="card-body">
                  <!-- Tab panes -->
                  <h5>Phone : 9446556231</h5>
                  <h5>Email : saak@live.com</h5>
                </div>
              </div>
            </div>
            <div class="col-md-10 ml-auto col-xl-4 mr-auto">
              
              <!-- Tabs with Background on Card -->
              <div class="card">
                <div class="card-header">
                <h3 class="h3-contact">Arfad</h3>
                <small class="text-uppercase font-weight-bold">Convener : Management Events</small>
                </div>
                <div class="card-body">
                  <!-- Tab panes -->
                  <h5>Phone : .+919995004654</h5>
                  <h5>Email : Arfu999.ak@gmail.com</h5>
                </div>
              </div>
              <!-- End Tabs on plain Card -->
            </div>
            <div class="col-md-10 ml-auto col-xl-4 mr-auto">
              <!-- Nav tabs -->
              <div class="card">
                <div class="card-header">
                <h3 class="h3-contact">Aswin K Ramesh</h3>
                <small class="text-uppercase font-weight-bold">Convenor : Sponsorship Committee</small>
                </div>
                <div class="card-body">
                  <!-- Tab panes -->
                  <h5>Phone : .+919446441455</h5>
                  <h5>Email : aswinkrc@gmail.com</h5>
                  
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-10 ml-auto col-xl-4 mr-auto">
              <div class="card">
                <div class="card-header">
                <h3 class="h3-contact">Prof. Ashokan O V</h3>
                <small class="text-uppercase font-weight-bold">Chairman : Public Relations & Advisory</small>
                </div>
                <div class="card-body">  
                    <h5>Phone : 9496291352</h5>
                    <h5>Email : asokan.ov@rediffmail.com</h5>
                </div>
              </div>
            </div>
            <div class="col-md-10 ml-auto col-xl-4 mr-auto">
              
              <!-- Tabs with Background on Card -->
              <div class="card">
                <div class="card-header">
                <h3 class="h3-contact">Atthri Anand</h3>
                <small class="text-uppercase font-weight-bold">Convenor : Public Relations & Advisory</small>
                </div>
                <div class="card-body">
                  <!-- Tab panes -->
                  <h5>Phone : +919895386159</h5>
                  <h5>Email : atthri.anand@gmail.com</h5>
                </div>
              </div>
              <!-- End Tabs on plain Card -->
            </div>
            <div class="col-md-10 ml-auto col-xl-4 mr-auto">
              <!-- Nav tabs -->
              <div class="card">
                <div class="card-header">
                <h3 class="h3-contact">Sreehari C</h3>
                <small class="text-uppercase font-weight-bold">Covenor : Technical Events committee</small>
                </div>
                <div class="card-body">
                  <!-- Tab panes -->
                  <h5>Phone : +918943540470</h5>
                  <h5>Email : sreeharicrj369@gmail.com</h5>
                  
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-10 ml-auto col-xl-4 mr-auto">
              <div class="card">
                <div class="card-header">
                <h3 class="h3-contact">Prathuish Prem</h3>
                <small class="text-uppercase font-weight-bold">Convenor : Cutural Events Committee</small>
                </div>
                <div class="card-body">  
                    <h5>Phone : .+917560877004</h5>
                    <h5>Email : prathuishprem97@gmail.com</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <section class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-plain">
              <div class="card-header">
                <h1 class="profile-title text-left">Contact</h1>
              </div>
              <div class="card-body">
                @if (session('status'))
                  <div class="alert alert-success">
                    {{ session('status') }}
                  </div>
                @endif
                <form method="post" action="{{ route('contact-admin') }}">
                  {{ csrf_field() }}
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name">Your Name</label>
                          <input id="name" name="name" type="text" class="form-control" value="{{ old('name') }}" required>
                          @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                          @endif
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                          <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label for="phone">Phone</label>
                        <input type="number" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                        @if ($errors->has('phone'))
                          <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                        <label for="subject">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject') }}" required>
                        @if ($errors->has('subject'))
                          <span class="help-block">
                                <strong>{{ $errors->first('subject') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                        <label for="message">Message</label>
                        <input type="text" class="form-control" placeholder="Hello there!" id="message" name="message" value="{{ old('message') }}" required>
                        @if ($errors->has('message'))
                          <span class="help-block">
                                <strong>{{ $errors->first('message') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary btn-round float-right" rel="tooltip" data-original-title="Can't wait for your message" data-placement="right">Send text</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>   
@endsection