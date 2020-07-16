<?php $__env->startSection('title', 'Adicionar Cupom Promocional '); ?>

<?php $__env->startSection('content'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('asset/css/bootstrap-datetimepicker.min.css')); ?>">


    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
              <h5 class="card-title"><?php echo app('translator')->getFromJson('admin.promocode.add_promocode'); ?></h5>
              <a href="<?php echo e(URL::previous()); ?>" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> <?php echo app('translator')->getFromJson('admin.back'); ?></a>
            </div>
            <div class="card-body">
            
            <p style="color: #cc0033;"><b>Note:</b> Each user may use this coupon once until the expiration date. </p><br>

            <form class="form-horizontal" action="<?php echo e(route('admin.promocode.store')); ?>" method="POST" enctype="multipart/form-data" role="form">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <label for="promo_code" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.promocode.promocode'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" autocomplete="off"  type="text" value="<?php echo e(old('promo_code')); ?>" name="promo_code" required id="promo_code" placehold="<?php echo app('translator')->getFromJson('admin.promocode.promocode'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="percentage" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.promocode.percentage'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" type="number" value="<?php echo e(old('percentage')); ?>" name="percentage" required id="percentage" placehold="<?php echo app('translator')->getFromJson('admin.promocode.percentage'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="max_amount" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.promocode.max_amount'); ?></label>
                    <div class="col-xs-10">
                        <input type="number" class="form-control" name="max_amount" required id="max_amount" placehold="<?php echo app('translator')->getFromJson('admin.promocode.max_amount'); ?>" value="<?php echo e(old('max_amount')); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="expiration" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.promocode.expiration'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control datetimepicker" type="text" value="<?php echo e(old('expiration')); ?>" name="expiration" required id="expiration" placehold="<?php echo app('translator')->getFromJson('admin.promocode.expiration'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="promo_description" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.promocode.promo_description'); ?></label>
                    <div class="col-xs-10">
                        <textarea id="promo_description" placehold="Description" class="form-control" name="promo_description">0% off, Maximum discount of 0<?php echo e(old('promo_description')); ?></textarea>
                    </div>
                </div>


                <div class="form-group">
                    <label for="zipcode" class="bmd-label-floating"></label>
                    <div class="col-xs-10">
                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->getFromJson('admin.promocode.add_promocode'); ?></button>
                        <a href="<?php echo e(route('admin.promocode.index')); ?>" class="btn btn-default"><?php echo app('translator')->getFromJson('admin.cancel'); ?></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('asset/js/bootstrap-datetimepicker.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('asset/js/moment-with-locales.min.js')); ?>"></script>
<script type="text/javascript">
$(document).ready(function () {
    //your code here
    $(function () {
        $('.datetimepicker').datetimepicker({defaultDate: moment(), minDate: moment(), format: 'YYYY-MM-DD HH:mm'});
    });
});

$("#percentage").on('keyup', function () {
    var per = $(this).val() || 0;
    var max = $("#max_amount").val() || 0;
    $("#promo_description").val(per + '% off! Valor máximo de desconto R$' + max);
});

$("#max_amount").on('keyup', function () {
    var max = $(this).val() || 0;
    var per = $("#percentage").val() || 0;
    $("#promo_description").val(per + '% off! Valor máximo de desconto R$' + max);
});


</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>