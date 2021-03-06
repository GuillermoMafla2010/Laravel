<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table="videos";


//relacion uno a muchos
    public function comments(){

    	return $this->hasMany("App\Comment");
    }
//relacion muchos a uno
    public function user(){

    	return $this->belongsTo("App\User","user_id");
    }
}
