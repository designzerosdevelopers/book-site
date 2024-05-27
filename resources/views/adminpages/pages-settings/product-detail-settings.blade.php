<!DOCTYPE html>
@extends('layouts.admin-layout.app')
@section('content')
<!-- partial -->
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('update.page') }}" method="post">
                @csrf
                <input type="hidden" name="comp_name" value="productdetail">
                <textarea name="html" rows="10" cols="50" id="editor1">
                    @if (!empty(App\Helpers\SiteviewHelper::page('productdetail')))
                        {!! App\Helpers\SiteviewHelper::page('productdetail')->herohtml !!}
                    @else
                        No Data
                    @endif
                </textarea>
                <br>
                <button type="submit" name="part" value="allhtml" class="btn btn-gradient-success me-2">Save</button>
            </form>
        </div>
    </div>

    <br>
    @php $style = App\Helpers\SiteviewHelper::style('homesetting'); @endphp

    <div class="card">
        <div class="card-body">
            <form action="{{ route('theme.update') }}" method="post">
                @csrf

                <div class="form-group row">
                    <label for="title_color" class="col-sm-2 col-form-label">Product title color</label>
                    <div class="col-sm-4">
                        <input type="color" id="title_color" class="form" name="title_color"
                            value="{{ $style['titleColor'] }}" required>
                    </div>

                    <label for="price_color" class="col-sm-2 col-form-label">Product price color</label>
                    <div class="col-sm-4">
                        <input type="color" id="price_color" class="form" name="price_color"
                            value="{{ $style['priceColor'] }}" required>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="title_size" class="col-sm-2 col-form-label">Title size</label>
                    <div class="col-sm-4">
                        <input type="text" id="title_size" class="form-control" name="title_size"
                            value="{{ $style['titleSize'] }}" required>
                    </div>

                    <label for="price_size" class="col-sm-2 col-form-label">Price size</label>
                    <div class="col-sm-4">
                        <input type="text" id="price_size" class="form-control" name="price_size"
                            value="{{ $style['priceSize'] }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="image_width" class="col-sm-2 col-form-label">Image width</label>
                    <div class="col-sm-4">
                        <input type="text" id="image_width" class="form-control" name="image_width"
                            value="{{ $style['productWidth'] }}" required>
                    </div>

                    <label for="image_height" class="col-sm-2 col-form-label">Image height</label>
                    <div class="col-sm-4">
                        <input type="text" id="image_height" class="form-control" name="image_height"
                            value="{{ $style['productHeight'] }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="button_name" class="col-sm-2 col-form-label">Button name</label>
                    <div class="col-sm-4">
                        <input type="text" id="button_name" class="form-control" name="section_button_name"
                            value="{{ $style['data']['product_section_button'] }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" name="page" value="home"
                            class="btn btn-gradient-success me-2">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

    
   

    <script src="{{asset('tinymce/tinymce.min.js')}}"></script>
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
            // enable title field in the Image dialog
            image_title: true,
            // enable automatic uploads of images represented by blob or data URIs
            automatic_uploads: true,
            // add custom filepicker only to Image dialog
            file_picker_types: 'image',
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
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                input.onchange = function() {
                    var file = this.files[0];

                    var formData = new FormData();
                    formData.append('image', file);
                  

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
                                src: imageUrl, 
                                title: file.name
                            });
                        },
                        error: function(xhr, status, error) {
                            console.log('image could not be uploaded.')
                        }
                    });

                };

                input.click();
            }
        });
    </script>
