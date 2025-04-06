<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <h2 class="mb-4">Mis Pedidos</h2>

    <?php if($orders->isEmpty()): ?>
        <div class="alert alert-info">Aún no has realizado ningún pedido.</div>
    <?php else: ?>
        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pedido #<?php echo e($order->id); ?></h5>
                    <p class="card-text">Total: €<?php echo e(number_format($order->total, 2)); ?></p>
                    <p class="card-text">Estado: <?php echo e($order->status); ?></p>
                    <h6>Productos:</h6>
                    <ul class="list-group">
                        <?php $__currentLoopData = $order->shoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shoe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <strong><?php echo e($shoe->brand->name); ?> <?php echo e($shoe->model->name); ?></strong><br>
                                    Talla: <?php echo e($shoe->pivot->size ?? '-'); ?><br>
                                    Cantidad: <?php echo e($shoe->pivot->quantity); ?>

                                </div>
                                <div><?php echo e(number_format($shoe->price, 2)); ?> €</div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/julia/Desktop/proyecto2/shop/resources/views/orders/mis-pedidos.blade.php ENDPATH**/ ?>