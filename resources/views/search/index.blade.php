@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-primary">Search term <b>"{{ $search }}"</b></h2>
    <form class="mt-3 my-5 " action="{{ route('search') }}">
        <input type="text" class="form-control" name="term" placeholder="Search your foods...">
    </form>
    @if ($menus->count() > 0)
    <div class="row ">
        @foreach ($menus as $menu)
        <x-menu-card :menu="$menu" />
        @endforeach
    </div>
    <div class="my-5">
        {{ $menus->links() }}
    </div>
    @else
    <h6>No results found.</h6>
    @endif

</div>
@endsection