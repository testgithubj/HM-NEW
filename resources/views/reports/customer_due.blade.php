@extends('layouts.app')
@section('title', translate('common.customer_list'))
@section('custom-css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
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
    <!-- <section class="app-user-list"> -->
    <x-container title="customer due">
            @php
                $setting = Auth::user()->shop;
            @endphp
            <div class="row justify-content-center">
                <div class="col-lg-4 mx-3 my-2">
                    <div class="bg-primary p-2 text-center" role="alert">
                        <h2 class="text-light">Total Due <br> <span class="">
                                {{ priceFormat($total_previous_due) }}
                            </span></h2>
                    </div>
                </div>
                <div class="col-lg-4 mx-3 my-2">
                    <div class="bg-warning p-2 text-center" role="alert">
                        <h2 class="text-light">Total Inovice Due <br> <span class="">
                                {{ priceFormat($total_invoice_due) }}</span></h2>
                    </div>
                </div>
            </div>
            <div class="table-responsive pt-0">
                <!-- <table class="customer_due_table table table-bordered border-dark"> -->
                <table class="customer_due_table table table-bordered border-dark">
                <thead class="x-table">
                        <tr>
                            <th>{{ translate('common.sn') }}</th>
                            <th>{{ translate('common.name') }}</th>
                            <th>{{ translate('common.phone') }}</th>
                            <th>Previous Dues</th>
                            <th>Invoice Dues</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in"></div>
        </x-container>
    <!-- </section> -->
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
                        <a href="{{ route('payment.method') }}" class="btn btn-primary">Payment Method</a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- BEGIN: Page Vendor JS-->



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
    <script>
        $(function() {

            var table = $('.customer_due_table').DataTable({
                processing: false,
                serverSide: true,
                ajax: "{{ route('report.customer_due') }}",
                columns: [{
                        data: 'id',
                        name: 'id',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'due',
                        name: 'due'
                    },
                    {
                        data: 'invoice_due',
                        name: 'invoice_due'
                    },
                ],
                dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    className: 'custom-button'  // Add custom button class
                },
                {
                    extend: 'excelHtml5',
                    className: 'custom-button'  // Add custom button class
                },
                {
                    extend: 'csvHtml5',
                    className: 'custom-button'  // Add custom button class
                },
                {
                    extend: 'pdfHtml5',
                    className: 'custom-button'  // Add custom button class
                }
            ]
            });

        });
    </script>
@endsection
