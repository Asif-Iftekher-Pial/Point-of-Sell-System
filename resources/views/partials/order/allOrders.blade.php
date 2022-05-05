@extends('master.master')
@section('content')
 <!-- Page-Title -->
 <div class="row">
    <div class="col-sm-12">
        <h4 class="pull-left page-title">All Orders !</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="#">Inventory management</a></li>
            <li class="active">Orders</li>
        </ol>
    </div>
</div>
<div class="row">
    
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
    <div class="col-lg-3 col-md-4">
        <a href="email-compose.html" class="btn btn-danger waves-effect waves-light btn-block">Compose</a>
        <div class="panel panel-default p-0  m-t-20">
            <div class="panel-body p-0">
                <div class="list-group mail-list">
                  <a href="#" class="list-group-item no-border active"><i class="fa fa-download m-r-5"></i>All orders <b>({{ App\Models\Order::count() }})</b></a>
                  <a href="#" class="list-group-item no-border"><i class="fa fa-file-text-o m-r-5"></i>Partial Orders <b>({{ App\Models\Order::where('partial_paid','yes')->count() }})</b></a>
                  {{-- <a href="#" class="list-group-item no-border"><i class="fa fa-file-text-o m-r-5"></i>Draft <b>(20)</b></a> --}}
                  <a href="#" class="list-group-item no-border"><i class="fa fa-paper-plane-o m-r-5"></i>Confirmed Orders <b>({{ App\Models\Order::where('order_status','confirmed')->count() }})</b></a>
                  <a href="#" class="list-group-item no-border"><i class="fa fa-trash-o m-r-5"></i>Trash <b>(354)</b></a>
                </div>
            </div>
        </div>
        <h3 class="panel-title m-t-40">Labels</h3>
        <div class="panel panel-default p-0 p-t-20 m-t-20">
            <div class="panel-body p-0">
                <div class="list-group no-border">
                  <a href="#" class="list-group-item no-border"><span class="fa fa-circle text-info pull-right"></span>Web App</a>
                  <a href="#" class="list-group-item no-border"><span class="fa fa-circle text-warning pull-right"></span>Project 1</a>
                  <a href="#" class="list-group-item no-border"><span class="fa fa-circle text-purple pull-right"></span>Project 2</a>
                  <a href="#" class="list-group-item no-border"><span class="fa fa-circle text-pink pull-right"></span>Friends</a>
                  <a href="#" class="list-group-item no-border"><span class="fa fa-circle text-success pull-right"></span>Family</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-9 col-md-8">
        <div class="row">
            <div class="col-lg-12">
                <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-folder"></i>
                        <b class="caret"></b>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#fakelink">Action</a></li>
                            <li><a href="#fakelink">Another action</a></li>
                            <li><a href="#fakelink">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#fakelink">Separated link</a></li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary waves-effect waves-light  dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-tag"></i>
                        <b class="caret"></b>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#fakelink">Action</a></li>
                            <li><a href="#fakelink">Another action</a></li>
                            <li><a href="#fakelink">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#fakelink">Separated link</a></li>
                        </ul>
                    </div>
                    
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary waves-effect waves-light  dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                          More
                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a href="#fakelink">Dropdown link</a></li>
                          <li><a href="#fakelink">Dropdown link</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> <!-- End row -->
        
        <div class="panel panel-default m-t-20">
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="myTable" class="display">
                        <thead>
                            <tr>
                                <th>order</th>
                                <th>customer name</th>
                                <th>payment Status</th>
                                <th>paid</th>
                                <th>due</th>
                                <th>Total price</th>
                                <th>status</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allOrders as $item)
                            <tr>
                                <td>
                                    {{ $item->order_number }}
                                </td>
                                <td>
                                    <a href="email-read.html">{{ $item->customer_name }}</a>
                                </td>
                                <td>
                                    <a href="email-read.html"><i class="fa fa-circle  
                                        @if($item->payment_status =='paid')
                                        text-success
                                        @else
                                        text-danger
                                        @endif
                                        m-r-15"></i>{{ $item->payment_status }}
                                    </a>
                                </td>
                                <td>
                                   @if ($item->partial_amount !=null)
                                   {{ $item->partial_amount }}
                                   @else
                                       <span>Payment done</span>
                                   @endif
                                   
                                </td>
                                <td>
                                    @if ($item->due_amount !=null)
                                    {{ $item->due_amount }}
                                    @else
                                        <span>no due</span>
                                    @endif
                                    
                                </td>
                                <td>
                                    {{ $item->total_amount }}
                                </td>
                               
                                <td>
                                    order status
                                    {{-- <span class="badge 
                                   @if ($item->$order_status == "confirmed")
                                    badge-success
                                    @else
                                    badge-danger
                                   @endif 
                                    ">{{ $item->$order_status }}</span> --}}
                                </td>
                                <td class="text-right">
                                   <a href="{{ route('order.show', $item->id) }}" class="btn  btn-sm btn-warning">view</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <hr>
                
               
            
            </div> <!-- panel body -->
        </div> <!-- panel -->
    </div>
</div>
    
@endsection