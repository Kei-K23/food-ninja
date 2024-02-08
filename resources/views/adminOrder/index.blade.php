@extends('layouts.admin')

@section('content')
<div class="mt-4">
    <h2>Orders data</h2>
    <div class="table-responsive ">
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th scope="col">Order Items ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Order by</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderItems as $orderItem)
                <tr>
                    <th scope="row">{{ $orderItem->id }}</th>
                    <td>
                        @if ($orderItem->menu->image_url && file_exists(public_path('images/' .
                        $orderItem->menu->image_url)))
                        <img class="rounded-circle " style="width: 70px; height: 70px"
                            src="{{ asset('images/' . $orderItem->menu->image_url) }}"
                            alt="{{ $orderItem->menu->name }}">
                        @elseif ($orderItem->menu->image_url && file_exists(public_path('storage/images/' .
                        $orderItem->menu->image_url)))
                        <img class="rounded-circle " style="width: 70px; height: 70px"
                            src="{{ asset('storage/images/' . $orderItem->menu->image_url) }}"
                            alt="{{ $orderItem->menu->name }}">
                        @else
                        <img class="rounded-circle " style="width: 70px; height: 70px"
                            src="{{ asset('images/placeholder.png') }}" alt="{{ $orderItem->menu->name }}">
                        @endif
                    </td>
                    <td>{{ $orderItem->menu->name }}</td>
                    <td>{{ $orderItem->order->user->name }}</td>
                    <td>{{ $orderItem->unit_price }} $</td>
                    <td>{{ $orderItem->quantity }}</td>
                    <td>
                        <form action="{{ route('orderItem.destroy' , ['orderItem' => $orderItem->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger ">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </td>
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