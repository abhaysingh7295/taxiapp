<?php $__env->startSection('title', 'Driver Checklist'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Driver Checklist</h4>
<!--                    <p class="card-category">Driver Checklist</p>-->
                </div>
                <div class="card-body">
                    <form class="form-horizontal"  action="<?php echo e(route('admin.provider.driverchecklist',['id'=>$provider->id])); ?>" method="POST" role="form">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <div class="row">
                            <div class="form-group">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="checkbox checkbox-inline">
                                            <input type="checkbox" id="is_check_documnet" name="is_check_documnet" value="1" <?php echo e(($provider->is_check_documnet==1)?'checked="checked"':""); ?>>
                                            <label for="is_check_documnet"> Is  Document Checked </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="checkbox checkbox-inline">
                                            <input type="checkbox" id="is_agree_add_company_logo_on_car	" name="is_agree_add_company_logo_on_car" value="1" <?php echo e(($provider->is_agree_add_company_logo_on_car==1)?'checked="checked"':""); ?>>
                                            <label for="is_agree_add_company_logo_on_car"> Is Agree Add Company Web Logo On Car	 </label>
                                        </div></div>
                                    <div class="col-sm-12">
                                        <div class="checkbox checkbox-inline">
                                            <input type="checkbox" id="is_full_time_work" name="is_full_time_work" value="1" <?php echo e(($provider->is_full_time_work==1)?'checked="checked"':""); ?>>
                                            <label for="is_full_time_work"> Is Full Time Working </label>
                                        </div></div>
                                    <div class="col-sm-12">
                                        <div class="checkbox checkbox-inline">
                                            <input type="checkbox" id="is_part_time_work" name="is_part_time_work" value="1" <?php echo e(($provider->is_part_time_work==1)?'checked="checked"':""); ?>>
                                            <label for="is_part_time_work"> Is Part Time Work </label>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="checkbox checkbox-inline">

                                            <input type="checkbox" id="	is_ready_for_schedule_job" name="is_ready_for_schedule_job" value="1" <?php echo e(($provider->is_ready_for_schedule_job==1)?'checked="checked"':""); ?>>
                                            <label for="is_ready_for_schedule_job">Is Ready For Schedule Job</label>
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="form-group">
                                    <label for="zipcode" class="bmd-label-floating"></label>
                                    <div class="col-xs-10">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="<?php echo e(route('admin.provider.index')); ?>" class="btn btn-default"><?php echo app('translator')->getFromJson('admin.cancel'); ?></a>
                                    </div>
                                </div>
                                </form>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>