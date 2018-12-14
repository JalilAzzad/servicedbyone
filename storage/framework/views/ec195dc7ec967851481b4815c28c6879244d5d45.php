<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=0"/>

    <link rel="apple-touch-icon" sizes="180x180" href="/favicon.png">
    <link rel="icon" type="image/png" href="/favicon.png" sizes="32x32">
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="shortcut icon" type="image/png" href="<?php echo e(url('/favicon.png')); ?>"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <?php if(request()->route()->getName() == 'home'): ?>  
        <?php if( empty($seo) ): ?>
            <title>Serviced By ONE</title>
        <?php else: ?>
            <title><?php echo e($seo->slug); ?></title>
            <meta name="description" content="<?php echo e($seo->meta_desc); ?>">
            <meta name="keywords" content="<?php echo e($seo->keywords); ?>">    
        <?php endif; ?>
    <?php elseif(isset($seo_title)): ?> 
        <?php if( empty($seo) ): ?>
            <title><?php echo e($seo_title); ?></title>
        <?php else: ?>
            <title><?php echo e($seo->slug); ?></title>
            <meta name="description" content="<?php echo e($seo->meta_desc); ?>">
            <meta name="keywords" content="<?php echo e($seo->keywords); ?>">    
        <?php endif; ?>
    <?php elseif(isset($service->name)): ?>
        
        <?php if( empty($seo) ): ?>
            <title><?php echo e($service->name); ?> | Serviced By ONE</title>
        <?php else: ?>
            <title><?php echo e($seo->slug); ?></title>
            <meta name="description" content="<?php echo e($seo->meta_desc); ?>">
            <meta name="keywords" content="<?php echo e($seo->keywords); ?>">    
        <?php endif; ?>

    <?php else: ?>   
        <?php if( empty($seo) ): ?>
            <title>Serviced By ONE</title>
        <?php else: ?>
            <title><?php echo e($seo->slug); ?></title>
            <meta name="description" content="<?php echo e($seo->meta_desc); ?>">
            <meta name="keywords" content="<?php echo e($seo->keywords); ?>">    
        <?php endif; ?>
    <?php endif; ?>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/user/app.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldContent('styles'); ?>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/user/app.js')); ?>"></script>
</head>
<body id="page-top">
    <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div id="app">
        <?php if (! (isset($is_homepage) && $is_homepage)): ?>
            
        <?php endif; ?>
        <div class="clearfix pt-5"></div>
        <main class="">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldContent('scripts'); ?>

    <!--search box-->
    <script type="text/javascript">
        $(document).ready(function() {
          $('.ui.searchdropdown')
            .dropdown({
              on: 'click'
            })
          ;
        });
 
        $('.input-search').on('click',function(){
            $('#dropdown-list').attr('class',$('#dropdown-list').attr('class').replace('visi-hide',''));
            $('#dropdown-list').focus();
        });

        $('#dropdown-list').on('focusout',function(){
            $('#dropdown-list').addClass('visi-hide');
        });

        function goOtherPage(path)
        {
            newClass = $('.span-search-box span').attr('class').replace('visi-hide','');
            $('.span-search-box span').attr('class',newClass);
            $('.span-search-box svg').attr('class','visi-hide');
            window.location = path;
            
        }

       
    </script>
    <!--search box-->
</body>
</html>
