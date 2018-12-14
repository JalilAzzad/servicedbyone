<nav class="navbar navbar-expand-lg fixed-top" id="mainNav">
    <div class="container">
        <!--<a class="navbar-brand js-scroll-trigger pl-3 pl-sm-0" href="<?php echo e(auth()->check() ? route('user.dashboard') : url('/')); ?>">-->
        <a class="navbar-brand js-scroll-trigger pl-3 pl-sm-0" href="https://servicedbyone.com/">
            <img class="nav-logo" src="<?php echo e(asset('/images/logo.png')); ?>" alt="Serviced by ONE" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon nk-icon-burger"> <span class="nk-t-1"></span> <span class="nk-t-2"></span> <span class="nk-t-3"></span> </span>
        </button>
        
        <!-- search box -->
        <div class="input-search-body w-100">
            <div class="w-100 relative">
                <div class="flex br2">
                    <div class="flex flex-1 relative">
                            <div class="ui fluid search selection searchdropdown">
                                  <input type="hidden" name="country"/>
                                  <div class="default text input-service-name">What service do you need?</div>
                                  <div class="menu">
                                      <div class="item" onclick="goOtherPage('/our-services')">Our Services</div>
                                      <div class="item" onclick="goOtherPage('/services/local-moving-under-50-miles')">Local Moving (Under 50 Miles)</div>
                                      <div class="item" onclick="goOtherPage('/services/interior-painting')">Interior Painting</div>
                                      <div class="item" onclick="goOtherPage('/services/central-air-conditioning-repair-or-maintenance')">Central Air Conditioning Repair or Maintenance</div>
                                      <div class="item" onclick="goOtherPage('/services/exterior-painting')">Exterior Painting</div>
                                      <div class="item" onclick="goOtherPage('/services/landscaping')">Landscaping</div>
                                      <div class="item" onclick="goOtherPage('/services/fence-and-gate-installation')">
                                      Fence and Gate Installation</div>
                                      <div class="item" onclick="goOtherPage('/services/central-air-conditioning-installation-or-replacement')">Central Air Conditioning Installation or Replacement</div>
                                      <div class="item" onclick="goOtherPage('/services/heating-system-repair-or-maintenance')">Heating System Repair or Maintenance</div>
                                      <div class="item" onclick="goOtherPage('/services/heating-system-installation-or-replacement')">Heating System Installation or Replacement</div>
                                      <div class="item" onclick="goOtherPage('/services/logo-designer')">Logo Designer</div>
                                      <div class="item" onclick="goOtherPage('/services/web-developer')">Web Developer</div>
                                  </div>
                            </div>
                    </div>
                    <button class="input-search-btn relative br-right pv2" data-test="search-button" aria-label="Search">
                        <span class="flex items-center justify-center span-search-box">
                           <span class="absolute loading-animate visi-hide">
                                <ul class="loading-animate-list" role="status">
                                    <li class="ani-btn-shape back-color btn-size"></li>
                                    <li class="ani-btn-shape back-color btn-size"></li>
                                    <li class="ani-btn-shape back-color btn-size"></li>
                                    <li class="loading-text">Loading</li>
                                </ul>
                            </span>
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="currentColor">
                                <path d="M15.707 14.293a.999.999 0 1 1-1.414 1.414l-3.68-3.679A5.46 5.46 0 0 1 7.5 13 5.506 5.506 0 0 1 2 7.5C2 4.467 4.468 2 7.5 2S13 4.467 13 7.5c0 1.156-.36 2.229-.972 3.114l3.679 3.679zM11 7.5C11 5.57 9.43 4 7.5 4S4 5.57 4 7.5 5.57 11 7.5 11 11 9.43 11 7.5z"></path>
                            </svg>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <!-- search box -->
        
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <?php if(auth()->guard()->guest()): ?>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="<?php echo e(url('/')); ?>#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="<?php echo e(url('/')); ?>#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('user.dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('referral')); ?>"><?php echo e(__('REFERRAL')); ?></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <?php echo e(auth()->user()->name); ?> <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo e(route('user.settings')); ?>">
                                <?php echo e(__('Settings')); ?>

                            </a>
                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <?php echo e(__('Logout')); ?>

                            </a>

                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo csrf_field(); ?>
                            </form>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>