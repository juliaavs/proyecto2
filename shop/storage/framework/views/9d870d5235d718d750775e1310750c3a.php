<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Lista de Modelos</h2>
    <a href="<?php echo e(route('models.create')); ?>" class="btn btn-primary mb-3">Añadir Nuevo Modelo</a>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($model->name); ?></td>
                    <td><?php echo e($model->brand->name); ?></td>
                    <td>
                        <a href="<?php echo e(route('models.edit', $model->id)); ?>" class="btn btn-warning btn-sm">Editar</a>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo e($model->id); ?>">
                            Eliminar
                        </button>

                        <!-- Modal Único para este Modelo -->
                        <div class="modal fade" id="deleteModal<?php echo e($model->id); ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo e($model->id); ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel<?php echo e($model->id); ?>">Eliminar Modelo</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-left">
                                        ¿Seguro que quieres eliminar el modelo <strong><?php echo e($model->name); ?></strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <form action="<?php echo e(route('models.destroy', $model->id)); ?>" method="POST" style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/julia/Desktop/proyecto2/shop/resources/views/models/index.blade.php ENDPATH**/ ?>