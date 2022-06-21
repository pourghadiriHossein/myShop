<div class="menu navbar navbar-static-top header-logo-center-menu-below oxy-mega-menu text-caps" id="masthead">
    <div class="logo-navbar container-logo">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle collapsed" data-target=".main-navbar" data-toggle="collapse" type="button"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <a class="navbar-brand" href="shop-index.html"> <img alt="Lambda Theme - Shop" src="{{asset('public')}}/assets/images/shop/lambda-shop.png"> </a>
                <div class="logo-sidebar"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="nav-container clearfix">
            <nav class="collapse navbar-collapse main-navbar">
                <div class="menu-container">
                    <ul class="nav navbar-nav" id="menu-main">
                        <li class="menu-item dropdown active "> <a href="{{route('publicHome')}}">خانه</a>
                        </li>
                        @foreach(\App\Models\Tool::getAllCategories() as $category)
                        <li class="menu-item dropdown"> <a href="{{route('categories.show',$category->id)}}">{{ $category->label }}</a>
                            <ul class="dropdown-menu dropdown-menu-right ">
                                @foreach($category->subCategories as $subCategory)
                                <li class="menu-item"> <a href="{{route('categories.show',$subCategory->id)}}">{{ $subCategory->label }}</a> </li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                        <li class="menu-item"> <a href="{{route('publicContact')}}">تماس با ما</a> </li>
                        <li class="menu-item"> <a href="{{route('publicTC')}}">قوانین و مقررات</a> </li>
                        <li class="menu-item"> <a href="{{route('publicFAQ')}}">سوالات متداول</a> </li>
                    </ul>
                </div>
                <div class="menu-sidebar">
                    <div class="sidebar-widget widget_shopping_cart">
                        <h3 class="sidebar-header">سبد خرید</h3>
                        @if(empty(\Illuminate\Support\Facades\Session::get('basket')))
                            <div class="widget_shopping_cart_content">
                                <div class="mini-cart-overview dropdown navbar-right">
                                    <a data-toggle="dropdown"> <i class="icon icon-bag animated pulse-two"></i> <span class="mini-cart-count">0</span>
                                        <span class="amount">0 ريال</span> </a>
                                    <ul class="dropdown-menu product_list_widget">
                                        <li>
                                            <p class="total"><strong>جمع کل:</strong> <span class="amount">0 ريال</span></p>
                                        </li>
                                    </ul>
                                    <!-- end product list -->
                                </div>
                            </div>
                        @else
                            @php($baskets = \App\Models\Tool::getBasket())
                            <div class="widget_shopping_cart_content">
                            <div class="mini-cart-overview dropdown navbar-right">
                                <a data-toggle="dropdown"> <i class="icon icon-bag animated pulse-two"></i> <span class="mini-cart-count">{{count($baskets)}}</span>
                                    <span class="amount">{{\App\Models\Tool::calculateCart()}} ريال</span> </a>
                                <ul class="dropdown-menu product_list_widget">
                                    @foreach($baskets as $basket)
                                    <li>
                                        <div class="product-mini">
                                            <div class="product-image">
                                                <a href="{{route('singleProduct',[$basket[0]->id,\App\Models\Tool::readyToUrl($basket[0]->label)])}}">
                                                    <img alt="hoodie1-1" height="114" src="{{asset($basket[0]->productImages[0]->path)}}" width="90"> </a>
                                            </div>
                                            <div class="product-details">
                                                <h4 class="product-details-heading"><a href="{{route('singleProduct',[$basket[0]->id,\App\Models\Tool::readyToUrl($basket[0]->label)])}}">{{$basket[0]->label}}</a></h4>
                                                <p></p>
                                                <p><span class="quantity">{{$basket[1]}} × <span class="amount">{{$basket[0]->price}} ريال</span></span>
                                                </p><a class="remove" href="{{route('session',[$basket[0]->id,$basket[1],'remove'])}}" title="Remove this item">×</a> </div>
                                        </div>
                                    </li>
                                        @endforeach
                                    <li>
                                        <p class="total"><strong>جمع کل:</strong> <span class="amount">{{\App\Models\Tool::calculateCart()}} ريال</span></p>
                                        <div class="buttons"> <a href="{{route('cartIndex')}}" }}>پرداخت</a> </div>
                                    </li>
                                </ul>
                                <!-- end product list -->
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
