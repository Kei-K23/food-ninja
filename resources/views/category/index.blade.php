@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-primary">Category</h2>
    <div class="row ">
        @foreach ($categories as $category)
        <x-category-card :category="$category" />
        @endforeach
    </div>
</div>
@endsection