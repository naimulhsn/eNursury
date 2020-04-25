<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\User;
use app\Ad;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['registerseller']);
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
        if($user->type=='general'){
            return view('user.profile',[
                'user'=>$user,
                'ads'=>$ads
            ]);
        }
        else {
            return view('user.sellerprofile',[
                'user' => $user,
                'ads' => $ads
            ]);
        }

    }
    public function registerseller()
    {
        return view('auth.registerseller');

    }
}
