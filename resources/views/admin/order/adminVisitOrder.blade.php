@extends('admin.layout.adminLayout')

@section('content')
    <style type="text/css" class="init">

        tfoot input {
            width: 100%;
            padding: 3px;
            box-sizing: border-box;
        }

    </style>
    <script type="text/javascript" language="javascript" src="{{asset('admin')}}/js/jq.dataTable.min.js">
    </script>
    <script type="text/javascript" language="javascript" src="{{asset('admin')}}/js/dataTables.bootstrap.min.js">
    </script>
    <script>
        $(document).ready(function () {
            // Setup - add a text input to each footer cell
            $('#orderTable tfoot th').each(function () {
                var title = $(this).text();
                $(this).html('<input class="form-control input-sm" type="text" placeholder="' + title + '" />');
            });

            // DataTable
            var table = $('#orderTable').DataTable({
                "order": [[0, "desc"]]
            });

            // Apply the search
            table.columns().every(function () {
                var that = this;

                $('input', this.footer()).on('keyup change', function () {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            });
        });
    </script>
    <section id="main-content">
        <section class="wrapper">
            <section class="panel">
                <header class="panel-heading">
                    مدیریت فاکتور ها


                </header>
                <div class="container">


                    <div class="col-xs-12 col-sm-12 col-md-12 table-responsive">
                        <br/>
                        @include('include.showError')
                        @include('include.validationError')
                        <table id="orderTable" class="table table-striped">
                            <thead>
                            <tr>
                                <th style="text-align: right">شناسه</th>
                                <th style="text-align: right">نام کاربر</th>
                                <th style="text-align: right">نام استان</th>
                                <th style="text-align: right">نام شهر</th>
                                <th style="text-align: right">نام ناحیه</th>
                                <th style="text-align: right">جزئیات آدرس</th>
                                <th style="text-align: right">کد تخفیف</th>
                                <th style="text-align: right">مبلغ کل</th>
                                <th style="text-align: right">مبلغ پرداخت شده</th>
                                <th style="text-align: right">وضعیت</th>
                                <th style="text-align: right">امکانات</th>
                            </tr>
                            </thead>
                            <tfoot style="direction: rtl;">
                            <tr>
                                <th style="text-align: right">شناسه</th>
                                <th style="text-align: right">نام کاربر</th>
                                <th style="text-align: right">نام استان</th>
                                <th style="text-align: right">نام شهر</th>
                                <th style="text-align: right">نام ناحیه</th>
                                <th style="text-align: right">جزئیات آدرس</th>
                                <th style="text-align: right">کد تخفیف</th>
                                <th style="text-align: right">مبلغ کل</th>
                                <th style="text-align: right">مبلغ پرداخت شده</th>
                                <th style="text-align: right">وضعیت</th>
                                <th style="text-align: right">امکانات</th>
                                >
                            </tr>
                            </tfoot>
                            <tbody>
                            @if(isset($orders))
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->address->zone->city->region->label }}</td>
                                    <td>{{ $order->address->zone->city->label }}</td>
                                    <td>{{ $order->address->zone->label }}</td>
                                    <td>{{ $order->address->detail }}</td>
                                    <td>@if($order->discount_id == null)
                                            تخفیف ندارد
                                        @else
                                            @if($order->discount->price)
                                                {{ $order->discount->price }},
                                            @endif
                                            @if($order->discount->percent)
                                                {{ $order->discount->percent }},
                                            @endif
                                            @if($order->discount->token)
                                                {{ $order->discount->token }},
                                            @endif
                                        @endif</td>
                                    <td>{{ $order->total_price }} ریال</td>
                                    <td>{{ $order->pay_price }} ریال</td>
                                    <td>
                                        @if($order->status == 0)
                                            <p class="label label-warning" style="width: 250px">غیر فعال</p>
                                        @endif
                                        @if($order->status == 1)
                                            <p class="label label-success" style="width: 250px">فعال</p>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="label label-info" data-toggle="modal" href="#myModal{{$order->id}}">محصولات</a>
                                        <div class="modal fade" id="myModal{{$order->id}}" tabindex="-1" role="dialog"
                                             aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-hidden="true">&times;
                                                        </button>
                                                        <h4 class="modal-title">محصولات ثبت شده در این سفارش</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table id="orderTable" class="table table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th style="text-align: right">شناسه</th>
                                                                <th style="text-align: right">تصویر محصول</th>
                                                                <th style="text-align: right">نام محصول</th>
                                                                <th style="text-align: right">قیمت محصول</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($order->orderListItems as $OLI)
                                                                <tr>
                                                                    <td>{{ $OLI->id }}</td>
                                                                    <td>
                                                                        <img src="{{asset(\App\Models\Tool::getProductImage($OLI->product_id))}}"
                                                                             height="50" width="40"></td>
                                                                    <td>{{ \App\Models\Tool::getProductName($OLI->product_id) }}</td>
                                                                    <td>{{ $OLI->price }} ريال</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>

                                                        </table>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button data-dismiss="modal" class="btn btn-warning"
                                                                type="button">بستن
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                            </tbody>

                        </table>
                    </div>

                </div>


            </section>
        </section>
    </section>

    <script>

        //owl carousel

        $(document).ready(function () {
            $("#owl-demo").owlCarousel({
                navigation: true,
                slideSpeed: 300,
                paginationSpeed: 400,
                singleItem: true

            });
        });

        //custom select box

        $(function () {
            $('select.styled').customSelect();
        });

    </script>
@endsection
