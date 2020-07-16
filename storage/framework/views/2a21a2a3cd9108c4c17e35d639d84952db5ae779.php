<?php $__env->startSection('title', __('admin.account.update_profile')); ?>

<?php $__env->startSection('content'); ?>

<div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title pull-left"><?php echo app('translator')->getFromJson('admin.account.update_profile'); ?></h4>
                <a href="<?php echo e(URL::previous()); ?>" class="btn pull-right"><i
                    class="fa fa-angle-left"></i> <?php echo app('translator')->getFromJson('admin.back'); ?></a>
            </div>
            <div class="card-body">
            <form class="form-horizontal" action="<?php echo e(route('admin.profile.update')); ?>" method="POST" enctype="multipart/form-data" role="form">
                <?php echo e(csrf_field()); ?>


                <div class="form-group">
                    <label for="name" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.name'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="<?php echo e(Auth::guard('admin')->user()->name); ?>" name="name" required id="name" placehold=" <?php echo app('translator')->getFromJson('admin.name'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.email'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" type="email" required name="email" value="<?php echo e(isset(Auth::guard('admin')->user()->email) ? Auth::guard('admin')->user()->email : ''); ?>" id="email" placehold="<?php echo app('translator')->getFromJson('admin.email'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="bmd-label-floating"><?php echo app('translator')->getFromJson('user.profile.language'); ?></label>
                    <div class="col-xs-10">
                        <?php ($language=get_all_language()); ?>
                        <select class="form-control" name="language" id="language">
                            <?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lkey=>$lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($lkey); ?>" <?php if(Auth::user()->language==$lkey): ?> selected <?php endif; ?>><?php echo e($lang); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>    
                </div>
                <div class="input-group row">
                    <label for="picture" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.picture'); ?></label>
                    <div class="col-xs-10">
                        <?php if(isset(Auth::guard('admin')->user()->picture)): ?>
                        <img style="height: 90px; margin-bottom: 15px; border-radius:2em;" src="<?php echo e(Auth::guard('admin')->user()->picture); ?>">
                        <?php endif; ?>
                        <input type="file" accept="image/*" name="picture" class=" dropify form-control-file" aria-describedby="fileHelp">
                    </div>
                </div>

                <div class="form-group">
                    <label for="zipcode" class="bmd-label-floating"></label>
                    <div class="col-xs-10">
                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->getFromJson('admin.account.update_profile'); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>