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
            <!-- Para pantallas grandes (Grid) -->
            <div class="row image-container d-none d-md-flex">
                <div class="col-6 col-md-3"><img src="<?php echo e(asset('img/nikeDunk.png')); ?>" alt="Imagen 1"></div>
                <div class="col-6 col-md-3"><img src="<?php echo e(asset('img/nikeRunning.png')); ?>" alt="Imagen 2"></div>
                <div class="col-6 col-md-3"><img src="<?php echo e(asset('img/nikeDunk.png')); ?>" alt="Imagen 3"></div>
                <div class="col-6 col-md-3"><img src="<?php echo e(asset('img/nikeRunning.png')); ?>" alt="Imagen 4"></div>
            </div>

            <!-- Para móviles (Scroll horizontal) -->
            <div class="image-slider d-flex d-md-none">
                <img src="https://via.placeholder.com/100" alt="Imagen 1">
                <img src="https://via.placeholder.com/100" alt="Imagen 2">
                <img src="https://via.placeholder.com/100" alt="Imagen 3">
                <img src="https://via.placeholder.com/100" alt="Imagen 4">
            </div>
        </div>
        
        <br>
        <br>
        <h4>Nuestros Destacados</h4>

        <div class="container mt-4">
            <!-- Para pantallas grandes (Grid) -->
            <div class="row image-container d-none d-md-flex">
                <div class="col-6 col-md-3"><img src="<?php echo e(asset('img/nikeDunk.png')); ?>" alt="Imagen 1"></div>
                <div class="col-6 col-md-3"><img src="<?php echo e(asset('img/nikeRunning.png')); ?>" alt="Imagen 2"></div>
                <div class="col-6 col-md-3"><img src="<?php echo e(asset('img/nikeDunk.png')); ?>" alt="Imagen 3"></div>
                <div class="col-6 col-md-3"><img src="<?php echo e(asset('img/nikeRunning.png')); ?>" alt="Imagen 4"></div>
            </div>

            <!-- Para móviles (Scroll horizontal) -->
            <div class="image-slider d-flex d-md-none">
                <img src="https://via.placeholder.com/100" alt="Imagen 1">
                <img src="https://via.placeholder.com/100" alt="Imagen 2">
                <img src="https://via.placeholder.com/100" alt="Imagen 3">
                <img src="https://via.placeholder.com/100" alt="Imagen 4">
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/DAWProjecte/Escriptori/proyecto2/shop/resources/views/home.blade.php ENDPATH**/ ?>