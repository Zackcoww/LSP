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

        <div class="mt-5">
          <ul class="nav nav-pills mb-3 custom-pill" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                aria-controls="pills-home" aria-selected="true">Ordering Information</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                aria-controls="pills-profile" aria-selected="false">Specifications</a>
            </li>
        
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
              <table class="table custom-table">
                <thead>
                  <th>Material</th>
                  <th>Description</th>
                  <th>Packaging</th>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">OTC022401</th>
                    <td>Pain Management: Acetaminophen PM Extra-Strength Caplets, 500 mg, 100/Bottle</td>
                    <td>1 BT</td>
                  </tr>
                  <tr>
                    <th scope="row">OTC022401</th>
                    <td>Pain Management: Acetaminophen PM Extra-Strength Caplets, 500 mg, 100/Bottle</td>
                    <td>144/CS</td>
                  </tr>
                  <tr>
                    <th scope="row">OTC022401</th>
                    <td>Pain Management: Acetaminophen PM Extra-Strength Caplets, 500 mg, 100/Bottle</td>
                    <td>1 EA</td>
                  </tr>
                  
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        
              <table class="table custom-table">
        
                <tbody>
                  <tr>
                    <td>HPIS CODE</td>
                    <td class="bg-light">999_200_40_0</td>
                  </tr>
                  <tr>
                    <td>HEALTHCARE PROVIDERS ONLY</td>
                    <td class="bg-light">No</td>
                  </tr>
                  <tr>
                    <td>LATEX FREE</td>
                    <td class="bg-light">Yes, No</td>
                  </tr>
                  <tr>
                    <td>MEDICATION ROUTE</td>
                    <td class="bg-light">Topical</td>
                  </tr>
                </tbody>
              </table>
        
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