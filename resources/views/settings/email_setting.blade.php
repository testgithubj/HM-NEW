@extends('layouts.backend')
@section('title', "Email Settings")
@section('content')
    <x-container title="Email Settings">
        <form action="{{ route('setting.emailSetting') }}" method="post">
            @csrf
            <div class="row justify-content-center">
                <div class="col-lg-6 ">
                    <h4>Email Setting</h4>
                    <div class="form-group mb-2 mt-2">
                        <label class="">MAIL DRIVER</label>
                        <input type="text" name="MAIL_DRIVER" value="{{ setting('MAIL_DRIVER') }}"
                               class="form-control">
                        @error('MAIL_DRIVER')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-2 mt-2">
                        <label class="">MAIL HOST</label>
                        <input type="text" name="MAIL_HOST" value="{{ setting('MAIL_HOST') }}"
                               class="form-control">
                        @error('MAIL_HOST')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-2 mt-2">
                        <label class="">MAIL PORT</label>
                        <input type="text" name="MAIL_PORT" value="{{ setting('MAIL_PORT') }}"
                               class="form-control">
                        @error('MAIL_PORT')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-2 mt-2">
                        <label class="">MAIL USERNAME</label>
                        <input type="text" name="MAIL_USERNAME" value="{{ setting('MAIL_USERNAME') }}"
                               class="form-control">
                        @error('MAIL_USERNAME')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-2 mt-2">
                        <label class="">MAIL PASSWORD</label>
                        <input type="text" name="MAIL_PASSWORD" value="{{ setting('MAIL_PASSWORD') }}"
                               class="form-control">
                        @error('MAIL_PASSWORD')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-2 mt-2">
                        <label class="">MAIL ENCRYPTION</label>
                        <input type="text" name="MAIL_ENCRYPTION" value="{{ setting('MAIL_ENCRYPTION') }}"
                               class="form-control">
                        @error('MAIL_ENCRYPTION')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-2 mt-2">
                        <label class="">MAIL FROM ADDRESS</label>
                        <input type="text" name="MAIL_FROM_ADDRESS" value="{{ setting('MAIL_FROM_ADDRESS') }}"
                               class="form-control" placeholder="info@companyname.com">
                        @error('MAIL_FROM_ADDRESS')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label class="">MAIL FROM NAME</label>
                        <input type="text" name="MAIL_FROM_NAME" value="{{ setting('MAIL_FROM_NAME') }}"
                               class="form-control" placeholder="Company name">
                        @error('MAIL_FROM_NAME')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary btn-block mt-2">Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </x-container>
@endsection