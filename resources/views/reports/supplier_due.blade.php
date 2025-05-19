@extends('layouts.app')
@section('title', translate('common.supplier_list'))
@section('custom-css')
<style>
/* Style for the custom buttons */
/* Style for the custom buttons */
.custom-button {
    color: #000000 !important; /* Black text for visibility */
    background-color: #f0f0f0 !important; /* Light gray background for contrast */
    border: 2px solid #000000 !important; /* Uniform border */
    border-left-color: #000000 !important; /* Specific left border color */
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    border-right-color: #000000 !important; /* Specific right border color */
    border-radius: 6px !important; /* Ensures the border radius is applied */
    padding: 8px 13px;  /* Adjusted padding for proper spacing and alignment */
    font-size: 14px;     /* Optional: increase font size for better proportion */
    font-weight: bold;
    text-transform: uppercase;
    margin: 15px 10px;  /* Equal spacing between buttons (top/bottom: 15px, left/right: 10px) */
    display: inline-block; /* Ensures proper alignment */
    transition: background-color 0.3s ease, color 0.3s ease;
    overflow: visible !important; /* Prevents clipping of rounded corners */
    box-shadow: none !important; /* Removes any conflicting shadows */
}

/* Hover state for custom buttons */
.custom-button:hover {
    background-color: #000000 !important; /* Black background on hover */
    color: #ffffff !important; /* White text on hover for contrast */
    border-color: #000000 !important;
    border-left-color: #ffffff !important; /* Change left border on hover for contrast */
    border-right-color: #ffffff !important; /* Change right border on hover for contrast */
}

/* Specific styles for DataTables buttons */
.dataTables_wrapper .dt-buttons .custom-button {
    border-radius: 6px !important; /* Ensures border-radius is applied */
    border: 2px solid #000000 !important; /* Uniform border */
    border-left-color: #000000 !important; /* Specific left border color */
    border-right-color: #000000 !important; /* Specific right border color */
    overflow: visible !important; /* Prevents clipping */
    box-shadow: none !important; /* Removes conflicting shadows */
}

</style>

    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section('content')
    
<x-container title="customer due">
                <div class="mb-3">
    <form method="get">
        <div class="col-md-12 user_role">
            <!-- <label class="form-label" for="UserRole">{{ translate('common.from_date') }}</label> -->
            <input type="text" name="date" id="reportrange2"
                value="{{ $from_date }} - {{ $to_date }}"
                class="form-control invoice-edit-input date-picker flatpickr-input">
            <input type="hidden" name="from" value="{{ $from_date }}">
            <input type="hidden" name="to" value="{{ $to_date }}">
        </div>
    </form>
</div>
                <div class="row">
                    <div class="col-md-4 user_role"></div>
                    <div class="col-md-4 user_plan"></div>
                    <div class="col-md-4 user_status"></div>
                </div>
        
            </div>
            @php
                $setting = Auth::user()->shop;
            @endphp
            <div class="row justify-content-center">
            <div class="col-lg-4 mx-3 my-2">
    <div class="bg-success p-2 text-center" role="alert">
        <h2 class="text-light">Total Previous Due <br> 
            <span class="">{{ priceFormat($total_previous_payable) }}</span>
        </h2>
    </div>
</div>
<div class="col-lg-4 mx-3 my-2">
    <div class="bg-info p-2 text-center" role="alert">
        <h2 class="text-light">Total Invoice due <br> 
            <span class="">{{ priceFormat($total_invoice_payable) }}</span>
        </h2>
    </div>
</div>

        
            </div>
            <div class="table-responsive pt-0">
                <table class="supplier_due_table table table-bordered border-dark" id="supplier_due_table">
                    <thead class="x-table">
                        <tr>
                            <th>{{ translate('common.sn') }}</th>
                            <th>{{ translate('common.name') }}</th>
                            <th>{{ translate('common.phone') }}</th>
                            <th>Invoice Dues</th>
                            <th>Previous Dues</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suppliers_with_dues as $index => $supplier)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $supplier['name'] }}</td>
                                <td>{{ $supplier['phone'] }}</td>
                                <td>{{ number_format($supplier['invoice_due'], 2) }}</td>
                                <td>{{ number_format($supplier['previous_due'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
           
            <div class="mt-3 d-flex justify-content-center">
        {{ $data->links() }}
        </x-container>
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

<!-- DataTables JS -->
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
@php
        $date = date('Y-m-d', strtotime('-7 day', time()));
    @endphp
    <script type="text/javascript">
        $(function() {

            var pvlpaid = $("#total").val();
            console.log(pvlpaid)
            $('#totaldue').html(pvlpaid);
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
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>

    <script>
       $(document).ready(function () {
    $('#supplier_due_table').DataTable({
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
