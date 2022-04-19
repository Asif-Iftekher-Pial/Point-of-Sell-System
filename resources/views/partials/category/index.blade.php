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
  
     <!-- Modal Add Category -->
     <div class="modal fade" id="add-employee">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><strong>Add</strong> new category</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label">Name</label>
                                <input class="form-control form-white" required placeholder="Enter new Category" type="text"
                                    name="name" />
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
    {{-- table --}}
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Category Information</h3>
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
                            <table id="myTable" class="display">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Last Modified</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getData as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div style="display:flex">
                                                    <a href="{{ route('category.edit', $item->id) }}"
                                                        class="btn btn-sm btn-warning">Edit</a>
                                                </div>
                                               
                                                <form action="{{ route('category.destroy', $item->id) }}"
                                                    method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn delete btn-sm btn-danger"
                                                        data-id="{{ $item->id }}"><i class="fa fa-trash"></i>Delete</button>
                                                </form>
                                                {{-- <button value="{{ $item->id }}"class="btn delete btn-sm btn-danger">delete</button> --}}

                                            </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->updated_at }}</td>
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
