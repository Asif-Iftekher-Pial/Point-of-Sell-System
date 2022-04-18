@extends('master.master')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Employee ID- {{ $getData->id }} !</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="#">Inventory management</a></li>
                <li class="active">Update Salary</li>
            </ol>
        </div>
    </div>
    <!--END Page-Title -->
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{ $getData->name }}</h3>
            </div>
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
                    <form class="cmxform form-horizontal tasi-form" id="commentForm" method="post"
                        action="{{ route('salaryUpdate', $getData->id) }}" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-group ">
                            <label class="control-label col-lg-2">Payment Status</label>
                            <div class="col-lg-10">
                                <select class="form-control" name="paymentStatus" aria-label="Default select example">
                                    <option value="">-- select status --</option>
                                    <option value="paid">Paid</option>
                                    <option value="due">Due</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="cemail" class="control-label col-lg-2">Bonus</label>
                            <div class="col-lg-10">
                                <input class="form-control "  type="number" name="bonus"
                                    placeholder="{{ $getData->bonus }}" aria-required="true">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="cemail" class="control-label col-lg-2">Date</label>
                            <div class="col-lg-10">
                                <input class="form-control "  type="number" min="1" max="31" name="date"
                                    placeholder="Date" aria-required="true">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="cemail" class="control-label col-lg-2">Month</label>
                            <div class="col-lg-10">
                                <input class="form-control " id="cemail" min="1" max="12" type="number" name="month"
                                    placeholder="month" aria-required="true">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="cemail" class="control-label col-lg-2">Year</label>
                            <div class="col-lg-10">
                                <input class="form-control "  type="number" min="2022" name="year"
                                    placeholder="year" aria-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-success btn-sm waves-effect waves-light" type="submit">Update</button>
                                <button class="btn btn-danger btn-sm waves-effect" type="button">Cancel</button>
                            </div>
                        </div>
                    </form>
                </form>
            </div> <!-- .form -->
        </div> <!-- panel-body -->
    </div> <!-- panel -->
    </div>

@endsection
