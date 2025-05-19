@extends('layouts.backend')
@section('title', "Transactions")
@section('content')
<x-container title="transaction">
    <div class="table-responsive pt-0">
        <table class="table">
            <x-table.thead :headers="['Date','Debit Account','Credit Account','Amount','Type','Particulars','Action']"></x-table.thead>
            <tbody>
            @foreach($collection as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ @$row->date }}</td>
                    <td>{{ @$row->debitAccount->name }}</td>
                    <td>{{ @$row->creditAccount->name }}</td>
                    <td>{{ $row->amount }}</td>
                    <td>
                        @if(in_array($row->amount, $expenseAccounts))
                            Expense
                        @else
                            {{ ucfirst(str_replace('_', ' ', $row->invoice_type)) }}
                        @endif
                    </td>
                    <td>{{ $row->particular }}</td>
                    <td class="d-flex gap-1">
                        <x-action.edit route="{{ route('transactions.edit', $row->id) }}"></x-action.edit>
                        <x-action.delete route="{{ route('transactions.destroy', $row->id) }}"></x-action.delete>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- Add pagination links -->
    <div class="d-flex justify-content-center">
        {{ $collection->links('pagination::bootstrap-4') }}
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
