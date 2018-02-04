<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Order;

class OrderController extends Controller
{
    public function index(){         	
    	return view('admin.order.index');
    }

    public function list(){
    	$orders = Order::orderBy('id', 'desc')->where('status', '!=', 'draft')->paginate(20);
    	return view('admin.order.list', ['orders' => $orders ]);
    }

    public function show($id){
    	return view('admin.order.show',['id'=>$id]);
    }

    public function ajaxShow($id){
    	$order = Order::whereId($id)->with('product')->first();
        return view('admin.order.block-show',['order' => $order]);
    }
} 
