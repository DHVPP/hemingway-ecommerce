@extends('layouts.app')
@section('title', $product->name)
@section('content')
    <div class="proizvod-template naslov">
        <h1 class="heading proizvod-head page"
            style="margin-bottom: 0 !important; width: 100%;text-align: left">{{$product->name}}</h1>
    </div>
    <div class="opis-proizvoda-div" style="width: 100%;padding-left: 15vw; padding-bottom: 10px">
        <div class="text-block-1 code-class" style="">
            <span class="text-block-1">{{'#' . $product->code}}</span>
        </div>
    </div>
    <div class="proizvod-template" style="padding-top:0px; align-items: start !important;">
        <div class="proizvod-fotka-div">
            @if($productColors->count() > 0)
                <div class="div-block-product">
                    <img class="male-fotke" src="{{asset($product->mainImage)}}"/>
                    @foreach($productColors as $productColor)
                        <img src="{{asset($productColor->imagePath)}}" class="male-fotke"/>
                    @endforeach
                </div>
            @endif
            <div class="fotka-ikonice">
                <a id="link-image-open" data-lightbox="Product Image" href="{{asset($product->mainImage)}}"><img
                        class="fotka" src="{{asset($product->mainImage)}}"/></a>
                <div class="ikonice">
                    @if ($labels->count() > 0)
                        @foreach($labels as $label)
                            <div><img src="{{asset($label->label->image)}}" title="{{$label->label->name}}"
                                      alt="{{$label->label->name}}" class="image-14"></div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="opis-proizvoda-div">
            @if($product->isOnSpecialOffer())
                <div class="text-block-price"><strike>{{$product->price . ' RSD' }}</strike></div>
                <div class="text-block-price" style="margin-top: 10px">{{$product->priceOnSpecialOffer . ' RSD' }}</div>
            @else
                <div class="text-block-price">{{$product->price . ' RSD' }}</div>
            @endif
            {{-- @if($productColors->count() > 0)
                    <div class="text-block-19">Izaberi boju</div>
                    <div class="boje-izbor">
                        @foreach($productColors as $productColor)
                            <div class="kruzici-boja" style="background-color:{{$productColor->color->hexCode}}"
                            data-value="{{$productColor->color->name}}"
                            data-image="{{asset($productColor->imagePath)}}">
                        </div>
                        @endforeach
                    </div>
                 @endif --}}

            {{ Form::open(['url' => '/add-cart/' . $product->id, 'method' => 'POST', 'id' => 'add-cart-form']) }}
            <input type="hidden" id="color" name="color" value="">
            <input type="hidden" id="idProduct" name="idProduct" value="{{$product->id}}">
            <label for="quantity" class="field-label-5" style="margin-top:15px">Količina</label>
            <input type="number" id="quantity" name="quantity" min="1" max="{{$product->quantityInStock}}"
                   style="margin-top:10px !important" class="div-block-17" value="1">
            @if(session()->has('errors_quantity'))
                <label id='personalisation-error' style="color: #ff0000;">{{session()->get('errors_quantity')}}</label>
            @endif
            @if(!empty($product->dimensions))
                <div class="text-block-19" style="margin:30px 0 20px 0">Dimenzije: <span class="text-block-18"
                                                                                         style="font-size: large">{{$product->dimensions}}</span>
                </div>
            @endif
            @if($product->quantityInStock <= 3 && $product->quantityInStock > 0)
                <div class="w-commerce-commerceaddtocartoutofstock">
                    <div>Only {{$product->quantityInStock}} left in stock!</div>
                </div>
            @endif

            @if ($product->isPersonalisationEnabled)
                <label for="quantity" class="field-label-5" style="margin-top:15px">Besplatna personalizacija</label>
                <input name="personalisation" class="text-field w-input" type="text"
                       placeholder="Inicijali/ime za utiskivanje" onkeyup="this.value = this.value.toUpperCase()">
                <label id='personalisation-error' style="color: red; display: none">Najviše 6 karaktera uključujući
                    slova i brojeve.</label>
            @endif
            @if($product->quantityInStock <= 0)
                <div class="w-commerce-commerceaddtocartoutofstock" style="text-align: center">
                    <div style="color:red"><strong>STOCK OUT</strong></div>
                </div>
            @else
                <input data-loading-text="Adding to cart..." value="Dodaj u korpu"
                       class="button-4 w-button"
                       style="background-color: #2d995b" {{ ($product->isPersonalisationEnabled) ? 'onclick=validatePersonalisation() type=button' : 'type=submit' }}>
            @endif
            {{ Form::close() }}
            <div style="margin-top:20px;z-index: 1" class="sharethis-inline-share-buttons"></div>
            @if (!empty(Auth::user()))
                <div class="text-block-19" style="margin-bottom: 20px">Admin Tools</div>
                <a class="button-5 w-button" href="/admin/products/update/{{$product->id}}" style="margin-bottom: 20px">
                    Edit Product
                </a>
                <a class="button-5 w-button" href="/admin/products/{{$product->id}}/labels" style="margin-bottom: 20px">
                    Edit Labels
                </a>
                {{ Form::open(['url' => '/admin/products/delete/' . $product->id, 'method' => 'DELETE']) }}
                <input type="submit" value="Delete product" class="button-5 w-button"
                       style="background-color:red;color:white;margin-bottom: 20px">
                {{ Form::close() }}
                <a class="button-5 w-button" href="/admin/products/color/{{$product->id}}" style="margin-bottom: 20px">
                    Add new Image
                </a>
                <a class="button-5 w-button" href="/admin/products/{{$product->id}}/images" style="margin-bottom: 20px">
                    Delete Image
                </a>

            @endif
        </div>
    </div>
    <div class="opis-proizvoda" style="margin-top: 50px">
        <h1 class="heading opis-proizvoda">Opis proizvoda</h1>
        <p class="paragraph-3">{!!$product->description!!}</p>
    </div>
    <div class="review">
        @if(isset($reviews) && $reviews->count() > 0)
            <h1 class="heading heading-review">Drugi o ovom proizvodu</h1>
            <div class="review-div">
                @foreach($reviews as $review)
                    <div class="review-text-div">
                        <div class="petar-petrovic">{{$review->name}}</div>
                        <p class="paragraph-4">{{$review->text}}</p>
                        <img src="{{asset('images/Asset-1.svg')}}" width="23" alt="" class="image-13">
                    </div>
                @endforeach
            </div>
        @endif
        {{ Form::open(['url' => '/review/' . $product->id, 'method' => 'POST', 'class' => 'review-form']) }}
        <h1 style="color: white">Ostavite Vaš komentar</h1>
        <div class="credentials-inputs-wrap">
            <div class="contact-name-field-wrap" style="width: 100%">
                <label for="name" class="contact-field-label" style="color:white">Ime</label>
                <input type="text" class="text-field cc-contact-field w-input" maxlength="256" name="name"
                       data-name="Name" placeholder="Unesite Vaše ime" id="Name">
            </div>
        </div>
        <label class="contact-field-label" style="color:white">Message</label>
        <textarea id="field" name="text" placeholder="Unesite Vaše mišljenje" maxlength="5000" data-name="Field"
                  class="text-field cc-textarea cc-contact-field w-input"></textarea>
        <input type="hidden" name="idProduct" value="{{$product->id}}"/>
        <input type="submit" value="Submit" data-wait="Please wait..." class="button w-button">
        {{ Form::close() }}
    </div>

    <div class="proizvodi">
        <h1 class="heading">Predloženi proizvodi</h1>
        <div class="proizvodi-div">
            @if($sameTypeProducts->count() > 0)
                @each('partials.product', $sameTypeProducts, 'product')
            @else
                <div class="w-dyn-empty">
                    <div>No items found.</div>
                </div>
            @endif
        </div>
    </div>
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2a6cd15e75630012258308&product=inline-share-buttons' async='async'></script>
    <script src="{{asset('js/lightbox.js')}}" type="text/javascript"></script>
@endsection
