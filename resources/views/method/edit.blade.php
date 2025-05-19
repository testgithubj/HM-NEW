@extends('layouts.app')
@section('title', translate('common.add_method'))
@section('content')
    <section id="basic-horizontal-layouts">
        <section id="multiple-column-form">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ translate('common.edit payment method') }}</h4>
                        </div>
                        <div class="card-body">
                        <form method="POST" action="{{ route('payment.method.update', ['id' => $method->id]) }}">
                            @csrf
                            @method('PUT')
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="mb-1">
                <label class="form-label" for="first-name-column">{{ translate('common.name') }}</label>
                <font color="red">*</font>
                <input type="text" id="first-name-column" class="form-control" placeholder="{{ translate('common.name') }}" name="name" value="{{ $method->name }}" required>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="mb-1">
                <label class="form-label" for="first-name-column">{{ translate('common.balance') }}</label>
                <font color="red">*</font>
                <input type="number" step="0.01" id="first-name-column" class="form-control" placeholder="Balance" name="balance" value="{{ $method->balance }}" required>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">{{ translate('common.submit') }}</button>
            <button type="reset" class="btn btn-outline-secondary waves-effect">{{ translate('common.reset') }}</button>
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
