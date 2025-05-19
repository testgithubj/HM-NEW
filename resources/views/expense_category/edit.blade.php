@extends('layouts.backend')
@section('title', "Edit Expense Categories")
@section('content')
    <x-container title="Edit Expense Categories" buttonTitle="Back" buttonRoute="{{ route('expense-categories.index') }}">
        <form action="{{route('expense-categories.update', $expenseCategory->id)}}" method="post" class="row">
            @csrf
            @method('put')
            <x-form.input
                    :required="true"
                    name="name"
                    label="Name"
                    value="{{ $expenseCategory->name }}"
                    col="col-md-6">
            </x-form.input>
            <x-form.select
                    :required="true"
                    name="status"
                    label="Status"
                    value="{{ @old('status') }}"
                    col="col-md-6">
                <option value="active" {{ $expenseCategory->status == 'active'?'selected':''}}>{{ translate('common.Active') }}</option>
                <option value="inactive" {{ $expenseCategory->status == 'inactive'?'selected':''}}>{{ translate('common.Inactive') }}</option>
            </x-form.select>

            <x-form.textarea
                    name="description"
                    label="Description"
                    value="{{ $expenseCategory->description }}">
            </x-form.textarea>

            <x-form.button></x-form.button>
        </form>
    </x-container>
@endsection