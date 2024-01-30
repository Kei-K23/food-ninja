<div class="col-12 col-md-6 col-lg-4 my-2 ">
    <div class="card">
        <img class="card-img-top img-thumbnail " src="{{ asset('images/' . $menu->image_url) }}" alt="{{ $menu->name }}"
            style="width: 100%; height: 220px;">
        <div class="card-body">
            <div class="d-flex justify-content-between  align-items-center ">
                <h5 class="card-title">{{ $menu->name }}</h5>
                <h5 class="card-title">{{ $menu->price }} $</h5>
            </div>
            <a href="{{ route('restaurant.show', ['restaurant' => $menu->restaurant->id ]) }}"
                class="card-subtitle mb-2 text-body-secondary text-truncate ">{{ $menu->restaurant->name }}</a>
            <p class="card-text truncate-paragraph mt-3 ">
                {{ $menu->description }}
            </p>
            <a href="#" class="btn btn-primary">Add To Cart</a>
            <a href="{{ route('menu.show' , ['menu' => $menu->id]) }}" class="btn btn-secondary ">See
                More</a>
        </div>
    </div>
</div>