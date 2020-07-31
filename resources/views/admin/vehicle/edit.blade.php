@extends('admin.layout.base')
@section('title', 'Update Vehicle')
@section('styles')
<link rel="stylesheet" href="{{asset('asset/css/intlTelInput.css')}}">
@endsection
@section('content')
<div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title pull-left">Update Vehicle</h4>
                <a href="{{ URL::previous() }}" class="btn pull-right"><i
                        class="fa fa-angle-left"></i> @lang('admin.back')</a>
            </div>
            <div class="card-body">

                <form action="{{route('admin.vehicles.update', $vehicle->id )}}" method="POST" enctype="multipart/form-data" role="form">
                    {{csrf_field()}}
         <input type="hidden" name="_method" value="PATCH">
      
                    <div class="form-group">
                        <label for="make" class="bmd-label-floating">Make</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ $vehicle->make }}" name="make" required id="make">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="model" class="bmd-label-floating">Model</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ $vehicle->model }}" name="model" required id="model">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="color" class="bmd-label-floating">Color</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ $vehicle->color }}" name="color" required id="color">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="registrationNumber" class="bmd-label-floating">Registration Number</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ $vehicle->registrationNumber }}" name="registrationNumber" required id="registrationNumber">
                        </div>
                    </div>
          <div class="form-group">
                        <label for="registration_expire" class="bmd-label-floating">Registration Expire</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="date" value="{{ $vehicle->registration_expire }}" name="registration_expire" required id="registration_expire">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="PHCLicenceNumber" class="bmd-label-floating">PHC Licence Number</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ $vehicle->PHCLicenceNumber }}" name="PHCLicenceNumber" required id="PHCLicenceNumber">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="PHCLicenceNumberExpire" class="bmd-label-floating">PHC Licence Number Expire</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="date" value="{{ $vehicle->PHCLicenceNumberExpire }}" name="PHCLicenceNumberExpire" required id="PHCLicenceNumberExpire">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="seatType" class="bmd-label-floating">Type</label>
                        <div class="col-xs-10">
                            <select id="seatType" name="seatType" class="form-control" required>
                                <option value="" selected disabled>Select</option>
                                @foreach(get_seattype() as $key => $value)
                                <option value="{{$value->id}}" {{($vehicle->seatType==$value->id) ? 'selected' : ''}}> {{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                 
              
                    
                    <div class="form-group">
                        <label for="zipcode" class="bmd-label-floating"></label>
                        <div class="col-xs-10">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{route('admin.vehicles.index')}}" class="btn btn-default">@lang('admin.cancel')</a>
                        </div>
                    </div>
                </form>
           
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
