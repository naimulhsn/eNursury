<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $guarded =['id'];

    public function user(){
        return $this->belongsTo('app\User');
    }


}
