<?php $__env->startSection('content'); ?>
    <div class="jumbotron jumbotron-fluid"
         style="background: linear-gradient(rgba(0, 0, 0, 0.65) 35%, rgba(0, 0, 0, 0.8) 80%), url('<?php echo e(asset(str_replace("public","storage", $service->featured_image))); ?>');
                background-repeat: no-repeat;
                background-size: cover;
                background-color: #f5f8fa;
                color: #fff;" >
        <div class="container margin-top-50">
            <?php if((isset($location) && !is_null($location) && $location->city_id == $city->id)): ?>
            <h4 class="display-6 text-center"><?php echo e($city->city); ?>, <?php echo e($city->state_code); ?></h4>
            <?php elseif(isset($location) && !is_null($location)): ?>
            <h4 class="display-6 text-center"><?php echo e($location->city->city); ?>, <?php echo e($location->city->state_code); ?></h4>
            <?php endif; ?>
            <div class="col-sm-6 mx-auto" style="background-color: rgb(255, 255, 255);color: #000;">
                <div class="p-sm-5 pt-5 pb-5">
                    <h3 class="display-6 text-center">Where do you need <?php echo e($service->name); ?>?</h3>

                    <div class="input-group mb-3">
                        <input id="city_id_input" value="<?php echo e($location->city_id == $city->id ?$location->zip:$location->zip); ?>" type="text" class="form-control" placeholder="Enter your zip code" aria-label="Enter your zip code" aria-describedby="go-button">
                        <div class="input-group-append">
                            <button class="btn btn-success font-weight-bold" type="button" id="go-button" data-toggle="modal" data-target="#exampleModal">GO</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <input type="hidden" class="service-name" value="<?php echo e($service->name); ?>">
    <section class="bg-primary">
        <div class="container text-left">
            <?php if($errors->any()): ?>
                <div class="alert alert-danger mb-5">
                    <ul>
                        <?php if($errors->has('city_id')): ?>
                            <li>The zip code is invalid or this service is not available for your location.</li>
                            
                        <?php endif; ?>
                        <?php $__currentLoopData = $service->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(str_contains($error, 'answer-'. $q->id)): ?>
                                    <li><?php echo e(str_replace('answer-'. $q->id, $q->name, $error)); ?></li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if(session('status')): ?>
                <div class="alert alert-success mb-5">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-lg-8 col-md-10 col-sm-12 header-line">
                    <h1 class="header-title-1 tp-margin-bottom--quad"><?php echo e($service->name); ?></h1>
                </div><!-- .col-8 -->
            </div><!-- .row -->

            <div class="row">
                <div class="col-lg-12">
                    <div><?php echo $service->description; ?></div>
                </div><!-- .col-8 -->
            </div>

            
            
                
            

            <!-- Modal -->
            <div class="modal fade service-question-modal questions-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="<?php echo e(url('/services/'.$service->id)); ?>" method="POST" enctype="multipart/form-data" id="questionsForm">
                        <?php echo csrf_field(); ?>
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Answer Questions</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input id="city_id" type="hidden" name="city_id" value="<?php echo e($location->city_id == $city->id ? $location->zip : $city->areas()->first()->zip); ?>" />
                            <div class="alert alert-danger" id="error" style="display: none;"></div>
                            <?php ($i = 1); ?>
                            <?php ($question_ids = []); ?>
                            <?php $__currentLoopData = $service->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php ($required = false); ?>
                                <?php ($continue = false); ?>
                                <?php $__currentLoopData = $question->rules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($rule->rule == \App\Models\ServiceQuestionValidationRule::AUTH_REQUIRED): ?>
                                        <?php if (! (auth()->check())): ?>
                                            <?php ($continue = true); ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if($rule->rule == \App\Models\ServiceQuestionValidationRule::AUTH_GUEST): ?>
                                        <?php if (! (auth()->guest())): ?>
                                            <?php ($continue = true); ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if($rule->rule == \App\Models\ServiceQuestionValidationRule::REQUIRED): ?>
                                        <?php ($required = $question->required = true); ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if($continue) continue; ?>
                                <div class="service-question service-question-<?php echo e($question->type); ?>" id="service-question-<?php echo e($question->id); ?>"
                                        <?php if($i != 1): ?> style="display: none;" <?php endif; ?> data-required="<?php echo e($required); ?>" data-type="<?php echo e($question->type); ?>">
                                    <h3><?php echo e($question->question); ?><?php echo e($required ? '*' : ''); ?> </h3>
                                    <?php if($question->type == \App\Models\ServiceQuestion::TYPE_BOOLEAN): ?>
                                        <div class="form-check">
                                            <input name="answer-<?php echo e($question->id); ?>" class="form-check-input" type="radio" id="answer-boolean-<?php echo e($question->id); ?>-yes" value="1" <?php if($required): ?> required <?php endif; ?> <?php if(old('answer-'.$question->id, false)): ?> checked <?php endif; ?>>
                                            <label class="form-check-label" for="answer-boolean-<?php echo e($question->id); ?>-yes">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input name="answer-<?php echo e($question->id); ?>" class="form-check-input" type="radio" id="answer-boolean-<?php echo e($question->id); ?>-no" value="0" <?php if($required): ?> required <?php endif; ?> <?php if (! (old('answer-'.$question->id, false))): ?> checked <?php endif; ?>>
                                            <label class="form-check-label" for="answer-boolean-<?php echo e($question->id); ?>-no">
                                                No
                                            </label>
                                        </div>
                                    <?php elseif($question->type == \App\Models\ServiceQuestion::TYPE_TEXT): ?>
                                        <?php if($question->name == 'guest.email'): ?>
                                            <input type="email" name="answer-<?php echo e($question->id); ?>" class="form-control" <?php if($required): ?> required <?php endif; ?> value="<?php echo e(old('answer-'.$question->id)); ?>" />
                                        <?php elseif($question->name == 'guest.phone'): ?>
                                            <input type="tel" name="answer-<?php echo e($question->id); ?>" class="form-control" <?php if($required): ?> required <?php endif; ?> value="<?php echo e(old('answer-'.$question->id)); ?>" />
                                        <?php else: ?>
                                            <input type="text" name="answer-<?php echo e($question->id); ?>" class="form-control" <?php if($required): ?> required <?php endif; ?> value="<?php echo e(old('answer-'.$question->id)); ?>" />
                                        <?php endif; ?>
                                    <?php elseif($question->type == \App\Models\ServiceQuestion::TYPE_TEXT_MULTILINE): ?>
                                        <textarea name="answer-<?php echo e($question->id); ?>" class="form-control" <?php if($required): ?> required <?php endif; ?>><?php echo e(old('answer-'.$question->id)); ?></textarea>
                                    <?php elseif($question->type == \App\Models\ServiceQuestion::TYPE_DATE): ?>
                                        <input type="date" name="answer-<?php echo e($question->id); ?>" class="form-control" <?php if($required): ?> required <?php endif; ?> value="<?php echo e(old('answer-'.$question->id)); ?>" />
                                    <?php elseif($question->type == \App\Models\ServiceQuestion::TYPE_TIME): ?>
                                        <input type="time" name="answer-<?php echo e($question->id); ?>" class="form-control" <?php if($required): ?> required <?php endif; ?> value="<?php echo e(old('answer-'.$question->id)); ?>" />
                                    <?php elseif($question->type == \App\Models\ServiceQuestion::TYPE_DATE_TIME): ?>
                                        <input type="datetime-local" name="answer-<?php echo e($question->id); ?>" class="form-control" <?php if($required): ?> required <?php endif; ?> value="<?php echo e(old('answer-'.$question->id)); ?>" />
                                    <?php elseif($question->type == \App\Models\ServiceQuestion::TYPE_FILE): ?>
                                        <input type="file" name="answer-<?php echo e($question->id); ?>" <?php if($required): ?> required <?php endif; ?> accept="image/*" />
                                    <?php elseif($question->type == \App\Models\ServiceQuestion::TYPE_FILE_MULTIPLE): ?>
                                        <input type="file" name="answer-<?php echo e($question->id); ?>[]" <?php if($required): ?> required <?php endif; ?> accept="image/*" multiple />
                                    <?php elseif($question->type == \App\Models\ServiceQuestion::TYPE_SELECT): ?>
                                        <?php $__currentLoopData = $question->choices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $choice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="form-check">
                                                <input name="answer-<?php echo e($question->id); ?>" class="form-check-input" type="radio" id="answer-choice-<?php echo e($choice->id); ?>" value="<?php echo e($choice->id); ?>" <?php if($required): ?> required <?php endif; ?> <?php if(old('answer-'.$question->id, false) == $choice->id): ?> checked <?php endif; ?>>
                                                <label class="form-check-label" for="answer-choice-<?php echo e($choice->id); ?>">
                                                    <?php echo e($choice->choice); ?>

                                                </label>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php elseif($question->type == \App\Models\ServiceQuestion::TYPE_SELECT_MULTIPLE): ?>
                                        <?php $__currentLoopData = $question->choices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $choice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="form-check">
                                                <input name="answer-<?php echo e($question->id); ?>[]" class="form-check-input" type="checkbox" id="answer-choice-<?php echo e($choice->id); ?>" value="<?php echo e($choice->id); ?>" <?php if($required): ?> required <?php endif; ?> <?php if( in_array($choice->id, old('answer-'.$question->id, [])) ): ?> checked <?php endif; ?>>
                                                <label class="form-check-label" for="answer-choice-<?php echo e($choice->id); ?>">
                                                    <?php echo e($choice->choice); ?>

                                                </label>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                                <?php (array_push($question_ids, $question->id)); ?>
                                <?php ($i++); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class="alert alert-success" style="display: none;" id="loading">Submiting Request...</div>
                        </div>
                        <div class="modal-footer">
                            
                            <?php if (! (isset($question_ids[0]) && $service->questions->where('id', $question_ids[0])->first()->required)): ?>
                                <button type="button" class="btn btn-outline-danger" id="skip">Skip</button>
                            <?php endif; ?>
                            <button type="button" class="btn btn-primary" id="next">Next</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            var city = $('#city_id');
            var city_input = $('#city_id_input');

            city_input.on('keyup', function () {
                city.val(parseInt(city_input.val()));
            });

            var questions = <?php echo json_encode($question_ids); ?>;
            var currentQuestionIndex = 0;
            var countQuestions = <?php echo e(count($question_ids)); ?>;

            $( "#next" ).click(function() {
                // Check Validity
                var error = $('#error');
                var loading = $('#loading');
                var type = $("#service-question-" + questions[currentQuestionIndex]).data("type");
                var required = $("#service-question-" + questions[currentQuestionIndex]).data("required");

                if(type == '<?php echo \App\Models\ServiceQuestion::TYPE_SELECT_MULTIPLE; ?>') {
                    var inpObj = $("input[name='answer-"+questions[currentQuestionIndex]+"[]']:checked");
                    if(required == 1) {
                        if (!inpObj.length) {
                            error.html("Please select one of these options.");
                            error.slideDown();
                            return false;
                        }
                    }
                } else if(type == '<?php echo \App\Models\ServiceQuestion::TYPE_FILE_MULTIPLE; ?>') {
                    var inpObj = document.getElementsByName("answer-"+questions[currentQuestionIndex]+"[]");
                    if (!inpObj[0].checkValidity()) {
                        error.html(inpObj[0].validationMessage);
                        error.slideDown();
                        return false;
                    }
                } else {
                    var inpObj = $("input[name='answer-"+questions[currentQuestionIndex]+"']");
                    if (!inpObj[0].checkValidity()) {
                        error.html(inpObj[0].validationMessage);
                        error.slideDown();
                        return false;
                    }
                }
                error.slideUp();


                $( "#service-question-" + questions[currentQuestionIndex] ).slideUp(400, function() {
                    // Animation complete.
                    if(currentQuestionIndex >= countQuestions - 1) // Check if last question
                    {
                        loading.slideDown();
                        $('#questionsForm').submit();
                        console.log('Last question');
                    } else {
                        currentQuestionIndex++;
                        if($(this).data("required") == 1)
                            $('#skip').hide();
                        else
                            $('#skip').show();

                        $( "#service-question-" + questions[currentQuestionIndex] ).slideDown(400);
                    }
                });
            });
        });

        $('.input-service-name').text($(".service-name").val());
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>