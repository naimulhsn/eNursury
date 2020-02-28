@extends('layouts.app')
@section('content')
    
<div class="container-fluid">
    <div class="row justify-content-center">
        
        <div class="col-md-6">
            <div class="card h-100">
                <img src="{{ $ad->image }}" class="card-img-top p-2" style="height:455px; object-fit:contain" alt="{{ $ad->name }}">
            </div>
        </div>
        <div class="col-md-6 ">

            {{-- ad uploader Info --}}
            <div class="col-md-12">
                <div class="card  mt-4">
                    <div class="card-header">Seller </div>
    
                    <div class="card-body ">
                        <div class="container-fluid">
                            <p class="card-title" style="color:black; font-weight:bold; font-size:1.5em">{{ $user->name }}</p>
                            <a href={{route('user_profile',$user->id)}}>
                                <button type="button" class=" btn btn-success ">Seller Profile</button>
                            </a>
                        </div>
                    </div>
                </div>   
            </div>
            
            
        </div>
       

        {{-- ad  description and specification --}}
        
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-header">Description </div>
                <div class="card-body ">
                    <div class="container">
                        <p style="text-align:justify; text-justify:inter-word;">{{$ad->description}} </p>
                    </div>
                </div>
            </div>
        </div>
       
        {{-- Right side --}}
        
    </div>

    <a href={{route('user_profile',$user->id)}}>
        <button type="button" class="mt-4 mb-4 btn btn-success btn-lg btn-block">Contact seller</button>
    </a>
</div>
@endsection