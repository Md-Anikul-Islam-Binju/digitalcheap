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
                    @foreach($activeUser as $key => $usersData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$usersData->name}}</td>
                            <td>{{$usersData->email}}</td>
                            <td>{{$usersData->phone}}</td>
                            <td>{{$usersData->address}}</td>
                            <td>{{$usersData->status==1? 'Active':'Inactive'}}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="actionDropdown{{ $usersData->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="actionDropdown{{ $usersData->id }}">
                                        <li>
                                            <a class="dropdown-item"  style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#editStatusId{{$usersData->id}}">Change Status</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#">Assign Tools</a></li>
                                        <li><a class="dropdown-item" href="#">Order</a></li>
                                        <li><a class="dropdown-item" href="#">Payment</a></li>
                                        <li><a class="dropdown-item" href="#">Edit</a></li>
                                    </ul>
                                </div>
                            </td>

                        </tr>

                        <div class="modal fade" id="editStatusId{{$usersData->id}}" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editStatusLabel{{$usersData->id}}" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="addStatusLabel{{$usersData->id}}">Change User Status</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{route('change.status',$usersData->id)}}">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">

                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="example-select" class="form-label">Status</label>
                                                        <select name="status" class="form-select">
                                                            <option value="1" {{ $usersData->status === 1 ? 'selected' : '' }}>Active</option>
                                                            <option value="0" {{ $usersData->status === 0 ? 'selected' : '' }}>Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button class="btn btn-primary" type="submit">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
