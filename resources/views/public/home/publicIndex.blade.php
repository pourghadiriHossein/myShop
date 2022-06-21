@extends('public.publicLayout')

@section('content')
    <article>
        {{--TOP IMAGE--}}
        @include('public.home.topImagePublicIndex')
        {{--LATEST PRODUCTS--}}
        @include('public.home.latestProductPublicIndex')
        {{--MENS LATEST--}}
        @include('public.home.menLatestPublicIndex')
        {{--WOMENS LATEST--}}
        @include('public.home.womenLatestPublicIndex')
    </article>
@endsection
