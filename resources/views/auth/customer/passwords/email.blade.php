@extends('layouts.guest')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 bg-transparent py-5 my-5">
                    <div class="card-header bg-transparent border-0 text-center">
                        <h5>{{ translate('website.Reset Password') }}</h5>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('customer.password.email') }}">
                            @csrf
                            <div class="form-label-group">
                                <label for="email" class="form-label">{{ translate('website.Email') }}</label>
                                <input type="email" name="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                                       autocomplete="email" autofocus>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-label-group d-flex justify-content-center mt-5">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
