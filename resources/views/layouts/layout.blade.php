<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>@yield('title')</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700" rel="stylesheet">
{{--<link rel="stylesheet" href="{{ asset('assets/source/front_index.de82651a.css') }}">--}}

@yield('headCss')

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div id="wrapper">

    @include('layouts.navbar')

    <div id="successProductsOrder" style="position: relative; width: 100%; display: flex; justify-content: center; background-color: red; z-index: 1;"></div>

    @yield('header')


    <div style="display: flex; justify-content: center; flex-direction: row; font-size: 40px; margin: 15px;"><a href="http://building-products.loc/category/opt-6_03">Products by category</a></div>
    <section class="section lb @if(!Request::is('/')) m3rem @endif">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                    @yield('content')

                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>

    <footer class="footer">

    </footer><!-- end footer -->

</div><!-- end wrapper -->
@stack('scripts')
<script src="https://kit.fontawesome.com/e8919c6321.js" crossorigin="anonymous"></script>
</body>
</html>
