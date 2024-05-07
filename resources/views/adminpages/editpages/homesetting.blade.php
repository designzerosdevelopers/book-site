<!DOCTYPE html>
@extends('layouts.admin-layout.app')
@section('content')
<!-- partial -->
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
      
            <form action="{{ route('update.shop') }}" method="post">
                @csrf
                <input type="hidden" name="comp_data" value="home">
                <textarea name="html"  rows="10" cols="50" id="editor1">
                    @if (!empty(App\Helpers\SiteviewHelper::page('home')))
                        {!! App\Helpers\SiteviewHelper::page('home')->html !!}
                    @else
                        No Data
                    @endif
                </textarea>
                <br>
                <button type="submit" class="btn btn-gradient-success me-2">Save</button>
            </form>
        </div>
    </div>

    
   

    <script src="{{asset('tinymce/tinymce.min.js')}}"></script>
    <script>
        tinymce.init({
            selector: '#editor1',
            width: '100%', // Use percentage for responsiveness
            height: 400, // Adjust height as needed
            plugins:[
                'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
                'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media', 
                'table', 'emoticons', 'template', 'codesample'
            ],
            toolbar: 'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify |' + 
            'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
            'forecolor backcolor emoticons',
            menu: {
                favs: {title: 'Menu', items: 'code visualaid | searchreplace | emoticons'}
            },
            menubar: 'favs file edit view insert format tools table',
            content_css: [
                'clientside/css/style.css',
                "https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
            ]
        });
