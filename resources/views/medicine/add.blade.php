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
                            <h4 class="card-title">{{ translate('common.medicine_add') }}</h4>
                        </div>
                        <div class="card-body">
                            <form class="form" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="product-type">{{ translate('common.product_type') }}
                                                <font color="red">*</font>
                                            </label>
                                            <select class="select2 form-select" id="product-type" tabindex="-1"
                                                aria-hidden="true" name="product_type" required>
                                                <option>{{ translate('select_product_type') }}</option>
                                                <option value="FMCG">{{ translate('FMCG') }}</option>
                                                <option value="medicine">{{ translate('Medicine') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.bar_code') }}</label>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="{{ translate('common.qr_code') }}" name="qr_code">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.HSN Code') }}</label>
                                            <input type="text" id="first-name-column" class="form-control"
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
                                                placeholder="{{ translate('common.name') }}" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12" id="generic_name_field">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="generic_name">{{ translate('common.generic_name') }}</label>
                                            <input type="text" id="generic_name" class="form-control"
                                                placeholder="{{ translate('common.generic_name') }}" name="generic_name">
                                        </div>
                                    </div>

                                    <!-- Strength Field -->
                                    <div class="col-md-4 col-12" id="strength_field">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="strength">{{ translate('common.strength') }}</label>
                                            <input type="text" id="strength" class="form-control"
                                                placeholder="{{ translate('common.strength') }}" name="strength">
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.desc') }}</label>
                                            <input type="text" id="first-name-column" class="form-control"
                                                placeholder="{{ translate('common.desc') }}" name="des">
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="first-name-column">{{ translate('common.MRP') }}
                                                <font color="red">*</font>
                                            </label>
                                            <input type="number" step="0.01" id="first-name-column"
                                                class="form-control" placeholder="{{ translate('common.price') }}"
                                                name="price" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.buy_price') }} <font
                                                    color="red">*</font></label>
                                            <input type="number" step="0.01" id="first-name-column"
                                                class="form-control" placeholder="{{ translate('common.buy_price') }}"
                                                name="buy_price" required>
                                        </div>
                                    </div>


                                    {{-- <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.category') }}
                                            </label>
                                            <select class="select2 form-select" id="select2-basic"
                                                data-select2-id="select2-basic" tabindex="-1" aria-hidden="true"
                                                name="category_id">
                                                <option value="">{{ translate('Select Category') }}</option>
                                                @foreach ($category as $leafs)
                                                    <option value="{{ $leafs->id }}">{{ $leafs->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}



                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="mfg_date">
                                                {{ translate('common.mfg_date') }}
                                            </label>
                                            <input type="date" id="mfg_date" class="form-control" name="mfg_date">
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="exp_date">
                                                {{ translate('common.exp_date') }}
                                            </label>
                                            <input type="date" id="exp_date" class="form-control" name="exp_date">
                                        </div>
                                    </div>




                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.type') }}
                                                <font color="red">*</font>
                                            </label>
                                            <select class="select2 form-select" id="select2-basic"
                                                data-select2-id="select2-basic" tabindex="-1" aria-hidden="true"
                                                name="type_id" required>
                                                <option value="">{{ translate('Select type of medicine') }}</option>
                                                @foreach ($type as $types)
                                                    <option value="{{ $types->id }}">{{ $types->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.units') }}
                                                <font color="red">*</font>
                                            </label>
                                            <select class="select2 form-select" id="select2-basic"
                                                data-select2-id="select2-basic" tabindex="-1" aria-hidden="true"
                                                name="unit_id" required>
                                                <option value="">{{ translate('Select unit of medicine') }}</option>
                                                @foreach ($unit as $units)
                                                    <option value="{{ $units->id }}">{{ $units->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="first-name-column">{{ translate('common.packaging_size') }}
                                                <font color="red">*</font>
                                            </label>
                                            <select class="select2 form-select" id="select2-basic"
                                                data-select2-id="select2-basic" tabindex="-1" aria-hidden="true"
                                                name="leaf_id" required>
                                                <option value="">{{ translate('Select Box Size') }}</option>
                                                @foreach ($leaf as $leafs)
                                                    <option value="{{ $leafs->id }}">{{ $leafs->name }}
                                                        ({{ $leafs->amount }})
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
                                                placeholder="{{ translate('common.shelf') }}" name="shelf">
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
                                                    <option value="{{ $leafs->id }}">{{ $leafs->name }} </option>
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
                                                for="first-name-column">{{ translate('common.status') }}
                                                <font color="red">*</font>
                                            </label>
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
        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                tags: true
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Initially hide the fields based on the selected product type
            toggleFields();

            // Listen for changes in the product type dropdown
            $('#product-type').change(function() {
                toggleFields();
            });

            function toggleFields() {
                const selectedType = $('#product-type').val();
                if (selectedType === 'FMCG') {
                    $('#generic_name_field').hide();
                    $('#strength_field').hide();
                } else if (selectedType === 'medicine') {
                    $('#generic_name_field').show();
                    $('#strength_field').show();
                }
            }
        });
    </script>

@endsection
