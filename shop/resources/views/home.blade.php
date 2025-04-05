@extends('layouts.app')

@section('content')
    <div class="container mct">
        <video class="custom-video" autoplay loop muted>
            <source src="{{ asset('videos/videoHome.mp4') }}" type="video/mp4">
            Tu navegador no soporta videos.
        </video>
        <br>
        <p>Eleva tu juego y rompe tus límites con nuestro calzado deportivo. ¡Da el salto hoy y vive la experiencia del máximo rendimiento!</p>
        <button class="btn btn-secondary">Ir a la sección deportiva</button>
        <br><br>

        <h4>Últimas Novedades</h4>
        <div class="container mt-4">
            <!-- Pantallas grandes -->
            <div class="row image-container d-none d-md-flex">
                @foreach ($ultimosProductos as $producto)
                    <div class="col-6 col-md-3 position-relative text-center">
                        <a href="{{ route('shoes.preview', $producto->id) }}">
                            <img src="{{ $producto->image }}" alt="{{ $producto->model->name }}" class="img-fluid mb-2">
                        </a>
                        <div>
                            <strong>{{ $producto->brand->name }} {{ $producto->model->name }}</strong><br>
                            @if ($producto->discount > 0)
                                <del>€{{ number_format($producto->price, 2) }}</del>
                                <span class="text-danger">€{{ number_format($producto->price * (1 - $producto->discount / 100), 2) }}</span>
                            @else
                                €{{ number_format($producto->price, 2) }}
                            @endif
                        </div>
                        @if ($producto->discount > 0)
                            <span class="badge bg-danger position-absolute top-0 start-0 m-2">-{{ $producto->discount }}%</span>
                        @endif
                        @if ($producto->stock < 20)
                            <span class="badge bg-warning text-dark position-absolute bottom-0 start-0 m-2">¡Quedan {{ $producto->stock }}!</span>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Móviles -->
            <div class="image-slider d-flex d-md-none overflow-auto">
                @foreach ($ultimosProductos as $producto)
                    <a href="{{ route('shoes.preview', $producto->id) }}" class="me-2 text-center" style="flex: 0 0 auto;">
                        <img src="{{ $producto->image }}" alt="{{ $producto->model->name }}" width="100">
                        <div style="font-size: 0.9em;">
                            {{ $producto->brand->name }} {{ $producto->model->name }}<br>
                            @if ($producto->discount > 0)
                                <del>€{{ number_format($producto->price, 2) }}</del><br>
                                <span class="text-danger">€{{ number_format($producto->price * (1 - $producto->discount / 100), 2) }}</span>
                            @else
                                €{{ number_format($producto->price, 2) }}
                            @endif
                            @if ($producto->stock < 20)
                                <div class="text-warning">¡Quedan {{ $producto->stock }}!</div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <br><br>
        <h4>Nuestros Destacados</h4>
        <div class="container mt-4">
            <!-- Pantallas grandes -->
            <div class="row image-container d-none d-md-flex">
                @foreach ($productosDestacados as $producto)
                    <div class="col-6 col-md-3 position-relative text-center">
                        <a href="{{ route('shoes.preview', $producto->id) }}">
                            <img src="{{ $producto->image }}" alt="{{ $producto->model->name }}" class="img-fluid mb-2">
                        </a>
                        <div>
                            <strong>{{ $producto->brand->name }} {{ $producto->model->name }}</strong><br>
                            @if ($producto->discount > 0)
                                <del>€{{ number_format($producto->price, 2) }}</del>
                                <span class="text-danger">€{{ number_format($producto->price * (1 - $producto->discount / 100), 2) }}</span>
                            @else
                                €{{ number_format($producto->price, 2) }}
                            @endif
                        </div>
                        <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2">Destacado</span>
                        @if ($producto->discount > 0)
                            <span class="badge bg-danger position-absolute top-0 end-0 m-2">-{{ $producto->discount }}%</span>
                        @endif
                        @if ($producto->stock < 20)
                            <span class="badge bg-warning text-dark position-absolute bottom-0 start-0 m-2">¡Quedan {{ $producto->stock }}!</span>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Móviles -->
            <div class="image-slider d-flex d-md-none overflow-auto">
                @foreach ($productosDestacados as $producto)
                    <a href="{{ route('shoes.preview', $producto->id) }}" class="me-2 text-center" style="flex: 0 0 auto;">
                        <img src="{{ $producto->image }}" alt="{{ $producto->model->name }}" width="100">
                        <div style="font-size: 0.9em;">
                            {{ $producto->brand->name }} {{ $producto->model->name }}<br>
                            @if ($producto->discount > 0)
                                <del>€{{ number_format($producto->price, 2) }}</del><br>
                                <span class="text-danger">€{{ number_format($producto->price * (1 - $producto->discount / 100), 2) }}</span>
                            @else
                                €{{ number_format($producto->price, 2) }}
                            @endif
                            @if ($producto->stock < 20)
                                <div class="text-warning">¡Quedan {{ $producto->stock }}!</div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Banner de Bike -->
        <div class="container mt-4 text-center">
            <img src="https://postersbase.com/cdn/shop/articles/kanye-west_6a1e735a-5683-4da6-ae1d-2562f2c25af6.png?v=1716304046" alt="Banner de Bicicletas" class="img-fluid mb-2" style="width: 100% important; border-radius: 0px;">
        </div>
    </div>
@endsection
