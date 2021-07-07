@extends('layouts.app')
@section('title', 'Korporativni pokloni')
@section('content')
    <div class="contact-section legal-notice">
        <h1 class="heading contact-heading">Korporativni pokloni</h1>
        <p class="paragraph-2 legal-paragraph">Nismo sigurni da li je to kvalitet, dugovečnost ili nešto treće, ali postoji nešto posebno u vezi sa kožnim
            proizvodima. Upravo ta posebnost čini ih savršenim poklonom, onim koji se uvek smatra ‘’ličnijim’’ i intimnijim
            od nekih drugih, a upravo to je razlog što sve više kompanija širom sveta bira upravo ovakve proizvode za
            korporativne poklone.</p>
        <p class="paragraph-2 legal-paragraph">U galeriji ispod su primeri, ali ne moramo se držati toga - uvek možemo otići korak dalje i napraviti praktično
            sve što smatrate savršenim poklonom, onim koji će Vašu kompaniju predstavljati na pravi način.
            Kontaktirajte nas i zajedno ćemo pronaći pravi poklon za datu priliku, sa logom Vaše kompanije na sebi i
            posebnim cenama za ovakav vid saradnje.
        </p>
        <div class="gallery">
            <a href="images/pokloni/podmetaci-za-case.jpg" data-lightbox="roadtrip"><img class="fotka" src="images/pokloni/podmetaci-za-case.jpg"/></a>
            <a href="images/pokloni/pokloni-za-muskarce.jpg" data-lightbox="roadtrip"><img class="fotka" src="images/pokloni/pokloni-za-muskarce.jpg"/></a>
            <a href="images/pokloni/leather-wallet.jpg" data-lightbox="roadtrip"><img class="fotka" src="images/pokloni/leather-wallet.jpg"/></a>
            <a href="images/pokloni/muski-poklon.jpg" data-lightbox="roadtrip"><img class="fotka" src="images/pokloni/muski-poklon.jpg"/></a>
            <a href="images/pokloni/leather-case.jpg" data-lightbox="roadtrip"><img class="fotka" src="images/pokloni/leather-case.jpg"/></a>
            <a href="images/pokloni/futrola-za-kartice.jpg" data-lightbox="roadtrip"><img class="fotka" src="images/pokloni/futrola-za-kartice.jpg"/></a>
            <a href="images/pokloni/elegantni-poklon.jpg" data-lightbox="roadtrip"><img class="fotka" src="images/pokloni/elegantni-poklon.jpg"/></a>
            <a href="images/pokloni/futrola-naocare-glavna.jpg" data-lightbox="roadtrip"><img class="fotka" src="images/pokloni/futrola-naocare-glavna.jpg"/></a>
            <a href="images/pokloni/business.jpg" data-lightbox="roadtrip"><img class="fotka" src="images/pokloni/business.jpg"/></a>
        </div>
    </div>
    <script src="{{asset('js/lightbox.js')}}" type="text/javascript"></script>
@endsection
