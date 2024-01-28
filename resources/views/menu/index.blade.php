@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-primary">This is menu page</h2>
    <ul>
        @foreach ($menus as $menu)
        <li>
            {{ $menu->restaurant->name }}
        </li>
        @endforeach
    </ul>
</div>
@endsection