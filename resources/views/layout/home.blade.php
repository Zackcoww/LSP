<!DOCTYPE html>
<html lang="en">

<head>
  <title>@yield('title', 'Home')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Rubik:400,700|Crimson+Text:400,400i" rel="stylesheet">
  <link rel="stylesheet" href="../frontend/fonts/icomoon/style.css">

  <link rel="stylesheet" href="../frontend/css/bootstrap.min.css">
  <link rel="stylesheet" href="../frontend/css/magnific-popup.css">
  <link rel="stylesheet" href="../frontend/css/jquery-ui.css">
  <link rel="stylesheet" href="../frontend/css/owl.carousel.min.css">
  <link rel="stylesheet" href="../frontend/css/owl.theme.default.min.css">


  <link rel="stylesheet" href="../frontend/css/aos.css">

  <link rel="stylesheet" href="../frontend/css/style.css">

</head>

<body>
  <div class="site-wrap">
    <div class="site-navbar py-2">
      <div class="container">
        <div class="d-flex align-items-center justify-content-between">
          <div class="logo">
            <div class="site-logo">
              @php
                
                $about = App\Models\About::first();
                if (Auth::guard('webcustomer')->check()){
                $user_id = Illuminate\Support\Facades\Auth::guard('webcustomer')->user()->id;
                $cart_total = App\Models\Cart::where('id_customer', Auth::guard('webcustomer')->user()->id)->where('is_checkout', 0)->count();
                }
              @endphp
              <a href="/" class="js-logo-clone">{{ $about->judul_website }}</a>
            </div>
          </div>
          <div class="main-nav d-none d-lg-block">
            <nav class="site-navigation text-right text-md-center" role="navigation">
              <ul class="site-menu js-clone-nav d-none d-lg-block">
                <li class="{{ (Request::is('/') ? 'active' : '') ? 'active' : '' }}"><a href="/">Home</a></li>
                <li class="has-children">
                  <a href="#">Store</a>
                  <ul class="dropdown">
                    <li><a href="/stores/buah">Buah</a></li>
                    <li><a href="/stores/sayur">Sayur</a></li>
                  </ul>
                </li>
                <li class="{{ (Request::is('orders') ? 'active' : '') ? 'active' : '' }}"><a href="/orders">Orders</a></li>
                <li class="{{ (Request::is('about') ? 'active' : '') ? 'active' : '' }}"><a href="/about">About</a></li>
              </ul>
            </nav>
          </div>
          <div class="icons">
            
            @if (Auth::guard('webcustomer')->check())
            <a href="/cart" class="icons-btn d-inline-block bag">
              <span class="icon-shopping-bag"></span>
              <span class="number">{{ $cart_total }}</span>
            </a>
            <a href="#">{{ Auth::guard('webcustomer')->user()->nama_customer }}</a>
            <a href="/logout_customer"><span class="btn btn-round btn-primary">Log Out</span></a>
            @else
            <a href="/login_customer"><span class="btn btn-round btn-primary">Sign In</span></a>
            @endif
            <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span
                class="icon-menu"></span></a>
          </div>
        </div>
      </div>
    </div>

    @yield('content')

    <div class="site-section bg-secondary bg-image" style="background-image: url('images/bg_2.jpg');">
      <div class="container">
        <div class="row align-items-stretch">
          <div class="col-lg-6 mb-5 mb-lg-0">
            
            <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('../frontend/images/bg_1.jpg');">
              <div class="banner-1-inner align-self-center">
                <h2>Fresh From the Farm</h2>
                <p> Handpicked fruits and vegetables grown in our own fields in Cianjur.  
                <strong>Zero middlemen, zero compromise—just clean, healthy food.</strong>
                </p>
              </div>
            </a>
          </div>
          <div class="col-lg-6 mb-5 mb-lg-0">
            <a href="#" class="banner-1 h-100 d-flex" style="background-image: url('../frontend/images/bg_2.jpg');">
              <div class="banner-1-inner ml-auto  align-self-center">
                <h2>Rated by Experts</h2>
                <p>Our produce is trusted by nutritionists, chefs, and families alike.  
                <strong>Freshness, taste, and quality—every time you order.</strong>
                </p>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
    
    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">

            <div class="block-7">
              <h3 class="footer-heading mb-4">About Us</h3>
              <p>{{$about->deskripsi}}</p>
            </div>

          </div>
          <div class="col-lg-3 mx-auto mb-5 mb-lg-0"></div>
          <div class="col-md-6 col-lg-3">
            <div class="block-5 mb-5">
              <h3 class="footer-heading mb-4">Contact Info</h3>
              <ul class="list-unstyled">
                <li class="address">{{ $about->alamat }}</li>
                <li class="phone"><a hr ef="tel://23923929210">{{ $about->telepon }}</a></li>
                <li class="email">{{ $about->email }}</li>
              </ul>
            </div>


          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <p>
              Copyright &copy;
              <script>document.write(new Date().getFullYear());</script> All rights reserved | Made by 
              <a href="#" target="_blank" class="text-primary">{{ $about->atas_nama }}</a>
            </p>
          </div>

        </div>
      </div>
    </footer>
  </div>
  <script src="../frontend/js/jquery-3.3.1.min.js"></script>
  <script src="../frontend/js/jquery-ui.js"></script>
  <script src="../frontend/js/popper.min.js"></script>
  <script src="../frontend/js/bootstrap.min.js"></script>
  <script src="../frontend/js/owl.carousel.min.js"></script>
  <script src="../frontend/js/jquery.magnific-popup.min.js"></script>
  <script src="../frontend/js/aos.js"></script>
  <script src="../frontend/js/main.js"></script>
  @stack('js')
</body>
</html>