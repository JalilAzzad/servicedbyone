<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="">
            <h2 class="">Service Request#<?php echo e($request->id); ?></h2>
        </div>
        <?php if(session('status')): ?>
            <div class="alert alert-success">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>
        <table class="table">
            <tbody>
            <tr>
                <th scope="row">#</th>
                <td><?php echo e($request->id); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('Service ID')); ?></th>
                <td><?php echo e($request->service_id); ?> | <?php echo e($request->service->name); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('Location')); ?></th>
                <td><?php echo e($request->location->zip); ?> | <?php echo e($request->location->city->city); ?> | <?php echo e($request->location->city->state_code); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('Created At')); ?></th>
                <td><?php echo e($request->created_at->toRfc850String()); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('Updated At')); ?></th>
                <td><?php echo e($request->updated_at->toRfc850String()); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php echo e(__('Actions')); ?></th>
                <td>
                    <?php echo $__env->make('admin.layouts.deleteform', ['action' => route('service-requests.destroy', $request->id), 'id' => $request->id], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="clearfix"></div>
        <hr>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Question</th>
                    <th scope="col">Answer</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $request->service->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($question->id); ?> | <?php echo e($question->name); ?> | <?php echo e($question->question); ?></td>
                        <td>
                            <?php ($a = $request->answers->where('question_id', $question->id)->first()); ?>
                            <?php if(is_null($a)): ?>
                                <p class="text-danger">No Answer</p>
                            <?php else: ?>
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
                                        <?php echo e($c->answer->choice->id); ?> | <?php echo e($c->answer->choice->choice); ?><br />
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php elseif($question->type == \App\Models\ServiceQuestion::TYPE_SELECT_MULTIPLE): ?>
                                    <?php $__currentLoopData = $request->answers->where('question_id', $question->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e($c->answer->choice->id); ?> | <?php echo e($c->answer->choice->choice); ?><br />
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div class="clearfix"></div>
        <hr>

        <a class="btn btn-primary" href="<?php echo e(url()->previous() == url()->current() ? '/admin/service-requests' :url()->previous()); ?>">Back</a>
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