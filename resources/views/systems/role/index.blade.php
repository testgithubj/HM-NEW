@extends('layouts.backend')
@section('title', "Roles")
@section('content')
    <x-container title="Roles" buttonTitle="Add New" buttonRoute="{{ route('role.create') }}">
        <div class="table-responsive pt-0">
            <table class="table">
                <thead class="table-light">
                <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($collection as $role)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->status }}</td>
                        <td>
                            <a class="btn btn-sm btn-info" href="{{ route('role.edit',$role->id ) }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete')"
                               href="{{ route('role.delete',$role->id ) }}">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </x-container>
@endsection