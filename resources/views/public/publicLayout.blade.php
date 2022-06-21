<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui">
    <title> Shop</title>
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link href="//fonts.googleapis.com/css?family=Roboto:100,300,300italic,400,500,700,900%7CRoboto+Condensed:400,700&amp;subset=latin,latin" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('public')}}/assets/css/extras.min.css">
    <style type="text/css" media="screen">
        .section-upper-footer {
            display: none;
        }
    </style>
    <link rel="stylesheet" href="{{asset('public')}}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('public')}}/assets/css/theme.min.css">
    <link rel="stylesheet" href="{{asset('public')}}/assets/css/shop.min.css">
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('public')}}/assets/images/favicons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('public')}}/assets/images/favicons/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('public')}}/assets/images/favicons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('public')}}/assets/images/favicons/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('public')}}/assets/images/favicons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('public')}}/assets/images/favicons/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('public')}}/assets/images/favicons/apple-touch-icon-144x144.png">
    <link rel="icon" type="image/png" href="{{asset('public')}}/assets/images/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="{{asset('public')}}/assets/images/favicons/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="{{asset('public')}}/assets/images/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="shortcut icon" href="{{asset('public')}}/assets/images/favicons/favicon.ico">
    @yield('css')
</head>
<body class="pace-on pace-dot">
<div class="pace-overlay"></div>
@include('public.topBarPublicLayout')
@include('public.menuPublicLayout')
<div id="content" role="main">
    @yield('content')
    <section class="section">
        <div class="background-overlay" style="background-color: rgba(240,240,240,1);"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-right element-top-100 element-bottom-100 normal regular">

                    </h1>
                </div>
            </div>
        </div>
    </section>
    <footer id="footer">
        <section class="section">
            <div class="container">
                <div class="row element-top-40 element-bottom-40 footer-columns-4">
                    <div class="col-sm-3 pull-right">
                        <div class="sidebar-widget widget_text" id="text-15">
                            <h3 class="sidebar-header">تماس با ما</h3>
                            <div class="textwidget"> <address>
                                    گیلان - رشت - گلسار - چهار راه دیلمان
                                </address> </div>
                        </div>
                        <div class="sidebar-widget widget_social">
                            <ul class="unstyled inline social-icons social-simple social-normal">
                                <li> <a href=""><i class="fa fa-twitter"></i></a> </li>
                                <li> <a href=""><i class="fa fa-facebook"></i></a> </li>
                                <li> <a href=""><i class="fa fa-linkedin"></i></a> </li>
                                <li> <a href=""><i class="fa fa-google-plus"></i></a> </li>
                                <li> <a href=""><i class="fa fa-youtube"></i></a> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 pull-right">
                        <div class="sidebar-widget widget_text">
                            <h3 class="sidebar-header">درباره ما</h3>
                            <div class="textwidget">
                                <p>بچه های زرنگ <strong>پل استار</strong> قصد دارند تا لاراول را یاد بگیرند.</p>
                                <p>تا آینده طراحی و توسعه سایت از آن <strong>بچه های نابغه پل استار </strong> باشد .</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 pull-right">
                        <div class="sidebar-widget woocommerce widget_product_tag_cloud">
                            <h3 class="sidebar-header">تگ های محصولات</h3>
                            <div class="tagcloud">
                                <ul>
                                    @foreach(\App\Models\Tool::getAllTag() as $tag)
                                    <li><a href='{{route('categories.edit',$tag->id)}}'>{{$tag->label}}</a> </li>
                                        @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="sidebar-widget widget_text" id="text-11">
                            <h3 class="sidebar-header">پرداخت</h3>
                            <div class="textwidget">کلیه تراکنش های موجود در این سایت از طریق ID Pay صورت می گیرد و به صورت آزمایشی می باشد.</div>
                        </div>
                        <div class="sidebar-widget widget_social">
                            <ul class="unstyled inline social-icons social-simple social-normal">
                                <li> <a data-iconcolor="#3b9999" href=""><i class="fa fa-cc-amex"></i></a> </li>
                                <li> <a data-iconcolor="#3b9999" href=""><i class="fa fa-paypal"></i></a> </li>
                                <li> <a data-iconcolor="#3b9999" href=""><i class="fa fa-bank"></i></a> </li>
                                <li> <a data-iconcolor="#3b9999" href=""><i class="fa fa-cc-mastercard"></i></a> </li>
                                <li> <a data-iconcolor="#3b9999" href=""><i class="fa fa-google-wallet"></i></a> </li>
                                <li> <a data-iconcolor="#3b9999" href=""><i class="fa fa-credit-card"></i></a> </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section subfooter">
            <div class="container">
                <div class="row element-top-10 element-bottom-10 footer-columns-2">
                    <div style="text-align: center">
                        <div class="sidebar-widget widget_text">
                            <div class="textwidget"> نمونه طراحی شده برگرفته از Lamda Wordpress theme بوده و جهت آموزش دوره لاراول مجموعه پل استار می باشد </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </footer>
</div>

<a class="go-top go-top-square" href="javascript:void(0)"> <i class="fa fa-angle-up"></i> </a>
<script type="text/javascript">
    var oxyThemeData = {
        navbarHeight: 130,
        navbarScrolled: 120,
        navbarScrolledPoint: 200,
        menuClose: 'off',
        scrollFinishedMessage: 'No more items to load.',
        hoverMenu:
            {
                hoverActive: true,
                hoverDelay: 200,
                hoverFadeDelay: 200
            },
        siteLoader: 'on'
    };
</script>
<script src="{{asset('public')}}/assets/js/theme.min.js"></script>
    @yield('script')
</body>

</html>