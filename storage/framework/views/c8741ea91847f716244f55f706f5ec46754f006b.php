<?php
    $seo_title =  "Login | ". config('app.name', 'Serviced By ONE');
?>



<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header"><h1><?php echo e(__('Login')); ?></h1></div>

                    <div class="card-body">
                        <form method="POST" action="<?php echo e(route('login')); ?>" aria-label="<?php echo e(__('Login')); ?>">
                            <?php echo csrf_field(); ?>

                            <div class="form-group row">
                                <label for="email" class="col-md-12 col-form-label"><?php echo e(__('E-Mail Address')); ?></label>

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

                                    <?php if($errors->has('email')): ?>
                                        <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-12 col-form-label"><?php echo e(__('Password')); ?></label>

                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" required>

                                    <?php if($errors->has('password')): ?>
                                        <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>

                                        <label class="form-check-label" for="remember">
                                            <?php echo e(__('Remember Me')); ?>

                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        <?php echo e(__('Login')); ?>

                                    </button>

                                    <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                        <?php echo e(__('Forgot Your Password?')); ?>

                                    </a>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-12">
                            <div class="Login-separator">or</div>
                            <a href="<?php echo e(route('social.login', 'facebook')); ?>" class="d-block mb-1">
                                <img class="w-75" src="<?php echo e(asset('images/login-fb.png')); ?>" alt=""></a>
                            <a href="<?php echo e(route('social.login', 'google')); ?>"  class="d-block">
                                <img class="w-75" src="<?php echo e(asset('images/login-google.png')); ?>" alt="">
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>