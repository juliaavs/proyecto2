<?php $__env->startSection('content'); ?>
    <div class="login-section">
        <div class="login-container">
            <div class="logo">
                <img src="<?php echo e(asset('img/logo.png')); ?>" alt="Moon Shoes Logo">
            </div>

            
            <form method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>

                
                <div class="mb-3">
                    <input id="email"
                           type="email"
                           class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           name="email"
                           value="<?php echo e(old('email')); ?>"
                           required
                           autocomplete="email"
                           autofocus
                           placeholder="Usuario">

                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="mb-3">
                    <input id="password"
                           type="password"
                           class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           name="password"
                           required
                           autocomplete="current-password"
                           placeholder="Contraseña">

                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="mb-3 form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="remember"
                           id="remember"
                           <?php echo e(old('remember') ? 'checked' : ''); ?>>

                    <label class="form-check-label" for="remember">
                        <?php echo e(__('Remember Me')); ?>

                    </label>
                </div>

                
                <?php if(Route::has('password.request')): ?>
                    <a class="forgot-password" href="<?php echo e(route('password.request')); ?>">
                        <?php echo e(__('Forgot Your Password?')); ?>

                    </a>
                <?php endif; ?>

                
                <a class="register-link" href="<?php echo e(route('register')); ?>">
                    <?php echo e(__('Create new account')); ?>

                </a>

                
                <button type="submit" class="btn btn-dark w-100">
                    <?php echo e(__('Login')); ?>

                </button>
            </form>

            <p class="login-footer">
                &copy; Moon Shoes S.L. 2025
            </p>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/DAWProjecte/Escriptori/proyecto2/shop/resources/views/auth/login.blade.php ENDPATH**/ ?>