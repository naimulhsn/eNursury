@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">{{ __('Sign up') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('ads.update',$ad->id) }}">
                        @csrf
                        @method('PATCH')
                        
                        {{-- Product name --}}
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Product name') }}</label>

                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $ad->name }}" required autocomplete="name" >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    
                        {{-- Priceeeeee --}}
                        <div class="form-group row">
                            <label for="price" class="col-md-3 col-form-label text-md-right">{{ __('Selling price') }}</label>

                            <div class="col-md-4">
                                <input id="price" type="number" min="20" max="1000000"  class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $ad->price }}" required autocomplete="price">

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- negotiation --}}
                            <div class="col-md-3">
                                <select class="form-control" name="negotiation" required>
                                        @if($ad->negotiation=="negotiable")
                                            <option value="negotiable">Negotiable</option>
                                            <option value="fixed">Fixed price</option>
                                        @else
                                            <option value="fixed">Fixed price</option>
                                            <option value="negotiable">Negotiable</option>
                                        @endif
                                </select>
                                @error('negotiation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- description    --}}
                        <div class="form-group row">
                            <label for="description" class="col-md-3 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-7">
                                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="6"  required autocomplete="description">{{ $ad->description }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- specification    --}}
                        <div class="form-group row">
                            <label for="specification" class="col-md-3 col-form-label text-md-right">{{ __('Products specification') }}</label>

                            <div class="col-md-7">
                                <textarea id="specification" name="specification" class="form-control @error('specification') is-invalid @enderror" rows="8" required autocomplete="specification">{{ $ad->specification }}</textarea>

                                @error('specification')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="form-group row mt-4 mb-2">
                            <div class="col-md-7 offset-md-3">
                                <button type="submit" class="btn btn-outline-danger btn-block">
                                    {{ __('Apply this Edit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
