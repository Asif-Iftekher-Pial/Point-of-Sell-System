@extends('master.master')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">{{ $pageTitle }} !</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="#">Inventory management</a></li>
                <li class="active">{{ $pageTitle }}</li>
            </ol>
        </div>
    </div>
    <!--END Page-Title -->

    <!-- END MODAL -->
    {{-- Modal --}}
    <!-- Modal Add Employee -->
    <div class="modal fade" id="add-employee">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><strong>Add</strong> new product</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            
                            <label class="control-label">Name</label>
                            <input class="form-control form-white" required placeholder="Product name" type="text"
                                name="product_name" />
                            <label class="control-label">Category</label>
                            <select class="form-control form-white" name="CategoryName"
                                aria-label="Default select example">
                                <option value="">-- select category --</option>
                                @foreach ($parentCategory as $parentCat)
                                    <option value="{{ $parentCat->name }}">{{ $parentCat->name }}</option>
                                @endforeach
                            </select>
                            <label class="control-label">Child Category</label>
                            <select class="form-control form-white" name="child_cat_id"
                                aria-label="Default select example">
                                <option value="">-- select child category --</option>
                                @foreach ($childCategory as $childCat)
                                    <option value="{{ $childCat->id }}">{{ $childCat->child_CatName }} - parent category -> {{ $childCat->category->name }}</option>
                                @endforeach
                            </select>
                            <label class="control-label">Supplier Name</label>
                            <select class="form-control form-white" name="supplier_id"
                                aria-label="Default select example">
                                <option value="">-- select Supplier --</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                            <label class="control-label">Product Code</label>
                            <input class="form-control form-white" required placeholder="Enter product code" type="number"
                                name="product_code" />
                            <label class="control-label">Warehouse</label>
                            <input class="form-control form-white" required placeholder="Warehouse name" type="text"
                                name="warehouse" />
                            <label class="control-label">Product Route</label>
                            <input class="form-control form-white" required placeholder="Product Route" type="text"
                                name="product_route" />
                            <label class="control-label">Purchase Date</label>
                            <input class="form-control form-white" required placeholder="Purchase Date" type="text"
                                name="purchase_date" />
                            <label class="control-label">Expire date</label>
                            <input class="form-control form-white" required placeholder="Expire date" type="text"
                                name="expire_date" />
                            <label class="control-label">Buying Price</label>
                            <input class="form-control form-white" required placeholder="Buying Price" type="number"
                                name="buying_price" />
                            <label class="control-label">Selling Price</label>
                            <input class="form-control form-white" required placeholder="Selling Price" type="number"
                                name="selling_price" />
                            <label class="control-label">Stock</label>
                            <input class="form-control form-white" required placeholder="stock" type="number"
                                name="stock" />
                            
                            <label class="control-label">Status</label>
                            <select class="form-control form-white" name="status"
                                aria-label="Default select example">
                                <option value="">-- Status --</option>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            
                            </select>
                            <label class="control-label">Photo</label>
                            <br>
                            <img id="image" src="#" alt="No image">
                            <input class="form-control form-white" required accept="image/*" type="file" name="image"
                                onchange="readURL(this);" />
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light">Save</button>
                </div>
                </form>
            </div>

        </div>
    </div>
    </div>
    <!-- END MODAL -->

    {{-- Modal --}}
    {{-- table --}}
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Product Information</h3>
               
            </div>
            <div class="pull-right">
                <a  class="btn btn-purple waves-effect waves-light"href="{{ route('export') }}">
                    <i class="fa fa-download"></i> Export all product</a>
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
            <br>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <div style="width:10%">
                                <a href="#" data-toggle="modal" data-target="#add-employee"
                                    class="btn btn-sm btn-primary btn-block waves-effect waves-light">
                                    <i class="fa fa-plus"></i> Create New
                                </a>
                            </div>
                            <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="pull-right" style="margin-bottom: 10px;">
                                    <label class="control-label" for="file">Import file</label>
                                    <input class="form-control form-white" type="file" name="importFile" id="">
                                    <button class="btn btn-sm btn-success waves-effect waves-light" type="submit"><i class="fa fa-upload"></i> Import</button>
                                </div>
                            </form>
                            <table id="myTable" class="display">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Action</th>
                                        <th>Status</th>
                                        <th>Product Name</th>
                                        <th>Warehouse</th>
                                        <th>Stock</th>
                                        <th>Photo</th>
                                        <th>Buying Price</th>
                                        <th>Selling Price</th>
                                        <th>Product Code</th>
                                        <th>Product Route</th>
                                        <th>Supplier Name</th>
                                        <th>Category</th>
                                        <th>Child Category</th>
                                        <th>Parchase Date</th>
                                        <th>Expire Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getData as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div style="display:flex">
                                                    <a href="{{ route('product.edit', $item->id) }}"
                                                        class="btn btn-sm btn-warning">Edit</a>

                                                    <form action="{{ route('product.destroy', $item->id) }}"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn delete btn-sm btn-danger"
                                                            data-id="{{ $item->id }}"><i
                                                                class="fa fa-trash"></i>Delete</button>
                                                    </form>
                                                    {{-- <button value="{{ $item->id }}"class="btn delete btn-sm btn-danger">delete</button> --}}

                                                </div>
                                            </td>
                                            <td> <span class="badge 
                                                @if ($item->status == 'inactive') 
                                                badge-danger
                                                @else
                                                badge-success @endif ">{{ $item->status }}</span>
                                            </td>
                                            <td>{{ $item->product_name }}</td>
                                            <td>{{ $item->warehouse }}</td>
                                            <td>{{ $item->stock }}</td>
                                            <td>
                                                <img style="height:80px"
                                                    src="{{ asset('backend/products/images/' . $item->image) }}"
                                                    alt="No photo" srcset="">
                                            </td>
                                            <td>{{ $item->buying_price }}</td>
                                            <td>{{ $item->selling_price }}</td>
                                            <td>{{ $item->product_code }}</td>
                                            <td>{{ $item->product_route }}</td>
                                            <td>{{ App\Models\Supplier::where('id',$item->supplier_id)->pluck('name')->first() }}</td>
                                            <td>{{ $item->CategoryName }}</td>
                                            <td>{{ App\Models\ChildCategory::where('id',$item->child_cat_id)->pluck('child_CatName')->first() }}</td>
                                            <td>{{ $item->purchase_date }}</td>
                                            <td>{{ $item->expire_date }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- End table --}}
@endsection

@section('script')
    {{-- delete --}}
    <script>
        $(document).ready(function() {
            $(document).on('click', '.delete', function(e) {
                e.preventDefault();
                $('.delete').text('Deleting...');
                $('.delete').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>')

                var form = $(this).closest('form'); //sellecting form
                var dataID = $(this).data('id'); // getting id 
                // console.log(form);
                // let url = $(this).attr('data-href');
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this file!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {

                            form.submit();

                            swal("Your file has been deleted!", {
                                icon: "success",
                            });
                            $('.delete').text('Delete');
                        } else {
                            swal("Your file is safe!", {
                                icon: "success",
                            });
                            $('.delete').text('Delete');
                        }
                    });
            });
        });
    </script>
    {{-- End delete --}}

    <script>
        function refreshPage() {
            location.reload(true);
        }
    </script>
@endsection
