@extends('backend.layouts.master')

@section('title', 'Manage Users')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12 my-2">
                            <h3>All Users</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Details</th>
                             </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->total }}</td>
                                    <td><a href="{{ route('admin.orderdetails', [$order->billing_id, $order->id]) }}" class="btn btn-primary">Details</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
