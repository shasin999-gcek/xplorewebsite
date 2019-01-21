@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Banners
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li>
                    <i class="fa fa-calender"></i> <a href="{{ route('admin.banners.index') }}">Banners</a>
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
                    Add New Banner
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

                    <form class="form-horizontal" method="POST" action="{{ route('admin.banners.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-2 control-label">Banner for</label>

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


                        <div class="form-group{{ $errors->has('banner_image') ? ' has-error' : '' }}">
                            <label for="banner_image" class="col-md-2 control-label">Upload Banner</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control" id="banner_image" name="banner_image" required>

                                @if ($errors->has('banner_image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('banner_image') }}</strong>
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

        function getAllEvents() {
            return axios.get(window.location.origin + '/api/allevents')
                    .catch(handleError);
        }

        function getAllWorkshops() {
            return axios.get(window.location.origin + '/api/allworkshops')
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

        jQuery(document).ready(function () {
            jQuery('#e_w_id').select2();
            getAllWorkshops().then(updateUI);
        });

        var typeSelector = document.getElementById('type');
    
        typeSelector.onchange = function(event) {
            var type = event.target.value;

            if(type === 'W') {
                getAllWorkshops().then(updateUI);
            } else {
                getAllEvents().then(updateUI);
            }
        }
    </script>
@endsection