@extends('layouts.backend')
@section('title', "Edit account types")
@section('content')
    <x-container title="Edit account types" buttonTitle="Back" buttonRoute="{{ route('account-types.index') }}">
        <form action="{{ route('account-types.update', $accountType->id )}}" method="post" class="row">
            @csrf
            @method('put')

            @include('accounts.account-type.form')

            <x-form.button></x-form.button>
        </form>
    </x-container>
@endsection