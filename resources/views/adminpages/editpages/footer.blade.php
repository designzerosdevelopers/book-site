<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Title</title>
    <!-- Include CSS files here -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
    .container {
    width: 80%;
    margin: 0 auto;
    text-align: center;
    padding-top: 50px;
}

h1 {
    color: blue; /* Example color for the heading */
}

.text-red {
    color: red;
}

.mt-4 {
    margin-top: 1rem; /* Adjust this value as needed */
}

</style>
</head>
<body>

@extends('layouts.admin-layout.app')

@section('content')
<div class="content-wrapper">
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    
                 
               
                  
                <h5 class="card-title">Footer</h5>
                @if(session('success'))
                <div id="successMessage" class="alert alert-success">{{ session('success') }}</div>
                @endif
                
                <form action="{{ route('update.footer') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="default">Enter your HTML here:</label>
                        <textarea name="htmlInput" id="default" class="form-control"> {{ $footer }} </textarea>
                    </div>                    
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
@stop

<!-- Include TinyMCE script after the content -->
<script src="{{asset('tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('script.js')}}"></script>

<!-- Include jQuery and Bootstrap JavaScript files -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Additional JavaScript -->
<script>
    // jQuery function to slide up the success message after 3 seconds
    $(document).ready(function(){
        $('#successMessage').delay(3000).slideUp();
    });
</script>

</body>
</html>
