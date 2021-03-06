<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="images/favicon_1.ico">
    <title>Inverntory Management System</title>

    <!-- Base Css Files -->
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Font Icons -->
    <link href="{{ asset('backend/assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/ionicon/css/ionicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/material-design-iconic-font.min.css') }}" rel="stylesheet">

    <!-- animate css -->
    <link href="{{ asset('backend/css/animate.css') }}" rel="stylesheet" />

    <!-- Waves-effect -->
    <link href="{{ asset('backend/css/waves-effect.css') }}" rel="stylesheet">

    <!-- Custom Files -->
    <link href="{{ asset('backend/css/helper.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
{{-- dataTable --}}
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.jqueryui.min.css">



    {{-- toastr notification --}}
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      

    <script src="{{ asset('backend/js/modernizr.min.js') }}"></script>

    @yield('css')
</head>
