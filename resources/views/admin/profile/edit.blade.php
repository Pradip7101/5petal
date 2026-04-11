@extends('admin.admin_layouts.admin_app')
@section('content')
<div class="content-wrapper">
    <div class="content-margin">
        <div class="dashboard_heading flex-css">
            <div class="name">
                <h2 class="m-0">Edit Profile</h2>
            </div>
            <div class="list_links">
                <ul class="p-0 flex-css">
                    <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li>/</li>
                    <li class="active">Edit Profile</li>
                </ul>
            </div>
        </div>
        <section class="dashboard_box dashboard_padding">
            <div class="border-box profile_edit">
                @if(session('success'))
                    <div id="success-alert">
                        <div class="alert alert-success mb-2">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
                <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div>
                                @if($admin->profile_image && file_exists(public_path('admin_assets/uploads/' . $admin->profile_image)))
                                    <div id="image-preview" class="mb-4 profile_image_box" style="display: block;">
                                        <img id="preview-img" src="{{ asset('admin_assets/uploads/' . $admin->profile_image) }}" alt="Profile Image" class="img-thumbnail">
                                    </div>
                                @else
                                    <div id="image-preview" class="mb-4 profile_image_box" style="display: none;">
                                        <img id="preview-img" src="" alt="Default Profile Image" class="img-thumbnail">
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="image">Profile Image</label>
                                <div>
                                    <label for="upload_image" class="custom-file-upload form-control">
                                        Upload Your Image 
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 448 512"><path d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3 192 320c0 17.7 14.3 32 32 32s32-14.3 32-32l0-210.7 73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-64z"/></svg>
                                        </span>
                                    </label>
                                    <input id="upload_image" type="file" name="profile_image" accept="image/*" class="form-control @error('profile_image') is-invalid @enderror" style="display: none">
                                    @error('profile_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ old('name', $admin->name) }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email address" value="{{ old('email', $admin->email) }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="submit_btn">Update Profile</button>
                        <a href="{{ url()->previous() }}" class="back_btn" style="margin-left: 10px;">
                            {{ __('Back') }}
                        </a>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection
