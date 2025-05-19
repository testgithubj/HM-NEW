@extends('layouts.backend')
@section('title', "User")
@section('content')
<x-container title="Users" buttonTitle="Add New" buttonRoute="{{ route('user.create') }}">
    <div class="table-responsive pt-0">
        <table class="table">
            <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Role</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($collection as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->role_name }}</td>
                    <td>{{ $row->email }}</td>
                    <td class="d-flex">
                        <x-action.edit route="{{ route('user.edit', $row->id) }}"></x-action.edit>
                        <x-action.delete route="{{ route('user.delete', $row->id) }}"></x-action.delete>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-container>
@endsection