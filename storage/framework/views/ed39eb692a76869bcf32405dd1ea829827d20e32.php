<?php $__env->startSection('title', 'Promotional Coupons '); ?>

<?php $__env->startSection('content'); ?>


        <div class="container-fluid">
            
            <div class="card">
                <div class="card-header card-header-primary">
                <?php if(Setting::get('demo_mode', 0) == 1): ?>
                    <div class="col-md-12" style="height:50px;color:red;">
                        ** Demo Mode : <?php echo app('translator')->getFromJson('admin.demomode'); ?>
                    </div>
                <?php endif; ?>
                <h5 class="card-title"><?php echo app('translator')->getFromJson('admin.promocode.promocodes'); ?></h5>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('promocodes-create')): ?>
                <a href="<?php echo e(route('admin.promocode.create')); ?>" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> <?php echo app('translator')->getFromJson('admin.promocode.add_promocode'); ?></a>
                <?php endif; ?>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('admin.id'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.promocode.promocode'); ?> </th>
                            <th><?php echo app('translator')->getFromJson('admin.promocode.percentage'); ?> </th>
                            <th><?php echo app('translator')->getFromJson('admin.promocode.max_amount'); ?> </th>
                            <th><?php echo app('translator')->getFromJson('admin.promocode.expiration'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.status'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.promocode.used_count'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $promocodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $promo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($index + 1); ?></td>
                            <td><?php echo e($promo->promo_code); ?></td>
                            <td><?php echo e($promo->percentage); ?></td>
                            <td><?php echo e($promo->max_amount); ?></td>
                            <td>
                                <?php echo e($promo->expiration); ?>

                            </td>
                            <td>
                                <?php if(date("Y-m-d H:i") <= $promo->expiration): ?>
                                    <span class="tag tag-success">Valid</span>
                                <?php else: ?>
                                    <span class="tag tag-danger">Expired</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php echo e(promo_used_count($promo->id)); ?>

                            </td>
                            <td>
                                <form action="<?php echo e(route('admin.promocode.destroy', $promo->id)); ?>" method="POST">
                                    <?php echo e(csrf_field()); ?>

                                    <input type="hidden" name="_method" value="DELETE">
                                    <?php if( Setting::get('demo_mode', 0) == 0): ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('promocodes-edit')): ?>
                                    <a href="<?php echo e(route('admin.promocode.edit', $promo->id)); ?>" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('promocodes-delete')): ?>
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
                            <th><?php echo app('translator')->getFromJson('admin.promocode.promocode'); ?> </th>
                            <th><?php echo app('translator')->getFromJson('admin.promocode.percentage'); ?> </th>
                            <th><?php echo app('translator')->getFromJson('admin.promocode.max_amount'); ?> </th>
                            <th><?php echo app('translator')->getFromJson('admin.promocode.expiration'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.status'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.promocode.used_count'); ?></th>
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