<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="">
            <h2 class="">Service#<?php echo e($service->id); ?></h2>
        </div>
        <table class="table">
            <tbody>
            <tr>
                <th scope="row">#</th>
                <td><?php echo e($service->id); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('Name')); ?></th>
                <td><?php echo e($service->name); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('Slug')); ?></th>
                <td><?php echo e($service->slug); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('Description')); ?></th>
                <td><?php echo e($service->description); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('Categories')); ?></th>
                <td>
                    <?php $__currentLoopData = $service->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($c->id . ' | ' . $c->name); ?> <br/>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('Location Type')); ?></th>
                <td><?php echo e($service->location_type); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('State Locations')); ?></th>
                <td>
                    <?php $__currentLoopData = $service->states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($l->state . ' | ' . $l->state_code); ?> <br/>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('City Locations')); ?></th>
                <td>
                    <?php $__currentLoopData = $service->cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($l->city . ' | ' . $l->state_code); ?> <br/>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('City Area Locations')); ?></th>
                <td>
                    <?php $__currentLoopData = $service->areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($l->county . ' | ' . sprintf("%05d", $l->zip) . ' | ' . $l->city->city . ' | ' . $l->city->state_code); ?> <br/>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('Questions')); ?></th>
                <td>
                    <?php $__currentLoopData = $service->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($q->id . ' | ' . $q->name . ' | ' . $q->question); ?> <br/>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('Featured Image')); ?></th>
                <td><img class="img-thumbnail" src="<?php echo e(is_null($service->featured_image) ? asset('/images/service-default.png') : asset(str_replace("public","storage", $service->featured_image))); ?>" alt="Service Featured Image"></td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('Actions')); ?></th>
                <td>
                    <a class="btn btn-secondary" href="<?php echo e(route('services.edit', $service->id)); ?>">Edit</a>
                    <?php echo $__env->make('admin.layouts.deleteform', ['action' => route('services.destroy', $service->id), 'id' => $service->id], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="clearfix"></div>
        <hr>
        <a class="btn btn-primary" href="<?php echo e(url()->previous() == url()->current() ? '/admin/services' :url()->previous()); ?>">Back</a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>