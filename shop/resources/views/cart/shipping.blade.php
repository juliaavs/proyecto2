@extends('layouts.app')

@section('content')
    <h2>Introduce tu Dirección de Envío</h2>
    <form action="{{ route('checkout.saveShipping') }}" method="POST">
        @csrf
        <label for="street">Calle:</label>
        <input type="text" name="street" value="{{ old('street', $user->street) }}" required>
        <label for="street_number">Número de Calle:</label>
        <input type="text" name="street_number" value="{{ old('number', $user->number) }}" required>

        <label for="city">Ciudad:</label>
        <input type="text" name="city" value="{{ old('city', $user->city) }}" required>

        <label for="state">Estado/Provincia:</label>
        <input type="text" name="state" value="{{ old('state', $user->state) }}" required>

        <label for="zip_code">Código Postal:</label>
        <input type="text" name="zip_code" value="{{ old('zip_code', $user->zip_code) }}" required>

        <label for="country">País:</label>
        <input type="text" name="country" value="{{ old('country', $user->country) }}" required>

        <button type="submit" class="btn btn-primary">Guardar Dirección</button>
    </form>
@endsection
