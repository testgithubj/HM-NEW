<x-form.input
        :required="true"
        name="name"
        label="Name"
        value="{{ old('name', @$account->name) }}"
        col="col-md-6">
</x-form.input>
<x-form.select
        :required="true"
        name="account_type_id"
        label="Account Type"
        col="col-md-6">
    @foreach($accountTypes as $accountType)
        <option value="{{ $accountType->id }}" {{ @$accountType->id == @$account->account_type_id ? 'selected':'' }} >
            {{ $accountType->name }}
        </option>
    @endforeach
</x-form.select>
<x-form.input
        type="number"
        :required="true"
        name="serial"
        label="Serial"
        value="{{ old('serial', $serial ?? @$accountType->serial) }}"
        col="col-md-6">
</x-form.input>
<x-form.select
        name="status"
        label="Status"
        col="col-md-6">
    <option value="active" {{ @$account->status == 'active' ? 'selected':'' }} >{{ translate('common.Active') }}</option>
    <option value="inactive" {{ @$account->status == 'inactive' ? 'selected':'' }}>{{ translate('common.Inactive') }}</option>
</x-form.select>
