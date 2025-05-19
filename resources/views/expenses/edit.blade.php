@extends('layouts.backend')
@section('title', "Edit expense")
@section('content')
    <x-container title="Edit expense" buttonTitle="Back" buttonRoute="{{ route('expenses.index') }}">
        <form action="{{ route('expenses.update', $expense->id )}}" method="post" class="row">
            @csrf
            @method('put')
            <x-form.input
                    :required="true"
                    type="date"
                    name="date"
                    label="Expense Date"
                    value="{{ $expense->date }}"
                    col="col-md-6">
            </x-form.input>
            <x-form.select
                    :required="true"
                    name="category_id"
                    label="Category"
                    col="col-md-6">
                @foreach($categories as $category)
                    <option {{ $expense->category_id == $category->id ? 'selected' : '' }} value="{{$category->id}}">{{ $category->name }}</option>
                @endforeach
            </x-form.select>
            <x-form.input
                    :required="true"
                    name="title"
                    label="Expense for"
                    value="{{ $expense->title }}"
                    col="col-md-6">
            </x-form.input>

            <x-form.input
                    :required="true"
                    type="number"
                    name="amount"
                    label="Amount"
                    value="{{ $expense->amount }}"
                    col="col-md-6">
            </x-form.input>
            <x-form.select
                    :required="true"
                    name="account_id"
                    label="Debit Account"
                    col="col-md-6">
                @foreach($accounts as $account)
                    <option value="{{ $account->id }}" {{ @$account->id == @$expense->account_id ? 'selected':'' }} >
                        {{ $account->name }}
                    </option>
                @endforeach
            </x-form.select>
            <div></div>
            <x-form.textarea
                    name="reference"
                    label="Reference"
                    value="{{ $expense->reference }}"
                    col="col-md-6">
            </x-form.textarea>

            <x-form.textarea
                    name="note"
                    label="Note"
                    value="{{ $expense->note }}"
                    col="col-md-6">
            </x-form.textarea>

            <x-form.button></x-form.button>
        </form>
    </x-container>
@endsection