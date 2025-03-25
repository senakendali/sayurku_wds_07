@extends('layouts.main')
@section('container')
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>{{ $page_detail->title }}</h1>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aspernatur odit neque facere saepe totam necessitatibus eum deleniti perspiciatis minus laudantium!</p>
            </div> 
        </div>
    </div>
</div>
<main class="content">
    <div class="container">
        <div class="row mt-4 page-content">
            <div class="col-lg-12 text-start">
                {!! $page_detail->content !!}
            </div>
        </div>
    </div>
</main>
@endsection