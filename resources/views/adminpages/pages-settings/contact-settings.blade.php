<!DOCTYPE html>
@extends('layouts.admin-layout.app')

@section('content')
    <div class="content-wrapper">
        <div class="card p-2">
            <div class="">
                <form action="{{ route('update.page') }}" method="post">
                    @csrf
                    <input type="hidden" name="comp_name" value="contact">
                    <textarea name="html" rows="10" cols="50" id="editor1">
                        @if (!empty(App\Helpers\SiteviewHelper::page('contact')))
{!! App\Helpers\SiteviewHelper::page('contact')->herohtml !!}
@else
No Data
@endif
                    </textarea>
                    <br>
                    <button type="submit" name="part" value="herohtml"
                        class="btn btn-gradient-success me-2">Save</button>
                </form>
            </div>
        </div>
        <br>
        @php $style = App\Helpers\SiteviewHelper::style('contactsetting'); @endphp
        <div class="card">
            <div class="card-body">
                <form action="{{ route('theme.update') }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-4">
                            <input type="text" id="address" class="form-control" name="address"
                                value="{{ $style['contactInfo']['address'] }}" required>
                        </div>

                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-4">
                            <input type="text" id="email" class="form-control" name="email"
                                value="{{ $style['contactInfo']['email'] }}" required>
                        </div>

                        <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-4">
                            <input type="text" id="phone" class="form-control" name="phone"
                                value="{{ $style['contactInfo']['phone'] }}" required>
                        </div>
                    </div>
                    <div class="form-group row">

                        <label for="textColor" class="col-sm-2 col-form-label">Text Color</label>
                        <div class="col-sm-4">
                            <input type="color" id="textColor" class="" name="textColor" value="{{$style['contactTextColor']}}" required>
                        </div>

                        <label for="iconBG" class="col-sm-2 col-form-label">Icon Background</label>
                        <div class="col-sm-4">
                            <input type="color" id="iconBG" class="" name="iconBG" value="{{$style['contactIconBG']}}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" name="page" value="contact"
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
    // Wait for the document to be ready
    $(document).ready(function() {
        // Slide up the error messages after a delay
        $("#updateSuccessAlert").delay(8000).slideUp(300);
        $("#updateerrorAlert").delay(3000).slideUp(300);
    });
</script>
