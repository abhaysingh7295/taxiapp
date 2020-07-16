@extends('admin.layout.base')
@section('title', 'Update Car')
@section('styles')
<link rel="stylesheet" href="{{asset('asset/css/intlTelInput.css')}}">
@endsection
@section('content')
<div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title pull-left">Update Car</h4>
                <a href="{{ URL::previous() }}" class="btn pull-right"><i
                        class="fa fa-angle-left"></i> @lang('admin.back')</a>
            </div>
            <div class="card-body">

                <form action="{{route('admin.cars.update', $cars->id )}}" method="POST" enctype="multipart/form-data" role="form">
                    {{csrf_field()}}
         <input type="hidden" name="_method" value="PATCH">
           <div class="form-group">
                        <label for="VehiclesTitle" class="bmd-label-floating">Title</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ $cars->VehiclesTitle }}" name="VehiclesTitle" required id="VehiclesTitle">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="FuelType" class="bmd-label-floating">Fuel Type</label>
                        <div class="col-xs-10">
                            <select class="form-control" name="FuelType" required>
                                <option value=""> Select </option>
                                <option value="Petrol" {{($cars->FuelType=='Petrol')?'selected':""}}>Petrol</option>
                                <option value="Diesel" {{($cars->FuelType=='Diesel')?'selected':""}}>Diesel</option>
                                <option value="CNG" {{($cars->FuelType=='CNG')?'selected':""}}>CNG</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="PricePerDay" class="bmd-label-floating">Price Par Day</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ $cars->PricePerDay }}" name="PricePerDay" required id="PricePerDay">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="SeatingCapacity" class="bmd-label-floating">Seating Capacity</label>
                        <div class="col-xs-10">
                            <input class="form-control" min="1" type="number" value="{{ $cars->SeatingCapacity }}" name="SeatingCapacity" required id="SeatingCapacity">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ModelYear" class="bmd-label-floating">Model Year</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ $cars->ModelYear }}" name="ModelYear" required id="ModelYear">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="VehiclesOverview" class="bmd-label-floating">Car OverView</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ $cars->VehiclesOverview }}" name="VehiclesOverview" required id="VehiclesOverview">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="bmd-label-floating">Car Type</label>
                        <div class="col-xs-10">
                            <select id="VehiclesType" name="VehiclesType" class="form-control" required>
                                <option value="" selected disabled>Select</option>
                                @foreach(get_cartype() as $key => $cartype)
                                <option value="{{$cartype->id}}" {{($cars->VehiclesType==$cartype->id) ? 'selected' : ''}}> {{$cartype->name}}</option>
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
                                <option value="{{$company->id}}" {{($cars->company_id==$company->id)?'selected':""}}> {{$company->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="bmd-label-floating">ACCESSORIES</label>

                        <div class="form-group">
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id="AirConditioner" name="AirConditioner" value="1" {{($cars->AirConditioner==1)?'checked="checked"':""}}>
                                    <label for="airconditioner"> Air Conditioner </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id="PowerDoorLocks" name="PowerDoorLocks" value="1" {{($cars->PowerDoorLocks==1)?'checked="checked"':""}}>
                                    <label for="powerdoorlocks"> Power Door Locks </label>
                                </div></div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id="AntiLockBrakingSystem" name="AntiLockBrakingSystem" value="1"{{($cars->AntiLockBrakingSystem==1)?'checked="checked"':""}}>
                                    <label for="antilockbrakingsys"> AntiLock Braking System </label>
                                </div></div>
                            <div class="col-sm-3">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="BrakeAssist" name="BrakeAssist" value="1" {{($cars->BrakeAssist==1)?'checked="checked"':""}}>
                                <label for="brakeassist"> Brake Assist </label>
                            </div>
                        </div>

                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                 
                                    <input type="checkbox" id="PowerSteering" name="PowerSteering" value="1" {{($cars->PowerSteering==1)?'checked="checked"':""}}>
                                    <label for="inlineCheckbox5"> Power Steering </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id="DriverAirbag" name="DriverAirbag" value="1" {{($cars->DriverAirbag==1)?'checked="checked"':""}}>
                                    <label for="driverairbag">Driver Airbag</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id="PassengerAirbag" name="PassengerAirbag" value="1" {{($cars->PassengerAirbag==1)?'checked="checked"':""}}>
                                    <label for="passengerairbag"> Passenger Airbag </label>
                                </div>
                            </div>
                          <div class="col-sm-3">
                            <div class="checkbox checkbox-inline">
                                <input type="checkbox" id="PowerWindows" name="PowerWindows" value="1" {{($cars->PowerWindows==1)?'checked="checked"':""}}>
                                <label for="powerwindow"> Power Windows </label>
                            </div>
                         </div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id="CDPlayer" name="CDPlayer" value="1" {{($cars->CDPlayer==1)?'checked="checked"':""}}>
                                    <label for="cdplayer"> CD Player </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox h checkbox-inline">
                                    <input type="checkbox" id="CentralLocking" name="CentralLocking" value="1" {{($cars->CentralLocking==1)?'checked="checked"':""}}>
                                    <label for="centrallocking">Central Locking</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id="CrashSensor" name="CrashSensor" value="1" {{($cars->CrashSensor==1)?'checked="checked"':""}}>
                                    <label for="crashcensor"> Crash Sensor </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-inline">
                                    <input type="checkbox" id="leatherseats" name="LeatherSeats" value="1" {{($cars->LeatherSeats==1) ? 'checked="checked" ': ""}}>
                                    <label for="leatherseats"> Leather Seats </label>
                                </div>
                            </div>
                        </div>
                    <div class="form-group">
                        <label for="zipcode" class="bmd-label-floating"></label>
                        <div class="col-xs-10">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{route('admin.cars.index')}}" class="btn btn-default">@lang('admin.cancel')</a>
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
    
    @endsection
