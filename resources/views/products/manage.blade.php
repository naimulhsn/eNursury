@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
            
        {{-- Show ads here --}}
        
        <div class="col-md-10">
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
            <div class="card">
                <div class="card-header">All Products </div>

                <div class="card-body bg-light">
                    

                    <div class="container-fluid">
                        <div class="row">
                            @foreach($products as $product) 
                            @php
                                $productName = $product->name;
                                if(strlen($productName)>40){
                                    $productName = substr($productName,0,37) ."...";
                                }
                            @endphp
                            {{-- foreach adddddddddddddddddddddddddd --}}
                                <div class="col-md-3">
                                        <div class="custom_card card mb-4">
                                            <img src="{{ $product->image }}"  class="card-img-top pt-2 pl-2 pr-2" style="height:150px; object-fit:contain" alt="{{ $productName }}">

                                            <div class="card-body">
                                                <p class="card-title d-inline " style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">
                                                    {{ $productName }}</p>
                                                
                                                <div>
                                                    <p class="d-inline " style="color:seagreen">Price : </p> 
                                                    <strong class="d-inline" style="color:seagreen"> {{ $product->price }} TK</strong>
                                                </div>
                                                <br>
                                                <a class="btn btn-outline-success btn-block" href="{{route('products.show',$product->id)}} " role="button">Show Product</a>
                                                <a class="btn btn-outline-primary btn-block" href="{{route('products.edit',$product->id)}}" role="button">Edit info</a>                                              
                                                <form method="POST" action="{{ route('products.destroy',$product->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-block mt-2">Remove product</button>
                                                </form>

                                            </div>
                                        </div>
                                    
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
