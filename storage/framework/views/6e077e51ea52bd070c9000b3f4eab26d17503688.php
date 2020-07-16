<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo e(config('constants.site_title','FTF')); ?> - <?php echo $__env->yieldContent('title'); ?> - User Dashboard</title>
    <link rel="shortcut icon" type="image/png" href="<?php echo e(config('constants.site_icon')); ?>"/>

    <link href="<?php echo e(asset('asset/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('asset/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('asset/css/slick.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('asset/css/slick-theme.css')); ?>"/>
    <link href="<?php echo e(asset('asset/css/bootstrap-datepicker.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('asset/css/bootstrap-timepicker.css')); ?>" rel="stylesheet">
    <?php if(Config::get('app.locale')=='ar'): ?>
    <link href="<?php echo e(asset('asset/css/arabic_dashboard-style.css')); ?>" rel="stylesheet">
    <?php else: ?>
    <link href="<?php echo e(asset('asset/css/dashboard-style.css')); ?>" rel="stylesheet" type="text/css">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo e(asset('main/assets/css/style_dialog.css')); ?>">
    <?php echo $__env->yieldContent('styles'); ?>
</head>

<body>

    <?php echo $__env->make('user.include.header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="page-content dashboard-page">    
        <div class="container">
        <?php
        $route_name = Request::path();
        $allRouteDialog = config('guidelines.demo_mode_dialog.user');
        $checkRouteDialog = isset($allRouteDialog[$route_name])?"true":"false";
        $tempVar = (Session::get($route_name))?Session::get($route_name):"false";
        if($checkRouteDialog =="true"){
        $dialog = $allRouteDialog[$route_name];
        }
        ?>

<?php if($checkRouteDialog =="true"): ?>
<div id="demoModeDialog" class="demoModeDialogmodal">
        <div class="demoModeDialogmodal-content text-center">
            <span class="demoModeDialogclose">&times;</span>
            <div class="row demoModeDialogdis demoModeDialogdis1">
                <p> <?php echo $dialog; ?> </p>
           </div>
         </div>
    </div>
    <?php endif; ?>
            <?php echo $__env->make('user.include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->yieldContent('content'); ?>

        </div>
    </div>


    <?php echo $__env->make('user.include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>


    <script src="<?php echo e(asset('asset/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/js/bootstrap.min.js')); ?>"></script>       
    <script type="text/javascript" src="<?php echo e(asset('asset/js/jquery.mousewheel.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('asset/js/jquery-migrate-1.2.1.min.js')); ?>"></script> 
    <script type="text/javascript" src="<?php echo e(asset('asset/js/slick.min.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/js/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/js/bootstrap-timepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('asset/js/dashboard-scripts.js')); ?>"></script>
    <?php if(Setting::get('demo_mode', 0) == 1): ?>

    <?php endif; ?>
    <?php if(($checkRouteDialog =="true") && (Setting::get('demo_mode', 0) == 1) && ($tempVar =="false")): ?>
    <?php echo e(Session::put($route_name,'true')); ?>

         <script type="text/javascript">
            var demoModeDialogmodal = document.getElementById('demoModeDialog');
            demoModeDialogmodal.style.display = "block";
            var demoModeDialogspan = document.getElementsByClassName("demoModeDialogclose")[0];
            demoModeDialogspan.onclick = function() 
            {
                demoModeDialogmodal.style.display = "none";
            }
            </script>
    <?php endif; ?> 
    <?php echo $__env->yieldContent('scripts'); ?>
    
</body>
</html>