<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <div class="user-details">
            <div class="pull-left">
                <img src="backend/images/users/avatar-1.jpg" alt="" class="thumb-md img-circle">
            </div>
            <div class="user-info">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">John Doe <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:void(0)"><i class="md md-face-unlock"></i> Profile<div class="ripple-wrapper"></div></a></li>
                        <li><a href="javascript:void(0)"><i class="md md-settings"></i> Settings</a></li>
                        <li><a href="javascript:void(0)"><i class="md md-lock"></i> Lock screen</a></li>
                        <li><a href="{{ route('logout') }}"><i class="md md-settings-power"></i> Logout</a></li>
                    </ul>
                </div>
                
                <p class="text-muted m-0">Administrator</p>
            </div>
        </div>
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>
                <li>
                    <a href="{{ route('home') }}" class="waves-effect active"><i class="md md-home"></i><span> Dashboard </span></a>
                </li>

                <li class="has_sub">
                    <a href="#" class="waves-effect"><i class="ion-person"></i><span> Employee Section </span><span class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('employee.index') }}">All Employees</a></li>
                        <li><a href="{{ route('salaryManage') }}">Salary Management</a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="#" class="waves-effect"><i class="ion-person"></i> <span> Customer Section </span> <span class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('customer.index') }}">All Customers</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="#" class="waves-effect"><i class="ion-person-stalker"></i><span>Suppliers Section </span><span class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('supplier.index') }}">All Suppliers</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="#" class="waves-effect"><i class="md md-now-widgets"></i> <span> Category Section </span> <span class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('category.index') }}">All Categories</a></li>
                    </ul>
                </li>
                
                <li class="has_sub">
                    <a href="#" class="waves-effect"><i class="md md-now-widgets"></i><span> Products Section </span><span class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('product.index') }}">All Product</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="#" class="waves-effect"><i class="md md-view-list"></i><span>Expense</span><span class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('expense.index') }}">All Expenses</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="#" class="waves-effect"><i class="md md-poll"></i><span> Sell Report </span><span class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="morris-chart.html">Morris Chart</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="#" class="waves-effect"><i class="md md-place"></i><span> Attendence </span><span class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="gmap.html"> Google Map</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="#" class="waves-effect"><i class="md md-pages"></i><span> Pages </span><span class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="timeline.html">Timeline</a></li>
                        <li><a href="invoice.html">Invoice</a></li>
                        <li><a href="email-template.html">Email template</a></li>
                        <li><a href="contact.html">Contact-list</a></li>
                        <li><a href="login.html">Login</a></li>
                        <li><a href="register.html">Register</a></li>
                        <li><a href="recoverpw.html">Recover Password</a></li>
                        <li><a href="lock-screen.html">Lock Screen</a></li>
                        <li><a href="blank.html">Blank Page</a></li>
                        <li><a href="maintenance.html">Maintenance</a></li>
                        <li><a href="coming-soon.html">Coming-soon</a></li>
                        <li><a href="404.html">404 Error</a></li>
                        <li><a href="404_alt.html">404 alt</a></li>
                        <li><a href="500.html">500 Error</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="md md-share"></i><span>Multi Level </span><span class="pull-right"><i class="md md-add"></i></span></a>
                    <ul>
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><span>Menu Level 1.1</span> <span class="pull-right"><i class="md md-add"></i></span></a>
                            <ul style="">
                                <li><a href="javascript:void(0);"><span>Menu Level 2.1</span></a></li>
                                <li><a href="javascript:void(0);"><span>Menu Level 2.2</span></a></li>
                                <li><a href="javascript:void(0);"><span>Menu Level 2.3</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);"><span>Menu Level 1.2</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>