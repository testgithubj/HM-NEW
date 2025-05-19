@extends('layouts.backend')
@section('title', "Add new account")
@section('content')
    <x-container title="Add new account" buttonTitle="Back" buttonRoute="{{ route('accounts.index') }}">
        <form action="{{route('accounts.store')}}" method="post" class="row">
            @csrf
            @include('accounts.account.form')
            <x-form.button></x-form.button>
        </form>
    </x-container>
@endsection