<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    
    protected $fillable = [
        'user_id','product_id',
    ];
    public $timestamps = false;
}
