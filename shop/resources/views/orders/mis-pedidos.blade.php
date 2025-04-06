@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Mis Pedidos</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info">Aún no has realizado ningún pedido.</div>
    @else
        @foreach($orders as $order)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pedido #{{ $order->id }}</h5>
                    <p class="card-text">Total: €{{ number_format($order->total, 2) }}</p>
                    <p class="card-text">Estado: {{ $order->status }}</p>
                    <h6>Productos:</h6>
                    <ul class="list-group">
                        @foreach($order->shoes as $shoe)
                            <li class="list-group-item d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <strong>{{ $shoe->brand->name }} {{ $shoe->model->name }}</strong><br>
                                    Talla: {{ $shoe->pivot->size ?? '-' }}<br>
                                    Cantidad: {{ $shoe->pivot->quantity }}
                                </div>
                                <div>{{ number_format($shoe->price, 2) }} €</div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection