<?php $__env->startSection('content'); ?>

    <div class="container mt-5">
        <h2 class="mb-4">Finalizar Compra</h2>
        <div class="row">
            <div class="col-md-8">
                <h4 class="mb-3">Detalles de Envío</h4>
                <form action="<?php echo e(route('checkout.saveShipping')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="apellido">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="ciudad">Ciudad</label>
                            <input type="text" class="form-control" id="ciudad" name="ciudad" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="codigo_postal">Código Postal</label>
                            <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="pais">País</label>
                            <select class="form-select" id="pais" name="pais" required>
                                <option value="">Selecciona...</option>
                                <option value="España">España</option>
                                <option value="México">México</option>
                                <option value="Argentina">Argentina</option>
                            </select>
                        </div>
                    </div>
                 
                </form>
                    <!-- Botón para continuar con el pago -->
                    <form action="<?php echo e(route('checkout.payment')); ?>" method="GET">
                        <button type="submit">Continuar con el pago</button>
                    </form>
            </div>
            <div class="col-md-4">
                <h4 class="mb-3">Resumen del Pedido</h4>
                <ul class="list-group mb-3">
                    <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0"><?php echo e($item->shoe->name); ?></h6>
                                <small class="text-muted">Cantidad: <?php echo e($item->quantity); ?></small>
                            </div>
                            <span class="text-muted"><?php echo e($item->shoe->price * $item->quantity); ?>€</span>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total</span>
                        <p>Total: <?php echo e($item->shoe->price * $item->quantity); ?>€</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/julia/Documents/docker-shop/shop/resources/views/cart/review.blade.php ENDPATH**/ ?>