<?php $__env->startSection('content'); ?>
    <div class="container">
        <h2 class="text-center mb-4">Lista de Pedidos</h2>

        <?php if(session('status')): ?>
            <div class="alert alert-success">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>

        <!-- Buscador de pedidos -->
        <form action="<?php echo e(route('orders.search')); ?>" method="GET" class="mb-4">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Buscar por email</th>
                        <th>Selecciona un estado</th>
                        <th>Buscar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <!-- Campo texto para email -->
                        <td>
                            <input type="text" name="email" class="form-control" placeholder="Buscar por email"
                                value="<?php echo e(old('email')); ?>">
                        </td>
                        <!-- Select de estado -->
                        <td>
                            <select name="status" class="form-control" value="<?php echo e(old('status')); ?>">
                                <option value="">Selecciona un estado</option>
                                <option value="pending">Pendiente</option>
                                <option value="shipped">Enviado</option>
                                <option value="completed">Completado</option>
                                <option value="processing">Procesando</option>
                                <option value="cancelled">Cancelado</option>
                            </select>
                        </td>
                        <!-- Botón de búsqueda -->
                        <td>
                            <button type="submit" class="btn btn-primary w-100">
                                Buscar
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID del Pedido</th>
                    <th>Usuario</th>
                    <th>Email Usuario</th>
                    <th>Estado</th>
                    <th>Precio Total</th>
                    <th>Fecha Pedido</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($order->id); ?></td>
                        <td><?php echo e($order->user->name); ?></td>
                        <td><?php echo e($order->user->email); ?></td>

                        <td><?php echo e($order->status); ?></td>
                        <td><?php echo e($order->total); ?> €</td>
                        <td><?php echo e($order->created_at); ?></td>
                        <td>
                            <a href="<?php echo e(route('orders.edit', $order->id)); ?>" class="btn btn-primary btn-sm">Editar</a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/julia/Documents/docker-shop/shop/resources/views/orders/allOrders.blade.php ENDPATH**/ ?>