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
    <!-- Modal Add Employee -->
    <div class="modal fade" id="edit-employee">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><strong>Edit</strong> employee</h4>
                </div>
                <div class="modal-body">
                 
                    <form action="{{ route('employee.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label">Name</label>
                                <input class="form-control form-white" required placeholder="Enter name" type="text"
                                    name="name" id="name" />
                                <label class="control-label">Email</label>
                                <input class="form-control form-white" required placeholder="Enter name" type="email"
                                    name="email"  id="email" />
                                <label class="control-label">Phone</label>
                                <input class="form-control form-white" required placeholder="Enter name" type="number"
                                    name="phone"  id="phone" />
                                <label class="control-label">Address</label>
                                <input class="form-control form-white" required placeholder="Enter name" type="text"
                                    name="address"  id="address" />
                                <label class="control-label">Experience</label>
                                <input class="form-control form-white" required placeholder="Enter name" type="text"
                                    name="experience"  id="experience" />
                                <label class="control-label">Salary</label>
                                <input class="form-control form-white" required placeholder="Enter name" type="number"
                                    name="salary"  id="salary" />
                                <label class="control-label">Vacation</label>
                                <input class="form-control form-white" required placeholder="Enter name" type="text"
                                    name="vacation"  id="vacation"/>
                                <label class="control-label">City</label>
                                <input class="form-control form-white" required placeholder="Enter name" type="text"
                                    name="city"  id="city"/>
                                <label class="control-label">Photo</label>
                                <br>
                                <img id="Updateimage" src="#" alt="No image">
                                <input class="form-control form-white"  required accept="image/*"
                                    type="file" name="image" onchange="readURLupdate(this);" />
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success waves-effect waves-light">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- END MODAL -->
    {{-- Modal --}}
    <!-- Modal Add Category -->
    <div class="modal fade" id="add-employee">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><strong>Add</strong> new employee</h4>
                </div>
                <div class="modal-body">
                 
                    <form action="{{ route('employee.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label">Name</label>
                                <input class="form-control form-white" required placeholder="Enter name" type="text"
                                    name="name" />
                                <label class="control-label">Email</label>
                                <input class="form-control form-white" required placeholder="Enter name" type="email"
                                    name="email" />
                                <label class="control-label">Phone</label>
                                <input class="form-control form-white" required placeholder="Enter name" type="number"
                                    name="phone" />
                                <label class="control-label">Address</label>
                                <input class="form-control form-white" required placeholder="Enter name" type="text"
                                    name="address" />
                                <label class="control-label">Experience</label>
                                <input class="form-control form-white" required placeholder="Enter name" type="text"
                                    name="experience" />
                                <label class="control-label">Salary</label>
                                <input class="form-control form-white" required placeholder="Enter name" type="number"
                                    name="salary" />
                                <label class="control-label">Vacation</label>
                                <input class="form-control form-white" required placeholder="Enter name" type="text"
                                    name="vacation" />
                                <label class="control-label">City</label>
                                <input class="form-control form-white" required placeholder="Enter name" type="text"
                                    name="city" />
                                <label class="control-label">Photo</label>
                                <br>
                                <img id="image" src="#" alt="No image">
                                <input class="form-control form-white" required accept="image/*"
                                    type="file" name="image" onchange="readURL(this);" />
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
                <h3 class="panel-title">Employee Information</h3>
            </div>
            
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
                                        <th>Action</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Photo</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Experience</th>
                                        <th>Salary</th>
                                        <th>Vacation</th>
                                        <th>City</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach ($getData as $item )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <button  data-href="{{ route('employee.edit', $item->id) }}" class="btn editButton btn-sm btn-warning">edit</button>
                                            <button data-href="{{ route('employee.destroy', $item->id) }}" class="btn deleteButton btn-sm btn-danger">delete</button>
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            <img style="height:80px" src="{{ asset('backend/employee/images/'.$item->image) }}" alt="No photo" srcset="">
                                        </td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>{{ $item->experience }}</td>
                                        <td>BDT-{{ $item->salary }}</td>
                                        <td>{{ $item->vacation }}</td>
                                        <td>{{ $item->city }}</td>
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

<!-- sweet alerts -->
<script>
    $(document).ready(function () {
        $(document).on('click','.editButton',function (e) { 
            e.preventDefault();
            
            var editButton_id =$(this).val();
            let url = $(this).attr('data-href');
            
            //  console.log(url);
            $('#edit-employee').modal('show')
            $.ajax({
                type: "get",
                // url: "/employee-edit/" + editButton_id,
                url: url,
                success: function (response) {
                    
                    //  console.log(response)
                    if(response.status == 200){
                        $('#name').val(response.retrivedData.name),
                        $('#email').val(response.retrivedData.email),
                        $('#phone').val(response.retrivedData.phone),
                        $('#address').val(response.retrivedData.address),
                        $('#experience').val(response.retrivedData.experience),
                        $('#salary').val(response.retrivedData.salary),
                        $('#vacation').val(response.retrivedData.vacation),
                        $('#city').val(response.retrivedData.city),
                        $('#image').val(response.retrivedData.image)
                    }else{
                        swal({
                        title: "Data not found",
                        text: "No Data found in database",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                        })
                    }
                }
            });
        });
    });
</script>
    
@endsection
