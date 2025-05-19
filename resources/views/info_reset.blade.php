@extends('layouts.app')
@section('title', translate('common.change_pass'))
@section('content')
    <section id="basic-horizontal-layouts">
        <section id="multiple-column-form">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('Change Basic Information') }}</h4>
                        </div>
                        <div class="card-body">
                            <form class="form" action="{{ url('/profile_info_setting') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-7 col-12 mr-100">
                                        <div class="mb-1">
                                            <label class="form-label" for="last-name-column-1">{{ __('Email') }}</label>
                                            <font color="red">*</font>
                                            <input type="email" id="last-name-column-1" class="form-control"
                                                name="email" value="{{ Auth::user()->email }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-12 mr-100">
                                        <div class="mb-1">
                                            <label class="form-label" for="city-column">{{ __('Name') }}</label>
                                            <font color="red">*</font>
                                            <input type="text" id="city-column" class="form-control" name="name"
                                                value="{{ Auth::user()->name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-12 mr-100">
    <div class="mb-1">
        <label class="form-label" for="city-column">{{ __('Image') }}</label>
        <input type="file" id="city-column" class="form-control" name="image" accept="image/*" onchange="previewImage(event)">
        <!-- Display the existing image if it exists -->
        @if(Auth::user()->image)
            <div id="existing-image">
                <img src="{{ asset('storage/images/profile/' . Auth::user()->image) }}" alt="Current Image" class="img-thumbnail mt-2" style="max-height: 150px;">
            </div>
        @endif

        <!-- Placeholder for new image preview -->
        <div id="new-image-preview" class="mt-2" style="display: none;">
            <img id="output" class="img-thumbnail" style="max-height: 150px;">
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
                <div class="col-md-6 col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ translate('common.change_password') }}</h4>
                        </div>
                        <div class="card-body">
                            <form class="form" action="{{ url('/profile_setting') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="last-name-column">{{ __('Current Password') }}</label>
                                                <font color="red">*</font>
                                            <input type="password" id="last-name-column" class="form-control" name="old"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 mr-100">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="last-name-column-1">{{ translate('common.new_password') }}</label>
                                                <font color="red">*</font>
                                            <input type="password" id="last-name-column-1" class="form-control"
                                                name="new" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 mr-100">
                                        <div class="mb-1">
                                            <label class="form-label"
                                                for="city-column">{{ translate('common.confirm_password') }}</label>
                                                <font color="red">*</font>
                                            <input type="password" id="city-column" class="form-control" name="confirm"
                                                required>
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


<script>
    function previewImage(event) {
        const output = document.getElementById('output');
        const previewDiv = document.getElementById('new-image-preview');
        const existingImageDiv = document.getElementById('existing-image');

        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function () {
                output.src = reader.result;
                previewDiv.style.display = 'block';
            };
            reader.readAsDataURL(file);

            // Hide the existing image if a new file is selected
            if (existingImageDiv) {
                existingImageDiv.style.display = 'none';
            }
        }
    }
</script>
@endsection

