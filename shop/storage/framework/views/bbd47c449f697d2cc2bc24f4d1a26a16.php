<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h2 class="mb-4">Usuarios Registrados</h2>

    <!-- Buscador -->
    <form method="GET" action="<?php echo e(route('admin.users.index')); ?>" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o email..." value="<?php echo e(request('search')); ?>">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <!-- Tabla de usuarios -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td><span class="badge bg-<?php echo e($user->role === 'admin' ? 'success' : 'secondary'); ?>"><?php echo e(ucfirst($user->role)); ?></span></td>
                        <td>
                            <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="text-center">No se encontraron usuarios.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/julia/Desktop/proyecto2/shop/resources/views/profile/index.blade.php ENDPATH**/ ?>