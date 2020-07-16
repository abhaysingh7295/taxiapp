
@extends('admin.layout.base')

@section('title', __('admin.provides.update_provider'))
@section('styles')
<link rel="stylesheet" href="{{asset('asset/css/intlTelInput.css')}}">
@endsection
@section('content')

<div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h5 class="card-title">@lang('admin.provides.update_provider')</h5>
                <a href="{{ URL::previous() }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>
            </div>
            <div class="card-body">

            <form class="form-horizontal" action="{{route('admin.provider.update', $provider->id )}}" method="POST" enctype="multipart/form-data" role="form">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PATCH">

                <div class="form-group">
                    <label for="first_name" class="bmd-label-floating">@lang('admin.first_name')</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ $provider->first_name }}" name="first_name" required id="first_name" placehold="First Name">
                    </div>
                </div>

                <div class="form-group">
                    <label for="last_name" class="bmd-label-floating">@lang('admin.last_name')</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ $provider->last_name }}" name="last_name" required id="last_name" placehold="Last Name">
                    </div>
                </div>

                <div class="input-group row">
                    
                    <label for="picture" class="bmd-label-floating">@lang('admin.picture')</label>
                    <div class="col-xs-10">
                    @if(isset($provider->avatar))
                        <img style="height: 90px; margin-bottom: 15px; border-radius:2em;" src="{{img($provider->avatar)}}">
                    @endif
                        <input type="file" accept="image/*" name="avatar" class="dropify form-control-file" id="picture" aria-describedby="fileHelp">
                    </div>
                </div>

                <div class="form-group">
                    <label for="country_code" class="bmd-label-floating">Código do País</label>
                    <div class="col-xs-10">
                    <input type="text" name="country_code" style ="padding-bottom:5px;" id="country_code" class="country-name"  value="{{ $provider->country_code}}" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="mobile" class="bmd-label-floating">@lang('admin.mobile')</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="number" value="{{ $provider->mobile }}" name="mobile" required id="mobile" placehold="Mobile">
                    </div>
                </div>
                 <div class="form-group">
                    <label for="mobile" class="bmd-label-floating">@lang('admin.driver_address')</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ $provider->address }}" name="address" required id="address" placehold="@lang('admin.driver_address')">
                    </div>
                </div>
                 <div class="form-group">
                    <label for="mobile" class="bmd-label-floating">@lang('admin.driver_LICENSENO')</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ $provider->licenseno }}" name="licenseNo" required id="licenseNo" placehold="@lang('admin.driver_LICENSENO')">
                    </div>
                </div>
                 <div class="form-group">
                    <label for="mobile" class="bmd-label-floating">@lang('admin.driver_carno')</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ $provider_service->service_number}}" name="service_number" required id="service_number" placehold="@lang('admin.driver_carno')">
                    </div>
                </div>
                 <div class="form-group">
                    <label for="mobile" class="bmd-label-floating">@lang('admin.driver_carmodel')</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{$provider_service->service_model}}" name="service_model" required id="service_model" placehold="@lang('admin.driver_carmodel')">
                    </div>
                </div>
                 <div class="form-group">
                    <label for="mobile" class="bmd-label-floating">@lang('admin.driver_cartype')</label>
                    <select class="form-control" name="service_type" id="service_type" data-validation="required">
                    <option value="">Select @lang('admin.driver_cartype')</option>
                    @foreach(get_all_service_types() as $type)
                        <option value="{{$type->id}}" {{ ( $type->id == $provider_service->service_type_id) ? 'selected' : '' }}>{{$type->name}}</option>
                    @endforeach
                </select>
                </div>
                <div class="form-group">
                        <label for="mobile" class="bmd-label-floating">Country</label>
                        <div class="col-xs-10">
                            <select id="country" name="country" class="form-control" required>
                                <option value="" selected disabled>Select</option>
                                @foreach($countries as $key => $country)
                                <option value="{{$key}}" {{ ($key == $provider->country) ? 'selected' : '' }}> {{$country}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="bmd-label-floating">City</label>
                        <div class="col-xs-10">
                            <select name="city" id="city" class="form-control" required>
                                @foreach(get_all_city($provider->country) as $type)
                        <option value="{{$type->id}}" {{ ( $type->id == $user->city) ? 'selected' : '' }}>{{$type->name}}</option>
                    @endforeach
                            </select>
                        </div>
                    </div>
                <div class="form-group">
                    <label class="bmd-label-floating">@lang('admin.password')</label>
                    <div class="col-xs-10">
                        <input type="password" class="form-control" name="password" placehold="@lang('admin.password')">
                    </div>
                </div>

                <div class="form-group">
                    <label class="bmd-label-floating">@lang('admin.account-manager.password_confirmation')</label>
                    <div class="col-xs-10">
                        <input type="password" class="form-control" name="password_confirm" placehold="@lang('admin.account-manager.password_confirmation')">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="zipcode" class="bmd-label-floating"></label>
                    <div class="col-xs-10">
                        <button type="submit" class="btn btn-primary">@lang('admin.provides.update_provider')</button>
                        <a href="{{route('admin.provider.index')}}" class="btn btn-default">@lang('admin.cancel')</a>
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
        var input = document.querySelector("#country_code");

    //    var states = $('#states');
    //    var providerCity = "{{ $provider->city_id }}";

    //    states.change(function () {
    //        var idEstado = $(this).val();
    //        $.get('/admin/cities/' + idEstado, function (cidades) {
    //            $('#cities').empty();
    //            $.each(cidades, function (key, value) {
    //                $('#cities').append('<option value=' + value.id + '>' + value.title + '</option>');
    //            });
    //        });
    //    });

    //    if(states.val() != null){
    //        $.get('/admin/cities/' + states.val(), function (cidades) {
    //            $('#cities').empty();
    //            $.each(cidades, function (key, value) {
    //                if(value.id == providerCity){
    //                    $('#cities').append('<option value=' + value.id + ' selected>' + value.title + '</option>');
    //                }else{
    //                    $('#cities').append('<option value=' + value.id + '>' + value.title + '</option>');
    //                }
    //            });
    //        });
    //    }

       window.intlTelInput(input,({
           // separateDialCode:true,
       }));
       $(".country-name").click(function(){
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
                $("#city").append('<option>Select</option>');
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