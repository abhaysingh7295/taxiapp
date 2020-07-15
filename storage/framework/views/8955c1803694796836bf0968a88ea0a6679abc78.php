<?php $__env->startSection('title', 'Driver Statement'); ?>

<?php $__env->startSection('content'); ?>
<style type="text/css">

</style>
<!-- //TODO ALLAN - Alterações débito na máquina e voucher -->

<div class="container-fluid">
    <div class="card">
        <div class="card-header card-header-primary">
        <div class="row">
            <div class="col">
                    <h3 class="card-title"><?php echo e($page); ?></h3>
                    <?php if(isset($statement_for) && $statement_for =="provider"): ?>
                    <p>Name: <b><?php echo e($Provider->first_name); ?> <?php echo e($Provider->last_name); ?></b></p>
                    <p>Telphone: <b><?php echo e($Provider->mobile); ?></b></p>
                    <p>E-mail: <b><?php echo e($Provider->email); ?></b></p>
                    <?php endif; ?>
                </div>
                <div class="col">
                    <div style="text-align: center;padding: 20px;color: white;font-size: 24px;">
                        <?php if(isset($statement_for) && $statement_for =="provider"): ?>
                        <p><strong>
                                <span><?php echo app('translator')->getFromJson('admin.dashboard.over_earning'); ?> : <?php echo e(currency($revenue[0]->overall)); ?></span>
                                <br>
                                <span><?php echo app('translator')->getFromJson('admin.dashboard.over_commission'); ?> :
                                    <?php echo e(currency($revenue[0]->commission)); ?></span>
                            </strong></p>
                        <?php elseif(isset($statement_for) && $statement_for =="user"): ?>
                        <span><?php echo app('translator')->getFromJson('admin.dashboard.over_commission'); ?> : <?php echo e(currency($revenue[0]->commission)); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="card-header card-header-primary">
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs" data-tabs="tabs">
                            <li class="nav-item">
                    <a style="cursor:pointer" id="tday" class="nav-link showdate">Today</a>
                    </li>
                    <li class="nav-item">
                    <a style="cursor:pointer" id="yday" class="nav-link showdate">Yesterday</a>
                </li>
                <li class="nav-item">
                    <a style="cursor:pointer" id="cweek" class="nav-link showdate">This week</a>
                </li>
                <li class="nav-item">
                    <a style="cursor:pointer" id="pweek" class="nav-link showdate">Last week</a>
                </li>
                <li class="nav-item">
                    <a style="cursor:pointer" id="cmonth" class="nav-link showdate">This month</a>
                </li>
                <li class="nav-item">
                    <a style="cursor:pointer" id="pmonth" class="nav-link showdate">Last month</a>
                </li>
                <li class="nav-item">
                    <a style="cursor:pointer" id="cyear" class="nav-link showdate">This year</a>
                </li>
                <li class="nav-item">
                    <a style="cursor:pointer" id="pyear" class="nav-link showdate">Last year</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix" style="margin-top: 15px;">

                <form class="form-horizontal" action="<?php echo e(route('admin.ride.statement.range')); ?>" method="GET"
                    enctype="multipart/form-data" role="form">

                    <div class="form-group col-md-3">
                        <label for="name" class="col-xs-1 col-form-label">from</label>
                        <div class="col-xs-8">
                            <?php if(isset($statement_for) && $statement_for =="provider"): ?>
                            <input type="hidden" name="provider_id" id="provider_id" value="<?php echo e($id); ?>">
                            <?php elseif(isset($statement_for) && $statement_for =="user"): ?>
                            <input type="hidden" name="user_id" id="user_id" value="<?php echo e($id); ?>">
                            <?php endif; ?>
                            <input class="form-control" type="date" name="from_date" id="from_date" required
                                placehold="Data de">
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="email" class="col-xs-1 col-form-label">to</label>
                        <div class="col-xs-8">
                            <input class="form-control" type="date" required name="to_date" id="to_date"
                                placehold="Data até">
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="email" class="col-xs-4 col-form-label">Status</label>
                        <div class="col-xs-8">
                            <select class="form-control" name="payment_status">
                                <option value="all">select</option>
                                <option value="paid">Paid</option>
                                <option value="not_paid">Not Paid</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <div class="col-xs-8">
                            <select class="form-control" name="payment_mode">
                                <option value="all">select</option>
                                <option value="cash">Cash</option>
                                <option value="card">Card</option>
                                <option value="debit_machine">Debit Machine</option>
                                <option value="voucher">Voucher</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-1">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>
            </div>

            <div class="row">

                <div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="box box-block bg-white tile tile-1 mb-2" style="border-top-color: #3e70c9 !important;">
                        <div class="t-icon right"><span class="bg-danger"
                                style="background-color: #3e70c9 !important;"></span><i class="ti-rocket"></i></div>
                        <div class="t-content">
                            <h6 class="text-uppercase mb-1"><?php echo app('translator')->getFromJson('admin.dashboard.Rides'); ?></h6>
                            <h1 class="mb-1"><?php echo e($pagination->total); ?></h1>
                            <i class="fa fa-caret-up text-success mr-0-5"></i><span>Trips Started</span>
                        </div>
                    </div>
                </div>

                <?php if(isset($statement_for) && $statement_for !="user"): ?>
                <div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="box box-block bg-white tile tile-1 mb-2" style="border-top-color: #4bcb73 !important;">
                        <div class="t-icon right"><span class="bg-success"
                                style="background-color: #4bcb73 !important;"></span><i class="ti-money"></i></div>
                        <div class="t-content">
                            <h6 class="text-uppercase mb-1"><?php echo app('translator')->getFromJson('admin.dashboard.Revenue'); ?></h6>
                            <h1 class="mb-1"><?php echo e(currency($revenue[0]->overall)); ?></h1>
                            <i class="fa fa-caret-up text-success mr-0-5"></i><span>OF <?php echo e($pagination->total); ?>

                                Travels</span>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="box box-block bg-white tile tile-1 mb-2" style="border-top-color: #4bcb73 !important;">
                        <div class="t-icon right"><span class="bg-success"
                                style="background-color: #4bcb73 !important;"></span><i class="ti-money"></i></div>
                        <div class="t-content">
                            <h6 class="text-uppercase mb-1"><?php echo app('translator')->getFromJson('admin.dashboard.total'); ?></h6>
                            <h1 class="mb-1"><?php echo e(currency($revenue[0]->overall)); ?></h1>
                            <i class="fa fa-caret-up text-success mr-0-5"></i><span>OF <?php echo e($pagination->total); ?>

                                Travels</span>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="box box-block bg-white tile tile-1 mb-2" style="border-top-color: #f44236 !important;">
                        <div class="t-icon right"><span class="bg-primary"
                                style="background-color: #f44236 !important;"></span><i class="ti-bar-chart"></i></div>
                        <div class="t-content">
                            <h6 class="text-uppercase mb-1"><?php echo app('translator')->getFromJson('admin.dashboard.cancel_rides'); ?></h6>
                            <h1 class="mb-1"><?php echo e($cancel_rides); ?></h1>
                            <i class="fa fa-caret-down text-danger mr-0-5"></i><span>Canceled Trips</span>
                        </div>
                    </div>
                </div>

                <div class="row row-md mb-2" style="padding: 15px;">
                    <div class="col-md-12">
                        <div class="box bg-white">
                            <div class="box-block clearfix">
                                <h5 class="float-xs-left"><?php echo e($listname); ?></h5>
                                <div class="float-xs-right">
                                </div>
                            </div>

                            <?php if(count($rides) != 0): ?>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><?php echo app('translator')->getFromJson('admin.request.Booking_ID'); ?></th>
                                            
                                            <th><?php echo app('translator')->getFromJson('admin.request.picked_up'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('admin.request.dropped'); ?></th>
                                            <?php if(isset($statement_for) && $statement_for !="user"): ?>
                                            <th><?php echo app('translator')->getFromJson('admin.request.commission'); ?></th>
                                            <?php endif; ?>
                                            <?php if(isset($statement_for) && $statement_for !="user"): ?>
                                            <th><?php echo app('translator')->getFromJson('admin.request.earned'); ?></th>
                                            <?php else: ?>
                                            <th><?php echo app('translator')->getFromJson('admin.dashboard.total'); ?></th>
                                            <?php endif; ?>
                                            <th><?php echo app('translator')->getFromJson('admin.request.date'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('admin.request.status'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('admin.request.Payment_Mode'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('admin.request.Payment_Status'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('admin.request.request_details'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $diff = ['-success', '-info', '-warning', '-danger']; ?>
                                        <?php $__currentLoopData = $rides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $ride): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($ride->booking_id); ?></td>
                                            <td><?php echo e($ride->os_id? $ride->os_id:'N/A'); ?></td>
                                            <td>
                                                <?php if($ride->s_address != ''): ?>
                                                <?php echo e($ride->s_address); ?>

                                                <?php else: ?>
                                                Uninformed
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($ride->d_address != ''): ?>
                                                <?php echo e($ride->d_address); ?>

                                                <?php else: ?>
                                                Uninformed
                                                <?php endif; ?>
                                            </td>
                                            <?php if(isset($statement_for) && $statement_for !="user"): ?>
                                            <td><?php echo e(currency($ride->payment['provider_commission'])); ?></td>
                                            <?php endif; ?>
                                            <?php if(isset($statement_for) && $statement_for !="user"): ?>
                                            <td><?php echo e(currency($ride->payment['total'])); ?></td>
                                            <?php else: ?>
                                            <td><?php echo e(currency($ride->payment['total'])); ?></td>
                                            <?php endif; ?>
                                            <td>
                                                <span
                                                    class="text-muted"><?php echo e(date('d M Y',strtotime($ride->created_at))); ?></span>
                                            </td>
                                            <td>
                                                <?php if($ride->status == "COMPLETED"): ?>
                                                <span class="tag tag-success">COMPLETED</span>
                                                <?php elseif($ride->status == "CANCELLED"): ?>
                                                <span class="tag tag-danger">CANCELED</span>
                                                <?php else: ?>
                                                <span class="tag tag-info"><?php echo e($ride->status); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($ride->payment_mode == "CASH"): ?>
                                               CASH
                                                <?php elseif($ride->payment_mode == "DEBIT_MACHINE"): ?>
                                                DEBIT MACHINE
                                                <?php elseif($ride->payment_mode == "VOUCHER"): ?>
                                                VOUCHER
                                                <?php elseif($ride->payment_mode == "CARD"): ?>
                                                CARD
                                                <?php else: ?>
                                                $ride->payment_mode
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($ride->paid): ?>
                                                Paid
                                                <?php else: ?>
                                                Não Paid
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a class="text-primary"
                                                    href="<?php echo e(route('admin.requests.show',$ride->id)); ?>"><span
                                                        class="underline">See Details</span></a>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <tfoot>
                                        <tr>
                                            <th><?php echo app('translator')->getFromJson('admin.request.Booking_ID'); ?></th>
                                            
                                            <th><?php echo app('translator')->getFromJson('admin.request.picked_up'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('admin.request.dropped'); ?></th>
                                            <?php if(isset($statement_for) && $statement_for !="user"): ?>
                                            <th><?php echo app('translator')->getFromJson('admin.request.commission'); ?></th>
                                            <?php endif; ?>
                                            <?php if(isset($statement_for) && $statement_for !="user"): ?>
                                            <th><?php echo app('translator')->getFromJson('admin.request.earned'); ?></th>
                                            <?php else: ?>
                                            <th><?php echo app('translator')->getFromJson('admin.dashboard.total'); ?></th>
                                            <?php endif; ?>
                                            <th><?php echo app('translator')->getFromJson('admin.request.date'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('admin.request.status'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('admin.request.Payment_Mode'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('admin.request.Payment_Status'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('admin.request.request_details'); ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <?php echo $__env->make('common.pagination', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                <?php else: ?>
                                <h6 class="no-result">There are no records</h6>
                                <?php endif; ?>

                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('scripts'); ?>
    <script type="text/javascript">
        $(".showdate").on('click', function () {
            var ddattr = $(this).attr('id');
            //console.log(ddattr);
            if (ddattr == 'tday') {
                $("#from_date").val('<?php echo e($dates["today"]); ?>');
                $("#to_date").val('<?php echo e($dates["today"]); ?>');
            } else if (ddattr == 'yday') {
                $("#from_date").val('<?php echo e($dates["yesterday"]); ?>');
                $("#to_date").val('<?php echo e($dates["yesterday"]); ?>');
            } else if (ddattr == 'cweek') {
                $("#from_date").val('<?php echo e($dates["cur_week_start"]); ?>');
                $("#to_date").val('<?php echo e($dates["cur_week_end"]); ?>');
            } else if (ddattr == 'pweek') {
                $("#from_date").val('<?php echo e($dates["pre_week_start"]); ?>');
                $("#to_date").val('<?php echo e($dates["pre_week_end"]); ?>');
            } else if (ddattr == 'cmonth') {
                $("#from_date").val('<?php echo e($dates["cur_month_start"]); ?>');
                $("#to_date").val('<?php echo e($dates["cur_month_end"]); ?>');
            } else if (ddattr == 'pmonth') {
                $("#from_date").val('<?php echo e($dates["pre_month_start"]); ?>');
                $("#to_date").val('<?php echo e($dates["pre_month_end"]); ?>');
            } else if (ddattr == 'pyear') {
                $("#from_date").val('<?php echo e($dates["pre_year_start"]); ?>');
                $("#to_date").val('<?php echo e($dates["pre_year_end"]); ?>');
            } else if (ddattr == 'cyear') {
                $("#from_date").val('<?php echo e($dates["cur_year_start"]); ?>');
                $("#to_date").val('<?php echo e($dates["cur_year_end"]); ?>');
            } else {
                alert('invalid dates');
            }
        });
    </script>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>