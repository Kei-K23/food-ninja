@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-primary">Restaurants</h2>
    <div class="row ">
        @foreach ($restaurants as $restaurant)
        <x-restaurant-card :restaurant="$restaurant" />
        @endforeach
    </div>
    <div class="my-5">
        {{ $restaurants->links() }}
    </div>
</div>
@endsection