<?php $__env->startSection('title', 'Adicionar Item Perdido '); ?>

<?php $__env->startSection('content'); ?>
<style>
    .input-group{
        width: none;
    }
    .input-group .fa-search{
        display: table-cell;
    }
</style>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title"><?php echo app('translator')->getFromJson('admin.lostitem.add'); ?></h4>
              <a href="<?php echo e(URL::previous()); ?>" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> <?php echo app('translator')->getFromJson('admin.back'); ?></a>
            </div>
            <div class="card-body">

            <form class="form-horizontal" action="<?php echo e(route('admin.lostitem.store')); ?>" method="POST" enctype="multipart/form-data" role="form">
                <?php echo e(csrf_field()); ?>


                <div class="form-group">
                    <label for="user" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.lostitem.lost_user'); ?></label>

                    <div class="col-xs-5">
                        <div class="input-group">
                            <input class="form-control" type="text" value="<?php echo e(old('name')); ?>" name="name" required id="namesearch" placehold="Search Nome" required="" aria-describedby="basic-addon2" autocomplete="off">
                            <span class="input-group-addon fa fa-search"  id="basic-addon2"></span>
                        </div>
                        <input type="hidden" name="user_id" id="user_id" value="">
                    </div>
                </div>				

                <div class="form-group">
                    <label for="lost_item_name" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.lostitem.request'); ?></label>
                    <div class="col-xs-5">
                        <table class="table table-striped table-bordered dataTable requestList">
                            <thead>
                                <tr>
                                    <th>ID Viagem</th>
                                    <th>De</th>
                                    <th>Para</th>                           
                                    <th>Selecionar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td colspan="4">Sem resultados</td></tr>
                            </tbody>

                        </table>
                    </div>
                </div>

                <div class="form-group">
                    <label for="lost_item_name" class="bmd-label-floating"><?php echo app('translator')->getFromJson('admin.lostitem.lost_item'); ?></label>
                    <div class="col-xs-5">
                        <textarea class="form-control" name="lost_item_name" required id="lost_item_name" placehold="<?php echo app('translator')->getFromJson('admin.lostitem.lost_item'); ?>"><?php echo e(old('lost_item')); ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="bmd-label-floating"></label>
                    <div class="col-xs-5">
                        <input type="hidden" name="is_admin" value="1" />
                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->getFromJson('admin.lostitem.add'); ?></button>
                        <a href="<?php echo e(route('admin.lostitem.index')); ?>" class="btn btn-default"><?php echo app('translator')->getFromJson('admin.cancel'); ?></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<link href="<?php echo e(asset('asset/css/jquery-ui.css')); ?>" rel="stylesheet"> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script type="text/javascript" src="<?php echo e(asset('asset/js/jquery-ui.js')); ?>"></script>

<script type="text/javascript">
var sflag = '';
$('#namesearch').autocomplete({
    source: function (request, response) {
        $.ajax
            ({
                type: "GET",
                url: '<?php echo e(route("admin.usersearch")); ?>',
                data: {stext: request.term},
                dataType: "json",
                success: function (responsedata, status, xhr)
                {
                    if (!responsedata.data.length) {
                        var data = [];
                        data.push({
                            id: 0,
                            label: "<?php echo app('translator')->getFromJson('No Records'); ?>"
                        });
                        response(data);
                    } else {
                        response($.map(responsedata.data, function (item) {
                            var name_alias = item.first_name + " - " + item.id;
                            $('#user_id').val(item.id);
                            return {
                                value: name_alias,
                                id: item.id,
                                bal: item.wallet_balance
                            }
                        }));
                    }
                }
            });
    },
    minLength: 2,
    change: function (event, ui)
    {
        if (ui.item == null) {
            $("#namesearch").val('');
            $("#namesearch").focus();
            $("#wallet_balance").text("-");
        } else {
            if (ui.item.id == 0) {
                $("#namesearch").val('');
                $("#namesearch").focus();
                $("#wallet_balance").text("-");
            }
        }
    },
    select: function (event, ui) {

        $.ajax({
            url: "<?php echo e(route('admin.ridesearch')); ?>",
            type: 'post',
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                id: ui.item.id
            },
            success: function (data, textStatus, jqXHR) {
                var requestList = $('.requestList tbody');
                requestList.html(`<tr><td colspan="4"><?php echo app('translator')->getFromJson('No Records'); ?></td></tr>`);
                if (data.data.length > 0) {
                    var result = data.data;
                    for (var i in result) {
                        requestList.html(`<tr><td>` + result[i].booking_id + `</td><td>` + result[i].s_address + `</td><td>` + result[i].d_address + `</td><td><input name="request_id" value="` + result[i].id + `" type="radio" /></td></tr>`);
                    }
                } else {
                    requestList.html(`<tr><td colspan="4">No Results</td></tr>`);
                }
            }
        });

        $("#from_id").val(ui.item.id);
        $("#wallet_balance").text(ui.item.bal);
    }
});

</script>    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>