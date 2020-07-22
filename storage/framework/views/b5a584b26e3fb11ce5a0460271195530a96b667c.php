<?php $__env->startSection('title', 'Vehicle Documents'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Vehicle Documents</h4> 
                    <a href="<?php echo e(route('admin.vehicles.index')); ?>" style="margin-left: 1em;margin-top: -30px" class="btn btn-primary pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                    

                </div>
                <div class="card-body">


                    <div class="form-group">

                        <div class="manage-doc-section">
<!--                            <div class="manage-doc-section-head row no-margin">
                                <h3 class="manage-doc-tit">
                                    <?php echo app('translator')->getFromJson('provider.profile.vehicle_document'); ?>
                                </h3>
                            </div>-->

                            <div class="manage-doc-section-content">
                                <?php $__currentLoopData = $VehicleDocuments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="manage-doc-box row no-margin border-top">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="manage-doc-box-left">
                                            <p class="manage-txt"><?php echo e($Document->name); ?></p>
<!--                                            <p class="license"><?php echo app('translator')->getFromJson('provider.expires'); ?>: <?php echo e($vehicle->document($Document->id) ? ($vehicle->document($Document->id)->expires_at ? $vehicle->document($Document->id)->expires_at: 'N/A'): 'N/A'); ?></p>-->
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="manage-doc-box-center text-center">
                                            <p class="manage-badge <?php echo e($vehicle->document($Document->id) ? ($vehicle->document($Document->id)->status == 'ASSESSING' ? 'yellow-badge' : 'green-badge') : 'red-badge'); ?>">
                                                <?php if($vehicle->document($Document->id)): ?>
                                                <?php if($vehicle->document($Document->id)->status == "ASSESSING"): ?><?php echo e("ASSESSING"); ?>

                                                <?php elseif($vehicle->document($Document->id)->status == "ACTIVE"): ?> <?php echo e("APROVADO"); ?>

                                                <?php elseif($vehicle->document($Document->id)->status == "MISSING"): ?> <?php echo e("NOT SENT"); ?> <?php endif; ?>
                                                <?php else: ?> <?php echo e("NOT SENT"); ?> <?php endif; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="manage-doc-box-right text-right">
                                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                <form action="<?php echo e(route('admin.vehicles.uploadsvehicledocuments', [$Document->id,$vehicle->id])); ?>" method="POST" enctype="multipart/form-data">
                                                    <?php echo e(csrf_field()); ?>

                                                    <?php echo e(method_field('PATCH')); ?>

                                                    <div class="form-control" data-trigger="fileinput">
                                                        <span class="fileinput-filename"></span>
                                                    </div>
                                                    <span class="input-group-addon btn btn-default btn-file fileinput-exists btn-submit">
                                                        <button>
                                                            <i class="fa fa-check"></i>
                                                        </button>
                                                    </span>
                                                    <span class="input-group-addon btn btn-default btn-file">
                                                        <span class="fileinput-new upload-link">
                                                            <i class="fa fa-upload upload-icon"></i> <?php echo app('translator')->getFromJson('provider.profile.upload'); ?>
                                                        </span>
                                                        <span class="fileinput-exists">
                                                            <i class="fa fa-edit"></i>
                                                        </span>
                                                        <input type="file" name="document" accept="application/pdf, image/*">
                                                    </span>
                                                    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                    </div>



                </div>
                   <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('provider-documents')): ?>
        <div class="card">
            <div class="card-header card-header-primary">
                <h5 class="card-title">
                    <?php echo app('translator')->getFromJson('admin.provides.provider_documents'); ?><br>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('provider-status')): ?>
                    <?php if($vehicle->status != 'approved'): ?>
                    <?php if($vehicle->documents()->count()): ?>
                    <?php if($vehicle->documents->last()->status == "ACTIVE"): ?>
<!--                    <a class="btn btn-success btn-block"
                        href="">Approve</a>-->
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endif; ?>
                </h5>
            </div>
            <?php if( Setting::get('demo_mode', 0) == 0): ?>
            <?php if(count($vehicle->documents)>0): ?>
<!--            <a href="<?php echo e(route('admin.download', $vehicle->id)); ?>" style="margin-left: 1em;"
                class="btn btn-primary pull-right"><i class="fa fa-download"></i> <?php echo app('translator')->getFromJson('admin.provides.download'); ?></a>-->
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
                            <?php $__currentLoopData = $vehicle->documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Index => $Document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                            href="<?php echo e(route('admin.vehicles.viewvehicledocument', [$vehicle->id, $Document->id])); ?>"><span
                                                class="btn btn-success btn-large"><?php echo app('translator')->getFromJson('admin.view'); ?></span></a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('provider-document-delete')): ?>
                                        
                                        <form
                                            
                                            action="<?php echo e(route('admin.vehicles.destroyvehicledocument', [$vehicle->id, $Document->id])); ?>"
                                            method="POST" id="form_delete_<?php echo e($Document->id); ?>">
                                            <?php echo e(csrf_field()); ?>

                                            <?php echo e(method_field('DELETE')); ?>

                                            <button class="btn btn-danger btn-large doc-delete"
                                            id="<?php echo e($Document->id); ?>"><?php echo app('translator')->getFromJson('admin.delete'); ?></button>
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
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<link href="<?php echo e(asset('asset/css/jasny-bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('asset/js/jasny-bootstrap.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>