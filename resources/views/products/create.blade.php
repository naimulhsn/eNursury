@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">{{ __('Upload Product') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf


                        {{-- Category --}}
                        <div class="form-group row">
                            <label for="category" class="col-md-3 col-form-label text-md-right">{{ __('Product Category') }}</label>

                            <div class="col-md-7">
                                <select class="form-control" name="category" required>
                                    <option value="">Select :</option>
                                    {{-- @foreach ($categories as $cat)
                                        @if($cat->category!='Others')
                                            <option value="{{$cat->category}}">{{$cat->category}}</option>
                                        @endif
                                    @endforeach --}}
                                    <option value="Others">Others</option>
                                </select>
                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        {{-- Product name --}}
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Product name') }}</label>
                            <div class="col-md-7">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        
                        {{-- Priceeeeee --}}
                        <div class="form-group row">
                            <label for="price" class="col-md-3 col-form-label text-md-right">{{ __('Price') }}</label>
                            <div class="col-md-7">
                                <input id="price" type="number" min="5" max="100000" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                       
                        {{-- About this Product    --}}
                        <div class="form-group row">
                            <label for="about" class="col-md-3 col-form-label text-md-right">{{ __('About this Product') }}</label>

                            <div class="col-md-7">
                                <textarea id="about" name="about" class="form-control @error('about') is-invalid @enderror" rows="8" required autocomplete="about">{{ old('about') }}</textarea>

                                @error('about')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- Upload Image --}}
                        <div class="form-group row">
                            <label for="image" class="col-md-3 col-form-label text-md-right">Upload Image</label>
                            <div class="col-md-7">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="btn btn-outline-primary btn-file" id="imgUpload">
                                            Browse… <input type="file" name="image" id="imgInp">
                                        </span>
                                    </span>
                                    <input type="text" class="form-control" readonly aria-describedby="imgUpload" >
                                </div>
                                @error('specification')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <img class="mt-1" style="max-height:250px; object-fit:contain" id='img-upload'/>
                            </div>
                        </div>
                        
                        {{-- Upload button --}}
                        <div class="form-group row mt-4 mb-2">
                            <div class="col-md-7 offset-md-3">
                                <button type="submit" class="btn btn-outline-primary btn-block">
                                    {{ __('Upload Product') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    {{-- Error alart --}}
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
