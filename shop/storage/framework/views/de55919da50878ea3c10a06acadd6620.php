

<?php $__env->startSection('content'); ?>
    <div class="container">

        <video class="custom-video" autoplay loop muted>
            <source src="<?php echo e(asset('videos/videoHome.mp4')); ?>" type="video/mp4">
            Tu navegador no soporta videos.
        </video>
        <br>
        <p>Eleva tu juego y rompe tus límites con nuestro calzado deportivo. ¡Da el salto hoy y vive la experiencia del máximo rendimiento!</p>
        <button class="btn btn-secondary">Ir a la sección deportiva</button>
        <br>
        <br>
        
        <h4>Últimas Novedades</h4>

<div class="container mt-4">
    <!-- Pantallas grandes -->
    <div class="row image-container d-none d-md-flex">
        <?php $__currentLoopData = $ultimosProductos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6 col-md-3 position-relative text-center">
                <a href="<?php echo e(route('shoes.preview', $producto->id)); ?>">
                    <img src="<?php echo e($producto->image); ?>" alt="<?php echo e($producto->model->name); ?>" class="img-fluid mb-2">
                </a>
                <div>
                    <strong><?php echo e($producto->brand->name); ?> <?php echo e($producto->model->name); ?></strong><br>
                    <?php if($producto->discount > 0): ?>
                        <del>€<?php echo e(number_format($producto->price, 2)); ?></del>
                        <span class="text-danger">€<?php echo e(number_format($producto->price * (1 - $producto->discount / 100), 2)); ?></span>
                    <?php else: ?>
                        €<?php echo e(number_format($producto->price, 2)); ?>

                    <?php endif; ?>
                </div>
                <?php if($producto->discount > 0): ?>
                    <span class="badge bg-danger position-absolute top-0 start-0 m-2">-<?php echo e($producto->discount); ?>%</span>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Móviles -->
    <div class="image-slider d-flex d-md-none overflow-auto">
        <?php $__currentLoopData = $ultimosProductos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('shoes.preview', $producto->id)); ?>" class="me-2 text-center" style="flex: 0 0 auto;">
                <img src="<?php echo e($producto->image); ?>" alt="<?php echo e($producto->model->name); ?>" width="100">
                <div style="font-size: 0.9em;">
                    <?php echo e($producto->brand->name); ?> <?php echo e($producto->model->name); ?><br>
                    <?php if($producto->discount > 0): ?>
                        <del>€<?php echo e(number_format($producto->price, 2)); ?></del><br>
                        <span class="text-danger">€<?php echo e(number_format($producto->price * (1 - $producto->discount / 100), 2)); ?></span>
                    <?php else: ?>
                        €<?php echo e(number_format($producto->price, 2)); ?>

                    <?php endif; ?>
                </div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<br><br>
<h4>Nuestros Destacados</h4>

<div class="container mt-4">
    <!-- Pantallas grandes -->
    <div class="row image-container d-none d-md-flex">
        <?php $__currentLoopData = $productosDestacados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6 col-md-3 position-relative text-center">
                <a href="<?php echo e(route('shoes.preview', $producto->id)); ?>">
                    <img src="<?php echo e($producto->image); ?>" alt="<?php echo e($producto->model->name); ?>" class="img-fluid mb-2">
                </a>
                <div>
                    <strong><?php echo e($producto->brand->name); ?> <?php echo e($producto->model->name); ?></strong><br>
                    <?php if($producto->discount > 0): ?>
                        <del>€<?php echo e(number_format($producto->price, 2)); ?></del>
                        <span class="text-danger">€<?php echo e(number_format($producto->price * (1 - $producto->discount / 100), 2)); ?></span>
                    <?php else: ?>
                        €<?php echo e(number_format($producto->price, 2)); ?>

                    <?php endif; ?>
                </div>
                <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2">Destacado</span>
                <?php if($producto->discount > 0): ?>
                    <span class="badge bg-danger position-absolute top-0 end-0 m-2">-<?php echo e($producto->discount); ?>%</span>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Móviles -->
    <div class="image-slider d-flex d-md-none overflow-auto">
        <?php $__currentLoopData = $productosDestacados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('shoes.preview', $producto->id)); ?>" class="me-2 text-center" style="flex: 0 0 auto;">
                <img src="<?php echo e($producto->image); ?>" alt="<?php echo e($producto->model->name); ?>" width="100">
                <div style="font-size: 0.9em;">
                    <?php echo e($producto->brand->name); ?> <?php echo e($producto->model->name); ?><br>
                    <?php if($producto->discount > 0): ?>
                        <del>€<?php echo e(number_format($producto->price, 2)); ?></del><br>
                        <span class="text-danger">€<?php echo e(number_format($producto->price * (1 - $producto->discount / 100), 2)); ?></span>
                    <?php else: ?>
                        €<?php echo e(number_format($producto->price, 2)); ?>

                    <?php endif; ?>
                </div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<!-- Banner de Bike -->
<div class="container mt-4 text-center">
    <img src="https://postersbase.com/cdn/shop/articles/kanye-west_6a1e735a-5683-4da6-ae1d-2562f2c25af6.png?v=1716304046" alt="Banner de Bicicletas" class="img-fluid mb-2" style="width: 100% important; border-radius: 0px;">
    </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Leo\Desktop\proyecto2\shop\resources\views/home.blade.php ENDPATH**/ ?>