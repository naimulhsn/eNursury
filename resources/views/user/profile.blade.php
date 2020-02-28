@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

            <div class="col-md-6">
                    <div class="card">
    
                        <div class="card-body">
                            <div class="card-title mb-4">
                                <div class="d-flex justify-content-start">
                                    <div class="image-container">
                                        @if($user->gender=='Male')
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
                                        <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold">{{$user->name}}</h2>
                                        <h6 class="d-block"><a href="javascript:void(0)">{{count($ads)}}</a> Ad uploaded</h6>
                                    </div>
                                    
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-12">
                                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Basic Information</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content ml-1" id="myTabContent">
                                        <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                                            
    
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label style="font-weight:bold;">Full Name</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <span class="myFont">{{$user->name}}</span> 
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label style="font-weight:bold;">Department</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <span class="myFont">{{$user->dept}}</span> 
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label style="font-weight:bold;">Session</label>
                                                </div>
                                                <div class="col-md-7">
                                                    <span class="myFont">{{$user->session}} </span> 
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label style="font-weight:bold;">E-mail</label>
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
                                                    <span class="myFont" id="phoneNumber">{{$user->phone}} </span> 
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
                                            <hr />
                                            @if($user->id!== Auth::user()->id && count($ads)>0)
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="alert alert-success" role="alert">
                                                        <strong>Contact the Seller through Phone.</strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr />
                                            @endif
                                            
    
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
        <div class="col-md-6">
            <div class="card mb-2">
                <h5 class="m-2">Uploaded Ads</h5>
            </div>
            <div class="row">
            @foreach($ads as $ad) 
                {{-- foreach adddddddddddddddddddddddddd --}}
                    <div class="col-md-6">
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
