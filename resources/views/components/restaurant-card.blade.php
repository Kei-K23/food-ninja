<div class="col-12 col-md-6 col-lg-4 my-2 ">
    <div class="card">
        <img class="card-img-top img-thumbnail " src="{{ asset('images/' . $restaurant->image_url) }}"
            alt="{{ $restaurant->name }}" style="width: 100%; height: 220px;">
        <div class="card-body">
            <h5 class="card-title mb-3">{{ $restaurant->name }}</h5>
            <h5 class="card-subtitle text-body-secondary mb-2 text-success  "><i class="fa-solid fa-phone"></i> {{
                $restaurant->phone_number }}</h5>
            <p class="text-muted  card-subtitle mb-2 text-body-secondary">{{ $restaurant->address }}</p>
            <a href="{{ route('restaurant.show' , ['restaurant' => $restaurant->id]) }}"
                class="btn btn-secondary ">Visit</a>
        </div>
    </div>
</div>