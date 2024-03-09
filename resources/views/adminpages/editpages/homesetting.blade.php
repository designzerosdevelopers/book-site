@extends('layouts.admin-layout.app')
@section('content')
<!-- partial -->
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Home Page Settings </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Forms</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form elements</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- Display the image dynamically -->
                    <div style="display: flex; align-items: center;">
                        <div style="flex: 1;">
                            <h4 class="card-title">Home form elements</h4>
                            <p class="card-description"> Edit your home elements </p>
                        </div>
                        @if(isset($homepage->hero_image))
                        <img src="{{ asset('clientside/images/' . $homepage->hero_image) }}" alt="Hero Image" style="max-width: 100px; max-height: 200px; margin-left: 15px;">
                        @endif
                    </div>

                    @if(session('status'))
                    <div class="alert alert-success" role="alert" id="updateSuccessAlert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form class="forms-sample" action="{{ route('updatehome') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Add the heading input -->
                        <div class="form-group">
                            <label>Hero section image</label>

                            <div class="input-group col-xs-12">
                                <!-- Display the image input -->
                                <input type="file" class="form-control file-upload-info" placeholder="Upload Image" name="hero_image">

                            </div>
                            @error('hero_image')
                            {{ $message }}
                            @enderror
                            <small class="text-muted">The image size must be 1000 x 700</small>
                        </div>

                        <!-- Add the heading input -->
                        <div class="form-group">
                            <label for="hero_heading">Heading</label>
                            <input type="text" class="form-control" id="hero_heading" placeholder="Heading" name="hero_heading" value="{{ $homepage->hero_heading ?? '' }}">
                        </div>

                        <!-- Add the paragraph textarea -->
                        <div class="form-group">
                            <label for="editor">Paragraph</label>
                            <textarea class="form-control" id="editor" rows="3" name="hero_paragraph">{{ $homepage->hero_paragraph ?? '' }}</textarea>
                        </div>

                        @error('hero_paragraph')
                        {{ $message }}
                        @enderror

                        <button type="submit" class="btn btn-gradient-success me-2">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
@stop
