@extends('layouts.app')
@section('title', translate('common.supplier_add'))
@section('content')
    <section id="basic-horizontal-layouts">
        <section id="multiple-column-form">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ translate('common.Add New Supplier') }}</h4>
                        </div>
                        <div class="card-body">
                            <form class="form" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                    <div class="mb-1">
    <label class="form-label" for="first-name-column">{{ translate('common.name') }}</label>
    <font color="red">*</font>
    <input type="text" id="first-name-column" class="form-control" placeholder="{{ translate('common.name') }}" name="name" value="{{ old('name') }}" required>
    @if ($errors->has('name'))
        <span class="text-danger">{{ $errors->first('name') }}</span>
    @endif
</div>

                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="last-name-column">{{ translate('common.address') }}</label>
                                                <font color="red">*</font>
                                            <input type="text" id="last-name-column" class="form-control"
                                                placeholder="{{ translate('common.address') }}" name="address" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="city-column">{{ translate('common.phone') }}</label>
                                                <font color="red">*</font>
                                            <input type="text" id="city-column" class="form-control"
                                                placeholder="{{ translate('common.phone') }}" name="phone" required>
                                                @if ($errors->has('phone'))
        <span class="text-danger">{{ $errors->first('phone') }}</span>
    @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="country-floating">{{ translate('payable (due)') }}</label>
                                            <input type="number" step="0.01" id="country-floating" class="form-control"
                                                name="due" placeholder="{{ translate('common.payable (due)') }}">
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
