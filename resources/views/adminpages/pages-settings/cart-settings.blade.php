<!DOCTYPE html>
@extends('layouts.admin-layout.app')
@section('content')
    <div class="content-wrapper">
        <div class="card p-2">
            <div class="">
                <form action="{{ route('update.page') }}" method="post">
                    @csrf
                    <input type="hidden" name="comp_name" value="cart">
                    <textarea name="html"  rows="10" cols="50" id="editor1">
                        @if (!empty(App\Helpers\SiteviewHelper::page('cart')))
                            {!! App\Helpers\SiteviewHelper::page('cart')->html !!}
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
