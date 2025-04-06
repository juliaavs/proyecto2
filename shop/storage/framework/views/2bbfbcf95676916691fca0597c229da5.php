

<?php $__env->startSection('content'); ?>
<div class="container text-center">
    <h2>¡Pago exitoso!</h2>
    <p>Gracias por tu compra. Tu pedido será procesado pronto.</p>
    <a href="<?php echo e(route('cart.index')); ?>" class="btn btn-primary">Volver al carrito</a>


    
<a href="#" class="btn btn-dark btn-lg mt-4">
    <i class="bi bi-download"></i> Descargar Factura
</a>


</div>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/julia/Desktop/proyecto2/shop/resources/views/cart/success.blade.php ENDPATH**/ ?>