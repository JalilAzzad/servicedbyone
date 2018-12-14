<?php $__env->startSection('content'); ?>
    <div class="container">
        You are on Admin Dashboard!!!
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>