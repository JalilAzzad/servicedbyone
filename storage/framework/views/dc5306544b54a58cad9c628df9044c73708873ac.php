<?php $__env->startSection('content'); ?>
    <?php if($popularServices->count()): ?>
    <header class="bg-primary">
        <div class="container text-left">
            <div class="row">
                <div class="col-lg-8 col-md-10 col-sm-12 header-line">
                    <h1 class="header-title-1 tp-margin-bottom--quad mobile-margin-top-40">Hire us for reliable help on a variety of professional services.</h1>
                    
                </div><!-- .col-8 -->
            </div><!-- .row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="one-title-5 one-margin-bottom--doubule">
                    <?php if(is_null($location)): ?>
                        Popular Services
                    <?php else: ?>
                        Popular services in <?php echo e($location->city->city); ?>, <?php echo e($location->city->state_code); ?>.
                    <?php endif; ?>
                    </div>
                </div><!-- .col-8 -->

                <?php if($agent->isMobile()): ?>
                    <div class="scrolling-wrapper services-item services-item-scroll">
                        <?php $__currentLoopData = $popularServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                            <?php if($key < 6): ?> 

                                <div class="card h-100">
                                    <?php if(is_null($location)): ?>
                                        <?php ($url = 'services/'.$service->slug); ?>
                                    <?php else: ?>
                                        <?php ($url = $location->city->state_code.'/'.$location->city->slug.'/'.$service->slug); ?>
                                    <?php endif; ?>
                                    <a href="<?php echo e(url($url)); ?>">
                                        <img class="card-img-top" src="<?php echo e(asset(str_replace("public","storage", $service->resized_featured_image))); ?>" alt="<?php echo e($service->name); ?>" onerror="this.src='<?php echo e(url('/default.png')); ?>'">
                                    </a>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a class="one-color--black-300" href="<?php echo e(url($url)); ?>"><?php echo e($service->name); ?></a>
                                        </h4>
                                    </div>
                                </div> 

                            <?php endif; ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                <?php else: ?>
                    
                        <?php $__currentLoopData = $popularServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-sm-4 col-md-3 services-item mb-4">
                                <div class="card h-100">
                                    <?php if(is_null($location)): ?>
                                        <?php ($url = 'services/'.$service->slug); ?>
                                    <?php else: ?>
                                        <?php ($url = $location->city->state_code.'/'.$location->city->slug.'/'.$service->slug); ?>
                                    <?php endif; ?>
                                    <a href="<?php echo e(url($url)); ?>">
                                        <img class="card-img-top" src="<?php echo e(asset(str_replace("public","storage", $service->resized_featured_image))); ?>" alt="<?php echo e($service->name); ?>" onerror="this.src='<?php echo e(url('/default.png')); ?>'">
                                    </a>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a href="<?php echo e(url($url)); ?>"><?php echo e($service->name); ?></a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                <?php endif; ?>
            </div>
        </div>
    </header>
    <div class="clearfix"></div>
    <?php endif; ?>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="title ">
                        <h2 class="header-title-2">What's your next project?</h2>
                        <p class="subtitle">The most popular categories</p>
                    </div>
                </div>
            </div>
            <div class="row category-boxes">
                <div class="col-sm-9">
                    <div class="row">
                    <?php ($category = $popularCategories->where('id', 1)->first()); ?>
                    <?php if($category): ?>
                        <!-- Category Box -->
                            <div class="col-6 col-sm-4">
                                <a href="<?php echo e(url('service-categories/'.$category->slug)); ?>">
                                    <div class="category-box">
                                        <img class="img-fluid" src="<?php echo e(asset(str_replace("public","storage", $category->resized_featured_image))); ?>" alt="<?php echo e($category->name); ?>">
                                        <div class="category-box-title">
                                            <h6>
                                                <?php echo e($category->name); ?>

                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                    <?php endif; ?>

                    <?php ($category = $popularCategories->where('id', 2)->first()); ?>
                    <?php if($category): ?>
                        <!-- Category Box -->
                            <div class="col-6 col-sm-4">
                                <a href="<?php echo e(url('service-categories/'.$category->slug)); ?>">
                                    <div class="category-box">
                                        <img src="<?php echo e(asset(str_replace("public","storage", $category->resized_featured_image))); ?>" alt="<?php echo e($category->name); ?>">
                                        <div class="category-box-title">
                                            <h6>
                                                <?php echo e($category->name); ?>

                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                    <?php endif; ?>

                    <?php ($category = $popularCategories->where('id', 3)->first()); ?>
                    <?php if($category): ?>
                        <!-- Category Box -->
                            <div class="col">
                                <a href="<?php echo e(url('service-categories/'.$category->slug)); ?>">
                                    <div class="category-box">
                                        <img src="<?php echo e(asset(str_replace("public","storage", $category->resized_featured_image))); ?>" alt="<?php echo e($category->name); ?>">
                                        <div class="category-box-title">
                                            <h6>
                                                <?php echo e($category->name); ?>

                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                    <?php ($category = $popularCategories->where('id', 4)->first()); ?>
                    <?php if($category): ?>
                        <!-- Category Box -->
                            <div class="col-6 col-sm-4">
                                <a href="<?php echo e(url('service-categories/'.$category->slug)); ?>">
                                    <div class="category-box">
                                        <img src="<?php echo e(asset(str_replace("public","storage", $category->resized_featured_image))); ?>" alt="<?php echo e($category->name); ?>">
                                        <div class="category-box-title">
                                            <h6>
                                                <?php echo e($category->name); ?>

                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                    <?php endif; ?>

                    <?php ($category = $popularCategories->where('id', 5)->first()); ?>
                    <?php if($category): ?>
                        <!-- Category Box -->
                            <div class="col-6 col-sm-8">
                                <a href="<?php echo e(url('service-categories/'.$category->slug)); ?>">
                                    <div class="category-box">
                                        <img src="<?php echo e(asset(str_replace("public","storage", $category->resized_featured_image))); ?>" alt="<?php echo e($category->name); ?>">
                                        <div class="category-box-title">
                                            <h6>
                                                <?php echo e($category->name); ?>

                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="row full-height">
                    <?php ($category = $popularCategories->where('id', 6)->first()); ?>
                    <?php if($category): ?>
                        <!-- Category Box -->
                            <div class="col full-height">
                                <a href="<?php echo e(url('service-categories/'.$category->slug)); ?>">
                                    <div class="category-box category-box-alt">
                                        <img src="<?php echo e(asset(str_replace("public","storage", $category->resized_featured_image))); ?>" alt="<?php echo e($category->name); ?>">
                                        <div class="category-box-title">
                                            <h6>
                                                <?php echo e($category->name); ?>

                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="how">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="title ">
                        <h2 class="header-title-2">All <?php echo e($states->count()); ?> States</h2>
                        
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 mx-auto col-md-12">
                    <p class="leadtext">From big cities to small towns, we’ve got professionals on call covering every county in the U.S, From the smallest job to the toughest we've got it covered.</p>

                    <a href="/our-services" class="btn btn-primary mb-4">Explore our services</a>

                </div>
                <div class="col-lg-4 col-md-12">
                    <img src="<?php echo e(asset('images/us.png')); ?>" class="home-map" alt="US Map">
                </div>
                <div class="col-lg-12 mx-auto">
                    <ol class="states-list__list">
                        <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a class="one-link--dark one-color--black-300" href="<?php echo e(url($state->state_code)); ?>"><?php echo e($state->state); ?></a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <h2 class="header-title-2">About this page</h2>
                    <p class="lead">From big cities to small towns, we’ve got pros covering every county in the United States. From the smallest job to the toughest we've got it covered.</p>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>