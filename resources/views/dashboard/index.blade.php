@extends('layouts.admin')

@section('content')
<div>
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard for {{ $user->restaurant->name }}</h1>
        <h3>{{ $user->name }}</h3>
    </div>

    <canvas class="my-4 w-100" id="lineChart" width="900" height="380"></canvas>

    <h2>Order items</h2>
    <div class="table-responsive ">
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th scope="col">Order Items ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderItems as $orderItem)
                <tr>
                    <th scope="row">{{ $orderItem->id }}</th>
                    <td><img class="rounded-circle " style="width: 70px; height: 70px"
                            src="{{ asset('images/' . $orderItem->menu->image_url) }}"
                            alt="{{ $orderItem->menu->name }}">
                    </td>
                    <td>{{ $orderItem->menu->name }}</td>
                    <td>{{ $orderItem->unit_price }}</td>
                    <td>{{ $orderItem->quantity }}</td>
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


@push('scripts')
<script>
    const ctx = document.getElementById('lineChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($chartData['labels']),
                datasets: [{
                    data: @json($chartData['data']),
                    lineTension: 0,
                    backgroundColor: "transparent",
                    borderColor: "#007bff",
                    borderWidth: 2,
                    pointBackgroundColor: "#007bff",
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        boxPadding: 3,
                    },
                },
            }
        });


</script>
@endpush