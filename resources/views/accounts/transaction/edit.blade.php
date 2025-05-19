@extends('layouts.backend')
@section('title', "Edit transaction")
@section('content')
    <x-container title="Edit transaction" buttonTitle="Back" buttonRoute="{{ route('transactions.index') }}">
        <form action="{{ route('transactions.update', $transaction->id )}}" method="post" class="row">
            @csrf
            @method('put')

            @include('accounts.transaction.form')

            <x-form.button></x-form.button>
        </form>
    </x-container>
@endsection