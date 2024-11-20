@extends('admin.app')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sorborno</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Client Review</a></li>
                        <li class="breadcrumb-item active">Client Review!</li>
                    </ol>
                </div>
                <h4 class="page-title">Client Review!</h4>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">

                <div class="d-flex justify-content-end">
                    @can('review-create')
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addNewModalId">Add New</button>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Client Profile</th>
                        <th>Client Name</th>
                        <th>Designation</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($clientReview as $key=>$reviewData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                <img src="{{asset('images/client/'. $reviewData->file )}}" alt="Current Image" style="max-width: 50px; border-radius: 50%;">
                            </td>
                            <td>{{$reviewData->name}}</td>
                            <td>{{$reviewData->designation}}</td>
                            <td>{{$reviewData->message}}</td>
                            <td>{{$reviewData->status==1? 'Active':'Inactive'}}</td>
                            <td style="width: 100px;">
                                <div class="d-flex  gap-1">
                                    @can('review-edit')
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editNewModalId{{$reviewData->id}}">Edit</button>
                                    @endcan

                                    @can('review-delete')
                                    <a href="{{route('review.destroy',$reviewData->id)}}"class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#danger-header-modal{{$reviewData->id}}">Delete</a>
                                    @endcan
                                </div>
                            </td>
                            <div class="modal fade" id="editNewModalId{{$reviewData->id}}" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editNewModalLabel{{$reviewData->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="addNewModalLabel{{$reviewData->id}}">Message</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('review.update',$reviewData->id)}}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Client Name</label>
                                                            <input type="text" id="name" name="name"
                                                                   class="form-control" placeholder="Enter Client Name" value="{{$reviewData->name}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="example-fileinput" class="form-label">Profile</label>
                                                            <input type="file" name="file" id="example-fileinput" class="form-control" >
                                                            <img src="{{asset('images/client/'. $reviewData->file )}}" alt="File or  Image" class="mt-2" style="max-width: 50px;">
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="designation" class="form-label">Designation</label>
                                                            <input type="text" id="designation" name="designation"
                                                                   class="form-control" placeholder="Enter Designation" value="{{$reviewData->designation}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="message" class="form-label">Message</label>
                                                            <textarea id="message" name="message" class="form-control" placeholder="Enter Message">{{$reviewData->message}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="example-select" class="form-label">Status</label>
                                                        <select name="status" class="form-select">
                                                            <option value="1" {{ $reviewData->status === 1 ? 'selected' : '' }}>Active</option>
                                                            <option value="0" {{ $reviewData->status === 0 ? 'selected' : '' }}>Inactive</option>
                                                        </select>
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

                            <!-- Delete Modal -->
                            <div id="danger-header-modal{{$reviewData->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="danger-header-modalLabel{{$reviewData->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header modal-colored-header bg-danger">
                                            <h4 class="modal-title" id="danger-header-modalLabe{{$reviewData->id}}l">Delete</h4>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="mt-0">Are You Went to Delete this ? </h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <a href="{{route('review.destroy',$reviewData->id)}}" class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--Add Modal -->
    <div class="modal fade" id="addNewModalId" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addNewModalLabel">Add</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('review.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Client Name</label>
                                    <input type="text" id="name" name="name"
                                           class="form-control" placeholder="Enter Client Name">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="designation" class="form-label">Designation</label>
                                    <input type="text" id="designation" name="designation"
                                           class="form-control" placeholder="Enter Designation">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="example-fileinput" class="form-label">Profile</label>
                                    <input type="file" name="file" id="example-fileinput" class="form-control">
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea id="message" name="message" class="form-control" placeholder="Enter Message"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
