@extends('admin.layout.base')
@section('title', 'Vehicle Checklist')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Vehicle Checklist</h4>
<!--                    <p class="card-category">Driver Checklist</p>-->
                </div>
                <div class="card-body">
                    <form class="form-horizontal"  action="{{route('admin.vehicles.vehiclechecklist', $vehicle->id )}}" method="POST" role="form">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="form-group">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="checkbox checkbox-inline">
                                            <input type="checkbox" id="is_logo" name="is_logo" value="1" {{($vehicle->is_logo==1)?'checked="checked"':""}}>
                                            <label for="is_logo"> Is  Logo </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="checkbox checkbox-inline">
                                            <input type="checkbox" id="is_ft" name="is_ft" value="1" {{($vehicle->is_ft==1)?'checked="checked"':""}}>
                                            <label for="is_ft"> Is Full Time	 </label>
                                        </div></div>
                                    <div class="col-sm-12">
                                        <div class="checkbox checkbox-inline">
                                            <input type="checkbox" id="is_schedule" name="is_schedule" value="1" {{($vehicle->is_schedule==1)?'checked="checked"':""}}>
                                            <label for="is_schedule"> Is Schedule </label>
                                        </div></div>
                                    <div class="col-sm-12">
                                        <div class="checkbox checkbox-inline">
                                            <input type="checkbox" id="is_induction" name="is_induction" value="1" {{($vehicle->is_induction==1)?'checked="checked"':""}}>
                                            <label for="is_induction"> Is Induction </label>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="checkbox checkbox-inline">

                                            <input type="checkbox" id="is_notes" name="is_notes" value="1" {{($vehicle->is_notes==1)?'checked="checked"':""}}>
                                            <label for="is_notes">Is Notes</label>
                                        </div>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection
