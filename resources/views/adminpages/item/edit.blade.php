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
                      
                            <img src="{{ asset( 'book_images/'.$item->image) }}" alt="Item image" style="max-width: 100px; max-height: 200px; margin-left: 15px;">
                        @endif
                    </div>
              
                <form class="form-sample" action="{{ route('updateitem',['id' => $item->id]) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <p class="card-description">Item info</p>
                  
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group row">
                              <label class="col-sm-3 col-form-label">Name</label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" name="name" value="{{ $item->name}}" />
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
                                <input type="file" class="form-control" name="image" />
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
                                  <input type="file" class="form-control" name="bookfile" />
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
                                  <textarea class="form-control" name="description">{{ $item->description }}</textarea>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
  $(document).ready(function(){
       // Automatically hide the status message alert after 3 seconds
       $("#updateSuccessAlert").fadeTo(3000, 500).slideUp(500, function(){
          $("#updateSuccessAlert").slideUp(500);
      });
  });
</script>
@stop
