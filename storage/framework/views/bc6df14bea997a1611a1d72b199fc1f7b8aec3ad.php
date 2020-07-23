<?php $__env->startSection('title', 'Add Luggage Combination'); ?>
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('asset/css/intlTelInput.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title pull-left">Add Luggage Combination</h4>
                <a href="<?php echo e(URL::previous()); ?>" class="btn pull-right"><i
                        class="fa fa-angle-left"></i> <?php echo app('translator')->getFromJson('admin.back'); ?></a>
            </div>
            <div class="card-body">
                <span id="result"></span>
                <div class="table-responsive">
                     <form class="form-horizontal" action="<?php echo e(route('admin.luggage.store')); ?>" method="POST" enctype="multipart/form-data" role="form" id="dynamic_form">
                <?php echo e(csrf_field()); ?>

          
                        
                        <div class="form-group">
                            <label for="seatType" class="bmd-label-floating">Seater</label>
                            <div class="col-xs-10">
                                <select id="seatType" name="seattype" class="form-control" required>
                                    <option value="" selected disabled>Select</option>
                                    <?php $__currentLoopData = get_seattype(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>"> <?php echo e($value->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <table class="table table-bordered " id="user_table">
                            <thead>
                                <tr>
                                    <th width="35%">NumberPassengers</th>
                                    <th width="35%">Large Luggages</th>
                                    <th width="35%">Small Luggages</th>
                                    <th width="30%">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                           
                        </table>
                        <div class="form-group">
                            <label for="zipcode" class="bmd-label-floating"></label>
                            <div class="col-xs-10">
                                <button id="save" type="submit" class="btn btn-primary">Save</button>
                                <a href="<?php echo e(route('admin.luggage.index')); ?>" class="btn btn-default"><?php echo app('translator')->getFromJson('admin.cancel'); ?></a>
                            </div>
                        </div>
                    </form>
                </div>
              
            </div>
        </div>
    </div>

    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('scripts'); ?>
    <script type="text/javascript" src="<?php echo e(asset('asset/js/intlTelInput.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('asset/js/intlTelInput-jquery.min.js')); ?>"></script>

    <script>
$(document).ready(function () {

    var count = 1;

    dynamic_field(count);

    function dynamic_field(number)
    {
        html = '<tr>';
        html += '<td><input type="text" name="NumberPassengers[]" class="form-control" required/></td>';
        html += '<td><input type="text" name="LargeLuggages[]" class="form-control" required/></td>';
        html += '<td><input type="text" name="SmallLuggages[]" class="form-control" required/></td>';
        if (number > 1)
        {
            html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
            $('tbody').append(html);
        } else
        {
            html += '<td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
            $('tbody').html(html);
        }
    }

    $(document).on('click', '#add', function () {
        count++;
        dynamic_field(count);
    });

    $(document).on('click', '.remove', function () {
        count--;
        $(this).closest("tr").remove();
    });

    $('#dynamic_form').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            url: '<?php echo e(route("admin.luggage.store")); ?>',
            method: 'post',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function () {
                $('#save').attr('disabled', 'disabled');
            },
            success: function (data)
            {
                if (data.error)
                {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++)
                    {
                        error_html += '<p>' + data.error[count] + '</p>';
                    }
                    $('#result').html('<div class="alert alert-danger">' + error_html + '</div>');
                } else
                {
                    dynamic_field(1);
                    $('#result').html('<div class="alert alert-success">' + data.success + '</div>');
                }
                $('#save').attr('disabled', false);
            }
        })
    });

});
    </script>
    <?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>