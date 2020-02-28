@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
            
        {{-- Show ads here --}}
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Ads </div>

                <div class="card-body bg-light">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('bad_status'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('bad_status') }}
                        </div>
                    @endif

                    <div class="container">
                        <div class="row">
                            @foreach($ads as $ad) 
                            {{-- foreach adddddddddddddddddddddddddd --}}
                                <div class="col-md-6">
                                        <div class="custom_card card mb-4">
                                            <img src="{{ $ad->image }}"  class="card-img-top pt-2 pl-2 pr-2" style="max-height:150px; object-fit:contain" alt="{{ $ad->name }}">

                                            <div class="card-body">
                                                <p class="card-title d-inline " style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">{{ $ad->name }}</p>
                                                
                                                <span class="float-right">
                                                    <p class="d-inline " style="color:seagreen">Price : </p> 
                                                    <strong class="d-inline" style="color:seagreen"> {{ $ad->price }} TK</strong>
                                                </span>
                                                <br><br> 
                                                <a class="btn btn-outline-success btn-block" href="{{route('ads.show',$ad->id)}} " role="button">View This Ad</a>
                                                <a class="btn btn-outline-primary btn-block" href="{{route('ads.edit',$ad->id)}}" role="button">Edit This</a>
                                                <!--a class="btn btn-outline-danger btn-block" href="{{route('ads.destroy',$ad->id)}}" role="button">Delete This Ad </a-->
                                                <form method="POST" action="{{ route('ads.destroy',$ad->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-block mt-2">Delete This Ad Permanantly</button>
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
