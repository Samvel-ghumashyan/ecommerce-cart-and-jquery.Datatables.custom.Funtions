@extends('layouts.layout')

@section('title', 'Markedia - Marketing Blog Template :: ' . $post->title)

@section('content')

    <div class="container py-3">
        <div class="row">

            <div class="col-md-8 order-md-1">
                <ul class="thumbnails list-unstyled clearfix">
                    <li class="thumb-main text-center"><img src="{{ $post->getImage() }}" style="width: 400px;" alt=""></a></li>
                </ul>
                {!! $post->content !!}
            </div>

            <div class="col-md-4 order-md-2">
                <ol class="breadcrumb hidden-xs-down">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{ route('categories.single', ['slug' => $post->category->slug]) }}">{{ $post->category->title }}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $post->title }}</li>
                </ol>
                <span class="color-yellow"><a href="{{ route('categories.single', ['slug' => $post->category->slug]) }}"
                                              title="">{{ $post->category->title }}</a></span>
                <h3>{{ $post->title }}</h3>
                <ul class="list-unstyled">
                    <li><i class="fas fa-check text-success"></i> В наличии</li>
                    <li><i class="fas fa-shipping-fast text-muted"></i> Ожидается</li>
                    <li><i class="fas fa-hand-holding-usd"></i> <span class="product-price">
                                                    <small>$12</small>
                                                $10                </span></li>
                </ul>
                <div id="product">
                    <div class="input-group mb-3">
                        <input id="input-quantity" type="text" class="form-control" name="quantity" value="1">
                        <button class="btn btn-danger add-to-cart" type="button" data-id="1">Купить</button>
                    </div>
                </div>
            </div>

            <div class="blog-title-area">
                @if($post->tags->count())
                    <div class="tag-cloud-single">
                        <span>Tags</span>
                        @foreach($post->tags as $tag)
                            <small><a href="{{ route('tags.single', ['slug' => $tag->slug]) }}" title="">{{ $tag->title }}</a></small>
                        @endforeach
                    </div><!-- end meta -->
                @endif
            </div>

        </div>
    </div>

@endsection




