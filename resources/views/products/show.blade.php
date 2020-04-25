@extends('layouts.app')
@section('content')
    
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
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
            <div class="">
                <div class="card mr-3">
                    <div class="row">

                    
                        <div class="col-md-5">
                            <img src="{{ $product->image }}" class="card-img-top p-2" style="height:455px; object-fit:contain" alt="{{ $product->name }}">
                        </div>
                        <div class="col-md-5 ">

                            {{-- Product basic Info --}}

                            {{-- wishlist --}}
                            <p class="float-right m-2">
                                @if ($wished == "0")
                                    <i class="fa fa-heart-o" style="color:red; font-size:15px;"></i>
                                @else 
                                <i class="fa fa-heart" style="color:red; font-size:15px;"></i>
                                @endif
                                <small>({{$wishcount}})</small>
                            </p>
                            {{-- product details --}}
                            <div class="container-fluid mt-4" style="height:455px">
                                
                                <h2 class="card-title" style="color:black; font-weight:bold; font-size:1.4em;">
                                    {{ $product->name }}</h2>
                                <span class="text-secondary"><small>Category : {{$product->category}}</small></span>
                                <br><br><br><br>
                                <p class="d-inline " style="color:seagreen">Price : </p> 
                                <strong class="d-inline" style="color:seagreen"> {{ $product->price }} TK</strong>
                                 <br><br>
                                 <h5>
                                     <span class="badge badge-pill badge-info text-white">
                                        {{ $product->available  < 1 ? 'No Item is Available' : $product->available.' item in stock' }}
                                    </span>
                                </h5>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        Quantity 
                                    </div>
                                    <div class="col-md-4">
                                        <form method="POST" action="{{ route('addtocart') }}" id="quantityform">
                                            @csrf
                                            <input type="hidden" id="product_id" name="product_id" value="{{$product->id}}">
                                            

                                        
                                            <div class="input-group mb-3" style="max-width: 120px;">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-outline-secondary js-btn-minus" type="button">
                                                    <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                                <input name="quantity" type="number" readonly class="form-control text-center quantity" value="1" min="1" max="100">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary js-btn-plus" type="button">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        
                                            <div class="col-md-5"> </div>
                                        </form>
                                    </div>
                                </div>
                                {{-- Adding to wishlist --}}
                                <a href="{{route('addtowishlist',$product->id)}}" role="button" class="btn btn-success @if ($wished != "0")disabled @endif"
                                    @if($wished != "0") aria-disabled="true" @endif >
                                    <i class="fa fa-heart" style="@if($wished != "0")color:red; @endif font-size:20px;"></i>
                                    @if($wished != "0") Already in Wishlist @else  Add to WishList @endif
                                </a>


                                <button type="button" class="btn btn-danger" onclick="getElementById('quantityform').submit()"
                                @if($incart!="0" || $product->user_id==Auth::user()->id) disabled @endif>
                                    <i class="fa fa-cart-plus" style="color:yellow;font-size:20px;"></i> 
                                    @if($incart != "0") Already in your Cart @else Add To Cart @endif
                                </button>

                                
                                
                                
                                
                            </div>
                            
                        </div>

                        {{-- Seller Info --}}
                        <div class="col-md-2 bg-light">
                            <div class=" mt-4 ml-2 mr-2 ">
                                <p class="text-secondary d-inline">Seller Nursery Info</p>
                                <hr>
                                <p class="d-inline" style="color:seagreen; font-size:1.3em">{{ $seller->name }}</p>
                                <br>
                                <span class="d-inline">
                                    <small>Rating: </small>
                                    <span class="fa fa-star text-primary"></span>
                                    <span class="fa fa-star text-primary"></span>
                                    <span class="fa fa-star text-primary"></span>
                                    <span class="fa fa-star text-primary"></span>
                                    <span class="fa fa-star"></span>
                                    <small class="text-secondary">(75)</small>
                                </span>
                                <br>
                                <span class="d-inline">
                                    <small>District: {{$seller->seller->district}}</small> 
                                </span>
                                <br>
                                <span class="d-inline">
                                    <small>Location: {{$seller->seller->location}}</small> 
                                </span>
                                <br>
                                <span class="d-inline">
                                    <small>Total Products: 534</small> 
                                </span>
                                <br>
                                <a  href={{route('user_profile',$seller->id)}}>
                                    <button type="button" style="vertical-align:bottom" 
                                    class="mt-4 mb-4 btn btn-outline-success btn-sm btn-block">Seller Profile</button>
                                </a>
                                
                            </div>
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- ad  description and specification --}}
        
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-header">About This Product </div>
                <div class="card-body ">
                    <div class="container">
                        <p style="text-align:justify; text-justify:inter-word;">{{$product->about}} </p>
                    </div>
                </div>
            </div>
        </div>
       
        {{-- Right side --}}
        
    </div>

    <a href={{route('user_profile',$seller->id)}}>
        <button type="button" class="mt-4 mb-4 btn btn-success btn-lg btn-block">Contact seller</button>
    </a>
</div>
@endsection