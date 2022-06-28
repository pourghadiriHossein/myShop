<section class="section">
    <div class="container container-vertical-middle">
        <div class="row vertical-middle">
            <div class="col-md-3">
                <h2 class="text-left element-top-20 element-bottom-20 os-animation normal" data-os-animation="fadeIn" data-os-animation-delay="0s">آخرین محصولات زنانه</h2> </div>
            <div class="col-md-9">
                <hr class="element-top-0 element-bottom-0 os-animation" data-os-animation="fadeIn" data-os-animation-delay="0s"> </div>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="divider-wrapper">
                    <div class="visible-xs element-height-30"></div>
                    <div class="visible-sm element-height-30"></div>
                    <div class="visible-md element-height-30"></div>
                    <div class="visible-lg element-height-30"></div>
                </div>
                <div class="woocommerce columns-6">
                    <div class="row">
                        <ul class="products">
                            @foreach(\App\Models\Tool::getWomenProducts() as $product)
                                <li class="product col-md-2">
                                    @if($product->discount_id) <span class="onsale">تخفیف</span> @endif
                                        <a href="{{route('singleProduct',[$product->id,\App\Models\Tool::readyToUrl($product->label)])}}">
                                            <div class="product-image">
                                                <div class="product-image-front">
                                                    <img alt="jacket2-1" height="893" src="@if($product->productImages[0]){{asset($product->productImages[0]->path)}}@endif" width="700">
                                                </div>
                                            <div class="product-image-back"><img alt="jacket2-2" src="@if($product->productImages[1]){{asset($product->productImages[1]->path)}}@endif"></div>
                                                <div class="product-image-overlay">
                                                    <h4>جزئیات</h4>
                                                </div>
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
                                        <a class="add-to-cart-button" href="{{route('session',[$product->id,1,'add'])}}" rel="nofollow">
                                            <i class="icon-bag"></i> </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
