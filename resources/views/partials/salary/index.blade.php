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
  
    
    {{-- table --}}
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Salary Information</h3>
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
                            <table id="myTable" class="display">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Action</th>
                                        <th>Status</th>
                                        <th>Employee Name</th>
                                        <th>Salary</th>
                                        <th>Bonus</th>
                                        <th>Day</th>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Last Modified</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getData as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div style="display:flex">
                                                    <a href="{{ route('editSalary', $item->id) }}"
                                                        class="btn btn-sm btn-warning">Edit</a>
                                                </div>
                                                {{-- <button value="{{ $item->id }}"class="btn delete btn-sm btn-danger">delete</button> --}}
                                            </td>
                                            <td><span
                                                    class="badge 
                                                @if ($item->paymentStatus == 'due') 
                                                badge-danger
                                                @else
                                                badge-success
                                                 @endif ">
                                                    {{ $item->paymentStatus }}
                                                </span>
                                            </td>
                                            <td>{{ $item->employee_name }}</td>
                                            <td>{{ $item->salaryAmount }}</td>
                                            <td>{{ $item->bonus }}</td>
                                           
                                            <td>{{ $item->date }}</td>
                                            <td>{{ $item->month }}</td>
                                            <td>{{ $item->year }}</td>
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

