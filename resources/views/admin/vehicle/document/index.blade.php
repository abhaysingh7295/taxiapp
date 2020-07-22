@extends('admin.layout.base')
@section('title', 'Vehicle Documents')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Vehicle Documents</h4> 
                    <a href="{{route('admin.vehicles.index')}}" style="margin-left: 1em;margin-top: -30px" class="btn btn-primary pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                    

                </div>
                <div class="card-body">


                    <div class="form-group">

                        <div class="manage-doc-section">
<!--                            <div class="manage-doc-section-head row no-margin">
                                <h3 class="manage-doc-tit">
                                    @lang('provider.profile.vehicle_document')
                                </h3>
                            </div>-->

                            <div class="manage-doc-section-content">
                                @foreach($VehicleDocuments as $Document)
                                <div class="manage-doc-box row no-margin border-top">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="manage-doc-box-left">
                                            <p class="manage-txt">{{ $Document->name }}</p>
<!--                                            <p class="license">@lang('provider.expires'): {{ $vehicle->document($Document->id) ? ($vehicle->document($Document->id)->expires_at ? $vehicle->document($Document->id)->expires_at: 'N/A'): 'N/A' }}</p>-->
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="manage-doc-box-center text-center">
                                            <p class="manage-badge {{ $vehicle->document($Document->id) ? ($vehicle->document($Document->id)->status == 'ASSESSING' ? 'yellow-badge' : 'green-badge') : 'red-badge'}}">
                                                @if($vehicle->document($Document->id))
                                                @if($vehicle->document($Document->id)->status == "ASSESSING"){{ "ASSESSING" }}
                                                @elseif($vehicle->document($Document->id)->status == "ACTIVE") {{ "APROVADO" }}
                                                @elseif($vehicle->document($Document->id)->status == "MISSING") {{ "NOT SENT" }} @endif
                                                @else {{ "NOT SENT" }} @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="manage-doc-box-right text-right">
                                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                <form action="{{ route('admin.vehicles.uploadsvehicledocuments', [$Document->id,$vehicle->id]) }}" method="POST" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PATCH') }}
                                                    <div class="form-control" data-trigger="fileinput">
                                                        <span class="fileinput-filename"></span>
                                                    </div>
                                                    <span class="input-group-addon btn btn-default btn-file fileinput-exists btn-submit">
                                                        <button>
                                                            <i class="fa fa-check"></i>
                                                        </button>
                                                    </span>
                                                    <span class="input-group-addon btn btn-default btn-file">
                                                        <span class="fileinput-new upload-link">
                                                            <i class="fa fa-upload upload-icon"></i> @lang('provider.profile.upload')
                                                        </span>
                                                        <span class="fileinput-exists">
                                                            <i class="fa fa-edit"></i>
                                                        </span>
                                                        <input type="file" name="document" accept="application/pdf, image/*">
                                                    </span>
                                                    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>



                </div>
                   @can('provider-documents')
        <div class="card">
            <div class="card-header card-header-primary">
                <h5 class="card-title">
                    @lang('admin.provides.provider_documents')<br>
                    @can('provider-status')
                    @if($vehicle->status != 'approved')
                    @if($vehicle->documents()->count())
                    @if($vehicle->documents->last()->status == "ACTIVE")
<!--                    <a class="btn btn-success btn-block"
                        href="">Approve</a>-->
                    @endif
                    @endif
                    @endcan
                    @endif
                </h5>
            </div>
            @if( Setting::get('demo_mode', 0) == 0)
            @if(count($vehicle->documents)>0)
<!--            <a href="{{route('admin.download', $vehicle->id)}}" style="margin-left: 1em;"
                class="btn btn-primary pull-right"><i class="fa fa-download"></i> @lang('admin.provides.download')</a>-->
            @endif
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.provides.document_type')</th>
                                <th>@lang('admin.status')</th>
                                <th>@lang('admin.action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vehicle->documents as $Index => $Document)
                            <tr>
                                <td>{{ $Index + 1 }}</td>
                                <td>@if($Document->document){{ $Document->document->name }}@endif</td>
                                <td>@if($Document->status == "ACTIVE"){{ "APPROVED" }}@else {{ " PENDING ASSESSMENT" }}
                                    @endif</td>
                                <td>
                                    <div class="input-group-btn">
                                        @if( Setting::get('demo_mode', 0) == 0)
                                        @can('provider-document-edit')
                                        <a
                                            href="{{ route('admin.vehicles.viewvehicledocument', [$vehicle->id, $Document->id]) }}"><span
                                                class="btn btn-success btn-large">@lang('admin.view')</span></a>
                                        @endcan
                                        @can('provider-document-delete')
                                        
                                        <form
                                            
                                            action="{{ route('admin.vehicles.destroyvehicledocument', [$vehicle->id, $Document->id]) }}"
                                            method="POST" id="form_delete_{{$Document->id}}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="btn btn-danger btn-large doc-delete"
                                            id="{{$Document->id}}">@lang('admin.delete')</button>
                                        </form>
                                        @endcan
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin.provides.document_type')</th>
                                <th>@lang('admin.status')</th>
                                <th>@lang('admin.action')</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                @endcan
            </div>
        </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('styles')
<link href="{{ asset('asset/css/jasny-bootstrap.min.css') }}" rel="stylesheet" type="text/css">
@section('scripts')
<script type="text/javascript" src="{{ asset('asset/js/jasny-bootstrap.min.js') }}"></script>

@endsection
