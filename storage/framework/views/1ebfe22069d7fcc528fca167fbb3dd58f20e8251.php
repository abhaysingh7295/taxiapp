<?php $__env->startSection('title', 'Vehicle Documents '); ?>

<?php $__env->startSection('content'); ?>
<div>
    <div class="container-fluid">

        <div class="card">
            <div class="card-header card-header-primary">
            <h5 class="card-title">Vehicle Name: <?php echo e($Document->vehicle->make); ?> <?php echo e($Document->vehicle->model); ?></h5>
            <h5 class="card-category"><?php echo app('translator')->getFromJson('admin.document.document_name'); ?>: <?php echo e($Document->document->name); ?></h5> <a href="<?php echo e(route('admin.vehicles.vehicledocuments', $Document->vehicle->id )); ?>" style="margin-left: 1em;margin-top: -30px" class="btn btn-primary pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
        </div>
        <div class="card-body">
            <embed src="<?php echo e($Document->url!='' ? asset('storage/'.$Document->url): asset('asset/img/semfoto.jpg')); ?>" width="100%" height="100%" />
<!--     <embed src="<?php echo e($Document->url!='' ? 'http://bhanushainfosoft.live/taxiapp/storage/app/public/'.$Document->url: asset('asset/img/semfoto.jpg')); ?>" width="100%" height="100%" />-->

            <div class="row">
                <div class="col-xs-6">
                    <form action="<?php echo e(route('admin.vehicles.approvevehicledocument', [$Document->vehicle->id, $Document->id])); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('PATCH')); ?>

                        <button class="btn btn-block btn-primary" type="submit"><?php echo app('translator')->getFromJson('admin.provides.approve'); ?></button>
                    </form>
                </div>

                <div class="col-xs-6">
                    <form action="<?php echo e(route('admin.vehicles.destroyvehicledocument', [$Document->vehicle->id, $Document->id])); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('DELETE')); ?>

                        <button class="btn btn-block btn-danger" type="submit"><?php echo app('translator')->getFromJson('admin.provides.delete'); ?></button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>