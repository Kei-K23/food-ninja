@extends('layouts.admin')

@section('content')
<div class="container mt-5 ">
    <div class="d-flex flex-column flex-md-row  align-items-start  justify-content-center gap-5">
        <div class="flex-grow-1">
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
            <div class="row ">
                <form class="col-12 col-md-8 col-lg-6" action="{{ route('products.destroy', ['menu' => $menu]) }}"
                    method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-100 btn btn-danger  "><i class="fa-solid fa-trash"></i>
                        Delete</button>
                </form>
            </div>
        </div>
        <div>
            @if ($menu->image_url && file_exists(public_path('images/' .
            $menu->image_url)))
            <img style="height: 250px; width: 250px" class=" rounded-3 shadow-sm"
                src="{{ asset('images/' . $menu->image_url) }}" alt="{{ $menu->name }}">
            @elseif ($menu->image_url && file_exists(public_path('storage/images/' .
            $menu->image_url)))
            <img style="height: 250px; width: 250px" class=" rounded-3 shadow-sm"
                src="{{ asset('storage/images/' . $menu->image_url) }}" alt="{{ $menu->name }}">
            @else
            <img style="height: 250px; width: 250px" class=" rounded-3 shadow-sm"
                src="{{ asset('images/placeholder.png') }}" alt="{{ $menu->name }}">
            @endif
        </div>
    </div>

    <div class="row justify-content-center mt-3 mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Edit {{ $menu->name }}
                </div>
                @if (session('success'))
                <div class='alert alert-success text-center ' role='alert'><i class="fa-regular fa-square-check"></i>
                    {{ session('success') }}
                </div>
                @endif
                <div class="card-body">
                    <form action="{{route('products.update', ['menu' => $menu])}}" class="w-px-500 p-3 p-md-3"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input value="{{ $menu->name }}" type="text" class="form-control" name="name"
                                    placeholder="Menu name" required>
                                @error('name')
                                <span class="text-danger  ">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="description" placeholder="Description"
                                    required>{{ $menu->description }}"</textarea>
                                @error('description')
                                <span class="text-danger  ">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Price</label>
                            <div class="col-sm-9">
                                <input value="{{ $menu->price }}" id="longitude-input" type="number"
                                    class="form-control" name="price" placeholder="Price" required />
                                @error('price')
                                <span class="text-danger  ">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Latitude</label>
                            <div class="col-sm-9">
                                <select name="category_id" required class="form-select">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $menu->category_id == $category->id ?
                                        'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach

                                </select>
                                @error('latitude')
                                <span class="text-danger  ">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Menu Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="image_url">
                                @error('image_url')
                                <span class="text-danger  ">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden" name="restaurant_id" value="{{$restaurantId}}" />

                        <div class="d-flex flex-column flex-sm-row  gap-3  ">
                            <div>
                                <button type="submit" class="w-100 btn btn-success "><i
                                        class="fa-solid fa-pen-to-square"></i>
                                    Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection