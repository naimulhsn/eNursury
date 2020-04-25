@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <img src="/images/male.jpg" class="img-fluid " alt="Responsive image"> --}} 
    <img src="/images/1.jpg" class="" style="width: 100%;
    height: 300px;
    object-fit: cover;" alt="cover img">
    <div class="row justify-content-center">
                


            <div class="col-md-12">
                    <div class="card">
    
                        <div class="card-body">
                            <div class="card-title mb-4">
                                <div class="d-flex justify-content-start">
                                    <div class="image-container">
                                        @if($user->gender==null)
                                        <img src="/images/male.jpg" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />
                                        @else
                                        <img src="/images/female.png" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />
                                        @endif
                                        <!--div class="middle">
                                            <input type="button" class="btn btn-secondary" id="btnChangePicture" value="Change" />
                                            <input type="file" style="display: none;" id="profilePicture" name="file" />
                                        </div-->
                                    </div>
                                    <div class="userData ml-3">
                                        <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold">{{$user->seller->name}}</h2>
                                        {{-- <h6 class="d-block"><a href="javascript:void(0)">{{count($ads)}}</a> Ad uploaded</h6> --}}
                                    </div>
                                    
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-12">
                                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">About This Nursery</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content ml-1" id="myTabContent">
                                        <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                                            
    
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label style="font-weight:bold;">Full Name</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <span class="myFont">{{$user->seller->name}}</span> 
                                                </div>
                                            </div>
                                            
                                            <hr />
                                            
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label style="font-weight:bold;">District</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <span class="myFont">{{$user->seller->district}} </span> 
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label style="font-weight:bold;">Location</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <span class="myFont">{{$user->seller->location}} </span> 
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label style="font-weight:bold;">About Us </label>
                                                </div>
                                                <div class="col-md-7">
                                                    <span class="myFont">{{$user->seller->about}} </span> 
                                                </div>
                                            </div>
                                            <hr />
                                           
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label style="font-weight:bold;">Email</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <span class="myFont">{{$user->email}} </span> 
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label style="font-weight:bold;">Phone</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <span class="myFont" id="phoneNumber">{{$user->seller->phone}} </span> 
                                                </div>
                                                @if($user->id!== Auth::user()->id )
                                                <div class="col-md-2">
                                                    <div class="mytooltip">
                                                        <button class="btn btn-outline-secondary" onclick="myFunctionCopy()" onmouseout="outFuncCopy()">Copy<span class="mytooltiptext" id="myTooltip">Copy to clipboard</span>
                                                        </button>
                                                    </div>
                                                    <script>
                                                        function myFunctionCopy() {
                                                            var copyText = document.getElementById("phoneNumber");
                                                            var textArea = document.createElement("textarea");
                                                            textArea.value = copyText.textContent;
                                                            document.body.appendChild(textArea);
                                                            textArea.select();
                                                            document.execCommand("Copy");
                                                            
                                                            var tooltip = document.getElementById("myTooltip");
                                                            tooltip.innerHTML = "Copied: " + textArea.value;
                                                            textArea.remove();
                                                        }
                                                        
                                                        function outFuncCopy() {
                                                            var tooltip = document.getElementById("myTooltip");
                                                            tooltip.innerHTML = "Copy to clipboard";
                                                        }
                                                    </script>
                                                </div>
                                                @endif
                                            </div>
                                            
    
                                        </div>
                                    </div>
                                </div>
                            </div>
    
    
                        </div>
    
                    </div>
                </div>

        <!--div class="card col-md-4">
            <div class="ard">
                
                @if($user->gender=="Male")
                    <img class="rounded-circle z-depth-2  d-block m-4" alt="" style="height:150px; object-fit:cover" src="https://cdn.onlinewebfonts.com/svg/img_542942.png" data-holder-rendered="true">
                @else
                    <img class="rounded-circle z-depth-2  d-block m-4" alt="" src="https://www.sefairebellesalon.com/assets/uploads/2017/04/blank-avatar.png" data-holder-rendered="true">
                @endif
                
                <span>Name : </span>
                <p class="myFont d-inline">{{$user->name}} </p>
                <span>Gender : </span>
                <p class="myFont">{{$user->gender}} </p>
                    
            </div>
        </div-->
        @php
            //$map= "https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3647.9136826615572!2d".$user->seller->longitude."!3d".$user->seller->latitude."!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1584649386568!5m2!1sen!2sbd"; 
            $map= "https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d184615.2587414252!2d".$user->seller->longitude."!3d".$user->seller->latitude."!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1584649386568!5m2!1sen!2sbd"; 
        @endphp
        <div class="col-md-12 mt-2">
            <iframe src={{$map}}
            width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
        <div class="col-md-12 mt-4">
            <div class="card mb-2">
                <h5 class="m-2">Plants to sell</h5>
            </div>
            <div class="row">
            @foreach($ads as $ad) 
                {{-- foreach adddddddddddddddddddddddddd --}}
                    <div class="col-md-4">
                        <a href="{{ route('ads.show', $ad->id) }}">

                            <div class="custom_card card mb-4">
                                <img src="{{ $ad->image }}" class="card-img-top pt-2 pl-2 pr-2" style="height:200px; object-fit:cover" alt="{{ $ad->name }}">

                                <div class="card-body">
                                    <p class="card-title" style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; font-weight:bold">{{ $ad->name }}</p>
                                    <span>
                                        <p class="d-inline ">Category : </p> 
                                        <strong class="d-inline " > {{$ad->category}}</strong>
                                    </span>
                                    <br>
                                    <span >
                                        <p class="d-inline "> Condition : </p> 
                                        <strong class="d-inline " @if($ad->condition=='New')style="color:tomato" @endif > {{$ad->condition}}</strong>
                                    </span>
                                    <br>
                                    <span>
                                        <p class="d-inline" style="color:seagreen">Price : </p> 
                                        <strong class="d-inline" style="color:seagreen"> {{ $ad->price }} TK</strong>
                                        
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
