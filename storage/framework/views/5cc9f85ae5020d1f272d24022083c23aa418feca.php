<?php $__env->startSection('title', __('admin.service.Update_Service_Type')); ?>

<?php $__env->startSection('content'); ?>

<div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
              <h5 class="card-title"><?php echo app('translator')->getFromJson('admin.service.Update_Service_Type'); ?></h5>
              <a href="<?php echo e(URL::previous()); ?>" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> <?php echo app('translator')->getFromJson('admin.back'); ?></a>
            </div>
            <div class="card-body">
            <form class="form-horizontal" action="<?php echo e(route('admin.service.update', $service->id )); ?>" method="POST" enctype="multipart/form-data" role="form">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="_method" value="PATCH">

                <div class="form-group">
                    <label for="name" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.service.Service_Name'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="<?php echo e($service->name); ?>" name="name" required id="name" placehold="<?php echo app('translator')->getFromJson('admin.service.Service_Name'); ?>">
                    </div>
                </div>

                <div class="input-group row">

                    <label for="image" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.picture'); ?></label>
                    <div class="col">
                        <?php if(isset($service->image)): ?>
                        <img style="height: 90px; margin-bottom: 15px; border-radius:2em;" src="<?php echo e($service->image); ?>">
                        <?php endif; ?>
                        <input type="file" accept="image/*" name="image" class="dropify form-control-file" id="image" aria-describedby="fileHelp">
                    </div>
                </div>

                <div class="input-group row">

                    <label for="marker" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.service.Service_marker_Image'); ?></label>
                    <div class="col">
                        <?php if(isset($service->marker)): ?>
                        <img style="height: 90px; margin-bottom: 15px; border-radius:2em;" src="<?php echo e($service->marker); ?>">
                        <?php endif; ?>
                        <input type="file" accept="image/*" name="marker" class="dropify form-control-file" id="marker" aria-describedby="fileHelp">
                    </div>
                </div>

                <div class="form-group">
                    <label for="calculator" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.service.Pricing_Logic'); ?></label>
                    <div class="col-xs-5">
                        <select class="form-control" id="calculator" name="calculator">
                            <option value="MIN" <?php if($service->calculator =='MIN'): ?> selected <?php endif; ?>><?php echo app('translator')->getFromJson('servicetypes.MIN'); ?></option>
                            <option value="HOUR" <?php if($service->calculator =='HOUR'): ?> selected <?php endif; ?>><?php echo app('translator')->getFromJson('servicetypes.HOUR'); ?></option>
                            <option value="DISTANCE" <?php if($service->calculator =='DISTANCE'): ?> selected <?php endif; ?>><?php echo app('translator')->getFromJson('servicetypes.DISTANCE'); ?></option>
                            <option value="DISTANCEMIN" <?php if($service->calculator =='DISTANCEMIN'): ?> selected <?php endif; ?>><?php echo app('translator')->getFromJson('servicetypes.DISTANCEMIN'); ?></option>
                            <option value="DISTANCEHOUR" <?php if($service->calculator =='DISTANCEHOUR'): ?> selected <?php endif; ?>><?php echo app('translator')->getFromJson('servicetypes.DISTANCEHOUR'); ?></option>
                        </select>
                    </div>
                    <div class="col-xs-5">
                        <span class="showcal"><i><b>Price Calculation:<span id="changecal"></span></b></i></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="min_price" class="bmd-label-floating">Minimum fee (<?php echo e(currency('')); ?>)</label>
                    <div class="col-xs-5">
                        <input class="form-control" type="text" id="currency_min_price" data-thousands="." data-decimal="," value="<?php echo e($service->min_price); ?>" name="min_price" required id="min_price" min="0">
                    </div>
                    <div class="col-xs-5">
                        <span class="showcal"><i><b>TM (Amount charged for short trips)</b></i></span>
                    </div>
                </div>

                <div class="form-group" >
                    <label for="fixed" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.service.hourly_Price'); ?> (<?php echo e(currency('')); ?>)</label>
                    <div class="col-xs-5">
                        <input class="form-control" type="number" value="<?php echo e($service->hour); ?>" name="hour" id="hourly_price" min="0">
                    </div>
                    <div class="col-xs-5">
                        <span class="showcal"><i><b>PH (<?php echo app('translator')->getFromJson('admin.service.per_hour'); ?>), TH (<?php echo app('translator')->getFromJson('admin.service.total_hour'); ?>)</b></i></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="fixed" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.service.Base_Price'); ?> (<?php echo e(currency('')); ?>)</label>
                    <div class="col-xs-5">
                        <input class="form-control" type="text" id="currency_fixed" data-thousands="." data-decimal="," value="<?php echo e($service->fixed); ?>" name="fixed" required id="fixed" placehold="<?php echo app('translator')->getFromJson('admin.service.Base_Price'); ?>" min="0">
                    </div>
                    <div class="col-xs-5">
                        <span class="showcal"><i><b>PB (<?php echo app('translator')->getFromJson('admin.service.Base_Price'); ?>)</b></i></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="distance" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.service.Base_Distance'); ?> (<?php echo e(distance('')); ?>)</label>
                    <div class="col-xs-5">
                        <input class="form-control" type="number" value="<?php echo e($service->distance); ?>" name="distance" id="distance" placehold="<?php echo app('translator')->getFromJson('admin.service.Base_Distance'); ?>" min="0">
                    </div>
                    <div class="col-xs-5">
                        <span class="showcal"><i><b>DB (<?php echo app('translator')->getFromJson('admin.service.Base_Distance'); ?>) </b></i></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="minute" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.service.unit_time'); ?> (<?php echo e(currency()); ?>)</label>
                    <div class="col-xs-5">
                        <input class="form-control" type="text" id="currency_minute" data-thousands="." data-decimal="," value="<?php echo e($service->minute); ?>" name="minute" id="minute" placehold="<?php echo app('translator')->getFromJson('admin.service.unit_time'); ?>" min="0">
                    </div>
                    <div class="col-xs-5">
                        <span class="showcal"><i><b>PM (<?php echo app('translator')->getFromJson('admin.service.per_minute'); ?>), TM (<?php echo app('translator')->getFromJson('admin.service.total_minute'); ?>)</b></i></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="price" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.service.unit'); ?> (<?php echo e(distance()); ?>)</label>
                    <div class="col-xs-5">
                        <input class="form-control" type="text" id="currency_price" data-thousands="." data-decimal="," value="<?php echo e($service->price); ?>" name="price" id="price" placehold="<?php echo app('translator')->getFromJson('admin.service.unit'); ?>" min="0">
                    </div>
                    <div class="col-xs-5">
                        <span class="showcal"><i><b>P<?php echo e(config('constants.distance')); ?> (<?php echo app('translator')->getFromJson('admin.service.per'); ?> <?php echo e(config('constants.distance')); ?>), T<?php echo e(config('constants.distance')); ?> (<?php echo app('translator')->getFromJson('admin.service.total'); ?> <?php echo e(config('constants.distance')); ?>)</b></i></span>
                    </div>
                </div>

                 <div class="form-group">
                    <label for="capacity" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.service.Seat_Capacity'); ?></label>
                    <div class="col-xs-5">
                        <input class="form-control" type="number" value="<?php echo e($service->capacity); ?>" name="capacity" required id="capacity" placehold="<?php echo app('translator')->getFromJson('admin.service.Seat_Capacity'); ?>" min="1">
                    </div>
                </div>

                <h3 for="description" class="bmd-label-floating" style="color: white; font-style:bold; font-size: 25px;"><?php echo app('translator')->getFromJson('admin.service.peak_title'); ?></h3>
                <div class="form-group">
                     <!-- Set Peak Time -->
                    <div class="col-xs-12">
                        <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->getFromJson('admin.service.peak_id'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('admin.service.peak_time'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('admin.service.peak_price'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $Peakhour; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($index + 1); ?></td>
                                        <td><?php echo e(date('h:i A', strtotime($w->start_time))); ?> - <?php echo e(date('h:i A', strtotime($w->end_time))); ?></td>
                                        <td> <input type="text" id="peak_price" name="peak_price[<?php echo e($w->id); ?>][id]" value="<?php if($w->servicetimes): ?><?php echo e($w->servicetimes->min_price); ?><?php endif; ?>"  min="1">
                                        <input type="hidden" name="peak_price[<?php echo e($w->id); ?>][status]" value="<?php if($w->servicetimes): ?>1 <?php else: ?> 0 <?php endif; ?>"> </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?php echo app('translator')->getFromJson('admin.service.peak_id'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('admin.service.peak_time'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('admin.service.peak_price'); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                    </div>
                </div>


                <h3 style="color: White;font-size: 25px;"><?php echo app('translator')->getFromJson('admin.service.waiting_title'); ?></h3>
                 <div class=" row">
                    
                    <div class="form-group col">
                        <label for="waiting_free_mins" class="col-xs-5 col-form-label"><?php echo app('translator')->getFromJson('admin.service.waiting_wave'); ?></label>
                        <input class="form-control" type="number" value="<?php echo e($service->waiting_free_mins); ?>" name="waiting_free_mins" id="waiting_free_mins" placehold="<?php echo app('translator')->getFromJson('admin.service.waiting_wave'); ?>" min="0">
                    </div>
                    
                    <div class=" form-group col">
                        <label for="waiting_min_charge" class="col-xs-5 col-form-label"><?php echo app('translator')->getFromJson('admin.service.waiting_charge'); ?></label>
                        <input class="form-control" type="number" value="<?php echo e($service->waiting_min_charge); ?>" name="waiting_min_charge" id="waiting_min_charge" placehold="<?php echo app('translator')->getFromJson('admin.service.waiting_charge'); ?>" min="0">
                    </div>
                </div>
                <h3 style="color: White;font-size: 25px;">Normal Trips</h3>
                    <div class=" row">
                    
                    <div class="form-group col">
                        <label for="normaltripsamountdiscount" class="col col-form-label">Amount of Discount(%)</label>
                        <input class="form-control" type="number" value="<?php echo e($service->normaltripsamountdiscount); ?>" name="normaltripsamountdiscount" id="normaltripsamountdiscount"  min="0">
                    </div>
                    
                    <div class=" form-group col">
                        <label for="normaltripsextracharges" class="col col-form-label">Extra Charges <?php echo e(currency()); ?></label>
                        <input class="form-control" type="number" value="<?php echo e($service->normaltripsextracharges); ?>" name="normaltripsextracharges" id="normaltripsextracharges"  min="0">
                    </div>
                </div>
                <h3 style="color: White;font-size: 25px;">Intercity Trips</h3>
                    <div class=" row">
                    
                    <div class="form-group col">
                        <label for="intercitytripsamountdiscount" class="col col-form-label">Amount of Discount(%)</label>
                        <input class="form-control" type="number" value="<?php echo e($service->intercitytripsamountdiscount); ?>" name="intercitytripsamountdiscount" id="intercitytripsamountdiscount"  min="0">
                    </div>
                    
                    <div class=" form-group col">
                        <label for="intercitytripextracharges" class="col col-form-label">Extra Charges <?php echo e(currency()); ?></label>
                        <input class="form-control" type="number" value="<?php echo e($service->intercitytripextracharges); ?>" name="intercitytripextracharges" id="intercitytripextracharges"  min="0">
                    </div>
                </div>
                 <h3 style="color: White;font-size: 25px;">Scheduled Trips</h3>
                    <div class=" row">
                    
                    <div class="form-group col">
                        <label for="seheduletripamountdiscountwaitingtime" class="col col-form-label">Amount of Discount on Waiting time(%)</label>
                        <input class="form-control" type="number" value="<?php echo e($service->seheduletripamountdiscountwaitingtime); ?>" name="seheduletripamountdiscountwaitingtime" id="seheduletripamountdiscountwaitingtime"  min="0">
                    </div>
                    
                    <div class=" form-group col">
                        <label for="seheduletripextracharges" class="col col-form-label">Extra Charges <?php echo e(currency()); ?></label>
                        <input class="form-control" type="number" value="<?php echo e($service->seheduletripextracharges); ?>" name="seheduletripextracharges" id="seheduletripextracharges"  min="0">
                    </div>
                </div>
                 <h3 style="color: White;font-size: 25px;">Airport Pick-up/Drop off Charges</h3>
                    <div class=" row">
                    
                    <div class="form-group col">
                        <label for="airportpickup" class="col col-form-label">Pick-Up <?php echo e(currency()); ?></label>
                        <input class="form-control" type="number" value="<?php echo e($service->airportpickup); ?>" name="airportpickup" id="airportpickup"  min="0">
                    </div>
                    
                    <div class=" form-group col">
                        <label for="airportpickdropoff" class="col col-form-label">Drop-Off <?php echo e(currency()); ?></label>
                        <input class="form-control" type="number" value="<?php echo e($service->airportpickdropoff); ?>" name="airportpickdropoff" id="airportpickdropoff"  min="0">
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <button type="submit" class="btn btn-primary btn-block"><?php echo app('translator')->getFromJson('admin.service.Update_Service_Type'); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
    var cal='DISTANCE';
    priceInputs('<?php echo e($service->calculator); ?>');
    $("#calculator").on('change', function(){
        cal=$(this).val();
        priceInputs(cal);
    });

    function priceInputs(cal){
        if(cal=='MIN'){
            $("#hourly_price,#distance,#price").attr('value','');
            $("#minute").prop('disabled', false);
            $("#minute").prop('required', true);
            $("#hourly_price,#distance,#price").prop('disabled', true);
            $("#hourly_price,#distance,#price").prop('required', false);
            $("#changecal").text('PB + (TM*PM)');
        }
        else if(cal=='HOUR'){
            $("#minute,#distance,#price").attr('value','');
            $("#hourly_price").prop('disabled', false);
            $("#hourly_price").prop('required', true);
            $("#minute,#distance,#price").prop('disabled', true);
            $("#minute,#distance,#price").prop('required', false);
            $("#changecal").text('PB + (TH*PH)');
        }
        else if(cal=='DISTANCE'){
            $("#minute,#hourly_price").attr('value','');
            $("#price,#distance").prop('disabled', false);
            $("#price,#distance").prop('required', true);
            $("#minute,#hourly_price").prop('disabled', true);
            $("#minute,#hourly_price").prop('required', false);
            $("#changecal").text('PB + (T<?php echo e(config("constants.distance")); ?>-DB*P<?php echo e(config("constants.distance")); ?>)');
        }
        else if(cal=='DISTANCEMIN'){
            $("#hourly_price").attr('value','');
            $("#price,#distance,#minute").prop('disabled', false);
            $("#price,#distance,#minute").prop('required', true);
            $("#hourly_price").prop('disabled', true);
            $("#hourly_price").prop('required', false);
            $("#changecal").text('PB + (T<?php echo e(config("constants.distance")); ?>-DB*P<?php echo e(config("constants.distance")); ?>) + (TM*PM)');
        }
        else if(cal=='DISTANCEHOUR'){
            $("#minute").attr('value','');
            $("#price,#distance,#hourly_price").prop('disabled', false);
            $("#price,#distance,#hourly_price").prop('required', true);
            $("#minute").prop('disabled', true);
            $("#minute").prop('required', false);
            $("#changecal").text('PB + ((T<?php echo e(config("constants.distance")); ?>-DB)*P<?php echo e(config("constants.distance")); ?>) + (TH*PH)');
        }
        else{
            $("#minute,#hourly_price").attr('value','');
            $("#price,#distance").prop('disabled', false);
            $("#price,#distance").prop('required', true);
            $("#minute,#hourly_price").prop('disabled', true);
            $("#minute,#hourly_price").prop('required', false);
            $("#changecal").text('PB + (T<?php echo e(config("constants.distance")); ?>-DB*P<?php echo e(config("constants.distance")); ?>)');
        }
    }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>