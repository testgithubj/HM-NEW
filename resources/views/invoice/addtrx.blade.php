@extends('layouts.app')
@section('title', translate('common.add_pay'))
@section('content')
    <section id="basic-horizontal-layouts">
        <section id="multiple-column-form">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ translate('common.add_pay') }}</h4>
                        </div>
                        <div class="card-body">
                            <form class="form" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.payment_method') }}</label>

                                            <select name="method" class="form-select">
                                                @foreach (\App\Models\Method::all() as $method)
                                                    <option value="{{ $method->id }}">{{ $method->name }}</option>
                                                @endforeach



                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.amount') }}</label>
                                            <input type="number" step="0.01" id="first-name-column" class="form-control"
                                                value="{{ $invoice->due_price }}"
                                                placeholder="{{ translate('common.amount') }}" name="amount" required>
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
