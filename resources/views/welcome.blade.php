@extends('layouts.app')
@section('title', 'Leather')
@section('content')
<div class="hero-section"><img src="images/Asset-3.svg" alt="" class="image-3">
    <div class="div-central-home">
        <div class="div-block-2">
            <div class="div-block-3">
                <p class="paragraph"><i>''Being a true Gentleman never goes out of fashion.''</i></p>
            </div>
            <div class="social-div">
                <a href="https://www.facebook.com/hemingway.leather" target="_blank" class="w-inline-block">
                    <img src={{asset("images/face.svg")}} alt="" class="image-5">
                </a>
                <a href="https://twitter.com/Hemingway_GS" target="_blank" class="w-inline-block">
                    <img src="{{asset("images/twitter.svg")}}" alt="" class="image-5">
                </a>
                <a href="https://www.instagram.com/hemingway_leather" target="_blank" h class="w-inline-block">
                    <img src="{{asset("images/instagram.svg")}}" alt="" class="image-5">
                </a>
            </div>
        </div>
        <!-- <a href="/products/special-offer"><img src="{{asset("images/nova-godina.png")}}" class="black-friday-image" /></a> -->
        <div class="div-block-4"><a href="#Proizvodi" class="link-block-2 w-inline-block"><img src="{{asset("images/button-down.svg")}}" alt="" class="image-6"></a></div>
    </div>
</div>
<div class="tri-bloka">
    <div class="blokovi-sekcija-tri-bloka about-us"><a href="#" class="link-4">O nama</a><a href="/about-us" class="link-tri-bloka w-inline-block"></a></div>
    <div class="blokovi-sekcija-tri-bloka corporate-gifts"><a href="#" class="link-4">Korporativni<br /> pokloni</a><a href="/pokloni" class="link-tri-bloka w-inline-block"></a></div>
    <div class="blokovi-sekcija-tri-bloka contact"><a href="#" class="link-4">Kontakt</a><a href="/contact" class="link-tri-bloka w-inline-block"></a></div>
</div>
<div class="proizvodi special-section">
    <h1 class="heading">Specijalna ponuda</h1>
    <div class="proizvodi-div">
        @if($specialOfferProducts->count() > 0)
        @each('partials.product', $specialOfferProducts, 'product')
        @else
        <div class="w-dyn-empty">
            <div>No items found.</div>
        </div>
        @endif
    </div>
</div>
<div class="ostali-proizvodi">
    <a href="/products/special-offer" class="link-block-4 w-inline-block">
        <div class="text-block-8 white">Pogledaj ostale proizvode</div>
        <div class="div-block-9"><img src="images/Asset-15.svg" alt="" class="image-9 white"></div>
    </a>
</div>
<div id="Proizvodi" class="proizvodi">
    <h1 class="heading">Bestsellers</h1>
    <div class="proizvodi-div">
        @if($topProducts->count() > 0)
        @each('partials.product', $topProducts, 'product')
        @else
        <div class="w-dyn-empty">
            <div>No items found.</div>
        </div>
        @endif
    </div>
</div>
@endsection
