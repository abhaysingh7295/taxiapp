<?php $__env->startSection('title', 'Páginas '); ?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
              <h5 class="card-title"><?php echo app('translator')->getFromJson('admin.pages.pages'); ?></h5>
            <?php if(Setting::get('demo_mode', 0) == 1): ?>
            <div class="col-md-12" style="height:50px;color:red;">
                ** Demo Mode : <?php echo app('translator')->getFromJson('admin.demomode'); ?>
            </div>
            <?php endif; ?>
            </div>
            <div class="card-body">
            <div className="row">
                <form id="cmspages" action="<?php echo e(route('admin.pages.update')); ?>" method="POST">
                    <div class="form-group">
                        <select class="form-control" id="types" name="types">
                            <option value="select">select</option>
                            <option value="help">Ajuda</option>
                            <option value="page_privacy">Política de Privacidade</option>
                            <option value="terms">Termos de Uso</option>
                            <option value="cancel">Política de Cancelamento</option>
                        </select>
                    </div>
                    <?php echo e(csrf_field()); ?>                    

                    <div class="row">
                        <div class="col-xs-12">
                            <textarea name="content" class="content" id="myeditor"></textarea>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-xs-12 col-md-3">
                            <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-danger btn-block">Cancelar</a>
                        </div>
                        <div class="col-xs-12 col-md-3 offset-md-6">
                            <button type="submit" class="btn btn-primary btn-block">Atualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script type="text/javascript">
CKEDITOR.replace('myeditor');</script>
<script type="text/javascript">
    <?php if(Setting::get('demo_mode', 0) == 1): ?>
    $("#cmspages :input").prop("disabled", true);
    $("#types").prop("disabled", false);
    <?php endif; ?>

            $(document).ready(function(){
    $("#types").change(function(){
    var types = $("#types").val();
            $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="_toke-n"]').attr('content') }
            });
            $.ajax({url: "<?php echo e(url('admin/pages/search')); ?>/" + types,
                    success: function(data) {
                    // $('#doc_title').val("");
                    //alert(data);
                    CKEDITOR.instances["myeditor"].setData(data)
                            //$('#myeditor').val("data");
                            //document.getElementById("myeditor").value = "blah ... "
                            //$(".content").val(data);
                            //$("#myeditor").hide();
                            //$("#myeditor").hide();
                            // $("#myeditor").append("<textarea id='myeditor'   name='content' >"+data+"</textarea> </br> ");
                    }});
    });
    }
    );
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>