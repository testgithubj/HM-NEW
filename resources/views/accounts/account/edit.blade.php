@extends('layouts.backend')
@section('title', "Edit account")
@section('content')
    <x-container title="Edit account" buttonTitle="Back" buttonRoute="{{ route('accounts.index') }}">
        <form action="{{ route('accounts.update', $account->id )}}" method="post" class="row">
            @csrf
            @method('put')

            @include('accounts.account.form')

            <x-form.button></x-form.button>
        </form>
    </x-container>
@endsection