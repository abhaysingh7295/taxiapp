@extends('admin.layout.base')
@section('title', 'Add Document ')
@section('content')
<script src="http://www.codermen.com/js/jquery.js"></script>
<div class="container">
    <div class="panel panel-default">
      <div class="panel-heading"></div>
      <div class="panel-body">
            <div class="form-group">
                <select id="country" name="category_id" class="form-control" style="width:350px" >
                <option value="" selected disabled>Select</option>
                  @foreach($countries as $key => $country)
                  <option value="{{$key}}"> {{$country}}</option>
                  @endforeach
                  </select>
            </div>
            <div class="form-group">
                <label for="title">Select City:</label>
                <select name="city" id="city" class="form-control" style="width:350px">
                </select>
            </div>
      </div>
    </div>
</div>
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