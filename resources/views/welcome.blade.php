@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
            {{-- Left category options --}}
            <div class="col-md-2">
                    <div class="card">
                        <div class="card-header">Select Category</div>
        
                        <div class="card-body">
                            <div class="ul">
                                <div class="li">
                                    <a href="#">All</a>
                                </div>
                                <i class="fas fa-bone-break    "></i>
                                <div class="li">
                                    <a href="#">Mobile</a>
                                </div>
                                <div class="li">
                                    <a href="#">Computer</a>
                                </div>
                                <div class="li">
                                    <a href="#">Furniture</a>
                                </div>
                                <div class="li">
                                    <a href="#">Books</a>
                                </div>
                                
                            </div>
                            You are logged in!
                        </div>
                    </div>
                </div>



        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
        {{-- Right side --}}
        <div class="col-md-2">
            <div class="card ">
                <div class="card-header">    Order by: Recent </div>
            </div>
        </div>
    </div>
</div>
@endsection
