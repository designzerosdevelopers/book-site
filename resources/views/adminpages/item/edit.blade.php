@extends('layouts.admin-layout.app')
@section('content')
     <!-- partial -->
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title"> Home Page Settings </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Forms</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form elements</li>
              </ol>
            </nav>
          </div>
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                    <!-- Display the image dynamically -->
                    <div style="display: flex; align-items: center;">
                        <div style="flex: 1;">
                            <h4 class="card-title">Home form elements</h4>
                            <p class="card-description"> Edit your home elements </p>
                        </div>
                        @if(!empty($item->image))
                      
                            <img src="{{ asset($item->image) }}" alt="Item image" style="max-width: 100px; max-height: 200px; margin-left: 15px;">
                        @endif
                    </div>
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" id="updateSuccessAlert">
                        {{ session('success') }}
                    </div>
                @endif
                
                <form class="form-sample" action="{{ route('updateitem',['id' => $item->id]) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <p class="card-description">Item info</p>
                  
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Name</label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" name="name" value="{{ $item->name }}" />
                                  @error('name')
                                      <span class="text-danger">{{ $message }}</span>
                                  @enderror
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="image" value="{{ $item->image }}" />
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Price</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="price" value="{{ $item->price }}" />
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                      <div class="col-md-6">
                          <div class="form-group row">
                              <label class="col-sm-3 col-form-label">File</label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" name="bookfile" value="{{  $item->file }}"/>
                                  @error('bookfile')
                                      <span class="text-danger">{{ $message }}</span>
                                  @enderror
                              </div>
                          </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Category</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="category">
                                        <option value="" disabled>Select a category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @if(old('category') == $category->id) selected @endif>{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    
                
                
                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Description</label>
                              <div class="col-sm-12">
                                  <textarea class="form-control" id="editor" name="description">{{ $item->description }}</textarea>
                                  @error('description')
                                      <span class="text-danger">{{ $message }}</span>
                                  @enderror
                              </div>
                          </div>
                      </div>
                  </div>
                  <button type="submit" class="btn btn-gradient-primary me-2">Save</button>
              </form>
              
              </div>
            </div>
          </div>
        </div>
@stop
