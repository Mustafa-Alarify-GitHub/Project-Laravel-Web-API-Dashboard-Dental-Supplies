<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dental-Supplies</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    <link rel="stylesheet"
        href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
</head>

<body>
    <div class="container-scroller">
        <!-- Header -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">

            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="/"><img src="{{ asset('assets/images/logo.png') }}"
                        alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="/"><img src="{{ asset('assets/images/logo-mini.png') }}"
                        alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <div class="search-field d-none d-xl-block">
                    @yield('search')
                </div>
                <ul class="navbar-nav navbar-nav-right">



                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown"
                            aria-expanded="false">
                            <div class="nav-profile-img">
                                <img src="{{ asset( Auth()->user()->image ) }}" alt="image">
                            </div>
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black">{{ Auth()->user()->name }}</p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm"
                            aria-labelledby="profileDropdown" data-x-placement="bottom-end">
                            <div class="p-3 text-center bg-primary">
                                <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{ asset(Auth()->user()->image) }}"
                                    alt="">
                            </div>
                            <div class="p-2">
                                <h5 class="dropdown-header text-uppercase pl-2 text-dark">{{ Auth()->user()->name }}</h5>
                                
                                <a class="dropdown-item py-1 d-flex align-items-center justify-content-between"
                                    href="{{ route('Profile.index') }}">
                                    <span>Settings Profile</span>
                                    <i class="mdi mdi-settings"></i>
                                </a>
                                <div role="separator" class="dropdown-divider"></div>
                                <h5 class="dropdown-header text-uppercase  pl-2 text-dark mt-2">Actions</h5>
                                
                                <form action="{{ route('logout') }}" method="post">
                                    @method('post')
                                    @csrf
                                    <button type="submit"
                                        class="dropdown-item py-1 d-flex align-items-center justify-content-between"
                                        href="#">
                                        <span>Log Out</span>
                                        <i class="mdi mdi-logout ml-1"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                   
                    @if (Auth()->user()->type == 'Master Admin')
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" 
                         href="{{ route('join') }}"
                            >
                            <i class="mdi mdi-bell-outline"></i>
                            <span class="count-symbol bg-danger"></span>
                        </a>
                        
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" 
                         href="{{ route('Product') }}"
                            >
                            <i class="mdi mdi-email-outline"></i>
                            <span class="count-symbol bg-danger"></span>
                        </a>
                        
                    </li>
                    @endif

                    
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>



        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">


                    <li class="nav-item nav-category">Dashboard</li>


                    <li class="nav-item">
                        <a class="nav-link" href="/">
                            <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                            <span class="menu-title">Home</span>
                        </a>
                    </li>
                    @if (Auth()->user()->type == 'Master Admin')
                        <li class="nav-item nav-category">Users</li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('Supplier') }}">
                                <span class="icon-bg"><i class="mdi mdi-account-multiple-outline"></i></span>
                                <span class="menu-title">Supplier </span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('Clinic') }}">
                                <span class="icon-bg"><i class="mdi mdi-account-multiple-outline"></i></span>
                                <span class="menu-title">Clinic</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('Balance.index') }}">
                                <span class="icon-bg"><i class="mdi mdi-cisco-webex"></i></span>
                                <span class="menu-title">Balance</span>
                            </a>
                        </li>



                        <li class="nav-item nav-category">Product</li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('Hero.index') }}">
                                <span class="icon-bg"><i class="mdi mdi-account-multiple-outline"></i></span>
                                <span class="menu-title">Hero </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('product.index') }}">
                                <span class="icon-bg"><i class="mdi mdi-account-multiple-outline"></i></span>
                                <span class="menu-title">All Product</span>
                            </a>
                        </li> 
                        @endif
                    
                    @if (Auth()->user()->type == 'Admin Provider')
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('Employ.index') }}">
                            <span class="icon-bg"><i class="mdi mdi-account-multiple-outline"></i></span>
                            <span class="menu-title">Employs</span>
                        </a>
                    </li> 
                  
                    
                    @else @endif
                    
                        <li class="nav-item
        nav-category">Others</li>



    <li class="nav-item sidebar-user-actions">
        <div class="sidebar-user-menu">
            <form action="{{ route('logout') }}" method="post">

                @method('post')
                @csrf
                <button type="submit" style="background: transparent;border: none">

                    <a class="nav-link">
                        <i class="mdi mdi-logout menu-icon"></i>
                        <span class="menu-title">Log Out</span>
                    </a>
                </button>
            </form>
        </div>
    </li>
    </ul>
    </nav>
    <!-- Content -->
    @yield('content')
    <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->














    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/jquery-circle-progress/js/circle-progress.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
    </body>

</html>
