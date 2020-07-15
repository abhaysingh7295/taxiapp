<?php $__env->startSection('title', 'New Driver '); ?>
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('asset/css/intlTelInput.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h5 class="card-title"><?php echo app('translator')->getFromJson('admin.provides.add_provider'); ?></h5>
                <a href="<?php echo e(URL::previous()); ?>" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> <?php echo app('translator')->getFromJson('admin.back'); ?></a>
            </div>
            <div class="card-body">
            <form class="form-horizontal" action="<?php echo e(route('admin.provider.store')); ?>" method="POST" enctype="multipart/form-data" role="form">
                <?php echo e(csrf_field()); ?>

                
                <div class="form-group">
                    <label for="first_name" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.first_name'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="<?php echo e(old('first_name')); ?>" name="first_name" required id="first_name" placehold="<?php echo app('translator')->getFromJson('admin.first_name'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="last_name" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.last_name'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="<?php echo e(old('last_name')); ?>" name="last_name" required id="last_name" placehold="<?php echo app('translator')->getFromJson('admin.last_name'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.email'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" type="email" required name="email" value="<?php echo e(old('email')); ?>" id="email" placehold="<?php echo app('translator')->getFromJson('admin.email'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.password'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" type="password" name="password" id="password" placehold="<?php echo app('translator')->getFromJson('admin.password'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.provides.password_confirmation'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placehold="<?php echo app('translator')->getFromJson('admin.provides.password_confirmation'); ?>">
                    </div>
                </div>

                <div class="input-group row">
                    <label for="picture" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.picture'); ?></label>
                    <div class="col-xs-10">
                        <input type="file" accept="image/*" name="avatar" class="dropify form-control-file" id="picture" aria-describedby="fileHelp">
                    </div>
                </div>

                <div class="form-group">
                    <label for="country_code" class="bmd-label-floating">Country code</label>
                    <div class="col-xs-10">
                        <input type="text" name="country_code" value="+55" style ="padding-bottom:5px;" class="country-name" id="country_code" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="mobile" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.mobile'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" type="number" value="<?php echo e(old('mobile')); ?>" name="mobile" required id="mobile" placehold="<?php echo app('translator')->getFromJson('admin.mobile'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="mobile" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.driver_address'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="<?php echo e(old('address')); ?>" name="address" required id="address" placehold="<?php echo app('translator')->getFromJson('admin.driver_address'); ?>">
                    </div>
                </div>
                 <div class="form-group">
                    <label for="mobile" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.driver_LICENSENO'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="<?php echo e(old('LICENSENO')); ?>" name="licenseNo" required id="licenseNo" placehold="<?php echo app('translator')->getFromJson('admin.driver_LICENSENO'); ?>">
                    </div>
                </div>
                 <div class="form-group">
                    <label for="mobile" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.driver_carno'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="<?php echo e(old('carno')); ?>" name="service_number" required id="service_number" placehold="<?php echo app('translator')->getFromJson('admin.driver_carno'); ?>">
                    </div>
                </div>
                 <div class="form-group">
                    <label for="mobile" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.driver_carmodel'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="<?php echo e(old('carno')); ?>" name="service_model" required id="service_model" placehold="<?php echo app('translator')->getFromJson('admin.driver_carmodel'); ?>">
                    </div>
                </div>
                 <div class="form-group">
                    <label for="mobile" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.driver_cartype'); ?></label>
                    <select class="form-control" name="service_type" id="service_type" data-validation="required">
                    <option value="">Select <?php echo app('translator')->getFromJson('admin.driver_cartype'); ?></option>
                    <?php $__currentLoopData = get_all_service_types(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                </div>


                <div class="form-group">
                    <label for="zipcode" class="bmd-label-floating"></label>
                    <div class="col-xs-10">
                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->getFromJson('admin.provides.add_provider'); ?></button>
                        <a href="<?php echo e(route('admin.provider.index')); ?>" class="btn btn-default"><?php echo app('translator')->getFromJson('admin.cancel'); ?></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('asset/js/intlTelInput.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('asset/js/intlTelInput-jquery.min.js')); ?>"></script>
<script type="text/javascript">
       var input = document.querySelector("#country_code");

    //    var states = $('#states');

    //    states.change(function () {
    //        var idEstado = $(this).val();
    //        $.get('/admin/cities/' + idEstado, function (cidades) {
    //            $('#cities').empty();
    //            $.each(cidades, function (key, value) {
    //                $('#cities').append('<option value=' + value.id + '>' + value.title + '</option>');
    //            });
    //        });
    //    });

    //    if(states.val() != null){
    //        $.get('/admin/cities/' + states.val(), function (cidades) {
    //            $('#cities').empty();
    //            $.each(cidades, function (key, value) {
    //                $('#cities').append('<option value=' + value.id + '>' + value.title + '</option>');
    //            });
    //        });
    //    }

       window.intlTelInput(input,({
           // separateDialCode:true,
       }));
       $(".country-name").click(function(){
           var myVar = $(this).closest('.country').find(".dial-code").text();
           $('#country_code').val(myVar);
        });
		</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>