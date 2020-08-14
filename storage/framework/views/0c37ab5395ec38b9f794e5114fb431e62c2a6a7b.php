<?php $__env->startSection('title', 'Driver Documents'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Driver Documents</h4> 
                    <a href="<?php echo e(route('admin.provider.index')); ?>" style="margin-left: 1em;margin-top: -30px" class="btn btn-primary pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                    

                </div>
                <div class="card-body">


                    <div class="form-group">

                        <div class="manage-doc-section">

                            <div class="manage-doc-section-content">
                                <?php $__currentLoopData = $DriverDocuments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="manage-doc-box row no-margin border-top">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="manage-doc-box-left">
                                            <p class="manage-txt"><?php echo e($Document->name); ?></p>
                                            <p class="license"><?php echo app('translator')->getFromJson('provider.expires'); ?>: <?php echo e($provider->document($Document->id) ? ($provider->document($Document->id)->expires_at ? $provider->document($Document->id)->expires_at: 'N/A'): 'N/A'); ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="manage-doc-box-center text-center">
                                            <p class="manage-badge <?php echo e($provider->document($Document->id) ? ($provider->document($Document->id)->status == 'ASSESSING' ? 'yellow-badge' : 'green-badge') : 'red-badge'); ?>">
                                                <?php if($provider->document($Document->id)): ?>
                                                <?php if($provider->document($Document->id)->status == "ASSESSING"): ?><?php echo e("ASSESSING"); ?>

                                                <?php elseif($provider->document($Document->id)->status == "ACTIVE"): ?> <?php echo e("APROVADO"); ?>

                                                <?php elseif($provider->document($Document->id)->status == "MISSING"): ?> <?php echo e("NOT SENT"); ?> <?php endif; ?>
                                                <?php else: ?> <?php echo e("NOT SENT"); ?> <?php endif; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="manage-doc-box-right text-right">
                                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                <form action="<?php echo e(route('admin.provider.updatedocuments', [$Document->id,$provider->id])); ?>" method="POST" enctype="multipart/form-data">
                                                    <?php echo e(csrf_field()); ?>

                                                    <?php echo e(method_field('PATCH')); ?>

                                                    <?php if($Document->is_expiredate == "1"): ?>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <div class="manage-doc-box-left">
                                                    <p class="manage-txt">Expire Date</p>

                                                    <input class="form-control" type="date" value="<?php echo e(old('expires_at')); ?>" name="expires_at" required id="expires_at">
                                                </div>
                                            
                                               
                                            </div>
                                             <?php endif; ?>
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