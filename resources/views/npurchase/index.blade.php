@extends('layouts.app')
@section('title', 'Purchase List')
@section('custom-css')
    <style>
        .table> :not(caption)>*>* {
            padding: 4px 6px !important;
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

    <!-- <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                    <h4 class="card-title mb-0">{{ translate('common.Purchase List') }}</h4>
                    <a href="{{ route('purchase.create') }}" class="btn btn-primary">{{ translate('common.New Purchase') }}</a>
                </div> -->
                <x-container title="Purchase List" buttonTitle="Add purchase" buttonRoute="{{ route('purchase.create') }}">
                <div class="card-body">
                    <div class="row justify-content-between mb-1">
                        <div class="col-lg-2">
                            <!-- Pagination Dropdown -->
                            <select name="paginate" onchange="changePagination(this.value)" class="form-select">
                                <option value="10" selected>{{ translate('common.Show') }}</option>
                                <option value="10" @if (request('paginate') == 10) selected @endif>{{ translate('common.10') }}</option>
                                <option value="20" @if (request('paginate') == 20) selected @endif>{{ translate('common.20') }}</option>
                                <option value="50" @if (request('paginate') == 50) selected @endif>{{ translate('common.50') }}</option>
                                <option value="100" @if (request('paginate') == 100) selected @endif>{{ translate('common.100') }}</option>
                                <option value="200" @if (request('paginate') == 200) selected @endif>{{ translate('common.200') }}</option>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <!-- Search form for invoice_id -->
                            <form action="{{ route('purchase.index') }}" method="GET">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search by Invoice ID" value="{{ request('search') }}" id="searchField">
    </div>
</form>
                        </div>
                    </div>
                    <div class="table-responsive pt-0">
                        <table class="table">
                        <x-table.thead :headers="['invoice_id','supplier','Date','Medicines','Quantity','Subtotal','Discount','Total','Paid','Due','Payment Method','Action']"></x-table.thead>
                            <tbody>
                                @forelse($purchases as $purchase)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $purchase->inv_id }}</td>
                                        <td>{{ $purchase->supplier ? $purchase->supplier->name : '-' }}</td>
                                        <td>{{ $purchase->date }}</td>
                                        <td>
                                            @if($purchase->batch && $purchase->batch->isNotEmpty())
                                                @foreach ($purchase->batch as $batch)
                                                    <span>{{ $batch->medicine->name ?? 'N/A' }}</span><br>
                                                @endforeach
                                            @else
                                                <span>No Medicines Found</span>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $purchase->qty }}</td>
                                        <td class="text-center">{{ number_format($purchase->subtotal, 2) }}</td>
                                        <td class="text-center">{{ $purchase->discount }}</td>
                                        <td class="text-center">{{ number_format($purchase->total_price, 2) }}</td>
                                        <td>{{ number_format($purchase->purchasePay->amount ?? 0) }}</td> <!-- Display paid amount -->
                                        <td class="text-center">{{ number_format($purchase->due_price, 2) }}</td>
                                        <td>{{ $purchase->method ? $purchase->method->name : '-' }}</td>
                                        <td>
                                            <a href="{{ route('purchase.show', $purchase->id) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('purchase.return.form', $purchase->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-undo"></i></a>
                                            <a onclick="return confirm('{{ translate('common.Are you sure to delete') }}')" href="{{ route('purchase.destroy', $purchase->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="13" class="text-center">
                                            <h4 class="py-4">{{ translate('common.No data found') }}!</h4>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="pagination -flex justify-content-end">
                        {!! $purchases->links() !!}
                    </div>
                        </div>
                        </x-container>
                    <!-- Pagination Links -->
                   
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
    <script>
        // Automatically trigger the search when the user types in the search field
        document.getElementById('searchField').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Prevent the default behavior of 'Enter' key
            this.form.submit(); // Submit the form
        }
    });

        // Function to handle pagination and retain search query in URL
        function changePagination(paginate) {
            var nurl = new URL('{{ route('purchase.index') }}');
            nurl.searchParams.set('paginate', paginate);

            // Add search query if exists
            var searchQuery = document.querySelector('input[name="search"]').value;
            if (searchQuery) {
                nurl.searchParams.set('search', searchQuery);
            }

            location.href = nurl;
        }
    </script>
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

@endsection
