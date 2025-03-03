@extends('admin.app')
@section('admin_content')
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Sorobonno</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                            <li class="breadcrumb-item active">Welcome!</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Welcome!</h4>
                </div>
            </div>
        </div>

        @can('cart-list')
        <div class="row">
            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat text-bg-pink">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-app-store-line widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Customers">Total App</h6>
                        <h2 class="my-2">10</h2>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat text-bg-purple">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-profile-line widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Customers">Total Website</h6>
                        <h2 class="my-2">10</h2>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat text-bg-info">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-route-line widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Customers">Total News</h6>
                        <h2 class="my-2">10</h2>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat text-bg-primary">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-file-line widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Customers">Total Blog</h6>
                        <h2 class="my-2">10</h2>
                    </div>
                </div>
            </div>
        </div>
        @endcan

        @can('user-dashboard-cart')



        <div class="row">
            <div class="col-xxl-9">
                <div class="row">
                    <div class="col-xxl-4 col-sm-6">
                        <div class="card widget-flat text-bg-purple">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="ri-profile-line widget-icon"></i>
                                </div>
                                <h6 class="text-uppercase mt-0" title="Customers">Total Order</h6>
                                <h2 class="my-2">{{$orders}}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-sm-6">
                        <div class="card widget-flat text-bg-purple">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="ri-profile-line widget-icon"></i>
                                </div>
                                <h6 class="text-uppercase mt-0" title="Customers">Total Active Order</h6>
                                <h2 class="my-2">{{$activeOrder}}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-sm-6">
                        <div class="card widget-flat text-bg-purple">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="ri-app-store-line widget-icon"></i>
                                </div>
                                <h6 class="text-uppercase mt-0" title="Customers">Total Inactive Order</h6>
                                <h2 class="my-2">{{$inactiveOrder}}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-4 col-sm-6">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Your Active Subscriptions:</h4>
                                </div>
                            </div>
                            @foreach($ordersItemAll as $key => $ordersItem)
                                @foreach($ordersItem->orderItems as $item)
                                    <a href="http://127.0.0.1:8000/">
                                        <div class="col-xxl-12 col-sm-6">
                                            <div class="card widget-flat text-bg-primary">
                                                <div class="card-body">
                                                    <h3 class="text-uppercase mt-0" title="Customers">{{$item->name}}</h3>
                                                    <h5 class="my-2">
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
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            @if($user->profile)
                                <img src="{{asset($user? $user->profile:'' )}}" class="rounded-circle avatar-lg" alt="profile-image" style="height: 50px; width: 50px;">
                            @else
                                <div class="avatar-lg rounded-circle bg-primary text-center">
                                    <div class="avatar-title font-22 text-white">
                                        {{Str::limit($user->name,1,'')}}
                                    </div>
                                </div>
                            @endif

                        </div>
                        <h5 class="card-title text-center mt-1">{{$user->name}}</h5>
                        <p class="card-text text-center mt-1">{{$user->email}}</p>
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="header-title">Account Batch</h4>
                            @if($buyOrder>=1 && $buyOrder<=3)
                                <div>
                                    <h6 class="text-center">SILVER</h6>
                                    <img src="{{URL::to('backend/images/si.png')}}" alt="" style="width: 50px;">
                                </div>

                            @elseif($buyOrder>=4 && $buyOrder<=9)
                                <div>
                                    <h6 class="text-center">GOLD</h6>
                                    <img src="{{URL::to('backend/images/go.png')}}" alt="" style="width: 50px;">
                                </div>
                            @elseif($buyOrder>=10)
                                <div>
                                    <h6 class="text-center">PLATINUM</h6>
                                    <img src="{{URL::to('backend/images/pl.png')}}" alt="" style="width: 50px;">
                                </div>
                            @endif
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"> <b>Phone:</b> {{$user->phone}}</li>
                            <li class="list-group-item"> <b>Address:</b> {{$user->address}}</li>
                            <li class="list-group-item"> <b>Country:</b> {{$user->phone}}</li>
                            <li class="list-group-item"> <b>Join As:</b> {{$user->joinCategory->name}}</li>
                            <li class="list-group-item"> <b>Country:</b> {{$user->country->name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @endcan





        @can('login-log-list')
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
                            <th>Email</th>
                            <th>IP</th>
                            <th>Browser</th>
                            <th>Platform</th>
                            <th>Last Login</th>
                            <th>User Agent</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($loginLog as $key=>$loginLogData)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$loginLogData->email}}</td>
                                <td>{{$loginLogData->ip}}</td>
                                <td>{{$loginLogData->browser}}</td>
                                <td>{{$loginLogData->platform}}</td>
                                <td>{{$loginLogData->last_login}}
                                <td>{{$loginLogData->user_agent}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endcan
@endsection
