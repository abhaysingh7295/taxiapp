<?php $__env->startSection('title', 'Add Rider'); ?>
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('asset/css/intlTelInput.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title pull-left"><?php echo app('translator')->getFromJson('admin.users.add_user'); ?></h4>
                <a href="<?php echo e(URL::previous()); ?>" class="btn pull-right"><i
                        class="fa fa-angle-left"></i> <?php echo app('translator')->getFromJson('admin.back'); ?></a>
            </div>
            <div class="card-body">

                <form action="<?php echo e(route('admin.user.store')); ?>" method="POST" enctype="multipart/form-data" role="form">
                    <?php echo e(csrf_field()); ?>


                    <div class="form-group">
                        <label for="first_name" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.first_name'); ?></label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="<?php echo e(old('first_name')); ?>" name="first_name" required id="first_name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="last_name" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.last_name'); ?></label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="<?php echo e(old('last_name')); ?>" name="last_name" required id="last_name" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="checkbox"><input type="radio" checked="checked" name="gender" value="MALE" data-validation="required" data-validation-error-msg="Please select a gender"> Male</label>
                        <label class="checkbox"><input type="radio" name="gender" value="FEMALE" data-validation-error-msg="Please select a gender"> Female</label> 
                    </div>
                    <div class="form-group">
                        <label for="email" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.email'); ?></label>
                        <div class="col-xs-10">
                            <input class="form-control" type="email" required name="email" value="<?php echo e(old('email')); ?>" id="email" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.password'); ?></label>
                        <div class="col-xs-10">
                            <input class="form-control" type="password" name="password" id="password" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.account.password_confirmation'); ?></label>
                        <div class="col-xs-10">
                            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" >
                        </div>
                    </div>

                    <div class="input-group row">
                        <label for="picture" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.picture'); ?></label>
                        <div class="col">
                            <input type="file" accept="image/*" name="picture" class="dropify form-control-file" id="picture" aria-describedby="fileHelp">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="country_code" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.country_code'); ?></label>
                        <div class="col-xs-10">
                            <input type="text" name="country_code" value="+91" style ="padding-bottom:5px;" class="country-name" id="country_code">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="mobile" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.mobile'); ?></label>
                        <div class="col-xs-10">
                            <input class="form-control" type="number" value="<?php echo e(old('mobile')); ?>" name="mobile" required id="mobile" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="bmd-label-floating">Country</label>
                        <div class="col-xs-10">
                            <select id="country" name="country" class="form-control" required>
                                <option value="" selected disabled>Select Country</option>
                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>"> <?php echo e($country); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="bmd-label-floating">Select City</label>
                        <div class="col-xs-10">
                            <select name="city" id="city" class="form-control" required>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="zipcode" class="bmd-label-floating"></label>
                        <div class="col-xs-10">
                            <button type="submit" class="btn btn-primary"><?php echo app('translator')->getFromJson('admin.users.add_user'); ?></button>
                            <a href="<?php echo e(route('admin.user.index')); ?>" class="btn btn-default"><?php echo app('translator')->getFromJson('admin.cancel'); ?></a>
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
//For mobile number with date
var input = document.querySelector("#country_code");
window.intlTelInput(input, ({
// separateDialCode:true,
}));
$(".country-name").click(function () {
    var myVar = $(this).closest('.country').find(".dial-code").text();
    $('#country_code').val(myVar);
});
    </script>
    <script type="text/javascript">
    $('#country').change(function(){
    var countryID = $(this).val();    
    if(countryID){
        $.ajax({
           type:"GET",
           url:"<?php echo e(url('/admin/get-city-list')); ?>?country_id="+countryID,
           success:function(res){               
            if(res){
                $("#city").empty();
                $("#city").append('<option>Select City</option>');
                $.each(res,function(key,value){
                    $("#city").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
                   $("#city").empty();
            }
           }
        });
    }else{
       
        $("#city").empty();
    }      
   });

</script>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>