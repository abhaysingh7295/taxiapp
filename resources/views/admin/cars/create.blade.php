@extends('admin.layout.base')

@section('title', 'Add Car')
@section('styles')
<link rel="stylesheet" href="{{asset('asset/css/intlTelInput.css')}}">
@endsection

@section('content')

<div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title pull-left">Add  Car</h4>
                <a href="{{ URL::previous() }}" class="btn pull-right"><i
                        class="fa fa-angle-left"></i> @lang('admin.back')</a>
            </div>
            <div class="card-body">

                <form action="{{route('admin.cars.store')}}" method="POST" enctype="multipart/form-data" role="form">
                    {{csrf_field()}}

                    <div class="form-group">
                        <label for="VehiclesTitle" class="bmd-label-floating">Title</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ old('VehiclesTitle') }}" name="VehiclesTitle" required id="VehiclesTitle">
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
                            <input class="form-control" type="text" value="{{ old('PricePerDay') }}" name="PricePerDay" required id="PricePerDay">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="SeatingCapacity" class="bmd-label-floating">Seating Capacity</label>
                        <div class="col-xs-10">
                            <input class="form-control" min="1" type="number" value="{{ old('SeatingCapacity') }}" name="SeatingCapacity" required id="SeatingCapacity">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ModelYear" class="bmd-label-floating">Model Year</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ old('ModelYear') }}" name="ModelYear" required id="ModelYear">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="VehiclesOverview" class="bmd-label-floating">Car OverView</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ old('VehiclesOverview') }}" name="VehiclesOverview" required id="VehiclesOverview">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="bmd-label-floating">Car Type</label>
                        <div class="col-xs-10">
                            <select id="VehiclesType" name="VehiclesType" class="form-control" required>
                                <option value="" selected disabled>Select</option>
                                @foreach(get_cartype() as $key => $cartype)
                                <option value="{{$cartype->id}}"> {{$cartype->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="bmd-label-floating">Company</label>
                        <div class="col-xs-10">
                            <select id="company_id" name="company_id" class="form-control" required>
                                <option value="" selected disabled>Select</option>
                                @foreach(get_company() as $key => $company)
                                <option value="{{$company->id}}"> {{$company->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                      <div class="form-group">
                        <label for="mobile" class="bmd-label-floating">ACCESSORIES</label>

                        <div class="form-group">
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id="AirConditioner" name="AirConditioner" value="1">
                                    <label for="AirConditioner"> Air Conditioner </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id="PowerDoorLocks" name="PowerDoorLocks" value="1" >
                                    <label for="powerdoorlocks"> Power Door Locks </label>
                                </div></div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id="AntiLockBrakingSystem" name="AntiLockBrakingSystem" value="1">
                                    <label for="antilockbrakingsys"> AntiLock Braking System </label>
                                </div></div>
                            <div class="col-sm-3">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="BrakeAssist" name="BrakeAssist" value="1" >
                                <label for="brakeassist"> Brake Assist </label>
                            </div>
                        </div>

                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                 
                                    <input type="checkbox" id="PowerSteering" name="PowerSteering" value="1">
                                    <label for="inlineCheckbox5"> Power Steering </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id="DriverAirbag" name="DriverAirbag" value="1">
                                    <label for="driverairbag">Driver Airbag</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id="PassengerAirbag" name="PassengerAirbag" value="1" >
                                    <label for="passengerairbag"> Passenger Airbag </label>
                                </div>
                            </div>
                          <div class="col-sm-3">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="PowerWindows" name="PowerWindows" value="1" >
                                <label for="powerwindow"> Power Windows </label>
                            </div>
                         </div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id="CDPlayer" name="CDPlayer" value="1" >
                                    <label for="cdplayer"> CD Player </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox h checkbox-inline">
                                    <input type="checkbox" id="CentralLocking" name="CentralLocking" value="1" >
                                    <label for="centrallocking">Central Locking</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id="CrashSensor" name="CrashSensor" value="1" >
                                    <label for="crashcensor"> Crash Sensor </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id="leatherseats" name="LeatherSeats" value="1" >
                                    <label for="leatherseats"> Leather Seats </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="zipcode" class="bmd-label-floating"></label>
                            <div class="col-xs-10">
                                <button type="submit" class="btn btn-primary">Add</button>
                                <a href="{{route('admin.cartype.index')}}" class="btn btn-default">@lang('admin.cancel')</a>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

    @endsection

    @section('scripts')
    <script type="text/javascript" src="{{ asset('asset/js/intlTelInput.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/js/intlTelInput-jquery.min.js') }}"></script>
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
                    url: "{{url('/admin/get-city-list')}}?country_id=" + countryID,
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
    @endsection
