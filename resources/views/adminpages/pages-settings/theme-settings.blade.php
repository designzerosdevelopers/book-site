@extends('layouts.admin-layout.app')

@section('content')
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <form action="{{route('theme.update')}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="bg_color" class="col-sm-2 col-form-label">Background Color:</label>
                        <div class="col-sm-4">
                            <input type="color" id="bg_color" name="bg_color" value="{{$color['bg']}}">
                        </div>

                        <label for="url_color" class="col-sm-2 col-form-label">URL Color:</label>
                        <div class="col-sm-4">
                            <input type="color" id="url_color" name="url_color" value="{{$color['url']}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="navbar_color" class="col-sm-2 col-form-label">Navbar Color:</label>
                        <div class="col-sm-4">
                            <input type="color" id="navbar_color" name="navbar_color" value="{{$color['navbar']}}">
                        </div>

                        <label for="hero_color" class="col-sm-2 col-form-label">Hero Section Color:</label>
                        <div class="col-sm-4">
                            <input type="color" id="hero_color" name="hero_color" value="{{$color['hero']}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="footer_color" class="col-sm-2 col-form-label">Footer Color:</label>
                        <div class="col-sm-4">
                            <input type="color" id="footer_color" name="footer_color" value="{{$color['footer']}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-gradient-success me-2">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
