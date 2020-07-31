<?php $__env->startSection('title', 'Add Vehicle'); ?>
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('asset/css/intlTelInput.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title pull-left">Add  Vehicle</h4>
                <a href="<?php echo e(URL::previous()); ?>" class="btn pull-right"><i
                        class="fa fa-angle-left"></i> <?php echo app('translator')->getFromJson('admin.back'); ?></a>
            </div>
            <div class="card-body">

                <form action="<?php echo e(route('admin.vehicles.store')); ?>" method="POST" enctype="multipart/form-data" role="form">
                    <?php echo e(csrf_field()); ?>


                    <div class="form-group">
                        <label for="make" class="bmd-label-floating">Make</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="<?php echo e(old('make')); ?>" name="make" required id="make">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="model" class="bmd-label-floating">Model</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="<?php echo e(old('model')); ?>" name="model" required id="model">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="color" class="bmd-label-floating">Color</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="<?php echo e(old('color')); ?>" name="color" required id="color">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="registrationNumber" class="bmd-label-floating">Registration Number</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="<?php echo e(old('registrationNumber')); ?>" name="registrationNumber" required id="registrationNumber">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="registration_expire" class="bmd-label-floating">Registration Expire</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="date" value="<?php echo e(old('registration_expire')); ?>" name="registration_expire" required id="registration_expire">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="PHCLicenceNumber" class="bmd-label-floating">PHC Licence Number</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="<?php echo e(old('PHCLicenceNumber')); ?>" name="PHCLicenceNumber" required id="PHCLicenceNumber">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="PHCLicenceNumberExpire" class="bmd-label-floating">PHC Licence Number Expire</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="date" value="<?php echo e(old('PHCLicenceNumberExpire')); ?>" name="PHCLicenceNumberExpire" required id="PHCLicenceNumberExpire">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="seatType" class="bmd-label-floating">Type</label>
                        <div class="col-xs-10">
                            <select id="seatType" name="seatType" class="form-control" required>
                                <option value="" selected disabled>Select</option>
                                <?php $__currentLoopData = get_seattype(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>"> <?php echo e($value->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                            <label for="zipcode" class="bmd-label-floating"></label>
                            <div class="col-xs-10">
                                <button type="submit" class="btn btn-primary">Add</button>
                                <a href="<?php echo e(route('admin.vehicles.index')); ?>" class="btn btn-default"><?php echo app('translator')->getFromJson('admin.cancel'); ?></a>
                            </div>
                        </div>
                
        </div>
    </div>
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('scripts'); ?>
    <script type="text/javascript" src="<?php echo e(asset('asset/js/intlTelInput.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('asset/js/intlTelInput-jquery.min.js')); ?>"></script>
  
    
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>