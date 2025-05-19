@extends('layouts.app')
@section('title', translate('common.medicine_edit'))
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
                            <h4 class="card-title">{{ translate('common.banks_add') }}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('bank.update', $contact->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                            
                                <input type="hidden" name="contact_id" value="{{ $contact->id }}">
                            
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="account-holder-name">{{ translate('common.Account Holder Name') }}
                                            <font color="red">*</font>
                                            </label>
                                            <input type="text" id="account-holder-name" class="form-control"
                                                placeholder="{{ translate('common.Account Holder Name') }}"
                                                name="account_holder_name" value="{{ old('account_holder_name', $contact->account_holder_name) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="bank-name">{{ translate('common.Bank Name') }}
                                            <font color="red">*</font>
                                            </label>
                                            <input type="text" id="bank-name" class="form-control"
                                                placeholder="{{ translate('common.Bank Name') }}"
                                                name="account_number" value="{{ old('account_number', $contact->account_number) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="account-type">{{ translate('common.account_type') }} <font color="red">*</font></label>
                                            <input type="text" id="account-type" class="form-control"
                                                placeholder="{{ translate('common.account_type') }}" name="account_type"
                                                value="{{ old('account_type', $contact->account_type) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="ifsc-code">{{ translate('common.ifsc_code') }}
                                            <font color="red">*</font>
                                            </label>
                                            <input type="text" id="ifsc-code" class="form-control"
                                                placeholder="{{ translate('common.ifsc_code') }}" name="ifsc_code"
                                                value="{{ old('ifsc_code', $contact->ifsc_code) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="branch-name">{{ translate('common.branch_name') }}
                                            <font color="red">*</font>
                                            </label>
                                            <input type="text" id="branch-name" class="form-control"
                                                placeholder="{{ translate('common.branch_name') }}" name="branch_name"
                                                value="{{ old('branch_name', $contact->branch_name) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="branch-address">{{ translate('common.branch_address') }}</label>
                                            <input type="text" id="branch-address" class="form-control"
                                                placeholder="{{ translate('common.branch_address') }}" name="branch_address"
                                                value="{{ old('branch_address', $contact->branch_address) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="contact-number">{{ translate('common.contact_number') }}</label>
                                            <input type="text" id="contact-number" class="form-control"
                                                placeholder="{{ translate('common.contact_number') }}" name="contact_number"
                                                value="{{ old('contact_number', $contact->contact_number) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="email">{{ translate('common.email') }} <font color="red">*</font></label>
                                            <input type="email" id="email" class="form-control" placeholder="{{ translate('common.email') }}"
                                                name="email" value="{{ old('email', $contact->email) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label">{{ translate('common.status') }}
                                            <font color="red">*</font>
                                            </label>
                                            <div class="demo-inline-spacing">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status" id="active"
                                                        value="1" {{ old('status', $contact->status) == 1 ? 'checked' : '' }} required>
                                                    <label class="form-check-label" for="active">{{ translate('Active') }}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status" id="inactive"
                                                        value="0" {{ old('status', $contact->status) == 0 ? 'checked' : '' }} required>
                                                    <label class="form-check-label" for="inactive">{{ translate('Inactive') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">{{ translate('common.submit') }}</button>
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
