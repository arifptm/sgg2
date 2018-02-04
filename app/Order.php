<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id'];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function product(){
    	return $this->belongsToMany('App\Product', 'lineitems')->withPivot('id', 'product_id', 'quantity', 'aprice' ,'price', 'notes' , 'created_at');
    }
}
