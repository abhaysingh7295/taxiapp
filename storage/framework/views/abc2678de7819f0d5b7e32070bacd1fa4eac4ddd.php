<?php $__env->startSection('title', 'Change Password'); ?>

<?php $__env->startSection('content'); ?>


    <div class="container-fluid">
        <div class="row">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title"><?php echo app('translator')->getFromJson('admin.account.change_password'); ?></h4>
                </div>
        <div class="card-body">
            <form action="<?php echo e(route('admin.password.update')); ?>" method="POST" role="form">
                <?php echo e(csrf_field()); ?>

                <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.account.old_password'); ?></label>
                        <input class="form-control" type="password" name="old_password" id="old_password">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.account.password'); ?></label>
                        <input class="form-control" type="password" name="password" id="password">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.account.password_confirmation'); ?></label>
                        <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
                      </div>
                    </div>
                  </div>

                <div class="form-group">
                    <label for="zipcode" class="bmd-label-floating"></label>
                    <div class="col-xs-10">
                        <button type="submit" class="btn btn-primary pull-right"><?php echo app('translator')->getFromJson('admin.account.change_password'); ?></button>
                        <div class="clearfix"></div>
                    </div>
                </div>

            </form>
        </div>
    </div>
        </div></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>