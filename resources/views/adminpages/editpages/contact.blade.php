@extends('layouts.admin-layout.app')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @if(session('status'))
                        <div class="alert alert-success" role="alert" id="updateSuccessAlert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <h3 class="card-title">Contact Page</h3>
                        <form action="{{ route('updatehome') }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="section" value="contact">
                            <div class="form-group">
                                <label for="contact_hs_title">Page title:</label><br>
                                <input type="text" id="contact_hs_title" name="contact_hs_title" value="{{ $pages->contact_hs_title }}" class="form-control" required><br><br>

                                <br>
                                <label for="editor10">Page Description:</label><br>
                                <textarea name="contact_hs_description" id="editor10" cols="15" rows="5" class="form-control">{{ $pages->contact_hs_description }}</textarea>

                            </div>
                            <button type="submit" class="btn btn-gradient-success me-2">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Button 1</h3>
                        <form action="{{ route('updatehome') }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="section" value="contact_button_1">
                            <div class="form-group">
                                <label for="button_1">Button 1 name:</label><br>
                                <input type="text" id="button_1" name="button_1_name" class="form-control" value="{{ $pages->button_1_name }}" required><br>

                                <label for="button_1">Button 1 Url:</label><br>
                                <input type="text" id="button_1" name="button_1_url" class="form-control" value="{{ $pages->button_1_url }}"  required><br>
                            </div>
                            <button type="submit" class="btn btn-gradient-success me-2">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Button 2</h3>
                        <form action="{{ route('updatehome') }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="section" value="contact_button_2">
                            <div class="form-group">
                                <label for="button_2">Button 2 name:</label><br>
                                <input type="text" id="button_2" name="button_2_name" class="form-control" value="{{ $pages->button_2_name }}" required><br>

                                <label for="button_2">Button 2 Url:</label><br>
                                <input type="text" id="button_2" name="button_2_url" class="form-control" value="{{ $pages->button_2_url }}"  required><br>
                            </div>
                            <button type="submit" class="btn btn-gradient-success me-2">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    // Wait for the document to be ready
    $(document).ready(function() {
        // Slide up the error messages after a delay
        $("#updateSuccessAlert").delay(8000).slideUp(300);
        $("#updateerrorAlert").delay(3000).slideUp(300);
    });
</script>
