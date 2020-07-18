<?php $__env->startSection('content'); ?>
<div class="pro-dashboard-head">
    <div class="container">
        <a href="<?php echo e(route('provider.profile.index')); ?>" class="pro-head-link"><?php echo app('translator')->getFromJson('provider.profile.profile'); ?></a>
        <a href="<?php echo e(route('provider.documents.index')); ?>" class="pro-head-link"><?php echo app('translator')->getFromJson('provider.profile.manage_documents'); ?></a>
        <a href="<?php echo e(route('provider.location.index')); ?>" class="pro-head-link"><?php echo app('translator')->getFromJson('provider.profile.update_location'); ?></a>
        <a href="#" class="pro-head-link active"><?php echo app('translator')->getFromJson('provider.profile.wallet_transaction'); ?></a>
        <?php if(config('constants.card')==1): ?>
            <a href="<?php echo e(route('provider.cards')); ?>" class="pro-head-link"><?php echo app('translator')->getFromJson('provider.card.list'); ?></a>
        <?php endif; ?>
        <a href="<?php echo e(route('provider.transfer')); ?>" class="pro-head-link"><?php echo app('translator')->getFromJson('provider.profile.transfer'); ?></a>
        <?php if(config('constants.referral')==1): ?>
            <a href="<?php echo e(route('provider.referral')); ?>" class="pro-head-link"><?php echo app('translator')->getFromJson('provider.profile.refer_friend'); ?></a>
        <?php endif; ?>
    </div>
</div>

