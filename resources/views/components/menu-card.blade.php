<div class="col-12 col-md-6 col-lg-4 my-2">
    <div class="card h-100">
        <!-- Card image -->
        @if ($menu->image_url && file_exists(public_path('images/' . $menu->image_url)))
        <img style="width: 100%; height: 220px;" class="card-img-top img-thumbnail"
            src="{{ asset('images/' . $menu->image_url) }}" alt="{{ $menu->name }}">
        @elseif ($menu->image_url && file_exists(public_path('storage/images/' . $menu->image_url)))
        <img style="width: 100%; height: 220px;" class="card-img-top img-thumbnail"
            src="{{ asset('storage/images/' . $menu->image_url) }}" alt="{{ $menu->name }}">
        @else
        <img style="width: 100%; height: 220px;" class="card-img-top img-thumbnail"
            src="{{ asset('images/placeholder.png') }}" alt="{{ $menu->name }}">
        @endif
        <!-- Card body -->
        <div class="card-body d-flex flex-column">
            <!-- Title and Price -->
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">{{ $menu->name }}</h5>
                <h5 class="card-title">{{ $menu->price }} $</h5>
            </div>
            <!-- Restaurant name -->
            <a href="{{ route('restaurant.show', ['restaurant' => $menu->restaurant->id]) }}"
                class="card-subtitle mb-2 text-body-secondary text-truncate">{{ $menu->restaurant->name }}</a>
            <!-- Description -->
            <p class="card-text truncate-paragraph flex-grow-1">
                {{ $menu->description }}
            </p>
            <!-- Buttons -->
            @if ($showAction)
            <div class="d-flex flex-column gap-2 ">
                <button class="btn btn-primary add-to-cart-btn" data-menu-id="{{ $menu->id }}"
                    data-is-item-in-cart="{{ Auth::check() && Auth::user()->shoppingCarts->where('menu_id', $menu->id)->count() > 0 ? 'true' : 'false' }}">Add
                    To Cart</button>
                <a href="{{ route('menu.show', ['menu' => $menu->id]) }}" class="btn btn-secondary">See More</a>
            </div>
            @else
            <a href="{{ route('products.show', ['menu' => $menu->id]) }}" class="btn btn-secondary">See More</a>
            @endif
        </div>
    </div>
</div>