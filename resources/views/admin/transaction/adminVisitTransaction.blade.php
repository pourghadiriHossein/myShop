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
                    مدیریت تراکنش ها

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
                                <th style="text-align: right">شناسه فاکتور</th>
                                <th style="text-align: right">مبلغ پرداخت شده</th>
                                <th style="text-align: right">کد رهگیری</th>
                                <th style="text-align: right">شناسه IDPay</th>
                                <th style="text-align: right">شماره کارت</th>
                                <th style="text-align: right">زمان پرداخت</th>
                                <th style="text-align: right">زمان تایید پرداخت</th>
                                <th style="text-align: right">وضعیت</th>
                            </tr>
                            </thead>
                            <tfoot style="direction: rtl;">
                            <tr>
                                <th style="text-align: right">شناسه</th>
                                <th style="text-align: right">شناسه فاکتور</th>
                                <th style="text-align: right">مبلغ پرداخت شده</th>
                                <th style="text-align: right">کد رهگیری</th>
                                <th style="text-align: right">شناسه IDPay</th>
                                <th style="text-align: right">شماره کارت</th>
                                <th style="text-align: right">زمان پرداخت</th>
                                <th style="text-align: right">زمان تایید پرداخت</th>
                                <th style="text-align: right">وضعیت</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @if(isset($transactions))
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->id }}</td>
                                    <td>{{ $transaction->order_id }}</td>
                                    <td>{{ $transaction->amount }} ریال</td>
                                    <td>{{ $transaction->IDPay_track_id }}</td>
                                    <td>{{ $transaction->IDPay_id }}</td>
                                    <td>{{ $transaction->card_no }}</td>
                                    <td>
                                        @if($transaction->pay_date)
                                        {{ verta($transaction->pay_date) }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($transaction->verify_date)
                                        {{ verta($transaction->verify_date) }}
                                        @endif
                                    </td>
                                    <td>
                                        {!!\App\Models\Gateway::gatewayStatusCode($transaction->status)!!}
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
