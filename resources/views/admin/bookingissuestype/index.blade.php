@extends('admin.layout.base')

@section('title', 'Booking Issues Type ')

@section('content')

            <div class="card">
                <div class="card-header card-header-primary">
                    <h5 class="card-title">@lang('admin.bookingissue.title')</h5>
                    @if(Setting::get('demo_mode', 0) == 1)
                    <div class="card-category" style="height:50px;color:red;">
                        ** Demo Mode : @lang('admin.demomode')
                    </div>
                @endif
                
     
                <a href="{{ route('admin.bookingissuetypes.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> @lang('admin.bookingissue.add_dispute')</a>
          
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>@lang('admin.id')</th>
                            <th>@lang('admin.bookingissue.dispute_type') </th>
                            <th>@lang('admin.bookingissue.dispute_name') </th>                             
                            <th>@lang('admin.status')</th>                         
                            <th>@lang('admin.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($bookingissuestype as $index => $dist)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>@if($dist->type=='user'){{__('admin.user')}} @endif @if($dist->type=='provider'){{__('admin.provider')}} @endif</td>
                            <td>{{ ucfirst($dist->name) }} </td>
                            <td>
                                @if($dist->status=='active')
                                    <span class="tag tag-success">@lang('admin.active')</span>
                                @else
                                    <span class="tag tag-danger">@lang('admin.inactive')</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.bookingissuetypes.destroy', $dist->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    @if( Setting::get('demo_mode', 0) == 0)
                                    @can('dispute-edit')
                                    <a href="{{ route('admin.bookingissuetypes.edit', $dist->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> @lang('admin.edit')</a>
                                    @endcan
                                    @can('dispute-delete')
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> @lang('admin.delete')</button>
                                    @endcan
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>@lang('admin.id')</th>
                            <th>@lang('admin.bookingissue.dispute_type') </th>
                            <th>@lang('admin.bookingissue.dispute_name') </th>                              
                            <th>@lang('admin.status')</th>                            
                            <th>@lang('admin.action')</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
        </div>
    </div>
@endsection