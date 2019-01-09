@extends('layouts.master',['bodyclass' => 'index-page bkg-yellow','active_menu' => 'login','navbar' => ' bkg-yellow'])


@section('content')
<div class="wrapper">
        <img src="{{ asset('/img/dots.png')}}" class="dots">
        
    <div class="container">
      <div class="row">
        <div class="col-md-4 ml-auto mr-auto">
          <div class="card card-plain" style="margin-top: 30%">
            <div class="card-header text-center">
              <img class="img-center img-fluid rounded-circle" src="{{ asset('img/user.png') }}" width="150" height="150" />
                <h4 class="title" style="text-align: center;">{{ $currentUser->name }}</h4>
            </div>
            <div class="card-body text-center">
              <h5>{{ $currentUser->email }}</h5>
              
              <h5>{{ $currentUser->mobile_number }}</h5>
              
            </div>
            <div class="card-footer text-center">
            
            <button id="refid" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Copy" data-container="body" data-animation="true" data-original-title="Copy" onclick="event.preventDefault(); copyRefToClipboard('{{ url('?ref_code=').Auth::user()->referral_id }}');">Invite Friends</button> <br><br>

            <a href="whatsapp://send" data-text="Are you ready to breathe in the excitement to Xplore the Unexplored?
Then tune into Xplore'19, The 5th National Techno Management Cultural Festival of Govt. College of Engineering Kannur from February 22nd - 24th 2019!

Dabble in the extraordinary!

" data-href="{{ url('?ref_code=').Auth::user()->referral_id }}" class="wa_btn wa_btn_l" style="display:none">Share</a>

            </div>
          </div>
        </div>
        <div class="col-md-8 ml-auto mr-auto pt-4">
          <section class="section section-lg " style="padding: 0;">
            <div class="container">
              <div class="row">
                <div class="col-md-9">
                 
                  <hr class="line-info">
                  <h1>Registered <span>Events</span> and <span>Workshop</span></h1>
                </div>
              </div>
            </div>
            <div class="container">
              <div class="row">
                @if($registered_events->count() > 0)
                @foreach($registered_events as $e)
                <div class="col-md-4">
                  <div class="card card-plain">
                    <div class="card-header">
                      <img class="card-img" src="{{ asset('storage/' . $e->thumbnail_image) }}">
                    </div>
                    <div class="card-body">
                      <h3>{{ $e->name }}</h3>
                      <h4>RegId: <kbd>{{ $e->pivot->order_id }}</kbd></h4>
                    </div>
                  </div>
                </div>
                @endforeach
                @else
                  <h3 class="text-center">No events and workshops registered</h3>
                @endif
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
    <div class="section section-event-workshop">
      <div class="container">
        <div class="row">
          <div class="col-md-6 mr-auto ml-auto">
              <hr class="line-info">
              <h2>Workshops</span></h2>
              <div class="table-responsive-sm">
                    <table class="table">
                    <thead>
                        <tr>
                        
                            <th>Name</th>
                            <th>Type</th>
                            <th>Branch</th>
                            <th class="text-right">Register Fees</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            
                            <td>John Doe</td>
                            <td>Design</td>
                            <td>2012</td>
                            <td class="text-right">&euro; 89,241</td>
                            <td class="td-actions text-right">
                              <button type="button" rel="tooltip" class="btn btn-info btn-sm btn-round btn-icon">
                                  <i class="tim-icons icon-settings-gear-63"></i>
                              </button>
                            
                              
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
              </div>
              
          </div>
          <div class="col-md-6 mr-auto ml-auto">
              <hr class="line-info">
              <h2>Events</span></h2>
              <div class="table-responsive-sm">
                    <table class="table">
                      <thead>
                          <tr>
                              <th class="text-center">#</th>
                              <th>Name</th>
                              <th>Type</th>
                              <th>Branch</th>
                              <th class="text-right">Register Fees</th>
                              <th class="text-right">Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                          
                          <tr>
                              <td class="text-center">2</td>
                              <td>John Doe</td>
                              <td>Design</td>
                              <td>2012</td>
                              <td class="text-right">&euro; 89,241</td>
                              <td class="td-actions text-right">
                                
                                <button type="button" rel="tooltip" class="btn btn-success btn-sm btn-round btn-icon">
                                    <i class="tim-icons icon-settings-gear-63"></i>
                                </button>
                                
                              </td>
                          </tr>
                          
                      </tbody>
                  </table>
              </div>
          </div>
        </div>
      </div>
    </div>
    
@endsection