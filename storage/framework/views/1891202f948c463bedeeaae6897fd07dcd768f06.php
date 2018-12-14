<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Service Requests</h3>
                    <p class="card-text">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    </p>
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Service</th>
                                <th scope="col">Requested At</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($request->service->name); ?></td>
                                    <td><?php echo e($request->created_at->toFormattedDateString()); ?></td>
                                    <td>
                                        <?php if(is_null($request->invoice)): ?>
                                            <p class="text-info">Wait for Quote</p>
                                        <?php else: ?>
                                            <?php if(is_null($request->invoice->charge_id)): ?>
                                                <p class="text-danger">Invoice need to be paid</p>
                                            <?php else: ?>
                                                <p class="text-success">Invoice paid</p>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('user.service-requests.show', $request->id)); ?>" class="btn btn-outline-primary">View Details</a>
                                        <?php if(!is_null($request->invoice) && is_null($request->invoice->charge_id)): ?>
                                            <a href="<?php echo e(route('user.service-requests.invoice', \Hashids::encode($request->id))); ?>" class="btn btn-outline-primary">Pay Invoice</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>