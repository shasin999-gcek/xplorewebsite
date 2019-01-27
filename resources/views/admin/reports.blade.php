@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Registration Reports
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-calender"></i> Reports
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info">
               Download Event/Workshop registration reports as xlsx, csv or ods format
            </div>
            <div class="panel panel-info">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    Generate Reports
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

                    <form class="form-horizontal" method="GET" action="{{ route('admin.report.download') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-2 control-label">Report for</label>

                            <div class="col-md-6">
                                <select id="type" type="tex" class="form-control" name="type" required autofocus>
                                    <option value="workshop">Workshop</option>
                                    <option value="event">Event</option>
                                </select>
                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                            <label for="id" class="col-md-2 control-label">Event/Workshop</label>

                            <div class="col-md-6">
                                <select class="form-control" id="id" name="id" required>

                                </select>
                                @if ($errors->has('id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('format') ? ' has-error' : '' }}">
                            <label for="format" class="col-md-2 control-label">Export as</label>

                            <div class="col-md-6">
                                <select class="form-control" name="format" id="format">
                                    <option value="xlsx">Excel Sheet</option>
                                    <option value="csv">CSV</option>
                                    <option value="ods">Ubuntu ODS</option>
                                </select>

                                @if ($errors->has('format'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('format') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    Download
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
            var listEventSelect = document.getElementById('id');
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
            jQuery('#id').select2();
            jQuery('#format').select2();
            getAllWorkshops().then(updateUI);
        });

        var typeSelector = document.getElementById('type');
    
        typeSelector.onchange = function(event) {
            var type = event.target.value;

            if(type === 'workshop') {
                getAllWorkshops().then(updateUI);
            } else {
                getAllEvents().then(updateUI);
            }
        }
    </script>
@endsection