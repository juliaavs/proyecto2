<?php $__env->startSection('content'); ?>

<div class="container">
    <h2>Editar Pedido:</h2>

    <form action="<?php echo e(route('order.update', $order->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label for="status" class="form-label">Estado del Pedido</label>
            <select name="status" id="status" class="form-control">
                <option value="pending" <?php echo e(old('status', $order->status) == 'pending' ? 'selected' : ''); ?>>Pending</option>
                <option value="shipped" <?php echo e(old('status', $order->status) == 'shipped' ? 'selected' : ''); ?>>Shipped</option>
                <option value="completed" <?php echo e(old('status', $order->status) == 'completed' ? 'selected' : ''); ?>>Completed</option>
                <option value="processing" <?php echo e(old('status', $order->status) == 'processing' ? 'selected' : ''); ?>>Processing</option>
                <option value="cancelled" <?php echo e(old('status', $order->status) == 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
            </select>
            <br>
            <button type="submit" class="btn btn-success">Guardar Cambios</button>

        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/julia/Documents/docker-shop/shop/resources/views/orders/edit.blade.php ENDPATH**/ ?>