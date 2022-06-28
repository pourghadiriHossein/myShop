@extends('public.publicLayout')
@section('content')
<article>
    <section class="section">
        <div class="background-overlay grid-overlay-0 " style="background-color: rgba(240,240,240,1);"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-right element-top-30 element-bottom-30 text-normal normal regular" data-os-animation="none" data-os-animation-delay="0s">
                    نمایش محصولات
                </h1> </div>
            </div>
        </div>
    </section>
    <section class="section section-commerce">
        <div class="container element-top-50 element-bottom-50">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <form role="search" method="get" id="searchform">
                                <div class="input-group">
                                    <input type="text" value name="s" class="form-control" placeholder="محصول مورد نظر خود را وارد کنید"> <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit" id="searchsubmit" value="">
                                    <i class="fa fa-search"></i>
                                    </button>
                                    <input type="hidden" name="post_type" value="product">
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 text-left">
                        <p class="woocommerce-result-count pull_right"> تعداد کل محصول: {{count($allProducts)}} </p>
                        <form class="woocommerce-ordering" method="get">
                            <select name="orderby" class="orderby">
                                <option value="menu_order" selected='selected'>جدید ترین</option>
                                <option value="popularity">قدیمی ترین</option>
                                <option value="rating">ارزان ترین</option>
                                <option value="date">گران ترین</option>
                            </select>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <ul class="products list-container">
                        @foreach($allProducts as $product)
                        <li class="product col-md-4 sale pull-right">
                            @if($product->discount_id) <span class="onsale">تخفیف</span> @endif
                                <a href="{{route('singleProduct',[$product->id,\App\Models\Tool::readyToUrl($product->label)])}}">
                                    <div class="product-image">
                                        <div class="product-image-front"> <img width="700" height="893" src="@if($product->productImages[0]){{asset($product->productImages[0]->path)}}@endif" alt="skirt4-1" /> </div>
                                        <div class="product-image-back"> <img src="@if($product->productImages[1]){{asset($product->productImages[1]->path)}}@endif" alt="" /> </div>
                                        <div class="product-image-overlay">
                                        <h4>جزئیات</h4> </div>
                                    </div>
                                </a>
                            <div class="product-info">
                                <h3 class="product-title">
                                <a href="{{route('singleProduct',[$product->id,\App\Models\Tool::readyToUrl($product->label)])}}">@if($product->label){{$product->label}}@endif</a>
                                </h3> <span class="product-categories">
                                    @if($product->tags)
                                        @foreach($product->tags as $tag)
                                            <a href="{{route('categories.edit',$tag->id)}}" rel="tag">{{$tag->label}}</a>,
                                        @endforeach
                                    @endif
                                </span>
                                <h3 class="price">
                                @if($product->discount_id)
                                <del>
                                <span class="amount">{{$product->price}} ریال</span>
                                </del>
                                <ins>
                                <span class="amount">
                                    {{\App\Models\Tool::calculateDiscount($product->price,$product->discount->price,$product->discount->percent)}}
                                ریال</span>
                                </ins>
                                @else
                                <ins>
                                <span class="amount">{{$product->price}} ریال</span>
                                </ins>
                                @endif
                                </h3>
                                <a href="{{route('session',[$product->id,1,'add'])}}" rel="nofollow" class="add-to-cart-button add_to_cart_button product_type_simple">
                                    <i class="icon-bag"></i></a> </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                {{--side--}}
                <div class="col-md-3">
                    <div class="sidebar-widget">
                        <form role="search" method="get" id="searchform">
                            <div class="input-group">
                                <ol class="breadcrumb">
                                    <li><a class="home" href="{{ route('publicHome') }}">خانه</a></li>
                                    @if($tag)
                                        <li><a class="category" href="{{ route('categories.edit',$tag->id) }}">{{$tag->label}}</a></li>
                                    @else
                                        @if(!$categories)
                                            <li><a class="category" href="">تمام محصولات</a></li>
                                        @else
                                            @foreach($categories as $category)
                                                @if($category->parent_id != null)
                                                    <li><a class="category" href="{{ route('categories.show',$category->parent->id) }}">{{$category->parent->label}}</a></li>
                                                @endif
                                            <li><a class="category" href="{{ route('categories.show',$category->id) }}">{{$category->label}}</a></li>
                                            @endforeach
                                        @endif
                                    @endif
                                </ol>
                            </div>
                        </form>
                    </div>
                    <div class="sidebar-widget">
                        <h3 class="sidebar-header">جدید ترین محصولات مردانه</h3>
                        <ul class="product_list_widget">
                            @foreach($newestMenProducts as $newestMenProduct)
                            <li>
                                <a href="{{route('singleProduct',[$newestMenProduct->id,\App\Models\Tool::readyToUrl($newestMenProduct->label)])}}" title="@if($newestMenProduct->label){{$newestMenProduct->label}}@endif">
                                <img width="90" height="114" src="@if($newestMenProduct->productImages[0]->path){{ asset($newestMenProduct->productImages[0]->path) }}@endif" alt="shirt2-1" />@if($newestMenProduct->label){{$newestMenProduct->label}}@endif</a>
                                @if($newestMenProduct->discount_id)
                                    <del><span class="amount">{{$newestMenProduct->price}} ریال</span></del>
                                    <br/>
                                    <span class="amount">{{\App\Models\Tool::calculateDiscount($newestMenProduct->price,$newestMenProduct->discount->price,$newestMenProduct->discount->percent)}} ريال</span> </li>
                                @else
                                    <span class="amount">@if($newestMenProduct->price){{$newestMenProduct->price}} ريال@endif</span> </li>
                                @endif
                            @endforeach
                            </ul>
                        </div>
                        <div class="sidebar-widget">
                            <h3 class="sidebar-header">جدید ترین محصولات زنانه</h3>
                            <ul class="product_list_widget">
                                @foreach($newestWomenProducts as $newestWomenProduct)
                            <li>
                                <a href="{{route('singleProduct',[$newestWomenProduct->id,\App\Models\Tool::readyToUrl($newestWomenProduct->label)])}}" title="@if($newestWomenProduct->label){{$newestWomenProduct->label}}@endif">
                                <img width="90" height="114" src="@if($newestWomenProduct->productImages[0]->path){{ asset($newestWomenProduct->productImages[0]->path) }}@endif" alt="shirt2-1" />@if($newestWomenProduct->label){{$newestWomenProduct->label}}@endif</a>
                                @if($newestWomenProduct->discount_id)
                                    <del><span class="amount">{{$newestWomenProduct->price}} ریال</span></del>
                                    <br/>
                                    <span class="amount">{{\App\Models\Tool::calculateDiscount($newestWomenProduct->price,$newestWomenProduct->discount->price,$newestWomenProduct->discount->percent)}} ريال</span> </li>
                                    @else
                                        <span class="amount">@if($newestWomenProduct->price){{$newestWomenProduct->price}} ريال@endif</span> </li>
                                    @endif
                                @endforeach
                                        </ul>
                                    </div>
                                    <div class="sidebar-widget woocommerce widget_product_tag_cloud">
                                        <h3 class="sidebar-header">تگ ها</h3>
                                        <div class="tagcloud">
                                            <ul>
                                                @foreach(\App\Models\Tool::getAllTag() as $tag)
                                                <li><a href='{{route('categories.edit',$tag->id)}}'>{{ $tag->label }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </article>
                @endsection
