@extends('layouts.app')
@section('title', $post->title)
@section('content')
<div class="proizvod-template naslov">
    <h1 class="heading proizvod-head page" style="margin-bottom: 0 !important; width: 100%;text-align: left">{{$post->title}}</h1>
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
<div id="disqus_thread"></div>
<script>
    var disqus_config = function () {
    this.page.url = "https://hemingwayleather.com";  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = "{{'post' . $post->id}}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    (function() { // DON'T EDIT BELOW THIS LINE
        var d = document,
            s = d.createElement('script');
        s.src = 'https://hemingway.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
@endsection