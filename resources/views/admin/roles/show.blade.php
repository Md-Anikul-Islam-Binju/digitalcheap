@extends('admin.app')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sorobonno</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Permission Manage</a></li>
                        <li class="breadcrumb-item active">Show Role!</li>
                    </ol>
                </div>
                <h4 class="page-title">Show Role!</h4>
            </div>
        </div>
    </div>
    <div class="card-header">
        <div class="d-flex">
            <a class="btn btn-success" href="{{ route('roles.index') }}"> Back</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $role->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permissions:</strong>
                @if(!empty($rolePermissions))
                    @foreach($rolePermissions as $v)
                        <span class="badge bg-primary">{{ $v->name }}</span>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
