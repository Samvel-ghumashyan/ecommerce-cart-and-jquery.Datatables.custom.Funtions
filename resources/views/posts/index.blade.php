@extends('layouts.layout')

@section('title', 'Markedia - Marketing Blog Template :: Home')

@section('header')
    <div style="padding-bottom: 70px"></div>
    <div style=" background-image: url('public/headerr.jpg');  height: 400px; ">
    <section  class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 align-self-center">
                    <h2>BUILDING PRODUCTS</h2>
                    <p class="lead"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce hendrerit, ex ac porttitor vulputate, mauris sapien porta dolor, vitae ultricies leo metus non dui. Aenean a fringilla tellus. In ante eros, imperdiet non blandit sit amet, dignissim nec purus. Donec non tempor nibh. In et orci tortor. Etiam ac molestie arcu. Cras cursus non odio ut sodales. Quisque placerat nisi eget facilisis eleifend. Cras viverra elit dapibus eros consectetur egestas iaculis sed nunc.</p>
                </div>
            </div>
        </div>
    </section>
    </div>

@endsection

@section('content')

            <div class="row row-cols-4 g-1">
            @foreach($posts as $post)
                    <div class="col-6 col-md-3">
                        <div class="card prod_cards" style=" border-radius: 25px; padding: 20px; background-color: white; height: 480px; ">
                            <a href="{{ route('posts.single', ['slug' => $post->slug]) }}"><img class="bd-placeholder-img card-img-top"  src="{{ $post->getImage() }}" width="200px" ></a>
                            <div class="card-body">
                                <h4 class="card-title"><a href="{{ route('posts.single', ['slug' => $post->slug]) }}" title="">{{ $post->title }}</a></h4>
                                <p class="card-text"> {!! $post->description !!}</p>
                                <div class="product-bottom-details d-flex justify-content-between">
                                    <div class="product-price" style="color: red; font-size: 20px;">
                                        <small style="color: grey; font-size: 15px;">$12</small>
                                        $10</div>
                                    <div class="product-links">
                                        <a class="add-to-cart" data-id="{{ $post->id }}" style="cursor: pointer;"><i class="fa-sharp fa-solid fa-cart-plus" style="font-size: 30px;"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
            <div class="col-md-12">
                {{$posts->onEachSide(1)->links('vendor.pagination.bootstrap-4')}}
            </div>

    <hr class="invis">



{{--    <div class="row">--}}
{{--        <div class="col-md-12">--}}
{{--            <nav aria-label="Page navigation">--}}
{{--                {{ $posts->links() }}--}}
{{--            </nav>--}}
{{--        </div><!-- end col -->--}}
{{--    </div><!-- end row -->--}}

@endsection
