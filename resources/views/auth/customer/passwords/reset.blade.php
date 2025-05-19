@extends('layouts.guest')

@section('content')
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card border-0 bg-transparent py-5 my-5">
                        <div class="card-header bg-transparent border-0 text-center">
                            <h5>{{ translate('website.Reset Password') }}</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('customer.password.update') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-label-group mb-3">
                                    <label for="email" class="form-label">{{ translate('website.Email') }}</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                           autocomplete="email" value="{{ $email ?? old('email') }}">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-label-group mb-3">
                                    <label for="password" class="form-label">{{ translate('website.Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-label-group mb-3">
                                    <label for="password_confirmation" class="form-label">{{ translate('website.Confirm Password') }}</label>
                                    <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                                    @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-label-group d-flex justify-content-end mt-3">
                                    <button type="submit" class="btn btn-dark">
                                        {{ translate('website.Reset Password') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
