<?php $__env->startSection('content'); ?>
    <div class="container">
        <div>
            <h2>Service Questions</h2>
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
                <th scope="col">Question</th>
                <th scope="col">Type</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th scope="row"><?php echo e($question->id); ?></th>
                <td><?php echo e($question->name); ?></td>
                <td><?php echo e($question->question); ?></td>
                <td><?php echo e($question->type); ?></td>
                <td>
                    <a class="btn btn-primary" href="<?php echo e(route('service-questions.show', $question->id)); ?>">Show</a>
                    <?php if (! ($question->is_locked)): ?>
                    <a class="btn btn-secondary" href="<?php echo e(route('service-questions.edit', $question->id)); ?>">Edit</a>
                    <?php echo $__env->make('admin.layouts.deleteform', ['action' => route('service-questions.destroy', $question->id), 'id' => $question->id], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <?php echo e($questions->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>