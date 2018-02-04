<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Product;
use App\Role;
use App\Http\Requests\admin\ProductEditRequest;

class ProductController extends Controller
{
    public function index(){         	
    	return view('admin.product.index');
    }

    public function show($slug){            
        $product = Product::whereSlug($slug)->first();
        //dd($product);
        return view('admin.product.show',['product'=>$product]);
    }

    public function list($state='pending_approved_rejected'){
    	$states= explode('_', $state);
    	$products = Product::whereIn('status', $states )->orderBy('id','desc')->paginate(20);
    	return view('admin.product.list',['products'=>$products]);
    } 
 
    public function update(ProductEditRequest $request){
    	$product = Product::findOrFail($request->product_id);
        $product->status = $request->product_status;
        if ($request->hasFile('image')) {
            $product->image = $this->upload($request);
        }     	
    	$product->name = $request->name;
    	$product->price = $request->price;
    	$product->url = $request->url;
    	$product->disposable = isset($request->disposable) ?: 'unhp' ;    	
    	$product->unit = $request->unit;
    	$product->stock = $request->stock ?: 0 ;
    	$product->body = $request->body;
    	$product->save();
    	return response()->json(['product'=>$product->name]);
    }


    public function destroy(Request $request){
        $product = Product::destroy($request->id);
        return response()->json(['product' => $product]);        
    }


	public function upload(Request $request){    
      	if($request->file('image')->isValid()) {
         	try {
            	$file = $request->file('image');
            	$name = time() . '.' . $file->guessClientExtension();
            	$request->file('image')->move("assets/images/products/", $name);
            	return $name;
         	} catch (Illuminate\Filesystem\FileNotFoundException $e) {

         	}
      	}
   	}     

}
