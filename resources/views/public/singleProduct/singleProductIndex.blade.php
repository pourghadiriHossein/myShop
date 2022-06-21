@extends('public.publicLayout')

@section('content')
    <article>
        <section class="section section-commerce">
            <div class="container element-top-50 element-bottom-50">
                <ol class="breadcrumb">
                    <li><a class="home" href="{{ route('publicHome') }}">خانه</a></li>
                        @foreach($categories as $category)
                            @if($category->parent_id != null)
                                <li><a class="category" href="{{ route('categories.show',$category->parent->id) }}">{{$category->parent->label}}</a></li>
                            @endif
                            <li><a class="category" href="{{ route('categories.show',$category->id) }}">{{$category->label}}</a></li>
                        @endforeach
                </ol>

                <div class="product">
                    <div class="row product-summary">
                        <div class="col-md-6">
                            <div class="product-images">
                                @if($product->discount_id)<span class="onsale">تخفیف</span>@endif
                                <div class="flexslider" data-flex-animation="slide" data-flex-controls="thumbnails" data-flex-controlsalign="left" data-flex-controlsposition="outside" data-flex-directions="hide" data-flex-directions-type="simple"
                                     data-flex-duration="600" data-flex-slideshow="true" data-flex-speed="7000" id="product-images">
                                    <ul class="slides product-gallery">
                                        <li>
                                            <figure> <img alt="Top Fancy" src="{{asset($product->productImages[0]->path)}}">
                                                <figcaption>
                                                    <h4><a href="{{asset($product->productImages[0]->path)}}">بزرگ نمایی</a></h4> </figcaption>
                                            </figure>
                                        </li>
                                        <li >
                                            <figure>
                                                <img alt="Top Fancy" src="">
                                            </figure>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="summary entry-summary">
                                <h1 class="product-title bordered">{{$product->label}}</h1>
                                <div>
                                    <p class="price price-big">
                                        @if($product->discount_id)
                                            <del><span class="amount">{{$product->price}} ريال</span></del>
                                            <ins><span class="amount">{{\App\Models\Tool::calculateDiscount($product->price,$product->discount->price,$product->discount->percent)}} ريال</span></ins>
                                        @else
                                            <ins><span class="amount">{{$product->price}} ريال</span></ins>
                                        @endif
                                    </p>
                                </div>
                                <div class="description">
                                    <p>{{$product->label}}</p>
                                </div>
                                <form method="GET" action="{{route('session',[$product->id,'request','add'])}}">
                                <div class="quantity">
                                    <input onclick="decrement()" type="button" value="-" class="minus">
                                    <input id="demoInput" class="input-text qty text" min="1" name="quantity" step="1" title="demoInput" type="number" value="1">
                                    <input onclick="increment()" type="button" value="+" class="plus">
                                    
                                </div>
                                <button class="single_add_to_cart_button button alt" type="submit">افزودن به سبد خرید</button>
                                </form>
                                <div class="product_meta">
                                    <span class="posted_in">دسته بندی:
                                    <a href="{{route('categories.show',$product->category->id)}}" rel="tag">{{$product->category->label}}</a>
                                </span>
                                    <span class="tagged_as">تگ ها:
                                    @if($product->product_tag_id) <a href="{{route('categories.edit',$product->product_tag_id)}}" rel="tag">{{$product->productTag->label}}</a> @endif
                                </span> </div>

                            </div>
                        </div>
                    </div>
                    <!-- .summary -->
                    <div class="row single-product-extras">
                        <div class="col-md-12">
                            <div class="tabbable top">
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="active"> <a data-toggle="tab" href="#tab-description">توضیحات</a> </li>
                                    <li> <a data-toggle="tab" href="#tab-reviews">نظر ها (0)</a> </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-description">
                                        <h3>{{$product->label}}</h3>
                                        <p>{{$product->description}}</p>
                                    </div>
                                    <div class="tab-pane" id="tab-reviews">
                                        @if(\Illuminate\Support\Facades\Auth::user())
                                            <div class="row" id="reviews">
                                                <form action="{{route('postComment',$product->id)}}" class="comment-form" id="commentform" method="post" name="commentform">
                                                    {{csrf_field()}}
                                                    <div class="form-group">
                                                        <label for="comment">نظر شما</label>
                                                        <textarea class="form-control" id="comment" name="description" rows="4">{{old('description')}}</textarea>
                                                    </div>
                                                    <p class="form-submit">
                                                        <input class="btn btn-primary" id="submit" name="submit" type="submit" value="ارسال">
                                                        <input name='comment_post_ID' type='hidden' value='60'>
                                                        <input name='comment_parent' type='hidden' value='0'> </p>
                                                </form>
                                                <div class="clear"></div>
                                            </div>
                                            <hr>
                                            <br/>
                                        @endif
                                        @foreach($productComments as $productComment)
                                            <div class="row" id="reviews">
                                                <div class="col-md-12" id="comments">
                                                    <h3 style="padding-right: 100px;">{{$productComment->user->name}}</h3>
                                                    <div class="col-md-11" style="border: 3px ; border-style: ridge; height: auto">
                                                        {{$productComment->description}}
                                                    </div>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <br/>
                                            <br/>
                                            <br/>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="related products">
                        <h2>کالا های مرتبط</h2>
                        <div class="row">
                            <ul class="products list-container">
                                @foreach($newestProducts as $newestProduct)
                                    <li class="product col-md-4">
                                        @if($newestProduct->discount_id)<span class="onsale">تخفیف</span>@endif
                                            <a href="{{route('singleProduct',[$newestProduct->id,\App\Models\Tool::readyToUrl($newestProduct->label)])}}">
                                            <div class="product-image">
                                                <div class="product-image-front">
                                                    <img alt="bag3-1" class="attachment-shop_catalog" height="893" src="@if($newestProduct->productImages[0]->path){{asset($newestProduct->productImages[0]->path)}}@endif" width="700">
                                                </div>
                                                <div class="product-image-back">
                                                    <img alt="bag3-2" src="@if($newestProduct->productImages[1]->path){{asset($newestProduct->productImages[1]->path)}}@endif">
                                                </div>
                                                <div class="product-image-overlay">
                                                    <h4>جزئیات</h4>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="product-info">
                                            <h3 class="product-title">
                                                <a href="{{route('singleProduct',[$newestProduct->id,\App\Models\Tool::readyToUrl($newestProduct->label)])}}">{{$newestProduct->label}}</a>
                                            </h3> <span class="product-categories">
                                            @if($newestProduct->product_tag_id) <a href="{{route('categories.edit',$newestProduct->product_tag_id)}}" rel="tag">{{$newestProduct->productTag->label}}</a>, @endif
                                            <h3 class="price">
                                                @if($newestProduct->discount_id)
                                                    <del><span class="amount">{{$newestProduct->price}} ريال</span></del>
                                                    <ins><span class="amount">{{\App\Models\Tool::calculateDiscount($newestProduct->price,$newestProduct->discount->price,$newestProduct->discount->percent)}} ريال</span></ins>
                                                @else
                                                    <ins><span class="amount">{{$newestProduct->price}} ريال</span></ins>
                                                @endif
                                            </h3>
                                            <a href="{{route('session',[$newestProduct->id,1,'add'])}}" rel="nofollow" class="add-to-cart-button"> <i class="icon-bag"></i> </a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </article>
@endsection
@section('script')
    <script>
        function increment() {
            document.getElementById('demoInput').stepUp();
        }
        function decrement() {
            document.getElementById('demoInput').stepDown();
        }
    </script>
@endsection
