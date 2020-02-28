<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\Ad;
use app\Category;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ads=Ad::orderBy('updated_at','desc')->paginate(20);
        $categories=Category::orderBy('category')->get();
        $count=Category::all()->sum('product_count');
        return view('home',[
            'ads'=>$ads,
            'categories'=>$categories,
            'count_all'=>$count,
            'curr'=>'all'
        ]);
    }
    public function category($cat)
    {
        $ads=Ad::where('category',$cat)->orderBy('updated_at','desc')->paginate(20);
        $categories=Category::orderBy('category')->get();
        $count=Category::all()->sum('product_count');
        return view('home',[
            'ads'=>$ads,
            'categories'=>$categories,
            'count_all'=>$count,
            'curr'=>$cat
        ]);
    }
    public function about()
    {
       
        return view('layouts.about');
    }
}
