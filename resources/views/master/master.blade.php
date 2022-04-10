<!DOCTYPE html>
<html>

@include('layouts.head')


<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        @include('layouts.topBar')
        <!-- Top Bar End -->


        <!-- ========== Left Sidebar Start ========== -->
        @include('layouts.LeftSideBar')
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">

                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="pull-left page-title">Welcome !</h4>
                            <ol class="breadcrumb pull-right">
                                <li><a href="#">Moltran</a></li>
                                <li class="active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                    <!--END Page-Title -->




                    @yield('content')

                </div> <!-- container -->

            </div> <!-- content -->

            <footer class="footer text-right">
                2015 © Moltran.
            </footer>

        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->


        <!-- Right Sidebar -->
        @include('layouts.rightSideBar')
        <!-- /Right-bar -->

    </div>
    <!-- END wrapper -->

    @include('layouts.script')

</body>

</html>
