<?php $__env->startSection('content'); ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0 overflow-hidden">
                <div class="row g-0">
                    
                    <div class="col-lg-6 d-flex align-items-center bg-light">
                        <img id="shoe-image" src="<?php echo e($shoe->image); ?>" 
                            class="img-fluid w-100 h-100 object-fit-cover" 
                            alt="<?php echo e($shoe->brand->name); ?> - <?php echo e($shoe->model->name); ?>">
                    </div>
                    
                    
                    <div class="col-lg-6">
                        <div class="card-body p-5">
                            <h2 class="card-title fw-bold"><?php echo e($shoe->brand->name); ?> - <?php echo e($shoe->model->name); ?></h2>
                            <p class="text-muted fs-5"><?php echo e($shoe->description ?? 'No hay descripción disponible.'); ?></p>
                            <h3 class="text-primary fw-bold mb-4">€<?php echo e(number_format($shoe->price, 2)); ?></h3>

                            
                            <h5>Seleccionar Color:</h5>
                            <div class="d-flex gap-2 mb-3">
                                <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button class="color-btn btn" data-image="<?php echo e($color->image_url); ?>" style="background-color: <?php echo e($color->hex_code); ?>; width: 30px; height: 30px; border: 1px solid #000;"></button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            
                            
                            <h5>Elige una Talla:</h5>
                            <div class="d-flex gap-2 flex-wrap">
                                <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($shoe->stock > 0): ?>
                                        <button class="btn btn-outline-primary size-btn" data-size-id="<?php echo e($size->id); ?>">
                                            <?php echo e($size->name); ?>

                                        </button>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            
                            <div class="d-grid gap-3 mt-3">
                                <form action="" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="selected_color" id="selected-color" value="">
                                    <input type="hidden" name="selected_size" id="selected-size" value="">
                                    
                                </form>

                                <button onclick="window.location='<?php echo e(route('merchandising.index')); ?>';" class="btn btn-info btn-lg">
                                    Personalizar
                                </button>
                                <button type="submit" class="btn btn-dark btn-lg">
                                        <i class="bi bi-cart-plus"></i> Agregar al carrito
                                </button>
                                <a href="<?php echo e(route('shoes.index')); ?>" class="btn btn-outline-secondary btn-lg">
                                    <i class="bi bi-arrow-left"></i> Volver a la tienda
                                </a>
                            </div>
                        </div>
                    </div>
                </div> 
            </div> 
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        let selectedColorInput = document.getElementById("selected-color");
        let selectedSizeInput = document.getElementById("selected-size");

        // Manejar la selección de colores
        document.querySelectorAll(".color-btn").forEach(button => {
            button.addEventListener("click", function () {
                let newImage = this.getAttribute("data-image");
                document.getElementById("shoe-image").src = newImage;
                selectedColorInput.value = this.style.backgroundColor;
            });
        });

        // Manejar la selección de talla
        document.querySelectorAll(".size-btn").forEach(button => {
            button.addEventListener("click", function () {
                document.querySelectorAll(".size-btn").forEach(btn => btn.classList.remove("active"));
                this.classList.add("active");
                selectedSizeInput.value = this.getAttribute("data-size-id");
            });
        });
    });
</script>

<style>
    /* Estilo por defecto: borde gris, fondo blanco, texto negro */
    .size-btn {
        background-color: #fff; /* Fondo blanco */
        color: #000; /* Texto negro */
        border: 1px solid #ccc; /* Borde gris */
        transition: all 0.3s ease; /* Transición suave */
    }

    /* Al pasar el mouse: borde negro */
    .size-btn:hover {
        border-color: #000; /* Borde negro */

    }

    /* Cuando está seleccionado (activo): borde negro, fondo blanco, texto negro */
    .size-btn.active {
        border-color: #000 !important; /* Borde negro */
        background-color: #fff !important; /* Fondo blanco */
        color: #000 !important; /* Texto negro */
    }
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/julia/Desktop/proyecto2/shop/resources/views/shoes/preview.blade.php ENDPATH**/ ?>