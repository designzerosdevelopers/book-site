@extends('layouts.admin-layout.app')
@section('content')
     <!-- partial -->
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title"> Item Index</h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Forms</a></li>
                <li class="breadcrumb-item active" aria-current="page">table elements</li>
              </ol>
            </nav>
          </div>
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                  <h4 class="card-title">Item Table</h4>
                  <a href="{{route('createitem')}}" class="ml-auto"><button class="btn btn-gradient-primary me-2">Create</button></a>
              </div>              
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th> Image </th>
                      <th> Item Name </th>
                      <th> Slug </th>
                      <th> Price </th>
                      <th> Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(!empty($items))
                    @foreach($items as $item)
                    <tr>
                      <td><img src="{{'book_images/'.$item->image}}" alt="image" /></td>
                      <td>{{$item->name}} </td>
                      <td>{{$item->slug}} </td>
                      <td>{{$item->price}} </td>
                      <td>
                        <div class="dropdown">
                            <span class=" dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <b>...</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">View</a>
                                <a class="dropdown-item" href="{{ route('edititem',['id'=>$item->id])}}">Edit</a>
                                <form action="{{route('deleteitem',['id'=>$item->id])}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item">Delete</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    </tr>
                    @endforeach
                    @else
                    <td></td>
                    <td></td>
                    <td>No item</td>
                    <td></td>
                    <td></td>
                    @endif
                  </tbody>
                </table>
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
