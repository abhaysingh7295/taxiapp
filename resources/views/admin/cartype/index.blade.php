
@extends('admin.layout.base')
@section('title', 'Car Type ')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title ">Car Type</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.cartype.index') }}" method="get">
                <div class="form-group col-md-12" style="padding-left:0 !important; padding-right:0 !important; margin-bottom: 20px;">

                    <div class="col-xs-6">
                        <input name="name" type="text" class="form-control" placehold="User Name or Email" aria-label="Passenger name" aria-describedby="basic-addon2">
                    </div>

                    <div class="col-xs-3">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>

                    @can('user-create')
                    <div class="col-xs-3">
                        <a href="{{ route('admin.cartype.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>Add New</a>

                    </div>
                    @endcan
                </div>
            </form>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Description</th>

                            <th>@lang('admin.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($page = ($pagination->currentPage-1)*$pagination->perPage)
                        @foreach($cartype as $key=> $cartypes)
                        @php($page++)
                        <tr>
                            <td>{{ $page }}</td>
                            <td>{{ $cartypes->name }}</td>
                            <td>{{ $cartypes->description }}</td>

                            <td>
                                <form action="{{ route('admin.cartype.destroy', $cartypes->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">

                                    <a href="{{ route('admin.cartype.edit', $cartypes->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> @lang('admin.edit')</a>

                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> @lang('admin.delete')</button>



                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>@lang('admin.action')</th>
                        </tr>
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
                url: "{{url('admin/cartype')}}?page=all",
                data: {},
                success: function (result) {
                    p = new Array();
                    $.each(result.data, function (i, d)
                    {
                        var item = [d.id, d.name,d.description];
                        p.push(item);
                    });
                },
                async: false
            });
            var head = new Array();
            head.push("ID", "Name","Description");
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

