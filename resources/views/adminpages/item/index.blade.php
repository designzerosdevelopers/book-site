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
                  <a href="{{route('createitem')}}" class="ml-auto"><button class="btn btn-gradient-success me-2">Create</button></a>
              </div>      
              @if(session('success'))
                <div class="alert alert-success" role="alert" id="success-alert">
                    {{ session('success') }}
                </div>
              @endif        
              @if(session('error'))
              <div class="alert alert-danger" role="alert" id="error-alert">
                  {{ session('error') }}
              </div>
            @endif 
            <div class="table-responsive">
                <table class="table table-striped  ">
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
                      <td><img src="{{App\Helpers\SiteviewHelper::generates3url($item->image)}}" alt="image" /></td>
                      <td>{{$item->name}} </td>
                      <td>{{$item->slug}} </td>
                      <td>{{$item->price}} </td>
                      <td>
                        <div class="dropdown">
                          <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <!-- Dropdown Trigger Content -->
                              <b>...</b>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <!-- Dropdown Items -->
                              <a class="dropdown-item" href="#">View</a>
                              <a class="dropdown-item" href="{{ route('edititem',['id'=>$item->id]) }}">Edit</a>
                              <form action="{{ route('deleteitem',['id'=>$item->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
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
        </div>
@stop

