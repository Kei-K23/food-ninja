<div class="col-6 col-md-4 col-lg-3 my-2 ">
    <div class="card">
        <img class="card-img-top img-thumbnail " src="{{ asset('images/' . $category->image_url) }}"
            alt="{{ $category->name }}" style="width: 100%; height: 150px;">
        <div class="card-body">
            <h5 class="card-title">{{ $category->name }}</h5>
            <a href="{{ route('category.show', ['category' => $category->id]) }}" class="card-link">View</a>
        </div>
    </div>
</div>