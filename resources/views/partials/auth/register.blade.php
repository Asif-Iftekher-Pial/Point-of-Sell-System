<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="{{ asset('backend/images/favicon_1.ico') }}">

    <title>POS - Registration Form</title>

    <!-- Base Css Files -->
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Font Icons -->
    <link href="{{ asset('backend/assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/ionicon/css/ionicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/material-design-iconic-font.min.css') }}" rel="stylesheet">

    <!-- animate css -->
    <link href="{{ asset('backend/css/animate.css') }}" rel="stylesheet" />

    <!-- Waves-effect -->
    <link href="{{ asset('backend/css/waves-effect.cs') }}s" rel="stylesheet">

    <!-- Custom Files -->
    <link href="{{ asset('backend/css/helper.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet" type="text/css" />
    {{-- toastr --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" integrity="sha512-OBqw+EqQ6cLascdn6suVrhnj69lJINTc0HOHf06HdHwLVtrpSLLROoIbT6LH+LcjIYeuh+lgQbJQOOyuxh/RBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

    <script src="{{ asset('backend/js/modernizr.min.js') }}"></script>

</head>

<body>


    <div class="wrapper-page">
        <div class="panel panel-color panel-primary panel-pages">
            <div class="panel-heading bg-img">
                <div class="bg-overlay"></div>
                <h3 class="text-center m-t-10 text-white"> Create a new Account </h3>
            </div>


            <div class="panel-body">

                <form class="form-horizontal m-t-20" action="{{ route('register') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <div class="col-xs-12">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input class="form-control input-lg" type="email" name="email" required=""
                                placeholder="Email">
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="col-xs-12">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input class="form-control input-lg" type="text" name="name" required="" placeholder="name">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input class="form-control input-lg" type="password" name="password" required=""
                                placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            @error('confirmPassword')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input class="form-control input-lg" type="password" name="confirmPassword" required=""
                                placeholder="Confirm Password">
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <div class="checkbox checkbox-primary">
                                <input id="checkbox-signup" type="checkbox" checked="">
                                <label for="checkbox-signup">
                                    I accept <a href="#">Terms and Conditions</a>
                                </label>
                            </div>

                        </div>
                    </div>

                    <div class="form-group text-center m-t-40">
                        <div class="col-xs-12">
                            <button class="btn btn-primary waves-effect waves-light btn-lg w-lg"
                                type="submit">Register</button>
                        </div>
                    </div>

                    <div class="form-group m-t-30">
                        <div class="col-sm-12 text-center">
                            <a href="{{ route('login') }}">Already have account?</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>


    <script>
        var resizefunc = [];
    </script>
    <script src="{{ asset('backend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/js/waves.js') }}"></script>
    <script src="{{ asset('backend/js/wow.min.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.nicescroll.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/js/jquery.scrollTo.min.js') }}"></script>
    <script src="{{ asset('backend/assets/jquery-detectmobile/detect.js') }}"></script>
    <script src="{{ asset('backend/assets/fastclick/fastclick.js') }}"></script>
    <script src="{{ asset('backend/assets/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('backend/assets/jquery-blockui/jquery.blockUI.js') }}"></script>


    {{-- toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js" integrity="sha512-R1bjo9slUbuOZw+h4aIf3iA2KvEWHpJ96w0Wbrn+1CMrQPeI44dpGYg3g6t3p/y16CR9KbJoe3UA+2zYngogJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    <!-- CUSTOM JS -->
    <script src="{{ asset('backend/js/jquery.app.js') }}"></script>

    {{-- notification --}}
    <script>
        @if (Session::has('messege'))
       
        var type="{{ Session::get('alert-type','info') }}"
        switch(type){
            case 'info' :
                toastr.info("{{ Session::get('messege') }}");
                break;
            case 'success' :
                toastr.success("{{ Session::get('messege') }}");
                break;
            case 'warning' :
                toastr.warning("{{ Session::get('messege') }}");
                break;
            case 'error' :
                toastr.error("{{ Session::get('messege') }}");
                break;
            
        } 
        @endif
    </script>

</body>

</html>
