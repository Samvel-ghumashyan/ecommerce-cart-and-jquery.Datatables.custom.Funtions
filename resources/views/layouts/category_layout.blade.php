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
<link rel="shortcut icon" href="{{ asset('assets/front/images/favicon.ico') }}" type="image/x-icon" />
<link rel="apple-touch-icon" href="{{ asset('assets/front/images/apple-touch-icon.png') }}">
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700" rel="stylesheet">

{{--<link rel="stylesheet" href="{{ asset('assets/source/front_index.de82651a.css') }}">--}}

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <script src="https://kit.fontawesome.com/e8919c6321.js" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div id="wrapper">

    @include('layouts.navbar')

    @yield('page-title')


    <section class="section lb">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                    @include('layouts.sidebar')
                </div><!-- end col -->

                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">

                    @yield('content')

                </div><!-- end col -->

            </div><!-- end row -->
        </div><!-- end container -->
    </section>

    <footer class="footer">

    </footer><!-- end footer -->

</div><!-- end wrapper -->


{{--<script src="{{ asset('assets/source/front_indexJs.d0e4a232.js') }}"></script>--}}

</body>
</html>

