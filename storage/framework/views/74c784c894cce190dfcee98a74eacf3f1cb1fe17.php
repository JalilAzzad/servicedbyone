<?php
    $seo_title =  "Register | ". config('app.name', 'Serviced By ONE');
?>



<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header"><h1><?php echo e(__('Register')); ?></h1></div>

                    <div class="card-body">
                        <form method="POST" action="<?php echo e(route('register')); ?>" aria-label="<?php echo e(__('Register')); ?>">
                            <?php echo csrf_field(); ?>

                            <div class="form-group row">
                                <label for="name" class="col-md-12 col-form-label"><b><?php echo e(__('Name')); ?></b></label>

                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name" value="<?php echo e(old('name')); ?>" required autofocus>

                                    <?php if($errors->has('name')): ?>
                                        <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-12 col-form-label"><b><?php echo e(__('E-Mail Address')); ?></b></label>

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required>

                                    <?php if($errors->has('email')): ?>
                                        <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_name" class="col-md-12 col-form-label"><b><?php echo e(__('User Name')); ?></b></label>

                                <div class="col-md-12">
                                    <input id="user_name" type="text" class="form-control<?php echo e($errors->has('user_name') ? ' is-invalid' : ''); ?>" name="user_name" value="<?php echo e(old('user_name')); ?>" required>

                                    <?php if($errors->has('user_name')): ?>
                                        <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('user_name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-12 col-form-label"><b><?php echo e(__('Phone')); ?></b></label>

                                <div class="col-md-12">
                                    <input id="phone" type="tel" class="form-control<?php echo e($errors->has('phone') ? ' is-invalid' : ''); ?>" name="phone" value="<?php echo e(old('phone')); ?>" required>

                                    <?php if($errors->has('phone')): ?>
                                        <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('phone')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-12 col-form-label"><b><?php echo e(__('Password')); ?></b></label>

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
                                <label for="password-confirm" class="col-md-12 col-form-label"><b><?php echo e(__('Confirm Password')); ?></b></label>

                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-register">
                                        <?php echo e(__('Register')); ?>

                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-12">
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