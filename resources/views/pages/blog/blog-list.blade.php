@extends('layouts.app')
@section('title', 'Blog')
@section('content')
    <div class="proizvodi special-section" style="padding-top:10px;min-height: 600px">
        @if($chunks->count() > 0)
            @foreach($chunks as $chunk)
                <div class="proizvodi-div">
                    @each('pages.blog.post', $chunk, 'post')
                </div>
            @endforeach
        @else
            <div class="w-dyn-empty">
                <div>No items found.</div>
            </div>
        @endif
        @if($count > 1)
            <div class="pagination">
                @for($i=1; $i <= $count; $i++)
                    <a href="/blog?page={{$i}}">{{$i}}</a>
                @endfor
            </div>
        @endif
    </div>

@endsection
