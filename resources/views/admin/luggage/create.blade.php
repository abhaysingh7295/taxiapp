@extends('admin.layout.base')
@section('title', 'Add Luggage Combination')
@section('styles')
<link rel="stylesheet" href="{{asset('asset/css/intlTelInput.css')}}">
@endsection
@section('content')
<div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title pull-left">Add Luggage Combination</h4>
                <a href="{{ URL::previous() }}" class="btn pull-right"><i
                        class="fa fa-angle-left"></i> @lang('admin.back')</a>
            </div>
            <div class="card-body">
                <span id="result"></span>
                <div class="table-responsive">
                     <form class="form-horizontal" action="{{route('admin.luggage.store')}}" method="POST" enctype="multipart/form-data" role="form" id="dynamic_form">
                {{csrf_field()}}
          
                        
                        <div class="form-group">
                            <label for="seatType" class="bmd-label-floating">Seater</label>
                            <div class="col-xs-10">
                                <select id="seatType" name="seattype" class="form-control" required>
                                    <option value="" selected disabled>Select</option>
                                    @foreach(get_seattype() as $key => $value)
                                    <option value="{{$value->id}}"> {{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <table class="table table-bordered " id="user_table">
                            <thead>
                                <tr>
                                    <th width="35%">NumberPassengers</th>
                                    <th width="35%">Large Luggages</th>
                                    <th width="35%">Small Luggages</th>
                                    <th width="30%">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                           
                        </table>
                        <div class="form-group">
                            <label for="zipcode" class="bmd-label-floating"></label>
                            <div class="col-xs-10">
                                <button id="save" type="submit" class="btn btn-primary">Save</button>
                                <a href="{{route('admin.luggage.index')}}" class="btn btn-default">@lang('admin.cancel')</a>
                            </div>
                        </div>
                    </form>
                </div>
              
            </div>
        </div>
    </div>

    @endsection

    @section('scripts')
    <script type="text/javascript" src="{{ asset('asset/js/intlTelInput.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/js/intlTelInput-jquery.min.js') }}"></script>

    <script>
$(document).ready(function () {

    var count = 1;

    dynamic_field(count);

    function dynamic_field(number)
    {
        html = '<tr>';
        html += '<td><input type="text" name="NumberPassengers[]" class="form-control" required/></td>';
        html += '<td><input type="text" name="LargeLuggages[]" class="form-control" required/></td>';
        html += '<td><input type="text" name="SmallLuggages[]" class="form-control" required/></td>';
        if (number > 1)
        {
            html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
            $('tbody').append(html);
        } else
        {
            html += '<td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
            $('tbody').html(html);
        }
    }

    $(document).on('click', '#add', function () {
        count++;
        dynamic_field(count);
    });

    $(document).on('click', '.remove', function () {
        count--;
        $(this).closest("tr").remove();
    });

    $('#dynamic_form').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            url: '{{route("admin.luggage.store")}}',
            method: 'post',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function () {
                $('#save').attr('disabled', 'disabled');
            },
            success: function (data)
            {
                if (data.error)
                {
                    var error_html = '';
                    for (var count = 0; count < data.error.length; count++)
                    {
                        error_html += '<p>' + data.error[count] + '</p>';
                    }
                    $('#result').html('<div class="alert alert-danger">' + error_html + '</div>');
                } else
                {
                    dynamic_field(1);
                    $('#result').html('<div class="alert alert-success">' + data.success + '</div>');
                }
                $('#save').attr('disabled', false);
            }
        })
    });

});
    </script>
    @endsection


