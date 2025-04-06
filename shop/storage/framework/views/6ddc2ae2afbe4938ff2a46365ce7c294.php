<?php $__env->startSection('content'); ?>
<div class="container">
    <h2 class="mb-4">Carrito de Compras</h2>

    <?php
        $total = 0; // Inicializamos el total
    ?>

    <?php if(count($cartItems) > 0): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Talla</th>
                    <th>Color</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    if (auth()->check() && isset($item->shoe)) {
                        $price = $item->shoe->price;
                        $discount = $item->shoe->discount ?? 0;
                        $finalPrice = $discount > 0 ? $price * (1 - $discount / 100) : $price;
                        $subtotal = $finalPrice * $item->quantity;
                    } else {
                        $finalPrice = $item['price'];
                        $subtotal = $item['price'] * $item['quantity'];
                    }

                    $total += $subtotal;
                ?>

                    <tr>
                        <!-- Imagen del zapato -->
                        <td class="align-middle">
                            <?php if(auth()->check() && isset($item->shoe->image)): ?>
                                <img src="<?php echo e($item->shoe->image); ?>" alt="<?php echo e($item->shoe->brand->name . ' ' . $item->shoe->model->name); ?>" class="img-thumbnail" width="80">
                            <?php elseif(!auth()->check() && isset($item['image'])): ?>
                                <img src="<?php echo e($item['image']); ?>" alt="<?php echo e($item['name']); ?>" class="img-thumbnail" width="80">
                            <?php else: ?>
                                <img src="<?php echo e(asset('images/placeholder.png')); ?>" alt="Imagen no disponible" class="img-thumbnail" width="80">
                            <?php endif; ?>
                        </td>

                        <!-- Nombre del producto con enlace -->
                        <td class="align-middle">
                            <?php if(auth()->check() && isset($item->shoe)): ?>
                                <a href="<?php echo e(url('/shoes/preview/' . $item->shoe->id)); ?>" class="text-decoration-none">
                                    <?php echo e($item->shoe->brand->name . ' ' . $item->shoe->model->name); ?>

                                </a>
                            <?php elseif(!auth()->check() && isset($item['name'])): ?>
                                <a href="#" class="text-decoration-none"><?php echo e($item['name']); ?></a>
                            <?php else: ?>
                                <span class="text-danger">Zapato no encontrado</span>
                            <?php endif; ?>
                        </td>

                        <!-- Talla -->
                        <td class="align-middle">
                            <?php if(auth()->check() && isset($item->shoe->size)): ?>
                                <?php echo e($item->shoe->size->name); ?>

                            <?php elseif(!auth()->check() && isset($item['size'])): ?>
                                <?php echo e($item['size']); ?>

                            <?php else: ?>
                                <span class="text-danger">-</span>
                            <?php endif; ?>
                        </td>

                        <!-- Color (como cuadrado visual) -->
                        <td class="align-middle">
                            <?php if(auth()->check() && isset($item->shoe->color)): ?>
                                <div style="width: 25px; height: 25px; background-color: <?php echo e($item->shoe->color->hex_code); ?>; border: 1px solid #000;"></div>
                            <?php elseif(!auth()->check() && isset($item['color'])): ?>
                                <div style="width: 25px; height: 25px; background-color: <?php echo e($item['color']); ?>; border: 1px solid #000;"></div>
                            <?php else: ?>
                                <span class="text-danger">-</span>
                            <?php endif; ?>
                        </td>

                        <!-- Precio -->
                        <td class="align-middle">
                            <?php if(auth()->check() && isset($item->shoe)): ?>
                                <?php if($item->shoe->discount > 0): ?>
                                    <del class="text-muted">€<?php echo e(number_format($item->shoe->price, 2)); ?></del><br>
                                    <span class="text-success fw-bold">€<?php echo e(number_format($finalPrice, 2)); ?></span>
                                <?php else: ?>
                                    €<?php echo e(number_format($finalPrice, 2)); ?>

                                <?php endif; ?>
                            <?php elseif(!auth()->check() && isset($item['price'])): ?>
                                €<?php echo e(number_format($item['price'], 2)); ?>

                            <?php else: ?>
                                <span class="text-danger">-</span>
                            <?php endif; ?>
                        </td>


                        <!-- Cantidad con botones mejorados -->
                        <td class="align-middle">
                            <div class="d-flex align-items-center">
                                <button class="btn btn-sm btn-outline-danger update-quantity me-2" 
                                    data-id="<?php echo e(auth()->check() ? $item->shoe->id : $key); ?>" 
                                    data-action="decrease">-</button>

                                <input type="text" class="form-control text-center quantity-input" 
                                    value="<?php echo e(auth()->check() ? $item->quantity : $item['quantity']); ?>" readonly style="width: 50px;">

                                <button class="btn btn-sm btn-outline-success update-quantity ms-2" 
                                    data-id="<?php echo e(auth()->check() ? $item->shoe->id : $key); ?>" 
                                    data-action="increase">+</button>
                            </div>
                        </td>

                        <!-- Subtotal -->
                        <td class="align-middle">€<?php echo e(number_format($subtotal, 2)); ?></td>

                        <!-- Botón de eliminación -->
                        <td class="align-middle">
                            <form action="<?php echo e(route('cart.remove', auth()->check() ? ($item->shoe ? $item->shoe->id : null) : $key)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>


        <div class="d-flex justify-content-between align-items-center">
            <h4>Total: <strong>€<?php echo e(number_format($total, 2)); ?></strong></h4>

            <div>
                <form action="<?php echo e(route('cart.clear')); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <button class="btn btn-warning">Vaciar Carrito</button>
                </form>
                
                <form action="<?php echo e(route('checkout')); ?>" method="GET">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-secondary">Añadir direccion de envio</button>
                </form>             
            </div>
        </div>
    <?php else: ?>
        <p>No hay productos en el carrito.</p>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/julia/Desktop/proyecto2/shop/resources/views/cart/index.blade.php ENDPATH**/ ?>