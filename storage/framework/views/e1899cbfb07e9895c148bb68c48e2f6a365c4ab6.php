<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Service Referrals</h3>
                   
                    <h5 class="float-right referral">Total Commission: $<?php echo e($total); ?></h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Referee</th>
                                <th scope="col">Commission</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $referees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($referee->email); ?></td>
                                    <td>$<?php echo e($referee->commission); ?></td>
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