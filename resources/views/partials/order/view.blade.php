@extends('master.master')
@section('content')
    <div class="col-sm-12">
        <h4 class="pull-left page-title">Invoice</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="#">Point of sell</a></li>
            <li><a href="#">Expense</a></li>
            <li class="active">Invoice</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <!-- <div class="panel-heading">
                                <h4>Invoice</h4>
                            </div> -->
                <div class="panel-body" id="p1">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-right"><img src="{{ asset('backend/images/logo_dark.png') }}"
                                    alt="velonic"></h4>

                        </div>
                        <div class="pull-right">
                            <h4>Invoice # <br>
                                <strong>{{ date('Y') }}-{{ date('m') }}-{{ $detailOrder->invoice_number }}</strong>
                            </h4>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="pull-left m-t-30">
                                <address>
                                    <strong>{{ $detailOrder->customer_name }}</strong><br>
                                    {{ $detailOrder->address }}<br>
                                    <abbr title="Phone">P: </abbr> {{ $detailOrder->phone }}
                                </address>
                            </div>
                            <div class="pull-right m-t-30">
                                <p><strong>Order Date: </strong> {{ date('d') }} {{ date('M') }},
                                    {{ date('Y') }}</p>
                                <p class="m-t-10"><strong>Order Status: </strong> <span
                                        class="label label-pink">{{ $detailOrder->order_status }}</span></p>
                                <p class="m-t-10"><strong>Order ID: </strong>
                                    #ORD-{{ $detailOrder->order_number }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="m-h-50"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-success table-striped m-t-30">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product-name</th>
                                            <th>Quantity</th>
                                            <th>Unit cost</th>
                                            <th>Unit total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detailOrder->orderDetail as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->product_name }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>BDT: {{ $item->price }}</td>
                                                <td>BDT: {{ $item->qty * $item->price }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="border-radius: 0px;">
                        <div class="col-md-3 col-md-offset-9">
                            @if ($detailOrder->partial_amount != null)
                                <p class="text-right"><b>Paid: </b> {{ $detailOrder->partial_amount }} BDT</p>
                            @else
                                <div class="text-right">

                                    <p class="badge badge-success"><b>Full Paid</b></p>

                                </div>
                            @endif
                            <br>
                            @if ($detailOrder->due_amount != null)
                                <p class="text-right">Due: {{ $detailOrder->due_amount }} BDT</p>
                            @else
                                <div class="text-right">
                                    <p class="badge badge-success"><b>No Due</b></p>
                                </div>
                            @endif
                            <hr>
                            <h3 class="text-right">BDT: {{ $detailOrder->total_amount }}</h3>
                        </div>
                    </div>

                    <hr>
                    <div class="hidden-print">
                        <div class="pull-right">
                            <a href="#" onclick="printContent('p1')" class="btn btn-inverse waves-effect waves-light"><i
                                    class="fa fa-print"></i></a>
                            @if ($detailOrder->order_status == 'confirmed')
                                <a href="#" class="btn btn-success waves-effect waves-light">Done</a>
                            @else
                            
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
@section('script')
    <script>
        function printContent(el) {
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementById(el).innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
            document.body.innerHTML = restorepage;
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#partial_paid').click(function(e) {
                e.preventDefault();
                if ($(this).is(":checked")) {

                    $('#partial_field').toggle();
                }
            });
        });
    </script>
@endsection
