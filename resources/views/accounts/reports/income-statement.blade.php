@extends('layouts.backend')
@section('title', "Income Statement")
@section('content')
<x-container title="Income Statement">
    <div class="text-end">
        <a href="javascript:" id="window-printer" onclick="return(window.print())" class="btn btn-sm btn-success mb-2">
            <i class="fa fa-print"></i>
            {{ translate('common.Print') }}
        </a>
    </div>
    <div class="table-responsive pt-0">
        <table class="table">
            <thead>
            <tr>
                <th>{{ translate('common.Account Name') }}</th>
                <th>{{ translate('common.Balance') }}</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th><h4>{{ translate('common.Revenue') }}</h4></th>
            </tr>
            @foreach($incomeStatement['revenues'] as $balance)
                <tr>
                    <td class="name">{{ $balance->account_name }}</td>
                    <td>{{  priceFormat($balance->balance) }}</td>
                </tr>
            @endforeach
            <tr>
                <td><h5>{{ translate('common.Total') }}</h5></td>
                <td><h5 class="text-decoration-underline">{{  priceFormat($incomeStatement['totalRevenue']) }}</h5></td>
            </tr>
            <tr>
                <th><h4>{{ translate('common.Expense') }}</h4></th>
            </tr>
            @foreach($incomeStatement['expenses'] as $balance)
                <tr>
                    <td class="name">{{ $balance->account_name }}</td>
                    <td>{{  priceFormat($balance->balance) }}</td>
                </tr>
            @endforeach
            <tr>
                <td><h5>{{ translate('common.Total') }}</h5></td>
                <td><h5 class="text-decoration-underline">{{  priceFormat($incomeStatement['totalExpense']) }}</h5></td>
            </tr>
            <tr>
                <td class="name"><h4>{{ translate('common.net Income') }}</h4></td>
                <td><h4>{{ priceFormat($incomeStatement['netIncome']) }}</h4></td>
            </tr>
            </tbody>
        </table>
        <hr>
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