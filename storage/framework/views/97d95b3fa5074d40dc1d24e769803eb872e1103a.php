<?php $__env->startSection('content'); ?>
    <div class="container">

        <?php if(session('status')): ?>
            <div class="alert alert-success">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-danger">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <?php if(count($categories) > 0): ?>
            <div class ="table-responsive">
                <table class="table table-condensed table-bordered">
                    <thead>
                    <tr>
                        <th colspan="3" style="border:none; font-weight:bold; font-size:20px;">Service Categories</th>
                    </tr>
                    <tr>
                        <th><b>Category ID</b></th>
                        <th><b>Category Featured Image</b></th>
                        <th><b>Category Name</b></th>
                        <th><b>Category Slug</b></th>
                        <th><b>Options</b></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo $c->id; ?></td>
                            <td>
                                <img class="img-fluid" src="<?php echo e(asset(str_replace("public","storage", $c->featured_image))); ?>" alt="">
                            </td>
                            <td><?php echo $c->name; ?></td>
                            <td><?php echo $c->slug; ?></td>
                            <td>
                                <a href="<?php echo route('service-categories.edit', [$c->id]); ?>" class="btn btn-primary">Edit</a>
                                <?php echo $__env->make('admin.layouts.deleteform', ['action' => route('service-categories.destroy', $c->id), 'id' => $c->id], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php echo e($categories->links()); ?>

            </div>
        <?php endif; ?>
        <div class="form-group">
            <label for="categories" class="col-sm-2 control-label"></label>
            <div class="col-sm-9">
                <h3>Add new category</h3>
            </div>
        </div>
        <?php echo $__env->make('errors.list', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <form action="<?php echo e(url('/admin/service-categories')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="categories" class="col-sm-2 control-label">Category Name</label>
                <div class="col-sm-9">
                    <input type="text" name="name" class="form-control" placeholder="Category Name" required>
                </div>
            </div>

            <div class="form-group">
                <label for="featured_image" class="col-sm-2 control-label">Category Featured Image</label>
                <div class="col-sm-9">
                    <input name="featured_image" type="file" class="form-control" id="featured_image" required />
                </div>
            </div>

            <div class="form-group">
                <label for="categories" class="col-sm-2 control-label"></label>
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-default">Add Category</button>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>