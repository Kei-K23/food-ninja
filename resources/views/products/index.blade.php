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
                <div class='alert alert-success ' role='alert'><i class="fa-regular fa-square-check"></i>
                    {{ session('success') }}
                </div>
                @endif
                <div class="card-body">
                    <form class="w-px-500 p-3 p-md-3" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control  " name="name" placeholder="Name">
                                @error('name')
                                <span class="text-danger  ">*{{ $message }}</span>
                                @enderror

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Phone</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="phone_number" placeholder="Phone">
                                @error('phone_number')
                                <span class="text-danger  ">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Longitude</label>
                            <div class="col-sm-9">
                                <input id="longitude-input" type="text" readonly class="form-control" name="longitude"
                                    placeholder="Longitude" />
                                @error('longitude')
                                <span class="text-danger  ">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Latitude</label>
                            <div class="col-sm-9">
                                <input id="latitude-input" type="text" readonly class="form-control" name="latitude"
                                    placeholder="Latitude" />
                                @error('latitude')
                                <span class="text-danger  ">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Profile Picture</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="image_url">
                                @error('image_url')
                                <span class="text-danger  ">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-success "><i class="fa-solid fa-pen-to-square"></i>
                                    Edit</button>
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