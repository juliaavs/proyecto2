<?php $__env->startSection('content'); ?>
    <h2>Introduce tu Dirección de Envío</h2>
    <form action="<?php echo e(route('checkout.saveShipping')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <label for="street">Calle:</label>
        <input type="text" name="street" value="<?php echo e(old('street', $user->street)); ?>" required>

        <label for="city">Ciudad:</label>
        <input type="text" name="city" value="<?php echo e(old('city', $user->city)); ?>" required>

        <label for="state">Estado/Provincia:</label>
        <input type="text" name="state" value="<?php echo e(old('state', $user->state)); ?>" required>

        <label for="zip_code">Código Postal:</label>
        <input type="text" name="zip_code" value="<?php echo e(old('zip_code', $user->zip_code)); ?>" required>

        <label for="country">País:</label>
        <input type="text" name="country" value="<?php echo e(old('country', $user->country)); ?>" required>

        <button type="submit" class="btn btn-primary">Guardar Dirección</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/julia/Documents/docker-shop/shop/resources/views/cart/shipping.blade.php ENDPATH**/ ?>