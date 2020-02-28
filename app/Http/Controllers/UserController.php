<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\User;
use app\Ad;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except([]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile($id)
    {

        $user=User::where('id',$id)->first();
        $ads=Ad::where('user_id',$id)->latest()->get();
        //return dd($user['gender'] , $ads);
        return view('user.profile',[
            'user'=>$user,
            'ads'=>$ads
        ]);

    }
}
