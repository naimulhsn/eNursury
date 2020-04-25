<?php

namespace app\Http\Controllers;
use Auth;
use app\User;
use app\Product;
use app\CartProduct;
use app\Wishlist;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        if(auth()->guest())return redirect('home');
        if(Auth::user()->type=='general')abort(403);
        $products = Product::where('user_id',auth()->id())->latest()->get();
        
        return view('products.manage',[
            'products'=>$products
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
            return redirect()->route('login')->with('placeAd',"You will have to Login first to Upload your Products here.");
        }

        if(Auth::user()->type=='general')abort(403);

        return view('products.create');
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
        if(Auth::user()->type=='general' )abort(403);
        //validate
        $validated=request()->validate([
            'category'=>'required',
            'name'=>['required','between:3,120'],
            'price'=>'required',
            //'negotiation'=>['required',Rule::in(['negotiable','fixed'])],
            'category'=>['required', 'exists:categories,category'],
            'about'=>['required','between:10,500'],
            'image' => 'required|image|mimes:jpeg,png,jpg|max:300072',

        ]);
        $imageName = time().'__'.request()->image->getClientOriginalName();
  
        request()->image->move(public_path('images/Products'), $imageName);
        
        $product=new Product();
        $product->category = $validated['category'];
        $product->user_id = Auth::user()->id;
        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->available = 1;
        $product->about = $validated['about'];
        $product->district = Auth::user()->seller->district;
        $product->distance = Auth::user()->seller->distance;
        $product->image="/images/Products/".$imageName;

        $product->save();

        //$category=Category::where('category',$validated['category'])->first();
        //$category->product_count= $category->product_count+1;
        //$category->save();

        //$res= DB::select('select product_count as pp from categories where category=?',[$validated['category']]);
        //return dd($res[0]);
        //$cnt= $res[0]->pp+1;
        //DB::update('update categories set product_count = ? where category = ?',[$cnt,$validated['category']]);
        
        return redirect()->route('products.index')->with('status','Your Product is uploaded successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \app\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $wished = Auth::user()->wishlists->where('product_id',$product->id)->count();
        $wishCount = $product->wishlists->count();
        $incart = Auth::user()->cartProducts->where('product_id',$product->id)->count();
        return view('products.show',[
            'product'=>$product,
            'seller'=>$product->user,
            'wished'=>$wished,
            'wishcount'=>$wishCount,
            'incart'=>$incart
        ]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \app\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \app\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \app\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    
    public function addtowishlist(Product $product)
    {
        $wish = new Wishlist();
        $wish->user_id = Auth::user()->id;
        $wish->product_id = $product->id;
        $wish->save();

        return redirect()->route('products.show',$product->id)
        ->with('status','Added to Wishlist...');
    }
    
}
