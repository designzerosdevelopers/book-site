<!DOCTYPE html>
@extends('layouts.admin-layout.app')
@section('content')
<!-- partial -->
<div class="content-wrapper">
    <div class="card p-2">
        <div class="">
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
    @php $style = App\Helpers\SiteviewHelper::style('productdetailsettings'); @endphp

    <div class="card">
        <div class="card-body">
            <form action="{{ route('theme.update') }}" method="post">
                @csrf

                <div class="form-group row">
                    <label for="title_color" class="col-sm-2 col-form-label">Title color</label>
                    <div class="col-sm-4">
                        <input type="color" id="title_color" class="form" name="product_title_color"
                            value="{{ $style['titleColor'] }}" required>
                    </div>

                    <label for="price_color" class="col-sm-2 col-form-label">Price color</label>
                    <div class="col-sm-4">
                        <input type="color" id="price_color" class="form" name="product_price_color"
                            value="{{ $style['priceColor'] }}" required>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="title_size" class="col-sm-2 col-form-label">Title size</label>
                    <div class="col-sm-4">
                        <input type="text" id="title_size" class="form-control" name="product_title_size"
                            value="{{ $style['titleSize'] }}" required>
                    </div>

                    <label for="price_size" class="col-sm-2 col-form-label">Price size</label>
                    <div class="col-sm-4">
                        <input type="text" id="price_size" class="form-control" name="product_price_size"
                            value="{{ $style['priceSize'] }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="image_width" class="col-sm-2 col-form-label">Image width</label>
                    <div class="col-sm-4">
                        <input type="text" id="image_width" class="form-control" name="product_image_width"
                            value="{{ $style['productWidth'] }}" required>
                    </div>

                    <label for="image_height" class="col-sm-2 col-form-label">Image height</label>
                    <div class="col-sm-4">
                        <input type="text" id="image_height" class="form-control" name="product_image_height"
                            value="{{ $style['productHeight'] }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="button_name" class="col-sm-2 col-form-label">Button name</label>
                    <div class="col-sm-4">
                        <input type="text" id="button_name" class="form-control" name="product_button_name"
                            value="{{ $style['data']['product_button_name'] }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" name="page" value="productdetailsetting"
                            class="btn btn-gradient-success me-2">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

