    <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul>
                            <li class="text-muted menu-title">Navigation</li>

                            <li class="has_sub">
                                <a href="{{route('dashboard')}}" class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i><span> Dashboard </span></a>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-address-book"></i> <span> Members </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{route('memberList')}}">Members List</a></li>
                                    <li><a href="{{route('memberCreate')}}">Members Create</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="index.php" class="waves-effect"><i class="fa fa-line-chart"></i><span> Reports </span></a>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>

            </div>
            <!-- Left Sidebar End -->