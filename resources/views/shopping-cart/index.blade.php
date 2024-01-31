@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $user->name . "'s" . ' Shopping cart' }}</div>

                <div class="card-body">
                    <h5 class="card-title">Total items: </h5>
                    <div id="shopping-cart-lists" class="list-group">

                        @foreach ($carts as $cart)
                        <div>
                            <h4>
                                {{ $cart->id }}
                            </h4>
                            <h4>
                                {{ $cart->menu->name }}
                            </h4>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection