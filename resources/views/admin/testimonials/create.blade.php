@extends('admin.admin_layouts.admin_app')
@section('content')
<div class="content-wrapper">
    <div class="content-margin">
        <div class="dashboard_heading flex-css">
            <div class="name">
                <h2 class="m-0">Add New Testimonial</h2>
            </div>
            <div class="list_links">
                <ul class="p-0 flex-css">
                    <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li>/</li>
                    <li><a href="{{ route('admin.testimonials.index') }}">Testimonials</a></li>
                    <li>/</li>
                    <li class="active">Add New</li>
                </ul>
            </div>
        </div>
        <section class="dashboard_box users_edit product_create">
            <div class="border-box">
                <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header justify-content-start">
                        <h2>Testimonial Details</h2>
                    </div>
                    <div class="card-body card-padding">
                        <div class="form-group">
                            <div id="image-preview" class="mb-4 profile_image_box" style="display: none;">
                                <img id="preview-img" src="" class="img-thumbnail" alt="Image Preview" />
                            </div>
                            <label for="image" class="form-label">Image</label>
                            <div>
                                <label for="upload_image" class="custom-file-upload form-control">
                                    Upload Your Image
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 448 512"><path d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3 192 320c0 17.7 14.3 32 32 32s32-14.3 32-32l0-210.7 73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-64z"/></svg>
                                    </span>
                                </label>
                                <input id="upload_image" name="image" type="file" accept="image/*" class="form-control-file @error('image') is-invalid @enderror" style="display: none">
                                @error('image')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="5">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="submit_btn">Save Testimonial</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection
