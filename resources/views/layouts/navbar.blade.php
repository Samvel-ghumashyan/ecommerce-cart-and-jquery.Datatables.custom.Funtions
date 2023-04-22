<div class="market-header header" >
        <nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary fixed-top" style="border: 5px solid orange">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}" style="color: white">LOGO</a>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="http://building-products.loc/authh" style="color: white">Admin Login</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
            <?php $count = session('qnty') <= 0 ? 0 : session('qnty'); ?>

            <a href="#" class="relative" data-toggle="modal" data-target="#cart-modal"  id="get-cart" style="width: 50px;">
                <i class="fa-solid fa-cart-shopping" style="color: #ffd500;"></i>
                <span class="badge bg-danger rounded-pill count-items">{{$count}}</span>
            </a>
        </nav>
    </div>

<div class="modal fade" id="cart-modal" tabindex="-1" aria-labelledby="exampleModalLabel" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Cart</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-cart-content">

            </div>
        </div>
    </div>
</div>
