<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Service Request for <b><?php echo e($request->service->name); ?></b></h4>
                    <hr>
                    <?php echo $__env->make('errors.list', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Question</th>
                                <th scope="col">Answer</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $request->answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($a->question->question); ?></td>
                                    <td>
                                        <?php ($question = $a->question); ?>
                                        <?php if($question->type == \App\Models\ServiceQuestion::TYPE_BOOLEAN): ?>
                                            <?php echo e($a->answer->answer ? 'Yes' : 'No'); ?>

                                        <?php elseif($question->type == \App\Models\ServiceQuestion::TYPE_TEXT): ?>
                                            <?php echo e($a->answer->answer); ?>

                                        <?php elseif($question->type == \App\Models\ServiceQuestion::TYPE_TEXT_MULTILINE): ?>
                                            <?php echo e($a->answer->answer); ?>

                                        <?php elseif($question->type == \App\Models\ServiceQuestion::TYPE_TIME): ?>
                                            <?php echo e($a->answer->answer); ?>

                                        <?php elseif($question->type == \App\Models\ServiceQuestion::TYPE_DATE): ?>
                                            <?php echo e($a->answer->answer); ?>

                                        <?php elseif($question->type == \App\Models\ServiceQuestion::TYPE_DATE_TIME): ?>
                                            <?php echo e($a->answer->answer); ?>

                                        <?php elseif($question->type == \App\Models\ServiceQuestion::TYPE_FILE): ?>
                                            <img src="<?php echo e(asset(str_replace("public","storage", $a->answer->file_path))); ?>" alt="" style="width: 100%">
                                        <?php elseif($question->type == \App\Models\ServiceQuestion::TYPE_FILE_MULTIPLE): ?>
                                            <?php $__currentLoopData = $request->answers->where('question_id', $question->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <img src="<?php echo e(asset(str_replace("public","storage", $c->answer->file_path))); ?>" alt="" style="width: 100%"><br />
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php elseif($question->type == \App\Models\ServiceQuestion::TYPE_SELECT): ?>
                                            <?php $__currentLoopData = $request->answers->where('question_id', $question->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e($c->answer->choice->choice); ?><br />
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php elseif($question->type == \App\Models\ServiceQuestion::TYPE_SELECT_MULTIPLE): ?>
                                            <?php $__currentLoopData = $request->answers->where('question_id', $question->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e($c->answer->choice->choice); ?><br />
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    <?php if($request->invoice): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Description</th>
                                    <th scope="col">Cost</th>
                                    <th scope="col">Quantity</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $request->invoice->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($detail->detail); ?></td>
                                        <td>$<?php echo e(number_format($detail->cost * ($detail->quantity ? $detail->quantity : 1), 2)); ?></td>
                                        <td><b><?php echo e(($detail->quantity ? 'X ' . $detail->quantity : '')); ?></b></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"></th>
                                    <td class="text-right"><b>Total</b></td>
                                    <td><b>$<?php echo e($request->invoice->details()->select(\DB::raw('sum(cost * COALESCE(quantity, 1)) as total'))->first()->total); ?></b></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>


                        <?php if(is_null($request->invoice->charge_id)): ?>
                            <div>
                                <div class="alert alert-success" id="success" style="display:none;">Payment Successfull!</div>
                                <div class="alert alert-danger" id="fail" style="display:none;">Payment Declined!</div>
                            </div>

                            <div class="">
                                <div id="payment-request-button" class="mb-3">
                                    <!-- A Stripe Element will be inserted here. -->
                                </div>

                                <form action="<?php echo e(route('user.service-requests.charge', $request->id)); ?>" method="POST" class="pull-right" id="stripe-payment-element">
                                    <?php echo csrf_field(); ?>
                                    <script
                                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                            data-key="pk_test_kv0g7LnJZvNeblzW2hLrOTjm"
                                            data-amount="<?php echo e((int) ($request->invoice->details()->select(\DB::raw('sum(cost * quantity) as total'))->first()->total * 100)); ?>"
                                            data-name="ServicedByOne.com"
                                            data-description="ServicedByONE LLC"
                                            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                            data-locale="auto"
                                            data-zip-code="true"
                                            data-billing-address="true">
                                    </script>
                                </form>
                            </div>

                            <div class="clearfix"></div>
                        <?php else: ?>
                            <div class="alert alert-success">This invoice is already paid!</div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('styles'); ?>
    <?php if($request->invoice): ?>
        <script src="https://js.stripe.com/v3/"></script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php if($request->invoice): ?>
        <script type="text/javascript">
            $(document).ready(function () {

                // Create a Stripe client.
                var stripe = Stripe('pk_test_kv0g7LnJZvNeblzW2hLrOTjm');

                var paymentRequest = stripe.paymentRequest({
                    country: 'US',
                    currency: 'usd',
                    total: {
                        label: "Payment for Service <?php echo e($request->service->name); ?>",
                        amount: <?php echo e((int) ($request->invoice->details()->select(\DB::raw('sum(cost * quantity) as total'))->first()->total * 100)); ?>,
                    },
                    requestPayerName: true,
                    requestPayerEmail: true,
                });

                var elements = stripe.elements();
                var prButton = elements.create('paymentRequestButton', {
                    paymentRequest: paymentRequest,
                });

                // Check the availability of the Payment Request API first.
                paymentRequest.canMakePayment().then(function(result) {
                    if (result) {
                        prButton.mount('#payment-request-button');
                    } else {
                        document.getElementById('payment-request-button').style.display = 'none';
                    }
                });

                paymentRequest.on('token', function(ev) {
                    // Send the token to your server to charge it!
                    fetch("<?php echo e(route('user.service-requests.chargeJson', $request->id)); ?>", {
                        method: 'POST',
                        body: JSON.stringify({stripeToken: ev.token.id, _token: $('meta[name="csrf-token"]').attr('content')}),
                        headers: {
                            'content-type': 'application/json',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    })
                        .then(function(response) {
                            if (response.ok) {
                                // Report to the browser that the payment was successful, prompting
                                // it to close the browser payment interface.
                                ev.complete('success');
                                console.log('success');
                                $('#payment-request-button').slideUp();
                                $('#stripe-payment-element').slideUp();
                                $('#success').slideDown();
                            } else {
                                // Report to the browser that the payment failed, prompting it to
                                // re-show the payment interface, or show an error message and close
                                // the payment interface.
                                ev.complete('fail');
                                console.log('fail');
                                $('#error').slideDown();
                            }
                        });
                });
            });
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>