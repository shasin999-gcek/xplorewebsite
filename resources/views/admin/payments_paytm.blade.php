@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Paytm Payments
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-calender"></i> Paytm Payments
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
                            <i class="fa fa-check fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $success_count  }}</div>
                            <div>Successful Transactions</div>
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
                            <i class="fa fa-exclamation-triangle fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $failure_count }}</div>
                            <div>Transaction Failures</div>
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
                           RS
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $success_amount }}</div>
                            <div>Amount Credited</div>
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
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                                <tr>
                                    <td>{{ $payment->ORDERID }}</td>
                                    <td>{{ $payment->TXNID }}</td>
                                    <td>{{ $payment->BANKTXNID }}</td>
                                    <td>{{ $payment->TXNAMOUNT }}</td>
                                    <td>{{ $payment->TXNDATE->toDayDateTimeString() }}</td>
                                    @if($payment->STATUS == 'TXN_SUCCESS')
                                        <td class="text-success">{{ $payment->STATUS }}</td>
                                    @else
                                        <td class="text-danger">{{ $payment->STATUS }}</td>
                                    @endif
                                    <td>
                                        <button class="btn btn-xs btn-primary" 
                                            data-toggle="modal"
                                            data-target="#payment-info"
                                            data-bankname="{{ $payment->BANKNAME }}"
                                            data-gatewayname="{{ $payment->GATEWAYNAME }}"
                                            data-paymentmode="{{ $payment->PAYMENTMODE }}"
                                            data-currency="{{ $payment->CURRENCY }}"
                                            data-respmsg="{{ $payment->RESPMSG }}"
                                            data-cardlastnums="{{ $payment->CARD_LAST_NUMS }}" >
                                            More Details
                                        </button>
                                    </td>
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

    <div class="modal fade" id="payment-info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">New message</h4>
            </div>
            <div class="modal-body">
               <table class="table table-striped">
                    <tr>
                        <th>Bank Name</th>
                        <td id="bankname"></td>
                    </tr>
                    <tr>
                        <th>Gateway Name</th>
                        <td id="gatewayname"></td>
                    </tr>
                    <tr>
                        <th>Payment Mode</th>
                        <td id="paymentmode"></td>
                    </tr>
                    <tr>
                        <th>Currency</th>
                        <td id="currency"></td>
                    </tr>
                    <tr>
                        <th>Response Message</th>
                        <td id="respmsg"></td>
                    </tr>
                    <tr>
                        <th>Card Last Nums</th>
                        <td id="cardlastnums"></td>
                    </tr>
               </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });

        $('#payment-info').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var bankname = button.data('bankname');
            var gatewayname = button.data('gatewayname');
            var paymentmode = button.data('paymentmode');
            var currency = button.data('currency');
            var respmsg = button.data('respmsg');
            var cardlastnums = button.data('cardlastnums');
            console.log('sds');
            var modal = $(this)
            modal.find('.modal-title').text('Payment Details');
            modal.find('#bankname').text(bankname);
            modal.find('#gatewayname').text(gatewayname);
            modal.find('#paymentmode').text(paymentmode);
            modal.find('#currency').text(currency);
            modal.find('#respmsg').text(respmsg);
            modal.find('#cardlastnums').text(cardlastnums);
        })
    </script>
@endsection
