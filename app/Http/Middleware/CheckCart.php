<?php

namespace App\Http\Middleware;

use Closure;

use App\Order;
Use Auth;
use Illuminate\Support\Facades\View;

class CheckCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if($user->hasRole('user')){
            $order = Order::whereUser_id($user->id)->whereStatus('draft');
            if($order->count()){
                 View::share('draft_order', '1');
            }
        }    
        return $next($request);
    }
}
