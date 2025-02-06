@extends('admin.app')

@section('admin_content')
    {{-- CKEditor CDN --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">User Manage</a></li>
                        <li class="breadcrumb-item active">User Manage!</li>
                    </ol>
                </div>
                <h4 class="page-title">User Manage!</h4>
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
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $usersData)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$usersData->name}}</td>
                                <td>{{$usersData->email}}</td>
                                <td>{{$usersData->phone}}</td>
                                <td>{{$usersData->address}}</td>
                                <td>{{$usersData->is_registration_by}}</td>
                                <td>{{$usersData->status==1? 'Active':'Inactive'}}</td>
                                <td>
                                    <a href="{{route('order.list.manage.by.admin',$usersData->id)}}" class="btn btn-primary btn-sm">Order</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
