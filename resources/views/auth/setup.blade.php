@extends('layouts.admin-layout.guest')
@section('content')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-6 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img src="{{ asset('admin/images/digital-store.jpg') }}">
                            </div>
                            <h4>New here?</h4>
                            <h6 class="font-weight-light">Setup your database</h6>
                            @if (Session::has('db_error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ Session::get('db_error') }}
                                </div>
                            @endif
                            <form class="pt-3" method="POST" action="{{ route('setup.config') }}">
                                @csrf
                                <div class="form-group">
                                    <input id="db_name" class="form-control form-control-lg" type="text" name="db_name"
                                        :value="old('db_name')" required autofocus autocomplete="db_name"
                                        placeholder="Database Name">
                                    <x-input-error :messages="$errors->get('db_name')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <input id="db_username" class="form-control form-control-lg" type="text"
                                        name="db_username" :value="old('db_username')" required autocomplete="db_username"
                                        placeholder="Database Username">
                                    <x-input-error :messages="$errors->get('db_username')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <input id="db_password" class="form-control form-control-lg" type="text"
                                        name="db_password" :value="old('db_password')" autocomplete="db_password"
                                        placeholder="Database Password">
                                    <x-input-error :messages="$errors->get('db_password')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <input id="db_host" class="form-control form-control-lg" type="text" name="db_host"
                                        :value="old('db_host')" required autocomplete="db_host" placeholder="Database Host">
                                    <x-input-error :messages="$errors->get('db_host')" class="mt-2" />
                                </div>

                                <div class="mt-3">
                                    <button
                                        class="btn btn-block btn-gradient-success btn-lg font-weight-medium auth-form-btn">Setup</button>
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
