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
      <div class="col-12 grid-margin stretch-card">
            @include('profile.partials.update-profile-information-form')
       </div>
       
       <div class="col-12 grid-margin stretch-card">
          @include('profile.partials.update-password-form')
       </div>
    </div>
      
</div>
@stop
