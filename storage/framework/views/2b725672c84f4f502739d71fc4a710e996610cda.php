<?php $__env->startSection('content'); ?>
    <div class="container">
        <div>
            <h2>Users</h2>
        </div>

        <?php if(session('status')): ?>
            <div class="alert alert-success">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Roles</th>
                <th scope="col">Balance</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th scope="row"><?php echo e($user->id); ?></th>
                <td><?php echo e($user->name); ?></td>
                <td><?php echo e($user->email); ?></td>
                <td><?php echo e($user->phone); ?></td>
                <td><?php echo e(implode(', ', $user->roles->pluck('name')->toArray())); ?></td>
                <td>$<?php echo e($user->balance); ?></td>
                <td>
                    <a class="btn btn-primary" href="<?php echo e(route('users.show', $user->id)); ?>">Show</a>
                    <a class="btn btn-secondary" href="<?php echo e(route('users.edit', $user->id)); ?>">Edit</a>
                    <?php if(!$user->hasRole(\App\Models\User::ADMIN)): ?>
                        <?php echo $__env->make('admin.layouts.deleteform', ['action' => route('users.destroy', $user->id), 'id' => $user->id], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <?php echo e($users->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>