
@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <h2 class="mb-4">Finalizar Compra</h2>
        <div class="row">
            <div class="col-md-8">
                <h4 class="mb-3">Detalles de Envío</h4>
                <form action="{{ route('checkout.saveShipping') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="apellido">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="ciudad">Ciudad</label>
                            <input type="text" class="form-control" id="ciudad" name="ciudad" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="codigo_postal">Código Postal</label>
                            <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="pais">País</label>
                            <select class="form-select" id="pais" name="pais" required>
                                <option value="">Selecciona...</option>
                                <option value="España">España</option>
                                <option value="México">México</option>
                                <option value="Argentina">Argentina</option>
                            </select>
                        </div>
                    </div>
                 
                </form>
                    <!-- Botón para continuar con el pago -->
                    <form action="{{ route('checkout.payment') }}" method="GET">
                        <button type="submit">Continuar con el pago</button>
                    </form>
            </div>
            <div class="col-md-4">
                <h4 class="mb-3">Resumen del Pedido pedido</h4>
                <ul class="list-group mb-3">
                    @foreach($cartItems as $item)
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">{{ $item->shoe->name }}</h6>
                                <small class="text-muted">Cantidad: {{ $item->quantity }}</small>
                            </div>
                            <span class="text-muted">{{ $item->shoe->price * $item->quantity }}€</span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between">

                        <span>Total</span>
                        <p>Total: {{ $item->shoe->price * $item->quantity }}€</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @endsection
