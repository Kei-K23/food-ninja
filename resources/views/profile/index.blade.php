@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ ( $user->name . "'s" . ' Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center gap-5">
                        <div>
                            @if ($user->image_url)
                            <img style="width: 100px; height: 100px;"
                                src="{{ asset('storage/images/'.$user->image_url) }}" alt="{{ $user->name }}">
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
                                {{$user->phone_number}}
                            </p>
                            @endif
                            @if ($user->address)
                            <p class="text-muted ">
                                <i class="fa-solid fa-location-dot"></i>
                                {{$user->address}}
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ ( 'Edit ' . $user->name . "'s" . ' profile') }}
                </div>
                @if($errors->any())
                {!! implode('', $errors->all('<div>:message</div>')) !!}
                @endif
                <div class="card-body">
                    <form class="w-px-500 p-3 p-md-3" action="{{ route('profile.update' , ['profile' => $user]) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" placeholder="Name" @error('name')
                                    is-invalid @enderror value="{{ $user->name }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Phone</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="phone_number" placeholder="Phone"
                                    @error('phone_number') is-invalid @enderror value="{{ $user->phone_number }}">
                                @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="address" placeholder="Address" @error('address')
                                    is-invalid rows="3" @enderror>{{ $user->address }}</textarea>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Profile Picture</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="image_url" @error('image_url') is-invalid
                                    @enderror>
                            </div>
                            @error('image_url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-success ">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection