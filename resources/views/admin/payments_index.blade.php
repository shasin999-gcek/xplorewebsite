@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Payments
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-calender"></i> Payments
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-info">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    All Payments
                </div>

                <div class="panel-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%;">
                        <thead>
                        <tr>
                            <th>ORDER ID</th>
                            <th>Transaction Id</th>
                            <th>Bank Transaction Id</th>
                            <th>Amount Paid</th>
                            <th>Transaction Date</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                                <tr>
                                    <td>{{ $payment->ORDERID }}</td>
                                    <td>{{ $payment->TXNID }}</td>
                                    <td>{{ $payment->BANKTXNID }}</td>
                                    <td>{{ $payment->TXNAMOUNT }}</td>
                                    <td>{{ $payment->TXNDATE }}</td>
                                    @if($payment->STATUS == 'TXN_SUCCESS')
                                        <td class="text-success">{{ $payment->STATUS }}</td>
                                    @else
                                        <td class="text-danger">{{ $payment->STATUS }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>ORDER ID</th>
                            <th>Transaction Id</th>
                            <th>Bank Transaction Id</th>
                            <th>Amount Paid</th>
                            <th>Transaction Date</th>
                            <th>Status</th>
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
