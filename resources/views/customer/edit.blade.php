@extends('layouts.backend')
@section('title', translate('title.Edit customer'))
@section('content')
    <x-container title="Edit customer" buttonTitle="Back to list" buttonRoute="{{ route('customer.index') }}">
        <form action="{{ route('customer.update', $customer->id) }}" method="post" class="row">
            @csrf
            @method('put')
            <label for="Email">name <span class="text-danger">*</span></label>
            <x-form.input
                    name="name"
                    value="{{ $customer->name }}"
                    col="col-md-6">
                    
            </x-form.input>
           <label for="Email">Email <span class="text-danger">*</span></label>
            <x-form.input
                    name="email"
                    value="{{ $customer->email }}"
                    col="col-md-6">
                   
            </x-form.input>
            <label for="Email">Phone <span class="text-danger">*</span></label>
            <x-form.input
                    name="phone"
                    value="{{ $customer->phone }}"
                    col="col-md-6">
            </x-form.input>
            <x-form.input
                    type="number"
                    name="due"
                    label="Due"
                    value="{{ $customer->due }}"
                    col="col-md-6">
            </x-form.input>
            <x-form.textarea
                    name="address"
                    label="Address"
                    value="{{ $customer->address }}"
                    col="col-md-12">
            </x-form.textarea>
            <x-form.button></x-form.button>
        </form>
    </x-container>
@endsection