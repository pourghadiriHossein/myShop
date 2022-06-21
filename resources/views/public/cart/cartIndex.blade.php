@extends('public.publicLayout')
@section('content')
<article>
            <section class="section">
                <div class="background-overlay" style="background-color: rgba(240,240,240,1);"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="text-right element-top-30 element-bottom-30 normal regular">
                        سبد خرید
                    </h1> </div>
                    </div>
                </div>
            </section>
            <section class="section section-commerce">
                <div class="container">
                    <div class="row element-top-50 element-bottom-50">
                        <div class="col-md-12">

                            <div class="table-responsive">
                                <table cellspacing="0" class="shop_table cart table element-bottom-20">
                                    <thead>
                                        <tr>
                                            <th class="product-remove">&nbsp;</th>
                                            <th class="product-thumbnail">&nbsp;</th>
                                            <th class="product-name">محصول</th>
                                            <th class="product-price">قیمت</th>
                                            <th class="product-quantity">تعداد</th>
                                            <th class="product-subtotal">قیمت کل</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if(\App\Models\Tool::getBasket())
                                        @foreach(\App\Models\Tool::getBasket() as $basket)
                                        <tr class="cart_item">
                                            <td class="product-remove">
                                                <a href="{{route('session',[$basket[0]->id,$basket[1],'remove'])}}" class="remove" title="Remove this item"> <i class="icon-cross"></i> </a>
                                            </td>
                                            <td class="product-thumbnail">
                                                <a href="shop-simple-product.html"> <img alt="hoodie1-1" height="114" src="{{ asset($basket[0]->productImages[0]->path) }}" width="90"> </a>
                                            </td>
                                            <td class="product-name"> <a href="shop-simple-product.html">{{ $basket[0]->label }}</a> </td>
                                            @if($basket[0]->discount_id)
                                            <td class="product-price">
                                                <del class="amount">{{ $basket[0]->price }} ریال</del>
                                                <span class="amount">{{\App\Models\Tool::calculateDiscount($basket[0]->price,$basket[0]->discount->price,$basket[0]->discount->percent)}} ریال</span>
                                            </td>
                                            @else
                                            <td class="product-price"><span class="amount">{{ $basket[0]->price }} ریال</span></td>
                                            @endif
                                            <td class="product-quantity">
                                                <div class="quantity">
                                                    <a href="{{route('session',[$basket[0]->id,-1,'add'])}}"><input type="button" value="-" class="minus"></a>
                                                    <input class="input-text qty text" min="1" name="quantity" step="1" title="demoInput" type="number" value="{{ $basket[1] }}">
                                                    <a href="{{route('session',[$basket[0]->id,1,'add'])}}"><input type="button" value="+" class="plus"></a>
                                                </div>
                                            </td>
                                            @if($basket[0]->discount_id)
                                                <td class="product-subtotal"><span class="amount">{{\App\Models\Tool::calculateDiscount($basket[0]->price,$basket[0]->discount->price,$basket[0]->discount->percent) * $basket[1]}}</span> ریال </td>
                                            @else
                                                <td class="product-subtotal"><span class="amount">{{$basket[0]->price * $basket[1]}}</span> ریال </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <form action="{{route('session',['token','token','addTokenDiscount'])}}" method="get">
                                    <div class="col-md-6 element-bottom-20">
                                        <div class="input-group">
                                            <input class="input-text form-control" id="coupon_code" name="token" placeholder="کد تخفیف خود را وارد کنید"> <span class="input-group-btn">
                                            <input class="btn btn-primary" name="apply_coupon" type="submit" value="ثبت کد تخفیف"></span>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-md-6 element-bottom-20">
                                    <a href="{{route('checkoutIndex')}}"><button class="btn btn-success btn-block" name="proceed" type="submit" value="true"> ثبت و ارسال جهت پرداخت <i class="fa fa-shopping-cart"></i> </button></a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="cart_totals">
                                <table cellspacing="0" class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center" colspan="2">جمع بندی سبد خرید</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <th>جمع کل سبد خرید</th>
                                            <td><spanclass="amount"> {{\App\Models\Tool::calculateCart()}}</span> ریال </td>
                                        </tr>
                                        <tr class="shipping">
                                            <th>هزینه ارسال</th>
                                            <td>رایگان
                                                <input class="shipping_method" data-index="0" type="hidden" value="free_shipping">
                                            </td>
                                        </tr>
                                        <tr class="cart-subtotal danger">
                                            <th>کد تخفیف</th>
                                            <td><span class="amount">
                                                    @if(!empty(\App\Models\Tool::getTokenDiscount()))
                                                        @foreach(\App\Models\Tool::getTokenDiscount() as $dis)
                                                            @if($dis->price)
                                                                کسر {{(int) $dis->price}} ريال
                                                            @else
                                                                کسر {{(int) $dis->percent}} درصد
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        توکن تخفیفی برای شما ثبت نشده است
                                                    @endif
                                                    </span></td>
                                        </tr>
                                        <tr class="order-total success">
                                            <th>مبلغ نهایی</th>
                                            <td><strong><span class="amount">
                                                        {{(\App\Models\Tool::calculateCart()) - (\App\Models\Tool::calculateDiscountSession())}} ریال
                                                    </span></strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row element-top-20">
                        <div class="col-md-12"></div>
                    </div>
                </div>
            </section>
        </article>
@endsection

