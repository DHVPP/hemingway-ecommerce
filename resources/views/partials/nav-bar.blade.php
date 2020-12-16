@if(\App\Config::isSetAnnouncement())
<div class="nav announcement" style="background-color: #ddd !important;height: auto; color: black; text-align: center">
    <p style="width: 100%; text-align: center; margin: 0 auto;"><strong>{{\App\Config::getAnnouncement()}}</strong>
    </p>
</div>
@endif
<div data-w-id="5f4f9947-30e8-ea30-25f1-fb4b88672c5a" class="nav menu">
    <a href="/" aria-current="page" class="home-link w-inline-block w--current">
        <img src="{{asset("images/Hemingway.svg")}}" width="64.5" alt="" class="image">
    </a>
    <div class="bottom-nav">
        <div class="nav-containe">
            <div style="display: none" data-hover="" data-delay="0" class="dropdown w-dropdown">
                <div class="dropdown-toggle w-dropdown-toggle">
                    <div class="text-block">Sr</div>
                    <div class="icon w-icon-dropdown-toggle"></div>
                </div>
                <nav class="w-dropdown-list"><a href="#" class="w-dropdown-link">Link 1</a><a href="#" class="w-dropdown-link">Link
                        2</a><a href="#" class="w-dropdown-link">Link 3</a></nav>
            </div>
            <div data-node-type="commerce-cart-wrapper" data-open-product="" data-wf-cart-type="rightSidebar" data-wf-cart-query="" data-wf-page-link-href-prefix="" class="w-commerce-commercecartwrapper cart">
                <a href="#" data-node-type="commerce-cart-open-link" class="w-commerce-commercecartopenlink cart-button w-inline-block">
                    <svg class="w-commerce-commercecartopenlinkicon" width="17px" height="17px" viewbox="0 0 17 17">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <path d="M2.60592789,2 L0,2 L0,0 L4.39407211,0 L4.84288393,4 L16,4 L16,9.93844589 L3.76940945,12.3694378 L2.60592789,2 Z M15.5,17 C14.6715729,17 14,16.3284271 14,15.5 C14,14.6715729 14.6715729,14 15.5,14 C16.3284271,14 17,14.6715729 17,15.5 C17,16.3284271 16.3284271,17 15.5,17 Z M5.5,17 C4.67157288,17 4,16.3284271 4,15.5 C4,14.6715729 4.67157288,14 5.5,14 C6.32842712,14 7,14.6715729 7,15.5 C7,16.3284271 6.32842712,17 5.5,17 Z" fill="currentColor" fill-rule="nonzero">
                            </path>
                        </g>
                    </svg>
                    <div class="text-block-16 w-inline-block">Cart</div>
                    <div class="w-commerce-commercecartopenlinkcount cart-quantity">
                        @if(!empty(\Illuminate\Support\Facades\Session::get('products')))
                        {{count(\Illuminate\Support\Facades\Session::get('products'))}}
                        @else
                        {{0}}
                        @endif
                    </div>
                </a>
                <div data-node-type="commerce-cart-container-wrapper" style="display:none" class="w-commerce-commercecartcontainerwrapper w-commerce-commercecartcontainerwrapper--cartType-rightSidebar cart-wrapper">
                    <div data-node-type="commerce-cart-container" class="w-commerce-commercecartcontainer cart-container">
                        <div class="w-commerce-commercecartheader cart-header"><img src="{{asset("images/Logo_H.svg")}}" width="150" alt="" class="image-12">
                            <h4 class="w-commerce-commercecartheading heading-3">Vaša Korpa</h4><a href="#" data-node-type="commerce-cart-close-link" class="w-commerce-commercecartcloselink close-button w-inline-block">
                                <svg width="16px" height="16px" viewbox="0 0 16 16">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g fill-rule="nonzero" fill="#333333">
                                            <polygon points="6.23223305 8 0.616116524 13.6161165 2.38388348 15.3838835 8 9.76776695 13.6161165 15.3838835 15.3838835 13.6161165 9.76776695 8 15.3838835 2.38388348 13.6161165 0.616116524 8 6.23223305 2.38388348 0.616116524 0.616116524 2.38388348 6.23223305 8"></polygon>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                        </div>
                        <div class="w-commerce-commercecartformwrapper cart-form-wrapper">
                            <form data-node-type="commerce-cart-form" class="block-content">
                                <script type="text/x-wf-template" id="wf-template-71136eaa-6d80-8362-d58b-0c82ac714b1e"></script>
                                <div class="order-items">
                                    @if(!empty(\Illuminate\Support\Facades\Session::get('products')) && count(\Illuminate\Support\Facades\Session::get('products')) > 0)
                                    @foreach(\Illuminate\Support\Facades\Session::get('products') as $cartProduct)
                                    <div id="cart-product-{{$cartProduct['id']}}" class="order-item" style="color: black">
                                        <img src="{{asset($cartProduct['product']->mainImage)}}" width="80" alt="">
                                        <div class="div-block-19">
                                            <div class="text-block-23">{{$cartProduct['product']->name}}</div>
                                            <div>Količina: {{$cartProduct['quantity']}} </div>
                                            @if(isset($cartProduct['color']))
                                            <div>Boja: {{$cartProduct['color']}}</div>
                                            @endif
                                        </div>
                                        <div style="min-width: 75px">
                                            <p>{{$cartProduct['price']}} RSD </p>
                                            <a href="#" class="remove-cart-product">Obriši</a>
                                        </div>
                                    </div>

                                    @endforeach
                                    @endif
                                </div>
                                @if(!empty(\Illuminate\Support\Facades\Session::get('cartSum')))
                                <div class="w-commerce-commercecartfooter">
                                    <div class="w-commerce-commercecartlineitem">
                                        <div class="text-block-12">Ukupno</div>
                                        <div class="w-commerce-commercecartordervalue text-block-13" id="totalAmount">{{\Illuminate\Support\Facades\Session::get('cartSum')}}
                                            RSD
                                        </div>
                                    </div>
                                    <div><a href="/checkout" value="Završi kupovinu" data-node-type="cart-checkout-button" class="w-commerce-commercecartcheckoutbutton" data-loading-text="Hang Tight...">Završi kupovinu</a></div>
                                </div>
                                @endif
                            </form>
                            <div class="w-commerce-commercecartemptystate">
                                <div>No items found.</div>
                            </div>
                            <div style="display:none" data-node-type="commerce-cart-error" class="w-commerce-commercecarterrorstate">
                                <div class="w-cart-error-msg" data-w-cart-quantity-error="Product is not available in this quantity." data-w-cart-checkout-error="Checkout is disabled on this site." data-w-cart-general-error="Something went wrong when adding this item to the cart." data-w-cart-cart_order_min-error="The order minimum was not met. Add more items to your cart to continue.">
                                    Product is not available in this quantity.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="/search" class="search w-form"><input type="search" class="search-input w-input" maxlength="256" name="name" placeholder="" id="search" required=""><input type="submit" value="Search" class="search-button w-button">
            </form>
        </div>
        <div class="nav-containe">
            <div data-hover="" data-delay="0" class="dropdown w-dropdown">
                <div class="dropdown-toggle w-dropdown-toggle">
                    <div class="text-block">Koža</div>
                    <div class="icon w-icon-dropdown-toggle"></div>
                </div>
                <nav class="dropdown-list w-dropdown-list">
                    <a href="/products/types?type=1" class="dropdown-link-2 w-dropdown-link">
                        Novčanici
                    </a>
                    <a href="/products/types?type=2" class="dropdown-link w-dropdown-link">
                        Torbe
                    </a>
                    <a href="/products/types?type=3" class="dropdown-link w-dropdown-link">
                        Wellness
                    </a>
                    <a href="/products/types?type=4" class="dropdown-link w-dropdown-link">
                        Office
                    </a>
                    <a href="/products/types?type=5" class="dropdown-link-3 w-dropdown-link">
                        Moto Oprema
                    </a>
                    <a href="/products/types?type=6" class="dropdown-link-3 w-dropdown-link">
                        Sve ostalo
                    </a>
                </nav>
            </div>
            <a href="/products/types?type=7" class="link-block w-inline-block">
                <div class="text-block">Kravate &amp; Aksesoari</div>
            </a>
            <a href="/products/types?type=8" class="link-block w-inline-block">
                <div class="text-block">Muška Pećina</div>
            </a>
            <a href="/products/special-offer" class="link-block w-inline-block">
                <div class="text-block black-friday">Novogodišnja kolekcija</div>
            </a>
        </div>
    </div>
</div>