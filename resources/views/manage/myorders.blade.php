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
              $cntOrder = count($orders);    
            @endphp

            <div class="row">
              @foreach($orders as $order) 
                @php
                    
                @endphp
              {{-- foreach adddddddddddddddddddddddddd --}}
                  <div class="col-md-12">
                      <a href="#order{{$order->id}}" data-toggle="collapse">
                          <div class="card mb-4" >
                            <div class="card-header text-muted">#Order no {{$cntOrder-$loop->index}}
                              <span class="float-right mr-2 ">Ordering Date : {{$order->order_date}}</span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                  <div class="col-md-4"><strong>Number of Products : 
                                    <span style="color:seagreen"> {{$order->total_count}} </span> </strong></div>
                                  <div class="col-md-4"><strong>Total Cost : 
                                    <span style="color:seagreen"> {{$order->total_price}} Taka </span></strong> </div>
                                  <div class="col-md-3"><strong>Payment : {{$order->payment_method}}</strong></div>
                                  <div class="col-md-1 text-muted">{{$order->payment_status}}</div>
                                </div>
                            </div>
                          
                      </a>
                      <!-- order cart table -->
                      <div id="order{{$order->id}}" class="collapse @if($loop->index==0)show @endif">
                        <hr>
                        <div class="row m-2">
                          
                          <div class="col-md-6 text-muted"><small>Delivery address : {{$order->delivery_address}}</small></div>
                          <div class="col-md-6 text-muted"><small>Instruction for sellers: {{$order->instruction}}</small></div>
                        </div>
                        <hr>
                        <div class="row ml-5 mr-1 mt-1">
                          <div class="col-lg-12 bg-white rounded shadow-sm mb-2">
              
                            <div class="table-responsive">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col" class="border-0 ">
                                      <div class="p-2 px-3 text-uppercase">Product</div>
                                    </th>
                                    <th scope="col" class="border-0 ">
                                      <div class="py-2 text-uppercase">Price</div>
                                    </th>
                                    <th scope="col" class="border-0 ">
                                      <div class="py-2 text-uppercase">Quantity</div>
                                    </th>
                                    <th scope="col" class="border-0 ">
                                      <div class="py-2 text-uppercase">Sub Total</div>
                                    </th>
                                    <th scope="col" class="border-0 ">
                                      <div class="py-2 text-uppercase">Status</div>
                                    </th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products[$order->id] as $item)
                                      <tr> 
                                      @php
                                          $product = $item->product;
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
                                          <td class="@if($loop->first) border-0 @endif align-middle text-muted"><strong> {{$product->price}} TK </strong></td>
                                          <td class="@if($loop->first) border-0 @endif align-middle text-muted"><strong> {{$item->quantity}} </strong></td>
                                          <td class="@if($loop->first) border-0 @endif align-middle text-muted"><strong> {{$product->price * $item->quantity}} TK </strong></td>
                                          <td class="@if($loop->first) border-0 @endif align-middle text-muted"><strong> {{$item->delivery_status}} </strong></td>
                                      </tr>
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              @endforeach
            </div>
          







        </div>
    </div>
</div>
@endsection
