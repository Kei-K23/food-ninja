@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex flex-column flex-md-row  align-items-start  justify-content-center gap-5">
        <div>
            <div class="d-flex align-items-center  justify-content-between ">
                <div class="d-flex align-items-center gap-2 ">
                    <h2 class="text-primary">{{ $menu->name }}</h2>
                    <span class="text-muted ">({{ $menu->category->name }})</span>
                </div>
                <h2 class="text-success ">{{ $menu->price }} $</h2>
            </div>
            <a href="{{ route('restaurant.show', ['restaurant' => $menu->restaurant->id]) }}"
                class="card-subtitle mb-2 text-body-secondary text-truncate ">{{ $menu->restaurant->name }}</a>
            <p class="mt-3">
                {{ $menu->description }}
            </p>
            <button class="btn btn-primary add-to-cart-btn" data-menu-id="{{ $menu->id }}">
                <i class="fa-solid fa-cart-shopping"></i>
                Add to Cart</button>
        </div>
        <div>
            <img class="w-100  h-100 rounded-3 shadow-sm" src="{{ asset('images/' . $menu->image_url) }}"
                alt="{{ $menu->name }}">
        </div>
    </div>

    <h3 class="mt-5">Other popular {{ $menu->category->name }}</h3>
    <div class="owl-carousel owl-theme mt-4 ">
        @foreach ($menus as $otherMenu)
        <div class="card">
            <img class="card-img-top img-thumbnail " src="{{ asset('images/' . $otherMenu->image_url) }}"
                alt="{{ $otherMenu->name }}" style="width: 100%; height: 220px;">
            <div class="card-body">
                <div class="d-flex justify-content-between  align-items-center ">
                    <h5 class="card-title">{{ $otherMenu->name }}</h5>
                    <h5 class="card-title">{{ $otherMenu->price }} $</h5>
                </div>
                <h6 class="card-subtitle mb-2 text-body-secondary ">{{ $otherMenu->restaurant->name }}</h6>
                <p class="card-text truncate-paragraph">
                    {{ $otherMenu->description }}
                </p>
                <a href="#" class="btn btn-primary">Add To Cart</a>
                <a href="{{ route('menu.show', ['menu' => $otherMenu->id]) }}" class="btn btn-secondary ">See
                    More</a>
            </div>
        </div>
        @endforeach
    </div>

    <h4 class="mt-5">Reviews</h4>
    <form method="POST" class="mt-2 mb-4 " action="{{ route('review.store') }}">
        @csrf
        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
        <textarea class="form-control" name="content" placeholder="Review about the food..."></textarea>
        <button type="submit" class="mt-2 btn btn-primary ">Review</button>
    </form>
    @if ($menu->reviews->count())
    <div id="shopping-cart-lists" class="list-group">
        @php
        // Sort the reviews array by created_at in descending order
        $sortedReviews = $menu->reviews->sortByDesc('created_at');
        @endphp
        @foreach ($sortedReviews as $review)
        <div class="list-group-item ">
            <div class="d-flex justify-content-between ">
                <div class="d-flex align-items-center gap-2 ">
                    @if ($review->user->image_url)
                    <img style="width: 45px; height: 45px;" class="rounded-circle "
                        src="{{ asset('storage/images/' . $review->user->image_url) }}" alt="{{ $review->user->name }}">
                    @else
                    <img style="width: 45px; height: 45px;" class="rounded-circle "
                        src="{{ asset('images/profile-picture.png') }}" alt="{{ $review->user->name }}">
                    @endif
                    <h5>{{ $review->user->name }}</h5>
                </div>
                <h6 class="text-muted">{{ \Carbon\Carbon::parse($review->created_at)->diffForHumans()
                    }}</h6>
            </div>
            <p class="mt-2">
                {{ $review->content }}
            </p>
        </div>
        @endforeach
    </div>
    @else
    <p class="text-muted">No review for {{ $menu->name }}.</p>
    @endif

</div>
@endsection