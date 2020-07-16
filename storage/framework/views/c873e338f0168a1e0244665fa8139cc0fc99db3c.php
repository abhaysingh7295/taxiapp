<?php $__env->startSection('title', 'Driver Documents '); ?>

<?php $__env->startSection('content'); ?>
<!-- Alterado por Allan -->

    <div class="container-fluid">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('provider-services')): ?>
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title"><?php echo app('translator')->getFromJson('admin.provides.type_allocation'); ?></h4>
                <h5>Driver: <b><?php echo e($Provider->first_name); ?> <?php echo e($Provider->last_name); ?></b> </h5>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('provider-status')): ?>
                <?php if($Provider->status == 'approved'): ?>
                <a style="margin-left: 1em;margin-top: -30px" class="btn btn-danger pull-right"
                    href="<?php echo e(route('admin.provider.disapprove', $Provider->id )); ?>"><i class="fa fa-power-off"></i>
                    Disable Driver</a>
                <?php else: ?>
                <a style="margin-left: 1em;margin-top: -30px" class="btn btn-success pull-right"
                    href="<?php echo e(route('admin.provider.approve', $Provider->id )); ?>"><i class="fa fa-check"></i> Approve
                    Driver</a>
                <?php endif; ?>
                <?php endif; ?>
                <a href="<?php echo e($backurl); ?>" style="margin-left: 1em;margin-top: -30px" class="btn btn-primary pull-right"><i
                        class="fa fa-arrow-left"></i> <?php echo app('translator')->getFromJson('admin.back'); ?></a>
            </div>
            <div class="card-body">
                
                    <?php if($ProviderService->count() > 0): ?>
                    <h6>Attributed Services: </h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->getFromJson('admin.provides.service_name'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('admin.provides.service_number'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('admin.provides.service_model'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('admin.action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $ProviderService; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($service->service_type->name); ?>

                                    </td>
                                    <td><?php echo e($service->service_number); ?></td>
                                    <td><?php echo e($service->service_model); ?></td>
                                    <td>
                                        <?php if( Setting::get('demo_mode', 0) == 0): ?>
                                        <form
                                            action="<?php echo e(route('admin.provider.document.service', [$Provider->id, $service->id])); ?>"
                                            method="POST">
                                            <?php echo e(csrf_field()); ?>

                                            <?php echo e(method_field('DELETE')); ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('provider-service-delete')): ?>
                                            <button
                                                class="btn btn-danger btn-large btn-block"><?php echo app('translator')->getFromJson('admin.delete'); ?></a><?php endif; ?>
                                        </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><?php echo app('translator')->getFromJson('admin.provides.service_name'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('admin.provides.service_number'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('admin.provides.service_model'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('admin.action'); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                        <?php endif; ?>
                    </div>


                <?php if($ProviderService->count() >= 1): ?>
                
                    <h3 class="card-title">Update Service</h3>
                
                <form action="<?php echo e(route('admin.provider.document.store', $Provider->id)); ?>" method="POST">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" required name="method" value="update">
                    <div class="row">
                        <div class="col-md-3">
                        <div class="from-group">
                            <label for="service_type" class="bmd-label-floating">Service Type</label>
                            <select class="form-control" name="service_type" required>
                                <?php $__empty_1 = true; $__currentLoopData = $ServiceTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <option value="<?php echo e($Type->id); ?>"> <?php echo e($Type->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <option>- <?php echo app('translator')->getFromJson('admin.service_select'); ?> -</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        </div>
                        <div class="col-md-3">
                        <div class="form-group">
                            <label for="service_number" class="bmd-label-floating">Vehicle Number</label>
                                <input class="form-control" type="text" value="" name="service_number" required id="service_number">
                            </div>
                        </div>
                        <div class="col-md-3">
                        <div class="form-group">
                            <label for="service_model" class="bmd-label-floating">Vehicle Model</label>
                                <input class="form-control" type="text" value="" name="service_model" required id="service_model">
                            </div>
                        </div>
                        <?php if( Setting::get('demo_mode', 0) == 0): ?>
                        <div class="col-md-3">
                        <div class="form-group">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('provider-service-update')): ?><button class="btn btn-primary btn-block"
                                type="submit">Update</button><?php endif; ?>
                        </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </form>
                <?php endif; ?>

                
                    <h3 class="card-title">Add Service</h3>
                
                    <form action="<?php echo e(route('admin.provider.document.store', $Provider->id)); ?>" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" required name="method" value="create">
                        <div class="row">
                            <div class="col-md-3">
                            <div class="from-group">
                                <label for="service_type" class="bmd-label-floating">Service Type</label>
                                <select class="form-control" name="service_type" required>
                                    <?php $__empty_1 = true; $__currentLoopData = $ServiceTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <option value="<?php echo e($Type->id); ?>"> <?php echo e($Type->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <option>- <?php echo app('translator')->getFromJson('admin.service_select'); ?> -</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-3">
                            <div class="form-group">
                                <label for="service_number" class="bmd-label-floating">Vehicle Number</label>
                                    <input class="form-control" type="text" value="" name="service_number" required id="service_number">
                                </div>
                            </div>
                            <div class="col-md-3">
                            <div class="form-group">
                                <label for="service_model" class="bmd-label-floating">Vehicle Model</label>
                                    <input class="form-control" type="text" value="" name="service_model" required id="service_model">
                                </div>
                            </div>
                            <?php if( Setting::get('demo_mode', 0) == 0): ?>
                            <div class="col-md-3">
                            <div class="form-group">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('provider-service-update')): ?><button class="btn btn-success"
                                    type="submit">Add</button><?php endif; ?>
                            </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </form>

            </div>
        </div>
        <?php endif; ?>


        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('provider-documents')): ?>
        <div class="card">
            <div class="card-header card-header-primary">
                <h5 class="card-title">
                    <?php echo app('translator')->getFromJson('admin.provides.provider_documents'); ?><br>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('provider-status')): ?>
                    <?php if($Provider->status != 'approved'): ?>
                    <?php if($Provider->documents()->count()): ?>
                    <?php if($Provider->documents->last()->status == "ACTIVE"): ?>
                    <a class="btn btn-success btn-block"
                        href="<?php echo e(route('admin.provider.approve', $Provider->id )); ?>">Approve</a>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endif; ?>
                </h5>
            </div>
            <?php if( Setting::get('demo_mode', 0) == 0): ?>
            <?php if(count($Provider->documents)>0): ?>
            <a href="<?php echo e(route('admin.download', $Provider->id)); ?>" style="margin-left: 1em;"
                class="btn btn-primary pull-right"><i class="fa fa-download"></i> <?php echo app('translator')->getFromJson('admin.provides.download'); ?></a>
            <?php endif; ?>
            <?php endif; ?>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo app('translator')->getFromJson('admin.provides.document_type'); ?></th>
                                <th><?php echo app('translator')->getFromJson('admin.status'); ?></th>
                                <th><?php echo app('translator')->getFromJson('admin.action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $Provider->documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Index => $Document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($Index + 1); ?></td>
                                <td><?php if($Document->document): ?><?php echo e($Document->document->name); ?><?php endif; ?></td>
                                <td><?php if($Document->status == "ACTIVE"): ?><?php echo e("APPROVED"); ?><?php else: ?> <?php echo e(" PENDING ASSESSMENT"); ?>

                                    <?php endif; ?></td>
                                <td>
                                    <div class="input-group-btn">
                                        <?php if( Setting::get('demo_mode', 0) == 0): ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('provider-document-edit')): ?>
                                        <a
                                            href="<?php echo e(route('admin.provider.document.edit', [$Provider->id, $Document->id])); ?>"><span
                                                class="btn btn-success btn-large"><?php echo app('translator')->getFromJson('admin.view'); ?></span></a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('provider-document-delete')): ?>
                                        <button class="btn btn-danger btn-large doc-delete"
                                            id="<?php echo e($Document->id); ?>"><?php echo app('translator')->getFromJson('admin.delete'); ?></button>
                                        <form
                                            action="<?php echo e(route('admin.provider.document.destroy', [$Provider->id, $Document->id])); ?>"
                                            method="POST" id="form_delete_<?php echo e($Document->id); ?>">
                                            <?php echo e(csrf_field()); ?>

                                            <?php echo e(method_field('DELETE')); ?>

                                        </form>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th><?php echo app('translator')->getFromJson('admin.provides.document_type'); ?></th>
                                <th><?php echo app('translator')->getFromJson('admin.status'); ?></th>
                                <th><?php echo app('translator')->getFromJson('admin.action'); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <?php endif; ?>
            </div>
        </div>
        <?php $__env->stopSection(); ?>

        <?php $__env->startSection('scripts'); ?>
        <script type="text/javascript">
            $(".doc-delete").on('click', function () {
                var doc_id = $(this).attr('id');
                $("#form_delete_" + doc_id).submit();
            });
        </script>
        <?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>