<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="">
            <h2 class="">User#<?php echo e($user->id); ?></h2>
        </div>
        <table class="table">
            <tbody>
            <tr>
                <th scope="row">#</th>
                <td><?php echo e($user->id); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('Name')); ?></th>
                <td><?php echo e($user->name); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('Email')); ?></th>
                <td><?php echo e($user->email); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('Roles')); ?></th>
                <td><?php echo e(implode(', ', $user->roles->pluck('name')->toArray())); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('Actions')); ?></th>
                <td>
                    <a class="btn btn-secondary" href="<?php echo e(route('users.edit', $user->id)); ?>">Edit</a>
                    <?php if(!$user->hasRole(\App\Models\User::ADMIN)): ?>
                        <?php echo $__env->make('admin.layouts.deleteform', ['action' => route('users.destroy', $user->id), 'id' => $user->id], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endif; ?>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="clearfix"></div>
        <hr>
        <a class="btn btn-primary" href="<?php echo e(url()->previous() == url()->current() ? '/admin/users' :url()->previous()); ?>">Back</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>