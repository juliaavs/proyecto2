<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Lista de Zapatos</h2>
    <a href="<?php echo e(route('shoes.create')); ?>" class="btn btn-primary mb-3">Añadir Nuevo Zapato</a>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Imagen</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Descuento</th>
                <th>Color</th>
                <th>Talla</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $shoes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shoe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <?php if($shoe->image): ?>
                            <img src="<?php echo e($shoe->image); ?>" width="50" height="50">
                        <?php else: ?>
                            No Image
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($shoe->brand->name); ?></td>
                    <td><?php echo e($shoe->model->name); ?></td>
                    <td>$<?php echo e(number_format($shoe->price, 2)); ?></td>
                    <td><?php echo e($shoe->stock); ?></td>
                    <td><?php echo e($shoe->discount); ?>%</td>
                    <td><?php echo e($shoe->color->name); ?></td>
                    <td><?php echo e($shoe->size->name); ?></td>
                    <td>
                        <?php if($shoe->active): ?>
                            <span class="badge bg-success">Activo</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Inactivo</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('shoes.edit', $shoe->id)); ?>" class="btn btn-warning btn-sm">Editar</a>
                        <form action="<?php echo e(route('shoes.destroy', $shoe->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres eliminar este zapato?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/julia/Documents/docker-shop/shop/resources/views/shoes/index.blade.php ENDPATH**/ ?>