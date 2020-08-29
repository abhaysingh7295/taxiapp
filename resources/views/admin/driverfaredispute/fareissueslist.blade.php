@extends('admin.layout.base')

@section('title', ' Driver Fare Issues')

@section('content')

<div class="container-fluid">

    <div class="card">
        <div class="card-header card-header-primary">
            @if(Setting::get('demo_mode', 0) == 1)
            <div class="col-md-12" style="height:50px;color:red;">
                ** Demo Mode : @lang('admin.demomode')
            </div>
            @endif
            <h5 class="card-title">@lang('admin.driverfareissuelist.title1')</h5>
           
        </div>
        <div class="card-body">
            <form action="{{route('admin.fareissueslist')}}" method="get">
                <div class="row">
                    <div class="col-xs-4">
                        <input name="name" type="text" class="form-control" aria-describedby="basic-addon2">
                    </div>
                    <div class="col-xs-4">
                        <select class="form-control" name="dispute_reason" id="dispute_reason">
                            <option value="">@lang('admin.driverfareissue.dispute_reason')</option>
                            <option value="1">Issues while on The job</option>
                            <option value="2">Before Reaching The Pick-Up Point</option>
                            <option value="3">Reached The Pick-Up Point</option>
                            <option value="4">Waiting For The Rider</option>
                            <option value="5">Issues After Completing The job</option>
                        </select>   
                    </div>
                    <div class="col-xs-3">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">

                <table class="table">
                    <thead>
                        <tr>
                            <th>@lang('admin.id')</th>
                            <th>@lang('admin.dispute.dispute_request') </th>
                            <th>@lang('admin.users.name') </th>                           
                            <th>@lang('admin.dispute.dispute_request_id') </th>
                            <th>@lang('admin.dispute.dispute_name') </th>  
                            <th>@lang('admin.driverfareissue.dispute_reason') </th>  
                            <th>@lang('admin.dispute.dispute_comments') </th>                           
                            <th>@lang('admin.dispute.dispute_refund') </th>                           
                            <th>@lang('admin.dispute.dispute_status') </th>                           
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($disputes as $index => $dispute)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $dispute->dispute_type == "provider" ? "Driver" : "User" }}</td>
                            <td>@if($dispute->dispute_type=='user') @if($dispute->user != null) {{ $dispute->user->first_name." ".$dispute->user->last_name }} @endif @else  @if($dispute->provider != null)  {{ $dispute->provider->first_name." ".$dispute->provider->last_name }} @endif @endif</td>
                            <td>{{ $dispute->request->booking_id }}</td>
                            <td>{{ $dispute->dispute_name }}</td>
                            <td>{{ $dispute->comments }}</td>
                            <td>{{ currency($dispute->refund_amount) }}</td>
                            <td>
                                @if($dispute->status=='open')
                                <span class="tag tag-success">Open</span>
                                @else
                                <span class="tag tag-danger">Finished</span>
                                @endif
                            </td>
                         
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>@lang('admin.id')</th>
                            <th>@lang('admin.dispute.dispute_request') </th>
                            <th>@lang('admin.users.name') </th>                           
                            <th>@lang('admin.dispute.dispute_request_id') </th>
                            <th>@lang('admin.dispute.dispute_name') </th> 
                            <th>@lang('admin.driverfareissue.dispute_reason') </th>
                            <th>@lang('admin.dispute.dispute_comments') </th>                           
                            <th>@lang('admin.dispute.dispute_refund') </th>                           
                            <th>@lang('admin.dispute.dispute_status') </th>                           
                       
                        </tr>
                    </tfoot>
                </table>
                @include('common.pagination')
            </div>

        </div>
    </div>
    @endsection

    @section('scripts')
    <script type="text/javascript">
        $('#table-5').DataTable({
            responsive: true,
            paging: false,
            info: false,
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });
    </script>
    @endsection