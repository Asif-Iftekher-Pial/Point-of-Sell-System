@extends('master.master')
@section('content')
 <!-- Page-Title -->
 <div class="row">
    <div class="col-sm-12">
        <h4 class="pull-left page-title">Expense ID- {{ $getData->id }} !</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('home') }}">Inventory management</a></li>
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
            <div class="form">
                <form class="cmxform form-horizontal tasi-form" id="commentForm" method="post" action="{{ route('expense.update',$getData->id) }}" enctype="multipart/form-data" >
                    @method('patch')
                    @csrf
                    <div class="form-group ">
                        <label for="name" class="control-label col-lg-2">Expense Detail (required)</label>
                        <div class="col-lg-10">
                            <textarea  class="form-control" name="expenseDetail" id="" cols="30" rows="5" placeholder="{{ $getData->expenseDetail }}"></textarea>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="cemail" class="control-label col-lg-2">Amount (required)</label>
                        <div class="col-lg-10">
                            <input class="form-control " id="cemail" type="text" name="amount" placeholder="{{ $getData->amount }}" required="" aria-required="true">
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