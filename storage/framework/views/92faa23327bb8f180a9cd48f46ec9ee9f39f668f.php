<?php $__env->startSection('content'); ?>
    <div class="container">
        <div>
            <h2>Partners</h2>
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
                <th scope="col">Website Url</th>
                <th scope="col">Slug</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th scope="row"><?php echo e($partner->id); ?></th>
                <td><?php echo e($partner->name); ?></td>
                <td><?php echo e($partner->email); ?></td>
                <td><?php echo e($partner->phone); ?></td>
                <td><?php echo e($partner->url); ?></td>
                <td><?php echo e($partner->slug); ?></td>
                <td>
                    <a class="btn btn-primary" href="<?php echo e(route('partners.show', $partner->id)); ?>">Show</a>
                    <a class="btn btn-secondary" href="<?php echo e(route('partners.edit', $partner->id)); ?>">Edit</a>
                    <?php echo $__env->make('admin.layouts.deleteform', ['action' => route('partners.destroy', $partner->id), 'id' => $partner->id], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <?php echo e($partners->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>