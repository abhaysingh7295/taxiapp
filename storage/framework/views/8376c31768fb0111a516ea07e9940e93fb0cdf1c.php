<?php $__env->startSection('title', 'Notificações '); ?>

<?php $__env->startSection('content'); ?>

    <div>
        <div class="container-fluid">
            
            <div class="card">
                <?php if(Setting::get('demo_mode', 0) == 1): ?>
                    <div class="col-md-12" style="height:50px;color:red;">
                        ** Demo Mode : <?php echo app('translator')->getFromJson('admin.demomode'); ?>
                    </div>
                <?php endif; ?>
                <h5 class="mb-1"><?php echo app('translator')->getFromJson('admin.notification.title'); ?></h5>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('notification-create')): ?>
                <a href="<?php echo e(route('admin.notification.create')); ?>" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> <?php echo app('translator')->getFromJson('admin.notification.add'); ?></a>
                <?php endif; ?>

                <table class="table table-striped table-bordered dataTable" id="table-2">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('admin.id'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.notification.notify_type'); ?> </th>
                            <th><?php echo app('translator')->getFromJson('admin.notification.notify_image'); ?> </th>                           
                            <th><?php echo app('translator')->getFromJson('admin.notification.notify_desc'); ?> </th>
                            <th><?php echo app('translator')->getFromJson('admin.notification.notify_status'); ?> </th>                           
                            <th><?php echo app('translator')->getFromJson('admin.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $notification; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $notify): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($index + 1); ?></td>
                            <td>
                                <?php if($notify->notify_type == "user"): ?> 
                                    Users
                                <?php elseif($notify->notify_type == "provider"): ?>
                                    Drivers
                                <?php else: ?>
                                    All
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($notify->image): ?> 
                                    <img src="<?php echo e($notify->image); ?>" style="height: 50px" >
                                <?php else: ?>
                                    N/A
                                <?php endif; ?>
                            </td>    
                            <td><?php echo e($notify->description); ?> </td>

                            <td>
                                <?php if($notify->status=='active'): ?>
                                    <span class="tag tag-success">Ativo</span>
                                <?php else: ?>
                                    <span class="tag tag-danger">Inativo</span>
                                <?php endif; ?>
                            </td>
                           
                            <td>
                                <form action="<?php echo e(route('admin.notification.destroy', $notify->id)); ?>" method="POST">
                                    <?php echo e(csrf_field()); ?>

                                    <input type="hidden" name="_method" value="DELETE">
                                    <?php if( Setting::get('demo_mode', 0) == 0): ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('notification-edit')): ?>
                                    <a href="<?php echo e(route('admin.notification.edit', $notify->id)); ?>" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('notification-delete')): ?>
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</button>
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
                            <th><?php echo app('translator')->getFromJson('admin.notification.notify_type'); ?> </th>
                            <th><?php echo app('translator')->getFromJson('admin.notification.notify_image'); ?> </th>                           
                            <th><?php echo app('translator')->getFromJson('admin.notification.notify_desc'); ?> </th>
                            <th><?php echo app('translator')->getFromJson('admin.notification.notify_status'); ?> </th>                           
                            <th><?php echo app('translator')->getFromJson('admin.action'); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>