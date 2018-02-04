<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Flash; 
use Yajra\DataTables\Facades\DataTables;
use Auth;
use App\Order;


class ProductController extends Controller
{
    public function index(){
        return view('user.product.index');
    }


    public function blockLineitem(){
 		$order_inprogress = Order::whereUserId(Auth::id())->whereStatus('draft')->first();   
        return view('user.product.block-lineitem', ['order_inprogress'=> $order_inprogress] );    	
    }

    public function ajaxShow($slug){
        $product = Product::whereSlug($slug)->first();
        return response()->json(['product'=>$product]);
    }



    public function productDatatables(){
        
        $product = Product::where('status','!=','rejected');

        $dt = Datatables::of($product)
            ->editColumn('title', function ($product) {
                return '<a href="#" data-slug="'.$product->slug.'" class="product-name">'.$product->name.'</a>';                    
            })

            ->editColumn('image', function ($product) {
                $img = ($product->image == null) ? 'noimage.gif' : $product->image ;
                return '<a href="/products/'.$product->id.'"><img src="/imagecache/tiny/'.$img.'" /></a>';
            })

            ->editColumn('body', function($product){
                if ($product->body){
                    return str_limit($product->body,60,'... <a href="#" data-toggle="tooltip" title="'. e($product->body).'"><i class="fa fa-play-circle"></i></a>');
                } else {
                    return '<span class="text-gray"><em>~n/a~</em></span>';
                }
            })   

            ->editColumn('disposable', function($product){              
                if($product->disposable == 'unhp' ){
                    return '<div class="badge">NonHP<div>';
                } else
                if($product->disposable == 'hp' ){
                    return '<div class="badge bg-green">HP<div>';
                } else {
                    return '<div class="text-gray"><em>~n/a~</em></div>';
                }

            })

            ->addColumn('action', function ($product) {
                if ($product->verified != 9 ){                    
                    $img = $product->image ? $product->image : 'noimage.gif';                    
                    return '<button             
                        data-product_id = "'.$product->id.'"
                        data-title = "'.$product->name.'"
                        data-unit = "'.$product->unit.'"
                        data-image = "'.$img.'"
                        class="btn btn-xs btn-primary btn-create-lineitem">
                        <i class="glyphicon glyphicon-plus"></i> Permintaan</button>';                  
                }             
            })            
                 
            ->rawColumns(['title', 'image','body', 'disposable' ,'action']);
            return $dt->make(true);         
    }

}
