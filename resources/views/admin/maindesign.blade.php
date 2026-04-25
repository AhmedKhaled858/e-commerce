<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dark Bootstrap Admin </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="admin/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="admin/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="admin/css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="admin/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="admin/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="admin/img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
    <header class="header">
        <nav class="navbar navbar-expand-lg">
            <div class="search-panel">
                <div class="search-inner d-flex align-items-center justify-content-center">
                    <div class="close-btn">Close <i class="fa fa-close"></i></div>
                    <form id="searchForm" action="{{ route('search') }}" method="GET" class="search-form">
                        <div class="form-group">
                            <input type="search" name="search" placeholder="What are you searching for...">
                            <button type="submit" class="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="container-fluid d-flex align-items-center justify-content-between">
                <div class="navbar-header">
                    <!-- Navbar Header--><a href="index.html" class="navbar-brand">
                        <div class="brand-text brand-big visible text-uppercase"><strong
                                class="text-primary">Dark</strong><strong>Admin</strong></div>
                        <div class="brand-text brand-sm"><strong class="text-primary">D</strong><strong>A</strong></div>
                    </a>
                    <!-- Sidebar Toggle Btn-->
                    <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
                </div>
                <div class="right-menu list-inline no-margin-bottom">
                    <div class="list-inline-item"><a href="#" class="search-open nav-link"><i
                                class="icon-magnifying-glass-browser"></i></a></div>
                    <div class="list-inline-item dropdown"><a id="navbarDropdownMenuLink1" href="http://example.com"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            class="nav-link messages-toggle"><i class="icon-email"></i><span
                                class="badge dashbg-1">5</span></a>
                        <div aria-labelledby="navbarDropdownMenuLink1" class="dropdown-menu messages"><a href="#"
                                class="dropdown-item message d-flex align-items-center">
                                <div class="profile"><img src="admin/img/avatar-3.jpg" alt="..." class="img-fluid">
                                    <div class="status online"></div>
                                </div>
                                <div class="content"> <strong class="d-block">Nadia Halsey</strong><span
                                        class="d-block">lorem ipsum dolor sit amit</span><small
                                        class="date d-block">9:30am</small></div>
                            </a><a href="#" class="dropdown-item message d-flex align-items-center">
                                <div class="profile"><img src="admin/img/avatar-2.jpg" alt="..." class="img-fluid">
                                    <div class="status away"></div>
                                </div>
                                <div class="content"> <strong class="d-block">Peter Ramsy</strong><span
                                        class="d-block">lorem ipsum dolor sit amit</span><small
                                        class="date d-block">7:40am</small></div>
                            </a><a href="#" class="dropdown-item message d-flex align-items-center">
                                <div class="profile"><img src="admin/img/avatar-1.jpg" alt="..." class="img-fluid">
                                    <div class="status busy"></div>
                                </div>
                                <div class="content"> <strong class="d-block">Sam Kaheil</strong><span
                                        class="d-block">lorem ipsum dolor sit amit</span><small
                                        class="date d-block">6:55am</small></div>
                            </a><a href="#" class="dropdown-item message d-flex align-items-center">
                                <div class="profile"><img src="admin/img/avatar-5.jpg" alt="..." class="img-fluid">
                                    <div class="status offline"></div>
                                </div>
                                <div class="content"> <strong class="d-block">Sara Wood</strong><span
                                        class="d-block">lorem ipsum dolor sit amit</span><small
                                        class="date d-block">10:30pm</small></div>
                            </a><a href="#" class="dropdown-item text-center message"> <strong>See All Messages
                                    <i class="fa fa-angle-right"></i></strong></a></div>
                    </div>



                    <!-- Languages dropdown    -->
                    <div class="list-inline-item dropdown"><a id="languages" rel="nofollow" data-target="#"
                            href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            class="nav-link language dropdown-toggle"><img src="admin/img/flags/us_flag.jpg"
                                alt="English"><span class="d-none d-sm-inline-block">English</span></a>
                        <div aria-labelledby="languages" class="dropdown-menu"><a rel="nofollow" href="#"
                                class="dropdown-item"> <img src="admin/img/flags/germany_flag.jpg" alt="English"
                                    class="mr-2"><span>German</span></a><a rel="nofollow" href="#"
                                class="dropdown-item"> <img src="admin/img/flags/french_flag.jpg" alt="English"
                                    class="mr-2"><span>French </span></a></div>
                    </div>
                    <!-- Log out               -->
                    <div class="list-inline-item logout"> 
                         <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                                  <i class="icon-logout"></i>
                            </x-dropdown-link>
                            
                        </form>
                        </div>
                </div>
            </div>
        </nav>
    </header>
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        <nav id="sidebar">
            <!-- Sidebar Header-->
            <div class="sidebar-header d-flex align-items-center">
                <div class="avatar"><img src="admin/img/avatar-6.jpg" alt="..."
                        class="img-fluid rounded-circle"></div>
                <div class="title">
                    <h1 class="h5">{{ Auth::user()->name }}</h1>
                    <p>E-commerce</p>
                </div>
            </div>
           <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
                     <li class="active"><a href="{{ route('dashboard') }}"> <i class="icon-home"></i>Home </a></li>
                      <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Category </a>
                  <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="{{ route('admin.createCategory') }}">Create Category</a></li>
                    <li><a href="{{ route('admin.listCategories') }}">List Categories</a></li>
                  </ul>
                </li>
                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Product </a>
                  <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="{{ route('admin.addProduct') }}">Add Product</a></li>
                    <li><a href="{{ route('admin.ViewProducts') }}">View Products</a></li>
                    <li><a href="#">View Order</a></li>
                  </ul>
                </li>
               
            
        </ul><span class="heading">Extras</span>
        <ul class="list-unstyled">
          <li> <a href="#"> <i class="icon-settings"></i>Demo </a></li>
          <li> <a href="#"> <i class="icon-writing-whiteboard"></i>Demo </a></li>
          <li> <a href="#"> <i class="icon-chart"></i>Demo </a></li>
        </ul>
      </nav>
      <!-- Sidebar Navigation end-->
        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">Dashboard</h2>
                </div>
            </div>
            <section class="no-padding-top no-padding-bottom">
                @yield('dashboard')
                @yield('analysis')
                @yield('listcategory')
                @yield('createcategory')
                @yield('addproduct')
                @yield('viewproducts')
                @yield('searchresults')
            </section>

            <section>
             
            </section>
            <footer class="footer">
                <div class="footer__block block no-margin-bottom">
                    <div class="container-fluid text-center">
                        <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                        <p class="no-margin-bottom">2018 &copy; Your company. Download From <a target="_blank"
                                href="https://templateshub.net">Templates Hub</a>.</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- JavaScript files-->
    <script src="admin/vendor/jquery/jquery.min.js"></script>
    <script src="admin/vendor/popper.js/umd/popper.min.js"></script>
    <script src="admin/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="admin/vendor/jquery.cookie/jquery.cookie.js"></script>
    <script src="admin/vendor/chart.js/Chart.min.js"></script>
    <script src="admin/vendor/jquery-validation/jquery.validate.min.js"></script>
    {{-- <script src="admin/js/charts-home.js"></script> --}}
    <script src="admin/js/front.js"></script>

    <script>
        $('.dropdown-item').on('click', function(e) {
    // منع الصفحة إنها تعمل Refresh لو اللينك فيه #
    e.preventDefault();

    // 1. جلب بيانات اللغة اللي اتداس عليها
    var newImg = $(this).find('img').attr('src');
    var newText = $(this).find('span').text();

    // 2. تحديث الزرار الرئيسي (العلم والنص)
    $('#languages img').attr('src', newImg);
    $('#languages span').text(newText);
});
    </script>
</body>

</html>
