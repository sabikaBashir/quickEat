<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
   
    public function get_order()
    {
        $orders = Order::with('studentDetail')->get();
        return view('order.order_list',compact('orders'));
    }

    public function get_order_detail($id)
    {
        $orderDetail = order::with('orderDetail','studentDetail')->where('_id',$id)->first();
        return view('order.view_order',compact('orderDetail'));
    }

    
    public function update_order_status(Request $request,String $id)
    {
        $status = $request->order_status;
        $order = order::find($id);
        $order->status = $status;
        
        if($status == 'accept'){
            $order->approve_date = date('Y-m-d H:i:s');
        }elseif($status == 'complete'){
            $order->complete_date = date('Y-m-d H:i:s');
        }elseif($status == 'cancel'){
        $order->cancel_date = date('Y-m-d H:i:s');
        $order->cancel_reason = $request->reason;
        }
       
        $order->save();

        return redirect()->route('get.order')
            ->with('success', 'Order Update successfully.');
    
    }

  
}
