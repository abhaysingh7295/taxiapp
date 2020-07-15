<?php $__env->startSection('title', 'Users History' ); ?>

<?php $__env->startSection('content'); ?>

<div>
    <div class="container-fluid">
            <div class="card">                
                <div class="card-header card-header-primary">
                <h4 class="card-title">Passenger History</h4>
                <div class="box-block clearfix">
                    <h5 class="float-xs-left"><?php echo app('translator')->getFromJson('admin.include.user_ride_histroy'); ?></h5>
                    <div class="float-xs-right">
                    </div>
                </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                            <?php if(count($Users) != 0): ?>
                            <table class="table table-striped table-bordered dataTable" id="table-4">
                                <thead>
                                    <tr>
                                        <td><?php echo app('translator')->getFromJson('admin.fleets.name'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('admin.mobile'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('admin.fleets.Total_Rides'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('admin.users.Total_Spending'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('admin.fleets.Joined_at'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('admin.fleets.Details'); ?></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $diff = ['-success', '-info', '-warning', '-danger']; ?>
                                    <?php $__currentLoopData = $Users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <?php echo e($user->first_name); ?> 
                                            <?php echo e($user->last_name); ?>

                                        </td>
                                        <td>
                                            <?php echo e($user->mobile); ?>

                                        </td>

                                        <td>
                                            <?php if($user->rides_count): ?>
                                            <?php echo e($user->rides_count); ?>

                                            <?php else: ?>
                                            -
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($user->payment): ?>
                                            <?php echo e(currency($user->payment[0]->overall)); ?>

                                            <?php else: ?>
                                            -
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($user->created_at): ?>
                                            <span class="text-muted"><?php echo e($user->created_at->diffForHumans()); ?></span>
                                            <?php else: ?>
                                            -
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('admin.statement_user', $user->id)); ?>">Ver histórico</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <tfoot>
                                    <tr>
                                        <td><?php echo app('translator')->getFromJson('admin.fleets.name'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('admin.mobile'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('admin.fleets.Total_Rides'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('admin.users.Total_Spending'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('admin.fleets.Joined_at'); ?></td>
                                        <td><?php echo app('translator')->getFromJson('admin.fleets.Details'); ?></td>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>