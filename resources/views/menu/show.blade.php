@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex flex-column flex-md-row  align-items-start  justify-content-center gap-5">
        <div>
            <div class="d-flex align-items-center  justify-content-between ">
                <h2 class="text-primary">{{ $menu->name }}</h2>
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
</div>
@endsection