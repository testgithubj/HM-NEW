@extends('layouts.app')
@section('title', 'Purchase View')
@section('custom-css')
    <style media="all">
        .gry-color *,
        .gry-color {
            color: #333542;
        }

        table {
            width: 100%;
        }

        table th {
            font-weight: normal;
        }

        table.padding th {
            padding: .5rem .7rem;
        }

        table.padding td {
            padding: .7rem;
        }

        table.sm-padding td {
            padding: .2rem .7rem;
        }

        .border-bottom td,
        .border-bottom th {
            border-bottom: 0px solid #3b71de;
        }

        .col-12 {
            width: 100%;
        }

        [class*='col-'] {
            float: left;
        }

        .row:after {
            content: ' ';
            clear: both;
            display: block;
        }

        .header-height {
            height: 15px;
            border: 1px #3b71de;
            background: #3b71de;
        }

        .content-height {
            display: flex;
        }

        .customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        table.customers {
            background-color: #FFFFFF;
        }

        table.customers>tr {
            background-color: #FFFFFF;
        }

        table.customers tr>td {
            border-bottom: 1px solid #000;
        }

        .header {
            border: 1px solid #ecebeb;
        }

        .customers th {
            border: 1px solid #000;
            padding: 8px;
        }

        .customers td {
            border: 1px solid #000;
            padding: 6px;
        }

        .customers th {
            color: white;
            padding-top: 6px;
            padding-bottom: 6px;
            text-align: left;
        }

        .bg-primary {
            /*font-weight: bold !important;*/
            font-size: 0.95rem !important;
            text-align: left;
            color: white;
            {{-- background-color:  {{$web_config['primary_color']}}; --}} background-color: #3b71de;
        }

        .bg-secondary {
            /*font-weight: bold !important;*/
            font-size: 0.95rem !important;
            text-align: left;
            color: #333542 !important;
            background-color: #E6E6E6;
        }

        .big-footer-height {
            height: 250px;
            display: block;
        }

        .table-total {
            font-family: Arial, Helvetica, sans-serif;
        }

        .table-total th,
        td {
            text-align: left;
            padding: 10px;
        }

        .footer-height {
            height: 75px;
        }

        .for-th {
            color: white;
        }

        .for-th-font-bold {
            font-size: 0.95rem !important;
            text-align: left !important;
            color: #333542 !important;
            background-color: #E6E6E6;
        }

        .for-tb {
            margin: 10px;
        }

        .for-tb td {
            /*margin: 10px;*/
            border-style: hidden;
        }


        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .small {
            font-size: .85rem;
        }

        .strong {
            font-size: 0.95rem;
        }

        .bold {
            font-weight: bold;
        }

        .for-footer {
            position: relative;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: rgb(214, 214, 214);
            height: auto;
            margin: auto;
            text-align: center;
        }

        .flex-start {
            display: flex;
            justify-content: flex-start;
        }

        .flex-end {
            display: flex;
            justify-content: flex-end;
        }

        .flex-between {
            display: flex;
            justify-content: space-between;
        }

        .inline {
            display: inline;
        }

        .content-position {
            padding: 15px 40px;
        }

        .content-position-y {
            padding: 0px 15px;
        }

        .triangle {
            width: 0;
            height: 0;
            border: 22px solid #3b71de;
            border-top-color: transparent;
            border-bottom-color: transparent;
            border-right-color: transparent;
        }

        .triangle2 {
            width: 0;
            height: 0;
            border: 22px solid white;
            border-top-color: white;
            border-bottom-color: white;
            border-right-color: white;
            border-left-color: transparent;
        }

        .h1 {
            font-size: 12px;
            margin-block-start: 0.67em;
            margin-block-end: 0.67em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
        }

        .h2 {
            font-size: 1.5em;
            margin-block-start: 0.83em;
            margin-block-end: 0.83em;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            font-weight: bold;
        }

        .h4 {
            font-weight: bold;
        }

        .montserrat-normal-600 {
            font-family: Montserrat;
            font-style: normal;
            font-weight: 600;
            font-size: 18px;
            line-height: 6px;
            /* or 150% */


            color: #363B45;
        }

        .montserrat-bold-700 {
            font-family: Montserrat;
            font-style: normal;
            font-weight: 700;
            font-size: 18px;
            line-height: 6px;
            color: #363B45;
        }

        .text-white {
            color: white !important;
        }

        .bs-0 {
            border-spacing: 0;
        }

        .table thead th {
            border: 1px solid #fff;
            color: #fff;

        }

        .table thead th {
            background-color: #2A3547;

        }

        .table thead th:first-child {
            background-color: #8AB937;
        }

        .table thead th:first {
            background-color: #8AB937;
        }

        .tb-dotted {
            border-top: 1px dotted black;
            padding: 20px;
            border-bottom: 1px dotted black;
        }

        .bg-secondary {
            background-color: #71869d !important;
            -webkit-print-color-adjust: exact;
        }

        @media screen,
        print {

            .bg-secondary {
                background-color: #71869d !important;
            }
        }

        .first {
            position: relative;
            z-index: 1;
        }

        .first::after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 50%;
            height: 100%;
            background-color: #101010;
            z-index: -1;
            clip-path: polygon(0 0, 100% 0, 74% 100%, 0% 100%);
        }

        .first::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 51%;
            height: 80%;
            background-color: #8AB937;
            z-index: -1;
            clip-path: polygon(0 0, 100% 0, 80% 100%, 0% 100%);
            box-shadow: 10px 10px 120px rgba(0, 0, 0, 1);
        }

        .purchase-return-invoice {
            margin: 20px 120px;
            border: 1px solid #c2c2c2;
            padding: 10px;
        }

        .btn.non-printable {
            position: relative;
            left: 88%;
            top: 0%;
            background-color: #8AB937;
            border: 1px solid #8AB937;
            cursor: pointer;
            font-size: 15px;
            color: #fff;
            margin-bottom: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                    <h4 class="card-title mb-0">{{ translate('common.Purchase View') }}</h4>
                    <a href="{{ route('purchase.index') }}" class="btn btn-primary">{{ translate('common.Back') }}</a>
                </div>
                <div class="card-body">
                    <button id="print_invoice" type="button" class="btn non-printable"
                        onclick="printDiv('printableArea')">{{ translate('common.Print Now') }}
                    </button>
                    <div class="" id="printableArea">
                        <div class="first" style="display: block; height:auto !important;background: #fff;">
                            <table class=" content-position">
                                <img height="70" width="400" class="logo"
                                    src="{{ @globalAsset(setting('logo'), 'settings') }}"
                                    alt="" style="margin-top: 15px; margin-left: 9px">

                                {{-- <div class="text-right" style="padding: 7px 12px 10px 0;float: right;">
                                    <h2 class="" style="font-size: 25px; margin-bottom: 0; color: #8AB937">
                                        {{ setting('app_name') }}</h2>
                                    <h5 class="" style="font-size: 1rem; margin-bottom: 0">
                                        {{ translate('common.address') }} : {{ setting('store_address') }}
                                    </h5>
                                    <h5 class="" style="font-size: 0.9rem; margin-bottom: 0">
                                        {{ translate('common.Phone') }} : {{ setting('store_phone') }}
                                    </h5>
                                </div> --}}
                                <table class="bs-0">
                                    <tbody>
                                        <tr>
                                            <th class="content-position-y"
                                                style="padding-right: 0; height: 44px; text-align: left;background:#8AB937">
                                                <div>
                                                    <span class="inline text-white text-uppercase"
                                                        style="font-size: 18px">{{ translate('common.Purchase Invoice') }}#
                                                    </span>
                                                    <span class="inline">
                                                        <span class="h4 text-white"
                                                            style="display: inline">{{ $invoice->id }}</span>
                                                    </span>
                                                </div>
                                            </th>
                                            <th class="content-position-y"
                                                style="text-align: right; height: 44px;background-color: #2A3547;color: #fff">
                                                <span class="h4 inline"
                                                    style="color: #fff;padding-right: 15px; font-size: 17px">{{ translate('common.Date') }}
                                                    : {{ date('d F Y', strtotime($invoice->date)) }}</span>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </table>
                        </div>
                        <div class="row mt-3 justify-content-center">
                            <div class="col-6">
                                <h2 class="text-uppercase">{{ translate('common.Billing From') }}</h2>
                                <h4 class="fw-bold text-black">{{ $invoice->supplier->name }}</h4>
                                <p>{{ translate('common.Address') }}: {{ $invoice->supplier->address }}</p>
                                <p>{{ translate('common.Phone') }} : {{ $invoice->supplier->phone }}</p>
                            </div>
                            <div class="col-6 text-right">
                                <h2 class="text-uppercase">{{ translate('common.Billing To') }}</h2>
                                <h4 class="fw-bold text-black">{{ setting('app_name') }}</h4>
                                <p>{{ translate('common.Address') }}: {{ setting('address') }}</p>
                                <p>{{ translate('common.Phone') }} : {{ setting('phone') }}</p>
                            </div>
                        </div>
                        <table class="table purchase-product-table table-striped mb-2">
                            <thead>
                                <tr>
                                <tr>
                                    <th>#</th>
                                    <th>{{ translate('common.Medicine Name') }}</th>
                                    <th>{{ translate('common.MRP Per Unit') }}</th>
                                    <th>{{ translate('common.Buy Price Per Unit') }}</th>
                                    <th>{{ translate('common.Quantity') }}</th>
                                    <th>{{ translate('common.leaf') }}</th>
                                    <th>{{ translate('common.Total') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($purchase_details as $purchase)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $purchase->medicine->name }}</td>
                                        <td>{{ priceFormat($purchase->price) }}</td>
                                        <td>{{ priceFormat($purchase->buy_price) }}</td>
                                        <td>{{ $purchase->qty }}</td>
                                        <td>{{ $purchase->leaf->name }}</td>
                                        <td>{{ priceFormat($purchase->buy_price * $purchase->qty) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5" class="text-right">
                                        <b>{{ translate('common.Subtotal') }}</b>
                                    </td>
                                    <td>
                                        <b>{{ priceFormat($invoice->subtotal) }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-right">
                                        <b>{{ translate('common.Total Discount') }}</b>
                                    </td>
                                    <td>
                                        <b>{{ priceFormat($invoice->discount) }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-right">
                                        <b>{{ translate('common.Total') }}</b>
                                    </td>
                                    <td>
                                        <b>{{ priceFormat($invoice->total_price) }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-right">
                                        <b>{{ translate('common.Total Paid') }}</b>
                                    </td>
                                    <td>
                                        <b>{{ priceFormat($invoice->total_price - $invoice->due_price) }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-right">
                                        <b>{{ translate('common.Due') }}</b>
                                    </td>
                                    <td>
                                        <b>{{ priceFormat($invoice->due_price) }}</b>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="d-flex flex-row justify-content-between border-top">
                            <span>{{ translate('common.Paid by') }}: {{ @$invoice->method->name }}</span>
                        </div>

                        <h5 class="text-center pt-3 tb-dotted">
                            ~~THANK YOU~~
                        </h5>


                        <div class="">
                            <section class="" style="background-color: #8AB937;">
                                <table style="width: 100%">
                                    <tbody>
                                        <tr>
                                            <th class="content-position-y"
                                                style="padding-top:10px; padding-bottom:10px;text-align: left; width: 100%; display:flex;    align-items: center;
    justify-content: space-between;">
                                                <div class="text-white" style="padding-top:5px; padding-bottom:2px;"><i
                                                        class="fa fa-phone text-white"></i> {{ translate('common.Phone') }}
                                                    : {{ setting('phone') }}
                                                </div>
                                                <div class="text-white" style="padding-top:5px; padding-bottom:2px;"><i
                                                        class="fa fa-globe text-white" aria-hidden="true"></i>
                                                    {{ translate('common.Website') }}
                                                    : {{ url('/') }}
                                                </div>
                                                <div class="text-white" style="padding-top:5px; padding-bottom:2px;"><i
                                                        class="fa fa-envelope text-white" aria-hidden="true"></i>
                                                    {{ translate('common.Email') }}
                                                    : {{ setting('email') }}
                                                </div>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </section>
                        </div>

                        <script>
                            function printDiv(divName) {
                                var printContents = document.getElementById(divName).innerHTML;
                                var originalContents = document.body.innerHTML;
                                document.body.innerHTML = printContents;
                                window.print();
                                document.body.innerHTML = originalContents;
                                location.reload();
                            }
                        </script>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script></script>
@endsection
