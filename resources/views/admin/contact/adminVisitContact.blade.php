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
                                <th style="text-align: right">نام و نام خانوادگی</th>
                                <th style="text-align: right">شماره تماس</th>
                                <th style="text-align: right">متن پیام</th>
                                <th style="text-align: right">وضعیت</th>

                            </tr>
                            </thead>
                            <tfoot style="direction: rtl;">
                            <tr>
                                <th style="text-align: right">شناسه</th>
                                <th style="text-align: right">نام و نام خانوادگی</th>
                                <th style="text-align: right">شماره تماس</th>
                                <th style="text-align: right">متن پیام</th>
                                <th style="text-align: right">وضعیت</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->id }}</td>
                                    <td>
                                        @if($contact->user_id)
                                            {{ $contact->user->name }}
                                        @else
                                            {{ $contact->name }}
                                        @endif
                                    </td>
                                    <td>{{ $contact->phone }}</td>
                                    <td>{{ $contact->description }}</td>
                                    <td>
                                        @if($contact->status == 0)
                                            <p class="label label-danger" style="width: 250px">بررسی نشده</p>
                                        @endif
                                        @if($contact->status == 1)
                                            <p class="label label-success" style="width: 250px">بررسی شده</p>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

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
