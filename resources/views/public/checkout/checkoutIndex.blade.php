@extends('public.publicLayout')

@section('content')
<article>
            <section class="section">
                <div class="background-overlay" style="background-color: rgba(240,240,240,1);"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="text-right element-top-30 element-bottom-30 normal regular">
                        پرداخت
                    </h1> </div>
                    </div>
                </div>
            </section>
            <div class="woocommerce">
                <section class="section section-commerce">
                    <div class="container element-top-50 element-bottom-50">
                        @include('include.showError')
                        @include('include.validationError')
                        <form action="{{ route('postCheckout') }}" class="checkout" id="checkout" method="post" name="checkout">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6 pull-right">
                                    <h3>آدرس پیش فرض</h3>
                                    @if(\Illuminate\Support\Facades\Auth::user())
                                        <div class="checkbox">
                                            @foreach($addresses as $address)
                                            <label><input @if($address)value="{{ $address->id }}"@endif class="input-checkbox" name="previousAddress" type="radio">@if($address){{$address->zone->city->region->label}} - {{ $address->zone->city->label }} - {{ $address->zone->label }} - {{ $address->detail }}@else<p>آدرس پیش فرضی وجود ندارد</p>@endif</label>
                                            @endforeach
                                        </div>
                                        <div class="clear"></div>
                                    @else
                                        <p>آدرس پیش فرضی وجود ندارد</p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="checkbox" id="ship-to-different-address">
                                        <label>
                                            <input class="input-checkbox" name="newAddress" type="checkbox" value="1">
                                            <h3>ارسال به آدرس جدید</h3> </label>
                                    </div>
                                    
                                    <p>
                                        <label>استان </label>
                                        <select id="demo-hierarchical-pickers-region" data-dropdown="true" class="country_to_state form-control" name="regionID">
                                            @foreach($regions as $region)
                                                <<option value="{{$region->id}}"> {{$region->label}} </option>
                                            @endforeach
                                        </select>
                                    </p>
                                    <p>
                                        <label>شهر </label>
                                        <select class="country_to_state form-control" id="cityID" name="city_id">
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}"> {{$city->label}} </option>
                                            @endforeach
                                        </select>
                                    </p>
                                    <p>
                                        <label>ناحیه </label>
                                        <select class="country_to_state form-control" id="zoneID" name="zoneID">
                                            @foreach($zones as $zone)
                                                <option value="{{$zone->id}}"> {{$zone->label}} </option>
                                            @endforeach
                                        </select>
                                    </p>
                                    <p>
                                        <label> جزئیات آدرس  </label>
                                        <input class="input-text form-control" name="detail" placeholder="" type="text"> </p>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <h3 class="element-top-20">اطلاعات فردی</h3>
                            <div>
                                <table class="shop_table table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>اطلاعات فردی</th>
                                            <th>اطلاعات تماس</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td rowspan="2">@if(Auth::user()){{Auth::user()->name}} @elseنام وجود ندارد @endif</td>
                                            <td><span>@if(Auth::user()){{Auth::user()->phone}} @elseشماره تماس وجود ندارد @endif</span></td>
                                        </tr>
                                        <tr>

                                            <td><span>@if(Auth::user()){{Auth::user()->email}} @elseپست الکترونیک وجود ندارد @endif</span></td>
                                        </tr>


                                    </tbody>
                                </table>

                            </div>
                            <h3 class="element-top-20">فاکتور شما</h3>
                            <div>
                                <table class="shop_table table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>محصول</th>
                                            <th>جمع قیمت</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr class="info">
                                            <th>جمع محصولات</th>
                                            <td>
                                                @if(!empty(\App\Models\Tool::calculateCart()))
                                                    {{\App\Models\Tool::calculateCart()}}  ريال
                                                @else
                                                    فاکتوری وجود ندارد
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="info">
                                            <th>هزینه ارسال</th>
                                            <td>رایگان</td>
                                        </tr>
                                        <tr class="danger">
                                            <th>کد تخفیف</th>
                                            <td>@if(!empty(\App\Models\Tool::getTokenDiscount()))
                                                    @foreach(\App\Models\Tool::getTokenDiscount() as $dis)
                                                        @if($dis->price)
                                                            کسر {{(int) $dis->price}} ريال
                                                        @else
                                                            کسر {{(int) $dis->percent}} درصد
                                                        @endif
                                                    @endforeach
                                                @else
                                                    توکن تخفیفی برای شما ثبت نشده است
                                                @endif</td>
                                        </tr>
                                        <tr class="success">
                                            <th>مبلغ کل فاکتور</th>
                                            <td><strong><span>{{(\App\Models\Tool::calculateCart()) - (\App\Models\Tool::calculateDiscountSession())}} ریال</span></strong></td>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    @if(!empty(\App\Models\Tool::getBasket()))
                                        @foreach(\App\Models\Tool::getBasket() as $basket)
                                            <tr>
                                                <td> {{$basket[0]->label}} <strong>&times; {{$basket[1]}}</strong></td>
                                                <td><span>
                                                        @if($basket[0]->discount_id)
                                                            {{\App\Models\Tool::calculateDiscount($basket[0]->price,$basket[0]->discount->price,$basket[0]->discount->percent) * $basket[1]}}
                                                        @else
                                                            {{$basket[0]->price * $basket[1]}}
                                                        @endif
                                                    </span>ریال</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <td>محصول وجود ندارد <strong>&times; 0</strong></td>
                                        <td><span>0 ریال</span></td>
                                    @endif
                                    </tbody>
                                </table>
                                <div id="payment">

                                    <div class="form-row place-order">

                                        <div class="checkbox">
                                            <label>
                                                <input class="input-checkbox" id="terms" name="terms" type="checkbox"> من کلیه  <a href="{{ route('publicTC') }}" target="_blank">قوانین و مقررات</a> را می پذیرم</label>
                                        </div>
                                        <input class="btn btn-success btn-lg pull-right alt" data-value="Place order" type="submit" value="پرداخت">
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </article>
@endsection