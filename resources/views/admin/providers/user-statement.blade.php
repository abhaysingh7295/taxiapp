@extends('admin.layout.base')

@section('title', 'Users History' )

@section('content')

<div>
    <div class="container-fluid">
            <div class="card">                
                <div class="card-header card-header-primary">
                <h4 class="card-title">Passenger History</h4>
                <div class="box-block clearfix">
                    <h5 class="float-xs-left">@lang('admin.include.user_ride_histroy')</h5>
                    <div class="float-xs-right">
                    </div>
                </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                            @if(count($Users) != 0)
                            <table class="table table-striped table-bordered dataTable" id="table-4">
                                <thead>
                                    <tr>
                                        <td>@lang('admin.fleets.name')</td>
                                        <td>@lang('admin.mobile')</td>
                                        <td>@lang('admin.fleets.Total_Rides')</td>
                                        <td>@lang('admin.users.Total_Spending')</td>
                                        <td>@lang('admin.fleets.Joined_at')</td>
                                        <td>@lang('admin.fleets.Details')</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $diff = ['-success', '-info', '-warning', '-danger']; ?>
                                    @foreach($Users as $index => $user)
                                    <tr>
                                        <td>
                                            {{$user->first_name}} 
                                            {{$user->last_name}}
                                        </td>
                                        <td>
                                            {{$user->mobile}}
                                        </td>

                                        <td>
                                            @if($user->rides_count)
                                            {{$user->rides_count}}
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->payment)
                                            {{currency($user->payment[0]->overall)}}
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->created_at)
                                            <span class="text-muted">{{$user->created_at->diffForHumans()}}</span>
                                            @else
                                            -
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.statement_user', $user->id)}}">View History</a>
                                        </td>
                                    </tr>
                                    @endforeach

                                <tfoot>
                                    <tr>
                                        <td>@lang('admin.fleets.name')</td>
                                        <td>@lang('admin.mobile')</td>
                                        <td>@lang('admin.fleets.Total_Rides')</td>
                                        <td>@lang('admin.users.Total_Spending')</td>
                                        <td>@lang('admin.fleets.Joined_at')</td>
                                        <td>@lang('admin.fleets.Details')</td>
                                    </tr>
                                </tfoot>
                            </table>
                            @include('common.pagination')
                            @else
                            <h6 class="no-result">Results not found</h6>
                            @endif 

                        </div>
                    </div>

                </div>

            </div>
    </div>

@endsection
