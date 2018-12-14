<?php $__env->startSection('content'); ?>
    <div class="container">
        <div>
            <h2>SEO</h2>
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
                <th scope="col">URL</th>
                <th scope="col">Title</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $seos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th scope="row"><?php echo e($seo->id); ?></th>
                <td><?php echo e($seo->url); ?></td>
                <td><?php echo e($seo->slug); ?></td>
                <td>
                    <a class="btn btn-primary" href="<?php echo e(route('seos.show', $seo->id)); ?>">Show</a>
                    <a class="btn btn-secondary" href="<?php echo e(route('seos.edit', $seo->id)); ?>">Edit</a>
                   <?php echo $__env->make('admin.layouts.deleteform', ['action' => route('seos.destroy', $seo->id), 'id' => $seo->id], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <?php echo e($seos->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>