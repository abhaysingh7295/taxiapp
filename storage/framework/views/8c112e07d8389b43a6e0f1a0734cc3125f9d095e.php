<?php $__env->startSection('title', __('admin.roles.update_role')); ?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
            <h5 class="card-title"><?php echo app('translator')->getFromJson('admin.roles.update_role'); ?></h5>
            <a href="<?php echo e(URL::previous()); ?>" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> <?php echo app('translator')->getFromJson('admin.back'); ?></a>
            </div>
            <div class="card-body">

            <form class="form-horizontal" action="<?php echo e(route('admin.role.update', $role->id )); ?>" method="POST" role="form">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="_method" value="PATCH">
                <div class="form-group">
                    <label for="name" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.name'); ?></label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="<?php echo e($role->name); ?>" name="name" required id="name" placehold="<?php echo app('translator')->getFromJson('admin.name'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="permission" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.permissions'); ?></label>
                    <div class="col-xs-10">
                        <?php $val = ""; ?>
                        <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($value->group_name != $val): ?> 
                        <?php $val = $value->group_name; ?>
                        
                        <h5><?php echo e($value->group_name); ?></h5>
                        <?php endif; ?>
                        <label style="margin-right: 20px; margin-bottom: 20px;"><input type="checkbox" <?php if(in_array($value->id, $rolePermissions)) { echo 'checked'; } ?> value="<?php echo e($value->id); ?>" name="permission[]" id="permission" />
                        <?php echo e($value->display_name); ?></label>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="zipcode" class="bmd-label-floating"></label>
                    <div class="col-xs-10">
                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->getFromJson('admin.roles.update_role'); ?></button>
                        <a href="<?php echo e(route('admin.role.index')); ?>" class="btn btn-default"><?php echo app('translator')->getFromJson('admin.cancel'); ?></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript">
        
        $(document).ready(function() {
            $('.checkbox_group').each(function() {
                $(this).on('change', function() {
                        $(this).closest('.row').find(':checkbox:not(.checkbox_group)').prop('checked', $(this).is(':checked'));
                    });
                });
            });
            
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>