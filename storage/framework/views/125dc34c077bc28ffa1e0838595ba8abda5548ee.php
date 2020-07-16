<?php $__env->startSection('title', 'Change password'); ?>

<?php $__env->startSection('content'); ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header card-header-primary">
                          <h4 class="card-title">Change password</h4>
                          <p class="card-category">Complete your profile</p>
                        </div>
                        <div class="card-body">
                        <form class="form-horizontal"  action="<?php echo e(route('admin.provider.password',['id'=>$provider->id])); ?>" method="POST" role="form">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Password :</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Confirm password:</label>
                                        <input type="password" class="form-control" name="password_confirmation">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>