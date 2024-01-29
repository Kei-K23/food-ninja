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
            <p class="text-muted ">{{ $menu->restaurant->name }}</p>
            <p>
                {{ $menu->description }}
            </p>
        </div>
        <img class="w-100  h-100 rounded-3 shadow-sm" src="{{ asset('images/' . $menu->image_url) }}"
            alt="{{ $menu->name }}">
    </div>

    <h3 class="mt-5">Other popular {{ $menu->category->name }}</h3>
    <div class="owl-carousel owl-theme mt-4 ">
        @foreach ($menus as $menu)
        <div class="card">
            <img class="card-img-top img-thumbnail " src="{{ asset('images/' . $menu->image_url) }}"
                alt="{{ $menu->name }}" style="width: 100%; height: 220px;">
            <div class="card-body">
                <div class="d-flex justify-content-between  align-items-center ">
                    <h5 class="card-title">{{ $menu->name }}</h5>
                    <h5 class="card-title">{{ $menu->price }} $</h5>
                </div>
                <h6 class="card-subtitle mb-2 text-body-secondary ">{{ $menu->restaurant->name }}</h6>
                <p class="card-text truncate-paragraph">
                    {{ $menu->description }}
                </p>
                <a href="#" class="btn btn-primary">Add To Cart</a>
                <a href="{{ route('menu.show' , ['menu' => $menu->id]) }}" class="btn btn-secondary ">See
                    More</a>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection