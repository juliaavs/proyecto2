<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Lista de Tallas</h2>
    <a href="<?php echo e(route('sizes.create')); ?>" class="btn btn-primary mb-3">Añadir Nueva Talla</a>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($size->name); ?></td>
                    <td>
                        <a href="<?php echo e(route('sizes.edit', $size->id)); ?>" class="btn btn-warning btn-sm">Editar</a>
                        
                        <!-- Botón para abrir el modal -->
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo e($size->id); ?>">
                            Eliminar
                        </button>

                        <!-- Modal de Confirmación -->
                        <div class="modal fade" id="deleteModal<?php echo e($size->id); ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo e($size->id); ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel<?php echo e($size->id); ?>">Confirmar Eliminación</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Seguro que quieres eliminar la talla <strong><?php echo e($size->name); ?></strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <form action="<?php echo e(route('sizes.destroy', $size->id)); ?>" method="POST" style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- Fin del modal -->
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/julia/Desktop/proyecto2/shop/resources/views/sizes/index.blade.php ENDPATH**/ ?>