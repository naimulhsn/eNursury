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
              $cnt = count($products);    
            @endphp

            <table class="table table-bordered bg-white shadow ">
              <thead>
                <tr>
                  <th scope="col">#Order id</th>
                  <th scope="col">Product</th>
                  <th scope="col">quantity</th>
                  <th scope="col">payment</th>
                  <th scope="col">Delivery Status</th>
                </tr>
              </thead>
              <tbody>
                
                  @foreach ($products as $p)
                      <tr>
                        <th scope="row">{{$p->order->id}}</th>
                        <td>
                          <div class="">
                            <img src="{{$p->product->image}}" alt="" width="50" class="img-fluid rounded shadow-sm">
                            <div class="d-inline-block align-middle">
                            <h5 class="mb-0"> <a href="{{route('products.show',$p->product_id) }}" 
                                class="text-dark d-inline-block align-middle">{{$p->product->name}}</a>
                            </h5>
                            <span class="text-muted font-weight-normal font-italic d-block">Category: {{$p->product->category}}</span>
                            </div>
                          </div>
                        </td>
                        <td class="text-center">{{$p->quantity}}</td>
                        <td>{{$p->order->payment_method." (".$p->order->payment_status .")"}}</td>
                        <td class="text-center">
                          <div class="btn-group ">
                            <button type="button " class="btn 
                            @if($p->delivery_status=='Waiting for payment') btn-secondary
                            @elseif($p->delivery_status=='Delivery in process') btn-danger
                            @elseif($p->delivery_status=='Delivered')btn-warning
                            @else btn-success @endif dropdown-toggle" data-toggle="dropdown" 
                              aria-haspopup="true" aria-expanded="false">
                              {{$p->delivery_status}}
                            </button>
                            <div class="dropdown-menu">
                              @if ($p->delivery_status!="Waiting for payment") 
                                <a href="{{route('delivstat',[$p->id,'Waiting for payment'])}}" class="dropdown-item" > Waiting for payment</a>
                              @endif 
                              @if($p->delivery_status!="Delivery in process")
                                <a href="{{route('delivstat',[$p->id,'Delivery in process'])}}" class="dropdown-item" > Delivery in process</a>
                              @endif 
                              @if($p->delivery_status!="Delivered")
                                <a class="dropdown-item" href="{{route('delivstat',[$p->id,'Delivered'])}}">Delivered</a>
                              @endif 
                              @if($p->delivery_status!="Delivery Completed")
                                <a class="dropdown-item" href="{{route('delivstat',[$p->id,'Delivery Completed'])}}">Delivery Completed</a>
                              @endif 
                              <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-success" href="{{route('user_profile',$p->user->id)}}">
                                  {{"Ordered by: ".$p->user->name }}
                                </a>
                               
                            </div>
                          </div>
                        </td>
                      </tr>
                  @endforeach
                  
              </tbody>
            </table>
          







        </div>
    </div>
</div>
@endsection
