<?php $__env->startSection('title', 'Drivers Earnings '); ?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title ">Simple Table</h4>
            <h3>Drivers Earnings</h3>
            </div>
            <div class="card-body">
            <div class="row">

                <div class="row row-md mb-2" style="padding: 15px;">
                    <div class="col-md-12">
                        <div class="box bg-white">
                            <div class="box-block clearfix">
                                <h5 class="float-xs-left"><?php echo app('translator')->getFromJson('admin.include.provider_earnings'); ?></h5>
                                <div class="float-xs-right">
                                </div>
                            </div>

                            <?php if(count($Providers) != 0): ?>
                            <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td><?php echo app('translator')->getFromJson('admin.provides.provider_name'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('admin.mobile'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('admin.status'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('admin.provides.Total_Rides'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('admin.provides.Total_Earning'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('admin.provides.Commission'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('admin.provides.Joined_at'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('admin.provides.Details'); ?></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $diff = ['-success', '-info', '-warning', '-danger']; ?>
                                    <?php $__currentLoopData = $Providers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $provider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <?php echo e($provider->first_name); ?>

                                            <?php echo e($provider->last_name); ?>

                                        </td>
                                        <td>
                                            <?php echo e($provider->mobile); ?>

                                        </td>
                                        <td>
                                            <?php if($provider->status == "approved"): ?>
                                                <span class="tag tag-success">Approved</span>
                                            <?php elseif($provider->status == "banned"): ?>
                                                <span class="tag tag-danger">Banned</span>
                                            <?php elseif($provider->status == "document"): ?>
                                                <span class="tag tag-warning">Awaiting Verification</span>
                                            <?php elseif($provider->status == "onboarding"): ?>
                                                <span class="tag tag-danger">Missing Documents</span>
                                            <?php else: ?>
                                                <span class="tag tag-info"><?php echo e($provider->status); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($provider->rides_count): ?>
                                            <?php echo e($provider->rides_count); ?>

                                            <?php else: ?>
                                            -
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($provider->payment): ?>
                                            <?php echo e(currency($provider->payment[0]->overall)); ?>

                                            <?php else: ?>
                                            -
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($provider->payment): ?>
                                            <?php echo e(currency($provider->payment[0]->commission)); ?>

                                            <?php else: ?>
                                            -
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($provider->created_at): ?>
                                            <span class="text-muted"><?php echo e($provider->created_at->diffForHumans()); ?></span>
                                            <?php else: ?>
                                            -
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('admin.statement', $provider->id)); ?>">Ver histórico</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <tfoot>
                                    <tr>
                                        <td><?php echo app('translator')->getFromJson('admin.provides.provider_name'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('admin.mobile'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('admin.status'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('admin.provides.Total_Rides'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('admin.provides.Total_Earning'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('admin.provides.Commission'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('admin.provides.Joined_at'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('admin.provides.Details'); ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <?php echo $__env->make('common.pagination', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php else: ?>
                            <h6 class="no-result">Resultados não encontrados</h6>
                            <?php endif; ?>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>