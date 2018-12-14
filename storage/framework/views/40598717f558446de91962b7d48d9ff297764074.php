<?php $__env->startSection('content'); ?>
    <div class="container">
        <div>
            <h2>Service Requests</h2>
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
                <th scope="col">User</th>
                <th scope="col">Invoice</th>
                <th scope="col">Created At</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th scope="row"><?php echo e($request->id); ?></th>
                <td>
                    <?php if($request->user): ?>
                        <a href="<?php echo e(route('users.show', $request->user->id)); ?>"><?php echo e($request->user->id . ' | ' . $request->user->email); ?></a>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if($request->invoice): ?>
                        <?php if(is_null($request->invoice->charge_id)): ?>
                            <p class="text-danger">Not Paid</p>
                        <?php else: ?>
                            Charge ID: <?php echo e($request->invoice->charge_id); ?>

                        <?php endif; ?>
                    <?php else: ?>
                        <p class="text-danger">No Invoice Found</p>
                    <?php endif; ?>
                </td>
                <td><?php echo e($request->created_at->toRfc850String()); ?></td>
                <td>
                    <a class="btn btn-primary" href="<?php echo e(route('service-requests.show', $request->id)); ?>">Show</a>
                    <a class="btn btn-secondary" href="<?php echo e(url('admin/service-requests/showInvoice/' . $request->id )); ?>">Invoice</a>
                
                    <?php echo $__env->make('admin.layouts.deleteform', ['action' => route('service-requests.destroy', $request->id), 'id' => $request->id], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <?php echo e($requests->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>