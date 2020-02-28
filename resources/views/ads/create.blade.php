@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">{{ __('Sign up') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('ads.store') }}" enctype="multipart/form-data">
                        @csrf
                        
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
                        {{-- Category --}}
                        <div class="form-group row">
                            <label for="category" class="col-md-3 col-form-label text-md-right">{{ __('Product Category') }}</label>

                            <div class="col-md-7">
                                <select class="form-control" name="category" required>
                                    <option value="">Select :</option>
                                    @foreach ($categories as $cat)
                                        @if($cat->category!='Others')
                                            <option value="{{$cat->category}}">{{$cat->category}}</option>
                                        @endif
                                    @endforeach
                                    <option value="Others">Others</option>
                                </select>
                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Condition --}}
                        <div class="form-group row">
                            <label for="condition" class="col-md-3 col-form-label text-md-right">{{ __('Condition') }}</label>

                            <div class="col-md-7 mt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name='condition' id="conditionNew" value="New">
                                    <label class="form-check-label" for="conditionNew">New</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name='condition' id="conditionUsed" value="Used">
                                    <label class="form-check-label" for="conditionUsed">Used</label>
                                </div>
                            </div>
                        </div>
                        {{-- Used time --}}
                        <div class="form-group row">
                            <label for="used_time" class="col-md-3 col-form-label text-md-right">{{ __('Used this Product') }}</label>
                            {{-- days --}}
                            <div class="input-group col-md-2 pr-1">
                                <input type="number" name="used_time_days" min="0" max="30" class="form-control" placeholder="0"  >
                                <div class="input-group-append">
                                    <span class="input-group-text" id="used_time_days">days</span>
                                </div>
                            </div>
                            {{-- months --}}
                            <div class="input-group col-md-3 ">
                                <input type="number" name="used_time_months" min="0" max="11" class="form-control" placeholder="0"  >
                                <div class="input-group-append" >
                                    <span class="input-group-text" id="used_time_months">months</span>
                                </div>
                            </div>
                            {{-- years --}}
                            <div class="input-group col-md-2 pl-1">
                                <input type="number" name="used_time_years" min="0" max="10" class="form-control" placeholder="0"  >
                                <div class="input-group-append">
                                    <span class="input-group-text" id="used_time_years">year</span>
                                </div>
                            </div>

                        </div>
                        {{-- Priceeeeee --}}
                        <div class="form-group row">
                            <label for="price" class="col-md-3 col-form-label text-md-right">{{ __('Selling price') }}</label>

                            <div class="col-md-4">
                                <input id="price" type="number" min="20" max="1000000"  class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price">

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- negotiation --}}
                            <div class="col-md-3">
                                <select class="form-control" name="negotiation" required>
                                        <option value="negotiable">Negotiable</option>
                                        <option value="fixed">Fixed price</option>
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
                                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="6"  required autocomplete="description">{{ old('description') }}</textarea>

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
                                <textarea id="specification" name="specification" class="form-control @error('specification') is-invalid @enderror" rows="8" required autocomplete="specification">{{ old('specification') }}</textarea>

                                @error('specification')
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
