@extends('layouts.app')
@section('title', translate('common.invoice_reports'))
@section('custom-css')

    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        .custom-button {
            color: #000000 !important;
            background-color: #f0f0f0 !important;
            border-color: #000000 !important;
            border-radius: 4px;
            padding: 5px 10px;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            margin-right: 5px;
            margin-top: 15px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .custom-button:hover {
            background-color: #000000 !important;
            color: #ffffff !important;
            border-color: #000000 !important;
        }
    </style>
@endsection

@section('content')
    <section class="app-user-list">
        <div class="card">
            <div class="card-body border-bottom">
                <h4 class="card-title">{{ translate('Medicine Profit & Loss') }}</h4>
                <div class="row">
                    <div class="col-md-3">
                        <form method="get">
                            <div class="col-md-12 user_role">
                                <label class="form-label" for="UserRole">{{ translate('common.from_date') }}</label>
                                <input value="@php echo $from_date @endphp - @php echo $to_date @endphp" type="text"
                                    name="date" id="reportrange"
                                    class="form-control invoice-edit-input date-picker flatpickr-input">
                            </div>
                        </form>
                    </div>
                    @php
                        $setting = Auth::user()->shop;
                    @endphp
                    <div class="col-md-9 user_role">
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-info">
                                    <div class="smalll-box d-flex justify-content-between">
                                        <div class="inner">
                                            <h4 class="text-white">
                                                {{ priceFormat($total_sale_balance) }}</h4>
                                            <p class="text-white">Total Sales</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-success">
                                    <div class="smalll-box d-flex justify-content-between">
                                        <div class="inner">
                                            <h4 class="text-white">
                                                {{ priceFormat($total_profit_balance) }}</h4>
                                            <p class="text-white">Total Profit</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-warning">
                                    <div class="smalll-box d-flex justify-content-between">
                                        <div class="inner">
                                            <h4 class="text-white">
                                                {{ priceFormat(abs($total_loss_balance)) }}</h4>
                                            <p class="text-white">Total Loss</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-primary">
                                    <div class="smalll-box d-flex justify-content-between">
                                        <div class="inner">
                                            <h4 class="text-white">
                                                {{ priceFormat($balanceInhand) }}</h4>
                                            <p class="text-white">Balance In Hand</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mx-2 card-datatable table-responsive pt-0">
                <table class="user-list-table table table-bordered border-dark" id="user-list-table">
                    <thead class="table-light">
                        <tr>
                            <th>{{ translate('common.date') }}</th>
                            <th>{{ translate('Sales Invoice Qty') }}</th>
                            <th>{{ translate('Sales Amount') }}</th>
                            <th>{{ translate('Buy Amount') }}</th>
                            <th>{{ translate('Profit') }}</th>
                            <th>{{ translate('Loss') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            <tr>
                                <th>{{ $report['date'] }}</th>
                                <th>{{ $report['quantity'] }}</th>
                                <th>{{ priceFormat($report['amounts']) }}</th>
                                <th>{{ priceFormat($report['buy_amount']) }}</th>
                                <th>{{ priceFormat($report['profit']) }}</th>
                                <th>{{ priceFormat(abs($report['loss'])) }}</th>
                            </tr>
                        @endforeach
                        <input type="hidden" id="total" value="{{ priceFormat($total_profit_balance) }}">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in"></div>
    </section>
@endsection

@section('custom-js')


<script>
    $(document).ready(function() {
        @if($total_cash_in_hand == 0)
            $('#stockmodal').modal('show');
        @endif
    });
</script>
    <!-- Modal for total_cash_in_hand == 0 -->
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
                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                        <a href="{{ route('payment.method') }}" class="btn btn-primary">Payment Method</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- BEGIN: Page Vendor JS-->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <script type="text/javascript">
        $(function() {
            var pvlpaid = $("#total").val();
            $('#totaldue').html(pvlpaid);

            var start = moment().subtract(29, 'days');
            var end = moment();

            var up = function(start, end) {
                window.location.href = "?from=" + start + "&to=" + end;
            }

            $('input[name="date"]').daterangepicker({
                startDate: start,
                endDate: end,
                format: 'YYYY-MM-DD',
                timePicker: false,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, function(start, end, label) {
                var start2 = start.format("YYYY-MM-DD");
                var end2 = end.format("YYYY-MM-DD");

                window.start = start2;
                window.end = end2;
                up(start2, end2);
            });
        });

        $(document).ready(function () {
            $('#user-list-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        className: 'custom-button'
                    },
                    {
                        extend: 'excelHtml5',
                        className: 'custom-button'
                    },
                    {
                        extend: 'csvHtml5',
                        className: 'custom-button'
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'custom-button'
                    }
                ],
                responsive: true,
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                language: {
                    search: "{{ translate('Search:') }}",
                    lengthMenu: "{{ translate('Display _MENU_ records per page') }}",
                    zeroRecords: "{{ translate('No data found') }}",
                    info: "{{ translate('Showing _PAGE_ of _PAGES_') }}",
                    infoEmpty: "{{ translate('No records available') }}",
                    infoFiltered: "{{ translate('(filtered from _MAX_ total records)') }}"
                }
            });
        });
    </script>
@endsection

