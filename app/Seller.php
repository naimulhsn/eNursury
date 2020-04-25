<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    public function user(){
        return $this->belongsTo('app\User');
    }
    
    //
    protected $fillable = [
        'name', 'user_id','cover','district','location',
        'about','phone','latitude','longitude','distance',
    ];
}
