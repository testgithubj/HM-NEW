@extends('layouts.backend')
@section('title', "Expense Categories")
@section('custom-css')

@endsection
@section('content')

<x-container title="Expense Categories" buttonTitle="Add New" buttonRoute="{{ route('expense-categories.create') }}">
    <div class="table-responsive pt-0">
        <table class="table" id="expense-categories-table">
            <x-table.thead :headers="[ 'Category Name', 'Description', 'Status', 'Action']"></x-table.thead>
            <tbody>
            @foreach($collection as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->description }}</td>
                    <td>{{ $row->status }}</td>
                    <td class="d-flex gap-1">
                        <x-action.edit route="{{ route('expense-categories.edit', $row->id) }}"></x-action.edit>
                        <x-action.delete route="{{ route('expense-categories.delete', $row->id) }}"></x-action.delete>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mt-3 d-flex justify-content-center">
            {{ $collection->links() }}
        </div>
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
        $('#expense-categories-table').DataTable({
            paging: false, // Enable pagination
            searching: true, // Enable searching
            ordering: false, // Disable column ordering globally
            lengthChange: true, // Allow users to change page length
            pageLength: 10, // Default number of rows per page
            language: {
                search: "Search Categories:", // Customize search placeholder
            },
            dom: '<"d-flex justify-content-end"f>t<"d-flex justify-content-between"lpi>', // Search box position
        });

        // Show modal if total_cash_in_hand == 0
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

@endsection
