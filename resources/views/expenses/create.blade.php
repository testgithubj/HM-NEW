@extends('layouts.backend')
@section('title', "Add new expense")
@section('content')
    <x-container title="Add new expense" buttonTitle="Back" buttonRoute="{{ route('expenses.index') }}">
        <form action="{{route('expenses.store')}}" method="post" class="row">
            @csrf
            <x-form.input
                    :required="true"
                    type="date"
                    name="date"
                    label="Expense Date"
                    value="{{ @old('date') }}"
                    col="col-md-6">
            </x-form.input>
            <x-form.select
    :required="true"
    name="category_id"
    label="Category"
    value="{{ @old('category_id') }}"
    col="col-md-6">
    <option value="" disabled selected>Choose a Category</option>
    @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
    @endforeach
</x-form.select>

            <x-form.input
                    :required="true"
                    name="title"
                    label="Expense for"
                    value="{{ @old('title') }}"
                    col="col-md-6">
            </x-form.input>
            <x-form.input
                    :required="true"
                    type="number"
                    name="amount"
                    label="Amount"
                    value="{{ @old('amount') }}"
                    col="col-md-6">
            </x-form.input>
            <x-form.select
                    :required="true"
                    name="account_id"
                    label="Debit Account"
                    col="col-md-6">
                @foreach($accounts as $account)
                    <option value="{{ $account->id }}" {{ @$account->id == old('account_id') ? 'selected':'' }} >
                        {{ $account->name }}
                    </option>
                @endforeach
            </x-form.select>
            <x-form.select
    :required="true"
    name="credit_account_id"
    label="Credit Account"
    col="col-md-6">
    @foreach($accounts as $account)
        <option value="{{ $account->id }}" {{ @$account->id == old('credit_account_id') ? 'selected':'' }} >
            {{ $account->name }}
        </option>
    @endforeach
</x-form.select>
            <div> </div>
            <x-form.textarea
                    name="reference"
                    label="Reference"
                    value="{{ @old('reference') }}"
                    col="col-md-6">
            </x-form.textarea>
            <x-form.textarea
                    name="note"
                    label="Note"
                    value="{{ @old('note') }}"
                    col="col-md-6">
            </x-form.textarea>

            <x-form.button></x-form.button>
        </form>
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