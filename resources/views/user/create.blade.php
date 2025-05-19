@extends('layouts.backend')
@section('title', "Add new user")
@section('content')
    <x-container title="Add new user" buttonTitle="Back" buttonRoute="{{ route('user.index') }}">
        <form action="{{route('user.store')}}" method="post" class="row">
            @csrf
            <x-form.select
                    name="role"
                    label="Role"
                    col="col-md-6">
                @foreach($roles as $role)
                    <option value="{{$role['name']}}">{{$role['display_name']}}</option>
                @endforeach
            </x-form.select>
            <x-form.input
                    name="name"
                    label="Name"
                    value="{{ @old('name') }}"
                    col="col-md-6">
            </x-form.input>
            <x-form.input
                    name="email"
                    label="Email"
                    value="{{ @old('email') }}"
                    col="col-md-6">
            </x-form.input>

            <x-form.input
                    name="password"
                    label="Password"
                    value="{{ @old('password') }}"
                    col="col-md-6">
            </x-form.input>

            <x-form.button></x-form.button>
        </form>
    </x-container>
@endsection