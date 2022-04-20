@extends('master.master')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Chil Category ID- {{ $getData->id }} !</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="#">Inventory management</a></li>
                <li class="active">Update Child Category Name</li>
            </ol>
        </div>
    </div>
    <!--END Page-Title -->
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{ $getData->child_CatName }}</h3>
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
                        action="{{ route('updateChild', $getData->id) }}">
                        @method('put')
                        @csrf
                       
                        <div class="form-group ">
                            <label for="cemail" class="control-label col-lg-2">Child Category Name</label>
                            <div class="col-lg-10">
                                <input class="form-control "  type="text" name="child_CatName"
                                    placeholder="{{ $getData->child_CatName }}" aria-required="true">
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
