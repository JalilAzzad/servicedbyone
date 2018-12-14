<?php $__env->startSection('content'); ?>
    <div class="container">
        <div>
            <h2>Services</h2>
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
                <th scope="col">Slug</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th scope="row"><?php echo e($service->id); ?></th>
                <td><?php echo e($service->name); ?></td>
                <td><?php echo e($service->slug); ?></td>
                <td>
                    <a class="btn btn-primary" href="<?php echo e(route('services.show', $service->id)); ?>">Show</a>
                    <a class="btn btn-secondary" href="<?php echo e(route('services.edit', $service->id)); ?>">Edit</a>
                    <?php echo $__env->make('admin.layouts.deleteform', ['action' => route('services.destroy', $service->id), 'id' => $service->id], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <?php echo e($services->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>