@extends('layouts.backend')
@section('title', "Trail Balance")
@section('content')
<x-container title="Trail Balance" >
    <div class="text-end">
        <a href="javascript:" id="window-printer" onclick="return(window.print())" class="btn btn-sm btn-success mb-2">
            <i class="fa fa-print"></i>
            {{ translate('common.Print') }}
        </a>
    </div>
    <div class="table-responsive pt-0">
        <table class="table">
            <x-table.thead :headers="['Account','Debit','Credit']"></x-table.thead>
            <tbody>
            @foreach($collection as $account)
                @if($account->total_debits > 0 || $account->total_credits > 0)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $account->name }}</td>
                    <td>{{ $account->total_debits != 0 ? priceFormat($account->total_debits) : '-' }}</td>
                    <td>{{ $account->total_credits != 0 ? priceFormat($account->total_credits) : '-' }}</td>
                </tr>
                @endif
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td></td>
                <td class="text-start"><h4 class="mb-0 text-dark fw-bold">{{ translate('common.Total') }}</h4></td>
                <td><h4 class="mb-0 text-dark fw-bold">{{ priceFormat($collection->sum('total_debits')) }}</h4></td>
                <td><h4 class="mb-0 text-dark fw-bold">{{ priceFormat($collection->sum('total_credits')) }}</h4></td>
            </tr>
            </tfoot>
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
@endsection