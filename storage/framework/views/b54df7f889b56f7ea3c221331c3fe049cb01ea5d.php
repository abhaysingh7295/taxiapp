<?php $__env->startSection('title', 'Scheduled Trips'); ?>

<?php $__env->startSection('content'); ?>


        <div class="container-fluid">
            
            <div class="card">
                <div class="card-header card-header-primary">
                    <h5 class="card-title ">Scheduled Trips</h5>
                  </div>
                  <div class="card-body">
                <?php if(count($requests) != 0): ?>
                <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('admin.id'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.request.Request_Id'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.request.User_Name'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.request.Provider_Name'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.request.Scheduled_Date_Time'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.status'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.request.Payment_Mode'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.request.Payment_Status'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($index + 1); ?></td>

                            <td><?php echo e($request->id); ?></td>
                            <td><?php echo e($request->user?$request->user->first_name:''); ?> <?php echo e($request->user?$request->user->last_name:''); ?></td>
                            <td>
                                <?php if($request->provider_id): ?>
                                    <?php echo e($request->provider?$request->provider->first_name:''); ?> <?php echo e($request->provider?$request->provider->last_name:''); ?>

                                <?php else: ?>
                                    N/A
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($request->schedule_at); ?></td>
                            <td>
                                <?php if($request->status == "COMPLETED"): ?>
                                <span class="tag tag-success">CONCLUÍDA</span>
                                <?php elseif($request->status == "CANCELLED"): ?>
                                <span class="tag tag-danger">CANCELADA</span>
                                <?php else: ?>
                                <span class="tag tag-info"><?php echo e($request->status); ?></span>
                                <?php endif; ?>
                            </td>

                            <td><?php echo e($request->payment_mode); ?></td>
                            <td>
                                <?php if($request->paid): ?>
                                    Paid
                                <?php else: ?>
                                    Não Paid
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="input-group-btn">
                                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Action
                                    <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?php echo e(route('admin.requests.show', $request->id)); ?>" class="btn btn-default"><i class="fa fa-search"></i> More details</a>
                                    </li>
                                  </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('admin.id'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.request.Request_Id'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.request.User_Name'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.request.Provider_Name'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.request.Scheduled_Date_Time'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.status'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.request.Payment_Mode'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.request.Payment_Status'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.action'); ?></th>
                        </tr>
                    </tfoot>
                </table>
                </div>
                <?php else: ?>
                    <h6 class="no-result">no results found</h6>
                <?php endif; ?> 
            </div>
            
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>