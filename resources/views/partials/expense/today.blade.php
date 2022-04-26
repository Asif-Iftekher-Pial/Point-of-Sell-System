@extends('master.master')
@section('content')
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
                        <div style="text-align: center">
                        <strong>
                            @php
                              $count =  $todayExpense ->count();
                              $sum =  $todayExpense ->sum('amount');
                             
                            @endphp
                        Showing total {{ $count }} results from today  
                        </strong>    
                        </div>
                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Expense Detail</th>
                                    <th>Amount</th>
                                    <th>Added By</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todayExpense as $item)
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
        $('#myTable').DataTable();
    });
</script>
    
@endsection