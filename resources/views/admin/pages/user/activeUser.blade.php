@extends('admin.app')

@section('admin_content')
    {{-- CKEditor CDN --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Digital Cheap</a></li>
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
                                            <a class="dropdown-item"  style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#editId{{$usersData->id}}">Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"  style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#editStatusId{{$usersData->id}}">Change Status</a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{url('chatify',$usersData->id)}}">Chat</a></li>
                                        <li><a class="dropdown-item" href="{{route('order.manage',$usersData->id)}}">Order</a></li>
                                        <li>
                                            <a class="dropdown-item"  style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#assignToolsId{{$usersData->id}}">Assign Tools</a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item"  style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#send{{$usersData->id}}">Send Email</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#">Payment</a></li>
                                    </ul>
                                </div>
                            </td>

                        </tr>


                        <div class="modal fade" id="send{{$usersData->id}}" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="sendLabel{{$usersData->id}}" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="sendLabel{{$usersData->id}}">Send Email</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{route('send.email',$usersData->id)}}">
                                            @csrf
                                            <div class="row">

                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="example-text-input" class="form-label">Email</label>
                                                        <input class="form-control" type="email" value="{{$usersData->email}}" id="example-text-input" name="email">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="example-password-input" class="form-label">Message</label>
                                                        <textarea class="form-control" rows="5" name="message"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button class="btn btn-primary" type="submit">Send</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

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


                        <div class="modal fade" id="editId{{$usersData->id}}" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editLabel{{$usersData->id}}" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="addLabel{{$usersData->id}}">Edit</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{route('user.info.update',$usersData->id)}}">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">

                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="example-text-input" class="form-label">Name</label>
                                                        <input class="form-control" type="text" value="{{$usersData->name}}" id="example-text-input" placeholder="Enter Name" name="name">
                                                    </div>
                                                </div>


                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="example-password-input" class="form-label">Password</label>
                                                        <input class="form-control" type="password"  placeholder="Enter Password" name="password">
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



                     {{--Assign Tools--}}
                        <div class="modal fade" id="assignToolsId{{$usersData->id}}" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addTools{{$usersData->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="addTools{{$usersData->id}}">Assign Tools</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('user.assign.tools', $usersData->id) }}">
                                            @csrf
                                            <div class="row">

                                                {{-- Type Selection --}}
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Type</label>
                                                        <select id="toolTypeSelect{{$usersData->id}}" class="form-select">
                                                            <option value="">Select Type</option>
                                                            <option value="product">Product</option>
                                                            <option value="package">Package</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                {{-- Product Section --}}
                                                <div id="productSection{{$usersData->id}}" style="display:none;">
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Product</label>
                                                            <select name="product_id" class="form-select">
                                                                <option value="">Select Product</option>
                                                                @foreach($product as $productData)
                                                                    <option value="{{ $productData->id }}">{{ $productData->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Duration</label>
                                                            <select name="duration_product" class="form-select">
                                                                <option value="">Select Duration</option>
                                                                @for ($i = 1; $i <= 12; $i++)
                                                                    <option value="{{ $i }}">{{ $i }} Month{{ $i > 1 ? 's' : '' }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Package Section --}}
                                                <div id="packageSection{{$usersData->id}}" style="display:none;">
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Package</label>
                                                            <select name="package_id" class="form-select">
                                                                <option value="">Select Package</option>
                                                                @foreach($package as $packageData)
                                                                    <option value="{{ $packageData->id }}">{{ $packageData->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="form-label">Duration</label>
                                                            <select name="duration_package" class="form-select">
                                                                <option value="">Select Duration</option>
                                                                <option value="Monthly">Monthly</option>
                                                                <option value="Half Yearly">Half Yearly</option>
                                                                <option value="Yearly">Yearly</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Device Access (Common Part) --}}
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Device Access</label>
                                                        <select name="device_access" class="form-select">
                                                            <option value="">Select Device Access</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-end">
                                                <button class="btn btn-primary" type="submit">Assign Tools</button>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('[id^="toolTypeSelect"]').forEach(function (select) {
                select.addEventListener('change', function () {
                    const userId = this.id.replace('toolTypeSelect', '');
                    const productSection = document.getElementById(`productSection${userId}`);
                    const packageSection = document.getElementById(`packageSection${userId}`);

                    if (this.value === 'product') {
                        productSection.style.display = 'block';
                        packageSection.style.display = 'none';
                    } else if (this.value === 'package') {
                        packageSection.style.display = 'block';
                        productSection.style.display = 'none';
                    } else {
                        productSection.style.display = 'none';
                        packageSection.style.display = 'none';
                    }
                });
            });
        });
    </script>

@endsection
