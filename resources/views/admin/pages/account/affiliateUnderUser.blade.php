@extends('admin.app')

@section('admin_content')
    {{-- CKEditor CDN --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">My Affiliate User</a></li>
                        <li class="breadcrumb-item active">My Affiliate User!</li>
                    </ol>
                </div>
                <h4 class="page-title">My Affiliate!</h4>
            </div>
        </div>
    </div>


    @can('user-dashboard-cart')
        <div class="row">
            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat text-bg-pink">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-app-store-line widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Customers">Total Referrals</h6>
                        <h2 class="my-2">{{$totalClient}}</h2>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat text-bg-success">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-app-store-line widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Customers">Total Paid Referrals</h6>
                        <h2 class="my-2">{{$totalClient}}</h2>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat text-bg-danger">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-app-store-line widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Customers">Total Unpaid Referrals</h6>
                        <h2 class="my-2">{{$totalClient}}</h2>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-sm-6">
                <div class="card widget-flat text-bg-dark">
                    <div class="card-body">
                        <div class="float-end">
                            <i class="ri-route-line widget-icon"></i>
                        </div>
                        <h6 class="text-uppercase mt-0" title="Customers">Total Point</h6>
                        <h2 class="my-2">{{$totalClient*100}}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Affiliate Join Registration Link</label>
                            <div class="d-flex align-items-center">
                                <input type="text" class="form-control" value="{{ url('/account-registration-for-user?code=' . $user->user_name) }}" id="referralLink" readonly>
                                <button type="button" class="btn btn-info ms-2" onclick="copyReferralLink()">Copy</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan

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
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $usersData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$usersData->name}}</td>
                            <td>{{$usersData->email}}</td>
                            <td>{{$usersData->phone}}</td>
                            <td>{{$usersData->address}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function copyReferralLink() {
            // Get the text field
            var copyText = document.getElementById("referralLink");

            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            document.execCommand("copy");

            // Alert the user that the text has been copied
            alert("Referral link copied to clipboard: " + copyText.value);
        }
    </script>
@endsection
