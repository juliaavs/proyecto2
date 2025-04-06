<?php $__env->startSection('content'); ?>
<div id="alert-container" class="position-fixed top-0 end-0 p-3" style="z-index: 1055;"></div>

<div class="container py-5 mct">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row g-4 align-items-center">
                <div class="col-md-6">
                    <div class="bg-white rounded shadow-sm p-3 position-relative">
                        <img id="shoe-image" src="<?php echo e($shoe->image); ?>" class="img-fluid w-100 rounded object-fit-cover" alt="<?php echo e($shoe->brand->name); ?> - <?php echo e($shoe->model->name); ?>">
                        
                        <?php if($shoe->stock < 20): ?>
                            <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2">¡Quedan <?php echo e($shoe->stock); ?> unidades!</span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="bg-white rounded shadow-sm p-4">
                        <h1 class="mb-3 fw-bold"><?php echo e($shoe->brand->name); ?> - <?php echo e($shoe->model->name); ?></h1>
                        <p class="text-muted"><?php echo e($shoe->description ?? 'No hay descripción disponible.'); ?></p>

                        <div id="product-price" class="fs-3 fw-bold text-primary mb-4">
                            <?php if($shoe->discount > 0): ?>
                                <del class="text-muted">€<?php echo e(number_format($shoe->price, 2)); ?></del>
                                <span class="text-success">€<?php echo e(number_format($shoe->price * (1 - $shoe->discount / 100), 2)); ?></span>
                            <?php else: ?>
                                €<?php echo e(number_format($shoe->price, 2)); ?>

                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <h5>Colores disponibles:</h5>
                            <div class="d-flex gap-2">
                                <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $colorShoe = $color->shoes->first();
                                    ?>
                                    <?php if($colorShoe): ?>
                                        <button class="btn border color-btn"
                                                style="background-color: <?php echo e($color->hex_code); ?>; width: 32px; height: 32px;"
                                                data-target-id="<?php echo e($colorShoe->id); ?>"
                                                title="<?php echo e($color->name); ?>">
                                        </button>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5>Tallas disponibles:</h5>
                            <div class="d-flex flex-wrap gap-2">
                                <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button class="btn btn-outline-dark size-btn" data-size-id="<?php echo e($size->id); ?>">
                                        <?php echo e($size->name); ?>

                                    </button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <input type="hidden" id="selected-size" value="">

                        <div class="d-grid gap-2">
                            <button class="btn btn-dark btn-lg add-to-cart" data-id="<?php echo e($shoe->id); ?>">
                                <i class="bi bi-cart-plus"></i> Agregar al carrito
                            </button>
                            <a href="<?php echo e(route('home')); ?>" class="btn btn-outline-secondary btn-lg">
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/julia/Desktop/proyecto2/shop/resources/views/shoes/preview.blade.php ENDPATH**/ ?>