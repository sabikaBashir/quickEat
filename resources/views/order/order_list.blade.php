@extends('layouts.app',['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Order Management'])
   <div class="container-fluid py-4">
    <div class="row mt-4">
      <div class="col-12">
      @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="card">

        <div class="card-header d-flex justify-content-between">
        <h5 class="mb-0">Order Management</h5>
        </div>

        <div class="table-responsive">
            <table class="table table-flush dataTable-table" id="datatable-basic">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 21.8596%;">id</th>
                        <th style="width: 24.2884%;">Order Date</th>
                        <th style="width: 24.1149%;">status</th>
                        <th style="width: 29.1461%;">Student</th>
                        <th style="width: 33.1364%;">Pickup Date</th>
                        <th style="width: 16.1345%;">Price</th>
                        <th style="width: 16.1345%;">Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                            <p class="text-xs font-weight-bold ms-2 mb-0">#{{$order->order_id}}</p>
                            </div>
                        </td>
                        <td class="font-weight-bold">
                            <span class="my-2 text-xs">{{date('d-M ,h:i A', strtotime($order->order_date))}}</span>
                        </td>
                        <td class="text-xs font-weight-bold">
                            <div class="d-flex align-items-center">
                            @if($order->status == 'pending')
                                <button class="btn btn-icon-only btn-rounded btn-outline-info mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="ni ni-bell-55" aria-hidden="true"></i></button>
                                <span>Pending</span>
                            @elseif($order->status == 'accept')
                                <button class="btn btn-icon-only btn-rounded btn-outline-warning mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-check" aria-hidden="true"></i></button>
                                <span>Confirmed</span>
                            @elseif($order->status == 'cancel')
                                <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-times" aria-hidden="true"></i></button>
                                <span>Cancel</span>
                            @elseif($order->status == 'complete')
                                <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="ni ni-basket" aria-hidden="true"></i></button>
                                <span>Complete</span>
                            @endif
                            </div>
                        </td>
                        <td class="text-xs font-weight-bold">
                            <div class="d-flex align-items-center">
                             @if(!empty($order->studentDetail->image))
                                <img src="{{ asset('uploads/user/'.$order->studentDetail->image) }}" class="avatar avatar-xs me-2" alt="user1">    
                             @else
                                <img src="{{ asset('uploads/user/default-img.jpg') }}" class="avatar avatar-xs me-2" alt="user1">    
                             @endif                            
                            <span>{{$order->studentDetail->name ?? ''}}</span>
                            </div>
                        </td>
                        <td class="text-xs font-weight-bold">
                            <span class="my-2 text-xs">{{date('d-M ,h:i A', strtotime($order->pickup_date))}}</span>
                        </td>
                        <td class="text-xs font-weight-bold">
                            <span class="my-2 text-xs">{{$order->price}}</span>
                        </td>
                        <td class="text-sm">
                            <span class="d-flex">
                                <a href="{{route('get.order.detail',$order->id)}}" class="me-3" data-bs-toggle="tooltip" data-bs-original-title="view order">
                                <i class="fas fa-eye text-secondary" aria-hidden="true"></i>
                                </a>
                            </span>
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
@endsection
