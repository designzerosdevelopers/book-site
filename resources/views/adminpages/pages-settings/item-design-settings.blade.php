<!DOCTYPE html>
@extends('layouts.admin-layout.app')
@section('content')
    <!-- partial -->
    <div class="content-wrapper">
        <div class="card p-2">
            <div class="">

                <form action="{{ route('update.page') }}" method="post">
                    @csrf
                    <input type="hidden" name="comp_name" value="item_box">
                    <textarea name="html" rows="10" cols="50" id="editor1">
                    @if (!empty(App\Helpers\SiteviewHelper::page('item_box')))
                            {!! App\Helpers\SiteviewHelper::page('item_box')->html !!}
                            @else
                            No Data
                            @endif
                    </textarea>
                    <button type="submit" class="btn btn-gradient-success my-2">Save</button>
                </form>
            </div>
        </div>
        @stop