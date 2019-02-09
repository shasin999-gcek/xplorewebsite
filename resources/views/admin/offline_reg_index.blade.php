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
                <li class="active">
                    <i class="fa fa-calender"></i>  Offline Registrations
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            RS
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $e_amount->total ? $e_amount->total : 0 }}</div>
                            <div>Event Amount</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                           RS
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $w_amount->total ? $w_amount->total : 0 }}</div>
                            <div>Workshop Amount</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                        <i class="fa fa-university fa-5x" aria-hidden="true"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $gcek_count }}</div>
                            <div>Total GCEKians</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    Offline Event Registrations
                    <span class="pull-right">
                        <a href="{{ route('admin.offline-regs.create') }}" class="btn btn-xs btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Register
                        </a>
                    </span>
                </div>

                <div class="panel-body">
                    <table id="example" class="table table-bordered" width="100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Event/Workshop Name</th>
                            <th>Order ID</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($offlineERegs as $r)
                                <tr>
                                    <td>{{ $r->user->name }}</td>
                                    <td>{{ $r->event->name }}</td>
                                    <td>{{ $r->order_id }}</td>
                                    @if($r->type == 'GCEK')
                                        <td class="bg-danger text-center"><b>{{ $r->type }}</b></td>
                                    @endif 
                                    @if($r->type == 'OFFLINE')
                                        <td class="bg-success text-center"><b>{{ $r->type }}</b></td>
                                    @endif
                                    @if($r->type == 'TEAM')
                                        <td class="bg-info text-center"><b>{{ $r->type }}</b></td>
                                    @endif   
                                    <td class="text-center">
                                        <button class="btn btn-block btn-danger" onclick="event.preventDefault(); confirmAndDelete('delete_reg_{{$r->order_id}}')"><i class="fa fa-trash"></i> Delete</button>
                                        <form id="delete_reg_{{ $r->order_id }}" action="{{ route('admin.offline-regs.destroy', $r->order_id) }}" method="POST" style="display: none;">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                        </form> 
                                    </td>
                                </tr>
                            @endforeach

                            @foreach($offlineWRegs as $r)
                                <tr>
                                    <td>{{ $r->user->name }}</td>
                                    <td>{{ $r->workshop->name }}</td>
                                    <td>{{ $r->order_id }}</td>
                                    @if($r->type == 'GCEK')
                                        <td class="bg-danger text-center"><b>{{ $r->type }}</b></td>
                                    @endif 
                                    @if($r->type == 'OFFLINE')
                                        <td class="bg-success text-center"><b>{{ $r->type }}</b></td>
                                    @endif
                                    @if($r->type == 'TEAM')
                                        <td class="bg-info text-center"><b>{{ $r->type }}</b></td>
                                    @endif 
                                    <td class="text-center">
                                        <button class="btn btn-block btn-danger" onclick="event.preventDefault(); confirmAndDelete('delete_reg_{{$r->order_id}}')"><i class="fa fa-trash"></i> Delete</button>
                                        <form id="delete_reg_{{ $r->order_id }}" action="{{ route('admin.offline-regs.destroy', $r->order_id) }}" method="POST" style="display: none;">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                        </form> 
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Event/Workshop Name</th>
                            <th>Order ID</th>
                            <th>Type</th>
                            <th>Action</th>
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
        function confirmAndDelete(formId) {
            if(confirm('Are you sure you want to delete this ..?')) {
                document.getElementById(formId).submit();
            }
        }

        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endsection