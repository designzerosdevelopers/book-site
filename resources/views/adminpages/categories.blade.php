@extends('layouts.admin-layout.app')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Form elements </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Forms</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form elements</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h4 class="card-title mt-4">Categories</h4>
                    <p class="card-description"> Modify categories </p>
                    {{-- create category code goes here  --}}
                    <h4 class="card-title">Create a new category</h4>
                    <form class="forms-sample" action="" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Enter category name" name="category_name" aria-label="Enter category name" aria-describedby="basic-addon2">
                            <button class="btn btn-gradient-primary" type="submit">Create</button>
                        </div>
                    </form>

                 
                    <form class="forms-sample">
                        @csrf
                        @method('PUT')
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category['id'] }}</td>
                                    <td>
                                        <form action="{{ route('updatecategory') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="input-group">
                                                <input type="text" name="category_name" value="{{ $category['category_name'] }}" class="form-control">
                                            </div>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn  btn-xs btn-gradient-primary ">Update</button>
                                        </form>
                                        <form action="{{ route('deletecategory') }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-gradient-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
