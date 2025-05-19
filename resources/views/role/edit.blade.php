@extends('layouts.backend')
@section('title', "Add New Role")
@php
    function checked($action, $role)
    {
        $permitteds = $role->permissions->toArray();
        foreach ($permitteds as $permitted) {
            if ($action == $permitted['name']) {
                return true;
            }
        }
        return false;
    }
@endphp
@section('content')
    <x-container title="Add New Role" buttonTitle="Back to list" buttonRoute="{{ route('role.index') }}">
        <form action="{{route('role.update', $role->id)}}" method="post" class="row">
            @csrf
            @method('put')
            <x-form.input
                    :required="true"
                    name="name"
                    label="Role Name"
                    value="{{ $role->display_name }}"
                    col="col-md-5"
            ></x-form.input>

            <div class="col-lg-12">
                <div class="row justify-content-between align-content-center mb-1">
                    <div class="col-lg-4">
                        <h4><i class="fa fa-list-alt"></i> {{ translate('Modules') }}</h4>
                    </div>
                    <div class="col-lg-2 float-end">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                   id="checked-all">
                            <label class="form-check-label" for="checked-all">
                                {{ translate('Checked All') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row pe-4">
                    @foreach ($permissions as $module => $permission)
                        <div class="shadow-sm rounded-3 py-1 mb-2 bg-light mx-1">
                            <div class="row">
                                <div class="col-lg-3">
                                    <h4 class="mb-0">{{ $module }}</h4>
                                </div>
                                <div class="col-lg-9">
                                    <div class="row">
                                        @foreach ($permission as $action)
                                            <div class="col mb-1">
                                                <div class="form-check">
                                                    <input type="checkbox" name="permissions[{{ $action['id'] }}]"
                                                           value="{{ $action['name'] }}" class="form-check-input action-check"
                                                           id="{{ strtolower($module) }}-{{ strtolower($action['label']) }}"
                                                           @if (checked($action['name'], $role)) checked @endif>
                                                    <label class="form-check-label"
                                                           for="{{ strtolower($module) }}-{{ strtolower($action['label']) }}">
                                                        {{ $action['label'] }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <x-form.button></x-form.button>
        </form>
    </x-container>
@endsection

@push('js')

    <script>
        let allChecked = document.getElementById('checked-all');
        let allAction = document.querySelectorAll('.action-check');
        allChecked.addEventListener('change', function() {
            allAction.forEach((item) => {
                item.checked = allChecked.checked;
            })
        })
    </script>
@endpush