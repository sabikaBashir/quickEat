@extends('layouts.app',['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Order Detail'])
   <div class="container-fluid">
      <div class="row mb-lg-5">
        <div class="col-lg-10 mx-auto">
        
         <div class="card my-5">
            <div class="card-header p-3 pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                    <h6>Order Details</h6>
                    <p class="text-sm mb-0">Order no. <b>{{$orderDetail->order_id}}</b> 
                    </p>
                    </div>
                    <a href="javascript:;" class="btn bg-primary ms-auto mb-0"style="color:#fff">{{$orderDetail->status}}</a>
                </div>
            </div>

            <div class="card-body p-3 pt-0">
        
                <hr class="horizontal dark mt-0 mb-4">
                
                <div class="d-flex">
                 <div class="card-body">
                 <div class="row">
                        <div class="col-12">
                            <div class="table-responsive border-radius-lg">
                                <table class="table text-right">
                                    <thead class="bg-default">
                                    <tr>
                                    <th scope="col" class="pe-2 text-start ps-2 text-white">Item</th>
                                    <th scope="col" class="pe-2 text-white">Qty</th>
                                    <th scope="col" class="pe-2 text-white" colspan="2">Rate</th>
                                    <th scope="col" class="pe-2 text-white">Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orderDetail->orderDetail as $detail)
                                        <tr>
                                        <td class="text-start">{{$detail->item_name}}</td>
                                        <td class="ps-4">{{$detail->item_qty}}</td>
                                        <td class="ps-4" colspan="2">{{$detail->item_price}}</td>
                                        @php $tot = $detail->item_qty*$detail->item_price; @endphp
                                        <td class="ps-4">{{$tot}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                    <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th class="h5 ps-4" colspan="2">Total</th>
                                        <th colspan="1" class="text-right h5 ps-4">{{$orderDetail->price}}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>            
                    </div>
                 </div>
                </div>

                <hr class="horizontal dark mt-4 mb-4">

                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12">
                        <h6 class="mb-3">Track order</h6>
                        @if($orderDetail->order_date)
                        <div class="timeline timeline-one-side">
                            <div class="timeline-block mb-3">
                            <span class="timeline-step">
                            <i class="ni ni-bell-55 text-secondary"></i>
                            </span>

                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">Order received</h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{date('d-M h:i A', strtotime($orderDetail->order_date))}}</p>
                            </div>
                        </div>
                        @endif
                        @if($orderDetail->pickup_date)
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                            <i class="fas fa-diagnoses text-secondary"></i>
                            </span>

                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">Order Pick-up time
                                </h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{date('d-M h:i A', strtotime($orderDetail->pickup_date))}}</p>
                            </div>
                        </div>
                        @endif
                        @if($orderDetail->approve_date)
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                            <i class="ni ni-check-bold  text-secondary"></i>
                            </span>

                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">Order Approve
                                </h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{date('d-M h:i A', strtotime($orderDetail->approve_date))}}</p>
                            </div>
                        </div>
                        @endif
                        @if($orderDetail->cancel_date)
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                            <i class="fa fa-close text-secondary"></i>
                            </span>

                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0">Order Cancel
                                </h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{date('d-M h:i A', strtotime($orderDetail->approve_date))}}</p>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Reason:  {{$orderDetail->cancel_reason}}</p>                                

                            </div>
                        </div>
                        @endif
                        @if($orderDetail->complete_date)
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                <i class="fas fa-dolly-flatbed text-success text-gradient"></i>
                                </span>
                                
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">Order Completed</h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"> {{date('d-M h:i A', strtotime($orderDetail->complete_date))}}</p>
                               </div>
                            </div>
                        @endif
                        
                    </div>
                </div>

                <div class="col-lg-9 col-md-6 col-12">
            
                    <h6 class="mb-3 ">Billing Information</h6>
                
                    <ul class="list-group">
                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column">
                                <h6 class="mb-3 text-sm">{{$orderDetail->studentDetail->name}}</h6>
                                <span class="mb-2 text-xs">Email Address: <span class="text-dark ms-2 font-weight-bold">{{$orderDetail->studentDetail->email}}</span></span>
                                <span class="text-xs">Student ID: <span class="text-dark ms-2 font-weight-bold">{{$orderDetail->studentDetail->student_id}}</span></span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>        
      </div>
    @if(Auth::user()->role == 'vendor')
      @if($orderDetail->status != 'complete' || $orderDetail->status != 'cancel')
      <div class="card my-5">
        <div class="card multisteps-form__panel p-3 border-radius-xl bg-white h-100 js-active" data-animation="FadeIn">
            <h5 class="font-weight-bolder">Order Status</h5>
            <form method="POST" action="{{route('order.update.status',$orderDetail->id)}}"  class="item-form">
                    
                    @CSRF
                <div class="multisteps-form__content mt-3">
                    <div class="row">
                        <div class="col-12">
                            <label>Mark Order Status</label>
                                <div class=" d-flex flex-column">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="order_status" id="pending" value="pending">
                                        <label class="custom-control-label" for="pending">Pending</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="order_status" id="accept" value="accept">
                                        <label class="custom-control-label" for="accept">Accept</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="order_status" id="cancel" value="cancel">
                                        <label class="custom-control-label" for="cancel">Cancel</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="order_status" id="complete" value="complete">
                                        <label class="custom-control-label" for="complete">Complete</label>
                                    </div>
                        </div>
                        
                        <div class="col-12 mt-3">
                            <label>Reason</label>
                            <textarea class="multisteps-form__textarea form-control" rows="5" name="reason" placeholder="(Add reason in case of cancel)"></textarea>
                        </div>
                    </div>

                    <div class="button-row d-flex mt-4">
                    <button class="btn bg-primary ms-auto mb-0"style="color:#fff" type="submit" title="Send">Update</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
        @endif
        @endif
     </div>
  </div>
@endsection
