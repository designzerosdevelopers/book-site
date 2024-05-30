@extends('layouts.admin-layout.app')
@section('content')
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
            <a href="#" class="ml-auto"><button class="btn btn-gradient-success me-2">Create</button></a>
          </div>
          <div class="alert alert-success" role="alert" id="success-alert">
            <!-- Success Message -->
            Item created successfully.
          </div>
          <div class="alert alert-danger" role="alert" id="error-alert">
            <!-- Error Message -->
            Error occurred while creating item.
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-condensed">
              <thead>
                <tr>
                  <th style="width: 90%;"> Link </th>
                  <th style="width: 5%;"> Type </th>
                  <th style="width: 5%;"> Action </th>
                </tr>
              </thead>
              <tbody>
                @foreach($links as $link)
                <tr>
                  <td style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; width: 90%;" title="{{ $link->link }}">{{ $link->link }}</td>
                  <td style="width: 5%;">{{ $link->type }}</td>
                  <td style="width: 5%;">
                    <div class="dropdown">
                      <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <!-- Dropdown Trigger Content -->
                        <b>...</b>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <!-- Dropdown Items -->
                        <form action="#" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                          <button type="submit" class="dropdown-item">Delete</button>
                        </form>
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>       
  </div>
@stop
