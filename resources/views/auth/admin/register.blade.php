@extends('layouts.admin-layout.guest')
@section('content')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img src="{{ asset('admin/images/digital-store.jpg') }}">
                            </div>
                            <h4>New here?</h4>
                            <h6 class="font-weight-light">One time admin signup page. It only takes a few steps</h6>
                            @if (isset($success))
                                <div id="successMessage" class="alert alert-success">
                                    {{ $success }}
                                </div>
                            @endif

                            <form class="pt-3" method="POST" action="{{ route('admin.store') }}">
                                @csrf
                                <div class="form-group">
                                    <input id="name" class="form-control form-control-lg" type="text" name="name"
                                        :value="old('name')" required autofocus autocomplete="name" placeholder="Name">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <input id="email" class="form-control form-control-lg" type="email" name="email"
                                        :value="old('email')" required autocomplete="username" placeholder="Email">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <input type="hidden" name="role" value="1">
                                <div class="form-group">
                                    <input id="password" type="password" name="password" required
                                        autocomplete="new-password" class="form-control form-control-lg"
                                        placeholder="Password">
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <input id="password_confirmation" type="password" name="password_confirmation" required
                                        autocomplete="new-password" class="form-control form-control-lg"
                                        placeholder="Confirm Password">
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                                <div class="mb-4">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input"> I agree to all Terms &
                                            Conditions </label>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button
                                        class="btn btn-block btn-gradient-success btn-lg font-weight-medium auth-form-btn">SIGN
                                        UP</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light"> Already have an account? <a
                                        href="{{ route('login') }}" class="text-primary">Login</a>
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
<script>
  setTimeout(function() {
      document.getElementById('successMessage').style.display = 'none';
  }, 3000); // Hide after 3 seconds (3000 milliseconds)
</script>