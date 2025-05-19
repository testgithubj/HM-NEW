@extends('layouts.backend')
@section('title', translate('common.dashboard'))
@section('custom-css')
<style>
/* General small box styling */


/* Add a slight shadow when hovering over the card */
.small-box:hover {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

/* Transition for the arrow */
.small-box-footer i {
    transition: transform 0.3s ease;
}

/* Move the arrow slightly to the right on hover */
.small-box:hover .small-box-footer i {
    transform: translateX(5px);
}

/* Footer link styling */
.small-box-footer {
    display: flex;
    align-items: center;
    gap: 4px; /* Add spacing between the text and the icon */
    color: #007bff;
    font-size: 11px; /* Adjust font size for better visibility */
    text-decoration: none;
    transition: color 0.3s ease;
}
</style>
@endsection
@section('content')

    <div class="row my-2">
        <div class="col-lg-8">
            <div class="card border-0 border-r20 py-1">
                <div class="card-header bg-transparent border-0">
                    <h4>{{ translate('common.Reports') }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                    <div class="col-lg-3 mb-1 col-6">
    <div class="small-box first">
        <div class="smalll-box d-flex justify-content-between flex-column gap-1">
            <div class="icon">
                <i class="fas fa-pills fa-2xl"></i>
            </div>
            <div class="inner">
                <h3>{{ number_format($medicine, 0, '.', ',') }}</h3>
            </div>
        </div>
        <a href="{{ route('report.instock') }}" class="small-box-footer">
            <span>{{ __('Stock Medicine') }}</span>
            <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>
</div>
                        <div class="col-lg-3 mb-1 col-6">
                            <div class="small-box second">
                                <div class="smalll-box d-flex justify-content-between flex-column gap-1">
                                    <div class="icon">
                                        <i class="fas fa-usd fa-2xl"></i>
                                    </div>
                                    <div class="inner">
                                        <h3>{{ priceFormat($total_sell_amount) }}</h3>
                                    </div>
                                </div>
                                <a href="{{ route('invoice.reports') }}" class="small-box-footer">
                                    <span>{{ __('Total Sales') }}</span> <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 mb-1 col-6">
                            <div class="small-box third">
                                <div class="smalll-box d-flex justify-content-between flex-column gap-1">
                                    <div class="icon">
                                        <i class="fas fa-hourglass-end fa-2xl"></i>
                                    </div>
                                    <div class="inner">
                                        <h3>{{ $expire->count() }}</h3>
                                    </div>
                                </div>
                                <a href="{{ route('report.already_expire') }}" class="small-box-footer">
                                    <span>{{ translate('common.expired_medicine') }}</span> <i
                                            class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 mb-1 col-6">
                            <div class="small-box fourth">
                                <div class="smalll-box d-flex justify-content-between flex-column gap-1">
                                    <div class="icon">
                                        <i class="fa-brands fa-product-hunt fa-2xl"></i>
                                    </div>
                                    <div class="inner">
                                        <h3>{{ $stockout->count() }}</h3>
                                    </div>
                                </div>
                                <a href="{{ route('report.stockout') }}" class="small-box-footer">
                                    <span>{{ translate('common.stock_out_medicine') }}</span> <i
                                            class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 border-r20">
                <div class="card-header bg-transparent border-0">
                    <h4 class="card-title">{{ translate('common.Purchases & Sales') }}</h4>
                </div>
                <div class="card-body">
                    <div id="line-example" style="height: 180px;color: red" class="line-atl morris-chart"></div>
                </div>
            </div>
        </div>
    </div>
    <section id="dashboard-ecommerce">
        <div class="row">
            <div class="col-md-7 col-sm-12">
                <div class="card border-0 border-r20">
                    <div class="card-header">
                        <h4>{{ translate('Others') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col statistic px-2 col-border-right">
                                <div class="text text-dark text-center text-capitalize">
                                    <h4 class="count">{{ App\Models\Customer::count() }}</h4>
                                    <h6 class="mb-0">{{ translate('Total Customer') }}</h6>
                                </div>
                            </div>
                            <div class="col statistic px-2 col-border-right">
                                <div class="text text-dark text-center text-capitalize">
                                    <h4 class="count">{{ App\Models\Supplier::count() }}</h4>
                                    <h6 class="mb-0">{{ translate('Total supplier') }}</h6>
                                </div>
                            </div>
                            <div class="col statistic px-2 col-border-right">
                                <div class="text text-dark text-center text-capitalize">
                                    <h4 class="count">{{ priceFormat($total_cash_in_hand) }}</h4>
                                    <h6 class="mb-0">{{ translate('Total cash in hand ') }}</h6>
                                </div>
                            </div>
                            <div class="col statistic px-2">
                                <div class="text text-dark text-center text-capitalize">
                                    <h4 class="count">{{ priceFormat($total_customer_due) }}</h4>
                                    <h6 class="mb-0">{{ translate('Total customer due') }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="basic-table">
                    <div class="col-md-6 col-sm-12">
                        <div class="card border-0 border-r20">
                            <div class="card-header bg-primary border-0">
                                <h4 class="card-title Titlee">Today's sell</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>{{ translate('common.title') }}</th>
                                        <th>{{ translate('common.amount') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            {{ translate('common.today_invoice') }}
                                        </td>
                                        <td>{{ $today_sell }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ translate('common.sold_amount') }}
                                        </td>
                                        <td>{{ priceFormat($today_sell_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ translate('common.received_amount') }}
                                        </td>
                                        <td>{{ priceFormat($today_received) }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">

                        <div class="card border-0 border-r20">
                            <div class="card-header bg-success border-0">
                                <h4 class="card-title Titlee">{{ translate('Today\'s Purchase') }} </h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>{{ translate('common.title') }}</th>
                                        <th>{{ translate('common.amount') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{ translate('common.today_purchase') }}</td>
                                        <td>{{ $today_purchase }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ translate('common.purchase_amount') }}</td>
                                        <td>{{ priceFormat($today_purchase_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ translate('common.paid_amount') }}</td>
                                        <td>{{ priceFormat($today_paid) }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-12">
                <div class="card border-0 border-r20">
                    <div class="card-header bg-transparent border-0">
                        <div class="header-left">
                            <h4 class="card-title" style="color:#000; font-weight:600;">
                                {{ translate('common.Purchases & Sales') }}
                            </h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="piChart"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @if($total_cash_in_hand == 0)
    <div id="stockmodal" class="modal fade" role="dialog" aria-modal="true">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100 text-center position-relative">
                        {{ translate('common.action required') }}
                    </h4>
                    <button type="button" class="close btn btn-sm btn-light position-absolute" style="top: 10px; right: 10px;" data-bs-dismiss="modal">×</button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center" style="height: 100px;">
                    <p class="text-center">Please fill up the payment method</p>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <input type="hidden" name="is_modal_shown" id="is_modal_shown">
                    <a href="{{ route('payment.method') }}" class="btn btn-primary">Payment Method</a>
                </div>
            </div>
        </div>
    </div>
@endif

@endsection
@section('custom-js')

    <script type="text/javascript">
        $(document).ready(function () {
            $('#stockmodal').modal('show');
        });
    </script>

    <script src="{{ asset('dashboard/app-assets/morris-chart/popper.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/morris-chart//raphael-min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/morris-chart/morris.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @php
        $dfrom = date('Y-m-d', strtotime('-7 day', time()));
        $dto = date('Y-m-d');
        $datelist = list_days($dfrom, $dto);
        $i = 0;
        $data = [];
    @endphp
    @foreach ($datelist as $date)
        @php
            $data[$i]['y'] = $date;
            $data[$i]['a'] = \App\Models\Invoice::where('shop_id', Auth::user()->shop_id)
                ->where('date', $date)
                ->count();
            $data[$i]['b'] = \App\Models\Purchase::where('shop_id', Auth::user()->shop_id)
                ->where('date', $date)
                ->count();
            $i++;
        @endphp
    @endforeach
    <script>
        Morris.Line({
            element: 'line-example',
            data: @php echo json_encode($data) @endphp,
            xkey: 'y',
            labelColor: '#000000',
            ykeys: ['a', 'b'],
            labels: ['Sales', 'Purchase']
        });
    </script>

    @php
        $sales = \App\Models\Invoice::sum('total_price');
        $purchase = \App\Models\Purchase::sum('total_price');
    @endphp

    <script>
        var options = {
            series: [{{ $purchase }}, {{ $sales }}],
            chart: {
                width: 380,
                type: 'pie',
            },
            colors: ['#0088ff', '#f8bf15'],
            labels: ['Purchase', 'Sales'],
            legend: {
                position: 'bottom',
                show: true,
                showForSingleSeries: false,
                showForNullSeries: true,
                showForZeroSeries: true,
            },
        };

        var chart = new ApexCharts(document.querySelector("#piChart"), options);
        chart.render();
    </script>
@endsection
