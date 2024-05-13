<!DOCTYPE html>
@extends('layouts.admin-layout.app')

@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('update.page') }}" method="post">
                    @csrf
                    <input type="hidden" name="comp_name" value="contact">
                    <textarea name="html"  rows="10" cols="50" id="editor1">
                        @if (!empty(App\Helpers\SiteviewHelper::page('contact')))
                            {!! App\Helpers\SiteviewHelper::page('contact')->html !!}
                        @else
                            No Data
                        @endif
                    </textarea>
                    <br>
                    <button type="submit" class="btn btn-gradient-success me-2">Save</button>
                </form>
            </div>
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
