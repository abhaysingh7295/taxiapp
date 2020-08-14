<div class="sidebar" data-color="<?php echo e(config('constants.nav_skin', 'azure')); ?>" data-background-color="black"
     data-image="">
    <!--    <div class="sidebar" data-color="<?php echo e(config('constants.nav_skin', 'azure')); ?>" data-background-color="black"
         data-image="<?php echo e(asset('/asets/img/sidebar-2.jpg')); ?>">-->
    <!--
          Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"
  
          Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo" style="background: url(<?php echo e(config('constants.site_logo', asset('logo-black.png'))); ?>) no-repeat;">
        <a href="<?php echo e(url('admin/dashboard')); ?>" class="simple-text logo-normal">

        </a></div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <?php if(auth()->check() && auth()->user()->hasRole('ADMIN|ACCOUNT|SUBADMIN')): ?>
            <li class="nav-item <?php echo e(Request::segment(2) === 'dashboard' ? 'active' : null); ?>">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link">
                    <i class="fa fa-tachometer"></i>
                    <p><?php echo app('translator')->getFromJson('admin.include.dashboard'); ?></p>
                </a>
            </li>
            <?php endif; ?>

            <?php if(auth()->check() && auth()->user()->hasRole('ADMIN|SUBADMIN')): ?>
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('country')): ?>
            <ul class="nav navbar-nav">
                <li class="nav-item dropdown <?php echo e(Request::segment(2) === 'country' ? 'active' : null); ?> <?php echo e(Request::segment(2) === 'city' ? 'active' : null); ?>">

                    <a class="nav-link" href="#" data-toggle="dropdown">
                        <i class="fa fa-book"></i>
                        <p>City Management</p>
                    </a>
                    <div class="dropdown-menu dropdown-menu animated">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('country')): ?>
                        <a class="dropdown-item <?php echo e(Request::segment(2) === 'country' ? 'active' : null); ?>"
                           href="<?php echo e(route('admin.country.index')); ?>">Country</a>
                          <?php endif; ?>
                           <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('city')): ?>
                        <a class="dropdown-item <?php echo e(Request::segment(2) === 'city' ? 'active' : null); ?>"
                           href="<?php echo e(route('admin.city.index')); ?>">City</a>
                            <?php endif; ?>
                    </div>

                </li>
            </ul>
              <?php endif; ?>
            <!--            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('service-types-list')): ?>
                        <li class="nav-item <?php echo e(Request::segment(2) === 'service' ? 'active' : null); ?>">
                            <a href="<?php echo e(route('admin.service.index')); ?>" class="nav-link">
                                <i class="fa fa-taxi"></i>
                                <p><?php echo app('translator')->getFromJson('admin.include.service_types'); ?></p>
                            </a>
                        </li>
                        <?php endif; ?>-->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('statements')): ?>
            <ul class="nav navbar-nav">
                <li class="nav-item dropdown <?php echo e(Request::segment(2) === 'statement' ? 'active' : null); ?> <?php echo e(Request::segment(2) === 'transactions' ? 'active' : null); ?>">

                    <a class="nav-link" href="#" data-toggle="dropdown">
                        <i class="fa fa-book"></i>
                        <p><?php echo app('translator')->getFromJson('admin.include.statements'); ?></p>
                    </a>
                    <div class="dropdown-menu dropdown-menu animated">
                        <a class="dropdown-item <?php echo e(Request::segment(2) === 'statement' ? 'active' : null); ?>"
                           href="<?php echo e(route('admin.ride.statement')); ?>"><?php echo app('translator')->getFromJson('admin.include.overall_ride_statments'); ?></a>


                        <a class="dropdown-item <?php echo e(Request::segment(2) === 'statement' ? 'active' : null); ?>"
                           href="<?php echo e(route('admin.ride.statement.provider')); ?>"><?php echo app('translator')->getFromJson('admin.include.provider_statement'); ?></a>


                        <a class="dropdown-item <?php echo e(Request::segment(2) === 'statement' ? 'active' : null); ?>"
                           href="<?php echo e(route('admin.ride.statement.user')); ?>"><?php echo app('translator')->getFromJson('admin.include.user_statement'); ?></a>

                        <a class="dropdown-item <?php echo e(Request::segment(2) === 'transactions' ? 'active' : null); ?>"
                           href="<?php echo e(route('admin.providertransfer')); ?>"><?php echo app('translator')->getFromJson('admin.include.provider_request'); ?></a>

                        <a class="dropdown-item <?php echo e(Request::segment(2) === 'transactions' ? 'active' : null); ?>"
                           href="<?php echo e(route('admin.transactions')); ?>"><?php echo app('translator')->getFromJson('admin.include.all_transaction'); ?></a>

                        <a class="dropdown-item href="<?php echo e(route('admin.ride.statement.today')); ?>"><?php echo app('translator')->getFromJson('admin.include.daily_statement'); ?></a>
                        <a class="dropdown-item" href="<?php echo e(route('admin.ride.statement.monthly')); ?>"><?php echo app('translator')->getFromJson('admin.include.monthly_statement'); ?></a>
                        <a class="dropdown-item" href="<?php echo e(route('admin.ride.statement.yearly')); ?>"><?php echo app('translator')->getFromJson('admin.include.yearly_statement'); ?></a> 
                    </div>
                </li>
            </ul>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('promocodes-list')): ?>
            <li class="nav-item <?php echo e(Request::segment(2) === 'promocode' ? 'active' : null); ?>">
                <a href="<?php echo e(route('admin.promocode.index')); ?>" class="nav-link">
                    <i class="fa fa-history"></i>
                    <p><?php echo app('translator')->getFromJson('admin.include.promocodes'); ?></p>
                </a>
            </li> 
            <?php endif; ?>
            
            <ul class="nav navbar-nav">
                <li class="nav-item dropdown <?php echo e(Request::segment(2) === 'company' ? 'active' : null); ?> <?php echo e(Request::segment(2) === 'cartype' ? 'active' : null); ?><?php echo e(Request::segment(2) === 'cars' ? 'active' : null); ?> <?php echo e(Request::segment(2) === 'reservations' ? 'active' : null); ?>">

                    <a class="nav-link" href="#" data-toggle="dropdown">
                        <i class="fa fa-book"></i>
                        <p><?php echo app('translator')->getFromJson('admin.carrental.carrental'); ?></p>
                    </a>
                    <div class="dropdown-menu dropdown-menu animated">
                         <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('company')): ?>
                        <a class="dropdown-item <?php echo e(Request::segment(2) === 'company' ? 'active' : null); ?>"
                           href="<?php echo e(route('admin.company.index')); ?>"><?php echo app('translator')->getFromJson('admin.carrental.company'); ?></a>
                         <?php endif; ?>
                          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cartype')): ?>
                        <a class="dropdown-item <?php echo e(Request::segment(2) === 'cartype' ? 'active' : null); ?>"
                           href="<?php echo e(route('admin.cartype.index')); ?>"><?php echo app('translator')->getFromJson('admin.carrental.cartype'); ?></a>
                           <?php endif; ?>
                          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cars')): ?>
                        <a class="dropdown-item <?php echo e(Request::segment(2) === 'cars' ? 'active' : null); ?>"
                           href="<?php echo e(route('admin.cars.index')); ?>"><?php echo app('translator')->getFromJson('admin.carrental.cars'); ?></a>
                           <?php endif; ?>
                          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('reservations')): ?>
                        <a class="dropdown-item <?php echo e(Request::segment(2) === 'reservations' ? 'active' : null); ?>"
                           href="<?php echo e(route('admin.reservations.index')); ?>">Car Reservation</a>
                          <?php endif; ?>
                    </div>

                </li>
            </ul>
            
            <ul class="nav navbar-nav">
                <li class="nav-item dropdown <?php echo e(Request::segment(2) === 'provider' ? 'active' : null); ?>  <?php echo e(Request::segment(2) === 'vehicles' ? 'active' : null); ?>  <?php echo e(Request::segment(2) === 'document' ? 'active' : null); ?>">

                    <a class="nav-link" href="#" data-toggle="dropdown">
                        <i class="fa fa-book"></i>
                        <p><?php echo app('translator')->getFromJson('admin.include.providers'); ?></p>
                    </a>
                    <div class="dropdown-menu dropdown-menu animated">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('provider-list')): ?>
                        <a class="dropdown-item <?php echo e(Request::segment(2) === 'provider' ? 'active' : null); ?>"
                           href="<?php echo e(route('admin.provider.index')); ?>"><?php echo app('translator')->getFromJson('admin.include.providers'); ?></a>
                        <?php endif; ?>
                         <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vehicles')): ?>
                        <a class="dropdown-item <?php echo e(Request::segment(2) === 'vehicles' ? 'active' : null); ?>"
                           href="<?php echo e(route('admin.vehicles.index')); ?>">Vehicle</a>
                         <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('documents-list')): ?>
                         <a class="dropdown-item" <?php echo e(Request::segment(2) === 'luggage' ? 'active' : null); ?> href="<?php echo e(route('admin.document.index')); ?>"> <?php echo app('translator')->getFromJson('admin.include.documents'); ?></a>
                        <?php endif; ?>

                    </div>

                </li>
            </ul>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('payment-settings')): ?>
            <ul class="nav navbar-nav">
                <li class="nav-item dropdown <?php echo e(Request::segment(2) === 'settings' ? 'active' : null); ?> <?php echo e(Request::segment(2) === 'service' ? 'active' : null); ?>  <?php echo e(Request::segment(2) === 'luggage' ? 'active' : null); ?>">

                    <a class="nav-link" href="#" data-toggle="dropdown">
                        <i class="fa fa-book"></i>
                        <p><?php echo app('translator')->getFromJson('admin.include.FareManagement'); ?></p>
                    </a>
                    <div class="dropdown-menu dropdown-menu animated">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('payment-settings')): ?>
                         <a class="dropdown-item  <?php echo e(Request::segment(2) === 'settings' ? 'active' : null); ?>" href="<?php echo e(route('admin.settings.payment')); ?>"> <?php echo app('translator')->getFromJson('admin.include.FareManagement'); ?></a>
                        <?php endif; ?>

                         <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('provider-services')): ?>
                        <a class="dropdown-item <?php echo e(Request::segment(2) === 'service' ? 'active' : null); ?>"
                           href="<?php echo e(route('admin.service.index')); ?>"><?php echo app('translator')->getFromJson('admin.include.service_types'); ?></a>
                          <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('luggage')): ?>
                        <a class="dropdown-item <?php echo e(Request::segment(2) === 'luggage' ? 'active' : null); ?>"
                           href="<?php echo e(route('admin.luggage.index')); ?>">Luggage Combination </a>
                         <?php endif; ?>
                       
                    </div>

                </li>
            </ul>
        
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-list')): ?>
            <li class="nav-item <?php echo e(Request::segment(2) === 'user' ? 'active' : null); ?>">
                <a href="<?php echo e(route('admin.user.index')); ?>" class="nav-link">
                    <i class="fa fa-user"></i>
                    <p><?php echo app('translator')->getFromJson('admin.include.users'); ?></p>
                </a>
            </li>
            <?php endif; ?>
            <!--            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('provider-list')): ?>
                        <li class="nav-item <?php echo e(Request::segment(2) === 'provider' ? 'active' : null); ?>">
                            <a href="<?php echo e(route('admin.provider.index')); ?>" class="nav-link">
                                <i class="fa fa-server"></i>
                                <p><?php echo app('translator')->getFromJson('admin.include.providers'); ?></p>
                            </a>
                        </li> 
                        <?php endif; ?>-->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('payment-history')): ?>
            <li class="nav-item <?php echo e(Request::segment(2) === 'payment' ? 'active' : null); ?>">
                <a href="<?php echo e(route('admin.payment')); ?>" class="nav-link">
                    <i class="fa fa-money"></i>
                    <p><?php echo app('translator')->getFromJson('admin.include.payment_history'); ?></p>
                </a>
            </li>
            <?php endif; ?>
             <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dispute-list')): ?>
            <ul class="nav navbar-nav">
                <li class="nav-item dropdown <?php echo e(Request::segment(2) === 'disputeusers' ? 'active' : null); ?> <?php echo e(Request::segment(2) === 'dispute' ? 'active' : null); ?>">

                    <a class="nav-link" href="#" data-toggle="dropdown">
                        <i class="fa fa-book"></i>
                        <p>Complains</p>
                    </a>
                    <div class="dropdown-menu dropdown-menu animated">
                      
                        <a class="dropdown-item <?php echo e(Request::segment(2) === 'dispute' ? 'active' : null); ?>"
                           href="<?php echo e(route('admin.dispute.index')); ?>"><?php echo app('translator')->getFromJson('admin.include.dispute_type'); ?></a>
                        <a class="dropdown-item <?php echo e(Request::segment(2) === 'disputeusers' ? 'active' : null); ?>"
                           href="<?php echo e(route('admin.userdisputes')); ?>"> <?php echo app('translator')->getFromJson('admin.include.dispute_request'); ?></a>
                           

                    </div>

                </li>
            </ul>
           <?php endif; ?>
          
            <ul class="nav navbar-nav">
                <li class="nav-item dropdown  <?php echo e(Request::segment(2) === 'driverfareissuetypes' ? 'active' : null); ?> <?php echo e(Request::segment(2) === 'disputedriver' ? 'active' : null); ?>">

                    <a class="nav-link" href="#" data-toggle="dropdown">
                        <i class="fa fa-book"></i>
                        <p>Driver Fare Issues</p>
                    </a>
                    <div class="dropdown-menu dropdown-menu animated">
                      
                        <a class="dropdown-item <?php echo e(Request::segment(2) === 'driverfareissuetypes' ? 'active' : null); ?>"
                           href="<?php echo e(route('admin.driverfareissuetypes.index')); ?>"><?php echo app('translator')->getFromJson('admin.include.driver_fare_issues_type'); ?></a>
                        <a class="dropdown-item <?php echo e(Request::segment(2) === 'disputedriver' ? 'active' : null); ?>"
                           href="<?php echo e(route('admin.driverdisputes')); ?>"><?php echo app('translator')->getFromJson('admin.include.driver_fare_issues_request'); ?></a>
                        
                           

                    </div>

                </li>
            </ul>
        

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dispatcher-panel')): ?>
            <li class="nav-item <?php echo e(Request::segment(2) === 'dispatcher' ? 'active' : null); ?>">
                <a href="<?php echo e(route('admin.dispatcher.index')); ?>" class="nav-link">
                    <i class="fa fa-transgender-alt"></i>
                    <p><?php echo app('translator')->getFromJson('admin.include.dispatcher_panel'); ?></p>
                </a>
            </li> 
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dispute-list')): ?>
            <!--             <li class="nav-item <?php echo e(Request::segment(2) === 'dispute' ? 'active' : null); ?>">
                            <a href="<?php echo e(route('admin.dispute.index')); ?>" class="nav-link">
                                <i class="ti-write"></i>
                                <p><?php echo app('translator')->getFromJson('admin.include.dispute_type'); ?></p>
                            </a>
                        </li>
                        <li class="nav-item <?php echo e(Request::segment(2) === 'disputeusers' ? 'active' : null); ?>">
                            <a href="<?php echo e(route('admin.userdisputes')); ?>" class="nav-link">
                                <i class="ti-write"></i>
                                <p><?php echo app('translator')->getFromJson('admin.include.dispute_request'); ?></p>
                            </a>
                        </li> -->

            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('heat-map')): ?>
            <!-- <li class="nav-item <?php echo e(Request::segment(2) === 'map' ? 'active' : null); ?>">
                <a href="<?php echo e(route('admin.map.index')); ?>" class="nav-link">
                    <i class="ti-map-alt"></i>
                    <p><?php echo app('translator')->getFromJson('admin.include.map'); ?></p>
                </a>
            </li>
            <li class="nav-item <?php echo e(Request::segment(2) === 'heatmap' ? 'active' : null); ?>">
                <a href="<?php echo e(route('admin.heatmap')); ?>" class="nav-link">
                    <i class="ti-map"></i>
                    <p><?php echo app('translator')->getFromJson('admin.include.heat_map'); ?></p>
                </a>
            </li> -->
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('god-eye')): ?>
            <!-- <li class="nav-item <?php echo e(Request::segment(2) === 'godseye' ? 'active' : null); ?>">
                <a href="<?php echo e(route('admin.godseye')); ?>" class="nav-link">
                    <i class="fa fa-eye"></i>
                    <p><?php echo app('translator')->getFromJson('admin.heatmap.godseye'); ?></p>
                </a>
            </li> -->
            <?php endif; ?>
            
            <?php if(auth()->check() && auth()->user()->hasRole('ADMIN|SUBADMIN')): ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dispatcher-list')): ?>
            <!-- <li class="nav-item <?php echo e(Request::segment(2) === 'dispatch-manager' ? 'active' : null); ?>">
                <a href="<?php echo e(route('admin.dispatch-manager.index')); ?>" class="nav-link">
                    <i class="fa fa-share-square-o"></i>
                    <p><?php echo app('translator')->getFromJson('admin.include.dispatcher'); ?></p>
                </a>
            </li> -->
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('account-manager-list')): ?>
            <!-- <li class="nav-item <?php echo e(Request::segment(2) === 'account-manager' ? 'active' : null); ?>">
                <a href="<?php echo e(route('admin.account-manager.index')); ?>" class="nav-link">
                    <i class="fa fa-user-circle"></i>
                    <p><?php echo app('translator')->getFromJson('admin.include.account_manager'); ?></p>
                </a>
            </li> -->
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dispute-manager-list')): ?>
            <!--             <li class="nav-item <?php echo e(Request::segment(2) === 'dispute_manager' ? 'active' : null); ?>">
                            <a href="<?php echo e(route('admin.account-manager.index')); ?>" class="nav-link">
                                <i class="fa fa-user-circle"></i>
                                <p><?php echo app('translator')->getFromJson('admin.include.dispute_manager'); ?></p>
                            </a>
                        </li> -->
            <?php endif; ?>
            <?php endif; ?>

            <?php if(auth()->check() && auth()->user()->hasRole('ADMIN|SUBADMIN')): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ratings')): ?>
            <!--             <li class="nav-item <?php echo e(Request::segment(3) === 'user' ? 'active' : null); ?>">
                            <a href="<?php echo e(route('admin.user.review')); ?>" class="nav-link">
                                <i class="fa fa-star-o"></i>
                                <p><?php echo app('translator')->getFromJson('admin.include.user_ratings'); ?></p>
                            </a>
                        </li>
            
                        <li class="nav-item <?php echo e(Request::segment(3) === 'provider' ? 'active' : null); ?>">
                            <a href="<?php echo e(route('admin.provider.review')); ?>" class="nav-link">
                                <i class="fa fa-star-o"></i>
                                <p><?php echo app('translator')->getFromJson('admin.include.provider_ratings'); ?></p>
                            </a>
                        </li> -->
            <?php endif; ?>
            <?php endif; ?>
            <?php if(auth()->check() && auth()->user()->hasRole('ADMIN|SUBADMIN')): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ride-history')): ?>
            <!-- <li class="nav-item <?php echo e(Request::segment(2) === 'dispatcher' ? 'active' : null); ?>">
                <a href="<?php echo e(route('admin.requests.index')); ?>" class="nav-link">
                    <i class="fa fa-history"></i>
                    <p><?php echo app('translator')->getFromJson('admin.include.ride_history'); ?></p>
                </a>
            </li> -->
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('schedule-rides')): ?>
            <!--                 <li class="nav-item <?php echo e(Request::segment(2) === 'scheduled' ? 'active' : null); ?>">
                                <a href="<?php echo e(route('admin.requests.scheduled')); ?>" class="nav-link">
                                    <i class="ti-palette"></i>
                                    <p><?php echo app('translator')->getFromJson('admin.include.scheduled_rides'); ?></p>
                                </a>
                            </li> -->
            <?php endif; ?>
            <?php endif; ?>
            <?php if(auth()->check() && auth()->user()->hasRole('ADMIN|SUBADMIN')): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-list')): ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sub-admin-list')): ?>
            <li class="nav-item <?php echo e(Request::segment(2) === 'sub-admins' ? 'active' : null); ?>">
                <a href="<?php echo e(route('admin.sub-admins.index')); ?>" class="nav-link">
                    <i class="fa fa-user"></i>
                    <p><?php echo app('translator')->getFromJson('admin.include.sub_admins'); ?></p>
                </a>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('role-list')): ?>
            <li class="nav-item <?php echo e(Request::segment(2) === 'role' ? 'active' : null); ?>">
                <a href="<?php echo e(route('admin.role.index')); ?>" class="nav-link">
                    <i class="fa fa-users"></i>
                    <p><?php echo app('translator')->getFromJson('admin.include.role_types'); ?></p>
                </a>
            </li>

            <?php endif; ?>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('peak-hour-list')): ?>
            <li class="nav-item <?php echo e(Request::segment(2) === 'peakhour' ? 'active' : null); ?>">
                <a href="<?php echo e(route('admin.peakhour.index')); ?>" class="nav-link">
                    <i class="fa fa-clock"></i>
                    <p><?php echo app('translator')->getFromJson('admin.include.peakhour'); ?></p>
                </a>
            </li>
            <?php endif; ?>


            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('notification-list')): ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('notification-list')): ?>
            <li class="nav-item <?php echo e(Request::segment(2) === 'notification' ? 'active' : null); ?>">
                <a href="<?php echo e(route('admin.notification.index')); ?>" class="nav-link">
                    <i class="fa fa-user"></i>
                    <p><?php echo app('translator')->getFromJson('admin.include.notify'); ?></p>
                </a>
            </li>
            <?php endif; ?>

            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cancel-reasons-list')): ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cancel-reasons-list')): ?>
            <li class="nav-item <?php echo e(Request::segment(2) === 'reason' ? 'active' : null); ?>">
                <a href="<?php echo e(route('admin.reason.index')); ?>" class="nav-link">
                    <i class="fa fa-user"></i>
                    <p><?php echo app('translator')->getFromJson('admin.include.reason'); ?></p>
                </a>
            </li>
