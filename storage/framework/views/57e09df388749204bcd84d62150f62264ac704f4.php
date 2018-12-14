<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="">
            <h2 class="">User#<?php echo e($user->id); ?></h2>
        </div>
        <?php echo $__env->make('errors.list', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <form action="<?php echo e(route('users.update', $user->id)); ?>" method="POST">
            <?php echo method_field('PUT'); ?>
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Full Name" value="<?php echo e($user->name); ?>">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input name="email" type="email" class="form-control disabled" disabled id="email" placeholder="name@example.com" value="<?php echo e($user->email); ?>">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input name="phone" type="tel" class="form-control" id="phone" placeholder="+1xxxxxxxxxx" value="<?php echo e($user->phone); ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="roles">Roles</label>
                <select name="roles[]" multiple class="form-control" id="roles">
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php if($user->hasRole($role->name)): ?>selected <?php endif; ?>><?php echo e($role->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
             <div class="form-group">
                <label for="commission">Commission</label>
                <input name="commission" type="number" class="form-control" id="commission" placeholder="commission" value="<?php echo e($user->commission); ?>">
            </div>
            <a class="btn btn-danger" href="<?php echo e(url()->previous() == url()->current() ? '/admin/users/'.$user->id :url()->previous()); ?>">Cancel</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>