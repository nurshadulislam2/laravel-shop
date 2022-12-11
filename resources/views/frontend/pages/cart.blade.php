@extends('frontend.layouts.master')

@section('title', 'Cart')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Cart</div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="table-dark">
                              <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Remove</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                <tr>
                                    <td>
                                        <img src="{{ asset('images/product/'. $item->attributes->image) }}" class=" rounded" width="100" alt="Thumbnail">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <form action="{{ route('cart.update') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id}}" >
                                          <input type="number" name="quantity" value="{{ $item->quantity }}" />
                                          <button type="submit" class="btn btn-primary">update</button>
                                          </form>
                                    </td>
                                    <td>{{ $item->price }}</td>
                                    <td>
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $item->id }}" name="id">
                                            <button class="btn btn-danger">X</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                          </table>
                          <div class="row">
                            <div class="col-md-10">
                                Total: {{ Cart::getTotal() }} Taka
                            </div>
                            <div class="col-md-2">
                                <form action="{{ route('cart.clear') }}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger">Remove All Cart</button>
                                  </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-10">
                                <a href="{{ route('/') }}" class="btn btn-primary">Continue Shopping</a>
                            </div>
                            <div class="col-md-2">
                                @if (Cart::getTotal()>0)
                                    <a href="{{ route('checkout', Cart::getTotal()) }}" class="btn btn-primary">Checkout</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
