@extends('layouts.backend')
@section('title', "Edit user")
@section('content')
    <x-container title="Edit user" buttonTitle="Back" buttonRoute="{{ route('user.index') }}">
        <form action="{{route('user.update', $user->id)}}" method="post" class="row">
            @csrf
            @method('put')
            <x-form.select
                    name="role"
                    label="Role"
                    col="col-md-6">
                @foreach($roles as $role)
                    <option value="{{ $role['name'] }}" @if($user->hasRole($role['name'])) selected @endif>
                        {{ $role['display_name'] }}
                    </option>
                @endforeach
            </x-form.select>
            <x-form.input
                    name="name"
                    label="Name"
                    value="{{ $user->name }}"
                    col="col-md-6">
            </x-form.input>
            <x-form.input
                    name="email"
                    label="Email"
                    value="{{ $user->email }}"
                    col="col-md-6">
            </x-form.input>

            <x-form.input
                    name="password"
                    label="Update Password"
                    value=""
                    col="col-md-6">
            </x-form.input>

            <x-form.button></x-form.button>
        </form>
    </x-container>
@endsection