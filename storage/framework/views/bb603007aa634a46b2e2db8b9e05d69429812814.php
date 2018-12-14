<?php $__env->startComponent('mail::message'); ?>
# Hi <?php echo e($request->user->name); ?>


Thanks for ordering service [<?php echo e($request->service->name); ?>]. This is an invoice for your recent order.

<b>Amount Due: </b>$<?php echo e($request->invoice->details()->select(\DB::raw('sum(cost * COALESCE(quantity, 1)) as total'))->first()->total); ?><br>
<b>Due By: </b><?php echo e(\Carbon\Carbon::tomorrow()->format('m-d-Y')); ?>


<?php $__env->startComponent('mail::button', ['url' => route('user.service-requests.charge', \Hashids::encode($request->id)), 'color' => 'green']); ?>
Pay this Invoice
<?php echo $__env->renderComponent(); ?>

<b>Invoice#<?php echo e($request->invoice->id); ?></b> <br>
<b><?php echo e(\Carbon\Carbon::today()->format('m-d-Y')); ?></b>

<?php $__env->startComponent('mail::table'); ?>
    | Description       | Amount   |
    |:----------------- | --------:|
    <?php $__currentLoopData = $request->invoice->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    | <?php echo e($row->detail); ?> <b><?php echo e(($row->quantity ? ' X ' . $row->quantity : '')); ?></b> | $<?php echo e($row->cost * (is_null($row->quantity) ? 1 : $row->quantity)); ?> |
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    | <b3>Total</b3> |<b>$<?php echo e($request->invoice->details()->select(\DB::raw('sum(cost * COALESCE(quantity, 1)) as total'))->first()->total); ?></b>|
<?php echo $__env->renderComponent(); ?>

If you have any questions about this invoice, simply reply to this email or reach out to our support team for help.

Thanks,<br>
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
