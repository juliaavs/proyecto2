<?php $__env->startSection('content'); ?>
<div class="container">
<h2 class="my-4">Registrar Nueva Categoría</h2>

    
    <form action="<?php echo e(route('category.store')); ?>" method="POST">
        <?php echo csrf_field(); ?> 
        
        <div class="mb-3">
            <label for="name" class="form-label">Nombre de la Categoría</label>

            <input type="text" name="name" id="name" class="form-control" required>
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger mt-1"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="<?php echo e(route('category.index')); ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/julia/Desktop/proyecto2/shop/resources/views/categories/altaCategoria.blade.php ENDPATH**/ ?>