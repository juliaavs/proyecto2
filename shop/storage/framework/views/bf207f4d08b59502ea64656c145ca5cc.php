<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Lista de Marcas</h2>
    <a href="<?php echo e(route('brands.create')); ?>" class="btn btn-primary mb-3">Añadir Nueva Marca</a>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($brand->name); ?></td>
                <td>
                    <a href="<?php echo e(route('brands.edit', $brand->id)); ?>" class="btn btn-warning btn-sm">Editar</a>
                    <button class="btn btn-danger btn-sm delete-btn" type="button" data-bs-toggle="modal" data-bs-target="#deleteBrandModal" data-id="<?php echo e($brand->id); ?>">Eliminar</button>

                    <!-- Modal -->
                    <div class="modal fade" id="deleteBrandModal" tabindex="-1" aria-labelledby="deleteBrandModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteBrandModalLabel">Confirmar Eliminación</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Seguro que quieres eliminar esta marca?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form id="deleteBrandForm" action="<?php echo e(route('brands.destroy', $brand->id)); ?>" method="GET" style="display:inline;">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/julia/Desktop/proyecto2/shop/resources/views/brands/index.blade.php ENDPATH**/ ?>