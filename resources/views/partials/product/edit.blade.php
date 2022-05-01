@extends('master.master')
@section('content')
 <!-- Page-Title -->
 <div class="row">
    <div class="col-sm-12">
        <h4 class="pull-left page-title">Product ID- {{ $getData->id }} !</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="#">Inventory management</a></li>
            <li class="active">Edit Page</li>
        </ol>
    </div>
</div>
<!--END Page-Title -->
<div class="col-sm-12">
    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">{{ $getData->name }}</h3></div>
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
                <form class="cmxform form-horizontal tasi-form" id="commentForm" method="post" action="{{ route('product.update',$getData->id) }}" enctype="multipart/form-data" >
                    @method('patch')
                    @csrf
                    <div class="form-group ">
                        <label for="name" class="control-label col-lg-2">Product Name (required)</label>
                        <div class="col-lg-10">
                            <input class=" form-control" id="cname" name="product_name"  placeholder="{{ $getData->product_name }}" type="text" required="" aria-required="true">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="cemail" class="control-label col-lg-2">Status (required)</label>
                        <div class="col-lg-10">
                            <select class="form-control form-white" name="status"
                            aria-label="Default select example">
                            <option value="">-- Status --</option>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        </div>
                    </div>
                   <div class="form-group ">
                        <label for="cemail" class="control-label col-lg-2">Category (required)</label>
                        <div class="col-lg-10">
                            <select class="form-control form-white" name="CategoryName"
                            aria-label="Default select example">
                            <option value="">-- select category --</option>
                            @foreach ($parentCategory as $parentCat)
                                <option value="{{ $parentCat->name }}">{{ $parentCat->name }}</option>
                            @endforeach
                        </select>    
                        </div>
                    </div>
                   <div class="form-group ">
                        <label for="cemail" class="control-label col-lg-2">Child Category (required)</label>
                        <div class="col-lg-10">
                            <select class="form-control form-white" name="child_cat_id"
                            aria-label="Default select example">
                            <option value="">-- select child category --</option>
                            @foreach ($childCategory as $childCat)
                                <option value="{{ $childCat->id }}">{{ $childCat->child_CatName }} - parent category -> {{ $childCat->category->name }}</option>
                            @endforeach
                        </select>    
                        </div>
                    </div>
                   <div class="form-group ">
                        <label for="cemail" class="control-label col-lg-2">Supplier (required)</label>
                        <div class="col-lg-10">
                            <select class="form-control form-white" name="supplier_id"
                            aria-label="Default select example">
                            <option value="">-- select Supplier --</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>   
                        </div>
                    </div>
                   <div class="form-group ">
                        <label for="code" class="control-label col-lg-2">Product Code (required)</label>
                        <div class="col-lg-10">
                            <input class="form-control"  type="number" name="product_code" placeholder="{{ $getData->product_code }}" required="" aria-required="true">
                        </div>
                    </div>
                   <div class="form-group ">
                        <label for="warehouse" class="control-label col-lg-2">Warehouse (required)</label>
                        <div class="col-lg-10">
                            <input class="form-control " id="warehouse" type="text" name="warehouse" placeholder="{{ $getData->warehouse }}" required="" aria-required="true">
                        </div>
                    </div>
                   
                    <div class="form-group ">
                        <label for="ccomment" class="control-label col-lg-2">Product Route (required)</label>
                        <div class="col-lg-10">
                            <input class="form-control " id="ccomment" name="product_route" placeholder="{{ $getData->product_route }}" required="" aria-required="true">
                        </div>
                    </div>
                    
                    <div class="form-group ">
                        <label for="ccomment" class="control-label col-lg-2">Purchase Date (required)</label>
                        <div class="col-lg-10">
                            <input class="form-control " id="ccomment" name="purchase_date" placeholder="{{ $getData->purchase_date }}" required="" aria-required="true">
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="ccomment" class="control-label col-lg-2">Expire Date (required)</label>
                        <div class="col-lg-10">
                            <input class="form-control " id="ccomment" name="expire_date" placeholder="{{ $getData->expire_date }}" required="" aria-required="true">
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="ccomment" class="control-label col-lg-2">Buying Price (required)</label>
                        <div class="col-lg-10">
                            <input class="form-control " id="ccomment" name="buying_price"  type="number" placeholder="{{ $getData->buying_price }}" required="" aria-required="true">
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="ccomment" class="control-label col-lg-2">Selling Price (required)</label>
                        <div class="col-lg-10">
                            <input class="form-control " id="ccomment" name="selling_price" type="number" placeholder="{{ $getData->selling_price }}" required="" aria-required="true">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="ccomment" class="control-label col-lg-2">stock (required)</label>
                        <div class="col-lg-10">
                            <input class="form-control " id="ccomment" name="stock" type="number" placeholder="{{ $getData->stock }}" required="" aria-required="true">
                        </div>
                    </div>

                    
                    <div class="form-group ">
                    <label class="control-label col-lg-2">Previous Photo</label>
                        <div class="col-lg-10">
                            <img  style="height:80px" src="{{ asset('backend/products/images/' . $getData->image) }}" alt="No image">
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