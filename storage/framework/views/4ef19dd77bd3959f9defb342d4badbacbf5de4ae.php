<?php $__env->startSection('title', 'Edit Dispatcher '); ?>

<?php $__env->startSection('content'); ?>


    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title"><?php echo app('translator')->getFromJson('admin.dispatcher.update_dispatcher'); ?></h4>
              <a href="<?php echo e(URL::previous()); ?>" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> <?php echo app('translator')->getFromJson('admin.back'); ?></a>
            </div>
            <div class="card-body">
            

            <form class="form-horizontal" action="<?php echo e(route('admin.dispatch-manager.update', $dispatcher->id )); ?>" method="POST" enctype="multipart/form-data" role="form">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="_method" value="PATCH">

                <div class="form-group">
                    <label for="name" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.account-manager.full_name'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="<?php echo e($dispatcher->name); ?>" name="name" required id="name" placehold="Full Name">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.email'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="<?php echo e($dispatcher->email); ?>" readonly="true" name="email" required id="email" placehold="Full Name">
                    </div>
                </div>

                <div class="form-group">
                    <label for="mobile" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.mobile'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control numbers" type="number" value="<?php echo e($dispatcher->mobile); ?>" name="mobile" required id="mobile" placehold="Mobile">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="bmd-label-floating">Password</label>
                    <div class="col-xs-10">
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>

                <div class="form-group">
                    <label class="bmd-label-floating">Repeat Password</label>
                    <div class="col-xs-10">
                        <input type="password" class="form-control" name="password_confirm">
                    </div>
                </div>

                <div class="form-group">
                    <label for="zipcode" class="bmd-label-floating"></label>
                    <div class="col-xs-10">
                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->getFromJson('admin.dispatcher.update_dispatcher'); ?></button>
                        <a href="<?php echo e(route('admin.dispatch-manager.index')); ?>" class="btn btn-default"><?php echo app('translator')->getFromJson('admin.cancel'); ?></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>