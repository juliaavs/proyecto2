<?php $__env->startSection('content'); ?>

<div class="container">
    <h2 class="text-center mb-4">Lista de Categorias</h2>
    <a href="<?php echo e(route('category.create')); ?>" class="btn btn-primary mb-4">Añadir nueva categoria</a>


    <?php if(session('status')): ?>
        <div class="alert alert-success">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acciones</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($category->id); ?></td>
                    <td><?php echo e($category->name); ?></td>
                    <td>
                        <?php if($category->active): ?>
                            <span class="badge bg-success">Activa</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Desactivada</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($category->active): ?>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#disableModal<?php echo e($category->id); ?>">
                                Desactivar
                            </button>
                        <?php else: ?>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#enableModal<?php echo e($category->id); ?>">
                                Activar
                            </button>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('category.edit', $category->id)); ?>" class="btn btn-primary">Editar</a>
                    </td>
                </tr>

                <!-- Modal de Desactivación -->
                <div class="modal fade" id="disableModal<?php echo e($category->id); ?>" tabindex="-1" aria-labelledby="disableModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="disableModalLabel">Confirmar Desactivación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                ¿Estás seguro de que deseas desactivar la categoría "<?php echo e($category->name); ?>"?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <form action="<?php echo e(route('categories.toggle', $category->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-danger">Desactivar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal de Activación -->
                <div class="modal fade" id="enableModal<?php echo e($category->id); ?>" tabindex="-1" aria-labelledby="enableModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="enableModalLabel">Confirmar Activación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">¿Estás seguro de que deseas activar la categoría "<?php echo e($category->name); ?>"?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <form action="<?php echo e(route('categories.toggle', $category->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-success">Activar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/julia/Desktop/proyecto2/shop/resources/views/categories/allCategories.blade.php ENDPATH**/ ?>