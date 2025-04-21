@extends('layout.home')
@section('title', 'Product')

@section('content')

<div class="bg-light py-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mb-0"><a href="/">Home</a> <span class="mx-2 mb-0">/</span> <a
          href="/stores">Store</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{ $product->product_name }}</strong></div>
    </div>
  </div>
</div>

<div class="site-section">
  <div class="container">
    <div class="row">
      <div class="col-md-5 mr-auto">
        <div class="border text-center">
          <img src="../uploads/{{ $product->foto1 }}" alt="Image" class="img-fluid p-5">
        </div>
      </div>
      <div class="col-md-6">
        <h2 class="text-black">{{ $product->product_name }}</h2>
        <p>{{ $product->deskripsi }}</p>
        @if ($discount)
          <p class="text-primary h4"><del>RP {{ number_format($product->price) }}</del> &mdash; RP {{ number_format($product->price * (1 - $discount->percentage / 100)) }}</p>
        @else
          <p><strong class="text-primary h4">Rp. {{ number_format($product->price) }}</strong></p>
        @endif
        <p>Stok: {{ $product->stok }}</p>
        <div class="mb-5">
          <div class="input-group mb-3" style="max-width: 220px;">
            <div class="input-group-prepend">
              <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
            </div>
            <input type="number" class="form-control text-center jumlah" title="Qty" step="1" min="1" value="1" placeholder="Jumlah (Kg)"
              aria-label="Example text with button addon" aria-describedby="button-addon1">
            <div class="input-group-append">
              <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
            </div>
          </div>

        </div>
        <p><a href="#" class="buy-now btn btn-sm height-auto px-4 py-3 btn-primary add-to-cart">Add To Cart</a></p>

      </div>
    </div>
  </div>
</div>

@endsection

@push('js')
  <script>
    $(function(){
      $('.add-to-cart').click(function(e){
        id_customer = {{Auth::guard('webcustomer')->user()->id}}
        id_barang = {{ $product->id }}
        jumlah = $('.jumlah').val()
        @if ($discount)
          total = {{ $product->price * (1 - $discount->percentage / 100) }} * jumlah;
        @else
          total = {{ $product->price }} * jumlah;
        @endif
        is_checkout = 0

        $.ajax({
          url : "/add_to_cart",
          method : "POST",
          headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}",
          },
          data : {
            id_customer,
            id_barang,
            jumlah,
            total,
            is_checkout,
          },
          success : function (data) {
            window.location.href = '/cart';
          }
        });
      })
    })
  </script>
@endpush 