<div class="pro-dashboard-content gray-bg">
    <div class="container">
        <div class="manage-docs pad30">
            <div class="manage-doc-content">
                <div class="manage-doc-section pad50">
                    <!-- <div class="manage-doc-section-head row no-margin">
                        <h3 class="manage-doc-tit">
                            <?php echo app('translator')->getFromJson('provider.profile.wallet_transaction'); ?>
                            (<?php echo app('translator')->getFromJson('provider.current_balance'); ?> : <?php echo e(currency($wallet_balance)); ?>)
                        </h3>
                    </div> -->
                    <?php echo $__env->make('common.notify', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <div class="row no-margin">
                    <form action="<?php echo e(url('/provider/add/money')); ?>" id="add_money" method="POST">
                    <?php echo e(csrf_field()); ?>

                        <div class="col-md-6">
                             
                            <div class="wallet">
                                <h4 class="amount">
                                    <span class="price"><?php echo e(currency(Auth::user()->wallet_balance)); ?></span>
                                    <span class="txt"><?php echo app('translator')->getFromJson('user.in_your_wallet'); ?></span>
                                </h4>
                            </div>                                                               

                        </div>
                        <div class="col-md-6">
                            
                            <h6><strong><?php echo app('translator')->getFromJson('user.add_money'); ?></strong></h6>

                            <select class="form-control" autocomplete="off" name="payment_mode" onchange="card(this.value);">
                              <?php if(Config::get('constants.card') == 1): ?>
                              <?php if($cards->count() > 0): ?>
                                <option value="CARD">CARD</option>
                              <?php endif; ?>
                              <?php if(Config::get('constants.braintree') == 1): ?>
                              <option value="BRAINTREE">BRAINTREE</option>
                              <?php endif; ?>
                              <?php endif; ?>
                              <?php if(Config::get('constants.payumoney') == 1): ?>
                              <option value="PAYUMONEY">PAYUMONEY</option>
                              <?php endif; ?>
                              <?php if(Config::get('constants.paypal') == 1): ?>
                              <option value="PAYPAL">PAYPAL</option>
                              <?php endif; ?>
                              <?php if(Config::get('constants.paytm') == 1): ?>
                              <option value="PAYTM">PAYTM</option>
                              <?php endif; ?>
                            </select>
                            <br>
                            
                            <?php if(Config::get('constants.card') == 1): ?>
                            <select style="display: none;" class="form-control" name="card_id" id="card_id">
                              <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php if($card->is_default == 1): ?> selected <?php endif; ?> value="<?php echo e($card->card_id); ?>"><?php echo e($card->brand); ?> **** **** **** <?php echo e($card->last_four); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php endif; ?>

                            <?php if(Config::get('constants.braintree') == 1): ?>
                                <div style="display: none;" id="braintree">
                                    <div id="dropin-container"></div>
                                </div>
                            <?php endif; ?>

                            <br>
                            <?php if(Config::get('constants.braintree') == 1): ?>
                            <input type="hidden" name="braintree_nonce" value="" />
                            <?php endif; ?>
                            <input type="hidden" name="user_type" value="provider" />
                            <div class="input-group full-input">
                                <input type="number" class="form-control" name="amount" placehold="<?php echo app('translator')->getFromJson('user.enter_amount'); ?>" >
                            </div>

                            
                            <button type="submit" id="submit-button" class="full-primary-btn fare-btn"><?php echo app('translator')->getFromJson('user.add_money'); ?></button> 

                        </div>
                    </form>

                </div>

                   
                     <div class="manage-doc-section-content">
                     <div class="tab-content list-content">
                      <div class="list-view pad30 ">

                            <table class="earning-table table table-responsive">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->getFromJson('provider.sno'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('provider.transaction_ref'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('provider.datetime'); ?></th>
                                       <!--  <th><?php echo app('translator')->getFromJson('provider.transaction_desc'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('provider.status'); ?></th> -->
                                        <th><?php echo app('translator')->getFromJson('provider.amount'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php ($page = ($pagination->currentPage-1)*$pagination->perPage); ?>
                               <?php $__currentLoopData = $wallet_transation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$wallet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <?php ($page++); ?>
                                    <tr>
                                        <td><?php echo e($page); ?></td>
                                        <td><a href="javascript:void(0);" class="new-pro-link trdclass" data-toggle="trdetails" title="Transaction Details" data-content="" data-alias="#wallet_<?php echo e($wallet->transaction_alias); ?>"><?php echo e($wallet->transaction_alias); ?></a></td>
                                        <td><?php echo e($wallet->transactions[0]->created_at->diffForHumans()); ?></td>
                                       <!--  <td><?php echo e($wallet->transaction_desc); ?></td> -->
                                       <!--  <td><?php if($wallet->type == 'C'): ?> <?php echo app('translator')->getFromJson('provider.credit'); ?> <?php else: ?> <?php echo app('translator')->getFromJson('provider.debit'); ?> <?php endif; ?></td> -->
                                        <td><?php echo e(currency($wallet->amount)); ?>

                                        </td>
                                        <td style="display: none;" id="wallet_<?php echo e($wallet->transaction_alias); ?>">
                                            <table class="table table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>Description</th><th>Type</th><th>Amount</th>
                                                    </tr>
                                                <tbody>
                                                    <?php $__currentLoopData = $wallet->transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$transactions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($transactions->transaction_desc); ?></td>
                                                            <td><?php if($transactions->type=='C'): ?> Credit <?php else: ?> Debit <?php endif; ?></td>
                                                            <td><?php if($transactions->type=='C'): ?><span style="color: green"> <?php echo e(currency($transactions->amount)); ?></span><?php else: ?><span style="color: red"> <?php echo e(currency($transactions->amount)); ?></span><?php endif; ?></td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                          
                            <?php echo e($wallet_transation->links()); ?>

                        </div>
                     </div>
                     </div>
               
                </div>
            </div>
        </div>
    </div>

</div>
<style type="text/css">
    .popover{
        max-width: 500px !important;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php if(Config::get('constants.braintree') == 1): ?>
<script src="https://js.braintreegateway.com/web/dropin/1.14.1/js/dropin.min.js"></script>

<script>
    var button = document.querySelector('#submit-button');
    var form = document.querySelector('#add_money');
    braintree.dropin.create({
      authorization: '<?php echo e($clientToken); ?>',
      container: '#dropin-container',
      //Here you can hide paypal
      paypal: {
        flow: 'vault'
      }
    }, function (createErr, instance) {
      button.addEventListener('click', function (e) {
        e.preventDefault();
        if(document.querySelector('select[name="payment_mode"]').value == "BRAINTREE") {
            instance.requestPaymentMethod(function (requestPaymentMethodErr, payload) {
               document.querySelector('input[name="braintree_nonce"]').value = payload.nonce;
               console.log(payload.nonce);
               form.submit();
          });
          } else {
            form.submit();
          }
        
      });
    });
</script>
<?php endif; ?>

<script>
var request=0; 

    <?php if(Config::get('constants.card') == 1): ?>
        card('CARD');
    <?php endif; ?>

    function card(value){
        $('#card_id, #braintree').fadeOut(300);
        if(value == 'CARD'){
            $('#card_id').fadeIn(300);
        }else if(value == 'BRAINTREE'){
            $('#braintree').fadeIn(300);
        }
    }

$(document).ready(function(){
    $("[data-toggle=trdetails]").popover({
        html : true,
        content: function() {
          $('[data-toggle=trdetails]').not(this).popover('hide');  
          var content = $(this).attr("data-alias");
          console.log(content);
          return $(content).html();
        },
        
    });   
});  

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('provider.layout.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>