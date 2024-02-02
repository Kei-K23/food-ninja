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
    @if (session('success'))
    <div class="row justify-content-center">
        <div class="col-12 ">
            <div class='alert alert-success ' role='alert'><i class="fa-regular fa-square-check"></i>
                {{ session('success') }}
            </div>
        </div>
    </div>
    @endif
    @if ($menu->reviews->count())
    <div id="shopping-cart-lists" class="list-group">
        @php
        // Sort the reviews array by created_at in descending order
        $sortedReviews = $menu->reviews->sortByDesc('created_at');
        @endphp
        @foreach ($sortedReviews as $review)
        <div class="list-group-item ">
            <div class="d-flex justify-content-between ">
                <div class="d-flex align-items-center gap-2 w-100  ">
                    @if ($review->user->image_url)
                    <img style="width: 45px; height: 45px;" class="rounded-circle "
                        src="{{ asset('storage/images/' . $review->user->image_url) }}" alt="{{ $review->user->name }}">
                    @else
                    <img style="width: 45px; height: 45px;" class="rounded-circle "
                        src="{{ asset('images/profile-picture.png') }}" alt="{{ $review->user->name }}">
                    @endif
                    <div class="w-100 d-flex justify-content-between align-items-center ">
                        <h5>{{ $review->user->name }}</h5>
                        <h6 class="text-muted">
                            {{ \Carbon\Carbon::parse($review->created_at)->diffForHumans() }}</h6>
                    </div>
                </div>

            </div>

            <p id="{{ 'review-content-' . $review->id }}" class="mt-2 review-content">
                {{ $review->content }}
            </p>
            <!-- Edit Review Form -->
            <form id="{{ 'edit-review-form-' . $review->id }}" class="edit-review-form d-none mt-2 " method="POST">
                @csrf
                @method('PUT')
                <textarea class="form-control" name="content">{{ $review->content }}</textarea>
                <div class="d-flex align-items-center  gap-2 mt-2">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <button type="button" class="btn close-edit-form">Cancel</button>
                </div>
            </form>
            <div id="{{ 'review-actions-btns-' . $review->id }}"
                class="d-flex align-items-center  gap-2 review-actions-btns">
                <button class="btn btn-secondary edit-review-btn" data-review-id="{{ $review->id }}">
                    <i class="fa-solid fa-square-pen"></i>
                </button>
                <form method="POST" action="{{ route('review.destroy', ['review' => $review]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger ">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <p class="text-muted">No review for {{ $menu->name }}.</p>
    @endif

</div>
@endsection

@push('scripts')
<script>
    // jQuery code to toggle edit review form
        $(document).ready(function() {
            $('.edit-review-btn').click(function() {
                // reset other component into their previous state
                $('.edit-review-form').addClass('d-none');
                $('.review-content').removeClass('d-none');
                $('.review-actions-btns').removeClass('d-none');

                // perform on cliked review component
                var reviewId = $(this).data('review-id');
                $('#edit-review-form-' + reviewId).removeClass('d-none');
                $('#review-content-' + reviewId).addClass('d-none');
                $('#review-actions-btns-' + reviewId).addClass('d-none');
            });

            $('.close-edit-form').click(function () {
               // reset other component into their previous state
            $('.edit-review-form').addClass('d-none');
            $('.review-content').removeClass('d-none');
            $('.review-actions-btns').removeClass('d-none');
            });
        });
</script>
@endpush