@extends('layouts.backend')
@section('title', "Expenses")
@section('custom-css')
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
@endsection
@section('content')

<x-container title="Expenses" buttonTitle="Add New" buttonRoute="{{ route('expenses.create') }}">

    <!-- Filter Form -->
    <form id="filter-form" method="GET" action="{{ route('expenses.index') }}" class="d-flex gap-2 mb-4 align-items-center">
        <div>
            <select name="category_id" class="form-select" onchange="updateFilter()">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ isset($category_id) && $category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <!-- Expenses Table -->
    <div class="table-responsive pt-0">
        <table class="table" id="expenses-table">
            <x-table.thead :headers="['Date', 'Category', 'Expense for', 'Reference', 'Amount', 'Actions']"></x-table.thead>
            <tbody id="expenses-body">
                @if ($collection->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center">No Data Found</td>
                    </tr>
                @else
                    @php $total = 0; @endphp
                    @foreach ($collection as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->date }}</td>
                            <td>{{ $row->category->name }}</td>
                            <td>{{ $row->title }}</td>
                            <td>{{ $row->reference }}</td>
                            <td>{{ priceFormat($row->amount) }}</td>
                            <td class="d-flex gap-1">
                                <x-action.edit route="{{ route('expenses.edit', $row->id) }}"></x-action.edit>
                                <x-action.delete route="{{ route('expenses.delete', $row->id) }}"></x-action.delete>  
                            </td>
                        </tr>
                        @php $total += $row->amount; @endphp
                    @endforeach
                @endif
            </tbody>
        </table>
        <!-- Total Row Outside the DataTable to prevent interference -->
        @if (!$collection->isEmpty())
            <tr class="text-center">
                <td colspan="11" class="text-end"><b>Total</b></td>
                <td><b>{{ priceFormat($total) }}</b></td>
                <td></td>
            </tr>
        @endif
    </div>
</x-container>

@endsection

@section('custom-js')

<!-- Include DataTables JS -->
<script src="{{ asset('dashboard/app-assets/vendors/js/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#expenses-table').DataTable({
            searching: true, // Enable searching
            lengthChange: true, // Allow users to change page length
            language: {
                search: "Search Expenses:", // Customize search placeholder
            },
            dom: '<"row"<"col-sm-6"l><"col-sm-6"f>>rt<"row"<"col-sm-12"i><"col-sm-12"p>>',
            // Disable search on last row (the total row)
            searchCols: [
                null, null, null, null, null, null
            ]
        });

        // Show modal if total_cash_in_hand == 0
        @if($total_cash_in_hand == 0)
            $('#stockmodal').modal('show');
        @endif
    });

    function updateFilter() {
        document.getElementById('filter-form').submit();
    }
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

@endsection
