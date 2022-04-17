@extends('master.master')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Customer ID- {{ $getData->id }} !</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="#">Inventory management</a></li>
                <li class="active">Edit Page</li>
            </ol>
        </div>
    </div>
    <!--END Page-Title -->
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{ $getData->name }}</h3>
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
                <br>
                <div class="form">
                    <form class="cmxform form-horizontal tasi-form" id="commentForm" method="post"
                        action="{{ route('customer.update', $getData->id) }}" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="form-group ">
                            <label for="name" class="control-label col-lg-2">Name (required)</label>
                            <div class="col-lg-10">
                                <input class=" form-control" id="cname" name="name" placeholder="{{ $getData->name }}"
                                    type="text" required>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="cemail" class="control-label col-lg-2">E-Mail (required)</label>
                            <div class="col-lg-10">
                                <input class="form-control " id="cemail" type="email" name="email"
                                    placeholder="{{ $getData->email }}" required>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="cemail" class="control-label col-lg-2">Phone (required)</label>
                            <div class="col-lg-10">
                                <input class="form-control " id="cemail" type="number" name="phone"
                                    placeholder="{{ $getData->phone }}" required>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="cemail" class="control-label col-lg-2">Account Holder (required)</label>
                            <div class="col-lg-10">
                                <input class="form-control " id="cemail" type="text" name="account_holder"
                                    placeholder="{{ $getData->account_holder }}" required>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="cemail" class="control-label col-lg-2">Account Number (required)</label>
                            <div class="col-lg-10">
                                <input class="form-control " id="cemail" type="number" name="account_number"
                                    placeholder="{{ $getData->account_number }}" required>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="cemail" class="control-label col-lg-2">Bank Name (required)</label>
                            <div class="col-lg-10">
                                <input class="form-control " id="cemail" type="text" name="bank_name"
                                    placeholder="{{ $getData->bank_name }}" required>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="cemail" class="control-label col-lg-2">Bank Branch (required)</label>
                            <div class="col-lg-10">
                                <input class="form-control " id="cemail" type="text" name="bank_branch"
                                    placeholder="{{ $getData->bank_branch }}" required>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="cemail" class="control-label col-lg-2">Shop Name (required)</label>
                            <div class="col-lg-10">
                                <input class="form-control " id="cemail" type="text" name="shop_name"
                                    placeholder="{{ $getData->shop_name }}" required>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="cemail" class="control-label col-lg-2">City (required)</label>
                            <div class="col-lg-10">
                                <input class="form-control " id="cemail" type="text" name="city"
                                    placeholder="{{ $getData->city }}" required>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="ccomment" class="control-label col-lg-2">Address (required)</label>
                            <div class="col-lg-10">
                                <textarea class="form-control " id="ccomment" name="address" placeholder="{{ $getData->address }}" required=""
                                    aria-required="true"></textarea>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-lg-2">Previous Photo</label>
                            <div class="col-lg-10">
                                <img style="height:80px" src="{{ asset('backend/customer/images/' . $getData->image) }}"
                                    alt="No image">
                            </div>
                        </div>
                        <label class="control-label col-lg-2">Photo</label>
                        <div class="col-lg-10">
                            <img id="image" style="height:80px" src="" alt="No image">
                            <input class="form-control" required accept="image/*" type="file" name="image"
                                onchange="readURL(this);" />
                        </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button class="btn btn-success btn-sm waves-effect waves-light" type="submit">Update</button>
                        <button class="btn btn-danger btn-sm waves-effect" type="button">Cancel</button>
                    </div>
                </div>
                </form>
            </div> <!-- .form -->
        </div> <!-- panel-body -->
    </div> <!-- panel -->
    </div>

@endsection
