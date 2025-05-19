@extends('layouts.app')
@section('title', translate('common.medicine_edit'))
@section('custom-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/app-assets/vendors/css/forms/select/select2.min.css') }}">
@endsection
@section('content')
    <section id="basic-horizontal-layouts">
        <section id="multiple-column-form">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ translate('common.medicine_edit') }}</h4>
                        </div>
                        <div class="card-body">
                            <form class="form" method="POST" enctype="multipart/form-data"
                                action="{{ route('medicine.edit', $medicine->id) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="product-type">
                                                {{ translate('common.product_type') }}
                                                <font color="red">*</font>
                                            </label>
                                            <select class="select2 form-select" id="product-type" name="product_type"
                                                required>
                                                <option value="" disabled
                                                    {{ old('product_type', $medicine->product_type ?? '') == '' ? 'selected' : '' }}>
                                                    {{ translate('select_product_type') }}
                                                </option>
                                                <option value="FMCG"
                                                    {{ old('product_type', $medicine->product_type ?? '') == 'FMCG' ? 'selected' : '' }}>
                                                    {{ translate('FMCG') }}
                                                </option>
                                                <option value="medicine"
                                                    {{ old('product_type', $medicine->product_type ?? '') == 'medicine' ? 'selected' : '' }}>
                                                    {{ translate('Medicine') }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.Barcode') }}</label>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="{{ translate('common.qr_code') }}"
                                                value="{{ $medicine->qr_code }}" name="qr_code">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.Hsn Code') }}</label>
                                            <input type="text" id="first-name-column" class="form-control"
                                                value="{{ $medicine->hns_code }}"
                                                placeholder="{{ translate('common.Hns Code') }}" name="hns_code">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.name') }}
                                                <font color="red">*</font>
                                            </label>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="{{ translate('common.name') }}" value="{{ $medicine->name }}"
                                                name="name" required>
                                        </div>
                                    </div>


                                    <div class="col-md-4 col-12 generic-strength-fields">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="generic_name">{{ translate('common.generic_name') }}</label>
                                            <input type="text" id="generic_name" class="form-control"
                                                placeholder="{{ translate('common.generic_name') }}" name="generic_name"
                                                value="{{ $medicine->generic_name }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12 generic-strength-fields">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="strength">{{ translate('common.strength') }}</label>
                                            <input type="text" id="strength" class="form-control"
                                                placeholder="{{ translate('common.strength') }}" name="strength"
                                                value="{{ $medicine->strength }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.desc') }}</label>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="{{ translate('common.desc') }}" name="des"
                                                value="{{ $medicine->des }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="first-name-column">{{ translate('common.MRP') }}
                                                <font color="red">*</font>
                                            </label>
                                            <input type="number" step="0.01" id="first-name-column" class="form-control"
                                                placeholder="{{ translate('common.price') }}" name="price"
                                                value="{{ $medicine->price }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.buy_price') }} <font
                                                    color="red">*</font></label>
                                            <input type="number" step="0.01" id="first-name-column"
                                                class="form-control" placeholder="{{ translate('common.buy_price') }}"
                                                name="buy_price" value="{{ $medicine->buy_price }}" required>
                                        </div>
                                    </div>



                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="mfg_date">
                                                {{ translate('common.mfg_date') }}
                                            </label>
                                            <input type="date" id="mfg_date" class="form-control" name="mfg_date"
                                                value="{{ $medicine->mfg_date }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="exp_date">
                                                {{ translate('common.exp_date') }}
                                            </label>
                                            <input type="date" id="exp_date" class="form-control" name="exp_date"
                                                value="{{ $medicine->exp_date }}">
                                        </div>
                                    </div>



                                    {{-- <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.category') }}
                                                <font color="red">*</font>
                                            </label>
                                            <select class="select2 form-select" id="select2-basic"
                                                data-select2-id="select2-basic" tabindex="-1" aria-hidden="true"
                                                name="category_id" required>
                                                <option value="">{{ translate('Select Category') }}</option>
                                                @foreach ($category as $leafs)
                                                    <option value="{{ $leafs->id }}"
                                                        @if ($medicine->category_id == $leafs->id) selected @endif>
                                                        {{ $leafs->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="type-select">{{ translate('common.type') }}
                                                <font color="red">*</font>
                                            </label>
                                            <select class="select2 form-select" id="type-select"
                                                data-select2-id="type-select"tabindex="-1" aria-hidden="true"
                                                name="type_id" required>
                                                <option value="">{{ translate('Select type of medicine') }}</option>
                                                @foreach ($type as $types)
                                                    <option value="{{ $types->id }}"
                                                        @if ($medicine->type_id == $types->id) selected @endif>
                                                        {{ $types->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="type-select">{{ translate('common.units') }}
                                                <font color="red">*</font>
                                            </label>
                                            <select class="select2 form-select" id="type-select"
                                                data-select2-id="type-select" tabindex="-1" aria-hidden="true"
                                                name="unit_id" required>
                                                <option value="">{{ translate('Select unit of medicine') }}</option>
                                                @foreach ($unit as $units)
                                                    <option value="{{ $units->id }}"
                                                        @if ($medicine->unit_id == $units->id) selected @endif>
                                                        {{ $units->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.packaging size') }}
                                                <font color="red">*</font>
                                            </label>
                                            <select class="select2 form-select" id="select2-basic"
                                                data-select2-id="select2-basic" tabindex="-1" aria-hidden="true"
                                                name="leaf_id" required>
                                                <option value="">{{ translate('Select Box Size') }}</option>
                                                @foreach ($leaf as $leafs)
                                                    <option value="{{ $leafs->id }}"
                                                        @if ($medicine->leaf_id == $leafs->id) selected @endif>
                                                        {{ $leafs->name }} ({{ $leafs->amount }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.shelf') }}</label>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="{{ translate('common.shelf') }}" name="shelf"
                                                value="{{ $medicine->shelf }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.supplier') }}
                                                <font color="red">*</font>
                                            </label>
                                            <select class="select2 form-select" id="select2-basic"
                                                data-select2-id="select2-basic" tabindex="-1" aria-hidden="true"
                                                name="supplier_id" required>
                                                <option value="">Select Supplier</option>
                                                @foreach ($supplier as $leafs)
                                                    <option value="{{ $leafs->id }}"
                                                        @if ($medicine->supplier_id == $leafs->id) selected @endif>
                                                        {{ $leafs->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>




                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.image') }}</label>
                                            <input class="form-control" type="file" name="image" id="formFile">
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.status') }} </label>
                                            <div class="demo-inline-spacing">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="inlineRadio1" value="1"
                                                        @if ($medicine->status == 1) checked="" @endif>
                                                    <label class="form-check-label"
                                                        for="inlineRadio1">{{ translate('Active') }}</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="inlineRadio2" value="0"
                                                        @if ($medicine->status == 0) checked="" @endif>
                                                    <label class="form-check-label"
                                                        for="inlineRadio2">{{ translate('Inactive') }}</label>
                                                </div>
                                            </div>
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

@section('custom-js')
    <script src="{{ asset('dashboard/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>

    <script src="{{ asset('dashboard/app-assets/js/scripts/forms/form-select2.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productType = document.getElementById('product-type');
            const genericStrengthFields = document.querySelectorAll('.generic-strength-fields');

            const toggleFieldsVisibility = () => {
                if (productType.value === 'FMCG') {
                    genericStrengthFields.forEach(field => {
                        field.style.display = 'none';
                    });
                } else {
                    genericStrengthFields.forEach(field => {
                        field.style.display = 'block';
                    });
                }
            };

            // Initial check on page load
            toggleFieldsVisibility();

            // Add event listener for changes
            productType.addEventListener('change', toggleFieldsVisibility);
        });
    </script>

@endsection
