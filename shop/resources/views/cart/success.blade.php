@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2>¡Pago exitoso!</h2>
    <p>Gracias por tu compra. Tu pedido será procesado pronto.</p>
    <a href="{{ route('cart.index') }}" class="btn btn-primary">Volver al carrito</a>


    
<a href="#" class="btn btn-dark btn-lg mt-4">
    <i class="bi bi-download"></i> Descargar Factura
</a>


</div>




@endsection