@extends('master.master')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12 bg-info">
            <h4 style="color:aliceblue" class="pull-left page-title">{{ $pageTitle }} !
                <br>
                <span>
                    Today:{{ date('d-m-y') }}
                </span>
            </h4>

            <ol class="breadcrumb pull-right">
                <li><a href="#">Inventory management</a></li>
                <li class="active" style="color:aliceblue">{{ $pageTitle }}</li>
            </ol>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible" id="alert" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- modal --}}
    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('customer.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Add customer</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-1" class="control-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="John">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="example@gmail.com">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-2" class="control-label">Phone</label>
                                    <input type="number" class="form-control" name="phone" id="phone"
                                        placeholder="016xxxxxx">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="field-3" class="control-label">Address</label>
                                    <input type="text" class="form-control" name="address" id="address"
                                        placeholder="Address">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-4" class="control-label">Aaccount Holder</label>
                                    <input type="text" class="form-control" name="account_holder" id="account_holder"
                                        placeholder="account_holder">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-5" class="control-label">Shop name</label>
                                    <input type="text" name="shop_name" class="form-control" id="shop_name"
                                        placeholder="shop_name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-6" class="control-label">City</label>
                                    <input type="text" class="form-control" name="city" id="city" placeholder="city">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-4" class="control-label">Account Nummber</label>
                                    <input type="number" class="form-control" name="account_number" id="account_number"
                                        placeholder="account_number">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-5" class="control-label">Bank Branch</label>
                                    <input type="text" name="bank_branch" class="form-control" id="bank_branch"
                                        placeholder="bank_branch">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="field-6" class="control-label">Bank name</label>
                                    <input type="text" class="form-control" name="bank_name" id="bank_name"
                                        placeholder="bank_name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group no-margin">
                                    <label for="field-7" class="control-label">Picture</label>
                                    <img id="image" src="#" alt="No image">
                                    <input class="form-control form-white" required accept="image/*" type="file"
                                        name="image" onchange="readURL(this);" />
                                </div>
                            </div>
                        </div>
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

    <br>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 ">
            <div class="portfolioFilter">
                <h4>All Category</h4>
                @foreach ($parentCategory as $parents)
                    <a href="#" class="current">{{ $parents->name }}</a>
                @endforeach

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-5">
            <form action="{{ route('create.invoice') }}" method="post">
                @csrf
                <div class="panel">
                    <h4 class="text-info">Customer</h4>
                    <a href="#" data-toggle="modal" data-target="#con-close-modal"
                        class="btn btn-sm btn-primary btn-custom waves-effect waves-light m-b-5 pull-right"><i
                            class="fa fa-plus"></i> customer</a>
                    {{-- <label class="control-label" for="">select customer</label> --}}
                    <select class="form-control form-white" name="customer_id" id="">
                        <option disabled="" selected="">select customer</option>
                        @foreach ($customers as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="price_card text-center">
    
                    <ul class="price-features" style="border: 1px solid gray;">
                        <table class="table">
                            <thead class="bg-success">
                                <tr>
                                    <th class="text-white">name:</th>
                                    <th class="text-white">qty:</th>
                                    <th class="text-white">single price:</th>
                                    <th class="text-white">sub-total</th>
                                    <th class="text-white">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $content = Cart::content();
                                @endphp
                                {{-- @dd($content) --}}
                                @foreach ($content as $cartItem)
                                    <tr>
                                        <th>{{ $cartItem->name }}</th>
                                        <form action="{{ route('qty.update', $cartItem->rowId) }}" method="post">
                                            @csrf
                                            <td style="display: flex"><input class="form-control" type="number" id="input_qty"
                                                    value="{{ $cartItem->qty }}" name="qty" min="1" style="width: 50px">
                                                <button class="btn btn-sm btn-info" style="margin-top: 0px;" type="submit"><i
                                                        class="fa fa-check"></i></button>
                                            </td>
                                        </form>
                                        @php
                                            $qty = number_format($cartItem->qty);
                                        @endphp
                                        <td>{{ $cartItem->price }}</td>
                                        @php
                                            $price = number_format($cartItem->price, 2);
                                        @endphp
                                        {{-- @dd($qty*$price) --}}
                                        <td>{{ $qty * $price }}</td>
    
                                        <form action="{{ route('delete.cart', $cartItem->rowId) }}" method="get">
                                            <td><button type="submit" class="btn btn-sm btn-danger"><i
                                                        class="fa fa-trash"></i></button></td>
                                        </form>
                                    </tr>
                                @endforeach
    
                            </tbody>
                        </table>
                    </ul>
                    <div class="pricing-footer bg-primary">
    
                        <span class="name">Qty: {{ Cart::count() }}</span>
                        <span class="name">total price: BDT- {{ Cart::subtotal() }}</span>
                        <span class="name">tax: BDT- {{ Cart::tax() }}</span>
                        <span class="price">total: BDT- {{ Cart::total() }}</span>
                    </div>
                    <button class="btn btn-sm btn-purple btn-custom waves-effect" type="submit">create invoice</button>
                </div>
                <!-- end Pricing_card -->
            </form>
            
        </div>

        <div class="col-lg-7" style="padding-top: 10px">
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Action</th>
                        <th>Status</th>
                        <th>Photo</th>
                        <th>Product Name</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getData as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <form action="{{ route('addtocart', $item->id) }}" method="post">
                                    @csrf
                                    {{-- <input type="hidden" name="{{ $item->id }}"> --}}
                                    <button type="submit" class=" btn btn-success"><i
                                            class="fa fa-plus-square"></i></button>
                                </form>
                            </td>
                            <td> <span
                                    class="badge 
                                @if ($item->status == 'inactive') badge-danger
                                @else
                                badge-success @endif ">{{ $item->status }}</span>
                            </td>
                            <td>
                                <img style="height:80px" src="{{ asset('backend/products/images/' . $item->image) }}"
                                    alt="No photo" srcset="">
                            </td>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->stock }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
