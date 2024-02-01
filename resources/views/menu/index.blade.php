@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-primary">Menu</h2>
    <div class="row ">
        @foreach ($menus as $menu)
        <x-menu-card :menu="$menu" />
        @endforeach
    </div>
    <div class="my-5">
        {{ $menus->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
            // Loop through each add-to-cart button
            $('.add-to-cart-btn').each(function() {
                const isItemInCart = $(this).data('is-item-in-cart');

                // Disable button if the item is already in the cart
                if (isItemInCart) {
                    $(this).prop('disabled', true);
                }
            });
        });
</script>
@endpush