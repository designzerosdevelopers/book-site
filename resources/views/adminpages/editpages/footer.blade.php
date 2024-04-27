@extends('layouts.admin-layout.app')

@section('content')
<div class="content-wrapper">
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Footer</h5>
                @if(session('success'))
                <div id="successMessage" class="alert alert-success">{{ session('success') }}</div>
                @endif
                
                <form action="{{ route('update.footer') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="htmlInput">Enter your HTML here:</label>
                        <textarea class="form-control" id="htmlInput" name="htmlInput" rows="20" required style="resize: vertical; overflow: auto;">{{ $footer }}</textarea>

                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // jQuery function to slide up the success message after 3 seconds
    $(document).ready(function(){
        $('#successMessage').delay(3000).slideUp();
    });
</script>

