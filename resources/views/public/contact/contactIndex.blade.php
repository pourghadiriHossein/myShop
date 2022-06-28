@extends('public.publicLayout')

@section('content')
    <article>
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
        <section class="section">
            <div class="container container-vertical-middle">
                <div class="row vertical-middle">
                    <div class="col-md-4">
                        <h2 class="text-left element-top-0 element-bottom-0 os-animation normal" data-os-animation="fadeIn" data-os-animation-delay="0s">چه کمکی از دست ما بر می آید</h2> </div>
                    <div class="col-md-8">
                        <hr class="element-top-0 element-bottom-0 os-animation" data-os-animation="fadeIn" data-os-animation-delay="0s"> </div>
                </div>
            </div>
        </section>
        <section class="section text-normal section-text-no-shadow section-inner-no-shadow section-normal section-opaque">
            <div class="background-overlay grid-overlay-0" style="background-color: rgba(255,255,255,0);"></div>
            <div class="container container-vertical-default">
                <div class="row vertical-default">
                    <div class="col-md-12 text-default small-screen-default">
                        <div class="row">
                            <div class="col-md-4 text-right small-screen-left os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.3s">
                                <div class="divider-wrapper">
                                    <div class="visible-xs element-height-20"></div>
                                    <div class="visible-sm element-height-20"></div>
                                    <div class="visible-md element-height-20"></div>
                                    <div class="visible-lg element-height-20"></div>
                                </div>
                                <div class="col-text-1 text-normal element-top-0 element-bottom-0" data-os-animation="none" data-os-animation-delay="0s">
                                    <p style="text-align: justify">فرم آزمایشی پروژه پل استار جهت آموزش بهتر و کاردبری تر با ضاهر مناسب جهت ارتباط گیری بیشتر با مبحث نحصیلی می باشد</p>
                                </div>
                                <ul class="fa-ul text-normal element-top-0 element-bottom-0" data-os-animation="none" data-os-animation-delay="0s">
                                    <li><i class="fa-li fa fa-home"></i> گیلان - رشت - گلسار - چهار راه دیلمان</li>
                                    <li><i class="fa-li fa fa-phone"></i> 013-33333333</li>
                                    <li><i class="fa-li fa fa-globe"></i> poulstar.com</li>
                                </ul>
                                <div class="divider-wrapper">
                                    <div class="visible-xs element-height-60"></div>
                                    <div class="visible-sm element-height-60"></div>
                                    <div class="visible-md element-height-60"></div>
                                    <div class="visible-lg element-height-60"></div>
                                </div>
                            </div>
                            <div class="col-md-8 text-left small-screen-center os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.3s">
                                <div class="divider-wrapper">
                                    <div class="visible-xs element-height-20"></div>
                                    <div class="visible-sm element-height-20"></div>
                                    <div class="visible-md element-height-20"></div>
                                    <div class="visible-lg element-height-20"></div>
                                </div>
                                @include('include.showError')
                                @include('include.validationError')
                                <form action="{{route('postContact')}}" method="post" class="contact-form">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-md-6 pull-right">
                                            <div class="form-group form-icon-group"> <i class="fa fa-user"></i>
                                                <input value="{{old('name')}}" class="form-control" id="name" name="name" placeholder="نام خود را وارد کنید" type="text"> </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-icon-group"> <i class="fa fa-envelope"></i>
                                                <input value="{{old('phone')}}" class="form-control" id="phone" name="phone" placeholder="شماره تماس خود را وارد کنید" type="text"> </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-icon-group"> <i class="fa fa-pencil"></i>
                                        <textarea class="form-control" id="description" name="description" placeholder="پیام خود را برای ما بنویسید" rows="10">{{old('description')}}</textarea>
                                    </div>
                                    <p>
                                        <input type="submit" value="ارسال شود" class="btn btn-primary pull-right"> </p>
                                    <div class="messages text-center"></div>
                                </form>
                                <div class="divider-wrapper">
                                    <div class="visible-xs element-height-60"></div>
                                    <div class="visible-sm element-height-60"></div>
                                    <div class="visible-md element-height-60"></div>
                                    <div class="visible-lg element-height-60"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </article>
@endsection
