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
                            <label for="">{{ $stripeSetting['display_name'] }}</label>
                            <input type="text" class="form-control" name="{{ $stripeSetting['key'] }}"
                                value="{{ $stripeSetting['value'] }}">
                            <small class="text-muted">{{ $stripeSetting['note'] }}</small>
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
                            <label for="">{{ $paypalSetting['display_name'] }}</label>
                            <input type="text" class="form-control" name="{{ $paypalSetting['key'] }}"
                                value="{{ $paypalSetting['value'] }}">
                            <small class="text-muted">{{ $paypalSetting['note'] }}</small>

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
                @foreach ($mailSettings as $mailSetting)
                    <form method="POST" action="{{ route('update.settings') }}">
                        @csrf
                        <div class="form-group">
                            <label for="">{{ $mailSetting['display_name'] }}</label>
                            <input type="text" class="form-control" name="{{ $mailSetting['key'] }}"
                                value="{{ $mailSetting['value'] }}">
                            <small class="text-muted">{{ $mailSetting['note'] }}</small>
                        </div>
                @endforeach
                <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-body">
                <h3>AWS Configuration</h3>
                <form method="POST" action="{{ route('update.settings') }}">
                    @csrf
                    @foreach ($awsSettings as $aws)
                        <div class="form-group">
                            <label for="">{{ $aws['display_name'] }}</label>
                            <input type="text" class="form-control" name="{{ $aws['key'] }}"
                                value="{{ $aws['value'] }}">
                            <small class="text-muted">{{ $aws['note'] }}</small>
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
@stop
