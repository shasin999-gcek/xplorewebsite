@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Workshop Registration
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-cog"></i> Workshop Registrations
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-success">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    Workshop Registrations Trends
                </div>

                <div class="panel-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%;">
                        <thead>
                        <tr>
                            <th>Workshop Name</th>
                            <th>Reg Count</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($workshop_stats as $stat)
                            <tr>
                                <td>{{ $stat->name }}</td>
                                <td>{{ $stat->count }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Workshop Name</th>
                            <th>Reg Count</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>

            </div>


        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    Workshop Registrations
                </div>

                <div class="panel-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%;">
                        <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Workshop Name</th>
                            <th>Order Id</th>
                            <th>Reg Date</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($workshop_regs as $reg)
                                <tr>
                                    <td>{{ $reg->user->name }}</td>
                                    <td>{{ $reg->workshop->name }}</td>
                                    <td>
                                        {{ $reg->order_id }} 
                                        <a id="{{ $reg->order_id }}" class="text-muted" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Copy" onclick="event.preventDefault(); copyOrderIdToClipboard('{{ $reg->order_id }}');"> <i class="fa fa-fw fa-clone"></i></a>
                                    </td>
                                    <td>{{ $reg->created_at->toDayDateTimeString() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>User Name</th>
                            <th>Workshop Name</th>
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

        function copyOrderIdToClipboard(orderId) {
            if('clipboard' in navigator) {
                navigator.clipboard.writeText(orderId)
                    .then(() => {
                        var copyIcon = document.getElementById(orderId);
                        $(orderId).tooltip('hide');
                        copyIcon.setAttribute('data-original-title', 'Copied')
                        $(orderId).tooltip('show');
                    });
            }
        }

        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip()
            $('#example').DataTable();
        });
    </script>
@endsection