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
                @foreach ($stripeSettings as $stripeSetting)
                    <form method="POST" action="{{ route('update.settings') }}">
                        @csrf
                        <div class="form-group">
                            <label for="{{ $stripeSetting['key'] }}">{{ $stripeSetting['display_name'] }}</label>
                            @if ($stripeSetting['key'] == 'STRIPE_MODE')
                                <select class="form-control" name="{{ $stripeSetting['key'] }}">
                                    <option value="live" {{ $stripeSetting['value'] == 'live' ? 'selected' : '' }}>Live
                                    </option>
                                    <option value="sandbox" {{ $stripeSetting['value'] == 'sandbox' ? 'selected' : '' }}>
                                        Sandbox</option>
                                </select>
                            @else
                                <input type="text" class="form-control" name="{{ $stripeSetting['key'] }}"
                                    value="{{ $stripeSetting['value'] }}">
                            @endif
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
                @foreach ($paypalSettings as $paypalSetting)
                    <form method="POST" action="{{ route('update.settings') }}">
                        @csrf
                        <div class="form-group">
                            <label for="{{ $paypalSetting['key'] }}">{{ $paypalSetting['display_name'] }}</label>
                            @if ($paypalSetting['key'] == 'PAYPAL_MODE')
                                <select class="form-control" name="{{ $paypalSetting['key'] }}">
                                    <option value="live" {{ $paypalSetting['value'] == 'live' ? 'selected' : '' }}>Live
                                    </option>
                                    <option value="sandbox" {{ $paypalSetting['value'] == 'sandbox' ? 'selected' : '' }}>
                                        Sandbox</option>
                                </select>
                            @else
                                <input type="text" class="form-control" name="{{ $paypalSetting['key'] }}"
                                    value="{{ $paypalSetting['value'] }}">
                            @endif
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
                @php
                    $examples = [
                        'MAIL_MAILER' => 'e.g., smtp',
                        'MAIL_HOST' => 'e.g., smtp.mailtrap.io or smtp.google.com',
                        'MAIL_PORT' => 'e.g., 2525, 587, 465, 25',
                        'MAIL_USERNAME' => 'e.g., your-email@example.com',
                        'MAIL_PASSWORD' => 'e.g., App password',
                        'MAIL_ENCRYPTION' => 'e.g., tls or ssl',
                        'MAIL_FROM_ADDRESS' => 'e.g., Sender@email.com',
                        'MAIL_FROM_NAME' => 'e.g., Sender Name',
                    ];
                @endphp

                @foreach ($mailSettings as $mailSetting)
                    <form method="POST" action="{{ route('update.settings') }}">
                        @csrf
                        <div class="form-group">
                            <label for="{{ $mailSetting['key'] }}">{{ $mailSetting['display_name'] }}</label>
                            <input type="text" class="form-control" name="{{ $mailSetting['key'] }}"
                                value="{{ $mailSetting['value'] }}">
                            <small class="form-text text-muted">
                                {{ $examples[$mailSetting['key']] ?? '' }}
                            </small>
                        </div>
                @endforeach
                <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>

    </div>
@stop
