<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use Flash; 
use Yajra\DataTables\Facades\DataTables;
use Auth;
use App\Order;

use App\Http\Requests\CreateProposalRequest;
use App\Http\Requests\EditProposalRequest;

class ProposalController extends Controller
{
   
    public function index(){
        return view('user.proposal.index');
    }

    public function proposalDatatables(){
        $product = Product::owned();

        $dt = Datatables::of($product)
            ->editColumn('title', function ($product) {
                return '<a href="#" data-slug="'.$product->slug.'" class="product-name">'.$product->name.'</a>';                    
            })

            ->editColumn('image', function ($product) {
                $img = ($product->image == null) ? 'noimage.gif' : $product->image ;
                return '<a href="/products/'.$product->id.'"><img src="/imagecache/tiny/'.$img.'" /></a>';
            })

            ->editColumn('price', function($product){
                return number_format($product->price, 0, ',', '.');
            })

            ->editColumn('body', function($product){
                if ($product->body){
                    return str_limit($product->body,60,'... <a href="#" data-toggle="tooltip" title="'. e($product->body).'"><i class="fa fa-play-circle"></i></a>');
                } else {
                    return '<span class="text-gray"><em>~n/a~</em></span>';
                }
            })   

            ->editColumn('status', function($product){
                if($product->status == 'pending'){
                    return '<div class="badge text-primary">Pending<div>';
                } elseif($product->status == 'approved'){
                    return '<div class="badge bg-green">Diterima<div>';
                } elseif($product->status == 'rejected'){
                    return '<div class="badge bg-red">Ditolak<div>';
                }
            })

			->editColumn('disposable', function($product){				
                if($product->disposable == 'unhp' ){
                    return '<div class="badge">NonHP<div>';
			    } else
			    if($product->disposable == 'hp' ){
                    return '<div class="badge bg-blue">HP<div>';
			    } else {
			    	return '<div class="text-gray"><em>~n/a~</em></div>';
			    }

            })

            ->addColumn('action', function ($product) {
                    $status = ($product->status != 'pending') ? 'disabled' : '';
                    return "<div class='btn-group'>
                    <button class='btn btn-default btn-xs btn-edit-proposal' 
                    data-product_id='". $product->id ."'
                    data-name='". $product->name."'
                    data-image='". $product->image ."'
                    data-unit='". $product->unit ."'
                    data-price='". $product->price ."'
                    data-url='". $product->url ."'
                    data-body='". e($product->body) ."'
                    ".$status." >
                    <i class='fa fa-edit'></i>
                    </button>
                    <button data-id='". $product->id ."' class='btn btn-danger btn-xs btn-delete-proposal'". $status ." ><i class='fa fa-trash'></i></button>
                   </div>"; 
            })            
				 
            ->rawColumns(['title', 'image','body', 'disposable' ,'action', 'status']);
            return $dt->make(true);         
    }

   	public function ajaxStore(CreateProposalRequest $request){
     	$input = $request->except('product_id');

     	if ($request->hasFile('image')) {
         	$input['image'] = $this->upload($request);
     	}

      $input['user_id'] = $request->user()->id;

     	$proposal = Product::create($input);
     	return response()->json(['proposal' => $proposal]);
   }


    public function ajaxUpdate(EditProposalRequest $request){
          $input = $request->only(['id','image','name','unit','price', 'url', 'body']);

          $proposal = Product::owned()->findOrFail($request->product_id);
          
          if ($request->hasFile('image')) {
             $input['image'] = $this->upload($request);
          }      
          
          $proposal->update($input);

          return response()->json(['proposal' => $proposal]);
    }


   public function ajaxDestroy(Request $request){

      $product = Product::doesntHave('order')->owned()->where('id', $request->id);
      if ($product->count() == 0){
        return response()->json([],401);
      }

      $product->delete();
      return response()->json();
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
