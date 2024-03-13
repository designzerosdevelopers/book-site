@extends('layouts.admin-layout.app')
<style>
    .btn {
        background-color: #007bff;
        color: #fff;
        
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #a3ffba;
    }
</style>
@section('content')
<div class="content-wrapper">

    
    @if (session('message'))
        <div id="success-alert" class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif
   
    @if ($errors->any())
    <div id="error-alert" class="alert alert-danger" role="alert">
      
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
       
    </div>
    @endif

    <form method="POST" action="{{ route('save.uploads') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="uploadfiles">Upload Files</label>
            <input id="uploadfiles" type="file" class="form-control" name="uploadfiles[]" required multiple>
        </div>

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>


   
    {{-- Display uploaded images and files --}}
    @if($uploadedFiles->isNotEmpty())
    <div class="uploaded-files">
        <h2>Uploaded Files</h2>
        <ul>
            <div class="row">
                <div class="col-8">
                    @foreach($uploadedFiles as $file)
                        @php
                            $extension = pathinfo($file->file, PATHINFO_EXTENSION);
                        @endphp
                        @if ($extension == 'pdf')
                            <img src="{{ asset('uploads/pdf-logo.png') }}" height="100px" class="file-thumbnail" data-pdf="{{ asset('uploads/'.$file->file) }}" data-name="{{ $file->file }}"/>
                        @elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ asset('uploads/'.$file->file) }}" height="100px" class="file-thumbnail m-1" data-pdf="{{ asset('uploads/'.$file->file) }}" data-name="{{ $file->file }}"/>
                        @endif
                    @endforeach
                </div>
                
                <div class="col-4" id="pdf-viewer">
                    
                </div>
            </div>
        </ul>
    </div>
    @endif
</div>
@stop


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Add click event handler to all image thumbnails
        $('.file-thumbnail').click(function() {
            const pdfUrl = $(this).data('pdf');
            const pdfName = $(this).data('name');
            if (pdfUrl && pdfName) {
                // Load PDF into the col-4 section
                $('#pdf-viewer').html(`<embed src="${pdfUrl}" height="150px" />
                                       <p>Name: ${pdfName}</p>
                                       <p>Url: ${pdfUrl}</p>
                                       <div class="input-group mb-3">
                                           <input type="text" class="form-control" value="${pdfUrl}" readonly>
                                           <div class="input-group-append">
                                               <button class="btn btn-outline-secondary btn-copy" type="button">Copy</button>
                                           </div>
                                       </div>
                                       <span class="copy-success" style="display: none;">URL Copied!</span>`);
            }

            // Add click event handler to the copy button
            $('.btn-copy').click(function() {
                const urlText = $(this).closest('.input-group').find('input').val(); // Get the URL text from input field
                navigator.clipboard.writeText(urlText).then(function() {
                    // Show copying success message
                    $('.copy-success').fadeIn().delay(1500).fadeOut();
                }).catch(function(err) {
                    console.error('Could not copy text: ', err);
                });
            });
        });
    });
</script>







