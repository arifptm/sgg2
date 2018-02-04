<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Order;
use App\Lineitem;
use App\User;

class OrderController extends Controller
{
    public function index(){
    	return view('user.order.index');
    }

    public function ajaxIndex(){
    	$orders = Order::where('user_id', Auth::user()->id)->get();
    	return view('user.order.block-index',['orders' => $orders ]);
    }

    public function ajaxDestroy(Request $request){
        $order = Order::findOrFail($request->order_id);
        $order->product()->detach();
        $order->delete();

        return response()->json();
    }    

    public function show($id){
    	return view('user.order.show',['id' => $id ]);
    }

    public function ajaxShow($id){
        $order = Order::whereId($id)->with('product')->first();
        return view('user.order.block-show',['order' => $order]);
    }   

    public function checkout(Request $request){
        $order = Order::findOrFail($request->order_id);
        $order->status = 'pending';
        $order->save();
        return response()->json();
    } 

}
