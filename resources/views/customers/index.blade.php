@extends('layouts.admin')

@section('content')
<div class="mt-4">
    <h2>Customer data</h2>
    <div class="table-responsive ">
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th scope="col">Customer ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Profile Image</th>
                    <th scope="col">Eamil</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Latitude</th>
                    <th scope="col">Longitude</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderItems as $orderItem)
                <tr>
                    <th scope="row">{{ $orderItem->order->user_id }}</th>
                    <td>{{ $orderItem->order->user->name }}</td>
                    <td>
                        @if ($orderItem->order->user->image_url && file_exists(public_path('storage/images/' .
                        $orderItem->order->user->image_url)))
                        <img class="rounded-circle " style="width: 60px; height: 60px"
                            src="{{ asset('storage/images/' . $orderItem->order->user->image_url) }}"
                            alt="{{ $orderItem->order->user->name }}">
                        @else
                        <img class="rounded-circle " style="width: 60px; height: 60px"
                            src="{{ asset('images/profile-picture.png') }}" alt="{{ $orderItem->order->user->name }}">
                        @endif
                    </td>
                    <td>{{ $orderItem->order->user->email ? $orderItem->order->user->email : 'no email' }}</td>
                    <td>{{ $orderItem->order->user->phone_number ? $orderItem->order->user->phone_number : '---'}}</td>
                    <td>{{ $orderItem->order->user->latitude ? $orderItem->order->user->latitude : '---' }}</td>
                    <td>{{ $orderItem->order->user->longitude ? $orderItem->order->user->longitude : '---'}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="my-5">
        {{ $orderItems->links() }}
    </div>
</div>
@endsection