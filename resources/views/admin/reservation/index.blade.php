
@extends('admin.layout.base')
@section('title', 'Car Reservations')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header card-header-primary height">
            <h4 class="card-title reservations_center">Car Reservations</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.reservations.index') }}" method="get">
                <div class="form-group col-md-12" style="padding-left:0 !important; padding-right:0 !important; margin-bottom: 20px;">

                    <div class="col-xs-6">
<!--                        <input name="name" type="text" class="form-control" placehold="User Name or Email" aria-label="Passenger name" aria-describedby="basic-addon2">
                    </div>

                    <div class="col-xs-3">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>-->

                    @can('user-create')
<!--                    <div class="col-xs-3">
                        <a href="{{ route('admin.cars.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>Add New</a>

                    </div>-->
                    @endcan
                </div>
            </form>
            <div class="table-responsive-sm">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Car</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Message</th>
                             <th>Posting Date</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php($page = ($pagination->currentPage-1)*$pagination->perPage)
                        @foreach($reservation as $key=> $value)
                        @php($page++)
                        <tr>
                            <td>{{ $page }}</td>
                            <td>{{ get_rider_name($value->userid) }}</td>
                            <td>{{ get_car_name($value->VehicleId) }}</td>
                            <td>{{ $value->FromDate }}</td>
                            <td>{{ $value->ToDate }}</td>
                            <td>{{ $value->Message }}</td>
                            <td>{{ $value->PostingDate }}</td>


                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                     <!--    <tr>
                            <th>Id</th>
                              <th>Name</th>
                            <th>Car</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Message</th>
                            <th>Posting Date</th>

                        </tr> -->
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
                url: "{{url('admin/reservations')}}?page=all",
                data: {},
                success: function (result) {
                    p = new Array();
                    $.each(result.data, function (i, d)
                    {
                        var item = [d.id, d.userid,d.VehicleId,d.FromDate, d.ToDate, d.message,d.PostingDate, d.Status];
                        p.push(item);
                    });
                },
                async: false
            });
            var head = new Array();
            head.push("ID", "Name", "Car", "From Date", "To Date", "Message", "Posting Date","Status");
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

