<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="">
            <h2 class="">Service#<?php echo e($partner->id); ?></h2>
        </div>
        <?php echo $__env->make('errors.list', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <form action="<?php echo e(route('partners.update', $partner->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo method_field('PUT'); ?>
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control" id="name" value="<?php echo e(old('name', false) ? old('name') : $partner->name); ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input name="email" type="email" class="form-control" id="email" value="<?php echo e(old('email', false) ? old('email') : $partner->email); ?>">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input name="phone" type="tel" class="form-control" id="phone" value="<?php echo e(old('phone', false) ? old('phone') : $partner->phone); ?>">
            </div>
            <div class="form-group">
                <label for="website">Website</label>
                <input name="website" type="text" class="form-control" id="website" value="<?php echo e(old('website', false) ? old('website') : $partner->url); ?>">
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input name="slug" type="text" class="form-control" id="slug" value="<?php echo e(old('slug', false) ? old('slug') : $partner->slug); ?>">
            </div>
            <div class="form-group">
                <label for="name">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control"><?php echo e(old('description', false) ? old('description') : $partner->description); ?></textarea>
            </div>
            <div class="form-group">
                <label for="featured_image">Featured Image</label>
                <input name="featured_image" type="file" class="form-control" id="featured_image" />
            </div>
            <input type="hidden" name="partnerId" value="<?php echo e($partner->id); ?>">
            <a class="btn btn-danger" href="<?php echo e(url()->previous() == url()->current() ? '/admin/partners/' :url()->previous()); ?>">Cancel</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>