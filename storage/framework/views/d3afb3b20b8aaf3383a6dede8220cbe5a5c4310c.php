<?php $__env->startSection('title', 'Update User '); ?>

<?php $__env->startSection('content'); ?>


    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
            <h5 class="card-title"><?php echo app('translator')->getFromJson('admin.admins.update_user'); ?></h5>
            <a href="<?php echo e(URL::previous()); ?>" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> <?php echo app('translator')->getFromJson('admin.back'); ?></a>
            </div>
            <div class="card-body">

            <form class="form-horizontal" action="<?php echo e(route('admin.sub-admins.update', $user->id )); ?>" method="POST" role="form">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="_method" value="PATCH">
                <div class="form-group">
                    <label for="name" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.name'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="<?php echo e($user->name); ?>" name="name" required id="name" placehold="First Name">
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.email'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="<?php echo e($user->email); ?>" name="email" required id="email" placehold="First Name">
                    </div>
                </div>


<!--                <div class="form-group">
                    <label for="name" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.name'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="<?php echo e($user->first_name); ?>" name="first_name" id="name" placehold="First Name">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="name" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.name'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="<?php echo e($user->last_name); ?>" name="last_name" id="password_confirmation" placehold="First Name">
                    </div>
                </div>-->

                <div class="form-group">
                    <label for="permission" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.role'); ?></label>
                    <div class="col-xs-10">
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label><input type="checkbox" <?php if(in_array($role->id, $userRole)) { echo 'checked'; } ?> value="<?php echo e($role->id); ?>" name="roles[]" id="roles" />
                        <?php echo e($role->name); ?></label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="zipcode" class="bmd-label-floating"></label>
                    <div class="col-xs-10">
                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->getFromJson('admin.admins.update_user'); ?></button>
                        <a href="<?php echo e(route('admin.sub-admins.index')); ?>" class="btn btn-default"><?php echo app('translator')->getFromJson('admin.cancel'); ?></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>