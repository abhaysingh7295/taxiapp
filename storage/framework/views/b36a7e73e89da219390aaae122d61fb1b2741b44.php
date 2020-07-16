<?php $__env->startSection('title','Drivers'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="card">
        <div class="card-header card-header-primary">
            <h5 class="card-title">
                <?php echo app('translator')->getFromJson('admin.provides.providers'); ?>
            </h5>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('provider-create')): ?>
                    <a href="<?php echo e(route('admin.provider.create')); ?>" class="btn pull-right"><i class="fa fa-plus"></i><?php echo app('translator')->getFromJson('admin.provides.add_new_provider'); ?></a>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('admin.provider.index')); ?>" method="get">
                <div class="row">
                    <div class="col-xs-4">
                        <input name="name" type="text" class="form-control" aria-describedby="basic-addon2">
                    </div>

                    <div class="col-xs-5">
                        <label class="radio-inline">
                            <input type="radio" name="status" value="A" class="radio"
                                <?php echo e(request()->has('status')&&request()->get('status')=="A"?" checked":""); ?>> Regularized
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="P" class="radio"
                                <?php echo e(request()->has('status')&&request()->get('status')=="P"?" checked":""); ?>> Pending
                            Docs
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="status" value="F" class="radio"
                                <?php echo e(request()->has('status')&&request()->get('status')=="F"?" checked":""); ?>> Missing
                            Docs
                        </label>
                    </div>

                    <div class="col-xs-3">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>


            <div class="table-responsive">
                <table class="table ">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('admin.id'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.provides.full_name'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.email'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.mobile'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.users.Wallet_Amount'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.provides.total_requests'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.provides.accepted_requests'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.provides.created_at'); ?></th>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('provider-documents')): ?>
                            <th><?php echo app('translator')->getFromJson('admin.provides.service_type'); ?></th>
                            <?php endif; ?>
                            <th><?php echo app('translator')->getFromJson('admin.provides.online'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php ($page = ($pagination->currentPage-1)*$pagination->perPage); ?>
                        <?php $__currentLoopData = $providers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $provider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php ($page++); ?>
                        <tr>
                            <td><?php echo e($page); ?></td>
                            <td><?php echo e($provider->first_name); ?> <?php echo e($provider->last_name); ?></td>
                            <?php if(Setting::get('demo_mode', 0) == 1): ?>
                            <td><?php echo e(substr($provider->email, 0, 3).'****'.substr($provider->email, strpos($provider->email, "@"))); ?>

                            </td>
                            <?php else: ?>
                            <td><?php echo e($provider->email); ?></td>
                            <?php endif; ?>
                            <?php if(Setting::get('demo_mode', 0) == 1): ?>
                            <td>+91XXXXXXXXXX</td>
                            <?php else: ?>
                            <td><?php echo e($provider->mobile); ?></td>
                            <?php endif; ?>
                            <td>
                                <?php if($provider->wallet_balance < 0): ?> <label style="cursor: default;"
                                    class="btn small btn-block btn-danger">
                                    <?php echo e(currency($provider->wallet_balance)); ?></label>
                                    <?php elseif($provider->wallet_balance == 0): ?>
                                    <label style="cursor: default;"
                                        class="btn small btn-block btn-warning"><?php echo e(currency($provider->wallet_balance)); ?></label>
                                    <?php else: ?>
                                    <label style="cursor: default;"
                                        class="btn small btn-block btn-success"><?php echo e(currency($provider->wallet_balance)); ?></label>
                                    <?php endif; ?>
                            </td>
                            <td><?php echo e($provider->total_requests()); ?></td>
                            <td><?php echo e($provider->accepted_requests()); ?></td>
                            <td><?php echo e($provider->created_at->format('d/m/Y H:i:s')); ?></td>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('provider-documents')): ?>
                            <td>
                                <?php if($provider->active_documents() == $total_documents && $provider->service != null): ?>
                                <a class="btn btn-success btn-block"
                                    href="<?php echo e(route('admin.provider.document.index', $provider->id )); ?>">Verified</a>
                                <?php else: ?>
                                <a class="btn btn-danger btn-block label-right"
                                    href="<?php echo e(route('admin.provider.document.index', $provider->id )); ?>">Attention! <span
                                        class="btn-label"><?php echo e($provider->pending_documents()); ?></span></a>
                                <?php endif; ?>
                            </td>
                            <?php endif; ?>
                            <td>
                                <?php if($provider->service): ?>
                                <?php if($provider->service->status == 'active'): ?>
                                <label class="btn btn-block btn-primary">YES</label>
                                <?php else: ?>
                                <label class="btn btn-block btn-warning">NO</label>
                                <?php endif; ?>
                                <?php else: ?>
                                <label class="btn btn-block btn-danger">N/A</label>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="input-group-btn">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('provider-status')): ?>
                                    <?php if($provider->status == 'approved'): ?>
                                    <a class="btn btn-danger btn-block"
                                        href="<?php echo e(route('admin.provider.disapprove', $provider->id )); ?>"><?php echo app('translator')->getFromJson('Disable'); ?></a>
                                    <?php else: ?>
                                    <a class="btn btn-success btn-block"
                                        href="<?php echo e(route('admin.provider.approve', $provider->id )); ?>"><?php echo app('translator')->getFromJson('Enable'); ?></a>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if($user->hasAnyPermission(['provider-history', 'provider-statements',
                                    'provider-edit','provider-delete'])): ?>
                                    <button type="button" class="btn btn-info btn-block dropdown-toggle"
                                        data-toggle="dropdown"><?php echo app('translator')->getFromJson('admin.action'); ?>
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('provider-history')): ?>
                                        <li>
                                            <a href="<?php echo e(route('admin.provider.request', $provider->id)); ?>"
                                                class="btn btn-default"><i class="fa fa-search"></i>
                                                <?php echo app('translator')->getFromJson('admin.History'); ?></a>
                                        </li>
                                        <?php endif; ?>
                                        <li>
                                            <a href="<?php echo e(route('admin.provider.password', $provider->id)); ?>"
                                                class="btn btn-default"><i class="fa fa-user-secret"></i>
                                                <?php echo app('translator')->getFromJson('admin.provides.password'); ?></a>
                                        </li>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('provider-statements')): ?>
                                        <li>
                                            <a href="<?php echo e(route('admin.provider.statement', $provider->id)); ?>"
                                                class="btn btn-default"><i class="fa fa-account"></i>
                                                <?php echo app('translator')->getFromJson('admin.Statements'); ?></a>
                                        </li>
                                        <?php endif; ?>
                                        <?php if( Setting::get('demo_mode', 0) == 0): ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('provider-edit')): ?>
                                        <li>
                                            <a href="<?php echo e(route('admin.provider.edit', $provider->id)); ?>"
                                                class="btn btn-default"><i class="fa fa-pencil"></i>
                                                <?php echo app('translator')->getFromJson('admin.edit'); ?></a>
                                        </li>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('provider-delete')): ?>
                                        <li>
                                            <form action="<?php echo e(route('admin.provider.destroy', $provider->id)); ?>"
                                                method="POST">
                                                <?php echo e(csrf_field()); ?>

                                                <input type="hidden" name="_method" value="DELETE">
                                                <?php if( Setting::get('demo_mode', 0) == 0): ?>
                                                <button class="btn btn-default look-a-like"
                                                    onclick="return confirm('Are you sure?')"><i
                                                        class="fa fa-trash"></i><?php echo app('translator')->getFromJson('admin.delete'); ?></button>
                                                <?php endif; ?>
                                            </form>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('admin.id'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.provides.full_name'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.email'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.mobile'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.users.Wallet_Amount'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.provides.total_requests'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.provides.accepted_requests'); ?></th>
                            <th><?php echo app('translator')->getFromJson('admin.provides.created_at'); ?></th>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('provider-documents')): ?>
                            <th><?php echo app('translator')->getFromJson('admin.provides.service_type'); ?></th>
                            <?php endif; ?>
                            <th><?php echo app('translator')->getFromJson('admin.provides.online'); ?></th>
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
                url: "<?php echo e(url('admin/provider')); ?>?page=all}}",
                data: {},
                success: function (result) {
                    p = new Array();
                    $.each(result.data, function (i, d) {
                        var item = [d.id, d.first_name + ' ' + d.last_name, d.email, d
                            .mobile, d.rating, d.wallet_balance
                        ];
                        p.push(item);
                    });
                },
                async: false
            });
            var head = new Array();
            head.push("ID", "Nome", "Email", "Mobile", "Rating", "Wallet");
            return {
                body: p,
                header: head
            };
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