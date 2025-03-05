@extends('admin.app')
@section('admin_content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/dashboard">Sorborno</a></li>
                                <li class="breadcrumb-item active">Sorborno</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Account Setting</h4>
                    </div>
                </div>
            </div>
            <!-- Form row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="header-title">Account Information</h4>
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

                        <div class="card-body">
                            <form action="{{route('account.settings.create.update',$user ? $user->id : null)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-2">
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" value="{{$user?$user->name:''}}"
                                               placeholder="Enter Name English">
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{$user?$user->email:''}}"
                                               placeholder="Enter Email">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Phone</label>
                                        <input type="text" class="form-control" name="phone" value="{{$user?$user->phone:''}}"
                                               placeholder="Enter Phone">
                                    </div>


                                    <div class="mb-3 col-md-4">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-control" name="address" value="{{$user?$user->address:''}}"
                                               placeholder="Enter Address (En)">
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label for="profile" class="form-label">Profile Image</label>
                                        <input type="file" class="form-control" name="profile" value="{{$user?$user->profile:''}}"
                                               placeholder="Enter Logo">
                                        @if($user? $user->profile:'')
                                            <img src="{{asset($user? $user->profile:'' )}}" alt="Current Image" class="mt-2" style="max-width: 50px;">
                                        @endif
                                    </div>


                                    <div class="mb-3 col-md-4">
                                        <label for="join_category_id" class="form-label text-capitalize">Join Category</label>
                                        <select name="join_category_id" class="form-select">
                                            <option value="">Select Category</option>
                                            @foreach($joinCategory as $category)
                                                <option value="{{$category->id}}" {{ $user && $user->join_category_id == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label for="country_id" class="form-label text-capitalize">Country</label>
                                        <select name="country_id" class="form-select">
                                            <option value="">Select Country</option>
                                            @foreach($countryAll as $country)
                                                <option value="{{$country->id}}" {{ $user && $user->country_id == $country->id ? 'selected' : '' }}>{{$country->iso}} - {{$country->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>


                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="header-title">Affiliate Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Registration Link</label>
                                <div class="d-flex align-items-center">
                                    <input type="text" class="form-control" value="{{ url('/account-registration-for-user?code=' . $user->user_name) }}" id="referralLink" readonly>
                                    <button type="button" class="btn btn-info ms-2" onclick="copyReferralLink()">Copy</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
