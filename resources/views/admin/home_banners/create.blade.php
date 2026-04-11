@extends('admin.admin_layouts.admin_app')

@section('content')
<div class="content-wrapper">
    <div class="content-margin">
        <div class="dashboard_heading flex-css">
            <div class="name">
                <h2 class="m-0">Add New Home Banner</h2>
            </div>
            <div class="list_links">
                <ul class="p-0 flex-css">
                    <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li>/</li>
                    <li><a href="{{ route('admin.home-banners.index') }}">Home Banner Management</a></li>
                    <li>/</li>
                    <li class="active">Add New Home Banner</li>
                </ul>
            </div>
        </div>
        <section class="dashboard_box dashboard_padding">
            <div class="border-box profile_edit">
                <form method="POST" action="{{ route('admin.home-banners.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div>
                                <div id="image-preview" class="mb-4 profile_image_box">
                                    <img id="preview-img" src="" alt="Image Preview" />
                                    <button type="button" >
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="14" height="14"><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Image</label>
                                <!-- <input type="file" class="form-control @error('banner_image') is-invalid @enderror" name="banner_image"> -->
                                <div>
                                    <label for="profile_image" class="custom-file-upload form-control">
                                        <input id="profile_image" type="file" accept="image/*" class="form-control" style="display: none">
                                        Upload Your Image 
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 448 512"><path d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3 192 320c0 17.7 14.3 32 32 32s32-14.3 32-32l0-210.7 73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-64z"/></svg>
                                        </span>
                                    </label>
                                </div>
                                @error('banner_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control @error('banner_title') is-invalid @enderror" name="banner_title" placeholder="Title" value="{{ old('banner_title') }}">
                                @error('banner_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Button Text</label>
                                <input type="text" class="form-control @error('banner_button_text') is-invalid @enderror" name="banner_button_text" placeholder="Button Text" value="{{ old('banner_button_text') }}">
                                @error('banner_button_text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Button Link</label>
                                <input type="url" class="form-control @error('banner_button_link') is-invalid @enderror" name="banner_button_link" placeholder="Button Link" value="{{ old('banner_button_link') }}">
                                @error('banner_button_link')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-text @error('banner_description') is-invalid @enderror" name="banner_description" rows="3">{{ old('banner_description') }}</textarea>
                                @error('banner_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="submit_btn">Add Home Banner</button>
                    <a href="{{ url()->previous() }}" class="back_btn" style="margin-left: 10px;">
                        {{ __('Back') }}
                    </a>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection
