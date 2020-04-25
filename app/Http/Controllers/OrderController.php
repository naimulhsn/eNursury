<?php

namespace app\Http\Controllers;
use Auth;
use app\User;
use app\Order;
use app\OrderedProduct;
use app\Product;
use app\CartProduct;
use app\Wishlist;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['']);
    }

    public function addtocart(Request $request)
    {
        CartProduct::create([
            'user_id' => auth()->id(),
            'product_id' => $request['product_id'],
            'quantity' => $request['quantity']
        ]);
        return redirect()->route('products.show',$request['product_id'])
        ->with('status','Product is added to your Cart...');
    }

    public function mycart()
    {
        $items = Auth::user()->cartProducts;
        return view('manage.cart',[
            'items' => $items
        ]);
    }
    public function place_order(Request $request){
        $arr = json_decode(htmlspecialchars_decode($request['arr']));
        
        $user = Auth::user();
        
        $order = Order::create([
            'user_id' =>  $user->id,
            'total_count' => $request['totalCount'] ,
            'total_price' => $request['totalPrice'] ,
            'delivery_address' => $request['address'] ,
            'payment_method' => "Cash on delivery",
            'instruction' => $request['instruction'] ,
            'order_date' =>  date("d/m/Y")
        ]);

        for($i=0; $i < count($arr,0); $i++){
            
            OrderedProduct::create([
                'order_id' => $order->id ,
                'seller_id' => $arr[$i]->seller_id ,
                'user_id' =>  $user->id,
                'product_id' => $arr[$i]->product_id ,
                'quantity' => $arr[$i]->quantity ,
                'total_price' => $arr[$i]->total_price ,
                'delivery_status' => "On Process"
            ]);
        }
        
        $cart = $user->cartProducts()->get();
        foreach($cart as $item){
            $item->delete();
        }
        return redirect()->route('my_orders')->with('status','Order placed...');
        
    }
    
    public function my_orders(){
        $user = Auth::user();
        
        $orders = $user->orders()->latest()->get();
        
        $products = "";
        foreach($orders as $order){
            $products[$order->id] = $order->orderedProducts;
        }
        return view('manage.myorders',
        compact('user','orders','products'));
        
    }
    public function customer_orders(){
        $user = Auth::user();
        if($user->type=='general')abort(403);
        
        $products = $user->customer_order_products()->latest()->get();
        
        if(count($products)==0)$products = "";
        return view('manage.customer_orders',
        compact('user','products'));
    }
    
    public function delivstat($o_p_id, $stat){        
        $user = Auth::user();
        $orderedproduct = OrderedProduct::where('id',$o_p_id)->first();
        if($user->id != $orderedproduct->seller_id)abort(403);
        $orderedproduct->delivery_status = $stat;
        $orderedproduct->save();
        return redirect()->route('customer_orders');
    }
}
