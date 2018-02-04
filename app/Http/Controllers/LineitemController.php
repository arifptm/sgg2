<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\Lineitem;
use Auth;
use App\Http\Requests\CreateLineitemRequest;
use App\Http\Requests\EditLineitemRequest;

class LineitemController extends Controller
{

    public function ajaxCreate(CreateLineitemRequest $request){
        $product = Product::findOrFail($request->product_id);
        $user = Auth::user()->id;
        $active_order = Order::where('user_id', $user)->whereStatus('draft');

        $quantity = $request->quantity;
        $notes = $request->notes ? $request->notes : '';
        $aprice = $product->price;
        $price = $quantity * $aprice;

        if($active_order->count()){
            $active_order = $active_order->first();
            $selected_product = $active_order->product()->find($product->id);
            $current_quantity = $selected_product ? $selected_product->pivot->quantity : 0;
            $current_notes = $selected_product ? $selected_product->pivot->notes : '' ;
            $current_price = $selected_product ? $selected_product->pivot->price : 0 ;
            $quantity = $current_quantity + $request->quantity;
            $price = $current_price + $price;
            $notes = $current_notes.' '.$notes;
        } else {
            $active_order = new Order();
            $active_order->user_id = $user;
            $active_order->save();
        }
        
        $lineitems = [
            'quantity'=>$quantity, 
            'notes' => $notes,
            'aprice' => $aprice,
            'price' => $price
        ];

        $active_order->product()->detach($product);
        $active_order->product()->attach($product, $lineitems);
        $msg = '<b><em>'.$product->name.'</em></b> telah masuk dalam daftar rencana permintaan.';
        return response()->json(['msg'=> $msg]);
    }

    public function ajaxUpdate(Request $request){
        $lineitem = Lineitem::findOrFail($request->lineitem_id);
        $product = Product::findOrFail($lineitem->product_id);

        $lineitem->quantity = $request->quantity;
        $lineitem->notes = $request->notes;
        $lineitem->price = $request->quantity * $lineitem->aprice;
        $lineitem->save();
        $msg = '<b><em>'.$product->name.'</em></b> berhasil diperbarui.';
        return response()->json(['msg'=> $msg]);
    }

    public function ajaxDestroy(Request $request){
        $order = Order::findOrFail($request->order_id);
        $product = Product::findOrFail($request->product_id);
        $order->product()->detach($product);
        
        //if no product also delete order
        $rest = $order->product->count();
        if ($rest == 0){
            $order->delete();
        }
        $msg = $product->name;
        return response()->json(['msg' => $msg, 'rest' => $rest]);    
    }

}

