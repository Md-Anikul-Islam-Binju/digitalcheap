@extends('admin.app')
@section('admin_content')
    {{-- CKEditor CDN --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Order Manage </a></li>
                        <li class="breadcrumb-item active">Order Manage!</li>
                    </ol>
                </div>
                <h4 class="page-title">Order Manage!</h4>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
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
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $key => $order)
                        @foreach($order->orderItems as $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->type=='product'? 'Product' : 'Package'}}</td>
                                <td>{{$item->name}}</td>
                                <td>
                                    @if($item->type=='product')
                                        {{$item->duration}} Month
                                    @else
                                        @if($item->duration == 'Monthly')
                                            {{$item->duration}}
                                        @elseif($item->duration == 'Half Yearly')
                                            {{$item->duration}}
                                        @elseif($item->duration == 'Yearly')
                                            {{$item->duration}}
                                        @endif
                                    @endif
                                </td>
                                <td>{{$item->device_access}}</td>
                                <td>
                                    @if($item->type=='product')
                                        {{$item->is_free_or_paid=='paid'? 'Paid' : 'Free'}}
                                    @else
                                        @if($item->is_free_or_paid == 'buy')
                                            Paid
                                        @elseif($item->is_free_or_paid == 'free')
                                            Free
                                        @endif
                                    @endif

                                </td>
                                <td>{{$item->price}}</td>
                                @if($item->type=='product')
                                    <td>{{$item->price * $item->duration}}</td>
                                @else
                                    @if($item->duration == 'Monthly')
                                        <td>{{$item->price * 1}}</td>
                                    @elseif($item->duration == 'Half Yearly')
                                        <td>{{$item->price * 6}}</td>
                                    @elseif($item->duration == 'Yearly')
                                        <td>{{$item->price * 12}}</td>
                                    @endif
                                @endif
                                <td>
                                    <a href="{{route('order.invoice.manage', $order->id)}}" class="btn btn-primary btn-sm">Invoice</a>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
