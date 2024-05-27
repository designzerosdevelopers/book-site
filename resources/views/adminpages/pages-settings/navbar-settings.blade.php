<!DOCTYPE html>
@extends('layouts.admin-layout.app')
@section('content')
    <div class="content-wrapper">
        <div class="card p-2">
            <div class="">
                <form action="{{ route('update.page') }}" method="post">
                    @csrf
                    <input type="hidden" name="comp_name" value="navbar">
                    <textarea name="html" rows="10" cols="50" id="editor1">
                    @if (!empty(App\Helpers\SiteviewHelper::page('navbar')))
                            {!! App\Helpers\SiteviewHelper::page('navbar')->allhtml !!}
                            @else
                            No Data
                            @endif
                </textarea>
                    <br>
                    <button type="submit" name="part" value="allhtml" class="btn btn-gradient-success me-2">Save</button>
                </form>
            </div>
        </div>

        @stop