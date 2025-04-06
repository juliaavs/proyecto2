

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Editar Zapato</h2>

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

    <form action="<?php echo e(route('shoes.update', $shoe->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label class="form-label">Marca</label>
            <select name="brand_id" class="form-control">
                <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($brand->id); ?>" <?php echo e($shoe->brand_id == $brand->id ? 'selected' : ''); ?>>
                        <?php echo e($brand->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Modelo</label>
            <select name="model_id" class="form-control">
                <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($model->id); ?>" <?php echo e($shoe->model_id == $model->id ? 'selected' : ''); ?>>
                        <?php echo e($model->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="category_id" class="form-control">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>" <?php echo e($shoe->category_id == $category->id ? 'selected' : ''); ?>>
                        <?php echo e($category->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" name="price" step="0.01" class="form-control" value="<?php echo e($shoe->price); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control" value="<?php echo e($shoe->stock); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descuento (%)</label>
            <input type="number" name="discount" class="form-control" max="100" value="<?php echo e($shoe->discount); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Imagen Actual</label><br>
            <?php if($shoe->image): ?>
                <img src="<?php echo e($shoe->image); ?>" width="100">
            <?php else: ?>
                No Image
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Nueva Imagen</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Color</label>
            <select name="color_id" class="form-control">
                <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($color->id); ?>" <?php echo e($shoe->color_id == $color->id ? 'selected' : ''); ?>>
                        <?php echo e($color->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Talla</label>
            <select name="size_id" class="form-control">
                <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($size->id); ?>" <?php echo e($shoe->size_id == $size->id ? 'selected' : ''); ?>>
                        <?php echo e($size->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="featured" class="form-check-input" <?php echo e($shoe->featured ? 'checked' : ''); ?>>
            <label class="form-check-label">Destacado</label>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="main" class="form-check-input" <?php echo e($shoe->main ? 'checked' : ''); ?>>
            <label class="form-check-label">Imagen Principal</label>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="active" class="form-check-input" <?php echo e($shoe->active ? 'checked' : ''); ?>>
            <label class="form-check-label">Activo</label>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="<?php echo e(route('shoes.index')); ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Leo\Desktop\proyecto2\shop\resources\views/shoes/edit.blade.php ENDPATH**/ ?>