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
                                <li class="breadcrumb-item active">Form Elements</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Site Setting</h4>
                    </div>
                </div>
            </div>
            <!-- Form row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="header-title">Form</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('site-settings.createOrUpdate',$siteSettings ? $siteSettings->id : null)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-2">
                                    <div class="mb-3 col-md-4">
                                        <label for="name" class="form-label">Site Name</label>
                                        <input type="text" class="form-control" name="name" value="{{$siteSettings?$siteSettings->name:''}}"
                                               placeholder="Enter Name">
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label for="name" class="form-label">Site Title</label>
                                        <input type="text" class="form-control" name="title" value="{{$siteSettings?$siteSettings->title:''}}"
                                               placeholder="Enter Name">
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label for="logo" class="form-label">Site Preview Image</label>
                                        <input type="file" class="form-control" name="site_preview_image" value="{{$siteSettings?$siteSettings->site_preview_image:''}}"
                                               placeholder="Enter Logo">
                                        @if($siteSettings? $siteSettings->site_preview_image:'')
                                            <img src="{{asset($siteSettings? $siteSettings->site_preview_image:'' )}}" alt="Current Image" class="mt-2" style="max-width: 50px;">
                                        @endif
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label for="logo" class="form-label">Logo</label>
                                        <input type="file" class="form-control" name="logo" value="{{$siteSettings?$siteSettings->logo:''}}"
                                               placeholder="Enter Logo">
                                        @if($siteSettings? $siteSettings->logo:'')
                                            <img src="{{asset($siteSettings?$siteSettings->logo:'')}}" alt="Current Image" class="mt-2" style="max-width: 50px;">
                                        @endif
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="favicon" class="form-label">Favicon</label>
                                        <input type="file" class="form-control" name="favicon" value="{{$siteSettings?$siteSettings->favicon:''}}"
                                               placeholder="Favicon">
                                        @if($siteSettings?$siteSettings->favicon:'')
                                            <img src="{{asset($siteSettings?$siteSettings->favicon:'')}}" alt="Current Image" class="mt-2" style="max-width: 50px;">
                                        @endif
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="number" class="form-control" name="phone" value="{{$siteSettings?$siteSettings->phone:''}}"
                                               placeholder="Password">
                                    </div>
                                </div>

                                <div class="row g-2">
                                    <div class="mb-3 col-md-4">
                                        <label for="inputEmail4" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{$siteSettings?$siteSettings->email:''}}"
                                               placeholder="Enter Email">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" name="address" value="{{$siteSettings?$siteSettings->address:''}}"
                                               placeholder="Enter Address">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="short_description" class="form-label">Short Description</label>
                                        <input type="text" class="form-control" name="short_description" value="{{$siteSettings?$siteSettings->short_description:''}}"
                                               placeholder="Short Description">
                                    </div>
                                </div>

                                <div class="row g-2">
                                    <div class="mb-3 col-md-4">
                                        <label for="site_link" class="form-label">Website Link</label>
                                        <input type="text" class="form-control" name="site_link" value="{{$siteSettings?$siteSettings->site_link:''}}"
                                               placeholder="Enter Link">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="inputPassword4" class="form-label">Facebook Link</label>
                                        <input type="text" class="form-control" name="facebook_link" value="{{$siteSettings?$siteSettings->facebook_link:''}}"
                                               placeholder="Facebook Link">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="twitter_link" class="form-label">Twitter Link</label>
                                        <input type="text" class="form-control" name="twitter_link" value="{{$siteSettings?$siteSettings->twitter_link:''}}"
                                               placeholder="Twitter Link">
                                    </div>
                                </div>

                                <div class="row g-2">
                                    <div class="mb-3 col-md-4">
                                        <label for="instagram_link" class="form-label">Instagram Link</label>
                                        <input type="text" class="form-control" name="instagram_link" value="{{$siteSettings?$siteSettings->instagram_link:''}}"
                                               placeholder="Instagram Link">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="youtube_link" class="form-label">Youtube Link</label>
                                                <input type="text" class="form-control" name="youtube_link" value="{{$siteSettings?$siteSettings->youtube_link:''}}"
                                               placeholder="Youtube Link">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="linkedin_link" class="form-label">Linkedin Link</label>
                                        <input type="text" class="form-control" name="linkedin_link" value="{{$siteSettings?$siteSettings->linkedin_link:''}}"
                                               placeholder="Linkedin Link">
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <label for="pinterest_link" class="form-label">Pinterest Link</label>
                                        <input type="text" class="form-control" name="pinterest_link" value="{{$siteSettings?$siteSettings->pinterest_link:''}}"
                                               placeholder="Pinterest Link">
                                    </div>

                                    <div class="mb-3 col-md-12">
                                        <label for="linkedin_link" class="form-label">Meta Description</label>
                                        <textarea class="form-control" name="short_description" rows="5" placeholder="Enter the Description">{{ strip_tags($siteSettings?$siteSettings->short_description:'') }}</textarea>
                                    </div>


                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label>How To Use</label>
                                            <textarea id="summernoteEdit{{ $siteSettings ? $siteSettings->id : '' }}" name="how_to_use">{{ $siteSettings ? $siteSettings->how_to_use : '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label>How To Access</label>
                                            <textarea id="summernoteEdit{{ $siteSettings ? $siteSettings->id : '' }}" name="how_to_access">{{ $siteSettings ? $siteSettings->how_to_access : '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="how_to_use_link" class="form-label">How To Use Youtube Link</label>
                                        <input type="text" class="form-control" name="how_to_use_link" value="{{$siteSettings?$siteSettings->how_to_use_link:''}}"
                                               placeholder="How To Use Youtube Link">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="how_to_access_link" class="form-label">How To Access Youtube Link</label>
                                        <input type="text" class="form-control" name="how_to_access_link" value="{{$siteSettings?$siteSettings->how_to_access_link:''}}"
                                               placeholder="How To Access Youtube Link">
                                    </div>

                                    <div class="mb-3 col-md-12">
                                        <label for="how_to_join_become_affiliate_link" class="form-label">How To Join Become Affiliate Youtube Link</label>
                                        <input type="text" class="form-control" name="how_to_join_become_affiliate_link" value="{{$siteSettings?$siteSettings->how_to_join_become_affiliate_link	:''}}"
                                               placeholder="How To Join Become Affiliate Youtube Link">
                                    </div>



                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label>How To Join Become Affiliate</label>
                                            <textarea id="summernoteEdit{{ $siteSettings ? $siteSettings->id : '' }}" name="how_to_join_become_affiliate">{{ $siteSettings ? $siteSettings->how_to_join_become_affiliate : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>





                                <h5 style="color: red">For Home Page SEO</h5>
                                <div class="row g-2">
                                    <div class="mb-3 col-md-6">
                                        <label for="meta_title_for_home" class="form-label">Meta Title</label>
                                        <input type="text" class="form-control" name="meta_title_for_home" value="{{$siteSettings?$siteSettings->meta_title_for_home:''}}"
                                               placeholder="Meta Title">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="meta_keywords_for_home" class="form-label">Meta Keywords</label>
                                        <input type="text" class="form-control" name="meta_keywords_for_home" value="{{$siteSettings?$siteSettings->meta_keywords_for_home:''}}"
                                               placeholder="Meta Keywords">
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label>Meta Description</label>
                                            <textarea id="summernoteEdit{{ $siteSettings ? $siteSettings->id : '' }}" name="meta_description_for_home">{{ $siteSettings ? $siteSettings->meta_description_for_home : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <h5 style="color: red">For About Page SEO</h5>
                                <div class="row g-2">
                                    <div class="mb-3 col-md-6">
                                        <label for="meta_title_for_about" class="form-label">Meta Title</label>
                                        <input type="text" class="form-control" name="meta_title_for_about" value="{{$siteSettings?$siteSettings->meta_title_for_about:''}}"
                                               placeholder="Meta Title">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="meta_keywords_for_about" class="form-label">Meta Keywords</label>
                                        <input type="text" class="form-control" name="meta_keywords_for_about" value="{{$siteSettings?$siteSettings->meta_keywords_for_about:''}}"
                                               placeholder="Meta Keywords">
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label>Meta Description</label>
                                            <textarea id="summernoteEdit{{ $siteSettings ? $siteSettings->id : '' }}" name="meta_description_for_about">{{ $siteSettings ? $siteSettings->meta_description_for_about : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <h5 style="color: red">For Blog Page SEO</h5>
                                <div class="row g-2">
                                    <div class="mb-3 col-md-6">
                                        <label for="meta_title_for_blog" class="form-label">Meta Title</label>
                                        <input type="text" class="form-control" name="meta_title_for_blog" value="{{$siteSettings?$siteSettings->meta_title_for_blog:''}}"
                                               placeholder="Meta Title">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="meta_keywords_for_blog" class="form-label">Meta Keywords</label>
                                        <input type="text" class="form-control" name="meta_keywords_for_blog" value="{{$siteSettings?$siteSettings->meta_keywords_for_blog:''}}"
                                               placeholder="Meta Keywords">
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label>Meta Description</label>
                                            <textarea id="summernoteEdit{{ $siteSettings ? $siteSettings->id : '' }}" name="meta_description_for_blog">{{ $siteSettings ? $siteSettings->meta_description_for_blog : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <h5 style="color: red">For Product Page SEO</h5>
                                <div class="row g-2">
                                    <div class="mb-3 col-md-6">
                                        <label for="meta_title_for_product" class="form-label">Meta Title</label>
                                        <input type="text" class="form-control" name="meta_title_for_product" value="{{$siteSettings?$siteSettings->meta_title_for_product:''}}"
                                               placeholder="Meta Title">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="meta_keywords_for_product" class="form-label">Meta Keywords</label>
                                        <input type="text" class="form-control" name="meta_keywords_for_product" value="{{$siteSettings?$siteSettings->meta_keywords_for_product:''}}"
                                               placeholder="Meta Keywords">
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label>Meta Description</label>
                                            <textarea id="summernoteEdit{{ $siteSettings ? $siteSettings->id : '' }}" name="meta_description_for_product">{{ $siteSettings ? $siteSettings->meta_description_for_product : '' }}</textarea>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-12">
                                        <label for="extension_file" class="form-label">Extension</label>
                                        <input type="file" class="form-control" name="extension_file" value="{{$siteSettings?$siteSettings->extension_file:''}}"
                                               >
                                        @if($siteSettings?$siteSettings->extension_file:'')
                                            <a href="{{asset($siteSettings?$siteSettings->extension_file:'')}}" target="_blank" class="mt-2">Download</a>
                                        @endif
                                    </div>
                                </div>






                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
