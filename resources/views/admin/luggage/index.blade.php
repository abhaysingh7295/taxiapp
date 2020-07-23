@extends('admin.layout.base')

@section('title', 'Add Combinantion Luggage')
@section('styles')
<link rel="stylesheet" href="{{asset('asset/css/intlTelInput.css')}}">
@endsection

@section('content')

<div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title pull-left">Add Combinantion Luggage</h4>
                <a href="{{ URL::previous() }}" class="btn pull-right"><i
                        class="fa fa-angle-left"></i> @lang('admin.back')</a>
            </div>
            <div class="card-body">

                <form action="{{route('admin.city.store')}}" method="POST" enctype="multipart/form-data" role="form">
                    {{csrf_field()}}
                  
                    <div class="col-md-3">
                     <div class="form-group">
                        <label for="seatType" class="bmd-label-floating">Type</label>
                        <div class="col-xs-10">
                            <select id="seatType" name="seatType" class="form-control" required>
                                <option value="" selected disabled>Select</option>
                                @foreach(get_seattype() as $key => $value)
                                <option value="{{$value->id}}"> {{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                        </div>
                      <div class="row">
                                                 <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="service_number" class="bmd-label-floating">Number of Passengers</label>
                                                        <input class="form-control" type="text" value="" name="service_number" required id="service_number"><input class="form-control" type="text" value="" name="service_number" required id="service_number"><input class="form-control" type="text" value="" name="service_number" required id="service_number">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="service_model" class="bmd-label-floating">Large Luggages</label>
                                                        <input class="form-control" type="text" value="" name="service_model" required id="service_model">
                                                        <input class="form-control" type="text" value="" name="service_model" required id="service_model">
                                                         <input class="form-control" type="text" value="" name="service_model" required id="service_model">
                                                    </div>
                                                </div>
                     <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="service_model" class="bmd-label-floating">Small Luggages</label>
                                                        <input class="form-control" type="text" value="" name="service_model" required id="service_model"> <input class="form-control" type="text" value="" name="service_model" required id="service_model"><input class="form-control" type="text" value="" name="service_model" required id="service_model">
                                                    </div>
                                                </div>
                          <div class="col-md-3">
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Add</button> </br>
                            <button class="btn btn-success" type="submit">Delete</button> </br>
                            <button class="btn btn-success" type="submit">Delete</button> 
                        </div>
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
    $('#country').change(function(){
    var countryID = $(this).val();    
    if(countryID){
        $.ajax({
           type:"GET",
           url:"{{url('/admin/get-city-list')}}?country_id="+countryID,
           success:function(res){               
            if(res){
                $("#city").empty();
                $("#city").append('<option>Select City</option>');
                $.each(res,function(key,value){
                    $("#city").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
                   $("#city").empty();
            }
           }
        });
    }else{
       
        $("#city").empty();
    }      
   });

</script>
    @endsection


