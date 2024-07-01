@extends('layouts.admin-layout.guest')

@section('content')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left p-5">
                        <div class="brand-logo">
                            <img src="{{ asset('admin/images/digital-store.jpg') }}" alt="logo">
                        </div>
                        <h4>Forgot your password?</h4>
                        <p class="font-weight-light mb-4">No problem. Just let us know your email address and we will
                            email you a password reset link that will allow you to choose a new one.</p>

                        @if (session('status'))
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}" class="pt-3">
                            @csrf

                            <!-- Email Address -->
                            <div class="form-group">
                                <input type="email" class="form-control form-control-lg" id="email" name="email"
                                    :value="old('email')" required autofocus autocomplete="username"
                                    placeholder="Email">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="mt-3">
                                <button type="submit"
                                    class="btn btn-block btn-gradient-success btn-lg font-weight-medium auth-form-btn">
                                    {{ __('Email Password Reset Link') }}
                                </button>
                            </div>

                            <div class="my-2 d-flex justify-content-between align-items-center">
                                <a href="{{ route('login') }}" class="auth-link text-black">{{ __('Back to Login') }}</a>
                            </div>
                        </form>

                        <div class="text-center mt-4 font-weight-light">
                            {{ __("Don't have an account?") }} <a href="{{ route('register') }}"
                                class="text-primary">{{ __('Create one') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
