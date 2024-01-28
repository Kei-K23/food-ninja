@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-primary">{{ $menu->name }}</h2>
    <img src="{{ asset('images/' . $menu->image_url) }}" alt="{{ $menu->name }}">
</div>
@endsection