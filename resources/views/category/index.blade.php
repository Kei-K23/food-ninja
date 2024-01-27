@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-primary">This is category page</h2>
    <ul>
        @foreach ($categories as $category)
        <li>
            {{ $category->name }}
        </li>
        @endforeach
    </ul>
</div>
@endsection