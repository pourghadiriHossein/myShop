<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="" />
    <meta name="description" content="">
    <meta name="author" content="Hossein Pourghadiri">
    <title></title>
    <!-- Bootstrap core CSS -->
    <link rel="shortcut icon" href="">

    <link href="{{asset('admin')}}/css/bootstrap-slider.css" rel="stylesheet">
    <link href="{{asset('admin')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('admin')}}/css/bootstrap-reset.css" rel="stylesheet">
    <link href="{{asset('admin')}}/js/bootstrap-datepicker.min.css" rel="stylesheet">

    <!--external css-->
    <link href="{{asset('admin')}}/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="{{asset('admin')}}/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('admin')}}/css/owl.carousel.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template -->
    <link href="{{asset('admin')}}/css/style.css" rel="stylesheet">
    <link href="{{asset('admin')}}/css/style-responsive.css" rel="stylesheet" />

    <script src="{{asset('admin')}}/js/jquery.js"></script>
    <script src="{{asset('admin')}}/js/jquery-1.8.3.min.js"></script>
    @yield('css')

</head>

<body>

<section id="container" class="">
    <!--header start-->
    <header class="header white-bg">
        <div class="sidebar-toggle-box">
            <div data-original-title="برای باز و بسته شدن منو کلیک کنید" data-placement="left" class="icon-reorder tooltips"></div>
        </div>
        <!--logo start-->
        <a href="#" class="logo">  مدیریت <span> SHOP</span></a>
        <!--logo end-->

        <div class="top-nav ">
            <ul class="nav pull-left top-menu">

                <li id="header_notification_bar" class="dropdown">
                    <a href="{{route('publicHome')}}">خانه</a>

                </li>

                <li class="dropdown">

                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="username">
                              @if (\Illuminate\Support\Facades\Auth::user()){{\Illuminate\Support\Facades\Auth::user()->name}}@endif
                            <b class="caret"></b>
                            <ul class="dropdown-menu extended logout">
                                <div class="log-arrow-up"></div>
                                <p></p>
                                <li><a href="{{route('logout')}}"><i class="icon-eject"></i> خروج</a></li>
                            </ul>
                        </span>
                    </a>

                </li>
            </ul>
        </div>

    </header>

    <aside>
        <div id="sidebar" class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu">
                <li @if(Route::currentRouteName() == 'adminVisitUser')
                    class="sub-menu active"
                    @elseif(Route::currentRouteName() == 'adminAddUser')
                    class="sub-menu active"
                    @elseif(Route::currentRouteName() == 'adminUpdateUser')
                    class="sub-menu active"
                    @else
                    class="sub-menu">
                    @endif
                >
                    <a href="javascript:;" class="">
                        <i class="icon-user"></i>
                        <span>کاربرها</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{route('adminVisitUser')}}" style="color: #f2f2f2">لیست کاربران</a></li>
                        <li><a href="{{route('adminAddUser')}}" style="color: #f2f2f2">افزودن کاربر</a></li>
                    </ul>
                </li>
                <li @if(Route::currentRouteName() == 'adminVisitPermission')
                    class="sub-menu active"
                    @elseif(Route::currentRouteName() == 'adminAddPermission')
                    class="sub-menu active"
                    @elseif(Route::currentRouteName() == 'adminUpdatePermission')
                    class="sub-menu active"
                    @elseif(Route::currentRouteName() == 'adminVisitRole')
                    class="sub-menu active"
                    @elseif(Route::currentRouteName() == 'adminAddRole')
                    class="sub-menu active"
                    @elseif(Route::currentRouteName() == 'adminUpdateRole')
                    class="sub-menu active"
                    @else
                    class="sub-menu"
                        @endif
                >
                    <a href="javascript:;" class="">
                        <i class="icon-ban-circle"></i>
                        <span>سطوح دسترسی</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li> <a href="{{route('adminVisitPermission')}}" style="color: #f2f2f2">مدیریت سطوح دسترسی</a></li>
                        <li> <a href="{{route('adminAddPermission')}}" style="color: #f2f2f2">افزودن سطح دسترسی</a></li>
                        <li> <a href="{{route('adminVisitRole')}}" style="color: #f2f2f2">مدیریت نقش</a></li>
                        <li> <a href="{{route('adminAddRole')}}" style="color: #f2f2f2">افزودن نقش</a></li>
                    </ul>
                </li>

                <li @if(Route::currentRouteName() == 'adminVisitCategory')
                    class="sub-menu active"
                    @elseif(Route::currentRouteName() == 'adminAddCategory')
                    class="sub-menu active"
                    @elseif(Route::currentRouteName() == 'adminAddParentCategory')
                    class="sub-menu active"
                    @elseif(Route::currentRouteName() == 'adminUpdateCategory')
                    class="sub-menu active"
                    @else
                    class="sub-menu"
                        @endif
                >
                    <a href="javascript:;" class="">
                        <i class="icon-user"></i>
                        <span>دسته بندی ها</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{route('adminVisitCategory')}}" style="color: #f2f2f2">لیست دسته ها</a></li>
                        <li><a href="{{route('adminAddCategory')}}" style="color: #f2f2f2">افزودن دسته</a></li>
                    </ul>
                </li>

                <li @if(Route::currentRouteName() == 'adminVisitTag')
                    class="sub-menu active"
                    @elseif(Route::currentRouteName() == 'adminAddTag')
                    class="sub-menu active"
                    @elseif(Route::currentRouteName() == 'adminUpdateTag')
                    class="sub-menu active"
                    @else
                    class="sub-menu"
                        @endif
                >
                    <a href="javascript:;" class="">
                        <i class="icon-archive"></i>
                        <span>تگ ها</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{route('adminVisitTag')}}" style="color: #f2f2f2">لیست تگ ها</a></li>
                        <li><a href="{{route('adminAddTag')}}" style="color: #f2f2f2">افزودن تگ</a></li>
                    </ul>
                </li>



                <li @if(Route::currentRouteName() == 'adminVisitDiscount')
                    class="sub-menu active"
                    @elseif(Route::currentRouteName() == 'adminAddDiscount')
                    class="sub-menu active"
                    @elseif(Route::currentRouteName() == 'adminUpdateDiscount')
                    class="sub-menu active"
                    @else
                    class="sub-menu"
                        @endif
                >
                    <a href="javascript:;" class="">
                        <i class="icon-user"></i>
                        <span>مدیریت تخفیف</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{route('adminVisitDiscount')}}" style="color: #f2f2f2">لیست تخفیف ها</a></li>
                        <li><a href="{{route('adminAddDiscount')}}" style="color: #f2f2f2">افزودن تخفیف</a></li>
                    </ul>
                </li>

                <li @if(Route::currentRouteName() == 'adminVisitProduct')
                        class="sub-menu active"
                        @elseif(Route::currentRouteName() == 'adminAddProduct')
                        class="sub-menu active"
                    @elseif(Route::currentRouteName() == 'adminUpdateProduct')
                    class="sub-menu active"
                        @else
                        class="sub-menu"
                        @endif
                >
                    <a href="javascript:;" class="">
                        <i class="icon-user"></i>
                        <span>محصولات</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{route('adminVisitProduct')}}" style="color: #f2f2f2">لیست محصولات</a></li>
                        <li><a href="{{route('adminAddProduct')}}" style="color: #f2f2f2">افزودن محصولات</a></li>
                    </ul>
                </li>

                <li @if(Route::currentRouteName() == 'adminVisitComment')
                        class="sub-menu active"
                        @elseif(Route::currentRouteName() == 'adminUpdateComment')
                        class="sub-menu active"
                        @else
                        class="sub-menu"
                        @endif
                >
                    <a href="javascript:;" class="">
                        <i class="icon-user"></i>
                        <span>نظر ها</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{ route('adminVisitComment') }}" style="color: #f2f2f2">لیست نظر ها</a></li>
                    </ul>
                </li>

                <li
                        @if(Route::currentRouteName() == 'adminVisitRegion')
                        class="sub-menu active"
                        @elseif(Route::currentRouteName() == 'adminAddRegion')
                        class="sub-menu active"
                        @elseif(Route::currentRouteName() == 'adminUpdateRegion')
                        class="sub-menu active"
                        @elseif(Route::currentRouteName() == 'adminVisitCity')
                        class="sub-menu active"
                        @elseif(Route::currentRouteName() == 'adminAddCity')
                        class="sub-menu active"
                        @elseif(Route::currentRouteName() == 'adminUpdateCity')
                        class="sub-menu active"
                        @elseif(Route::currentRouteName() == 'adminVisitZone')
                        class="sub-menu active"
                        @elseif(Route::currentRouteName() == 'adminAddZone')
                        class="sub-menu active"
                        @elseif(Route::currentRouteName() == 'adminUpdateZone')
                        class="sub-menu active"
                        @else
                        class="sub-menu"
                        @endif
                >
                    <a href="javascript:;" class="">
                        <i class="icon-user"></i>
                        <span>مدیریت شهر و استان</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{ route('adminVisitRegion') }}" style="color: #f2f2f2">لیست استان ها</a></li>
                        <li><a href="{{ route('adminAddRegion') }}" style="color: #f2f2f2">افزودن استان</a></li>
                        <li><a href="{{ route('adminVisitCity') }}" style="color: #f2f2f2">لیست شهر</a></li>
                        <li><a href="{{ route('adminVisitZone') }}" style="color: #f2f2f2">لیست نواحی</a></li>
                    </ul>
                </li>
                <li
                        @if(Route::currentRouteName() == 'adminVisitAddress')
                        class="sub-menu active"
                        @else
                        class="sub-menu"
                        @endif
                >
                    <a href="javascript:;" class="">
                        <i class="icon-user"></i>
                        <span>آدرس ها</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{ route('adminVisitAddress') }}" style="color: #f2f2f2">لیست آدرس ها</a></li>
                    </ul>
                </li>
                <li
                        @if(Route::currentRouteName() == 'adminVisitOrder')
                        class="sub-menu active"
                        @else
                        class="sub-menu"
                        @endif
                >
                    <a href="javascript:;" class="">
                        <i class="icon-user"></i>
                        <span>فاکتور ها</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{ route('adminVisitOrder') }}" style="color: #f2f2f2">لیست فاکتور ها</a></li>
                    </ul>
                </li>
                <li
                        @if(Route::currentRouteName() == 'adminVisitTransaction')
                        class="sub-menu active"
                        @else
                        class="sub-menu"
                        @endif
                >
                    <a href="javascript:;" class="">
                        <i class="icon-user"></i>
                        <span>تراکنش ها</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{ route('adminVisitTransaction') }}" style="color: #f2f2f2">لیست تراکنش ها</a></li>
                    </ul>
                </li>
                <li
                        @if(Route::currentRouteName() == 'adminVisitContact')
                        class="sub-menu active"
                        @else
                        class="sub-menu"
                        @endif
                >
                    <a href="javascript:;" class="">
                        <i class="icon-user"></i>
                        <span>تماس با ما</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{ route('adminVisitContact') }}" style="color: #f2f2f2">لیست تماس ها</a></li>
                    </ul>
                </li>

            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>

    @yield('content')

</section>

</body>

<script src="{{asset('admin')}}/js/bootstrap.min.js"></script>
<script src="{{asset('admin')}}/js/jquery.scrollTo.min.js"></script>
<script src="{{asset('admin')}}/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="{{asset('admin')}}/js/jquery.sparkline.js" type="text/javascript"></script>
<script src="{{asset('admin')}}/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
<script src="{{asset('admin')}}/js/owl.carousel.js" ></script>
<script src="{{asset('admin')}}/js/jquery.customSelect.min.js" ></script>

<!--common script for all pages-->
<script src="{{asset('admin')}}/js/common-scripts.js"></script>
<!--script for this page-->
<script src="{{asset('admin')}}/js/sparkline-chart.js"></script>
<script src="{{asset('admin')}}/js/easy-pie-chart.js"></script>
<script src="{{asset('admin')}}/js/bootstrap-select.js"></script>
@yield('script')
</html>