<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Lista de Colores</h2>
    <a href="<?php echo e(route('colors.create')); ?>" class="btn btn-primary mb-3">Añadir Nuevo Color</a>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Código HEX</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($color->name); ?></td>
                    <td>
                        <div style="width: 30px; height: 30px; background-color: <?php echo e($color->hex_code); ?>; border: 1px solid #000;"></div>
                    </td>
                    <td>
                        <a href="<?php echo e(route('colors.edit', $color->id)); ?>" class="btn btn-warning btn-sm">Editar</a>
                        
                        <!-- Botón para abrir el modal -->
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo e($color->id); ?>">
                            Eliminar
                        </button>

                        <!-- Modal de Confirmación -->
                        <div class="modal fade" id="deleteModal<?php echo e($color->id); ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo e($color->id); ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel<?php echo e($color->id); ?>">Confirmar Eliminación</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Seguro que quieres eliminar el color <strong><?php echo e($color->name); ?></strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <form action="<?php echo e(route('colors.destroy', $color->id)); ?>" method="POST" style="display:inline;">
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/julia/Desktop/proyecto2/shop/resources/views/colors/index.blade.php ENDPATH**/ ?>