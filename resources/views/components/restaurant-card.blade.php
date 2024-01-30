{{-- <div class="col-12 col-md-6 col-lg-4 my-2 ">
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
</div> --}}

<div class="col-12 col-md-6 col-lg-4 my-2">
    <div class="card h-100 d-flex flex-column">
        <img class="card-img-top img-thumbnail" src="{{ asset('images/' . $restaurant->image_url) }}"
            alt="{{ $restaurant->name }}" style="width: 100%; height: 220px;">
        <div class="card-body d-flex flex-column">
            <h5 class="card-title mb-3">{{ $restaurant->name }}</h5>
            <h5 class="card-subtitle text-body-secondary mb-2 text-success"><i class="fa-solid fa-phone"></i>{{
                $restaurant->phone_number }}</h5>
            <p class="text-muted card-subtitle mb-2 text-body-secondary flex-grow-1">{{ $restaurant->address }}</p>
            <a href="{{ route('restaurant.show' , ['restaurant' => $restaurant->id]) }}"
                class="btn btn-secondary align-self-start">Visit</a>
        </div>
    </div>
</div>