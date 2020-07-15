<?php $__env->startSection('title', 'Rider '); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title "><?php echo app('translator')->getFromJson('admin.users.Users'); ?></h4>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('admin.user.index')); ?>" method="get">
                <div class="form-group col-md-12" style="padding-left:0 !important; padding-right:0 !important; margin-bottom: 20px;">
                    <div class="col-xs-6">
                        <input name="name" type="text" class="form-control" placehold="User Name or Email" aria-label="Passenger name" aria-describedby="basic-addon2">
                    </div>

                    <div class="col-xs-3">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-create')): ?>
                    <div class="col-xs-3">
                        <a href="<?php echo e(route('admin.user.create')); ?>" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>Add New</a>

                    </div>
                    <?php endif; ?>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('admin.id'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.first_name'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.last_name'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.gender'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.email'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.mobile'); ?></th>

<!--                        <th><?php echo app('translator')->getFromJson('admin.users.Rating'); ?></th>
<th><?php echo app('translator')->getFromJson('admin.users.Wallet_Amount'); ?></th>-->
                            <th><?php echo app('translator')->getFromJson('admin.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php ($page = ($pagination->currentPage-1)*$pagination->perPage); ?>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php ($page++); ?>
                        <tr>
                            <td><?php echo e($page); ?></td>
                            <td><?php echo e($user->first_name); ?></td>
                            <td><?php echo e($user->last_name); ?></td>
                            <td><?php echo e($user->gender); ?></td>
                            <?php if(Setting::get('demo_mode', 0) == 1): ?>
                            <td><?php echo e(substr($user->email, 0, 3).'****'.substr($user->email, strpos($user->email, "@"))); ?></td>
                            <?php else: ?>
                            <td><?php echo e($user->email); ?></td>
                            <?php endif; ?>
                            <?php if(Setting::get('demo_mode', 0) == 1): ?>
                            <td>+919876543210</td>
                            <?php else: ?>
                            <td><?php echo e($user->mobile); ?></td>

                            <?php endif; ?>
    <!--                        <td><?php echo e($user->rating); ?></td>
                            <td><?php echo e(currency($user->wallet_balance)); ?></td>-->
                            <td>
                                <form action="<?php echo e(route('admin.user.destroy', $user->id)); ?>" method="POST">
                                    <?php echo e(csrf_field()); ?>

                                    <input type="hidden" name="_method" value="DELETE">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-history')): ?>
    <!--                                <a href="<?php echo e(route('admin.user.request', $user->id)); ?>" class="btn btn-info"><i class="fa fa-search"></i> <?php echo app('translator')->getFromJson('admin.History'); ?></a>-->
                                    <?php endif; ?>
                                    <?php if( Setting::get('demo_mode', 0) == 0): ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-create')): ?>
                                    <a href="<?php echo e(route('admin.user.edit', $user->id)); ?>" class="btn btn-info"><i class="fa fa-pencil"></i> <?php echo app('translator')->getFromJson('admin.edit'); ?></a>
                                    <?php endif; ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-delete')): ?>
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> <?php echo app('translator')->getFromJson('admin.delete'); ?></button>
                                      <?php if($user->status == 'banned'): ?>
                                    <a class="btn btn-danger"
                                       href="<?php echo e(route('admin.user.approve', $user->id )); ?>"><?php echo app('translator')->getFromJson('Disable'); ?></a>
                                    <?php endif; ?>
                                     <?php if($user->status == 'approved'): ?>
                                    <a class="btn btn-success"
                                       href="<?php echo e(route('admin.user.disapprove', $user->id )); ?>"><?php echo app('translator')->getFromJson('Enable'); ?></a>
                                      <?php endif; ?>
                                    <?php endif; ?>

                                    <?php endif; ?>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('admin.id'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.first_name'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.last_name'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.gender'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.email'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.mobile'); ?></th>

<!--                        <th><?php echo app('translator')->getFromJson('admin.users.Rating'); ?></th>
 <th><?php echo app('translator')->getFromJson('admin.users.Wallet_Amount'); ?></th>-->
                            <th><?php echo app('translator')->getFromJson('admin.action'); ?></th>
                        </tr>
                    </tfoot>
                </table>
                <?php echo $__env->make('common.pagination', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
    jQuery.fn.DataTable.Api.register('buttons.exportData()', function (options) {
        if (this.context.length) {
            var jsonResult = $.ajax({
                url: "<?php echo e(url('admin/user')); ?>?page=all",
                data: {},
                success: function (result) {
                    p = new Array();
                    $.each(result.data, function (i, d)
                    {
                        var item = [d.id, d.first_name, d.last_name, d.gender, d.email, d.mobile];
                        p.push(item);
                    });
                },
                async: false
            });
            var head = new Array();
            head.push("ID", "First Name", "Last Name", "Gender", "Email", "Mobile");
            return {body: p, header: head};
        }
    });

    $('#table-5').DataTable({
        responsive: true,
        paging: false,
        info: false,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>