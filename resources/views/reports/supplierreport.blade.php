@extends('layouts.app')
@section('title', 'Supplier Report')

@section('custom-css')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
<style>
        .table> :not(caption)>*>* {
            padding: 4px 6px !important;
        }

        th {
            background-color: #AAB7B8 !important;
            color: #fff;
            text-transform: uppercase;
        }  
</style>
<style>
/* Style for the custom buttons */
.custom-button {
    color: #000000 !important; /* Black text for visibility */
    background-color: #f0f0f0 !important; /* Light gray background for contrast */
    border: 2px solid #000000 !important; /* Slightly thicker border for visibility */
    border-radius: 6px !important; /* Ensures the border radius is applied */
    padding: 8px 15px;  /* Adjusted padding for proper spacing and alignment */
    font-size: 16px;     /* Optional: increase font size for better proportion */
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
}

/* Specific styles for DataTables buttons */
.dataTables_wrapper .dt-buttons .custom-button {
    border-radius: 6px !important; /* Ensures border-radius is applied */
    border: 2px solid #000000 !important; /* Uniform border */
    overflow: visible !important; /* Prevents clipping */
    box-shadow: none !important; /* Removes conflicting shadows */
}

/* Fix parent container of DataTables buttons */
.dataTables_wrapper .dt-buttons {
    overflow: visible !important; /* Ensures rounded corners are not clipped */
    display: inline-flex; /* Aligns buttons properly */
    gap: 10px; /* Adds spacing between buttons */
}
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-transparent border-bottom">
                <h4 class="card-title mb-0">{{ translate('Supplier Report') }}</h4>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('report.supplier') }}" id="supplierFilterForm">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <select name="supplier_id" class="form-select"
                                    onchange="document.getElementById('supplierFilterForm').submit();">
                                <option value="">{{ translate('All Supplier') }}</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}"
                                            {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="status" class="form-select"
                                    onchange="document.getElementById('supplierFilterForm').submit();">
                                <option value="">{{ translate('All Status') }}</option>
                                <option value="Fully Paid"
                                        {{ request('status') == 'Fully Paid' ? 'selected' : '' }}>
                                    {{ translate('Fully Paid') }}
                                </option>
                                <option value="Advance"
                                        {{ request('status') == 'Advance' ? 'selected' : '' }}>
                                    {{ translate('Advance') }}
                                </option>
                                <option value="Pending"
                                        {{ request('status') == 'Pending' ? 'selected' : '' }}>
                                    {{ translate('Pending') }}
                                </option>
                            </select>
                        </div>
                    </div>
                </form>

                <!-- Table Section -->
                <div class="table-responsive">
                    <table class="table table-bordered" id="supplierTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ translate('Invoice ID') }}</th>
                            <th>{{ translate('Supplier') }}</th>
                            <th>{{ translate('Date') }}</th>
                            <th>{{ translate('Total') }}</th>
                            <th>{{ translate('Subtotal') }}</th>
                            <th>{{ translate('Due Price') }}</th>
                            <th>{{ translate('Balance') }}</th>
                            <th>{{ translate('Status') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($purchases as $purchase)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $purchase->inv_id }}</td>
                                <td>{{ $purchase->supplier ? $purchase->supplier->name : '-' }}</td>
                                <td>{{ $purchase->date }}</td>
                                <td class="text-center">{{ number_format($purchase->total_price, 2) }}</td>
                                <td class="text-center">{{ number_format($purchase->subtotal, 2) }}</td>
                                <td class="text-center">{{ number_format($purchase->due_price, 2) }}</td>
                                <td class="text-center">{{ number_format($purchase->balance, 2) }}</td>
                                <td>{{ $purchase->status }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">
                                    <h4 class="py-4">{{ translate('No data found!') }}</h4>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="pagination -flex justify-content-end">
                {!! $purchases->links() !!}
            </div>
        </div>
    </div>
</div>
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
            $('#supplierTable').DataTable({
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
                paging: false,  // Disable DataTables pagination
                searching: true,
                ordering: true,
                info: true,
                language: {
                    emptyTable: "{{ translate('No data available in table') }}",
                    search: "{{ translate('Search:') }}",
                    info: "{{ translate('Showing _PAGE_ of _PAGES_') }}",
                    infoFiltered: "{{ translate('(filtered from _MAX_ total records)') }}",
                    paginate: {
                        previous: "{{ translate('Previous') }}",
                        next: "{{ translate('Next') }}"
                    }
                }
            });
        });
    </script>
@endsection
