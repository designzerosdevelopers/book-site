@extends('layouts.admin-layout.app')

@section('content')
<div class="content-wrapper">
    {{-- <div class="container my-5 py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Import and Export CSV</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div id="success-alert" class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('csv.save') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="csv_file">CSV File</label>
                                <input id="csv_file" type="file" class="form-control" name="csv_file" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Import CSV</button>
                        </form>

                        <hr>

                        <form method="GET" action="{{ route('export.csv') }}">
                            <button type="submit" class="btn btn-success">Export CSV</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@stop 


    