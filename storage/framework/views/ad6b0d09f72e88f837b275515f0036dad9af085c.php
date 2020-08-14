<?php $__env->startSection('title', 'Documents '); ?>

<?php $__env->startSection('content'); ?>


        <div class="container-fluid">
            
            <div class="card">
                <div class="card-header card-header-primary">
             <?php if(Setting::get('demo_mode', 0) == 1): ?>
                <div class="col-md-12" style="height:50px;color:red;">
                    ** Demo Mode : <?php echo app('translator')->getFromJson('admin.demomode'); ?>
                </div>
             <?php endif; ?>
                <h5 class="card-title"><?php echo app('translator')->getFromJson('admin.document.document'); ?></h5>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('documents-create')): ?>
                <a href="<?php echo e(route('admin.document.create')); ?>" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> <?php echo app('translator')->getFromJson('admin.document.add_Document'); ?></a>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table ">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('admin.id'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.document.document_name'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.type'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.document.document_isexpiredate'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($index + 1); ?></td>
                            <td><?php echo e($document->name); ?></td>
                            <td><?php echo e($document->type == "VEHICLE" ? "VEHICLE" : "DRIVER"); ?></td>
                            <td><?php echo e($document->is_expiredate == "1" ? "Yes" : "No"); ?></td>
                            <td>
                                <form action="<?php echo e(route('admin.document.destroy', $document->id)); ?>" method="POST">
                                    <?php echo e(csrf_field()); ?>

                                    <input type="hidden" name="_method" value="DELETE">
                                    <?php if( Setting::get('demo_mode', 0) == 0): ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('documents-edit')): ?>
                                    <a href="<?php echo e(route('admin.document.edit', $document->id)); ?>" class="btn btn-info"><i class="fa fa-pencil"></i> <?php echo app('translator')->getFromJson('admin.edit'); ?></a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('documents-delete')): ?>
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> <?php echo app('translator')->getFromJson('admin.delete'); ?></button>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('admin.id'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.document.document_name'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.type'); ?></th>
                              <th><?php echo app('translator')->getFromJson('admin.document.document_isexpiredate'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.action'); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>