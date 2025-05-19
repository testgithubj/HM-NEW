<x-form.input
        :required="true"
        name="name"
        label="Name"
        value="{{ old('name', @$accountType->name) }}"
        col="col-md-6">
</x-form.input>
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
    <option value="active" {{ @$accountType->status == 'active' ? 'selected':'' }} >{{ translate('common.Active') }}</option>
    <option value="inactive" {{ @$accountType->status == 'inactive' ? 'selected':'' }}>{{ translate('common.Inactive') }}</option>
</x-form.select>
