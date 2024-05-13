<!DOCTYPE html>
@extends('layouts.admin-layout.app')
@section('content')
    <!-- partial -->
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('update.page') }}" method="post">
                    @csrf
                    <input type="hidden" name="comp_name" value="footer">
                    <textarea name="html" rows="10" cols="50" id="editor1">
                    @if (!empty(App\Helpers\SiteviewHelper::page('footer')))
                            {!! App\Helpers\SiteviewHelper::page('footer')->html !!}
                            @else
                            No Data
                            @endif
                    </textarea>
                    <button type="submit" class="btn btn-gradient-success my-2">Save</button>
                </form>
            </div>
        </div>


        <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
        <script>
            tinymce.init({
                selector: '#editor1',
                width: '100%', // Use percentage for responsiveness
                height: 400, // Adjust height as needed
                plugins: [
                    'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
                    'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media',
                    'table', 'emoticons', 'template', 'codesample'
                ],
                toolbar: 'undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify |' +
                    'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
                    'forecolor backcolor emoticons',
                menu: {
                    favs: {
                        title: 'Menu',
                        items: 'code visualaid | searchreplace | emoticons'
                    }
                },
                menubar: 'favs file edit view insert format tools table',
                content_css: [
                    'clientside/css/style.css',
                    "https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
                ],
                protect: {
                    // Match all content between "<?php" and "?> ?>", greedy matching (.*?)
                    pattern: /<\?php[\s\S]*?\?>/g
                }
                file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                input.onchange = function() {
                    var file = this.files[0];
                    console.log('Selected file:', file.name); // Log the selected file name

                    var formData = new FormData();
                    formData.append('image', file);
                    console.log(formData.get('image'));

                    $.ajax({
                        url: '/updatepage', // Corrected endpoint URL
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            var imageUrl = response.url;
                            cb(imageUrl, {
                                src: imageUrl, // Use the image URL as the source
                                title: file.name // Use the filename as the title
                            });
                        },
                        error: function(xhr, status, error) {
                            // Handle error
                        }
                    });

                };

                input.click();
            }
            });
        </script>

    @stop

