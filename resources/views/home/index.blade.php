@extends('layouts.app')

@section('content')
<div class="container mt-5 ">
    <div class="d-flex flex-column flex-md-row  align-items-center justify-content-center gap-5 ">
        <div>
            <h3 class="fs-5 fw-lighter">Effciently Connecting People</h3>
            <h1 class="fs-1 text-uppercase ">We Provide Super <span class="text-primary">Fast</span> Deliver
                Service</h1>
            <form class="mt-2">
                <input type="text" class="form-control" name="search" placeholder="Search your foods...">
            </form>
        </div>
        <div>
            <img class="rounded-3 shadow-sm w-100 h-100 "
                src="{{ asset('images/rowan-freeman-clYlmCaQbzY-unsplash.jpg') }}" alt="hero section image">
        </div>
    </div>
    <div class="container mt-5 ">
        <div class="mb-3 w-100 d-flex justify-content-between align-items-center ">
            <h2>
                Popular <span class="text-primary  ">Categories</span>
            </h2>
            <a class="btn btn-secondary" href="{{ route('category') }}" role="button">See All</a>
        </div>
        <div class="row ">
            @foreach ($categories as $category)
            <x-category-card :category="$category" />
            @endforeach
        </div>
    </div>

    <div class="container mt-5 ">
        <div class="mb-3 w-100 d-flex justify-content-between align-items-center ">
            <h2>
                Popular <span class="text-primary  ">Menu</span>
            </h2>
            <a class="btn btn-secondary" href="{{ route('menu') }}" role="button">See All</a>
        </div>
        <div class="row ">
            @foreach ($menus as $menu)
            <x-menu-card :menu="$menu" />
            @endforeach
        </div>
    </div>
</div>
@endsection