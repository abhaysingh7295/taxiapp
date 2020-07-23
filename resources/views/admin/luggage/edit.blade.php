@extends('admin.layout.base')
@section('title', 'Update Luggage Combination ')
@section('styles')
<link rel="stylesheet" href="{{asset('asset/css/intlTelInput.css')}}">
@endsection
@section('content')
<div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title pull-left">Update Luggage Combination</h4>
                <a href="{{route('admin.luggage.index')}}" class="btn pull-right"><i
                        class="fa fa-angle-left"></i> @lang('admin.back')</a>
            </div>
            <div class="card-body">

                <form action="{{route('admin.luggage.update', $seater->id )}}" method="POST" enctype="multipart/form-data" role="form">
                    {{csrf_field()}}
         <input type="hidden" name="_method" value="PATCH">
         <div class="form-group">
                            <label for="seatType" class="bmd-label-floating">Seater</label>
                            <div class="col-xs-10">
                                <select id="seatType" name="seattype" class="form-control" required>
                                    <option value="" selected disabled>Select</option>
                                    @foreach(get_seattype() as $key => $value)
                                    <option value="{{$value->id}}" {{ ( $key == $seater->seattype) ? 'selected' : '' }}> {{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
    
                    <div class="form-group">
                        <label for="NumberPassengers" class="bmd-label-floating">Number Passengers</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ $seater->NumberPassengers }}" name="NumberPassengers" required id="NumberPassengers">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="LargeLuggages" class="bmd-label-floating">Large Luggages</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ $seater->LargeLuggages }}" name="LargeLuggages" required id="LargeLuggages">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="SmallLuggages" class="bmd-label-floating">Small Luggages</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ $seater->SmallLuggages }}" name="SmallLuggages" required id="SmallLuggages">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="zipcode" class="bmd-label-floating"></label>
                        <div class="col-xs-10">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{route('admin.luggage.index')}}" class="btn btn-default">@lang('admin.cancel')</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
 

