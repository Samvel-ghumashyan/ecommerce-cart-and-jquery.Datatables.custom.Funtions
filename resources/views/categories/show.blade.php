@extends('layouts.category_layout')

@section('title', 'Caregory :: ' . $category->title)

@section('page-title')
    <div style="margin-top: 98px;"></div>
    <div class="page-title db">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <h2>{{ $category->title }}</h2>
                </div><!-- end col -->
                <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ $category->title }}</li>
                    </ol>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end page-title -->
    <div style="margin-bottom: 20px;"></div>
@endsection

@section('content')
    <div style="margin-bottom: 20px;"></div>
    <div class="row row-cols-lg-3 g-1">
        @foreach($posts as $post)
            <div class="col-6 col-md-3">
                <div class="card prod_cards" style=" border-radius: 25px; padding: 20px;  background-color: white; height: 475px;" >
                    <a href="{{ route('posts.single', ['slug' => $post->slug]) }}"><img class="bd-placeholder-img card-img-top"  src="{{ $post->getImage() }}" width="200px" ></a>
                    <div class="card-body">
                        <h4 class="card-title"><a href="{{ route('posts.single', ['slug' => $post->slug]) }}" title="">{{ $post->title }}</a></h4>
                        <p class="card-text"> {!! $post->description !!}</p>
                        <div class="product-bottom-details d-flex justify-content-between">
                            <div class="product-price" style="color: red; font-size: 20px;">
                                <small style="color: grey; font-size: 15px;">$12</small>
                                $10</div>
                            <div class="product-links">
                                <a class="add-to-cart" data-id="{{ $post->id }}" href="{{ route('posts.single', ['slug' => $post->slug]) }}"><i class="fa-sharp fa-solid fa-cart-plus" style="font-size: 30px;"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <hr class="invis">

    <div class="col-md-12">
        {{$posts->onEachSide(1)->links('vendor.pagination.bootstrap-4')}}
    </div>

@endsection

