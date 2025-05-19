<x-form.input
        :required="true"
        type="date"
        name="date"
        label="Date"
        value="{{ old('date', @$transaction->date) }}"
        col="col-md-6">
</x-form.input>

<x-form.select
        :required="true"
        name="debit_account_id"
        label="Debit Account"
        col="col-md-6">
    @foreach($accounts as $account)
        <option value="{{ $account->id }}" {{ @$account->id == @$transaction->debit_account_id ? 'selected':'' }} >
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
        <option value="{{ $account->id }}" {{ @$account->id == @$transaction->credit_account_id ? 'selected':'' }} >
            {{ $account->name }}
        </option>
    @endforeach
</x-form.select>

<x-form.input
        type="number"
        :required="true"
        name="amount"
        label="Amount"
        value="{{ old('amount', @$transaction->amount) }}"
        col="col-md-6">
</x-form.input>
<x-form.input
        :required="true"
        name="particular"
        label="Particulars"
        value="{{ old('particular', @$transaction->particular) }}"
        col="col-md-6">
</x-form.input>

<x-form.select
        name="invoice_type"
        label="Invoice type"
        col="col-md-3">
    <option value="sale" {{ @$transaction->invoice_type == 'sale' ? 'selected':'' }} >{{ translate('common.Sale') }}</option>
    <option value="purchase" {{ @$transaction->invoice_type == 'purchase' ? 'selected':'' }}>{{ translate('common.Purchase') }}</option>
    <option value="sale_return" {{ @$transaction->invoice_type == 'sale_return' ? 'selected':'' }} >{{ translate('common.Sale Return') }}</option>
    <option value="purchase_return" {{ @$transaction->invoice_type == 'purchase_return' ? 'selected':'' }}>{{ translate('common.Purchase Return') }}</option>
</x-form.select>

<x-form.input
        name="invoice_id"
        label="Invoice ID"
        value="{{ old('invoice_id', @$transaction->invoice_id) }}"
        col="col-md-3">
</x-form.input>