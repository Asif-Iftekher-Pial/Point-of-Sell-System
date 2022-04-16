@extends('master.master')
@section('content')
 <!-- Page-Title -->
 <div class="row">
    <div class="col-sm-12">
        <h4 class="pull-left page-title">Employee ID- {{ $getData->id }} !</h4>
        <ol class="breadcrumb pull-right">
            <li><a href="#">Inventory management</a></li>
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
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <br>
            <div class="form">
                <form class="cmxform form-horizontal tasi-form" id="commentForm" method="post" action="{{ route('employee.update',$getData->id) }}" enctype="multipart/form-data" >
                    @method('patch')
                    @csrf
                    <div class="form-group ">
                        <label for="name" class="control-label col-lg-2">Name (required)</label>
                        <div class="col-lg-10">
                            <input class=" form-control" id="cname" name="name"  placeholder="{{ $getData->name }}" type="text" required="" aria-required="true">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="cemail" class="control-label col-lg-2">E-Mail (required)</label>
                        <div class="col-lg-10">
                            <input class="form-control " id="cemail" type="email" name="email" placeholder="{{ $getData->email }}" required="" aria-required="true">
                        </div>
                    </div>
                   <div class="form-group ">
                        <label for="cemail" class="control-label col-lg-2">Phone (required)</label>
                        <div class="col-lg-10">
                            <input class="form-control " id="cemail" type="number" name="phone" placeholder="{{ $getData->phone }}" required="" aria-required="true">
                        </div>
                    </div>
                   <div class="form-group ">
                        <label for="cemail" class="control-label col-lg-2">Experience (required)</label>
                        <div class="col-lg-10">
                            <input class="form-control " id="cemail" type="text" name="experience" placeholder="{{ $getData->experience }}" required="" aria-required="true">
                        </div>
                    </div>
                   <div class="form-group ">
                        <label for="cemail" class="control-label col-lg-2">Salary (required)</label>
                        <div class="col-lg-10">
                            <input class="form-control " id="cemail" type="number" name="salary" placeholder="{{ $getData->salary }}" required="" aria-required="true">
                        </div>
                    </div>
                   <div class="form-group ">
                        <label for="cemail" class="control-label col-lg-2">Vacation (required)</label>
                        <div class="col-lg-10">
                            <input class="form-control " id="cemail" type="text" name="vacation" placeholder="{{ $getData->vacation }}" required="" aria-required="true">
                        </div>
                    </div>
                   <div class="form-group ">
                        <label for="cemail" class="control-label col-lg-2">City (required)</label>
                        <div class="col-lg-10">
                            <input class="form-control " id="cemail" type="text" name="city" placeholder="{{ $getData->city }}" required="" aria-required="true">
                        </div>
                    </div>
                   
                    <div class="form-group ">
                        <label for="ccomment" class="control-label col-lg-2">Address (required)</label>
                        <div class="col-lg-10">
                            <textarea class="form-control " id="ccomment" name="address" placeholder="{{ $getData->address }}" required="" aria-required="true"></textarea>
                        </div>
                    </div>
                    <div class="form-group ">
                    <label class="control-label col-lg-2">Photo</label>
                        <div class="col-lg-10">
                            <img id="image" style="height:80px" src="" alt="No image">
                            <input class="form-control" required accept="image/*" type="file" name="image"
                            onchange="readURL(this);" />
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