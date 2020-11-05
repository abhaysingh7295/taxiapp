@extends('admin.layout.base')

@section('title', 'Vehicle Documents ')

@section('content')
<div>
    <div class="container-fluid">

        <div class="card">
            <div class="card-header card-header-primary">
            <h5 class="card-title">Vehicle Name: {{ $Document->vehicle->make }} {{ $Document->vehicle->model }}</h5>
            <h5 class="card-category">@lang('admin.document.document_name'): {{ $Document->document->name }}</h5> <a href="{{route('admin.vehicles.vehicledocuments', $Document->vehicle->id )}}" style="margin-left: 1em;margin-top: -30px" class="btn btn-primary pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
        </div>
        <div class="card-body">
<!--            <embed src="{{ $Document->url!='' ? asset('storage/'.$Document->url): asset('asset/img/semfoto.jpg') }}" width="100%" height="100%" />-->
     <embed src="{{ $Document->url!='' ? 'http://bhanushainfosoft.live/taxiapp/storage/app/public/'.$Document->url: asset('asset/img/semfoto.jpg') }}" width="100%" height="100%" />

            <div class="row">
                <div class="col-xs-6">
                    <form action="{{ route('admin.vehicles.approvevehicledocument', [$Document->vehicle->id, $Document->id]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <button class="btn btn-block btn-primary" type="submit">@lang('admin.provides.approve')</button>
                    </form>
                </div>

                <div class="col-xs-6">
                    <form action="{{ route('admin.vehicles.destroyvehicledocument', [$Document->vehicle->id, $Document->id]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-block btn-danger" type="submit">@lang('admin.provides.delete')</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
