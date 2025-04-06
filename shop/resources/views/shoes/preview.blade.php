@extends('layouts.app')
@section('content')
<div id="alert-container" class="position-fixed top-0 end-0 p-3" style="z-index: 1055;"></div>

<div class="container py-5 mct">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row g-4 align-items-center">
                <div class="col-md-6">
                    <div class="bg-white rounded shadow-sm p-3 position-relative">
                        <img id="shoe-image" src="{{ $shoe->image }}" class="img-fluid w-100 rounded object-fit-cover" alt="{{ $shoe->brand->name }} - {{ $shoe->model->name }}">
                        
                        @if($shoe->stock < 20)
                            <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2">¡Quedan {{$shoe->stock}} unidades!</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="bg-white rounded shadow-sm p-4">
                        <h1 class="mb-3 fw-bold">{{ $shoe->brand->name }} - {{ $shoe->model->name }}</h1>
                        <p class="text-muted">{{ $shoe->description ?? 'No hay descripción disponible.' }}</p>

                        <div id="product-price" class="fs-3 fw-bold text-primary mb-4">
                            @if($shoe->discount > 0)
                                <del class="text-muted">€{{ number_format($shoe->price, 2) }}</del>
                                <span class="text-success">€{{ number_format($shoe->price * (1 - $shoe->discount / 100), 2) }}</span>
                            @else
                                €{{ number_format($shoe->price, 2) }}
                            @endif
                        </div>

                        <div class="mb-3">
                            <h5>Colores disponibles:</h5>
                            <div class="d-flex gap-2">
                                @foreach($colors as $color)
                                    @php
                                        $colorShoe = $color->shoes->first();
                                    @endphp
                                    @if($colorShoe)
                                        <button class="btn border color-btn"
                                                style="background-color: {{ $color->hex_code }}; width: 32px; height: 32px;"
                                                data-target-id="{{ $colorShoe->id }}"
                                                title="{{ $color->name }}">
                                        </button>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5>Tallas disponibles:</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($sizes as $size)
                                    <button class="btn btn-outline-dark size-btn" data-size-id="{{ $size->id }}">
                                        {{ $size->name }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <input type="hidden" id="selected-size" value="">

                        <div class="d-grid gap-2">
                            <button class="btn btn-dark btn-lg add-to-cart" data-id="{{ $shoe->id }}">
                                <i class="bi bi-cart-plus"></i> Agregar al carrito
                            </button>
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="bi bi-arrow-left"></i> Volver a la tienda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const selectedSizeInput = document.getElementById("selected-size");

        document.querySelectorAll(".size-btn").forEach(button => {
            button.addEventListener("click", () => {
                document.querySelectorAll(".size-btn").forEach(btn => btn.classList.remove("active"));
                button.classList.add("active");
                selectedSizeInput.value = button.dataset.sizeId;
            });
        });

        document.querySelectorAll(".color-btn").forEach(button => {
            button.addEventListener("click", () => {
                const targetId = button.dataset.targetId;
                if (targetId) {
                    window.location.href = `/shoes/preview/${targetId}`;
                }
            });
        });
    });
</script>
@endsection
