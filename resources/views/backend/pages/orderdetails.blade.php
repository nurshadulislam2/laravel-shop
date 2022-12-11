@extends('backend.layouts.master')

@section('title', "Order Details")

@section('content')
    <div class="card p-3">
        <div class="row">
            <div class="col-md-6">
                <h3 class="text-center h3 mb-3">Billing Info</h3>
                <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <td>Name</td>
                        <td>{{ $billing->name }}</td>
                      </tr>
                      <tr>
                        <td>Mobile</td>
                        <td>{{ $billing->mobile }}</td>
                      </tr>
                      <tr>
                        <td>City</td>
                        <td>{{ $billing->city }}</td>
                      </tr>
                      <tr>
                        <td>Address</td>
                        <td>{{ $billing->address }}</td>
                      </tr>
                    </tbody>
                  </table>

            </div>
            <div class="col-md-6">
                <h3 class="text-center h3 mb-3">Order Info</h3>
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Qunatity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $total=0;
                        @endphp
                      @foreach ($orderDetails as $details)
                        <tr>
                            <td>{{ $details->product->name }}</td>
                            <td>{{ $details->quantity }}</td>
                            <td>{{ $details->price }}</td>
                            <td>
                                {{ ($details->price*$details->quantity) }}
                                @php
                                    $total+=($details->price*$details->quantity);
                                @endphp
                            </td>
                        </tr>
                      @endforeach
                      <tr>
                        <td colspan="3">Total</td>
                        <td>{{ $total }} TK</td>
                      </tr>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
@endsection
