@extends('layouts.backend')
@section('title', "Account Types")
@section('content')
<x-container title="Account Types">
    <div class="table-responsive pt-0">
        <table class="table">
            <x-table.thead :headers="['name','serial','status','action']"></x-table.thead>
            <tbody>
            @foreach($collection as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->serial }}</td>
                    <td>
                        <span class="badge {{ $row->status == 'active' ? 'bg-success' : 'bg-danger' }}">{{ $row->status }}</span>
                    </td>

                    @if($row->is_deletable)
                        <td class="d-flex gap-1">
                            <x-action.edit route="{{ route('account-types.edit', $row->id) }}"></x-action.edit>
                            <x-action.delete route="{{ route('account-types.destroy', $row->id) }}"></x-action.delete>
                        </td>
                    @else
                        <td>
                            <span class="text-danger"> {{ translate('common.No Action') }}</span>
                        </td>
                    @endif
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
@endsection