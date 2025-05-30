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
                <div class="col-2">
                {{--Order filter--}}
                    <form action="{{ route('order.list') }}" method="get">
                        <div class="col-12">
                            <label for="example-select" class="form-label">Status</label>
                            <select name="created_at" class="form-select">
                                <option value="today">Today</option>
                                <option value="week">This Week</option>
                                <option value="month">This Month</option>
                                <option value="year">This Year</option>
                            </select><br>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>

                    </form>

                </div>

            </div>
            <div class="card-body">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Invoice No</th>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Duration</th>
                        <th>Device Access</th>
                        <th>Free Or Paid</th>
                        <th>Product Price</th>
                        <th>is Coupon</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $key => $order)
                        @foreach($order->orderItems as $item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$order->invoice_no}}</td>
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
                            @php
                                $coupon  = DB::table('coupons')->where('coupon_code', $order->coupon_code)->first();
                            @endphp

                            <td>
                                @if($order->coupon_code==null)
                                    No
                                @else
                                    Yes ({{$coupon->discount_amount}} Tk)
                                @endif
                            </td>

{{--                            @if($item->type=='product')--}}
{{--                                <td>{{$item->price * $item->duration}}</td>--}}
{{--                            @else--}}
{{--                                @if($item->duration == 'Monthly')--}}
{{--                                    <td>{{$item->price * 1}}</td>--}}
{{--                                @elseif($item->duration == 'Half Yearly')--}}
{{--                                    <td>{{$item->price * 6}}</td>--}}
{{--                                @elseif($item->duration == 'Yearly')--}}
{{--                                    <td>{{$item->price * 12}}</td>--}}
{{--                                @endif--}}
{{--                            @endif--}}

                            @if($item->type=='product')
                                @if($order->coupon_code)
                                    <td>{{$item->price * $item->duration - $coupon->discount_amount}}</td>
                                @else
                                    <td>{{$item->price * $item->duration}}</td>
                                @endif

                            @else
                                @if($order->coupon_code)
                                    @if($item->duration == 'Monthly')
                                        <td>{{$item->price * 1 - $coupon->discount_amount}}</td>
                                    @elseif($item->duration == 'Half Yearly')
                                        <td>{{$item->price * 6 - $coupon->discount_amount}}</td>
                                    @elseif($item->duration == 'Yearly')
                                        <td>{{$item->price * 12 - $coupon->discount_amount}}</td>
                                    @endif
                                @else
                                    @if($item->duration == 'Monthly')
                                        <td>{{$item->price * 1}}</td>
                                    @elseif($item->duration == 'Half Yearly')
                                        <td>{{$item->price * 6}}</td>
                                    @elseif($item->duration == 'Yearly')
                                        <td>{{$item->price * 12}}</td>
                                    @endif
                                @endif
                            @endif
                            <td>Approved</td>
                            <td>
                                <a href="{{route('order.invoice', $order->id)}}" class="btn btn-primary btn-sm">Invoice</a>
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
