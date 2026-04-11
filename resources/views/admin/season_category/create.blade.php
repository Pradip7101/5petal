@extends('admin.admin_layouts.admin_app')

@section('content')
<div class="content-wrapper">
    <div class="content-margin">
        <div class="dashboard_heading flex-css">
            <div class="name">
                <h2 class="m-0">Add New Season Category</h2>
            </div>
            <div class="list_links">
                <ul class="p-0 flex-css">
                    <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li>/</li>
                    <li><a href="{{ route('admin.season-category.index') }}">Season Category Management</a></li>
                    <li>/</li>
                    <li class="active">Add New Season Category</li>
                </ul>
            </div>
        </div>
        <section class="dashboard_box dashboard_padding">
            <div class="border-box profile_edit">
                <form method="POST" action="{{ route('admin.season-category.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div>
                                <div id="image-preview" class="mb-4 profile_image_box" style="display: none;">
                                    <img id="preview-img" src="" class="img-thumbnail" alt="Image Preview" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <div>
                                    <label for="upload_image" class="custom-file-upload form-control">
                                        Upload Your Image 
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 448 512"><path d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3 192 320c0 17.7 14.3 32 32 32s32-14.3 32-32l0-210.7 73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-64z"/></svg>
                                        </span>
                                    </label>
                                    <input id="upload_image" type="file" name="image" accept="image/*" class="form-control @error('image') is-invalid @enderror" style="display: none">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <div id="image-preview2" class="mb-4 profile_image_box" style="display: none;">
                                    <img id="preview-img2" src="" class="img-thumbnail" alt="Image Preview" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image">Banner Image</label>
                                <div>
                                    <label for="upload_image2" class="custom-file-upload form-control">
                                        Upload Your Banner Image 
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 448 512"><path d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3 192 320c0 17.7 14.3 32 32 32s32-14.3 32-32l0-210.7 73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-64z"/></svg>
                                        </span>
                                    </label>
                                    <input id="upload_image2" name="banner_image" type="file" accept="image/*" class="form-control @error('banner_image') is-invalid @enderror" style="display: none">
                                    @error('banner_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Title" value="{{ old('title') }}">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-text @error('description') is-invalid @enderror" name="description" rows="3">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="submit_btn">Add Season Category</button>
                    <a href="{{ url()->previous() }}" class="back_btn" style="margin-left: 10px;">
                        {{ __('Back') }}
                    </a>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection
