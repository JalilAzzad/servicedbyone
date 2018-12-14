<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <?php if(session('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>
                <?php if(session('status')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('status')); ?>

                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-header"><?php echo e(__('Basic Info')); ?></div>

                    <div class="card-body">
                        <form method="POST" action="<?php echo e(route('user.settings.updateInfo')); ?>" aria-label="<?php echo e(__('Basic Info')); ?>">
                            <?php echo csrf_field(); ?>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Name')); ?></label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name" value="<?php echo e(old('name', $user->name)); ?>" required autofocus>

                                    <?php if($errors->has('name')): ?>
                                        <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right"><?php echo e(__('E-Mail Address')); ?></label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email', $user->email)); ?>" required disabled>

                                    <?php if($errors->has('email')): ?>
                                        <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Phone')); ?></label>

                                <div class="col-md-6">
                                    <input id="phone" type="tel" class="form-control<?php echo e($errors->has('phone') ? ' is-invalid' : ''); ?>" name="phone" value="<?php echo e(old('phone', $user->phone)); ?>" required>

                                    <?php if($errors->has('phone')): ?>
                                        <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('phone')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        <?php echo e(__('Update Info')); ?>

                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><?php echo e(__('Change Password')); ?></div>

                    <div class="card-body">
                        <form method="POST" action="<?php echo e(route('user.settings.updatePassword')); ?>" aria-label="<?php echo e(__('Change Password')); ?>">
                            <?php echo csrf_field(); ?>

                            <div class="form-group row">
                                <label for="current_password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Current Password')); ?></label>

                                <div class="col-md-6">
                                    <input id="current_password" type="password" class="form-control<?php echo e($errors->has('current_password') ? ' is-invalid' : ''); ?>" name="current_password" required>

                                    <?php if($errors->has('current_password')): ?>
                                        <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('current_password')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="new_password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('New Password')); ?></label>

                                <div class="col-md-6">
                                    <input id="new_password" type="password" class="form-control<?php echo e($errors->has('new_password') ? ' is-invalid' : ''); ?>" name="new_password" required>

                                    <?php if($errors->has('new_password')): ?>
                                        <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('new_password')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Confirm Password')); ?></label>

                                <div class="col-md-6">
                                    <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        <?php echo e(__('Update Password')); ?>

                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>