<?php $__env->startSection('title', 'Service Types'); ?>

<?php $__env->startSection('content'); ?>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header card-header-primary">
                <?php if(Setting::get('demo_mode', 0) == 1): ?>
                    <div class="col-md-12" style="height:50px;color:red;">
                        ** Demo Mode : <?php echo app('translator')->getFromJson('admin.demomode'); ?>
                    </div>
                <?php endif; ?>
                <h5 class="card-title">Service Types</h5>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('service-types-create')): ?>
                    <a href="<?php echo e(route('admin.service.create')); ?>" style="margin-left: 1em;"
                       class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add Service</a>
                <?php endif; ?>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th> ID </th>
                        <th> Service Name </th>
                        <!-- <th> Provider Name </th> -->
                        <th> Capacity </th>
                        <th> Minimum Rate </th>
                        <th> Base Price </th>
                        <th> Base Distance </th>
                        <th> Price Distance </th>
                        <th> Price Time </th>
                        <th> Price Hour </th>
                        <th> Price Calculation </th>
                        <th> Image </th>
                        <th> Marker Map </th>
                        <th> Action </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($index + 1); ?></td>
                                <td><?php echo e($service->name); ?></td>
                            <!-- <td><?php echo e($service->provider_name); ?></td> -->
                                <td><?php echo e($service->capacity); ?></td>
                                <td><?php echo e(currency($service->min_price)); ?></td>
                                <td><?php echo e(currency($service->fixed)); ?></td>
                                <td><?php echo e(distance($service->distance)); ?></td>
                                <td><?php echo e(currency($service->price)); ?></td>
                                <td><?php echo e(currency($service->minute)); ?></td>
                                <?php if($service->calculator == 'DISTANCEHOUR' || $service->calculator == 'HOUR'): ?>
                                    <td><?php echo e(currency($service->hour)); ?></td>
                                <?php else: ?>
                                    <td>N/A</td>
                                <?php endif; ?>
                                <td><?php echo app('translator')->getFromJson('servicetypes.'.$service->calculator); ?></td>
                                <td>
                                    <?php if($service->image): ?>
                                        <img src="<?php echo e($service->image); ?>" style="height: 50px" >
                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($service->marker): ?>
                                        <img src="<?php echo e($service->marker); ?>" style="height: 50px" >
                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <form action="<?php echo e(route('admin.service.destroy', $service->id)); ?>" method="POST">
                                        <?php echo e(csrf_field()); ?>

                                        <?php echo e(method_field('DELETE')); ?>

                                        <?php if( Setting::get('demo_mode', 0) == 0): ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('service-types-edit')): ?>
                                                <a href="<?php echo e(route('admin.service.edit', $service->id)); ?>" class="btn btn-info btn-block">
                                                    <i class="fa fa-pencil"></i> Edit
                                                </a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('service-types-delete')): ?>
                                                <button class="btn btn-danger btn-block" onclick="return confirm('Are you sure?')">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </form>
                                </td>
                            </tr>
                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th> ID </th>
                        <th> Service Name </th>
                        <!-- <th> Provider Name </th> -->
                        <th> Capacity </th>
                        <th> Minimum Rate </th>
                        <th> Base Price </th>
                        <th> Base Distance </th>
                        <th> Price Distance </th>
                        <th> Price Time </th>
                        <th> Price Hour </th>
                        <th> Price Calculation </th>
                        <th> Image </th>
                        <th> Marker Map </th>
                        <th> Action </th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>