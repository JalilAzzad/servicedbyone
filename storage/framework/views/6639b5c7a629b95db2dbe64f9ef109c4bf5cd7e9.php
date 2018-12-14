<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1 class="mt-5">This page may have moved or is no longer available. ( Code #404)</h1>
        <p class="mt-4">We're sorry, but we can't find the page you requested.</p>
        <p class="mb-5">Please try finding what you need from <a href="<?php echo e(url('/')); ?>">our homepage</a>.</p>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>