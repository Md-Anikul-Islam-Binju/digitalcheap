@extends('admin.app')
@section('admin_content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/dashboard">Digital Cheap</a></li>
                                <li class="breadcrumb-item active">Account Setting</li>
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

                        <div class="card-body">
                            <form action="{{route('account.settings.create.update.agent',$user ? $user->id : null)}}" method="post" enctype="multipart/form-data">
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
                            <h4 class="header-title">Agent Code</h4>
                        </div>

                    </div>
                </div>
            </div>






        </div>
    </div>

@endsection
