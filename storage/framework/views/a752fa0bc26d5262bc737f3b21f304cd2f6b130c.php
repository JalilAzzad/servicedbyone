<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="">
            <h2 class="">SEO</h2>
        </div>
        <?php echo $__env->make('errors.list', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <form action="<?php echo e(route('seos.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="slug">URL</label>
                <input name="url" type="text" class="form-control" id="url" placeholder="https://servicedbyone.com/example" value="<?php echo e(old('url')); ?>">
            </div>
            <div class="form-group">
                <label for="slug">Title</label>
                <input name="slug" type="text" class="form-control" id="slug" placeholder="" value="<?php echo e(old('slug')); ?>">
            </div>
            <div class="form-group">
                <label for="keywords">Key-Words</label>
                <input name="keywords" type="text" class="form-control" id="keywords" placeholder="keyword1,keyword2" value="<?php echo e(old('keywords')); ?>">
            </div>
            <div class="form-group">
                <label for="meta_desc">Meta-Description</label>
                <input name="meta_desc" type="text" class="form-control" id="meta_desc" placeholder="Description" value="<?php echo e(old('meta_desc')); ?>">
            </div>

            <a class="btn btn-danger" href="<?php echo e(url()->previous() == url()->current() ? '/admin/seos/' :url()->previous()); ?>">Cancel</a>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>