<?php $__env->startSection('title', 'Itens Perdidos '); ?>

<?php $__env->startSection('content'); ?>

<div>
    <div class="container-fluid">

        <div class="card">
            <div class="card-header card-header-primary">
            <?php if(Setting::get('demo_mode', 0) == 1): ?>
            <div class="col-md-12" style="height:50px;color:red;">
                ** Demo Mode : <?php echo app('translator')->getFromJson('admin.demomode'); ?>
            </div>
            <?php endif; ?>
            <h5 class="card-title"><?php echo app('translator')->getFromJson('admin.lostitem.title'); ?></h5>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('lost-item-create')): ?>
            <a href="<?php echo e(route('admin.lostitem.create')); ?>" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> <?php echo app('translator')->getFromJson('admin.lostitem.add'); ?></a>
            <?php endif; ?>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->getFromJson('admin.id'); ?></th>
                        <th><?php echo app('translator')->getFromJson('admin.lostitem.lost_id'); ?> </th>
                        <th><?php echo app('translator')->getFromJson('admin.lostitem.lost_user'); ?> </th>                           
                        <th><?php echo app('translator')->getFromJson('admin.lostitem.lost_item'); ?> </th>
                        <th><?php echo app('translator')->getFromJson('admin.lostitem.lost_comments'); ?> </th>                           
                        <th><?php echo app('translator')->getFromJson('admin.lostitem.lost_status'); ?> </th>                           
                        <th><?php echo app('translator')->getFromJson('admin.action'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $lostitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $lost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($index + 1); ?></td>
                        <td><?php echo e($lost->request_id); ?></td>
                        <td><?php echo e($lost->user_id); ?></td>
                        <td><?php echo e($lost->lost_item_name); ?></td>
                        <td><?php echo e($lost->comments); ?></td>
                        <td>
                            <?php if($lost->status=='open'): ?>
                            <span class="tag tag-success">Aberto</span>
                            <?php else: ?>
                            <span class="tag tag-danger">Fechado</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if( Setting::get('demo_mode', 0) == 0): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('lost-item-edit')): ?>
                            <?php if($lost->status=='open'): ?>
                            <a href="<?php echo e(route('admin.lostitem.edit', $lost->id)); ?>" href="#" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
                            <?php endif; ?>   
                            <?php endif; ?> 
                            <?php endif; ?>                                
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th><?php echo app('translator')->getFromJson('admin.id'); ?></th>
                        <th><?php echo app('translator')->getFromJson('admin.lostitem.lost_id'); ?> </th>
                        <th><?php echo app('translator')->getFromJson('admin.lostitem.lost_user'); ?> </th>                           
                        <th><?php echo app('translator')->getFromJson('admin.lostitem.lost_item'); ?> </th>
                        <th><?php echo app('translator')->getFromJson('admin.lostitem.lost_comments'); ?> </th>                           
                        <th><?php echo app('translator')->getFromJson('admin.lostitem.lost_status'); ?> </th>                           
                        <th><?php echo app('translator')->getFromJson('admin.action'); ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>