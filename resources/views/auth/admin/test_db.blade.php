@extends('layouts.admin-layout.guest')

@section('content')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img src="{{ asset('admin/images/digital-store.jpg') }}" alt="Digital Store Logo">
                            </div>
                            <h4>Database Connection</h4>
                            <p class="font-weight-light">Configration is setup. Click the button to test the connection.</p>
                            <form class="pt-3" method="POST" action="{{route('db.migrate')}}">
                                @csrf
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-block btn-gradient-success btn-lg font-weight-medium auth-form-btn">Check Database Connection</button>
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
@endsection
