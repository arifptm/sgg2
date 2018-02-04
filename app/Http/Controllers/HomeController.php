<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Auth;
use App\User;
use App\Product;
use App\Order;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Auth::check()){
            return route('login');
        }

        if(Auth::user()->hasRole('user')){
            return view('user.product.index');
        }

        if(Auth::user()->hasRole('admin')) {

            $p = new Product;            
            $products['new'] = $p->limit(10)->orderBy('id','desc')->get();
            $products['pending'] = $p->whereStatus('pending')->get()->count();
            $products['verified'] = $p->whereIn('status', ['approved', 'rejected'])->get()->count();
            $products['all'] = $p->all()->count();


            $o = new Order;
            $orders['new'] = $o->limit(10)->where( 'status', '!=', 'draft')->orderBy('id','desc')->get();
            $orders['pending'] = $o->whereStatus('pending')->get()->count();
            $orders['verified'] = $o->whereIn('status', ['accepted', 'rejected'])->get()->count();
            $orders['all'] = $o->all()->count();

            return view('admin.index')->with([        
                'products' => $products,
                'orders' => $orders,                      
            ]);
        }

         if(Auth::user()->hasRole('kalab')) {            
            return redirect('kalab/orders/index');
         }
        
    }
}
