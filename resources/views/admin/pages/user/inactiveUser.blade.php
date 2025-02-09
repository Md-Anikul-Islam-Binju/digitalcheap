@extends('admin.app')

@section('admin_content')
    {{-- CKEditor CDN --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Active User</a></li>
                        <li class="breadcrumb-item active">Inactive User!</li>
                    </ol>
                </div>
                <h4 class="page-title">User!</h4>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                </div>
            </div>
            <div class="card-body">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($inactiveUser as $key => $usersData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$usersData->name}}</td>
                            <td>{{$usersData->email}}</td>
                            <td>{{$usersData->phone}}</td>
                            <td>{{$usersData->address}}</td>
                            <td>{{$usersData->status==1? 'Active':'Inactive'}}</td>
                            <td>
                                <a href="#" class="btn btn-primary btn-sm">Account Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
