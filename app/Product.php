<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $guarded =['id'];

    public function user(){
        return $this->belongsTo('app\User');
    }
    public function wishlists(){
        return $this->hasMany('app\Wishlist');
    }

}
