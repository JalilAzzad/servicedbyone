<?php
    $seo_title =  "Our services | Serviced By ONE";
?>



<?php $__env->startSection('content'); ?>
    <header class="bg-primary">
        <div class="container text-left" >
            <div class="row">
                <div class="col-lg-8 col-md-10 col-sm-12 header-line">
                    <h1 class="header-title-1 tp-margin-bottom--quad">Our Services</h1>
                </div><!-- .col-8 -->
            </div><!-- .row -->
            <div class="row ">
                <div class="col-12">
                    <div class="row sticky-parent">
                        <div class="col-md-4 sticky-menu">
                            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="servicepage-category-name">
                                    <a class="js-scroll-trigger" href="<?php echo e(url('/our-services')); ?>#<?php echo e($service->name); ?>"><?php echo e($service->name); ?></a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="col-md-8">
                            <div class="is-mobile">
                                <div class="mobile-nav">
                                    <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a class="js-scroll-trigger mobile-service-category" href="<?php echo e(url('/our-services')); ?>#<?php echo e($service->name); ?>" >
                                            <span class="mobile-nav-text" ><?php echo e($service->name); ?></span>
                                        </a>                 
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>               
                             <?php for($i = 0 ; $i < sizeof($services); $i++): ?>
                                <div id="<?php echo e($category[$i]->name); ?>" class="service-list">
                                    <span class="service-category-name" ><?php echo e($category[$i]->name); ?>

                                    </span>
                                    <div class="mt-5 row">
                                        <?php $count = 0 ?>
                                        <?php $__currentLoopData = $services[$i]->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(isset($location)): ?>
                                                <?php ($url = $location->state_code.'/'.$location->slug.'/'.$service->slug); ?>
                                            <?php else: ?>
                                                <?php ($url = 'services/'.$service->slug); ?>
                                            <?php endif; ?>
                                            <div class="col-lg-4 col-sm-6 services-item mb-4">
                                                <div class="card h-100">
                                                        <a href="<?php echo e(url($url)); ?>">
                                                            <?php if($count++ < 4): ?>
                                                            <img class="card-img-top" src="<?php echo e(asset(str_replace('public','storage', $service->resized_featured_image))); ?>" alt="">
                                                            <?php endif; ?>
                                                        </a>
                                                        <div class="card-body">
                                                        <h4 class="card-title">
                                                        <a href="<?php echo e(url($url)); ?>"><?php echo e($service->name); ?></a>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                                <hr class="bb-line">
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix mt-5"></div>
            <a href="<?php echo e(url()->previous() == url()->current() ? '/' :url()->previous()); ?>" class="btn btn-primary">Go Back</a>
        </div>
    </header>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript">
        $('.input-service-name').text('Our Services');
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>