@extends('layouts.backend')
@section('title', "Roles")
@section('content')
    <x-container title="Roles" buttonTitle="Add New" buttonRoute="{{ route('role.create') }}">
        <div class="table-responsive pt-0">
            <table class="table">
                <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Role Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($collection as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->display_name }}</td>

                        <td class="d-flex">
                            <x-action.edit route="{{ route('role.edit', $row->id) }}"></x-action.edit>
                            <x-action.delete route="{{ route('role.delete', $row->id) }}"></x-action.delete>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </x-container>
@endsection