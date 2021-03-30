<div class="w-commerce-commerceorderconfirmationcontainer" style="padding-top: 20vh">
    @if($data['idPaymentMethod'] == \App\Entities\Payments\PaymentMethod::POST_PAYMENT)
        <div class="w-form-done" style="display:block">
            <div>Hvala na izvršenoj narudžbini! Da bi ista bila potvrđena potrebno je da u roku od 2 dana izvršite
                uplatu prema instrukcijama sa slike.
            </div>
        </div>
        <img src="{{asset('/images/uplatnica.jpg')}}"
             style="width: 60%; display: block;margin-right: auto;margin-left: auto;"/>
    @else
        <div class="w-form-done" style="display:block">
            <div>Vaša narudžbina je uspešno kreirana! Uskoro ćete dobiti email potvrde porudžbine! Molimo vas da
                proverite i Spam folder Vašeg Email-a.
            </div>
        </div>
    @endif
    <div class="w-commerce-commercelayoutcontainer w-container">
        <div class="w-commerce-commercelayoutmain">
            <div class="w-commerce-commercecheckoutcustomerinfosummarywrapper">
                <div class="w-commerce-commercecheckoutsummaryblockheader">
                    <h4>Informacije kupca</h4>
                </div>
                <fieldset class="w-commerce-commercecheckoutblockcontent">
                    <div class="w-commerce-commercecheckoutrow">
                        <div class="w-commerce-commercecheckoutcolumn">
                            <div class="w-commerce-commercecheckoutsummaryitem">
                                <label class="w-commerce-commercecheckoutsummarylabel">Ime i prezime</label>
                                <div>{{$data['name']}}</div>
                            </div>

                        </div>
                        <div class="w-commerce-commercecheckoutcolumn">
                            <div class="w-commerce-commercecheckoutsummaryitem">
                                <label class="w-commerce-commercecheckoutsummarylabel">Email</label>
                                <div>{{$data['email']}}</div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="w-commerce-commercecheckoutpaymentsummarywrapper">
                <div class="w-commerce-commercecheckoutsummaryblockheader">
                    <h4>Informacije o plaćanju</h4>
                </div>
                <fieldset class="w-commerce-commercecheckoutblockcontent">
                    <div class="w-commerce-commercecheckoutrow">
                        <div class="w-commerce-commercecheckoutcolumn">
                            <div class="w-commerce-commercecheckoutsummaryitem"><label
                                    class="w-commerce-commercecheckoutsummarylabel">Način plaćanja</label>
                                <div class="w-commerce-commercecheckoutsummaryflexboxdiv">
                                    <div class="w-commerce-commercecheckoutsummarytextspacingondiv"></div>
                                    <div class="w-commerce-commercecheckoutsummarytextspacingondiv"></div>
                                </div>
                                <div class="w-commerce-commercecheckoutsummaryflexboxdiv">
                                    <div> {{$data['paymentMethod']}} </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-commerce-commercecheckoutcolumn">
                            <div class="w-commerce-commercecheckoutsummaryitem">
                                <label class="w-commerce-commercecheckoutsummarylabel">Adresa dostave</label>
                                <div>{{$data['address']}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="w-commerce-commercecheckoutrow">
                        <div class="w-commerce-commercecheckoutcolumn">
                            <div class="w-commerce-commercecheckoutsummaryitem"><label
                                    class="w-commerce-commercecheckoutsummarylabel">Ime i prezime na adresi</label>
                                <div class="w-commerce-commercecheckoutsummaryflexboxdiv">
                                    <div class="w-commerce-commercecheckoutsummarytextspacingondiv"></div>
                                    <div class="w-commerce-commercecheckoutsummarytextspacingondiv"></div>
                                </div>
                                <div class="w-commerce-commercecheckoutsummaryflexboxdiv">
                                    <div> {{$data['deliveryName']}} </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-commerce-commercecheckoutcolumn">
                            <div class="w-commerce-commercecheckoutsummaryitem">
                                <label class="w-commerce-commercecheckoutsummarylabel">Broj telefona na adresi</label>
                                <div>{{$data['deliveryPhone']}}</div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="w-commerce-commercecheckoutorderitemswrapper">
                <div class="w-commerce-commercecheckoutsummaryblockheader">
                    <h4>Napomena</h4>
                </div>
                <fieldset class="w-commerce-commercecheckoutblockcontent">
                    <div>{{$data['note']}}</div>
                </fieldset>
            </div>
            <div class="w-commerce-commercecheckoutorderitemswrapper">
                <div class="w-commerce-commercecheckoutsummaryblockheader">
                    <h4>Predmeti u porudžbini</h4>
                </div>
                <fieldset class="w-commerce-commercecheckoutblockcontent">
                    <div class="order-items">
                        @foreach($data['products'] as $cartProduct)
                            <div id="checkout-product-{{$cartProduct['id']}}" class="order-item" style="color: black">
                                <img src="{{asset($cartProduct['product']->mainImage)}}" width="80" alt="">
                                <div class="div-block-19">
                                    <div class="text-block-23">{{$cartProduct['product']->name}}</div>
                                    <div>Količina: {{$cartProduct['quantity']}} </div>
                                    @if(!empty($cartProduct['color']))
                                        <div>Boja: {{$cartProduct['color']}}</div>
                                    @endif
                                    @if (!empty($cartProduct['personalisation']))
                                        <div>Personalizacija: {{$cartProduct['personalisation']}}</div>
                                    @endif
                                </div>
                                <div>
                                    <p>{{$cartProduct['price']}} RSD </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="w-commerce-commercelayoutsidebar">
            <div class="w-commerce-commercecheckoutordersummarywrapper">
                <div class="w-commerce-commercecheckoutsummaryblockheader">
                    <h4>Cena porudžbine</h4>
                </div>
                <fieldset class="w-commerce-commercecheckoutblockcontent">
                    <script type="text/x-wf-template"
                            id="wf-template-5f083a9f233b5f765850315000000000006b">%3Cdiv%20class%3D%22w-commerce-commercecheckoutordersummaryextraitemslistitem%22%3E%3Cdiv%3E%3C%2Fdiv%3E%3Cdiv%3E%3C%2Fdiv%3E%3C%2Fdiv%3E</script>
                    <div class="w-commerce-commercecheckoutordersummaryextraitemslist"
                         data-wf-collection="database.commerceOrder.extraItems"
                         data-wf-template-id="wf-template-5f083a9f233b5f765850315000000000006b">
                        <div class="w-commerce-commercecheckoutordersummaryextraitemslistitem">
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                    <div class="w-commerce-commercecheckoutsummarylineitem">
                        <div>Proizvodi:</div>
                        <div class="w-commerce-commercecheckoutsummarytotal">{{$data['productSum']}} RSD</div>
                    </div>
                    <div class="w-commerce-commercecheckoutsummarylineitem">
                        <div>Dostava:</div>
                        <div class="w-commerce-commercecheckoutsummarytotal">{{$data['delivery']}} RSD</div>
                    </div>
                    <div class="w-commerce-commercecheckoutsummarylineitem">
                        <div>Ukupno:</div>
                        <div class="w-commerce-commercecheckoutsummarytotal">{{$data['sum']}} RSD</div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>
