@extends('layouts.backend')
@section('title', "General Settings")

@section('content')
    <x-container title="General Settings">

        <!-- Form -->
        <form class="form row" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-lg-8">
                <div class="row">
                    <x-form.input
                            col="col-lg-12"
                            name="app_name"
                            label="App name"
                            value="{{ setting('app_name') }}"
                    ></x-form.input>

                    <x-form.input
                            col="col-lg-6"
                            name="currency"
                            label="Currency"
                            value="{{ setting('currency') }}"
                    ></x-form.input>
                    <x-form.input
                            col="col-lg-6"
                            name="prefix"
                            label="Prefix"
                            value="{{ setting('prefix') }}"
                    ></x-form.input>
                    <x-form.input
                            col="col-lg-6"
                            name="email"
                            label="Email"
                            value="{{ setting('email') }}"
                    ></x-form.input>
                    <x-form.input
                            col="col-lg-6"
                            name="phone"
                            label="Phone"
                            value="{{ setting(',phone') }}"
                    ></x-form.input>
                    <x-form.input
                            col="col-lg-12"
                            name="address"
                            label="Address"
                            value="{{ setting('address') }}"
                    ></x-form.input>
                    <x-form.input
                            col="col-lg-6"
                            name="upcoming_expire_alert"
                            label="Upcoming Expire Alert"
                            value="{{ setting('upcoming_expire_alert') }}"
                    ></x-form.input>
                    <x-form.input
                            col="col-lg-6"
                            name="low_stock_alert"
                            label="Low Stock Alert"
                            value="{{ setting('low_stock_alert') }}"
                    ></x-form.input>
                    <x-form.select
                            col="col-lg-6"
                            name="time_zone"
                            label="Time Zone"
                    >
                        @foreach (\DateTimeZone::listIdentifiers() as $timezone)
                            <option {{ setting('time_zone') == $timezone ? 'selected' : '' }}
                                    value="{{ $timezone }}">{{ $timezone }}</option>
                        @endforeach
                    </x-form.select>
                </div>
            </div>
            <div class="col-lg-4 mb-2">
                <div class="media-setting">
                    <div class="row gy-3">
                    <div class="col-md-12">
    <label for="logo_image" class="form-label file-selectore">
        <span class="label">{{ translate('common.Select Logo') }}</span>
    </label>
    <div class="d-block my-2" id="logo_preview">
        @if (setting('logo'))
            <img id="existing_logo" height="55" width="250" 
                 src="{{ globalAsset(setting('logo'), 'settings') }}" 
                 alt="Current Logo">
        @else
            <p>No Logo Uploaded</p>
        @endif
    </div>
    <input type="file" name="logo" id="logo_image">
    <label class="text-muted mt-2">
        {{ translate('common.image size: 250 × 55 px') }}
    </label>
</div>

<div class="col-md-12">
    <label for="favicon_image" class="form-label file-selectore">
        <span class="label">{{ translate('common.Select Favicon') }}</span>
    </label>
    <div class="d-block my-2" id="favicon_preview">
        @if (setting('favicon'))
            <img id="existing_favicon" height="128" width="128" 
                 src="{{ globalAsset(setting('favicon'), 'settings') }}" 
                 alt="Current Favicon">
        @else
            <p>No Favicon Uploaded</p>
        @endif
    </div>
    <input type="file" name="favicon" id="favicon_image">
    <label class="text-muted mt-2">
        {{ translate('common.image size: 128 × 128 px') }}
    </label>
</div>


                    </div>
                </div>
            </div>
            <x-form.button title="Cancel" class="btn-outline-secondary waves-effect" type="reset" />
            <div class="d-flex justify-content-end mt-3">
                <!-- Reset Button -->
               

                <!-- Save Changes Button -->
                <x-form.button title="Save Changes" class="btn-primary"></x-form.button>
            </div>
        </form>
    </x-container>
    @endsection
    @section('custom-js')
    <script>
      document.addEventListener("DOMContentLoaded", function () {
    function setupImagePreview(inputId, previewId, defaultMessage) {
        const inputElement = document.getElementById(inputId);
        const previewElement = document.getElementById(previewId);

        inputElement.addEventListener("change", function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const previewImage = document.createElement("img");
                    previewImage.src = e.target.result;
                    if (inputId === "logo_image") {
                        previewImage.height = 55;
                        previewImage.width = 250;
                        previewImage.alt = "Uploaded Logo";
                    } else if (inputId === "favicon_image") {
                        previewImage.height = 128;
                        previewImage.width = 128;
                        previewImage.alt = "Uploaded Favicon";
                    }

                    // Replace existing content with the new image
                    previewElement.innerHTML = "";
                    previewElement.appendChild(previewImage);
                };
                reader.readAsDataURL(file);
            } else {
                // Display default message if no file is selected
                previewElement.innerHTML = `<p>${defaultMessage}</p>`;
            }
        });
    }

    // Set up previews for logo and favicon
    setupImagePreview("logo_image", "logo_preview", "No Logo Uploaded");
    setupImagePreview("favicon_image", "favicon_preview", "No Favicon Uploaded");
});


</script>
@endsection
