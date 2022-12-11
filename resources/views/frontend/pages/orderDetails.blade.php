@extends('frontend.layouts.master')

@section('title', "Orders")

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row">
            @foreach ($orders as $order)
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <p>Produt: {{ $order->product->name }}</p>
                        <p>Quantity: {{ $order->quantity }}</p>
                        <p>Price: {{ $order->price }}</p>
                    </div>
                    <div class="card-footer">Total: {{ $order->quantity*$order->price }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
