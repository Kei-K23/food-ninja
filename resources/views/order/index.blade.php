@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-11 col-12 ">
            <div class="card">
                <div class="card-header">{{ $user->name . "'s" . ' order history' }}</div>
                <div class="card-body">
                    @if ($orders->count() > 0)
                    <div id="shopping-cart-lists" class="list-group">
                        @foreach ($orders as $order)
                        <div class="list-group-item d-flex flex-column flex-md-row  justify-content-between gap-4 ">
                            <div>
                                <h5>Order ID: {{ $order->id }}</h5>
                                <h6 class="text-muted">Total item: {{ $order->total_item }}</h6>
                                <h6 class="text-muted">Total quantity: {{ $order->total_quantity }}</h6>
                                <h6 class="text-muted">Total price: {{ $order->total_price }} $</h6>
                            </div>
                            <div>
                                <h6 class="text-muted">{{ \Carbon\Carbon::parse($order->created_at)->diffForHumans()
                                    }}</h6>
                                <a href="{{ route('order.show', ['order' => $order->id]) }}"
                                    class="btn btn-primary">View detail</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p>No order create yet!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection