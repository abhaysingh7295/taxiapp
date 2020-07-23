<?php $__env->startSection('title', 'Update Luggage Combination '); ?>
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('asset/css/intlTelInput.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title pull-left">Update Luggage Combination</h4>
                <a href="<?php echo e(route('admin.luggage.index')); ?>" class="btn pull-right"><i
                        class="fa fa-angle-left"></i> <?php echo app('translator')->getFromJson('admin.back'); ?></a>
            </div>
            <div class="card-body">

                <form action="<?php echo e(route('admin.luggage.update', $seater->id )); ?>" method="POST" enctype="multipart/form-data" role="form">
                    <?php echo e(csrf_field()); ?>

         <input type="hidden" name="_method" value="PATCH">
         <div class="form-group">
                            <label for="seatType" class="bmd-label-floating">Seater</label>
                            <div class="col-xs-10">
                                <select id="seatType" name="seattype" class="form-control" required>
                                    <option value="" selected disabled>Select</option>
                                    <?php $__currentLoopData = get_seattype(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>" <?php echo e(( $key == $seater->seattype) ? 'selected' : ''); ?>> <?php echo e($value->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
    
                    <div class="form-group">
                        <label for="NumberPassengers" class="bmd-label-floating">Number Passengers</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="<?php echo e($seater->NumberPassengers); ?>" name="NumberPassengers" required id="NumberPassengers">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="LargeLuggages" class="bmd-label-floating">Large Luggages</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="<?php echo e($seater->LargeLuggages); ?>" name="LargeLuggages" required id="LargeLuggages">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="SmallLuggages" class="bmd-label-floating">Small Luggages</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="<?php echo e($seater->SmallLuggages); ?>" name="SmallLuggages" required id="SmallLuggages">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="zipcode" class="bmd-label-floating"></label>
                        <div class="col-xs-10">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="<?php echo e(route('admin.luggage.index')); ?>" class="btn btn-default"><?php echo app('translator')->getFromJson('admin.cancel'); ?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php $__env->stopSection(); ?>
 


<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>