@extends('layouts.app')
@section('title', $post->title)
@section('content')
<div class="proizvod-template naslov">
    <h1 class="heading proizvod-head page" style="margin-bottom: 0 !important; width: 100%;text-align: left">{{$post->title}}</h1>
</div>
<div class="opis-proizvoda" style="margin-top: 50px; min-height: 400px; margin-bottom: 50px">
    <div>{!!$post->content!!}</div>
</div>
<div id="disqus_thread"></div>
<script>
    var disqus_config = function () {
    this.page.url = "https://hemingwayleather.com";  
    this.page.identifier = "{{'post' . $post->id}}"; 
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