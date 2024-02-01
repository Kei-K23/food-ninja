@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-11 col-12 ">
            <div class="card">
                <div class="card-header">{{ 'Order ID: ' . $order->id }}</div>
                <div class="card-body">
                    <div class="table-responsive ">
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th scope="col">Order Items ID</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderItems as $orderItem)
                                <tr>
                                    <th scope="row">{{ $orderItem->id }}</th>
                                    <td><img class="rounded-circle " style="width: 70px; height: 70px"
                                            src="{{ asset('images/' . $orderItem->menu->image_url) }}"
                                            alt="{{ $orderItem->menu->name }}"></td>
                                    <td>{{ $orderItem->menu->name }}</td>
                                    <td>{{ $orderItem->unit_price }}</td>
                                    <td>{{ $orderItem->quantity }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex flex-column align-items-end ">
                        <h6 class="card-title text-muted">Total item: {{ $order->total_item }}</h6>
                        <h6 class="card-title text-muted">Total quantity: {{ $order->total_quantity }}</h6>
                        <h6 class="card-title  text-muted">Total price: {{ $order->total_price }} $</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection