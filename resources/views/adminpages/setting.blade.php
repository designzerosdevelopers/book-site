@extends('layouts.admin-layout.app')

@section('content')
    <div class="content-wrapper">
        @if (session('success'))
            <div id="success-alert" class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        {{-- stripe credientials --}}
        <div class="card">
            <div class="card-body">
                <h2 style="font-size: 24px; margin-bottom: 20px;">Stripe Configuration</h2>
                @foreach ($stripeSettings as $stripeSetting)
                    <form method="POST" action="{{ route('update.settings') }}">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ $stripeSetting['display_name'] }}</label>
                            <input type="text" class="form-control" name="{{ $stripeSetting['key'] }}"
                                value="{{ $stripeSetting['value'] }}">
                        </div>
                @endforeach
                <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
        <br>
        {{-- paypal credientials --}}
        <div class="card">
            <div class="card-body">
                <h2 style="font-size: 24px; margin-bottom: 20px;">PAY PAL Configuration</h2>
                @foreach ($paypalSettings as $paypalSetting)
                    <form method="POST" action="{{ route('update.settings') }}">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ $paypalSetting['display_name'] }}</label>
                            <input type="text" class="form-control" name="{{ $paypalSetting['key'] }}"
                                value="{{ $paypalSetting['value'] }}">
                        </div>
                @endforeach
                <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
        <br>
        {{-- email credientials --}}
        <div class="card">
            <div class="card-body">
                <h2 style="font-size: 24px; margin-bottom: 20px;">Mailer Configuration</h2>
                @foreach ($mailSettings as $mailSetting)
                    <form method="POST" action="{{ route('update.settings') }}">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ $mailSetting['display_name'] }}</label>
                            <input type="text" class="form-control" name="{{ $mailSetting['key'] }}"
                                value="{{ $mailSetting['value'] }}">
                        </div>
                @endforeach
                <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-body">
                <h2 style="font-size: 24px; margin-bottom: 20px;">AWS Configuration</h2>
                @foreach ($awsSettings as $awsSetting)
                    <form method="POST" action="{{ route('update.settings') }}">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ $awsSetting['display_name'] }}</label>
                            <input type="text" class="form-control" name="{{ $awsSetting['key'] }}"
                                value="{{ $awsSetting['value'] }}">
                        </div>
                @endforeach
                <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>        
    </div>
@stop
