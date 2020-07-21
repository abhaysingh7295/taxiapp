<?php $__env->startSection('title', 'Vehicle'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title ">Vehicle</h4>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('admin.vehicles.index')); ?>" method="get">
                <div class="form-group col-md-12" style="padding-left:0 !important; padding-right:0 !important; margin-bottom: 20px;">

                    <div class="col-xs-6">
                        <input name="name" type="text" class="form-control" placehold="User Name or Email" aria-label="Passenger name" aria-describedby="basic-addon2">
                    </div>

                    <div class="col-xs-3">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-create')): ?>
                    <div class="col-xs-3">
                        <a href="<?php echo e(route('admin.vehicles.create')); ?>" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>Add New</a>

                    </div>
                    <?php endif; ?>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Make</th>
                            <th>Model</th>
                            <th>Color</th>
                            <th>Registration Number</th>
                            <th>Registration Expire</th>
                            <th>PHC Licence Number</th>
                            <th>Checklist</th>
                            <th><?php echo app('translator')->getFromJson('admin.action'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php ($page = ($pagination->currentPage-1)*$pagination->perPage); ?>
                        <?php $__currentLoopData = $vehicle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php ($page++); ?>
                        <tr>
                            <td><?php echo e($page); ?></td>
                            <td><?php echo e($values->make); ?></td>
                            <td><?php echo e($values->model); ?></td>
                            <td><?php echo e($values->color); ?></td>
                            <td><?php echo e($values->registrationNumber); ?></td>
                            <td><?php echo e($values->registration_expire); ?></td>
                            <td><?php echo e($values->PHCLicenceNumber); ?></td>
                             <td>

                                <a class="btn btn-success btn-block"
                                   href="<?php echo e(route('admin.vehicles.vehiclechecklist', $values->id )); ?>">Checklist</a>
                            </td>


                            <td>
                                <form action="<?php echo e(route('admin.vehicles.destroy', $values->id)); ?>" method="POST">
                                    <?php echo e(csrf_field()); ?>

                                    <input type="hidden" name="_method" value="DELETE">

                                    <a href="<?php echo e(route('admin.vehicles.edit', $values->id)); ?>" class="btn btn-info"><i class="fa fa-pencil"></i> <?php echo app('translator')->getFromJson('admin.edit'); ?></a>

                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> <?php echo app('translator')->getFromJson('admin.delete'); ?></button>



                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Make</th>
                            <th>Model</th>
                            <th>Color</th>
                            <th>Registration Number</th>
                            <th>PHC Licence Number</th>
                              <th>Checklist</th>
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
                url: "<?php echo e(url('admin/vehicles')); ?>?page=all",
                data: {},
                success: function (result) {
                    p = new Array();
                    $.each(result.data, function (i, d)
                    {
                        var item = [d.id, d.make,d.model,d.color, d.registrationNumber, d.PHCLicenceNumber];
                        p.push(item);
                    });
                },
                async: false
            });
            var head = new Array();
            head.push("ID", "Make", "Model", "Color", "Registration Number", "PHC Licence Number");
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