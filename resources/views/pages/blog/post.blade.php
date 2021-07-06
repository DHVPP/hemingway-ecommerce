<div class="proizvod-div">
    <a href="/blog/post/{{$post->id}}"><img class="fotka-proizvoda" src="{{asset($post->image)}}"></a>
    <h1 class="naziv-proizvoda-mali-div">{{$post->title}}</h1>
    <div class="post-description">{{$post->description}}</div>
    <div class="blog-dugme">
        <a style="margin: 0 auto" href="/blog/post/{{$post->id}}" class="button-5 w-button add-cart">Detaljnije</a>
    </div>
</div>
