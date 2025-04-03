<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura #<?php echo e($order->id); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .invoice-container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background: #fff;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 150px;
        }
        .invoice-title {
            font-size: 24px;
            font-weight: bold;
            color: #007BFF;
        }
        .details {
            margin-bottom: 20px;
        }
        .details p {
            margin: 5px 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .table th {
            background: #007BFF;
            color: #fff;
        }
        .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>

    <div class="invoice-container">
        <!-- Encabezado -->
        <div class="header">
            <img src="<?php echo e(public_path('img/logo.png')); ?>" alt="Logo de la tienda">  
            <p class="invoice-title">Factura #<?php echo e($order->id); ?></p>
        </div>

        <!-- Datos del Cliente -->
        <div class="details">
            <p><strong>Fecha:</strong> <?php echo e($order->created_at->format('d/m/Y')); ?></p>
            <p><strong>Cliente:</strong> <?php echo e($order->user->name); ?></p>
            <p><strong>Email:</strong> <?php echo e($order->user->email); ?></p>
        </div>

        <!-- Tabla de productos -->
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item->shoe->model_id); ?></td>
                    <td><?php echo e($item->quantity); ?></td>
                    <td><?php echo e(number_format($item->shoe->price, 2)); ?> €</td>
                    <td><?php echo e(number_format($item->shoe->price * $item->quantity, 2)); ?> €</td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <!-- Total de la factura -->
        <p class="total">Total a pagar: <?php echo e(number_format($totalPrice, 2)); ?> €</p>

        <!-- Pie de página -->
        <div class="footer">
            <p>Gracias por su compra.</p>
            <p>Para soporte, contáctenos en <strong>soporte@tutienda.com</strong></p>
        </div>
    </div>

</body>
</html>
<?php /**PATH /Users/julia/Documents/docker-shop/shop/resources/views/invoices/invoice.blade.php ENDPATH**/ ?>