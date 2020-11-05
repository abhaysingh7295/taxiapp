@extends('admin.layout.base')
@section('title', 'Driver Documents')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Driver Documents</h4> 
                    <a href="{{route('admin.provider.index')}}" style="margin-left: 1em;margin-top: -30px" class="btn btn-primary pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                    

                </div>
                <div class="card-body">


                    <div class="form-group">

                        <div class="manage-doc-section">

                            <div class="manage-doc-section-content">
                                @foreach($DriverDocuments as $Document)
                                <div class="manage-doc-box row no-margin border-top">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="manage-doc-box-left">
                                            <p class="manage-txt">{{ $Document->name }}</p>
<!--                                            <p class="license">@lang('provider.expires'): {{ $provider->document($Document->id) ? ($provider->document($Document->id)->expires_at ? $provider->document($Document->id)->expires_at: 'N/A'): 'N/A' }}</p>-->
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="manage-doc-box-center text-center">
                                            <p class="manage-badge {{ $provider->document($Document->id) ? ($provider->document($Document->id)->status == 'ASSESSING' ? 'yellow-badge' : 'green-badge') : 'red-badge'}}">
                                                @if($provider->document($Document->id))
                                                @if($provider->document($Document->id)->status == "ASSESSING"){{ "ASSESSING" }}
                                                @elseif($provider->document($Document->id)->status == "ACTIVE") {{ "APROVADO" }}
                                                @elseif($provider->document($Document->id)->status == "MISSING") {{ "NOT SENT" }} @endif
                                                @else {{ "NOT SENT" }} @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="manage-doc-box-right text-right">
                                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                <form action="{{ route('admin.provider.updatedocuments', [$Document->id,$provider->id]) }}" method="POST" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PATCH') }}
                                                    @if($Document->is_expiredate == "1")
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                <div class="manage-doc-box-left">
                                                    <p class="manage-txt">Expire Date</p>

                                                    <input class="form-control" type="date" value="{{ old('expires_at') }}" name="expires_at" required id="expires_at">
                                                </div>
                                            
                                               
                                            </div>
                                             @endif
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
                                                            <i class="fa fa-upload upload-icon "></i> @lang('provider.profile.upload')
                                                        </span>
                                                        <span class="fileinput-exist upload">
                                                            <i class="fa fa-edit "></i>
                                                        </span>
                                                        <input type="file" name="document" accept="application/pdf, image/*">
                                                    </span>
                                                    <a href="#" class="input-group-addon btn btn-default fileinput-exists delete" data-dismiss="fileinput">
                                                        <i class="fa fa-times delete"></i>
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
