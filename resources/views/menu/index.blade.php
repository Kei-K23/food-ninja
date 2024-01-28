@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-primary">Menu</h2>
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