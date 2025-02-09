@extends('admin.app')

@section('admin_content')
    {{-- CKEditor CDN --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Order</a></li>
                        <li class="breadcrumb-item active">Order!</li>
                    </ol>
                </div>
                <h4 class="page-title">Order!</h4>
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
                        <th>Type</th>
                        <th>Name</th>
                        <th>Duration</th>
                        <th>Device Access</th>
                        <th>Free Or Paid</th>
                        <th>Product Price</th>
                        <th>Total Price</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $key => $order)
                        @foreach($order->orderItems as $item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->type=='product'? 'Product' : 'Package'}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->duration}}</td>
                            <td>{{$item->device_access}}</td>
                            <td>{{$item->type=='paid'? 'Paid' : 'Free'}}</td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->price * $item->duration}}</td>
                            <td>Approved</td>
                        </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
