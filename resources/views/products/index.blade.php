@extends('layouts.admin')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center mt-3 mb-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Add new product
                </div>
                @if (session('success'))
                <div class='alert alert-success text-center ' role='alert'><i class="fa-regular fa-square-check"></i>
                    {{ session('success') }}
                </div>
                @endif
                <div class="card-body">
                    <form action="{{ route('products.store') }}" class="w-px-500 p-3 p-md-3" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" placeholder="Menu name" required>
                                @error('name')
                                <span class="text-danger  ">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="description" placeholder="Description"
                                    required></textarea>
                                @error('description')
                                <span class="text-danger  ">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Price</label>
                            <div class="col-sm-9">
                                <input id="longitude-input" type="number" class="form-control" name="price"
                                    placeholder="Price" required />
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
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
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

                        <div class="row mb-3">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-success ">
                                    Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <h3>Products</h3>
    <div class="row ">
        @foreach ($menus as $menu)
        <x-menu-card :menu="$menu" :showAction="false" />
        @endforeach
    </div>
    <div class="my-5">
        {{ $menus->links() }}
    </div>
</div>
@endsection