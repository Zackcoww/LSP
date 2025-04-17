@extends('layout.home')
@section('title', 'Cart')
@section('content')
<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0">
        <a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> 
        <strong class="text-black">Cart</strong>
      </div>
    </div>
  </div>
</div>

<div class="site-section">
  <div class="container">
    <div class="row mb-5">
      <form class="col-md-12 form-cart">
        <div class="site-blocks-table">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="product-thumbnail">Image</th>
                <th class="product-name">Product</th>
                <th class="product-price">Price</th>
                <th class="product-quantity">Quantity</th>
                <th class="product-total">Total</th>
                <th class="product-remove">Remove</th>
              </tr>
            </thead>
            <tbody>
              @php
                $checkoutTotal = 0;
              @endphp
                <input type="hidden" name="id_customer" value="{{ Auth::guard('webcustomer')->user()->id }}">
              @foreach ($carts as $cart)
              @php
                $checkoutTotal += $cart->total;
                $discount = $discounts->where('id_barang', $cart->product->id)->where('start_date', '<=', now())->where('end_date', '>=', now())->first();
              @endphp
              
              <input type="hidden" name="id_produk[]" value="{{ $cart->product->id }}">
              <input type="hidden" name="jumlah[]" value="{{ $cart->jumlah }}">
              <input type="hidden" name="total[]" value="{{ $cart->total }}">
              <tr>
                <td class="product-thumbnail">
                  <img src="/uploads/{{ $cart->product->foto1 }}" alt="Image" class="img-fluid">
                </td>
                <td class="product-name">
                  <h2 class="h5 text-black">{{ $cart->product->product_name }}</h2>
                </td>
                @if ($discount)
                <td>RP {{ number_format($cart->product->price * (1 - $discount->percentage / 100)) }}</td>
                @else
                <td>{{ "Rp ". number_format($cart->product->price) }}</td>
                @endif
                <td>{{ $cart->jumlah }}</td>
                <td>{{ "Rp ". number_format($cart->total) }}</td>
                <td><a href="/delete_from_cart/{{ $cart->id }}" class="btn btn-primary height-auto btn-sm">X</a></td>
              </tr>
              @endforeach
              <input type="hidden" name="grand_total" value="{{ $checkoutTotal }}">
            </tbody>
          </table>
        </div>
      </form>
    </div>

    <div class="row">
      <div class="col-md-6">
      </div>
      <div class="col-md-6 pl-5">
        <div class="row justify-content-end">
          <div class="col-md-7">
            <div class="row">
              <div class="col-md-12 text-right border-bottom mb-5">
                <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
              </div>
            </div>
            <div class="row mb-5">
              <div class="col-md-6">
                <span class="text-black">Total</span>
              </div>
              <div class="col-md-6 text-right">
                <strong class="text-black">{{ "Rp ". number_format($checkoutTotal) }}</strong>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <a href="#" class="btn btn-primary btn-lg btn-block checkout">Proceed To
                  Checkout</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('js')
  <script>
    $(function() {
      $('.checkout').click(function(e){
        e.preventDefault()
        $.ajax({
          url: '/checkout_orders',
          method: 'POST',
          data: $('.form-cart').serialize(),
          headers: {
            'X-CSRF-TOKEN': "{{csrf_token()}}"
          },
          success: function(){
            location.href = '/checkout'
          }
        })
      })
    })
  </script>
@endpush