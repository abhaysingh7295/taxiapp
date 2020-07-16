<?php $__env->startSection('title', 'Add Cities'); ?>
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('asset/css/intlTelInput.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title pull-left">Add Cities</h4>
                <a href="<?php echo e(URL::previous()); ?>" class="btn pull-right"><i
                        class="fa fa-angle-left"></i> <?php echo app('translator')->getFromJson('admin.back'); ?></a>
            </div>
            <div class="card-body">

                <form action="<?php echo e(route('admin.city.store')); ?>" method="POST" enctype="multipart/form-data" role="form">
                    <?php echo e(csrf_field()); ?>

                     <div class="form-group">
                        <label for="mobile" class="bmd-label-floating">Country</label>
                        <div class="col-xs-10">
                            <select id="country" name="country" class="form-control" required>
                                <option value="" selected disabled>Select</option>
                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>"> <?php echo e($country); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="bmd-label-floating">Name</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="<?php echo e(old('name')); ?>" name="name" required id="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="zipcode" class="bmd-label-floating"></label>
                        <div class="col-xs-10">
                            <button type="submit" class="btn btn-primary">Add</button>
                            <a href="<?php echo e(route('admin.city.index')); ?>" class="btn btn-default"><?php echo app('translator')->getFromJson('admin.cancel'); ?></a>
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