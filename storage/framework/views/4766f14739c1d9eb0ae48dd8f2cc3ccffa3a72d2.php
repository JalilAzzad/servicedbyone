<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="">
            <h2 class="">Invoice For Service Request#<?php echo e($request->id); ?></h2>
        </div>
        <?php if(session('status')): ?>
            <div class="alert alert-success">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>

        <?php echo $__env->make('errors.list', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php if($request->invoice): ?>
            <?php if(is_null($request->invoice->charge_id)): ?>
                <form action="<?php echo e(route('service-requests.invoice.update', [$request->id, $request->invoice->id])); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="sort-container">
                        <?php $i = 0 ?>
                        <?php $__currentLoopData = $request->invoice->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $i++?>
                            <div class="sort-item" id="row-<?php echo e($loop->iteration); ?>">
                                <input type="hidden" class="sort-order-value" name="sort-order[<?php echo e($loop->index); ?>]" value="<?php echo e($loop->iteration); ?>">
                                <label class="sr-only" for="inlineFormInputGroup">Detail</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text dragdrop-handle"><i class="fa fa-arrows"></i></div>
                                    </div>
                                    <input name="detail[<?php echo e($loop->index); ?>]" type="text" class="form-control" placeholder="Detail" required min='0' value="<?php echo e($row->detail); ?>">
                                    <input name="cost[<?php echo e($loop->index); ?>]" type="number" step="0.01" class="form-control" placeholder="$0.0" required min='0' value="<?php echo e($row->cost); ?>">
                                    <input name="quantity[<?php echo e($loop->index); ?>]" type="number" step="1" class="form-control" placeholder="Quantity" min='0' required value="<?php echo e($row->quantity); ?>">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-danger delete-handle" type="button" data-row="<?php echo e($loop->iteration); ?>">Delete</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div><!-- /.sort-container -->

                    <div class="form-group form-check">
                        <input name="mail" type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Send Email to User?</label>
                    </div>
                    <input name="count" type="hidden" id="totalCountUpdate" value="<?php echo e($i); ?>"></input>
                    <button id="addRow" class="btn btn-outline-primary" type="button">Add Row</button>
                    <button class="btn btn-primary" type="submit">Submit</button>
                    <a class="btn btn-danger float-right" href="<?php echo e(url('admin/service-requests/changeRefferal/' . $request->invoice->id . '/' . $request->id )); ?>">Paid</a>
                </form>
            <?php else: ?>
                <div class="alert alert-info">Invoice for this request is already paid. And charge id is: <?php echo e($request->invoice->charge_id); ?></div>
            <?php endif; ?>

        <?php else: ?>
            <form action="<?php echo e(route('service-requests.invoice.store', $request->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="sort-container">
                    <div class="sort-item" id="row-1">
                        <input type="hidden" class="sort-order-value" name="sort-order[]" value="1">
                        <label class="sr-only" for="inlineFormInputGroup">Detail</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text dragdrop-handle"><i class="fa fa-arrows"></i></div>
                            </div>
                            <input name="detail[]" type="text" class="form-control" placeholder="Detail" required min='0'>
                            <input name="cost[]" type="number" step="0.01" class="form-control" placeholder="$0.0" required min='0'>
                            <input name="quantity[]" type="number" step="1" class="form-control" placeholder="Quantity" min='0' required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-danger delete-handle" type="button" data-row="1">Delete</button>
                            </div>
                        </div>
                    </div>
                </div><!-- /.sort-container -->

                <div class="form-group form-check">
                    <input name="mail" type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Send Email to User?</label>
                </div>
                <input name="count" type="hidden" id="totalCountCreate" value="1"></input>
                <button id="addRow" class="btn btn-outline-primary" type="button">Add Row</button>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
        <?php endif; ?>

        <div class="clearfix"></div>
        <hr>
        <a class="btn btn-primary" href="<?php echo e(' /admin/service-requests/'); ?>">Back</a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript">
        $(document).ready(function(){
            var count = 1;
            $('#addRow').click(function(){
                count++;
                $('.sort-container').append("<div class=\"sort-item\" id=\"row-"+count+"\">\n" +
                    "                    <input type=\"hidden\" class=\"sort-order-value\" name=\"sort-order[]\" value=\""+count+"\">\n" +
                    "                    <label class=\"sr-only\" for=\"inlineFormInputGroup\">Detail</label>\n" +
                    "                    <div class=\"input-group mb-2\">\n" +
                    "                        <div class=\"input-group-prepend\">\n" +
                    "                            <div class=\"input-group-text dragdrop-handle\"><i class=\"fa fa-arrows\"></i></div>\n" +
                    "                        </div>\n" +
                    "                        <input name=\"detail[]\" type=\"text\" class=\"form-control\" placeholder=\"Detail\" required min='0'>\n" +
                    "                        <input name=\"cost[]\" type=\"number\" step=\"0.01\" class=\"form-control\" placeholder=\"$0.0\" required min='0'>\n" +
                    "                        <input name=\"quantity[]\" type=\"number\" step=\"1\" class=\"form-control\" placeholder=\"Quantity\" min='0' required>\n" +
                    "                        <div class=\"input-group-append\">\n" +
                    "                            <button class=\"btn btn-outline-danger delete-handle\" type=\"button\" data-row=\""+count+"\">Delete</button>" +
                    "                        </div>\n" +
                    "                    </div>\n" +
                    "                </div>");
                $('#totalCountCreate').val(count);
                cnt = parseInt($('#totalCountUpdate').val()) + 1;
                $('#totalCountUpdate').val(cnt);
            });

            $( '.sort-container' ).on( 'click', '.delete-handle', function () {
                console.log('check');
                var row = $(this).data('row');
                $('#row-'+row).remove();
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>