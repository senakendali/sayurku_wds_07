@extends('layouts.main')
@section('container')
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Pesan Sayuran</h1>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aspernatur odit neque facere saepe totam necessitatibus eum deleniti perspiciatis minus laudantium!</p>
            </div> 
        </div>
    </div>
</div>
<main class="content">
    <section class="products">
        <div class="container-xxl"> 
            <div class="galleries page-content">
              @foreach ($products as $product)
                <div class="item">
                    <a href="{{ url('produk-kami/'.$product->id) }}">
                        <img src="{{ asset($product->product_image) }}" alt="{{ $product->product_name }}">
                    </a>
                    <div class="product-name">{{ $product->product_name }}</div>
                    <div class="product-description">
                        {{ $product->product_description }}
                    </div>
                </div>
              @endforeach
            </div>
        </div>
    </section>
    
    <section class="order">
        <div class="container">
            <h2 class="mt-4 mb-4">Pesan Sayuran</h2>
            <form id="order-form" class="order-form" >
                <p>
                    Silahkan isi form dibawah ini untuk melakukan pemesanan. 
                    Admin kami akan menghubungi anda untuk konfirmasi pesanan dan pembayaran
                </p>
                
                <div class="mb-3">
                  <label for="name" class="form-label">Nama Lengkap</label>
                  <input type="text" class="form-control" id="name" name="name" value="">
                </div>

                <div class="mb-3">
                  <label for="phone_number" class="form-label">Nomor HP</label>
                  <input type="text" class="form-control" id="phone_number" name="phone_number" value="" >
                </div>

                <div class="mb-3">
                  <label for="email" class="pesanan">Email</label>
                  <input type="email" class="form-control" id="email" name="email" value="">
                </div>
                
                <div class="mb-3">
                  <label for="address" class="pesanan">Alamat Pengiriman</label>
                  <textarea name="address" id="address" rows="10" ></textarea>
                </div>

                <div class="mb-3">
                  <label for="order_list" class="pesanan">Sayur yang akan dipesan</label>
                  <textarea name="order_detail" id="order_detail" rows="10" ></textarea>
                </div>

                <div class="mb-3">
                  <input id="submit" type="submit" name="submit" value="Submit">
                </div>
            </form>
        </div>
    </section>
</main>
@endsection