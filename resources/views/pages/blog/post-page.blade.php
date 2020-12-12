@extends('layouts.app')
@section('title', $post->title)
@section('content')
    <div class="proizvod-template naslov">
        <h1 class="heading proizvod-head page"
            style="margin-bottom: 0 !important; width: 100%;text-align: left">{{$post->title}}</h1>
    </div>
    <!--<div class="proizvod-template" style="padding-top:0px; align-items: start !important;">
        <div class="proizvod-fotka-div">
            <div class="fotka-ikonice">
                <a id="link-image-open" data-lightbox="Product Image" href="{{asset($post->image)}}"><img
                        class="fotka" src="{{asset($post->image)}}"/></a>
                <div class="ikonice">

                </div>
            </div>
        </div>
        <div class="opis-proizvoda-div">
            <div style="margin-top:20px;z-index: 1" class="sharethis-inline-share-buttons"></div>
        </div>
    </div>-->
    <div class="opis-proizvoda" style="margin-top: 50px">
        <div>{!!$post->content!!}</div>
    </div>

@endsection
