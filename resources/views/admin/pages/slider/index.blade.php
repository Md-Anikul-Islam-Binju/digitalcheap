@extends('admin.app')
@section('admin_content')
    {{-- CKEditor CDN --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sorobonno</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Slider</a></li>
                        <li class="breadcrumb-item active">Slider!</li>
                    </ol>
                </div>
                <h4 class="page-title">Slider!</h4>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    <!-- Large modal -->
                    @can('slider-create')
                     <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addNewModalId">Add New</button>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Title</th>
                        <th>File</th>
                        <th>Link</th>
                        <th>Details</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($slider as $key=>$sliderData)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$sliderData->title}}</td>
                        <td>
                            <img src="{{asset('images/slider/'. $sliderData->file )}}" alt="Current Image" style="max-width: 50px;">
                        </td>
                        <td>{{$sliderData->link}}</td>
                        <td>{!! Str::limit($sliderData->details, 30) !!}</td>
                        <td>{{$sliderData->status==1? 'Active':'Inactive'}}</td>
                        <td style="width: 100px;">
                            <div class="d-flex justify-content-end gap-1">
                                @can('slider-edit')
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editNewModalId{{$sliderData->id}}">Edit</button>
                                @endcan
                                @can('slider-delete')
                                    <a href="{{route('slider.destroy',$sliderData->id)}}"class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#danger-header-modal{{$sliderData->id}}">Delete</a>
                                @endcan
                            </div>
                        </td>
                        <!--Edit Modal -->
                        <div class="modal fade" id="editNewModalId{{$sliderData->id}}" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editNewModalLabel{{$sliderData->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="addNewModalLabel{{$sliderData->id}}">Edit</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{route('slider.update',$sliderData->id)}}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="title" class="form-label">Title</label>
                                                        <input type="text" id="title" name="title" value="{{$sliderData->title}}"
                                                               class="form-control" placeholder="Enter Title" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="example-fileinput" class="form-label">File (Banner Size 3000 * 2000 )</label>
                                                        <input type="file" name="file" id="example-fileinput" class="form-control" >
                                                        <img src="{{asset('images/slider/'. $sliderData->file )}}" alt="File or  Image" class="mt-2" style="max-width: 50px;">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="example-select" class="form-label">Status</label>
                                                        <select name="status" class="form-select">
                                                            <option value="1" {{ $sliderData->status === 1 ? 'selected' : '' }}>Active</option>
                                                            <option value="0" {{ $sliderData->status === 0 ? 'selected' : '' }}>Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="example-fileinput" class="form-label">Link</label>
                                                        <input type="text" name="link" id="example-fileinput" class="form-control" value="{{$sliderData->link}}" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label>Details  </label>
                                                        <textarea id="summernoteEdit{{ $sliderData->id }}" name="details">{{ $sliderData->details }}</textarea>
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
                        <!-- Delete Modal -->
                        <div id="danger-header-modal{{$sliderData->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="danger-header-modalLabel{{$sliderData->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-danger">
                                        <h4 class="modal-title" id="danger-header-modalLabe{{$sliderData->id}}l">Delete</h4>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h5 class="mt-0">Are You Went to Delete this ? </h5>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <a href="{{route('slider.destroy',$sliderData->id)}}" class="btn btn-danger">Delete</a>
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
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addNewModalLabel">Add</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('slider.store')}}" enctype="multipart/form-data" id="more_info_add">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title </label>
                                    <input type="text" id="title" name="title"
                                           class="form-control" placeholder="Enter Title">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="example-fileinput" class="form-label">File (Banner Size 3000 * 2000 )</label>
                                    <input type="file" name="file" id="example-fileinput" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="example-fileinput" class="form-label">Link</label>
                                    <input type="text" name="link" id="example-fileinput" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label> Details </label>
                                    <textarea id="summernoteBn" name="details"></textarea>
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
