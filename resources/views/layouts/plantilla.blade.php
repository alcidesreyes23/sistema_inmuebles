<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">

    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css2/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
    <!-- endinject -->

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;300&display=swap" rel="stylesheet">
    <!-- DATA TABLES CSS-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">

    <!-- TOAST CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="">
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css" integrity="sha256-SMGbWcp5wJOVXYlZJyAXqoVWaE/vgFA5xfrH3i/jVw0=" crossorigin="anonymous" />
    <style>
    .ui-datepicker-calendar {
    display: none;
    }
</style>
    @yield('css')
</head>

<body>
    <div class="container-scroller">
        <!--Top Navbar -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="{{ route('index') }}"><img src="images/logo.svg"
                        class="mr-2" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
                <div class="dropdown">
                    <button type="button" class="btn btn-light dropdown-toggle" id="dropdownMenuIconButton7"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ti-user"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton7" style="">
                        <h6 class="dropdown-header">Usuario: {{ auth()->user()->rol }} </h6>
                        <a class="dropdown-item" href="#"><span
                                class="menu-title">{{ auth()->user()->name }}</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm font-weight-bold">
                                    Log Out
                                </button>
                            </form>
                        </a>
                    </div>
                </div>
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        <div class="container-fluid page-body-wrapper">
            <!--LeftNavBar -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                    </li>

                    @if (auth()->user()->rol == 'Admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('personas.index') }}">
                                <i class="icon-grid menu-icon"></i>
                                <span class="menu-title">Registro de Usuarios</span>
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('properties.index') }}">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Gestion de inmuebles</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('citizens.index') }}">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Gestion de ciudadanos</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pagos.index') }}">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Pagos Propiedades</span>
                        </a>
                    </li>

                    @if (auth()->user()->rol == 'Admin')
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                                aria-controls="ui-basic">
                                <i class="icon-layout menu-icon"></i>
                                <span class="menu-title">Catalogos</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-basic">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('taxtypes.index') }}">Tributo/categorias</a></li>
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('tax.index') }}">Tributos</a></li>
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('subdivisiontax.index') }}">Subdivision tributos</a></li>
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('propertytype.index') }}">Propiedades/categorias</a></li>
                                    <li class="nav-item"> <a class="nav-link"
                                            href="{{ route('suburb.index') }}">Colonias</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('binnacle.index') }}">
                                <i class="icon-grid menu-icon"></i>
                                <span class="menu-title">Registro de Bitacora</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
            <!-- Contenido para para Page -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- Content -->
                    @yield('content')
                </div>
                <!-- Footer -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.
                            Módulo Inmuebles DWUSL-DS39A</span>
                        <span class="float-none text-muted float-sm-right d-block mt-1 mt-sm-0 text-center">
                            Created By: Erick Alcides Reyes Avila & Angel Sebastian Saravia Serpas
                        </span>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <!-- plugins:js -->
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('js2/off-canvas.js') }}"></script>
    <script src="{{ asset('js2/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js2/template.js') }}"></script>
    <script src="{{ asset('js2/settings.js') }}"></script>
    <script src="{{ asset('js2/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('js2/dashboard.js') }}"></script>
    <script src="{{ asset('js2/Chart.roundedBarCharts.js') }}"></script>
    <!-- End custom js for this page-->

    <!-- SweetAlert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!--iMask-->
    <script src="https://unpkg.com/imask"></script>
    <!-- Jquery Mask -->
    <script src="https://cdnjs.com/libraries/jquery.mask"></script>

    <!-- TOAST JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- DATA TABLE JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js" integrity="sha512-RCgrAvvoLpP7KVgTkTctrUdv7C6t7Un3p1iaoPr1++3pybCyCsCZZN7QEHMZTcJTmcJ7jzexTO+eFpHk4OCFAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @yield('js')
</body>

</html>
