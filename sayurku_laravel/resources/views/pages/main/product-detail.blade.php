@extends('layouts.main')
@section('container')
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>{{ $detail->product_name }}</h1>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aspernatur odit neque facere saepe totam necessitatibus eum deleniti perspiciatis minus laudantium!</p>
            </div> 
        </div>
    </div>
</div>
<main class="content">
    <div class="container">
        <div class="row page-content">
            <div class="col-lg-2">
                <ul class="list-group list-group-flush">
                    @foreach($products as $product)
                        <li class="list-group-item">
                            <a href="{{ url('produk-kami/'.$product->id) }}">{{ $product->product_name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-10 text-start">
                <img src="{{ asset($detail->product_image) }}" alt="{{ $detail->product_name }}" class="img-fluid mb-4">
                {!! $detail->product_description !!}
            </div>
        </div>
    </div>
</main>
@endsection