<?php $__env->startSection('title', 'Add Car'); ?>
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('asset/css/intlTelInput.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title pull-left">Add  Car</h4>
                <a href="<?php echo e(URL::previous()); ?>" class="btn pull-right"><i
                        class="fa fa-angle-left"></i> <?php echo app('translator')->getFromJson('admin.back'); ?></a>
            </div>
            <div class="card-body">

                <form action="<?php echo e(route('admin.cars.store')); ?>" method="POST" enctype="multipart/form-data" role="form">
                    <?php echo e(csrf_field()); ?>


                    <div class="form-group">
                        <label for="VehiclesTitle" class="bmd-label-floating">Title</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="<?php echo e(old('VehiclesTitle')); ?>" name="VehiclesTitle" required id="VehiclesTitle">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="FuelType" class="bmd-label-floating">Fuel Type</label>
                        <div class="col-xs-10">
                            <select class="form-control" name="FuelType" required>
                                <option value=""> Select </option>
                                <option value="Petrol">Petrol</option>
                                <option value="Diesel">Diesel</option>
                                <option value="CNG">CNG</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="PricePerDay" class="bmd-label-floating">Price Par Day</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="<?php echo e(old('PricePerDay')); ?>" name="PricePerDay" required id="PricePerDay">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="SeatingCapacity" class="bmd-label-floating">Seating Capacity</label>
                        <div class="col-xs-10">
                            <input class="form-control" min="1" type="number" value="<?php echo e(old('SeatingCapacity')); ?>" name="SeatingCapacity" required id="SeatingCapacity">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ModelYear" class="bmd-label-floating">Model Year</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="<?php echo e(old('ModelYear')); ?>" name="ModelYear" required id="ModelYear">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="VehiclesOverview" class="bmd-label-floating">Car OverView</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="<?php echo e(old('VehiclesOverview')); ?>" name="VehiclesOverview" required id="VehiclesOverview">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="bmd-label-floating">Car Type</label>
                        <div class="col-xs-10">
                            <select id="VehiclesType" name="VehiclesType" class="form-control" required>
                                <option value="" selected disabled>Select</option>
                                <?php $__currentLoopData = get_cartype(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cartype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cartype->id); ?>"> <?php echo e($cartype->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="bmd-label-floating">Company</label>
                        <div class="col-xs-10">
                            <select id="company_id" name="company_id" class="form-control" required>
                                <option value="" selected disabled>Select</option>
                                <?php $__currentLoopData = get_company(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($company->id); ?>"> <?php echo e($company->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="bmd-label-floating">ACCESSORIES</label>

                        <div class="form-group">
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id="airconditioner" name="airconditioner" value="1">
                                    <label for="airconditioner"> Air Conditioner </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id="powerdoorlocks" name="powerdoorlocks" value="1">
                                    <label for="powerdoorlocks"> Power Door Locks </label>
                                </div></div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id="antilockbrakingsys" name="antilockbrakingsys" value="1">
                                    <label for="antilockbrakingsys"> AntiLock Braking System </label>
                                </div></div>
                            <div class="col-sm-3">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="brakeassist" name="brakeassist" value="1">
                                <label for="brakeassist"> Brake Assist </label>
                            </div>
                        </div>

                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                 
                                    <input type="checkbox" id="powersteering" name="powersteering" value="1">
                                    <label for="inlineCheckbox5"> Power Steering </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id="driverairbag" name="driverairbag" value="1">
                                    <label for="driverairbag">Driver Airbag</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id="passengerairbag" name="passengerairbag" value="1">
                                    <label for="passengerairbag"> Passenger Airbag </label>
                                </div>
                            </div>
                          <div class="col-sm-3">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="powerwindow" name="powerwindow" value="1">
                                <label for="powerwindow"> Power Windows </label>
                            </div>
                         </div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id="cdplayer" name="cdplayer" value="1">
                                    <label for="cdplayer"> CD Player </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox h checkbox-inline">
                                    <input type="checkbox" id="centrallocking" name="centrallocking" value="1">
                                    <label for="centrallocking">Central Locking</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id="crashcensor" name="crashcensor" value="1">
                                    <label for="crashcensor"> Crash Sensor </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id="leatherseats" name="leatherseats" value="1">
                                    <label for="leatherseats"> Leather Seats </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="zipcode" class="bmd-label-floating"></label>
                            <div class="col-xs-10">
                                <button type="submit" class="btn btn-primary">Add</button>
                                <a href="<?php echo e(route('admin.cartype.index')); ?>" class="btn btn-default"><?php echo app('translator')->getFromJson('admin.cancel'); ?></a>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('scripts'); ?>
    <script type="text/javascript" src="<?php echo e(asset('asset/js/intlTelInput.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('asset/js/intlTelInput-jquery.min.js')); ?>"></script>
    <script type="text/javascript">
//For mobile number with date
var input = document.querySelector("#country_code");
window.intlTelInput(input, ({
// separateDialCode:true,
}));
$(".country-name").click(function () {
    var myVar = $(this).closest('.country').find(".dial-code").text();
    $('#country_code').val(myVar);
});
    </script>
    <script type="text/javascript">
        $('#country').change(function () {
            var countryID = $(this).val();
            if (countryID) {
                $.ajax({
                    type: "GET",
                    url: "<?php echo e(url('/admin/get-city-list')); ?>?country_id=" + countryID,
                    success: function (res) {
                        if (res) {
                            $("#city").empty();
                            $("#city").append('<option>Select City</option>');
                            $.each(res, function (key, value) {
                                $("#city").append('<option value="' + key + '">' + value + '</option>');
                            });

                        } else {
                            $("#city").empty();
                        }
                    }
                });
            } else {

                $("#city").empty();
            }
        });

    </script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>