@extends('layouts.master',['bodyclass' => 'index-page','active_menu' => 'login','navbar' => ' '])


@section('content')
<div class="wrapper">
        <img src="{{ asset('/img/dots.png')}}" class="dots">
        
    <div class="container">
      <div class="row">
        <div class="col-md-4 ml-auto mr-auto">
          <div class="card card-plain" style="margin-top: 30%">
              @if($is_college_empty)
                  <div class="alert alert-info alert-with-icon">
                      <span>Please update your college name, Inorder to download certificates</span>
                  </div>
              @endif
            <div class="card-header text-center">
              <img class="img-center img-fluid rounded-circle" src="{{ asset('img/user.png') }}" width="150" height="150" />
                <h4 class="title" style="text-align: center;">{{ $currentUser->name }}</h4>
            </div>
            <div class="card-body text-center">
              <h5>{{ $currentUser->email }}</h5>
              
              <h5>{{ $currentUser->mobile_number }}</h5>
              
            </div>
            <div class="card-footer text-center" id="college_update_area">
                @if($errors->has('college_name'))
                    <div class="alert alert-danger alert-with-icon">

                        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="tim-icons icon-simple-remove"></i>
                        </button>

                        <span><b> Error! - </b> {{ $errors->first('college_name') }}</span>
                    </div>
                @endif
                    @if(session('success'))
                        <div class="alert alert-success alert-with-icon">

                            <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="tim-icons icon-simple-remove"></i>
                            </button>

                            <span>{{ session('success') }}</span>
                        </div>
                    @endif
                <form action="{{ route('user.addcollege') }}" method="post">
                    {{ csrf_field() }}
                    <div class="input-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="text" name="college_name" class="form-control" placeholder="Enter College Name" value="{{ old('college_name', $currentUser->college_name) }}" />
                    </div>
                    <div>
                        <button class="btn btn-info btn-round btn-lg">Save</button>
                    </div>
                </form>
            {{--<button id="refid" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Copy" data-container="body" data-animation="true" data-original-title="Copy" onclick="event.preventDefault(); copyRefToClipboard('{{ url('?ref_code=').Auth::user()->referral_id }}');">Invite Friends</button><br>--}}
            {{--<small>Copy referral link and share to friends</small><br>--}}
            {{--<a href="whatsapp://send" data-text="Are you ready to breathe in the excitement to Xplore the Unexplored?--}}
{{--Then tune into Xplore'19, The 5th National Techno Management Cultural Festival of Govt. College of Engineering Kannur from February 22nd - 24th 2019!--}}

{{--Dabble in the extraordinary!--}}

{{--" data-href="{{ secure_url('/').'/?ref_code='.Auth::user()->referral_id }}" class="wa_btn wa_btn_l" style="display:none">Share</a>--}}
            {{--<br><small>For any queries related to Payment , Please Contact Web admin - +918129151079</small>--}}

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
                @if($registered_events->count() > 0 || $registered_workshops->count() > 0)
                @foreach($registered_events as $e)
                <div class="col-md-4">
                  <div class="card card-plain">
                    <div class="card-header">
                      <img class="card-img" src="{{ asset('storage/' . $e->thumbnail_image) }}">
                    </div>
                    <div class="card-body">
                      <h3>{{ $e->name }}</h3>
                        <a class="btn btn-info" href="{{ route('event.certificate', $e->pivot->order_id) }}" @if($is_college_empty) disabled="" @endif>Download Certificate</a>
                    </div>
                  </div>
                </div>
                @endforeach
                @foreach($registered_workshops as $w)
                    <div class="col-md-4">
                        <div class="card card-plain">
                            <div class="card-header">
                                <img class="card-img" src="{{ asset('storage/' . $w->thumbnail_image) }}">
                            </div>
                            <div class="card-body">
                                <h3>{{ $w->name }}</h3>
                                <a class="btn btn-info" href="{{ route('workshop.certificate', $w->pivot->order_id) }}" @if($is_college_empty) disabled="" @endif>Download Certificate</a>
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
              <h2>Events</h2>
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


                        @foreach($events as $event)
                            <tr>
                                <td>{{ $event->name }}</td>
                                <td>{{ $event->type }}</td>
                                <td>{{ $event->category->name }}</td>
                                <td class="text-right">{{ $event->reg_fee }}</td>
                                <td class="td-actions text-right">
                                  <a href="{{ route('display_event', ['category' => $event->category->short_name, 'slug' => $event->slug]) }}" rel="tooltip" class="btn btn-info btn-sm btn-round btn-icon">
                                      <i class="tim-icons icon-simple-add"></i>
                                  </a>
                                </td>
                            </tr>
                        @endforeach


                        
                    </tbody>
                </table>
              </div>
              
          </div>
          <div class="col-md-6 mr-auto ml-auto">
              <hr class="line-info">
              <h2>Workshops</h2>
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
                         
                          @foreach($workshops as $w)
                              <tr>
                                  <td>{{ $w->name }}</td>
                                  <td>{{ $w->type }}</td>
                                  <td>{{ $w->category->name }}</td>
                                  <td class="text-right">{{ $w->reg_fee }}</td>
                                  <td class="td-actions text-right">
                                      <a href="{{ route('display_workshop', ['category' => $w->category->short_name, 'slug' => $w->slug]) }}" rel="tooltip" class="btn btn-info btn-sm btn-round btn-icon">
                                          <i class="tim-icons icon-simple-add"></i>
                                      </a>
                                  </td>
                              </tr>
                          @endforeach
                          
                      </tbody>
                  </table>
              </div>
          </div>
        </div>
      </div>
    </div>
   </div>
@endsection