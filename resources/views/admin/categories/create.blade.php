@extends('admin.admin_layouts.admin_app')

@section('content')
<div class="content-wrapper">
    <div class="content-margin">

        <div class="dashboard_heading flex-css">
            <div class="name">
                <h2 class="m-0">Add New Category</h2>
            </div>
            <div class="list_links">
                <ul class="p-0 flex-css">
                    <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li>/</li>
                    <li><a href="{{ route('admin.categories.index') }}">Category Management</a></li>
                    <li>/</li>
                    <li class="active">Add New Category</li>
                </ul>
            </div>
        </div>

        <section class="dashboard_box dashboard_padding">
            <div class="border-box profile_edit">

                <form method="POST"
                    action="{{ route('admin.categories.store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        {{-- ================= CATEGORY IMAGE ================= --}}
                        <div class="col-6">
                            <div id="image-preview" class="mb-4 profile_image_box" style="display:none;">
                                <img id="preview-img" class="img-thumbnail" />
                            </div>

                            <div class="form-group">
                                <label>Image</label>
                                <label for="upload_image" class="custom-file-upload form-control">
                                    Upload Your Image
                                </label>
                                <input id="upload_image" type="file" name="image" accept="image/*"
                                    class="d-none @error('image') is-invalid @enderror">
                                @error('image') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- ================= BANNER IMAGE ================= --}}
                        <div class="col-6">
                            <div id="cat-banner-image-preview" class="mb-4 profile_image_box" style="display:none;">
                                <img id="preview-cat-banner-image" class="img-thumbnail" />
                            </div>

                            <div class="form-group">
                                <label>Category Banner Image</label>
                                <label for="cat_banner_image" class="custom-file-upload form-control">
                                    Upload Category Banner Image
                                </label>
                                <input id="cat_banner_image" type="file" name="cat_banner_image" accept="image/*"
                                    class="d-none @error('cat_banner_image') is-invalid @enderror">
                                @error('cat_banner_image') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- ================= MOBILE BANNER IMAGE ================= --}}
                        <div class="col-6">
                            <div id="cat-mobile-banner-image-preview" class="mb-4 profile_image_box" style="display:none;">
                                <img id="preview-cat-mobile-banner-image" class="img-thumbnail" />
                            </div>

                            <div class="form-group">
                                <label>Mobile Banner Image</label>
                                <label for="cat_banner_mobile_image" class="custom-file-upload form-control">
                                    Upload Mobile Banner Image
                                </label>
                                <input id="cat_banner_mobile_image"
                                    type="file"
                                    name="cat_banner_mobile_image"
                                    accept="image/*"
                                    class="d-none @error('cat_banner_mobile_image') is-invalid @enderror">
                                @error('cat_banner_mobile_image')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- ================= CATEGORY VIDEO (NEW) ================= --}}
                        <div class="col-6">
                            <div id="category-video-preview" class="mb-4 profile_image_box" style="display:none;">
                                <video id="preview-category-video" width="100%" controls></video>
                            </div>

                            <div class="form-group">
                                <label>Category Video</label>
                                <label for="category_video" class="custom-file-upload form-control">
                                    Upload Category Video
                                </label>
                                <input id="category_video"
                                    type="file"
                                    name="category_video"
                                    accept="video/mp4,video/webm,video/ogg"
                                    class="d-none @error('category_video') is-invalid @enderror">
                                @error('category_video')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- ================= NAME ================= --}}
                        <div class="col-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}"
                                    placeholder="Category Name">
                                @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- ================= PARENT CATEGORY ================= --}}
                        <div class="col-6">
                            <div class="form-group">
                                <label>Parent Category (Optional)</label>
                                <select name="parent_id" class="form-control">
                                    <option value="">None</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('parent_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- ================= DESCRIPTION ================= --}}
                        <div class="col-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description"
                                    rows="3"
                                    class="form-text @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="submit_btn">Add Category</button>
                    <a href="{{ url()->previous() }}" class="back_btn ms-2">Back</a>

                </form>
            </div>
        </section>
    </div>
</div>

{{-- ================= JS PREVIEW ================= --}}
<script>
    document.getElementById('category_video').addEventListener('change', function(e) {
        const video = document.getElementById('preview-category-video');
        const box = document.getElementById('category-video-preview');

        if (this.files[0]) {
            video.src = URL.createObjectURL(this.files[0]);
            box.style.display = 'block';
        }
    });
</script>

<script>
    document.getElementById('cat_banner_mobile_image').addEventListener('change', function(e) {
        const img = document.getElementById('preview-cat-mobile-banner-image');
        const box = document.getElementById('cat-mobile-banner-image-preview');

        if (this.files[0]) {
            img.src = URL.createObjectURL(this.files[0]);
            box.style.display = 'block';
        }
    });
</script>

@endsection