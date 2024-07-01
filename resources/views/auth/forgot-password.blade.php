@extends('layouts.admin-layout.guest')

@section('content')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">


                        @if (session('status'))
                            <div class="alert alert-success" role="alert" id="success-alert">
                                <x-auth-session-status class="mb-4" :status="session('status')" />
                            </div>
                        @endif

                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img src="{{ asset('admin/images/digital-store.jpg') }}">
                            </div>
                            <h4>Reset Password</h4>
                            <h6 class="font-weight-light">
                                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                            </h6>

                            <form method="POST" action="{{ route('password.email') }}">

                                @csrf
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" id="email" type="email"
                                        name="email" :value="old('email')" required autofocus autocomplete="username"
                                        placeholder="Email">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <div class="text-center mt-4 font-weight-light">
                                    <button type="submit"
                                        class="btn btn-block btn-gradient-success btn-lg font-weight-medium auth-form-btn">{{ __('Email Password Reset Link') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
@stop
