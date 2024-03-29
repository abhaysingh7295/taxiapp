@extends('admin.layout.base')

@section('title', 'Complain Issues Type ')

@section('content')

            <div class="card">
                <div class="card-header card-header-primary">
                    <h5 class="card-title">@lang('admin.dispute.title')</h5>
                    @if(Setting::get('demo_mode', 0) == 1)
                    <div class="card-category" style="height:50px;color:red;">
                        ** Demo Mode : @lang('admin.demomode')
                    </div>
                @endif
                
                @can('dispute-create')
                <a href="{{ route('admin.dispute.create') }}" style="margin-left: 1em; margin-top: -22px;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> @lang('admin.dispute.add_dispute')</a>
                @endcan
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>@lang('admin.id')</th>
                            <th>@lang('admin.dispute.dispute_type') </th>
                            <th>@lang('admin.dispute.dispute_name') </th>                             
                            <th>@lang('admin.status')</th>                         
                            <th>@lang('admin.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($dispute as $index => $dist)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>@if($dist->dispute_type=='user'){{__('admin.user')}} @endif @if($dist->dispute_type=='provider'){{__('admin.provider')}} @endif</td>
                            <td>{{ ucfirst($dist->dispute_name) }} </td>
                            <td>
                                @if($dist->status=='active')
                                    <span class="tag tag-success">@lang('admin.active')</span>
                                @else
                                    <span class="tag tag-danger">@lang('admin.inactive')</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.dispute.destroy', $dist->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    @if( Setting::get('demo_mode', 0) == 0)
                                    @can('dispute-edit')
                                    <a href="{{ route('admin.dispute.edit', $dist->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> @lang('admin.edit')</a>
                                    @endcan
                                    @can('dispute-delete')
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')">@lang('admin.delete')</button>
                                    @endcan
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                       <!--  <tr>
                            <th>@lang('admin.id')</th>
                            <th>@lang('admin.dispute.dispute_type') </th>
                            <th>@lang('admin.dispute.dispute_name') </th>                              
                            <th>@lang('admin.status')</th>                            
                            <th>@lang('admin.action')</th>
                        </tr> -->
                    </tfoot>
                </table>
            </div>
            
        </div>
    </div>
@endsection