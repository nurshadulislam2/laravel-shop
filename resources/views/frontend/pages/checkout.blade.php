@extends('frontend.layouts.master')

@section('title', 'Checkout')

@section('content')
    <section class="p-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Checkout</div>
                        <div class="card-body">
                            <form action="{{ route('placeorder') }}" method="post" id="payment-form">
                                @csrf
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="{{ \auth()->user()->name }}" class="form-control" id="name" name="name">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="mobile" name="mobile" value="{{ \auth()->user()->mobile }}">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="city" class="col-sm-2 col-form-label">City</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control" id="city" name="city"
                                            value="Dhaka">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <textarea name="address" id="address" cols="30" rows="3" class="form-control">{{ \auth()->user()->address }}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="payment" class="col-sm-2 col-form-label">Payment</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control" id="payment" name="payment"
                                            value="Cash On Delivery">
                                    </div>
                                </div>
                                <input type="hidden" name="amount" value="{{ $amount }}">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