</script>
       
        
    {{-- <div class="page-header">
        <h1 class="page-title"> Edit Home </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Forms</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form elements</li>
            </ol>
        </nav>
    </div>
     
    @if(session('status'))
    <div class="alert alert-success" role="alert" id="updateSuccessAlert">
        {{ session('status') }}
    </div>
    @endif
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
           

            <div class="card">
                <div class="card-body">
                    <!-- Display the image dynamically -->
                    <div style="display: flex; align-items: center;">
                        <div style="flex: 1;">
                            <h4 class="card-title">Home page elements</h4>
                            <p class="card-description"> Edit your Home page hero section here. </p>
                        </div>
                        @if(isset($pages->hero_image))
                        <img src="{{ asset('clientside/images/' . $pages->hero_image) }}" alt="Hero Image" style="max-width: 100px; max-height: 200px; margin-left: 15px;">
                        @endif
                    </div>

                    @error('wcu_image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

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
                            <input type="text" class="form-control" id="hero_heading" placeholder="Heading" name="hero_heading" value="{{ $pages->hero_heading ?? '' }}">
                        </div>
                        @error('hero_heading')
                        <div class="alert alert-danger" id="hero_heading_error">Heading is required.</div>
                        @enderror

                        <!-- Add the paragraph textarea -->
                        <div class="form-group">
                            <label for="editor">Paragraph</label>
                            <textarea class="form-control" id="editor1" rows="3" name="hero_paragraph">{{ $pages->hero_paragraph ?? '' }}</textarea>
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
                        <h3 class="card-title">Site name</h3>
                        <br>
                        <form action="{{ route('updatehome') }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="section" value="site_name">
                            <div class="form-group">
                                <label for="site_name">Enter the site name</label><br>
                                <input type="text" id="site_name" name="site_name" class="form-control" value="{{ $pages->site_name }}" required><br><br>
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
                        <h3 class="card-title">Product Section</h3>
                        <br>
                        <form action="{{ route('updatehome') }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="section" value="product_section">
                            <div class="form-group">
                                <label for="section_title">Product Section title:</label><br>
                                <input type="text" id="section_title" name="section_title" class="form-control" value="{{ $pages->ps_title }}" required><br><br>
                        
                                <label for="editor2">Product Section Description:</label><br>
                                <textarea id="editor2" name="section_description" rows="5" cols="10" class="form-control" required>{{ $pages->ps_description }} </textarea><br><br>
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
                        <h3 class="card-title">Why Choose Us Section</h3>
                        <form action="{{ route('updatehome') }}" method="post"  enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="section" value="why_choose_us">
                            <div class="form-group">
                                <label for="section_title">Section title:</label><br>
                                <input type="text" id="section_title" name="section_title" class="form-control" value="{{ $pages->wcu_title }} " required><br><br>
                        
                                <label for="editor3"> Section Description:</label><br>
                                <textarea id="editor3" name="section_description" rows="5" cols="10" class="form-control"required> {{ $pages->wcu_description }}  </textarea><br>

                                <hr class="bg-success" style="height: 7px;">

                                <label for="feature_1">Feature 1 Title:</label><br>
                                <input type="text" id="feature_1" name="feature_1" class="form-control" value=" {{ $pages->wcu_feature_1_title }}"  required><br>
                                
                                
                                <label for="editor4">Feature 1 Description:</label><br>
                                <textarea id="editor4" name="feature_1_description" rows="4" cols="50" class="form-control" required>{{ $pages->wcu_feature_1_description }}</textarea><br><br>

                                <hr class="bg-success" style="height: 7px;">
                                
                                <label for="feature_2">Feature 2 Title:</label><br>
                                <input type="text" id="feature_2" name="feature_2" class="form-control" value=" {{ $pages->wcu_feature_2_title }}" required><br>
                                
                                
                                <label for="editor5">Feature 2 Description:</label><br>
                                <textarea id="editor5" name="feature_2_description" rows="4" cols="50" class="form-control" required>{{ $pages->wcu_feature_2_description }}</textarea><br><br>
                                
                                <hr class="bg-success" style="height: 7px;">

                                <label for="feature_3">Feature 3 Title:</label><br>
                                <input type="text" id="feature_3" name="feature_3" class="form-control" value=" {{ $pages->wcu_feature_3_title }}" required><br>
                                
                                
                                <label for="editor6">Feature 3 Description:</label><br>
                                <textarea id="editor6" name="feature_3_description" rows="4" cols="50" class="form-control" required>{{ $pages->wcu_feature_3_description }}</textarea><br><br>
                                
                                <hr class="bg-success" style="height: 7px;">
                                
                                <label for="feature_4">Feature 4 Title:</label><br>
                                <input type="text" id="feature_4" name="feature_4" class="form-control" value=" {{ $pages->wcu_feature_4_title }}" required><br>
                                
                                
                                <label for="editor7">Feature 4 Description:</label><br>
                                <textarea id="editor7" name="feature_4_description" rows="4" cols="50" class="form-control" required>{{ $pages->wcu_feature_4_description }}</textarea><br>
                            </div>
 
                            <hr class="bg-success" style="height: 7px;">

                            <label for="wcu_image">Choose an image:</label><br>
                            <input type="file" id="wcu_image" name="wcu_image" class="form-control" required><br>

                      
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
                        <h3 class="card-title">We Help Section</h3>
                        <form action="{{ route('updatehome') }}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="section" value="we_help">
                            <div class="form-group">
                                <label for="we_help_title">Section title:</label><br>
                                <input type="text" id="we_help_title" name="we_help_title" value="{{ $pages->wh_title }}" class="form-control" required><br><br>
                        
                                <label for="editor8">Section Description:</label><br>
                                <textarea id="editor8" name="we_help_description" rows="5" cols="10" class="form-control" required>{{ $pages->wh_description }}</textarea><b><br>

                                <label for="feature_1">Feature 1 :</label><br>
                                <input type="text" id="feature_1" name="feature_1" class="form-control" value="{{ $pages->wh_feature_1 }}" required><br>

                                <label for="feature_2">Feature 2 :</label><br>
                                <input type="text" id="feature_2" name="feature_2" class="form-control" value="{{ $pages->wh_feature_2 }}" required><br>

                                <label for="feature_3">Feature 3 :</label><br>
                                <input type="text" id="feature_3" name="feature_3" class="form-control" value="{{ $pages->wh_feature_3 }}" required><br>

                                <label for="feature_4">Feature 4 :</label><br>
                                <input type="text" id="feature_4" name="feature_4" class="form-control" value="{{ $pages->wh_feature_4 }}"  required><br>

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
                            <input type="hidden" name="section" value="home_button_1">
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
                            <input type="hidden" name="section" value="home_button_2">
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
    </div> --}}
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
