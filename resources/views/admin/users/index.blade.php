@extends('admin.layout.base')

@section('title', 'Rider ')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title ">@lang('admin.users.Users')</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.user.index') }}" method="get">
                <div class="form-group col-md-12" style="padding-left:0 !important; padding-right:0 !important; margin-bottom: 20px;">
                    <div class="col-xs-6">
                        <input name="name" type="text" class="form-control" placehold="User Name or Email" aria-label="Passenger name" aria-describedby="basic-addon2">
                    </div>

                    <div class="col-xs-3">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>

                    @can('user-create')
                    <div class="col-xs-3">
                        <a href="{{ route('admin.user.create') }}" style="margin-left: 1em; margin-top: -44px;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>Add New</a>

                    </div>
                    @endcan
                </div>
            </form>
            <div class="table-responsive-md">
                <table class="table">
                    <thead>
                        <tr>
                            <th>@lang('admin.id')</th>
                            <th>@lang('admin.first_name')</th>
                            <th>@lang('admin.last_name')</th>
                            <th>@lang('admin.gender')</th>
                            <th>@lang('admin.email')</th>
                            <th>@lang('admin.mobile')</th>

<!--                        <th>@lang('admin.users.Rating')</th>
<th>@lang('admin.users.Wallet_Amount')</th>-->
                            <th>@lang('admin.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($page = ($pagination->currentPage-1)*$pagination->perPage)
                        @foreach($users as $index => $user)
                        @php($page++)
                        <tr>
                            <td>{{ $page }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->gender }}</td>
                            @if(Setting::get('demo_mode', 0) == 1)
                            <td>{{ substr($user->email, 0, 3).'****'.substr($user->email, strpos($user->email, "@")) }}</td>
                            @else
                            <td>{{ $user->email }}</td>
                            @endif
                            @if(Setting::get('demo_mode', 0) == 1)
                            <td>+919876543210</td>
                            @else
                            <td>{{ $user->mobile }}</td>

                            @endif
    <!--                        <td>{{ $user->rating }}</td>
                            <td>{{currency($user->wallet_balance)}}</td>-->
                            <td>
                                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    @can('user-history')
    <!--                                <a href="{{ route('admin.user.request', $user->id) }}" class="btn btn-info"><i class="fa fa-search"></i> @lang('admin.History')</a>-->
                                    @endcan
                                    @if( Setting::get('demo_mode', 0) == 0)

                                    @can('user-create')
                                    <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> @lang('admin.edit')</a>
                                    @endcan

                                    @can('user-delete')
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"> @lang('admin.delete')</button>
                                      @if($user->status == 'banned')
                                    <a class="btn btn-danger"
                                       href="{{ route('admin.user.approve', $user->id ) }}">@lang('Disable')</a>
                                    @endif
                                     @if($user->status == 'approved')
                                    <a class="btn btn-success"
                                       href="{{ route('admin.user.disapprove', $user->id ) }}">@lang('Enable')</a>
                                      @endif
                                    @endcan

                                    @endif
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                       <!-- <tr>
                            <th>@lang('admin.id')</th>
                            <th>@lang('admin.first_name')</th>
                            <th>@lang('admin.last_name')</th>
                            <th>@lang('admin.gender')</th>
                            <th>@lang('admin.email')</th>
                            <th>@lang('admin.mobile')</th>
                          <th>@lang('admin.users.Rating')</th>
 <th>@lang('admin.users.Wallet_Amount')</th>
                            <th>@lang('admin.action')</th>
                        </tr>-->
                    </tfoot>
                </table>
                @include('common.pagination')
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    jQuery.fn.DataTable.Api.register('buttons.exportData()', function (options) {
        if (this.context.length) {
            var jsonResult = $.ajax({
                url: "{{url('admin/user')}}?page=all",
                data: {},
                success: function (result) {
                    p = new Array();
                    $.each(result.data, function (i, d)
                    {
                        var item = [d.id, d.first_name, d.last_name, d.gender, d.email, d.mobile];
                        p.push(item);
                    });
                },
                async: false
            });
            var head = new Array();
            head.push("ID", "First Name", "Last Name", "Gender", "Email", "Mobile");
            return {body: p, header: head};
        }
    });

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
