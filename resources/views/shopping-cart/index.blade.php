@extends('layouts.app')


@section('content')
<div class="container">
    @if (session('success'))
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-11 col-12 ">
            <div class='alert alert-success ' role='alert'><i class="fa-regular fa-square-check"></i>
                {{ session('success') }}
            </div>
        </div>
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-11 col-12 ">
            <div class="card">
                <div class="card-header">{{ $user->name . "'s" . ' Shopping cart' }}</div>

                <div class="card-body">
                    <h5 class="card-title">Total item: <b>{{ $carts->count() }}</b></h5>
                    @php
                    $totalQuantity = $carts->sum('quantity');
                    @endphp
                    <h5 class="card-title">Total quantity: <b>{{ $totalQuantity }}</b></h5>
                    @php
                    $totalPrice = 0;
                    @endphp

                    @foreach ($carts as $cart)
                    @php
                    // Calculate the subtotal price for each item and add it to the total price
                    $subtotal = $cart->menu->price * $cart->quantity;
                    $totalPrice += $subtotal;
                    @endphp
                    @endforeach

                    <h5 class="card-title">Total price: <b>{{ $totalPrice }} $</b></h5>
                    <div id="shopping-cart-lists" class="list-group">
                        @foreach ($carts as $cart)
                        <div class="list-group-item d-flex flex-column flex-md-row  justify-content-between gap-4 ">
                            <div class="d-flex gap-3">
                                <img style="width: 150px; height: 100px" class="rounded-3 "
                                    src="{{ asset('images/' . $cart->menu->image_url) }}" alt="{{ $cart->menu->name }}">
                                <div>
                                    <h4>{{ $cart->menu->name }}</h4>
                                    <h5 class="text-success">{{ $cart->menu->price }} $</h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-primary btn-increment " data-cart-id="{{ $cart->id }}">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                                <span class="fw-semibold ">
                                    {{ $cart->quantity }}
                                </span>
                                <button class="btn btn-danger btn-decrement " data-cart-id="{{ $cart->id }}">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                                <button class="btn btn-danger btn-delete " data-cart-id="{{ $cart->id }}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @if ($carts->count() > 0)
                    <form action="{{ route('order.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="total_item" value="{{ $carts->count() }}">
                        <input type="hidden" name="total_quantity" value="{{ $totalQuantity }}">
                        <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <button class="btn btn-primary mt-4"><i class="fa-solid fa-money-check"></i>
                            Purchase</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('.btn-increment').click(function() {
                var cartId = $(this).data('cart-id');
                $.post("{{ route('shopping-cart.increment') }}", {
                    cart_id: cartId
                }, function(response) {
                    if (response.success) {
                        // Handle success
                        location.reload(); // Refresh the page after incrementing
                    } else {
                        // Handle failure
                        console.log('Failed to increment');
                    }
                });
            });

            $('.btn-decrement').click(function() {
                var cartId = $(this).data('cart-id');
                $.post("{{ route('shopping-cart.decrement') }}", {
                    cart_id: cartId
                }, function(response) {
                    if (response.success) {
                        // Handle success
                        location.reload(); // Refresh the page after decrementing
                    } else {
                        // Handle failure
                        console.log('Failed to decrement');
                    }
                });
            });

            $('.btn-delete').click(function() {
                var cartId = $(this).data('cart-id');
                $.ajax({
                    url: "{{ url('/shopping-cart/delete') }}/" + cartId,
                    type: 'DELETE',
                    success: function(response) {
                        if (response.success) {
                            // Handle success
                            location.reload(); // Refresh the page after deleting
                        } else {
                            // Handle failure
                            console.log('Failed to delete');
                        }
                    }
                });
            });
        });
</script>
@endpush