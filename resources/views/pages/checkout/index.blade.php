@extends('layouts.app')
@section('content')
    <div class="section-5">
        <div class="form-block w-form">
            {{ Form::open(['url' => '/order', 'method' => 'POST', 'class' => 'form-2']) }}
                <div class="order-form-div-block">
                    <div class="left-order-info-div">
                        <div class="customer-info-div">
                            <div class="block-header">
                                <h4 class="heading-6">Informacije o kupcu</h4>
                                <div>* Obavezno polje</div>
                            </div>
                            <div class="block-content">
                                <label for="email">Email*</label>
                                <input type="email" class="text-field-3 w-input" maxlength="256" name="email"  id="email" required="">
                                <label for="name">Ime i prezime*</label>
                                <input type="text" class="text-field-3 w-input" maxlength="256" name="name" id="name" required="">
                                <label for="phoneNumber">Broj telefona*</label>
                                <input type="tel" class="text-field-3 w-input" maxlength="256" name="phoneNumber" id="phoneNumber" required=""></div>
                        </div>
                        <div class="customer-info-div">
                            <div class="block-header">
                                <h4 class="heading-6">Adresa Dostavljanja</h4>
                                <div>* Obavezno polje</div>
                            </div>
                            <div class="block-content">
                                <label for="address">Adresa*</label>
                                <input type="text" class="text-field-3 w-input" maxlength="256" name="address" id="address" required="">
                                <label for="country">Država*</label>
                                <input type="text" class="text-field-3 w-input" maxlength="256" name="country" id="country" required="">
                                <div class="row">
                                    <div class="collumn">
                                        <label for="city">Grad*</label>
                                        <input type="tel" class="text-field-3 w-input" maxlength="256" name="city" id="city" required="">
                                    </div>
                                    <div class="collumn">
                                        <label for="zipCode">Poštanski broj*</label>
                                        <input type="tel" class="text-field-3 w-input" maxlength="256" name="zipCode" id="zipCode" required="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="customer-info-div">
                            <div class="block-header">
                                <h4 class="heading-6">Poručeni proizvodi</h4>
                            </div>
                            <div class="block-content">
                                <div class="order-items">
                                    @if(!empty(\Illuminate\Support\Facades\Session::get('products')) && count(\Illuminate\Support\Facades\Session::get('products')) > 0)
                                        @each('partials.cart-product', \Illuminate\Support\Facades\Session::get('products'), 'cartProduct')
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="right-order-info-div">
                        <div class="customer-info-div">
                            <div class="block-header">
                                <h4 class="heading-6">Za uplatu</h4>
                            </div>
                            <div class="block-content">
                                <div class="line-item">
                                    <div>Međuzbir</div>
                                    <div id="middleSum">{{\Illuminate\Support\Facades\Session::get('cartSum')}} RSD</div>
                                </div>
                                <div class="line-item">
                                    <div>Poštarina</div>
                                    <div>0 RSD</div>
                                </div>
                                <div class="line-item last">
                                    <div>Ukupno</div>
                                    <div id="sum">{{\Illuminate\Support\Facades\Session::get('cartSum')}} RSD</div>
                                </div>
                            </div>
                            <!--<div class="block-content"><label class="w-commerce-commercecheckoutdiscountslabel">PROMO Kod</label>
                                <div class="div-block-20"><input type="text" maxlength="256" name="Promo-code" data-name="Promo-code" id="Promo-code" class="text-field-4 w-input"></div>
                            </div>-->
                        </div><button type="submit" class="button-6 w-button">Naruči pouzećem</button>
                    </div>
                </div>
            {{ Form::close() }}
            <div class="w-form-done">
                <div>Thank you! Your submission has been received!</div>
            </div>
            <div class="w-form-fail">
                <div>Oops! Something went wrong while submitting the form.</div>
            </div>
        </div>
    </div>
@endsection
