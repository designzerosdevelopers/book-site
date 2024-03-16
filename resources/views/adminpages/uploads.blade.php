@extends('layouts.admin-layout.app')
@section('content')
<div class="content-wrapper">

    
    @if (session('success'))
        <div id="success-alert" class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('upload_errors'))
    <div class="alert alert-danger" id="success-alert">
        <ul>
            @foreach (session('upload_errors') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
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
                
                <div class="col-4" id="upload-viewer">
                    <!-- Your upload viewer content goes here -->
                </div>
            </div>
            
        </ul>
    </div>
@endif
</div>
@stop
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script>
      
$(document).ready(function() {
    // Add click event handler to all image thumbnails
    $('.file-thumbnail').click(function() {
        const pdfUrl = $(this).data('pdf');
        const pdfName = $(this).data('name');
        var deleteid = $(this).data('id');
console.log('clicked');
        if (pdfUrl && pdfName && deleteid) {
            // Load PDF into the col-4 section
            $('#upload-viewer').html(`
                <embed src="${pdfUrl}" height="150px" />
                <p>Name: ${pdfName}</p>
                
                <div class="input-group my-3">
                    <input type="text" class="form-control" value="${pdfUrl}" readonly>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary btn-copy" type="button">Copy</button>
                    </div>
                </div>
                <span class="copy-success" style="display: none;">URL Copied!</span>`
            );
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
function copyImageUrl(url, iconElement) {
    console.log('hit success');
    var tempInput = document.createElement('input');
    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
    tempInput.value = url;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand('copy');
    document.body.removeChild(tempInput);

    var messageContainer = document.createElement('div');
    messageContainer.style = "position: absolute; top: 80%; left: 38%; transform: translate(-45%, -50%); background-color: rgba(0, 0, 0, 0.8); color: #fff; padding: 2px; border-radius: 3px; z-index: 9999; font-size: 12px;"; // Adjust font-size as needed
    messageContainer.textContent = 'URL copied!';
    iconElement.parentNode.appendChild(messageContainer);

    setTimeout(function() {
        iconElement.parentNode.removeChild(messageContainer);
    }, 2000); // 2000 milliseconds = 2 seconds, adjust as needed
}










</script>