@extends('admin.app')
@section('admin_content')
    {{-- CKEditor CDN --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">My User</a></li>
                        <li class="breadcrumb-item active">My User!</li>
                    </ol>
                </div>
                <h4 class="page-title">My User!</h4>
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
                        <th>Total Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $key => $order)
                        @php
                            $orderAmount = $order->total - $coupon->discount_amount;
                            $totalAmount += $orderAmount;
                        @endphp
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$order->user->name}}</td>
                            <td>{{$order->user->email}}</td>
                            <td>{{$order->user->phone}}</td>
                            <td>{{$order->user->address}}</td>
                            <td>{{$order->total - $coupon->discount_amount}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <tfoot>
                <tr>
                    <td colspan="5" class="text-end fw-bold">Total Commission ({{$commissionPercent}}%):</td>
                    <td class="fw-bold">৳ {{ number_format(($totalAmount * $commissionPercent) / 100, 2) }}</td>
                </tr>
                </tfoot>
            </div>
        </div>
    </div>

@endsection
