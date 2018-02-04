<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Role extends Model
{
    use Sluggable;
    public $timestamps = false;
	

	public function users(){
    	return $this->belongsToMany('App\User', 'user_role', 'role_id', 'user_id');
    }

    public function sluggable(){
      return [ 'slug' => [ 'source' => 'name'] ];
    } 
}
