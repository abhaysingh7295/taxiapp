<?php $__env->startSection('title', 'Driver Fare Issues Type '); ?>

<?php $__env->startSection('content'); ?>

            <div class="card">
                <div class="card-header card-header-primary">
                    <h5 class="card-title"><?php echo app('translator')->getFromJson('admin.driverfareissue.title'); ?></h5>
                    <?php if(Setting::get('demo_mode', 0) == 1): ?>
                    <div class="card-category" style="height:50px;color:red;">
                        ** Demo Mode : <?php echo app('translator')->getFromJson('admin.demomode'); ?>
                    </div>
                <?php endif; ?>
                
     
                <a href="<?php echo e(route('admin.driverfareissuetypes.create')); ?>" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> <?php echo app('translator')->getFromJson('admin.driverfareissue.add_dispute'); ?></a>
          
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                
                <table class="table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('admin.id'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.driverfareissue.dispute_type'); ?> </th>
                            <th><?php echo app('translator')->getFromJson('admin.driverfareissue.dispute_name'); ?> </th>                             
                            <th><?php echo app('translator')->getFromJson('admin.status'); ?></th>                         
                            <th><?php echo app('translator')->getFromJson('admin.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $driverfareissuetype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $dist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($index + 1); ?></td>
                            <td><?php if($dist->type=='user'): ?><?php echo e(__('admin.user')); ?> <?php endif; ?> <?php if($dist->type=='provider'): ?><?php echo e(__('admin.provider')); ?> <?php endif; ?></td>
                            <td><?php echo e(ucfirst($dist->name)); ?> </td>
                            <td>
                                <?php if($dist->status=='active'): ?>
                                    <span class="tag tag-success"><?php echo app('translator')->getFromJson('admin.active'); ?></span>
                                <?php else: ?>
                                    <span class="tag tag-danger"><?php echo app('translator')->getFromJson('admin.inactive'); ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <form action="<?php echo e(route('admin.driverfareissuetypes.destroy', $dist->id)); ?>" method="POST">
                                    <?php echo e(csrf_field()); ?>

                                    <input type="hidden" name="_method" value="DELETE">
                                    <?php if( Setting::get('demo_mode', 0) == 0): ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dispute-edit')): ?>
                                    <a href="<?php echo e(route('admin.driverfareissuetypes.edit', $dist->id)); ?>" class="btn btn-info"><i class="fa fa-pencil"></i> <?php echo app('translator')->getFromJson('admin.edit'); ?></a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dispute-delete')): ?>
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
                            <th><?php echo app('translator')->getFromJson('admin.driverfareissue.dispute_type'); ?> </th>
                            <th><?php echo app('translator')->getFromJson('admin.driverfareissue.dispute_name'); ?> </th>                              
                            <th><?php echo app('translator')->getFromJson('admin.status'); ?></th>                            
                            <th><?php echo app('translator')->getFromJson('admin.action'); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>