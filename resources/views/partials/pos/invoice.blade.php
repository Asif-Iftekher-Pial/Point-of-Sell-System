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
    {{-- modal --}}
    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('submit.invoice') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Checkout</h4>
                        
                        <h4 class="modal-title">Total:BDT- {{ Cart::total() }}</h4>

                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Name</label>
                                    <input type="text" class="form-control" value="{{ $customer->name }}" name="name" id="name"
                                        placeholder="{{ $customer->name }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Phone</label>
                                    <input type="number" class="form-control" name="phone" id="phone"
                                        value="{{ $customer->phone }}" placeholder="{{ $customer->phone }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-4" class="control-label">Shop name</label>
                                    <input type="text" class="form-control" name="shop_name" id="shop_name"
                                        value=" {{ $customer->shop_name }} "
                                        placeholder="{{ $customer->shop_name }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Address</label>
                                    <input type="text" class="form-control" name="address" id="address"
                                        value=" {{ $customer->address }} " placeholder="{{ $customer->address }}">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-6" class="control-label">Partial payment?</label>
                                    <br>
                                    <input type="checkbox" name="partial_paid" value="yes" id="partial_paid"> Yes
                                   
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4" id="partial_field" style="display: none">
                                <div class="form-group">
                                    <label for="field-4" class="control-label">partial amount</label>
                                    <input type="number" class="form-control" name="partial_amount" id="partial_amount"
                                        placeholder="partial_amount">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="orderNumber" value="{{ $orderstr }}">
                        <input type="hidden" name="invoiceNumber" value="{{ $invoicestr }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal -->
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
                                <strong>{{ date('Y') }}-{{ date('m') }}-{{ $invoicestr }}</strong>
                            </h4>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="pull-left m-t-30">
                                <address>
                                    <strong>{{ $customer->shop_name }}</strong><br>
                                    {{ $customer->address }}<br>
                                    {{ $customer->city }}<br>
                                    <abbr title="Phone">P:</abbr> {{ $customer->phone }}
                                </address>
                            </div>
                            <div class="pull-right m-t-30">
                                <p><strong>Order Date: </strong> {{ date('d') }} {{ date('M') }},
                                    {{ date('Y') }}</p>
                                <p class="m-t-10"><strong>Order Status: </strong> <span
                                        class="label label-pink">Pending</span></p>
                                <p class="m-t-10"><strong>Order ID: </strong> #ORD-{{ $orderstr }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="m-h-50"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table m-t-30">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product-ID</th>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>Unit Cost</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cart as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>${{ $item->price }}</td>
                                                <td>${{ $item->qty * $item->price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="border-radius: 0px;">
                        <div class="col-md-3 col-md-offset-9">
                            <p class="text-right"><b>Sub-total:</b> {{ Cart::subtotal() }}</p>
                            <p class="text-right">Discout: {{ Cart::discount() }}%</p>
                            <p class="text-right">VAT: {{ Cart::tax() }}</p>
                            <hr>
                            <h3 class="text-right">BDT: {{ Cart::total() }}</h3>
                        </div>
                    </div>
                   
                    <hr>
                    <div class="hidden-print">
                        <div class="pull-right">
                            <a href="#" onclick="printContent('p1')" class="btn btn-inverse waves-effect waves-light"><i
                                    class="fa fa-print"></i></a>
                            <a href="#" data-toggle="modal" data-target="#con-close-modal"
                                class="btn btn-primary waves-effect waves-light">Submit</a>
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
