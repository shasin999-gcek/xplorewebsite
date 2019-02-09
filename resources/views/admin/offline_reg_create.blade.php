@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Offline Registrations
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li>
                    <i class="fa fa-calender"></i> <a href="{{ route('admin.offline-regs.index') }}">Offline Registrations</a>
                </li>
                <li class="active">
                    <i class="fa fa-calender"></i> Add
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    Add New Registration
                </div>

                <div class="panel-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if ($message = Session::get('failure'))
                        <div class="alert alert-danger">
                            <ul>
                                <li>{{ $message }}</li>
                            </ul>
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('admin.offline-regs.store') }}">
                        {{ csrf_field() }}


                        <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                            <label for="user_id" class="col-md-2 control-label">User</label>

                            <div class="col-md-6">
                                <select id="user_id" class="form-control" name="user_id" required autofocus>
                                    <option value="0" selected>Choose a user</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->email }}</option>
                                    @endforeach    
                                </select>
                                @if ($errors->has('user_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-4" role="tooltip" style="display: block;">
                                    <div class="arrow"></div>
                                    <h3 class="popover-title">User Details</h3>
                                    <div id="user-data" class="popover-content">Refreshing...</div>
                            </div>

                            <div class="col-md-4" style="display: none;">
                               <h5 class="text-danger">Muhammed Shasin</h5>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-2 control-label">Registration for</label>

                            <div class="col-md-6">
                                <select id="type" type="tex" class="form-control" name="type" required autofocus>
                                    <option value="W">Workshop</option>
                                    <option value="E">Event</option>
                                </select>
                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('e_w_id') ? ' has-error' : '' }}">
                            <label for="e_w_id" class="col-md-2 control-label">Name</label>

                            <div class="col-md-6">
                                <select class="form-control" id="e_w_id" name="e_w_id" required>

                                </select>
                                @if ($errors->has('e_w_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('e_w_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                            <label for="category" class="col-md-2 control-label">Category</label>

                            <div class="col-md-6">
                                <select id="category" class="form-control" name="category" required autofocus>
                                    <option value="OFFLINE">OFFLINE</option>
                                    <option value="TEAM">TEAM</option>
                                    <option value="GCEK">GCEK</option>
                                </select>
                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>


        </div>
    </div>
@endsection

@section('scripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
    <script>
        
        var userSelector = document.getElementById('user_id');
        var typeSelector = document.getElementById('type');
        var userDataDiv = document.getElementById('user-data');

        jQuery(document).ready(function () {
            jQuery('#user_id').select2();
            jQuery('#e_w_id').select2();

            getAllWorkshops().then(updateUI);
        });

        typeSelector.onchange = function(event) {
            var type = event.target.value;

            if(type === 'W') {
                getAllWorkshops().then(updateUI);
            } else {
                getAllEvents().then(updateUI);
            }
        }
      
        userSelector.onchange = function(event) {
            var user_id = event.target.value;
            showRefreshingMsg();
            getUserInfo(user_id).then(updateUserData);
        }

        function getAllEvents() {
            return axios.get(window.location.origin + '/api/allevents')
                    .catch(handleError);
        }

        function getAllWorkshops() {
            return axios.get(window.location.origin + '/api/allworkshops')
                    .catch(handleError);
        }

        function getUserInfo(id) {
            return axios.get(window.location.origin + `/api/getUserById?id=${id}`)
                    .catch(handleError);
        }

        function updateUI({ data }) {
            var listEventSelect = document.getElementById('e_w_id');
            listEventSelect.innerHTML = '';
            data.map(function(each) {
                var optionTag = document.createElement('option');
                optionTag.value = each.id;
                optionTag.textContent = each.name;
                listEventSelect.appendChild(optionTag);                
            });
        }

        function handleError(error) {
            console.log(error);
        }

        function updateUserData({ data }) {
            userDataDiv.innerHTML = 
                `<strong>${data.name} - <span class="text-primary">${data.mobile_number}</span></strong>`;
        }

        function showRefreshingMsg() {
            userDataDiv.innerHTML = '<span class="text-danger">Refreshing....<span>';
        }

    </script>
@endsection