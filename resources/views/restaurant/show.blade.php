@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex flex-column flex-md-row  align-items-start  justify-content-center gap-5">
        <div>
            <div class="d-flex align-items-center  justify-content-between ">
                <h2 class="text-primary">{{ $restaurant->name }}</h2>
            </div>
            <p>
                {{ $restaurant->phone_number }}
            </p>
            <p class="text-muted ">{{ $restaurant->address }}</p>
        </div>
        <div>
            <img class="w-100  h-100 rounded-3 shadow-sm" src="{{ asset('images/' . $restaurant->image_url) }}"
                alt="{{ $restaurant->name }}">
        </div>
    </div>

    <h2 class="text-center my-5"><span class="text-primary">{{ $restaurant->name }}</span>'s menu</h2>

    <div class="row ">
        @foreach ($menus as $menu)
        <x-menu-card :menu="$menu" />
        @endforeach
    </div>
    <div class="my-5">
        {{ $menus->links() }}
    </div>

</div>
@endsection