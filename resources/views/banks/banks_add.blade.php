@extends('layouts.app')
@section('title', translate('common.medicine_add'))
@section('custom-css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard/app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/css/pages/app-invoice.css') }}">
@endsection
@section('content')
    <section id="basic-horizontal-layouts">
        <section id="multiple-column-form">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ translate('common.add Bank account') }}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('bank.add') }}" class="form" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.Account Holder Name') }}</label>
                                                <font color="red">*</font>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="{{ translate('common.Account Holder Name') }}" name="account_holder_name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.Bank Name') }}</label>
                                                <font color="red">*</font>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="{{ translate('common.Bank Name') }}" name="account_number" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="first-name-column">{{ translate('common.account_type') }}
                                                <font color="red">*</font>
                                            </label>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="{{ translate('common.account_type') }}" name="account_type" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.ifsc_code') }}</label>
                                                <font color="red">*</font>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="{{ translate('common.ifsc_code') }}" name="ifsc_code" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.branch_name') }}</label>
                                                <font color="red">*</font>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="{{ translate('common.branch_name') }}" name="branch_name" required>
                                        </div>
                                    </div>

                                   

                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.branch_address') }}</label>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="{{ translate('common.branch_address') }}" name="branch_address">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.contact number') }}</label>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="{{ translate('common.contact number') }}" name="contact_number">
                                        </div>
                                    </div>
                                   
                                  
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.email') }}
                                                <font color="red">*</font>
                                            </label>
                                            <input type="email" step="0.01" id="first-name-column"
                                                class="form-control" placeholder="{{ translate('common.email') }}"
                                                name="email" required>
                                        </div>
                                    </div>
                                   
                                   

                                   
                                   
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.status') }} </label>
                                                <font color="red">*</font>
                                            <div class="demo-inline-spacing">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="inlineRadio1" value="1" required>
                                                    <label class="form-check-label"
                                                        for="inlineRadio1">{{ translate('Active') }}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="inlineRadio2" value="0" required>
                                                    <label class="form-check-label"
                                                        for="inlineRadio2">{{ translate('Inactive') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit"
                                            class="btn btn-primary me-1 waves-effect waves-float waves-light">{{ translate('common.submit') }}</button>
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



@section('custom-js')
    <script src="{{ asset('dashboard/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>

    <script src="{{ asset('dashboard/app-assets/js/scripts/forms/form-select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                tags: true
            });
        });
    </script>
@endsection
