@extends('frontend.layouts.master')

@section('title', $product->name)

@section('content')
    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0"
                        src="{{ asset('images/product/' . $product->image) }}" alt="{{ $product->ame }}" /></div>
                <div class="col-md-6">
                    <div class="small mb-1">Brand: <a class="text-decoration-none" href="{{ route('brand', $product->brand_id) }}" class="">{{ $product->brand->name }}</a></div>
                    <div class="small mb-1">Category: <a href="{{ route('category', $product->category_id) }}" class="text-decoration-none">{{ $product->category->name }}</a></div>
                    <h1 class="display-5 fw-bolder">{{ $product->name }}</h1>
                    <div class="fs-5 mb-5">

                        <span>{{ $product->price }} TK</span>
                    </div>
                    <div class="lead">{!! $product->description !!}</div>
                    <div class="d-flex">
                        <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $product->id }}" name="id">
                            <input type="hidden" value="{{ $product->name }}" name="name">
                            <input type="hidden" value="{{ $product->price }}" name="price">
                            <input type="hidden" value="{{ $product->image }}"  name="image">
                            <input type="hidden" value="1" name="quantity">

                            <button class="btn btn-outline-dark">Add To Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Related items section-->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="fw-bolder mb-4">Related products</h2>
            <div class="row">
                @foreach ($products as $product)
                <div class="col-md-4 mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="{{ asset('images/product/'. $product->image) }}" alt="{{ $product->name }}" height="300" />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">{{ $product->name }}</h5>
                                <!-- Product price-->
                                {{ $product->price }} TK
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $product->id }}" name="id">
                                    <input type="hidden" value="{{ $product->name }}" name="name">
                                    <input type="hidden" value="{{ $product->price }}" name="price">
                                    <input type="hidden" value="{{ $product->image }}"  name="image">
                                    <input type="hidden" value="1" name="quantity">
                                    <a class="btn btn-outline-dark mt-auto" href="{{ route('product', $product->id) }}">Details</a>
                                    <button class="btn btn-outline-dark">Add To Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
