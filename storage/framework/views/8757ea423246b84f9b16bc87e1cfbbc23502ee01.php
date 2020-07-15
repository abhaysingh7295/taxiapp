<?php $__env->startSection('title', 'Transfers'); ?>

<?php $__env->startSection('content'); ?>

        <div class="container-fluid">
            <?php if($type=='provider'): ?> <?php ($flag=1); ?> <?php else: ?> <?php ($flag=2); ?> <?php endif; ?>
            <div class="card">
                <div class="card-header card-header-primary">
                <?php if(Setting::get('demo_mode', 0) == 1): ?>
                <div class="col-md-12" style="hSetting::get('demo_mode', 0) == 0eight:50px;color:red;">
                    ** Demo Mode : No Permission to create or send settlements.
                </div>
                <?php endif; ?>
                <h5 class="card-title ">Pending request <?php if($type=='provider'): ?> Driver <?php endif; ?></h5>

                <?php if(Setting::get('demo_mode', 0) == 0): ?>
                    <a href="<?php echo e(route('admin.transfercreate', $flag)); ?>" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> <?php echo app('translator')->getFromJson('admin.addsettle'); ?></a>
                <?php endif; ?>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('admin.sno'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.transaction_ref'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.datetime'); ?></th>
                            <?php if($type=='provider'): ?>
                                <th><?php echo app('translator')->getFromJson('admin.provides.provider_name'); ?></th>
                            <?php endif; ?>        
                            <th><?php echo app('translator')->getFromJson('admin.amount'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php ($total=0); ?>
                       <?php $__currentLoopData = $pendinglist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$pending): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php ($total+=$pending->amount); ?>
                            <tr>
                                <td><?php echo e($index+1); ?></td>
                                <td><?php echo e($pending->alias_id); ?></td>                               
                                <td><?php echo e($pending->created_at->diffForHumans()); ?></td>
                                <?php if($type=='provider'): ?>
                                    <td><?php echo e($pending->provider->first_name." ".$pending->provider->last_name); ?> </td>
                                <?php endif; ?>
                                <td><?php echo e(currency($pending->amount)); ?></td>
                                <td> 
                                    <?php if( Setting::get('demo_mode', 0) == 0): ?>                                   
                                        <!-- <a class="btn btn-success btn-block" href="<?php echo e(route('admin.approve', $pending->id)); ?>"><?php echo app('translator')->getFromJson('admin.approve'); ?></a> -->
                                        <button type="button" class="btn btn-success btn-block transferClass" data-toggle="modal" data-target="#transferModal" data-id="send" data-href="<?php echo e(route('admin.approve', $pending->id)); ?>" data-rid="<?php echo e($pending->id); ?>"><?php echo app('translator')->getFromJson('admin.approve'); ?></button>
                                        <!-- <a class="btn btn-danger btn-block" href="<?php echo e(route('admin.cancel')); ?>?id=<?php echo e($pending->id); ?>"><?php echo app('translator')->getFromJson('admin.cancel'); ?></a> -->

                                        <button type="button" class="btn btn-danger btn-block transferClass" data-toggle="modal" data-target="#transferModal" data-id="cancel" data-href="<?php echo e(route('admin.cancel')); ?>?id=<?php echo e($pending->id); ?>" data-rid="<?php echo e($pending->id); ?>"><?php echo app('translator')->getFromJson('admin.cancel'); ?></button>
                                    <?php endif; ?>    
                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>

    <!-- Modal -->
    <div id="transferModal" class="modal fade" role="dialog" data-backdrop="static" aria-hidden="true" data-keyboard="false">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            <h4 class="modal-title" id="settitle"></h4>
          </div>
          <form action="" method="Get" id="transurl">
          <div class="modal-body">
            <div id="sendbody" style="display:none">
                <div class="form-group">
                    <label for="send_by" class="col-xs-3 col-form-label" required>Payment</label>
                    <div class="col-xs-5">
                        <select class="form-control" name="send_by" id="send_by">
                            <?php if(config("constants.card")==1): ?>
                                <option value="online">Stripe</option>
                            <?php endif; ?>    
                            <?php if(config("constants.cash")==1): ?>    
                                <option value="offline">Offline</option>
                            <?php endif; ?>                         
                        </select>
                    </div>
                </div>
                <div id="show_alert_text" class="alert alert-warning alert-dismissible" style="display:none">
                    <strong>Attention!</strong> <span id="setbody">Are you sure you want to complete this transaction in cash mode?</span>
                </div>
            </div>
            <div id="cancelbody" style="display:none">
                <input type="hidden" value="" name="id" id="transfer_id">
                <div class="alert alert-warning alert-dismissible">
                    <strong>Attention!</strong> <span id="setbody">Are you sure you want to cancel this transaction?</span>
                </div>
            </div>    
          </div>
          <div class="modal-footer">
            <?php if(config("constants.card")==1 || config("constants.cash")==1): ?>
                <!-- <a class="btn btn-success" href="#" id="transurl">Confirm</a> -->
                <button type="submit" class="btn btn-success">Confirm</button>
            <?php endif; ?>    
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </form>
        </div>

      </div>
    </div>
        </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
    var card='<?php echo e(config("constants.card")); ?>';
    <?php if(config("constants.card")==0): ?>
        $("#show_alert_text").show();
    <?php endif; ?>
    $(function () {
        $(".transferClass").click(function () {
            var curl = $(this).attr('data-href');
            var page = $(this).attr('data-id');
            $("#transurl").attr('action',curl);
            if(page=='send'){
                $("#settitle").text('Confirmar Transferência');
                $("#cancelbody").hide();
                $("#sendbody").show();
                $("#send_by").on('change', function(){
                    var ddval=$("#send_by").val();
                    if(ddval=="offline"){
                        $("#show_alert_text").show();
                    }
                    else{
                        $("#show_alert_text").hide();
                    }
                })
                
            }
            else{
                $("#transfer_id").val($(this).attr('data-rid'));
                $("#settitle").text('Cancelar Transferência');
                $("#sendbody").hide();
                $("#cancelbody").show();
            }
            
        })
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>