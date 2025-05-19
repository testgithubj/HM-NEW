@extends('layouts.app')
@section('title', translate('common.Supplier_list'))
@section('custom-css')
<link rel="stylesheet" type="text/css"
          href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('dashboard/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
    <style>
        .table> :not(caption)>*>* {
            padding: 4px 6px !important;
        }
    </style>
@endsection

@section('content')
    <x-container title="Supplier" buttonTitle="Add Supplier" buttonRoute="{{ route('supplier.add') }}">
        <div class="table-responsive pt-0">
            <table class="table">
                <x-table.thead :headers="['Name','Phone','Payable','Address','Action']"></x-table.thead>
                <tbody>
                    @foreach ($collection as $row)
                        <tr>
                            <td>{{ $loop->index + 1 + ($collection->currentPage() - 1) * $collection->perPage() }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->phone }}</td>
                            <td>{{ priceFormat($row->due) }}</td>
                            <td>{{ $row->address }}</td>

                            <td class="d-flex gap-1">
                                <x-action.edit  route="{{ route('supplier.edit', $row->id) }}"></x-action.edit>
                                <x-action.show  route="{{ route('supplier.view', $row->id) }}"></x-action.show>
                                <form class="d-inline-block" method="post" onsubmit="return confirm('are you sure want to delete this supplier?')"
                                    action="{{ route('supplier.delete', $row->id) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-circle">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination -flex justify-content-end">
                {!! $collection->links() !!}
            </div>
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
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100 text-center position-relative">
                        {{ translate('common.Action required') }}
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
        // Initialize DataTable without pagination (let Laravel handle it)
        $('.table').DataTable({
            responsive: true,
            paging: false,  // Disable DataTable's pagination
            searching: true,
            ordering: true,
            info: true,
        });
    });
</script>

@endsection
