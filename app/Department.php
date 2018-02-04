<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Department extends Model
{
	use Sluggable;

    protected $fillable = ['name'];
    public $timestamps = false;

    public function sluggable(){
      return [ 'slug' => [ 'source' => 'name'] ];
    }

    public function user(){
    	return $this->hasMany('App\User');
    }
    
}
