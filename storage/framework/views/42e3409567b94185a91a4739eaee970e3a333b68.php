<?php $__env->startSection('title', 'Provider Documents '); ?>

<?php $__env->startSection('content'); ?>
<div>
    <div class="container-fluid">

        <div class="card">
            <div class="card-header card-header-primary">
            <h5 class="card-title"><?php echo app('translator')->getFromJson('admin.provides.provider_name'); ?>: <?php echo e($Document->provider->first_name); ?> <?php echo e($Document->provider->last_name); ?></h5>
            <h5 class="card-category"><?php echo app('translator')->getFromJson('admin.document.document_name'); ?>: <?php echo e($Document->document->name); ?></h5>
        </div>
        <div class="card-body">
            <embed src="<?php echo e($Document->url!='' ? asset('storage/'.$Document->url): asset('asset/img/semfoto.jpg')); ?>" width="100%" height="100%" />

            <div class="row">
                <div class="col-xs-6">
                    <form action="<?php echo e(route('admin.provider.document.update', [$Document->provider->id, $Document->id])); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <?php echo e(method_field('PATCH')); ?>

                        <button class="btn btn-block btn-primary" type="submit"><?php echo app('translator')->getFromJson('admin.provides.approve'); ?></button>
                    </form>
                </div>

                <div class="col-xs-6">
                    <form action="<?php echo e(route('admin.provider.document.destroy', [$Document->provider->id, $Document->id])); ?>" method="POST">
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