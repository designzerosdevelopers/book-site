@extends('layouts.admin-layout.app')
@section('content')
<!-- partial -->
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Edit Home </h3>
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
                        <input type="hidden" name="section" value="hero_section">
                        <!-- Add the heading input -->
                        <div class="form-group">
                            <label>Hero section image</label>

                            <div class="input-group col-xs-12">
                                <!-- Display the image input -->
                                <input type="file" class="form-control file-upload-info" placeholder="Upload Image" name="hero_image" >

                            </div>
                            @error('hero_image')
                            {{ $message }}
                            @enderror
                            <small class="text-muted">The image size must be 1000 x 700</small>
                        </div>
                        
                        @if(session('error_image'))
                        <div class="alert alert-danger" role="alert" id="updateerrorAlert">
                            {{ session('error_image') }}
                        </div>
                        @endif

                        <!-- Add the heading input -->
                        <div class="form-group">
                            <label for="hero_heading">Heading</label>
                            <input type="text" class="form-control" id="hero_heading" placeholder="Heading" name="hero_heading" value="{{ $homepage->hero_heading ?? '' }}">
                        </div>
                        @error('hero_heading')
                        <div class="alert alert-danger" id="hero_heading_error">Heading is required.</div>
                        @enderror

                        <!-- Add the paragraph textarea -->
                        <div class="form-group">
                            <label for="editor">Paragraph</label>
                            <textarea class="form-control" id="editor" rows="3" name="hero_paragraph">{{ $homepage->hero_paragraph ?? '' }}</textarea>
                        </div>

                        @error('hero_paragraph')
                        <div class="alert alert-danger" id="hero_paragraph_error">Paragraph is required.</div>
                        @enderror
                        <button type="submit" class="btn btn-gradient-success me-2">Save</button>
                    </form>

                </div>
            </div>
            
        </div>
        <br>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Product Section</h3>
                        <br>
                        <form action="{{ route('updatehome') }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="section" value="product_section">
                            <div class="form-group">
                                <label for="section_title">Product Section title:</label><br>
                                <input type="text" id="section_title" name="section_title" class="form-control" value="{{ $homepage->ps_title }}" required><br><br>
                        
                                <label for="section_description">Product Section Description:</label><br>
                                <textarea id="section_description" name="section_description" rows="5" cols="10" class="form-control" required>{{ $homepage->ps_description }} </textarea><br><br>
                            </div>
                      
                            <button type="submit" class="btn btn-gradient-success me-2">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Why Choose Us</h3>
                        <form action="{{ route('updatehome') }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="section" value="why_choose_us">
                            <div class="form-group">
                                <label for="section_title">Section title:</label><br>
                                <input type="text" id="section_title" name="section_title" class="form-control" value="{{ $homepage->wcu_title }} " required><br><br>
                        
                                <label for="section_description"> Section Description:</label><br>
                                <textarea id="section_description" name="section_description" rows="10" cols="50" class="form-control"required> {{ $homepage->wcu_description }}  </textarea><br>

                                <hr class="bg-success" style="height: 7px;">

                                <label for="feature_1">Feature 1 Title:</label><br>
                                <input type="text" id="feature_1" name="feature_1" class="form-control" value=" {{ $homepage->wcu_feature_1_title }}"  required><br>
                                
                                
                                <label for="feature_1_description">Feature 1 Description:</label><br>
                                <textarea id="feature_1_description" name="feature_1_description" rows="4" cols="50" class="form-control" required>{{ $homepage->wcu_feature_1_description }}</textarea><br><br>

                                <hr class="bg-success" style="height: 7px;">
                                
                                <label for="feature_2">Feature 2 Title:</label><br>
                                <input type="text" id="feature_2" name="feature_2" class="form-control" value=" {{ $homepage->wcu_feature_2_title }}" required><br>
                                
                                
                                <label for="feature_2_description">Feature 2 Description:</label><br>
                                <textarea id="feature_2_description" name="feature_2_description" rows="4" cols="50" class="form-control" required>{{ $homepage->wcu_feature_2_description }}</textarea><br><br>
                                
                                <hr class="bg-success" style="height: 7px;">

                                <label for="feature_3">Feature 3 Title:</label><br>
                                <input type="text" id="feature_3" name="feature_3" class="form-control" value=" {{ $homepage->wcu_feature_3_title }}" required><br>
                                
                                
                                <label for="feature_3_description">Feature 3 Description:</label><br>
                                <textarea id="feature_3_description" name="feature_3_description" rows="4" cols="50" class="form-control" required>{{ $homepage->wcu_feature_3_description }}</textarea><br><br>
                                
                                <hr class="bg-success" style="height: 7px;">
                                
                                <label for="feature_4">Feature 4 Title:</label><br>
                                <input type="text" id="feature_4" name="feature_4" class="form-control" value=" {{ $homepage->wcu_feature_4_title }}" required><br>
                                
                                
                                <label for="feature_4_description">Feature 4 Description:</label><br>
                                <textarea id="feature_4_description" name="feature_4_description" rows="4" cols="50" class="form-control" required>{{ $homepage->wcu_feature_4_description }}</textarea><br>
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
                        <h3 class="card-title">We Help</h3>
                        <form action="{{ route('updatehome') }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="section" value="we_help">
                            <div class="form-group">
                                <label for="we_help_title">Section title:</label><br>
                                <input type="text" id="we_help_title" name="we_help_title" value="{{ $homepage->wh_title }}" class="form-control" required><br><br>
                        
                                <label for="we_help_description">Section Description:</label><br>
                                <textarea id="we_help_description" name="we_help_description" rows="10" cols="50" class="form-control" required>{{ $homepage->wh_description }}</textarea><b><br>

                                <label for="feature_1">Feature 1 :</label><br>
                                <input type="text" id="feature_1" name="feature_1" class="form-control" value="{{ $homepage->wh_feature_1 }}" required><br>

                                <label for="feature_2">Feature 2 :</label><br>
                                <input type="text" id="feature_2" name="feature_2" class="form-control" value="{{ $homepage->wh_feature_2 }}" required><br>

                                <label for="feature_3">Feature 3 :</label><br>
                                <input type="text" id="feature_3" name="feature_3" class="form-control" value="{{ $homepage->wh_feature_3 }}" required><br>

                                <label for="feature_4">Feature 4 :</label><br>
                                <input type="text" id="feature_4" name="feature_4" class="form-control" value="{{ $homepage->wh_feature_4 }}"  required><br>

                            </div>
                            <button type="submit" class="btn btn-gradient-success me-2">Save</button>
                        </form>
                    </div>
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
