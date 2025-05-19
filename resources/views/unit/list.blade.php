@extends('layouts.app')
@section('title', translate('common.units'))

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
@endsection
@section('content')
    <!-- <section class="app-user-list">
        <div class="card">
            <div class="card-body border-bottom">
                <h4 class="card-title">{{ translate('common.units') }}</h4>
                <div class="dt-action-buttons text-xl-end text-lg-start text-lg-end text-start ">
                    <div class="dt-buttons"><a class="dt-button btn btn-primary btn-add-record ms-2" tabindex="0"
                            aria-controls="DataTables_Table_0"
                            href="{{ route('unit.add') }}"><span>{{ translate('common.unit_add') }}</span></a> </div>
                </div>
            </div> -->
            <x-container title="unit" buttonTitle="Add Unit" buttonRoute="{{ route('unit.add') }}">
            <div class="table-responsive pt-0">
                <table class="user-list-table table table-bordered border-dark">
                    <thead class="x-table">
                        <tr>
                            <th>{{ translate('common.sn') }}</th>
                            <th>{{ translate('common.name') }}</th>
                            <th>{{ translate('common.action') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
    </x-container>
@endsection

@section('custom-js')


<!-- Automatically open modal if total_cash_in_hand == 0 -->
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

            var table = $('.user-list-table').DataTable({
                processing: false,
                serverSide: true,
                ajax: "{{ route('units') }}",
                columns: [{
                    data: 'DT_RowIndex', // Use DT_RowIndex for sequential numbering
                    name: 'DT_RowIndex',
                    orderable: false, // Prevent ordering by this column
                    searchable: false // Prevent searching by this column
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                dom: 'Bfrtip',
                buttons: [  
                {
                    extend: 'excelHtml5',
                    className: 'custom-button'
                },
                {
                    extend: 'csvHtml5',
                    className: 'custom-button'
                },
            ],
        });
    });
</script>
@endsection
