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
            margin-left: 10px;
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

        @if (request()->get('from') && request()->get('to'))
            @php
                $dto = request()->get('to');
                $dfrom = request()->get('from');
            @endphp
        @else
            @php
                $dfrom = date('Y-m-d', strtotime('-7 day', time()));
                $dto = date('Y-m-d');
            @endphp
        @endif



        @php
            $datelist = list_days($dfrom, $dto);

        @endphp
        @php
            $setting = Auth::user()->shop;
        @endphp


        <div class="card">
            <div class="card-body border-bottom">
                <h4 class="card-title">{{ Auth::user()->name }}'s {{ translate('Sales & Purchase Reports') }}</h4>
                <div class="row">
                    <form method="get">
                        <div class="col-md-5 user_role">
                            <label class="form-label" for="UserRole">{{ translate('common.from_date') }}</label>
                            <input value="@php echo $dfrom @endphp  - @php echo $dto @endphp" type="text"
                                name="date" id="reportrange"
                                class="form-control invoice-edit-input date-picker flatpickr-input">
                        </div>

                    </form>
                </div>
            </div>
            <div class="col-lg-12 px-2">
                <div class="row justify-content-center">
                    <div class="col-lg-3  my-2">
                        <div class="bg-danger p-2 text-center" role="alert">
                            <h4 class="text-light">{{ $total_sale }}</h4>
                            <h5 class="text-light"> Total Sale Invoice</h5>
                        </div>
                    </div>
                   
        <div class="col-lg-3 my-2">
            <div class="bg-primary p-2 text-center" role="alert">
                <h4 class="text-light">{{ priceFormat($total_sale_amount) }} </h4>
                <h5 class="text-light">Total Sale Amount <br><span class=""></span></h5>
            </div>
        </div>
        <div class="col-lg-3 my-2">
            <div class="bg-info p-2 text-center" role="alert">
                <h4 class="text-light">{{ $total_purchase }}</h4>
                <h5 class="text-light">Total Purchase Invoice<br><span class=""></span></h5>
            </div>
        </div>
        <div class="col-lg-3 my-2">
            <div class="bg-success p-2 text-center" role="alert">
                <h4 class="text-light">{{ priceFormat($total_purchase_amount) }}</h4>
                <h5 class="text-light">Total Purchase Amount</h5>
            </div>
        </div>
    </div>
</div>
            <div class="mx-2 card-datatable table-responsive pt-0">
                <table class="user-list-table table table-bordered border-dark" id="all_reports">
                    <thead class="table-light">
                        <tr>
                            <th>{{ translate('common.date') }}</th>
                            <th>Total Sales Inv.</th>
                            <th>{{ translate('common.Sales Price') }}</th>
                            <th>{{ translate('common.Total Amount') }}</th>
                            <th>{{ translate('common.Total Purchase Inv') }}</th>
                            <th>{{ translate('common.Purchase Price') }}</th>
                            <th>{{ translate('common.status') }}</th>
                            <th>{{ translate('common.Paid To Supplier') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($reports as $report)
                            <tr>
                                <td width="15%">{{ date('d M Y', strtotime($report['date'])) }}</td>
                                <td>{{ $report['total_sele'] }}</td>
                                <td>{{ priceFormat($report['total_sale_price']) }}</td>
                                <td>{{ priceFormat($report['total_sale_amount']) }}</td>
                                <td>{{ $report['total_purchase'] }}</td>
                                <td>{{ priceFormat($report['total_purchase_price']) }}</td>
                                <td>
                    {{ priceFormat($report['total_purchase_price']) != priceFormat($report['total_purchase_amount']) ? 'Returned' : '' }}
                </td>
                                <td>{{ priceFormat($report['total_purchase_amount']) }}</td>

                            </tr>
                        @endforeach


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


    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    @php
        $date = date('Y-m-d', strtotime('-7 day', time()));
    @endphp
    <!-- END: Page Vendor JS-->



    <script type="text/javascript">
        $(function() {


            var start = moment().subtract(29, 'days');
            var end = moment();

            var d = new Date();

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
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, function(start, end, label) {
                var start2 = start.format("YYYY-MM-DD");
                var end2 = end.format("YYYY-MM-DD");

                window.start = start2;
                window.end = end2;

                up(start2, end2);


            });
        });
    </script>
   <script type="text/javascript">
        $(document).ready(function () {
            // Initialize the DataTable with buttons
            var table = $('#all_reports').DataTable({
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
