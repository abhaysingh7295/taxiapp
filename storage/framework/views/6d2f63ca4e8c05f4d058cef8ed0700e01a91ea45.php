<?php $__env->startSection('title', 'Update Rider'); ?>
<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('asset/css/intlTelInput.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <!-- edit page -->
    <div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title pull-left">Profile Page</h4>
                    <a href="<?php echo e(URL::previous()); ?>" class="btn pull-right"><i
                        class="fa fa-angle-left"></i> <?php echo app('translator')->getFromJson('admin.back'); ?></a>
                </div>
                <div class="card-body">
                <form class="form-horizontal" action="<?php echo e(route('admin.user.update', $user->id )); ?>" method="POST"
                      enctype="multipart/form-data" role="form">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="_method" value="PATCH">

                    <div class="row">
                        <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.users.first_name'); ?></label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="<?php echo e($user->first_name); ?>" name="first_name"
                                   required id="first_name" placehold="<?php echo app('translator')->getFromJson('admin.users.first_name'); ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="last_name" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.users.last_name'); ?></label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="<?php echo e($user->last_name); ?>" name="last_name"
                                   required id="last_name" placehold="<?php echo app('translator')->getFromJson('admin.users.last_name'); ?>">
                        </div>
                    </div>
                </div>
                        
                    </div>
<div class="form-group">
                        <label class="checkbox"><input type="radio" checked="checked" name="gender" value="MALE" data-validation="required" data-validation-error-msg="Please select a gender" <?php echo e(($user->gender =='MALE' ? ' checked' : '')); ?>> Male</label>
                                    <label class="checkbox"><input type="radio" name="gender" value="FEMALE" data-validation-error-msg="Please select a gender" <?php echo e(($user->gender =='FEMALE' ? ' checked' : '')); ?>> Female</label> 
                            </div>
                    <div class="iinput-group row">

                        <label for="picture" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.picture'); ?></label>
                        <div class="col">
                            <?php if(isset($user->picture)): ?>
                                <img style="height: 90px; margin-bottom: 15px; border-radius:2em;" src="<?php echo e(img($user->picture)); ?>">
                            <?php endif; ?>
                            <input type="file" accept="image/*" name="picture" class="dropify form-control-file"
                                   id="picture" aria-describedby="fileHelp">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="country_code"
                               class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.country_code'); ?></label>
                        <div class="col-xs-10">
                            <input type="text" name="country_code" style="padding-bottom:5px;" class="country-name"
                                   id="country_code" value="<?php echo e($user->country_code); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="mobile" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.mobile'); ?></label>
                        <div class="col-xs-10">
                            <input class="form-control" type="number" value="<?php echo e($user->mobile); ?>" name="mobile" required
                                   id="mobile" placehold="<?php echo app('translator')->getFromJson('admin.mobile'); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.password'); ?></label>
                        <div class="col-xs-10">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.password_confirmation'); ?></label>
                        <div class="col-xs-10">
                            <input type="password" class="form-control" name="password_confirm">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="zipcode" class="bmd-label-floating"></label>
                        <div class="col-xs-10">
                            <button type="submit" class="btn btn-primary"><?php echo app('translator')->getFromJson('admin.users.update_user'); ?></button>
                            <a href="<?php echo e(route('admin.user.index')); ?>" class="btn btn-default"><?php echo app('translator')->getFromJson('admin.cancel'); ?></a>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript" src="<?php echo e(asset('asset/js/intlTelInput.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('asset/js/intlTelInput-jquery.min.js')); ?>"></script>
    <script type="text/javascript">
        // var states = $('#states');
        // var userCity = "<?php echo e($user->city_id); ?>";

        // states.change(function () {
        //     var idEstado = $(this).val();
        //     $.get('/admin/cities/' + idEstado, function (cidades) {
        //         $('#cities').empty();
        //         $.each(cidades, function (key, value) {
        //             $('#cities').append('<option value=' + value.id + '>' + value.title + '</option>');
        //         });
        //     });
        // });

        // if (states.val() != null) {
        //     $.get('/admin/cities/' + states.val(), function (cidades) {
        //         $('#cities').empty();
        //         $.each(cidades, function (key, value) {
        //             if (value.id == userCity) {
        //                 $('#cities').append('<option value=' + value.id + ' selected>' + value.title + '</option>');
        //             } else {
        //                 $('#cities').append('<option value=' + value.id + '>' + value.title + '</option>');
        //             }
        //         });
        //     });
        // }

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>