@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
            
        {{-- Show ads here --}}
        
        <div class="col-md-11">
            @if (session('status'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('status') }}
            </div>
            @endif
            @if (session('bad_status'))
                <div class="alert alert-danger" role="alert">
                    {{ session('bad_status') }}
                </div>
            @endif
            


            @php
                $totalCount = 0;
                $totalPrice = 0;
                $deliveryCost = 60;
                $noProduct = 0;
                $arr ;
                if(count($items)==0){
                    $deliveryCost = 0;
                    $arr = "";
                    $noProduct = 1;
                }
            @endphp




            <div class="pb-5">
                <div class="container-fluid">
                  <div class="row">

                    <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
            
                      <!-- Shopping cart table -->
                      <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col" class="border-0 bg-light">
                                <div class="p-2 px-3 text-uppercase">Product</div>
                              </th>
                              <th scope="col" class="border-0 bg-light">
                                <div class="py-2 text-uppercase">Price</div>
                              </th>
                              <th scope="col" class="border-0 bg-light">
                                <div class="py-2 text-uppercase">Quantity</div>
                              </th>
                              <th scope="col" class="border-0 bg-light">
                                <div class="py-2 text-uppercase">Total</div>
                              </th>
                              <th scope="col" class="border-0 bg-light">
                                <div class="py-2 text-uppercase">Remove</div>
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach ($items as $item)
                                <tr> 
                                @php
                                    $product = $item->product;
                                    $totalCount += $item->quantity;
                                    $totalPrice += ($product->price * $item->quantity);
                                    //Store array
                                    $arr[$loop->index]['seller_id'] = $product->user_id; 
                                    $arr[$loop->index]['product_id'] = $product->id; 
                                    $arr[$loop->index]['quantity'] = $item->quantity; 
                                    $arr[$loop->index]['total_price'] = ($product->price * $item->quantity);
                                @endphp
                                    
                                    <th scope="row" class=" @if($loop->first) border-0 @endif ">
                                        <div class="p-2">
                                        <img src="{{$product->image}}" alt="" width="70" class="img-fluid rounded shadow-sm">
                                        <div class="ml-3 d-inline-block align-middle">
                                        <h5 class="mb-0"> <a href="{{route('products.show',$product->id) }}" 
                                            class="text-dark d-inline-block align-middle">{{$product->name}}</a>
                                        </h5>
                                        <span class="text-muted font-weight-normal font-italic d-block">Category: {{$product->category}}</span>
                                        </div>
                                        </div>
                                    </th>
                                    <td class="@if($loop->first) border-0 @endif align-middle"><strong> {{$product->price}} TK </strong></td>
                                    <td class="@if($loop->first) border-0 @endif  align-middle">
                                        <div class="input-group mb-3" style="max-width: 120px;">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary js-btn-minus" type="button">
                                                <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input name="quantity" type="number" readonly class="form-control text-center quantity" value="{{$item->quantity}}" min="1" max="100">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary js-btn-plus" type="button">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="@if($loop->first) border-0 @endif align-middle"><strong> {{$product->price * $item->quantity}} TK </strong></td>
                                    <td class="@if($loop->first) border-0 @endif  align-middle"><a href="#" class="text-dark"><i class="fa fa-trash"></i></a></td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      <!-- End -->



                    <form method="POST" action="{{ route('place_order') }}" id="orderForm">
                        @csrf
                        <input type="hidden" id="arr" name="arr" value="<?php echo htmlspecialchars(json_encode($arr)); ?> ">
                        
                        <div class="row">
                        
                            <div class="col-lg-12 ">
                                {{-- <a class="btn btn-outline-secondary btn-block btn-sm mx-2 mb-5 disabled" href="{{route('products.show',1)}} " role="button">Update Cart</a> --}}
                            </div>
                            <div class="col-lg-6">
                                <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Delivery Address</div>
                                <div class="p-4">
                                <p class="font-italic mb-4">Please Provide: House no, Road no, Village, Thana or Upazilla name.</p>
                                <textarea name="address" id="address" minlength="10" cols="30" rows="3" class="form-control" required
                                    oninput="checkoutbtn()" ></textarea>
                                 <script>
                                    function checkoutbtn() {
                                      var x = document.getElementById("address").value;
                                      var btnn = document.getElementById("chkk");
                                      if(x.length < 10){
                                          btnn.disabled = true;
                                          btnn.innerHTML = "Provide full delivery address to Checkout";
                                      }else{
                                          btnn.disabled = false;
                                          btnn.innerHTML = "Proceed to Checkout..(Place Order)";
                                      }
                                    }
                                    </script>
                                </div>
                                <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Instructions for seller</div>
                                <div class="p-4">
                                <p class="font-italic mb-4">If you have some information for the seller you can leave them in the box below</p>
                                <textarea name="instruction" id="instruction" cols="30" rows="2" class="form-control"></textarea>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 ">
                                <div class="bg-light rounded-pill px-4 py-3 text-center text-uppercase font-weight-bold">Order summary </div>
                                <div class="p-4">
                                    <p class="font-italic mb-4">Delivery Charge is just an estimation. You might need to pay extra depenting on various criteria and situation</p>
                                <ul class="list-unstyled mb-4">
                                    <li class="d-flex justify-content-between py-3 "><strong class="text-muted">Total Products </strong><strong>{{$totalCount}}</strong></li>
                                    <input type="hidden" id="totalCount" name="totalCount" value="{{$totalCount}}">
                                    <li class="d-flex justify-content-between py-3 "><strong class="text-muted">Product Price </strong><strong>{{$totalPrice}} ৳</strong></li>
                                    <li class="d-flex justify-content-between py-3 "><strong class="text-muted">Delivery Charge</strong><strong>{{$deliveryCost}} ৳</strong></li>
                                    <li class="d-flex justify-content-between py-3 "><strong class="text-muted">Total Cost</strong>
                                    <h5 class="font-weight-bold text-danger"> {{$totalPrice + $deliveryCost}} ৳</h5>
                                    </li>
                                    <input type="hidden" id="totalPrice" name="totalPrice" value="{{$totalPrice + $deliveryCost}}">
                                </ul>
                                <br>
                                <button type="button" id="chkk" class="btn btn-danger rounded-pill py-2 btn-block" 
                                onclick="getElementById('orderForm').submit()" disabled>
                                 Provide full delivery address to Checkout </button>
                                 
                                </div>
                            </div>
                        </div>
                        
                    </form>


                    </div>
                  </div>
            
                  
                    
            
                </div>
              </div>
            </div>











        </div>
    </div>
</div>
@endsection
