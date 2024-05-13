<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Category;
use App\Models\Advertisement;

class OrderController extends Controller
{
    function getItem() {
        try{
            
            $category = Category::with(['item' => function($q) {
                        $q->where('status','=','active'); 
            }])->get();
          
            foreach($category as $cat){
                $categories[$cat->name] = $cat->item;                       
            }
            $response = $categories; 
            return response()->json(['success' => true , 'response' => $response]);
        
        }catch(\Exception $e){
            return response()->json(['success' => false,'response'=>$e->getMessage()]);
        }
    }

    function placeOrder(Request $request) {
        try{

            $category = Order::create([
                'order_id'   => random_int(100000, 999999),
                'student_id' => $request->student_id,
                'price'      => $request->total_price,
                'status'     => 'pending',
                'pickup_date'=> $request->pickup_date,
                'order_date' =>  date('Y-m-d H:i:s')
            ])->id;
          
            foreach($request->items as $item){
                $add_item  = [
                    'order_id'   => $category,
                    'item_price' => $item['price'],
                    'item_name'  => $item['name'],
                    'item_qty'   => $item['qty'],
                    'item_img'   => $item['image'],
                    'item_id'    => $item['item_id']
                ];  
                
                $create_item[] = $add_item;
            }
            $response = OrderDetail::insert($create_item);

            if($response){
                return response()->json(['success' => true , 'response' => $response]);
            }
            return response()->json(['success' => false , 'response' => 'unable to create order']);
        }catch(\Exception $e){
            return response()->json(['success' => false,'response'=>$e->getMessage()]);
        }
    }

    function getOrder($id){

        try{
        $order = Order::with('orderDetail')->where('student_id',$id)->get();

        foreach($order as $order_detail){
            $orderDetail[$order_detail->order_id] = $order_detail->orderDetail;
        }
        $response[] = $orderDetail;
        return response()->json(['success' => true , 'response' => $response]);
        
        }catch(\Exception $e){
            return response()->json(['success' => false,'response'=>$e->getMessage()]);
        }
    }

    function getadds(){
        try{
            $advertisment = Advertisement::where('approve','approve')->where('status','active')->get();
            
            return response()->json(['success' => true , 'response' => $advertisment]);
            
            }catch(\Exception $e){
                return response()->json(['success' => false,'response'=>$e->getMessage()]);
            }
    }
    
}
