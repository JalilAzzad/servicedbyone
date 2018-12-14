<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="">
            <h2 class="">Create Service</h2>
        </div>
        <?php echo $__env->make('errors.list', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <form action="<?php echo e(route('services.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control" id="name" value="<?php echo e(old('name')); ?>">
            </div>
            <div class="form-group">
                <label for="name">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control"><?php echo e(old('description')); ?></textarea>
            </div>
            
                
                
                    
                    
                    
                    
                
            
            <div class="form-group" id="locations-form-group">
                <label for="locations">Locations</label>
                <select name="locations[]" multiple class="form-control" id="locations"></select>
            </div>
            <div class="form-group">
                <label for="categories">Categories</label>
                <select name="categories[]" multiple class="form-control" id="categories"></select>
            </div>
            <div class="form-group">
                <label for="questions">Questions</label>
                <select name="questions[]" multiple class="form-control" id="questions"></select>
            </div>

            <div class="form-group">
                <label for="featured_image">Featured Image</label>
                <input name="featured_image" type="file" class="form-control" id="featured_image" />
            </div>

            <a class="btn btn-danger" href="<?php echo e(url()->previous() == url()->current() ? '/admin/services/' :url()->previous()); ?>">Cancel</a>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#locations').select2({
                ajax: {
                    url: "<?php echo e(url('/admin/services/states')); ?>",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function (data, params) {
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        params.page = params.page || 1;

                        return {
                            results: data.data,
                            pagination: {
                                more: (params.page * 15) < data.total
                            }
                        };
                    },
                    cache: true
                },
                placeholder: 'Search for a location',
                escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
                templateResult: formatLocation,
                templateSelection: formatLocationSelection,
                closeOnSelect: false
            });

            function formatLocation (location) {
                if (location.loading) {
                    return location.text;
                }

                var markup = "<div class='select2-result-location clearfix'>" +
                    "<div class='select2-result-location__meta'>" +
                    "<div class='select2-result-location__title'>" + location.state + ' | ' + location.state_code + "</div>" +
                    "</div>" +
                    "</div>";

                return markup;
            }

            function formatLocationSelection (location) {
                return location.state + " | " + location.state_code;
            }



            $('#categories').select2({
                ajax: {
                    url: "<?php echo e(url('/admin/services/categories')); ?>",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function (data, params) {
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        params.page = params.page || 1;

                        return {
                            results: data.data,
                            pagination: {
                                more: (params.page * 15) < data.total
                            }
                        };
                    },
                    cache: true
                },
                placeholder: 'Search for a Category',
                escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
                templateResult: formatCategory,
                templateSelection: formatCategorySelection,
                closeOnSelect: false
            });

            function formatCategory (category) {
                return category.id + " | " + category.name;
            }

            function formatCategorySelection (category) {
                return category.name;
            }


            $('#questions').select2({
                ajax: {
                    url: "<?php echo e(url('/admin/services/questions')); ?>",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function (data, params) {
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        params.page = params.page || 1;

                        return {
                            results: data.data,
                            pagination: {
                                more: (params.page * 10) < data.total
                            }
                        };
                    },
                    cache: true
                },
                placeholder: 'Search for a Question by name',
                escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
                templateResult: formatQuestion,
                templateSelection: formatQuestionSelection,
                closeOnSelect: false
            });

            function formatQuestion (question) {
                return question.id + " | " + question.name + " | " + question.question;
            }

            function formatQuestionSelection (question) {
                return question.id + " | " + question.name + " | " + question.question;
            }

            <?php $__currentLoopData = \App\Models\State::whereIn('id', old('locations', []))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            $("#locations").select2("trigger", "select", {data: <?php echo json_encode($l->only(['id', 'state', 'state_code'])); ?>});
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php $__currentLoopData = \App\Models\ServiceCategory::whereIn('id', old('categories', []))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            $("#categories").select2("trigger", "select", {data: <?php echo json_encode($c->only(['id', 'name'])); ?>});
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php $__currentLoopData = \App\Models\ServiceQuestion::whereIn('id', old('questions', []))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            $("#questions").select2("trigger", "select", {data: <?php echo json_encode($c->only(['id', 'name', 'question'])); ?>});
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            $('#location_type').on('change', function() {
                onChangeLocationType(this.value);
            });

            function onChangeLocationType(value) {
                if(value == '<?php echo e(\App\Models\Service::LOCATION_TYPE_ALL); ?>') {
                    $('#locations-form-group').hide();
                } else if(value == '<?php echo e(\App\Models\Service::LOCATION_TYPE_IN); ?>') {
                    $('#locations-form-group').show();
                } else if(value == '<?php echo e(\App\Models\Service::LOCATION_TYPE_EXCEPT); ?>') {
                    $('#locations-form-group').show();
                } else if(value == '<?php echo e(\App\Models\Service::LOCATION_TYPE_VIRTUAL); ?>') {
                    $('#locations-form-group').hide();
                }
            }

            onChangeLocationType($('#location_type').val());
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>