@extends('layout.home')
@section('content')
<!-- Hero Slider -->
<div class="site-blocks-cover" style="background-image: url('../frontend/images/hero_1.jpg');">
  <div class="container">
    <div class="row">
      <div class="col-lg-7 mx-auto order-lg-2 align-self-center">
        <div class="site-block-cover-content text-center">
          <h2 class="sub-title">Freshly Harvested, Naturally Delicious</h2>
          <h1>Welcome To Zako Shop</h1>
          <p>
            <a href="#" class="btn btn-primary px-5 py-3">Shop Now</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="site-section">
  <div class="container">
    <div class="row align-items-stretch section-overlap">
      <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
        <div class="banner-wrap bg-primary h-100">
          <a href="#" class="h-100">
            <h5>Free <br> Delivery</h5>
            <p>
            Straight from our fields in Cianjur
              <strong>Enjoy the goodness of fresh fruits and vegetables at your doorstep.</strong>
            </p>
          </a>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
        <div class="banner-wrap h-100">
          <a href="#" class="h-100">
            <h5>Seasonal  <br> Harvest Deals</h5>
            <p>
            Taste the season’s best — 
              <strong>Get up to 50% off on selected farm-fresh produce.</strong>
            </p>
          </a>
        </div>
      </div>
      <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
        <div class="banner-wrap bg-warning h-100">
          <a href="#" class="h-100">
            <h5>Gift <br>  A Healthy Basket</h5>
            <p>
            Show you care with a gift of wellness — 
              <strong>Send curated fruit & veggie baskets to your loved ones.</strong>
            </p>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="site-section">
  <div class="container">
    <div class="row">
      <div class="title-section text-center col-12">
        <h2 class="text-uppercase">New Products</h2>
      </div>
    </div>

    <div class="row">
      @foreach ($products as $product)
      <div class="col-sm-6 col-lg-4 text-center item mb-4">
        @php
        $discount = $discounts->where('id_barang', $product->id)->where('start_date', '<=', now())->where('end_date', '>=', now())->first();
        @endphp
        @if ($discount)
            <span class="tag">Sale</span>
        @endif
        <a href="/store/{{ $product->id }}" class="product-link">
          <div class="image-container">
            <img src="/uploads/{{ $product->foto1 }}" alt="Image" class="product-image">
          </div>
        </a>
        <h3 class="text-dark"><a href="/store/{{ $product->id }}">{{ $product->product_name }}</a></h3>
        @if ($discount)
          <p class="price"><del>RP {{ number_format($product->price) }}</del> &mdash; RP {{ number_format($product->price * (1 - $discount->percentage / 100)) }}</p>
        @else
          <p class="price">RP {{ number_format($product->price) }}</p>
        @endif
      </div>
      @endforeach
    </div>

    <div class="row mt-5">
      <div class="col-12 text-center">
        <a href="/stores/buah" class="btn btn-primary px-4 py-3">View All Products</a>
      </div>
    </div>
  </div>
</div>
@endsection