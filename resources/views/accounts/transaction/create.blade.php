@extends('layouts.backend')
@section('title', "Add new transaction")
@section('content')
    <x-container title="Add new transaction" buttonTitle="Back" buttonRoute="{{ route('transactions.index') }}">
        <form action="{{route('transactions.store')}}" method="post" class="row">
            @csrf
            @include('accounts.transaction.form')
            <x-form.button></x-form.button>
        </form>
    </x-container>
@endsection