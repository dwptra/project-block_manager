<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    
    <!-- theme meta -->
    <meta name="theme-name" content="quixlab" />
  
    <title>Block - Manager</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="https://cdn-icons-png.flaticon.com/512/3665/3665896.png">
    <!-- Pignose Calender -->
    <link href="assets/plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="assets/plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="assets/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <!-- Custom Stylesheet -->
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="index.html">
                    <b class="logo-abbr"><h3 class="text-white">B</h3></b>
                    <span class="logo-compact"><img src="assets/images/logo-compact.png" alt=""></span>
                    <span class="brand-title">
                        <h3 class="text-white">Block Manager</h3>
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">    
            <div class="header-content clearfix">
                
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown">
                            <a href="javascript:void(0)" class="log-user"  data-toggle="dropdown">
                                <span>{{ Auth::user()->name }}</span>  <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
                            </a>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><a href="/logout"><i class="icon-key"></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Dashboard</li>
                    <li>
                        <a href="/dashboard" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-label">Data</li>
                    <li>
                        <a href="/user" aria-expanded="false">
                            <i class="icon-user menu-icon"></i><span class="nav-text">User</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
        @yield('content')
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a> 2018</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->
    <!--**********************************
        Scripts
    ***********************************-->
    <script src="assets/plugins/common/common.min.js"></script>
    <script src="assets/js/custom.min.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/gleek.js"></script>
    <script src="assets/js/styleSwitcher.js"></script>
    <!-- Chartjs -->
    <script src="assets/plugins/chart.js/Chart.bundle.min.js"></script>
    <!-- Circle progress -->
    <script src="assets/plugins/circle-progress/circle-progress.min.js"></script>
    <!-- Datamap -->
    <script src="assets/plugins/d3v3/index.js"></script>
    <script src="assets/plugins/topojson/topojson.min.js"></script>
    <script src="assets/plugins/datamaps/datamaps.world.min.js"></script>
    <!-- Morrisjs -->
    <script src="assets/plugins/raphael/raphael.min.js"></script>
    <script src="assets/plugins/morris/morris.min.js"></script>
    <!-- Pignose Calender -->
    <script src="assets/plugins/moment/moment.min.js"></script>
    <script src="assets/plugins/pg-calendar/js/pignose.calendar.min.js"></script>
    <!-- ChartistJS -->
    <script src="assets/plugins/chartist/js/chartist.min.js"></script>
    <script src="assets/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>
    <script src="assets/js/dashboard/dashboard-1.js"></script>
    <!-- TableJS -->
    <script src="assets/plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="assets/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
</body>
</html>
