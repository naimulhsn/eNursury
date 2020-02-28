<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded =['id'];

    public function ads(){
        return $this->hasMany('app\Ad');
    }
}
