@extends('layouts.backend')
@section('title', "Update Bank Transaction")
@section('content')
    <x-container title="Update Bank Transaction" buttonTitle="Back" buttonRoute="{{ route('banktrans.index') }}">
        <form action="{{ route('banktrans.update', $banktrans->id) }}" method="POST" class="row">
            @csrf
            @method('PUT')
            
            <x-form.input
                :required="true"
                type="date"
                name="date"
                label="Transaction Date"
                value="{{ old('date', $banktrans->date) }}"
                col="col-md-6">
            </x-form.input>
            
            <x-form.select
                :required="true"
                name="paymentmethord_id"
                label="Payment Method"
                value="{{ old('paymentmethord_id', $banktrans->paymentmethord_id) }}"
                col="col-md-6">
                @foreach($methods as $method)
                    <option value="{{ $method->id }}" {{ $banktrans->paymentmethord_id == $method->id ? 'selected' : '' }}>
                        {{ $method->name }}
                    </option>
                @endforeach
            </x-form.select>
            
            <x-form.select
                :required="true"
                name="bank_id"
                label="Bank"
                value="{{ old('bank_id', $banktrans->bank_id) }}"
                col="col-md-6">
                @foreach($banks as $bank)
                    <option value="{{ $bank->id }}" {{ $banktrans->bank_id == $bank->id ? 'selected' : '' }}>
                        {{ $bank->account_holder_name }}
                    </option>
                @endforeach
            </x-form.select>
            
            <x-form.input
                :required="true"
                type="number"
                name="amount"
                label="Amount"
                value="{{ old('amount', $banktrans->amount) }}"
                col="col-md-6">
            </x-form.input>
            
            <x-form.input
                :required="true"
                name="serialnumber"
                label="Serial Number"
                value="{{ old('serialnumber', $banktrans->serialnumber) }}"
                col="col-md-6">
            </x-form.input>
            
            <x-form.button></x-form.button>
        </form>
    </x-container>
@endsection
