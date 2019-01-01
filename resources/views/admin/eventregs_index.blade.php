@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Events
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-calender"></i> Event Registrations
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    Event Registrations
                </div>

                <div class="panel-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%;">
                        <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Event Name</th>
                            <th>Order Id</th>
                            <th>Reg Date</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($event_regs as $reg)
                                <tr>
                                    <td>{{ $reg->user->name }}</td>
                                    <td>{{ $reg->event->name }}</td>
                                    <td>{{ $reg->order_id }}</td>
                                    <td>{{ $reg->created_at->toDayDateTimeString() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>User Name</th>
                            <th>Event Name</th>
                            <th>Order Id</th>
                            <th>Reg Date</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

            </div>


        </div>
    </div>

    <div id="alert_modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-facebook-official" aria-hidden="true"></i> Error in Sharing</h4>
                </div>
                <div id="error_from_faceboook" class="modal-body">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@endsection