@extends('master.master')
@section('content')
   
    {{-- Expense Report --}}

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

    <!-- END MODAL -->
    {{-- End table --}}

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
                            <div style="width:21%;display:flex;padding-bottom: 10px;">
                                <a style="margin-right: 5px;" data-toggle="modal" data-target="#expenseReport"
                                    class="btn btn-sm btn-primary btn-block waves-effect waves-light">
                                    <i class="fa fa-eye"></i>Filter expenses
                                </a>
                            </div>
                            <div style="text-align: center">
                            <strong>
                                @php
                                  $count =  $salereport ->count();
                                  $sum =  $salereport ->sum('amount');
                                 
                                @endphp
                               
                            Showing  {{ $count }} results from {{ $fromDate }} to {{ $toDate }}  
                            </strong>    
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
                <div style="text-align:right">
                   <strong> <h3>Total amount: {{ $sum }}</h3></strong>
                </div>
            </div>
           
        </div>
       
    </div>
   


@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#ExmyTable').DataTable();
    });
</script>
    
@endsection