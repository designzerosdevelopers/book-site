@extends('layouts.admin-layout.app')
@section('content')
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-success text-white me-2">
        <i class="mdi mdi-home"></i>
      </span> Dashboard
    </h3>
    <nav aria-label="breadcrumb">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
          <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-success align-middle"></i>
        </li>
      </ul>
    </nav>
  </div>
  <div class="row">
    <div class="col-md-4 stretch-card grid-margin">
      <div class="card bg-gradient-danger card-img-holder text-white">
        <div class="card-body">
          <!-- Total Sales -->
          <div class="total-sales mb-4">
            <div class="card-content">
              <img src="{{asset('admin/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
              <h5 class="font-weight-normal mb-2">Total Sales <i class="mdi mdi-chart-line mdi-24px float-right"></i></h5>
              <h3 class="mb-0" style="font-size: 30px">${{ $totalsale }}</h3>
            </div>
          </div>
          <!-- Weekly and Monthly Sales -->
          <div class="row">
              <!-- Last Week Sales -->
              <div class="col-md-6">
                  <div class="last-week-sales card-content mb-3">
                      <h5 class="font-weight-normal mb-2">Last 07 Days</h5>
                      <h3 class="mb-0">${{ $lastweek }}</h3>
                  </div>
              </div>
              <!-- Last Month Sales -->
              <div class="col-md-6">
                <div class="last-month-sales card-content mb-3">
                  <h5 class="font-weight-normal mb-2">Last 30 Days</h5>
                  <h3 class="mb-0">${{ $lastmonth }}</h3>
                </div>
             </div>
           </div>
         </div>
       </div>
     </div>

     <div class="col-md-4 stretch-card grid-margin">
      <div class="card bg-gradient-info card-img-holder text-white">
        <div class="card-body">
          <!-- Total Sales -->
          <div class="total-sales mb-4">
            <div class="card-content">
              <img src="{{ asset('admin/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
              <h5 class="font-weight-normal mb-2">Total Sold <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i></h5>
              <h3 class="mb-0" style="font-size: 30px">{{ $total_item_sold }}</h3>
            </div>
          </div>
          <!-- Weekly and Monthly Sales -->
          <div class="row">
              <!-- Last Week Sales -->
              <div class="col-md-6">
                  <div class="last-week-sales card-content mb-3">
                      <h5 class="font-weight-normal mb-2">Last 07 Days</h5>
                      <h3 class="mb-0">{{ $last7days_items_sold }}</h3>
                  </div>
              </div>
              <!-- Last Month Sales -->
              <div class="col-md-6">
                <div class="last-month-sales card-content mb-3">
                  <h5 class="font-weight-normal mb-2">Last 30 Days</h5>
                  <h3 class="mb-0">{{ $last30days_items_sold }}</h3>
                </div>
             </div>
           </div>
         </div>
       </div>
     </div>
        

    <div class="col-md-4 stretch-card grid-margin">
      <div class="card bg-gradient-success card-img-holder text-white">
        <div class="card-body">
          <img src="{{asset('admin/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
          <h4 class="font-weight-normal mb-3">Visitors Online <i class="mdi mdi-diamond mdi-24px float-right"></i>
          </h4>
          <h2 class="mb-5">95,5741</h2>
          {{-- <h6 class="card-text">Increased by 5%</h6>  --}}
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Registered Users</h4>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th> Full Name </th>
                  <th> Email </th>
                  <th> Registered date </th>
                </tr>
              </thead>
              <tbody>
            
                  @foreach ($users as $user)
                      <tr>
                          <td>
                            {{ $user->name.' '.$user->last_name }} 
                          </td>
                          <td> {{ $user->email }} </td>
                          <td> {{ \Carbon\Carbon::parse($user->created_at)->format('M d, Y') }} </td>
                      </tr>
                  @endforeach
              
                  
                 

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop