@extends('admin.app')
@section('admin_content')
    {{-- CKEditor CDN --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sorobonno</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sorobonno</a></li>
                        <li class="breadcrumb-item active">Coupon!</li>
                    </ol>
                </div>
                <h4 class="page-title">Coupon!</h4>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                    <!-- Large modal -->
                    @can('coupon-create')
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addNewModalId">Add New</button>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Coupon Code</th>
                        <th>Discount Amount</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Use Limit</th>
                        <th>Minimum Expend</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($coupon as $key=>$couponData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$couponData->coupon_code}}</td>
                            <td>{{$couponData->discount_amount}}</td>
                            <td>{{$couponData->start_date}}</td>
                            <td>{{$couponData->end_date}}</td>
                            <td>{{$couponData->use_limit}}</td>
                            <td>{{$couponData->amount_spend}}</td>
                            <td>{{$couponData->status==1? 'Active':'Inactive'}}</td>
                            <td style="width: 100px;">
                                <div class="d-flex justify-content-end gap-1">
                                    @can('coupon-edit')
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editNewModalId{{$couponData->id}}">Edit</button>
                                    @endcan
                                    @can('coupon-delete')
                                        <a href="{{route('coupon.destroy',$couponData->id)}}"class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#danger-header-modal{{$couponData->id}}">Delete</a>
                                    @endcan
                                </div>
                            </td>
                            <!--Edit Modal -->
                            <div class="modal fade" id="editNewModalId{{$couponData->id}}" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editNewModalLabel{{$couponData->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="addNewModalLabel{{$couponData->id}}">Edit</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('coupon.update',$couponData->id)}}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="coupon_code" class="form-label">Coupon Code</label>
                                                            <input type="text" id="coupon_code" name="coupon_code" value="{{$couponData->coupon_code}}"
                                                                   class="form-control" placeholder="Enter Coupon Code" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="discount_amount" class="form-label">Discount Amount</label>
                                                            <input type="text" id="discount_amount" name="discount_amount" value="{{$couponData->discount_amount}}"
                                                                   class="form-control" placeholder="Enter Discount Amount" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="start_date" class="form-label">Start Date</label>
                                                            <input type="date" id="start_date" name="start_date" value="{{$couponData->start_date}}"
                                                                   class="form-control" placeholder="Enter Start Date" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="end_date" class="form-label">End Date</label>
                                                            <input type="date" id="end_date" name="end_date" value="{{$couponData->end_date}}"
                                                                   class="form-control" placeholder="Enter End Date" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="use_limit" class="form-label">Use Limit</label>
                                                            <input type="number" id="use_limit" name="use_limit" value="{{$couponData->use_limit}}"
                                                                   class="form-control" placeholder="Enter Use Limit" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="amount_spend" class="form-label">Minimum Expend</label>
                                                            <input type="number" id="amount_spend" name="amount_spend" value="{{$couponData->amount_spend}}"
                                                                   class="form-control" placeholder="Enter Minimum Expend" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="example-select" class="form-label">Status</label>
                                                            <select name="status" class="form-select">
                                                                <option value="1" {{ $couponData->status === 1 ? 'selected' : '' }}>Active</option>
                                                                <option value="0" {{ $couponData->status === 0 ? 'selected' : '' }}>Inactive</option>
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
                            <!-- Delete Modal -->
                            <div id="danger-header-modal{{$couponData->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="danger-header-modalLabel{{$couponData->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header modal-colored-header bg-danger">
                                            <h4 class="modal-title" id="danger-header-modalLabe{{$couponData->id}}l">Delete</h4>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="mt-0">Are You Went to Delete this ? </h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <a href="{{route('coupon.destroy',$couponData->id)}}" class="btn btn-danger">Delete</a>
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
                    <form method="post" action="{{route('coupon.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="coupon_code" class="form-label">Coupon Code</label>
                                    <input type="text" id="coupon_code" name="coupon_code"
                                           class="form-control" placeholder="Enter Coupon Code" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="discount_amount" class="form-label">Discount Amount</label>
                                    <input type="text" id="discount_amount" name="discount_amount"
                                           class="form-control" placeholder="Enter Discount Amount" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="date" id="start_date" name="start_date"
                                           class="form-control" placeholder="Enter Start Date" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="date" id="end_date" name="end_date"
                                           class="form-control" placeholder="Enter End Date" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="use_limit" class="form-label">Use Limit</label>
                                    <input type="number" id="use_limit" name="use_limit"
                                           class="form-control" placeholder="Enter Use Limit" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="amount_spend" class="form-label">Minimum Expend</label>
                                    <input type="number" id="amount_spend" name="amount_spend"
                                           class="form-control" placeholder="Enter Minimum Expend" required>
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
