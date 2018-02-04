<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;
use Auth;


class Product extends Model
{
	use Sluggable;
	
    protected $guarded = ['id'];

    public function user(){
      return $this->belongsTo('App\User');
    }

    public function getRegisterDateAttribute($v){
      return ($v != null) ?  Carbon::parse($v)->format('d-m-y') : "-";
    }

    public function getCreatedAtAttribute($v){
      return ($v != null) ?  Carbon::parse($v)->format('d-m-y') : "-";
    }

    public function order(){
      return $this->belongsToMany('App\Order', 'lineitems')->withPivot('id', 'product_id', 'quantity','price', 'notes' , 'created_at');
    }

    public function scopeVerified($query){
      return $query->where('status','accepted');
    }

    public function scopeOwned($query){
      return $query->where('user_id', Auth::user()->id);
    }

    public function sluggable(){
      return [ 'slug' => [ 'source' => 'name'] ];
    }
}
