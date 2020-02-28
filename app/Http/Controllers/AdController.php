<?php

namespace app\Http\Controllers;
use Auth;
use app\User;
use app\Ad;
use app\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


use Illuminate\Support\Facades\DB;
class AdController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['create','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$user=Auth::user();
        //$ads=$user->ads()->latest()->paginate(5);
        if(auth()->guest())return redirect('home');

        $ads=Ad::where('user_id',auth()->id())->latest()->get();

        return view('ads.manage',[
            'ads'=>$ads
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::check()){
            return redirect()->route('login')->with('placeAd',"You will have to Login first to place your Ads here.");
        }
        //$categories=Category::all();
        $categories= DB ::select('select * from categories');

        return view('ads.create',[
            'categories'=>$categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->guest() )abort(403);
        //validate
        $validated=request()->validate([
            'name'=>['required','between:3,100'],
            'price'=>'required',
            'negotiation'=>['required',Rule::in(['negotiable','fixed'])],
            'category'=>['required', 'exists:categories,category'],
            'description'=>['required','between:10,500'],
            'specification'=>['required','between:0,500'],
            'image' => 'required|image|mimes:jpeg,png,jpg|max:3072',

        ]);
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
  
        request()->image->move(public_path('images'), $imageName);
        
        $ad=new Ad();
        
        $ad->user_id=Auth::user()->id;
        $ad->name=$validated['name'];
        $ad->price=$validated['price'];
        $ad->negotiation=$validated['negotiation'];
        $ad->category=$validated['category'];
        $ad->description=$validated['description'];
        $ad->specification=$validated['specification'];
        $ad->available=1;
        if(! $request['used_time_days']>0)$request['used_time_days']=0;
        if(! $request['used_time_months']>0)$request['used_time_months']=0;
        if(! $request['used_time_years']>0)$request['used_time_years']=0;
        $ad->used_time=$request['used_time_days']+($request['used_time_months']*30)+($request['used_time_years']*365);
        if($ad->used_time>0)$ad->condition="Used";
        else $ad->condition="New";
        $ad->image="/images/".$imageName;

        $ad->save();

        //$category=Category::where('category',$validated['category'])->first();
        //$category->product_count= $category->product_count+1;
        //$category->save();

        $res= DB::select('select product_count as pp from categories where category=?',[$validated['category']]);
        //return dd($res[0]);
        $cnt= $res[0]->pp+1;
        DB::update('update categories set product_count = ? where category = ?',[$cnt,$validated['category']]);
        
        return redirect()->route('home')->with('status','Your Ad is uploaded successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \app\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {

        return view('ads.show',[
            'ad'=>$ad,
            'user'=>$ad->user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \app\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ad=Ad::findOrFail($id);
        if($ad->user_id!= auth()->id() )abort(403);
        return view('ads.edit',[
            'ad'=>$ad
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \app\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ad=Ad::findOrFail($id);
        if($ad->user_id!= auth()->id() )abort(403);

        $val=request()->validate([
            'name'=>['required','between:3,100'],
            'price'=>'required',
            'negotiation'=>['required',Rule::in(['negotiable','fixed'])],
    
            'description'=>['required','between:10,500'],
            'specification'=>['required','between:0,500']

        ]);
        $ad->name=$val['name'];
        $ad->price=$val['price'];
        $ad->negotiation=$val['negotiation'];
        $ad->description=$val['description'];
        $ad->specification=$val['specification'];
        
        $ad->save();
        return redirect('home')->with('status','Your Ad has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \app\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ad=Ad::findOrFail($id);
        if($ad->user_id!= auth()->id() )abort(403);
        
        $cat=$ad->category;

        $res= DB::select('select product_count as pp from categories where category=?',[$cat]);;
        $cnt= $res[0]->pp-1;
        DB::update('update categories set product_count = ? where category = ?',[$cnt,$cat]);

        $ad->delete();
        //$del=DB::delete('delete from ads where id = ?',[$id]);
        //if($del != 1)abort(403);
        return redirect('home')->with('bad_status','The Ad has been deleted successfuly');
    }
}
