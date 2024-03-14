@extends('layouts.admin-layout.app')
@section('content')
<div class="content-wrapper">

    
    @if (session('success'))
        <div id="success-alert" class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div id="success-alert" class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif


   {{-- input field errors --}}
    @if ($errors->any())
    <div id="error-alert" class="alert alert-danger" role="alert">
      
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
       
    </div>
    @endif

    <form method="POST" action="{{ route('save.uploads') }}" enctype="multipart/form-data">
        @csrf

       

        <div class="input-group my-3">
            <input type="file" id="uploadfiles" class="form-control" name="uploadfiles[]" required multiple>
            <div class="input-group-append">
                <button class="btn btn-outline-success btn-copy" type="submit">Upload</button>
            </div>
        </div>

        

    
    </form>


   
    {{-- Display uploaded images and files --}}
    @if($uploadedFiles->isNotEmpty())
    <div class="uploaded-files">
        <h2>Uploaded Files</h2>
        <ul>
            <div class="row">
                <div class="col-8">
                    <div class="row">
                        @foreach($uploadedFiles as $file)
                        @php
                            $extension = pathinfo($file->file, PATHINFO_EXTENSION);
                        @endphp
                        @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                            <div class="col-auto mb-2">
                                <div class="img-container" style="width: 120px; height: 80px; background: rgb(255, 255, 255); display: flex; justify-content: center; align-items: center; position: relative;"> 
                                    <img src="{{ asset('uploads/'.$file->file) }}" class="file-thumbnail img-fluid" data-pdf="{{ asset('uploads/'.$file->file) }}" data-name="{{ $file->file }}" data-id="{{ $file->id }}" style="max-width: 100%; max-height: 100%; vertical-align: middle;">
                                    <span class="copy-icon" onclick="copyImageUrl('{{ asset('uploads/'.$file->file) }}', this)">
                                        <i class="fas fa-copy"></i>
                                    </span>
                                </div>
                            </div>
                        @endif
                        @if (in_array($extension, ['pdf']))
                            <div class="col-auto mb-2">
                                <div class="img-container" style="width: 120px; height: 80px; background: rgb(255, 255, 255); display: flex; justify-content: center; align-items: center; position: relative;"> 
                                    <img src="{{ asset('uploads/pdf-logo.png') }}" class="file-thumbnail img-fluid" data-pdf="{{ asset('uploads/'.$file->file) }}" data-name="{{ $file->file }}" data-id="{{ $file->id }}" style="max-width: 100%; max-height: 100%; vertical-align: middle;">
                                    <span class="copy-icon" onclick="copyImageUrl('{{ asset('uploads/'.$file->file) }}', this)">
                                        <i class="fas fa-copy"></i>
                                    </span>
                                </div>
                            </div>
                        @endif
                    @endforeach                    
                    </div>
                </div>
                
                <div class="col-4" id="pdf-viewer">
                    <!-- Your PDF viewer content goes here -->
                </div>
            </div>
            
        </ul>
    </div>
@endif
</div>
@stop