<!--            <li class="nav-item <?php echo e(Request::segment(2) === 'bookingissuetypes' ? 'active' : null); ?>">
                <a href="<?php echo e(route('admin.bookingissuetypes.index')); ?>" class="nav-link">
                    <i class="fa fa-user"></i>
                    <p><?php echo app('translator')->getFromJson('admin.include.bookingissuestype'); ?></p>
                </a>
            </li>-->
            <?php endif; ?>
            <?php endif; ?>
            <?php endif; ?>
           
            <?php if(auth()->check() && auth()->user()->hasRole('ADMIN|SUBADMIN')): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('cms-pages')): ?>
            <!--            <li class="nav-item <?php echo e(Request::segment(2) === 'pages' ? 'active' : null); ?>">
                            <a href="<?php echo e(route('admin.cmspages')); ?>" class="nav-link">
                                <i class="ti-file"></i>
                                <p><?php echo app('translator')->getFromJson('admin.include.cms_pages'); ?></p>
                            </a>
                        </li>-->
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('custom-push')): ?>
            <li class="nav-item <?php echo e(Request::segment(2) === 'send' ? 'active' : null); ?>">
                <a href="<?php echo e(route('admin.push')); ?>" class="nav-link">
                    <i class="fa fa-bullhorn"></i>
                    <p><?php echo app('translator')->getFromJson('admin.include.custom_push'); ?></p>
                </a>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('transalations')): ?>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('lost-item-list')): ?>
            <li class="nav-item <?php echo e(Request::segment(2) === 'lostitem' ? 'active' : null); ?>">
                <a href="<?php echo e(route('admin.lostitem.index')); ?>" class="nav-link">
                    <i class="ti-write"></i>
                    <p><?php echo app('translator')->getFromJson('admin.include.lostitem'); ?></p>
                </a>
            </li>
            <?php endif; ?>
            <?php endif; ?>
            <?php if(auth()->check() && auth()->user()->hasRole('ADMIN|SUBADMIN')): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('account-settings')): ?>
            <li class="nav-item <?php echo e(Request::segment(2) === 'profile' ? 'active' : null); ?>">
                <a href="<?php echo e(route('admin.profile')); ?>" class="nav-link">
                    <i class="fa fa-user"></i>
                    <p><?php echo app('translator')->getFromJson('admin.include.account_settings'); ?></p>
                </a>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('site-settings')): ?>
            <li class="nav-item <?php echo e(Request::segment(2) === 'site' ? 'active' : null); ?>">
                <a href="<?php echo e(route('admin.settings')); ?>" class="nav-link">
                    <i class="fa fa-tools"></i>
                    <p><?php echo app('translator')->getFromJson('admin.include.site_settings'); ?></p>
                </a>
            </li>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('change-password')): ?>
            <li class="nav-item <?php echo e(Request::segment(2) === 'password' ? 'active' : null); ?>">
                <a href="<?php echo e(route('admin.password')); ?>" class="nav-link">
                    <i class="fa fa-key"></i>
                    <p><?php echo app('translator')->getFromJson('admin.include.change_password'); ?></p>
                </a>
            </li>
            <?php endif; ?>
            <?php endif; ?>
        </ul>
    </div>
</div>