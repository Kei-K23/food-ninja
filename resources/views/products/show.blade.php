@extends('layouts.admin')

@section('content')
<div class="container mt-5 ">
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
        </div>
        <div>
            @if ($menu->image_url && file_exists(public_path('images/' .
            $menu->image_url)))
            <img class="w-100 h-100 rounded-3 shadow-sm" src="{{ asset('images/' . $menu->image_url) }}"
                alt="{{ $menu->name }}">
            @elseif ($menu->image_url && file_exists(public_path('storage/images/' .
            $menu->image_url)))
            <img class="w-100 h-100 rounded-3 shadow-sm" src="{{ asset('storage/images/' . $menu->image_url) }}"
                alt="{{ $menu->name }}">
            @else
            <img class="w-100 h-100 rounded-3 shadow-sm" src="{{ asset('images/placeholder.png') }}"
                alt="{{ $menu->name }}">
            @endif
        </div>
    </div>
</div>
@endsection