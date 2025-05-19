@extends('layouts.app')
@section('title', translate('common.payment_method'))
@php
    $setting = Auth::user()->shop;
@endphp

@section('content')
    <x-container title="payment_method" buttonTitle="Add New" buttonRoute="{{ route('payment.add') }}">
        <div class="table-responsive pt-0">
            <table class="table">
                <x-table.thead :headers="['Name', 'balance', 'Option']"></x-table.thead>
                <tbody>
                    @foreach ($methods as $method)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $method->name }}</td>
                            <td>{{ priceFormat($method->balance) }}</td>
                            <td class="d-flex gap-1">
                                <x-action.edit route="{{ route('payment.method.edit', $method->id) }}"></x-action.edit>
                                <x-action.delete route="{{ route('payment.delete', $method->id) }}"></x-action.delete>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td class="text-end bg-warning fw-bold">{{ translate('Total Balance') }}</td>
                        <td><strong>{{ priceFormat($total_balance) }}</strong></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </x-container>
@endsection
