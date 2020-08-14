<?php $__env->startSection('title', 'Update Reason for Cancellation '); ?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
    	<div class="card">
            <div class="card-header card-header-primary">
              <h5 class="card-title"><?php echo app('translator')->getFromJson('admin.reason.update_reason'); ?></h5>
              <a href="<?php echo e(URL::previous()); ?>" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> <?php echo app('translator')->getFromJson('admin.back'); ?></a>
            </div>
            <div class="card-body">
            <form class="form-horizontal" action="<?php echo e(route('admin.reason.update', $reason->id )); ?>" method="POST" enctype="multipart/form-data" role="form">
            	<?php echo e(csrf_field()); ?>

            	<input type="hidden" name="_method" value="PATCH">
				<div class="form-group">
					<label for="type" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.reason.type'); ?></label>
					<div class="col-xs-10">
						<select class="form-control" name="type" id="type">
							<option value="USER" <?php if($reason->type=='USER'): ?>selected <?php endif; ?>>User</option>
							<option value="PROVIDER" <?php if($reason->type=='PROVIDER'): ?>selected <?php endif; ?>>Driver</option>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<label for="reason" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.reason.reason'); ?></label>
					<div class="col-xs-10">
						<input class="form-control" autocomplete="off"  type="text" value="<?php echo e($reason->reason); ?>" name="reason" required id="reason" placehold="<?php echo app('translator')->getFromJson('admin.reason.reason'); ?>">
					</div>
				</div>
				
				<div class="form-group">
					<label for="max_amount" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.reason.status'); ?></label>
					<div class="col-xs-10">
						<select class="form-control" name="status" id="status">
							<option value="1" <?php if($reason->status==1): ?>selected <?php endif; ?>>Active</option>
							<option value="0" <?php if($reason->status==0): ?>selected <?php endif; ?>>Inactive</option>
						</select>
					</div>
				</div>


				
				<div class="form-group">
					<label for="" class="bmd-label-floating"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary"><?php echo app('translator')->getFromJson('admin.reason.update_reason'); ?></button>
						<a href="<?php echo e(route('admin.reason.index')); ?>" class="btn btn-default"><?php echo app('translator')->getFromJson('admin.cancel'); ?></a>
					</div>
				</div>
			</form>
		</div>
    </div>
</div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>