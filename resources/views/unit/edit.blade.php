@extends('layouts.app')
@section('title', translate('common.edit_unit'))
@section('content')
    <section id="basic-horizontal-layouts">
        <section id="multiple-column-form">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ translate('common.edit_unit') }}</h4>
                        </div>
                        <div class="card-body">
                            <form class="form" method="POST" action="{{ route('unit.edit', $customer->id) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.name') }}</label>
                                                <font color="red">*</font>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="{{ translate('common.name') }}" value="{{ $customer->name }}"
                                                name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit"
                                            class="btn btn-primary me-1 waves-effect waves-float waves-light">{{ translate('common.submit') }}</button>
                                        <button type="reset"
                                            class="btn btn-outline-secondary waves-effect">{{ translate('common.reset') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection
