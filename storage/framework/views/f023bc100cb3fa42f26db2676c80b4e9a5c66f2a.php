<?php $__env->startSection('title', 'Update Driver fare Issues Type'); ?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
    	<div class="card">
            <div class="card-header card-header-primary">
                <h5 class="card-title" style="margin-bottom: 2em;"><?php echo app('translator')->getFromJson('admin.driverfareissue.update_dispute'); ?></h5>
              
              <a href="<?php echo e(URL::previous()); ?>" class="card-category btn btn-default pull-right"><i class="fa fa-angle-left"></i> <?php echo app('translator')->getFromJson('admin.back'); ?></a>
            
            </div>
            <div class="card-body">
            

            <form class="form-horizontal" action="<?php echo e(route('admin.driverfareissuetypes.update', $driverfareissuetype->id )); ?>" method="POST" enctype="multipart/form-data" role="form">
            	<?php echo e(csrf_field()); ?>

            	<input type="hidden" name="_method" value="PATCH">				
				
				<div class="form-group">
					<label for="type" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.driverfareissue.dispute_type'); ?></label>
					<div class="col-xs-10">
						<select name="type" class="form-control">
						
							<option value="provider" <?php if($driverfareissuetype->type=='provider'): ?>selected <?php endif; ?>><?php echo e(__('admin.provider')); ?></option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="name" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.driverfareissue.dispute_name'); ?></label>
					<div class="col-xs-10">
						<input class="form-control" autocomplete="off"  type="text" value="<?php echo e($driverfareissuetype->name); ?>" name="name" required id="dispute_name" placehold="<?php echo app('translator')->getFromJson('admin.dispute.name'); ?>">
					</div>
				</div>

				<div class="form-group">
					<label for="status" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.driverfareissue.dispute_status'); ?></label>
					<div class="col-xs-10">
						<select name="status" class="form-control">
							<option value="active" <?php if($driverfareissuetype->status=='active'): ?>selected <?php endif; ?>><?php echo app('translator')->getFromJson('admin.active'); ?></option>
							<option value="inactive" <?php if($driverfareissuetype->status=='inactive'): ?>selected <?php endif; ?>><?php echo app('translator')->getFromJson('admin.inactive'); ?></option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="" class="bmd-label-floating"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary"><?php echo app('translator')->getFromJson('admin.driverfareissue.update_dispute'); ?></button>
						<a href="<?php echo e(route('admin.driverfareissuetypes.index')); ?>" class="btn btn-default"><?php echo app('translator')->getFromJson('admin.cancel'); ?></a>
					</div>
				</div>
			</form>
		</div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>