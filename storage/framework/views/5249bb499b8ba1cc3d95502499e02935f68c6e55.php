<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="">
            <h2 class="">Partner#<?php echo e($partner->id); ?></h2>
        </div>
        <table class="table">
            <tbody>
            <tr>
                <th scope="row">#</th>
                <td><?php echo e($partner->id); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('Name')); ?></th>
                <td><?php echo e($partner->name); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('Email')); ?></th>
                <td><?php echo e($partner->email); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('Phone')); ?></th>
                <td><?php echo e($partner->phone); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('Website')); ?></th>
                <td><?php echo e($partner->url); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('Slug')); ?></th>
                <td><?php echo e($partner->slug); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('Description')); ?></th>
                <td><?php echo e($partner->description); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('Featured Image')); ?></th>
                <td><img class="img-thumbnail" src="<?php echo e(is_null($partner->featured_image) ? asset('/images/partner-default.png') : asset(str_replace("public","storage", $partner->featured_image))); ?>" alt="Service Featured Image"></td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('Actions')); ?></th>
                <td>
                    <a class="btn btn-secondary" href="<?php echo e(route('partners.edit', $partner->id)); ?>">Edit</a>
                    <?php echo $__env->make('admin.layouts.deleteform', ['action' => route('partners.destroy', $partner->id), 'id' => $partner->id], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="clearfix"></div>
        <hr>
        <a class="btn btn-primary" href="<?php echo e(url()->previous() == url()->current() ? '/admin/partners' :url()->previous()); ?>">Back</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>