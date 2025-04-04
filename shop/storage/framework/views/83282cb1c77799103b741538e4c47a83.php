<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Añadir Nuevo Zapato</h2>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <h4>Error</h4>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('shoes.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="mb-3">
            <label class="form-label">Marca</label>
            <select name="brand_id" class="form-control">
                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($brand->id); ?>"><?php echo e($brand->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Modelo</label>
            <select name="model_id" class="form-control">
                <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($model->id); ?>"><?php echo e($model->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="category_id" class="form-control">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" name="price" step="0.01" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descuento (%)</label>
            <input type="number" name="discount" class="form-control" max="100">
        </div>

        <div class="mb-3">
            <label class="form-label">Imagen</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Color</label>
            <select name="color_id" class="form-control">
                <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($color->id); ?>"><?php echo e($color->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Talla</label>
            <select name="size_id" class="form-control">
                <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($size->id); ?>"><?php echo e($size->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="featured" class="form-check-input">
            <label class="form-check-label">Destacado</label>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="main" class="form-check-input">
            <label class="form-check-label">Imagen Principal</label>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="active" class="form-check-input" checked>
            <label class="form-check-label">Activo</label>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="<?php echo e(route('shoes.index')); ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/julia/Desktop/proyecto2/shop/resources/views/shoes/create.blade.php ENDPATH**/ ?>