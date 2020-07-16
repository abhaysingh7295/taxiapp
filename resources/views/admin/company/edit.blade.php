@extends('admin.layout.base')
@section('title', 'Update Company')
@section('styles')
<link rel="stylesheet" href="{{asset('asset/css/intlTelInput.css')}}">
@endsection
@section('content')
<div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title pull-left">Update Company</h4>
                <a href="{{ URL::previous() }}" class="btn pull-right"><i
                        class="fa fa-angle-left"></i> @lang('admin.back')</a>
            </div>
            <div class="card-body">

                <form action="{{route('admin.company.update', $company->id )}}" method="POST" enctype="multipart/form-data" role="form">
                    {{csrf_field()}}
         <input type="hidden" name="_method" value="PATCH">
         <div class="form-group">
                        <label for="name" class="bmd-label-floating">Name</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ $company->name}}" name="name" required id="name">
                        </div>
                    </div>
                    
                      <div class="form-group">
                        <label for="address" class="bmd-label-floating">Address</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ $company->address }}" name="address" required id="address">
                        </div>
                    </div>
                       <div class="form-group">
                        <label for="phone" class="bmd-label-floating">Phone</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="number" min="1" maxlength="10" value="{{ $company->phone }}" name="phone" required id="phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="bmd-label-floating">Country</label>
                        <div class="col-xs-10">
                            <select id="country" name="country" class="form-control" required>
                                <option value="" selected disabled>Select</option>
                                @foreach($countries as $key => $country)
                                <option value="{{$key}}" {{( $key == $company->country) ? 'selected' : '' }}> {{$country}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="bmd-label-floating">City</label>
                        <div class="col-xs-10">
                             <select id="city" name="city" class="form-control" required>
                                <option value="" selected disabled>Select</option>
                           @foreach(get_all_city($company->country) as $type)
                        <option value="{{$type->id}}" {{ ( $type->id == $company->city) ? 'selected' : '' }}>{{$type->name}}</option>
                    @endforeach
                    </select>
                        </div>
                    </div>
         
                    <div class="form-group">
                        <label for="zipcode" class="bmd-label-floating"></label>
                        <div class="col-xs-10">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{route('admin.company.index')}}" class="btn btn-default">@lang('admin.cancel')</a>
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
