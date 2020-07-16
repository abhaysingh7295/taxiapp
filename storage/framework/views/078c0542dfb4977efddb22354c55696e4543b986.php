<?php $__env->startSection('content'); ?>
<div class="pro-dashboard-head">
        <div class="container">
            <a href="<?php echo e(url('provider/earnings')); ?>" class="pro-head-link"><?php echo app('translator')->getFromJson('provider.partner.payment'); ?></a>
             <a href="<?php echo e(url('provider/upcoming')); ?>" class="pro-head-link active"><?php echo app('translator')->getFromJson('provider.partner.upcoming'); ?></a>
   <!--         <a href="new-provider-patner-invoices.html" class="pro-head-link">Payment Invoices</a>
            <a href="new-provider-banking.html" class="pro-head-link">Banking</a> -->
        </div>
    </div>

    <div class="pro-dashboard-content">
        
        <!-- Earning Content -->
        <div class="earning-content gray-bg">
            <div class="container">


                <!-- Earning section -->
                <div class="earning-section earn-main-sec pad20">
                    <!-- Earning section head -->
                    <div class="earning-section-head row no-margin">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 no-left-padding">
                            <h3 class="earning-section-tit"><?php echo app('translator')->getFromJson('provider.partner.upcoming_tips'); ?></h3>
                        </div>
                    </div>
                    <!-- End of earning section head -->

                    <!-- Earning-section content -->
                    <div class="tab-content list-content">
                        <div class="list-view pad30 ">
                            
                            <table class="earning-table table table-responsive">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->getFromJson('provider.partner.pickup_time'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('provider.partner.vehicle'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('provider.partner.pickup_address'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('provider.partner.status'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('provider.partner.action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $fully_sum = 0; ?>
                                <?php $__currentLoopData = $fully; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $each): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(date('Y D, M d - H:i A',strtotime($each->schedule_at))); ?></td>
                                        <td>
                                        	<?php if($each->service_type): ?>
                                        		<?php echo e($each->service_type->name); ?>

                                        	<?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo e($each->s_address); ?>

                                        </td>
                                        
                                        <td><?php echo e($each->status); ?></td>
                                        <td>
                                            <form method="POST" action="<?php echo e(route('provider.cancel')); ?>">
                                              <?php echo e(csrf_field()); ?>

                                                 <input type="hidden" name="id" value="<?php echo e($each->id); ?>" />
                                               <button class="btn btn-block btn-danger" type="submit" style="margin-top: -8px;"><?php echo app('translator')->getFromJson('provider.profile.cancel'); ?></button>
                                           </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                            </table>
                        </div>

                    </div>
                <!-- End of earning section -->
            </div>
        </div>
        <!-- Endd of earning content -->
    </div>                
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
	document.getElementById('set_fully_sum').textContent = "<?php echo e(currency($fully_sum)); ?>";
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('provider.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>