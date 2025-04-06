<?php $__env->startSection('title', $category->name); ?>

<?php $__env->startSection('content'); ?>
    <?php if($category->active == 1): ?>
        <div class="container py-4 mct">
            <h1 class="mb-4 text-center"><?php echo e($category->name); ?></h1>
            
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shoe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <div class="position-relative">
                                <a href="<?php echo e(route('shoes.preview', $shoe->id)); ?>">
                                    <img src="<?php echo e($shoe->image ? $shoe->image : asset('images/default-shoe.png')); ?>" class="card-img-top p-3 img-fluid" alt="<?php echo e($shoe->brand->name); ?> <?php echo e($shoe->model->name); ?>" style="object-fit: cover; height: 250px; border-radius: 10px;">
                                </a>
                                <?php if($shoe->stock < 50): ?>
                                    <div class="position-absolute top-0 end-0 bg-warning text-dark p-1 m-2 rounded" style="font-size: 0.8rem;">
                                        Quedan <?php echo e($shoe->stock); ?> en stock
                                    </div>
                                <?php endif; ?>
                                <?php if($shoe->discount > 0): ?>
                                    <div class="position-absolute bottom-0 end-0 bg-danger text-white p-1 m-2 rounded" style="font-size: 0.8rem;">
                                        -<?php echo e($shoe->discount); ?>%
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?php echo e($shoe->brand->name); ?> <?php echo e($shoe->model->name); ?></h5>
                                <p class="card-text mb-2">
                                    <strong>Precio:</strong>
                                    <?php if($shoe->discount > 0): ?>
                                        <span class="text-decoration-line-through text-muted">€<?php echo e(number_format($shoe->price, 2)); ?></span>
                                        <span class="text-success fw-bold"> €<?php echo e(number_format($shoe->price * (1 - $shoe->discount / 100), 2)); ?></span>
                                    <?php else: ?>
                                        €<?php echo e(number_format($shoe->price, 2)); ?>

                                    <?php endif; ?>
                                </p>
                                
                                <div class="mt-auto d-flex justify-content-center">
                                    <button class="btn btn-outline-primary add-to-cart d-flex align-items-center" data-id="<?php echo e($shoe->id); ?>">
                                        <i class="bi bi-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if($category->products->isEmpty()): ?>
                    <div class="col-12">
                        <div class="alert alert-warning text-center" role="alert">
                            No hay productos en esta categoría.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <div class="container py-4">
            <h1 class="mb-4 text-center"><?php echo e($category->name); ?></h1>
            <div class="alert alert-danger text-center" role="alert">
                Esta categoría se encuentra deshabilitada en estos momentos.
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/julia/Desktop/proyecto2/shop/resources/views/categories/show.blade.php ENDPATH**/ ?>