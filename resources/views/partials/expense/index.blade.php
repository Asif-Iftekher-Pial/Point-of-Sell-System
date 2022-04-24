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
                    <h4 class="modal-title"><strong>Add</strong> new expense</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('expense.store') }}" method="post">
                        @csrf
                        <div class="row">

                            <label class="control-label">Expense detail</label>
                            <textarea class="form-control form-white" required placeholder="Expense Detail" name="expenseDetail" id="" cols="30"
                                rows="5"></textarea>

                            <label class="control-label">Amount</label>
                            <input class="form-control form-white" required placeholder="amount" type="number"
                                name="amount" />


                            <input class="form-control form-white" value="{{ date('d/m/y') }}" required type="hidden"
                                name="date" />

                            <input class="form-control form-white" required value="{{ date('F') }}" type="hidden"
                                name="month" />

                            <input class="form-control form-white" required value="{{ date('Y') }}" type="hidden"
                                name="year" />

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

    <!-- END MODAL -->
     <!-- Modal Add Employee -->
     <div class="modal fade" id="expenseReport">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><strong>Filter Expense</strong></h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('filterExpense') }}" method="get">
                        <div class="row">
                            <label class="control-label">Expense From Date</label>
                            <input type="date" value="{{ $fromDate }}" class="form-control form-white" placeholder="From date" required
                                name="from_date">
                            <label class="control-label">To</label>
                            <input value="{{ $toDate }}" class="form-control form-white"  required placeholder="To date" type="date"
                                name="to_date"/>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light">Search</button>
                </div>
                </form>
            </div>

        </div>
    </div>

    {{-- Modal --}}
    {{-- table --}}
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Expense Information</h3>
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
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <div style="display:flex;padding-bottom: 10px;">
                                <a style="margin-right: 5px;" data-toggle="modal" data-target="#add-employee"
                                    class="btn btn-sm btn-primary btn-block waves-effect waves-light">
                                    <i class="fa fa-plus"></i>New Expense
                                </a>
                                <a style="margin-right: 5px;" href="{{ route('todayExpense') }}"
                                    class="btn btn-sm btn-info btn-block waves-effect waves-light">
                                    <i class="fa fa-eye"></i>Today Expense
                                </a>
                                <a  data-toggle="modal" data-target="#expenseReport"
                                    class="btn btn-sm btn-primary btn-block waves-effect waves-light">
                                    <i class="fa fa-eye"></i>Filter expenses
                                </a>

                            </div>

                            <table id="myTable" class="display">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Action</th>
                                        <th>Expense Detail</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Month</th>
                                        <th>Added By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getData as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div style="display:flex">
                                                    <a href="{{ route('expense.edit', $item->id) }}"
                                                        class="btn btn-sm btn-warning">Edit</a>

                                                    <form action="{{ route('expense.destroy', $item->id) }}"
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
                                            <td>{{ $item->expenseDetail }}</td>
                                            <td>{{ $item->amount }}</td>
                                            <td>{{ $item->date }}</td>
                                            <td>{{ $item->month }}</td>
                                            <td>{{ $item->UserName }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @php
                   $sum= $getData->sum('amount')
                @endphp
                <div style="text-align:right">
                    <strong> <h3>Total amount: {{ $sum }}</h3></strong>
                 </div>
            </div>
        </div>
    </div>

    {{-- Expense Report --}}

    <!-- Modal Add Employee -->
    {{-- <div class="modal fade" id="expenseReport">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><strong>Filter Expense</strong></h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('filterExpense') }}" method="get">
                        <div class="row">
                            <label class="control-label">Expense From Date</label>
                            <input type="date" value="" class="form-control form-white" placeholder="From date" required
                                name="from_date">
                            <label class="control-label">To</label>
                            <input value="" class="form-control form-white"  required placeholder="To date" type="date"
                                name="to_date"/>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light">Search</button>
                </div>
                </form>
            </div>

        </div>
    </div> --}}

    <!-- END MODAL -->
    {{-- End table --}}

    {{-- <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Expense Information</h3>
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
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <div style="width:21%;display:flex;padding-bottom: 10px;">
                                <a style="margin-right: 5px;" data-toggle="modal" data-target="#expenseReport"
                                    class="btn btn-sm btn-primary btn-block waves-effect waves-light">
                                    <i class="fa fa-eye"></i>View all expenses
                                </a>
                                
                            </div>
                            
                            <table id="ExmyTable" class="display">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Expense Detail</th>
                                        <th>Amount</th>
                                        <th>Added By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($salereport as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->expenseDetail }}</td>
                                            <td>{{ $item->amount }}</td>
                                            <td>{{ $item->UserName }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}



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
