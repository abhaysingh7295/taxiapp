<?php $__env->startSection('title', 'Add Driver Fare Issues Type'); ?>

<?php $__env->startSection('content'); ?>

        <div class="card">
            <div class="card-header card-header-primary">
                <h5 class="card-title" style="margin-bottom: 2em;"><?php echo app('translator')->getFromJson('admin.driverfareissue.add_dispute'); ?></h5>
              
              <a href="<?php echo e(URL::previous()); ?>" class="card-category btn btn-default pull-right"><i class="fa fa-angle-left"></i> <?php echo app('translator')->getFromJson('admin.back'); ?></a>
            
            </div>
            <div class="card-body">
            

            <form class="form-horizontal" action="<?php echo e(route('admin.driverfareissuetypes.store')); ?>" method="POST" enctype="multipart/form-data" role="form">
                <?php echo e(csrf_field()); ?>            	

                <div class="form-group">
                    <label for="type" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.driverfareissue.dispute_type'); ?></label>
                    <div class="col-xs-10">
                        <select name="type" class="form-control">
                            <option value="">select</option>
                           
                            <option value="provider"><?php echo app('translator')->getFromJson('admin.provider'); ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.driverfareissue.dispute_name'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" autocomplete="off"  type="text" value="<?php echo e(old('name')); ?>" name="name" required id="name" placehold="<?php echo app('translator')->getFromJson('admin.driverfareissue.dispute_name'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="dispute_status" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.driverfareissue.dispute_status'); ?></label>
                    <div class="col-xs-10">
                        <select name="status" class="form-control">
                            <option value="">select</option>
                            <option value="active"><?php echo app('translator')->getFromJson('admin.active'); ?></option>
                            <option value="inactive"><?php echo app('translator')->getFromJson('admin.inactive'); ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="bmd-label-floating"></label>
                    <div class="col-xs-10">
                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->getFromJson('admin.driverfareissue.add_dispute'); ?></button>
                        <a href="<?php echo e(route('admin.driverfareissuetypes.index')); ?>" class="btn btn-default"><?php echo app('translator')->getFromJson('admin.cancel'); ?></a>
                    </div>
                </div>
            </form>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>