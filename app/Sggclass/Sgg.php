<?php

namespace App\Sggclass;

use App\Order;
Use Auth;


class Sgg
{
    public function CheckCart()
    {
        $user = Auth::user();
        if($user->hasRole('user')){
            $order = Order::whereUser_id($user->id)->whereStatus('draft');
            if($order->count()){
                return true;
            }
        }
    }
}
