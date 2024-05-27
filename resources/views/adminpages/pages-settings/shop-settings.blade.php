<!DOCTYPE html>
@extends('layouts.admin-layout.app')
@section('content')
    <!-- partial -->
    <div class="content-wrapper">
        <div class="card p-2">
            <div class="">
                @if (session('success'))
                    <div id="successAlert" class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div id="errorAlert" class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('update.page') }}" method="post">
                    @csrf
                    <input type="hidden" name="comp_name" value="shop">
                    <textarea name="html" rows="10" cols="50" id="editor1">
                    @if (!empty(App\Helpers\SiteviewHelper::page('shop')))
                        {!! App\Helpers\SiteviewHelper::page('shop')->herohtml !!}
                        @else
                        No Data
                        @endif
                </textarea>
                    <br>
                    <button type="submit" name="part" value="herohtml" class="btn btn-gradient-success me-2">Save</button>
                </form>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('theme.update') }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="display_product" class="col-sm-2 col-form-label">Display products</label>
                        <div class="col-sm-4">
                            <input type="number" id="display_product" class="form-control" name="display_product"
                                value="{{App\Helpers\SiteviewHelper::style('shopsetting')['displayProduct']}}" required>
                        </div>


                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" name="page" value="shop"
                                class="btn btn-gradient-success me-2">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@stop


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Slide up and hide success message after 3 seconds
        $("#successAlert").delay(3000).slideUp(300);

        // Slide up and hide error message after 3 seconds
        $("#errorAlert").delay(3000).slideUp(300);
    });
</script>




