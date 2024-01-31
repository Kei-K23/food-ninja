@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $user->name . "'s" . ' Dashboard' }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center gap-5">
                        <div>
                            @if ($user->image_url)
                            <div class="position-relative " style="width: 100px; height: 100px;">
                                <img class="w-100  h-100 rounded-circle bg-secondary"
                                    src="{{ asset('storage/images/' . $user->image_url) }}" alt="{{ $user->name }}">
                                <form action="{{ route('profile.removeProfile', ['profile' => $user]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button style="cursor: pointer; top: 1.1rem"
                                        class="position-absolute start-100 translate-middle p-2  d-flex  justify-content-center  align-items-center bg-danger border border-light rounded-circle"
                                        type="submit">
                                        <i style="font-size: 11px" class="text-white fw-semibold  fa-solid fa-x"></i>
                                    </button>
                                </form>

                            </div>
                            @else
                            <div style="width: 100px; height: 100px;"
                                class="bg-secondary rounded-circle d-flex align-items-center justify-content-center ">
                                <i style="font-size: 2.5rem" class="text-white  fa-solid fa-user"></i>
                            </div>
                            @endif
                        </div>
                        <div class="flex-grow-1 ">
                            <h2>{{ $user->name }}</h2>
                            <p>{{ $user->email }}</p>
                            @if ($user->phone_number)
                            <p class="text-muted  ">
                                <i class="fa-solid fa-phone"></i>
                                {{ $user->phone_number }}
                            </p>
                            @endif
                            @if ($user->address)
                            <p class="text-muted ">
                                <i class="fa-solid fa-location-dot"></i>
                                {{ $user->address }}
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-3 ">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ 'Edit ' . $user->name . "'s" . ' profile' }}
                </div>
                {{-- @if ($errors->any())
                {!! implode('', $errors->all("<div class='alert alert-danger ' role='alert'><i
                        class='fa-solid fa-circle-exclamation'></i> :message</div>")) !!}
                @endif --}}
                @if (session('success'))
                <div class='alert alert-success ' role='alert'><i class="fa-regular fa-square-check"></i>
                    {{ session('success') }}
                </div>
                @endif
                <div class="card-body">
                    <form class="w-px-500 p-3 p-md-3" action="{{ route('profile.update', ['profile' => $user]) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control  " name="name" placeholder="Name"
                                    value="{{ $user->name }}" aria-describedby="feedback-name">
                                @error('name')
                                <span class="text-danger  ">*{{ $message }}</span>
                                @enderror

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Phone</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="phone_number" placeholder="Phone"
                                    value="{{ $user->phone_number }}">
                                @error('phone_number')
                                <span class="text-danger  ">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Longitude</label>
                            <div class="col-sm-9">
                                <input id="longitude-input" type="text" readonly class="form-control" name="longitude"
                                    placeholder="Longitude" value="{{ $user->longitude }}" />
                                @error('longitude')
                                <span class="text-danger  ">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Latitude</label>
                            <div class="col-sm-9">
                                <input id="latitude-input" type="text" readonly class="form-control" name="latitude"
                                    placeholder="Latitude" value="{{ $user->latitude }}" />
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

    <div class="row justify-content-center mt-3 ">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ "Edit account's " . $user->name }}
                </div>

                <div class="card-body">
                    <form class="w-px-500 p-3 p-md-3"
                        action="{{ route('profile.updatePassword', ['profile' => $user]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password" placeholder="New password"
                                    value="{{ old('password') }}" required>
                                @error('password')
                                <span class="text-danger  ">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Confirm Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="confirm_password"
                                    placeholder="Confirm password" required>
                                @error('confirm_password')
                                <span class="text-danger  ">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-success ">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="row justify-content-center mt-3 ">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ 'Delete ' . $user->name . "'s Account" }}
                </div>
                <div class="card-body">
                    <h3 class="card-title text-danger fw-light ">! This will perminally delete all relative data of
                        this user!</h3>
                    <form class="w-px-500 p-3 p-md-3" action="{{ route('profile.destroy') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <div class="row mb-3">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-danger  "><i class="fa-solid fa-trash-can"></i>
                                    Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-3 ">
        <div class="col-md-8">
            <div id='map' class='map'></div>
        </div>
    </div>
</div>
@endsection