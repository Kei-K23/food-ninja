@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-center gap-5 ">
        <div>
            <h3 class="fs-5 fw-lighter">Effciently Connecting People</h3>
            <h1 class="fs-1 text-uppercase ">We Provide Super <span class="text-danger">Fast</span> Deliver
                Service</h1>
            <form>
                <input type="text" class="form-control" name="search" placeholder="Search your foods...">
            </form>
        </div>
        <div>
            <img class="rounded-3 shadow-sm " src="{{ asset('images/rowan-freeman-clYlmCaQbzY-unsplash.jpg') }}"
                alt="hero section image">
        </div>
    </div>
</div>
@endsection