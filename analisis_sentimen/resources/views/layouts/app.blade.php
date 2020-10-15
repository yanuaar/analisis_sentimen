<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        @yield('title')
    </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

        @yield('assets')

    <link href="assets/img/favicon2.png" rel="icon" />
    <link href="assets/img/favicon2.png" rel="icon" />

    <link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
    <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

<style>

</style>

</head>

<body>  
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="">
                        <a href="{{ url('dashboard')}}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    <li class="">
                        <a href="{{ url('datasets')}}"><i class="menu-icon fa fa-twitter"></i>Datasets </a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                            <i class="menu-icon fa fa-th"></i>Forms</a>
                        <ul class="sub-menu children dropdown-menu">                       
                            <li><i class="fa fa-th"></i><a href="{{ url('data_stopword') }}"> Data Stopword</a></li>
                            <li><i class="fa fa-th"></i><a href="{{ url('data_normalisasi') }}"> Data Normalisasi</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                            <i class="menu-icon fa fa-gears"></i>Preprocessing</a>
                        <ul class="sub-menu children dropdown-menu">                            
                            <li><i class="fa fa-rub"></i><a href="{{ url('cleaning')}}"> Cleaning</a></li>
                            <li><i class="fa fa-text-height"></i><a href="{{ url('casefolding')}}"> Casefolding</a></li>
                            <li><i class="fa fa-puzzle-piece"></i><a href="{{ url('normalisasi') }}"> Normalisasi</a></li>
                            <li><i class="fa fa-eraser"></i><a href="{{ url('stopword') }}"> Stopwords</a></li>
                            <li><i class="fa fa-stack-exchange"></i><a href="{{ url('stemming') }}"> Stemming</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                            <i class="menu-icon fa fa-list"></i>Term Frequency</a>
                        <ul class="sub-menu children dropdown-menu">                            
                            <li><i class="fa fa-list"></i><a href="{{ url('tf_training') }}"> TF Training</a></li>
                            <li><i class="fa fa-list"></i><a href="{{ url('tf_testing') }}"> TF Testing</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                            <i class="menu-icon fa fa-tasks"></i>Classification</a>
                        <ul class="sub-menu children dropdown-menu">                            
                            <li><i class="fa fa-tasks"></i><a href="{{ url('classification_training') }}"> Training</a></li>
                            <li><i class="fa fa-tasks"></i><a href="{{ url('classification_testing') }}"> Testing</a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="{{ url('text_analysis')}}"><i class="menu-icon fa fa-list-alt" aria-hidden="true"></i>Text Analysis </a>
                    </li>
                </ul>
            </div><!-- navbar-collapse -->
        </nav>
    </aside>
    <!-- left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <!-- <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a> -->
                    <a class="navbar-brand" href="">Sentiment Analysis</a>
                    <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
        </header>
        <!-- header -->
        <div class="breadcrumbs" id="breadcrumbs">
            @yield('breadcrumb')
        </div>
        <!-- Content -->
        <div class="content" id="content">
            <div class="animated fadeIn">
                @yield('content')
            </div>
        </div>
        <!-- content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        <!-- Copyright &copy; 2018 Ela Admin -->
                    </div>
                    <div class="col-sm-6 text-right">
                        <!-- Designed by <a href="https://colorlib.com">Colorlib</a> -->
                    </div>
                </div>
            </div>
        </footer>
        <!-- site-footer -->
    </div>
    <!-- right-panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

    <!-- Chartist Chart -->
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
    <script src="assets/js/init/weather-init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
    <script src="assets/js/init/fullcalendar-init.js"></script>

    <!-- Datatables -->
    <script src="assets/js/lib/data-table/datatables.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/jszip.min.js"></script>
    <script src="assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="assets/js/init/datatables-init.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
        $('#bootstrap-data-table-export').DataTable();
    } );
    </script>

    @yield('scripts')
</body>
</html>
