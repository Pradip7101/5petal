@extends('admin.admin_layouts.admin_app')

@section('content')
<div class="content-wrapper">
    <div class="content-margin">

        <div class="dashboard_heading flex-css">
            <div class="name">
                <h2 class="m-0">Edit Category</h2>
            </div>
            <div class="list_links">
                <ul class="p-0 flex-css">
                    <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li>/</li>
                    <li><a href="{{ route('admin.categories.index') }}">Category Management</a></li>
                    <li>/</li>
                    <li class="active">Edit Category</li>
                </ul>
            </div>
        </div>

        <section class="dashboard_box dashboard_padding">
            <div class="border-box profile_edit">

                <form method="POST"
                    action="{{ route('admin.categories.update', $category->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        {{-- ================= CATEGORY IMAGE ================= --}}
                        <div class="col-6">
                            <div class="mb-4 profile_image_box"
                                style="display: {{ $category->image ? 'block' : 'none' }};">
                                <img src="{{ asset('admin_assets/uploads/'.$category->image) }}"
                                    class="img-thumbnail">
                            </div>

                            <div class="form-group">
                                <label>Image</label>
                                <label for="upload_image" class="custom-file-upload form-control">
                                    Upload Your Image
                                </label>
                                <input id="upload_image"
                                    type="file"
                                    name="image"
                                    accept="image/*"
                                    class="d-none @error('image') is-invalid @enderror">
                                @error('image') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- ================= CATEGORY BANNER IMAGE ================= --}}
                        <div class="col-6">
                            <div class="mb-4 profile_image_box"
                                style="display: {{ $category->cat_banner_image ? 'block' : 'none' }};">
                                <img src="{{ asset('admin_assets/uploads/'.$category->cat_banner_image) }}"
                                    class="img-thumbnail">
                            </div>

                            <div class="form-group">
                                <label>Category Banner Image</label>
                                <label for="cat_banner_image" class="custom-file-upload form-control">
                                    Upload Category Banner Image
                                </label>
                                <input id="cat_banner_image"
                                    type="file"
                                    name="cat_banner_image"
                                    accept="image/*"
                                    class="d-none @error('cat_banner_image') is-invalid @enderror">
                                @error('cat_banner_image') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- ================= MOBILE BANNER IMAGE ================= --}}
                        <div class="col-6">
                            <div class="mb-4 profile_image_box"
                                style="display: {{ $category->cat_banner_mobile_image ? 'block' : 'none' }};">
                                <img src="{{ asset('admin_assets/uploads/'.$category->cat_banner_mobile_image) }}"
                                    class="img-thumbnail">
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
                            @if($category->category_video &&
                            file_exists(public_path('admin_assets/uploads/category-videos/'.$category->category_video)))
                            <div class="mb-4 profile_image_box">
                                <video width="100%" controls>
                                    <source src="{{ asset('admin_assets/uploads/category-videos/'.$category->category_video) }}">
                                </video>
                            </div>
                            @endif

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
                                <input type="text"
                                    name="name"
                                    value="{{ old('name', $category->name) }}"
                                    class="form-control @error('name') is-invalid @enderror">
                                @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- ================= PARENT CATEGORY ================= --}}
                        <div class="col-6">
                            <div class="form-group">
                                <label>Parent Category (Optional)</label>
                                <select name="parent_id" class="form-control">
                                    <option value="">None</option>
                                    @foreach($categories as $parentCategory)
                                    <option value="{{ $parentCategory->id }}"
                                        {{ $parentCategory->id == old('parent_id', $category->parent_id) ? 'selected' : '' }}>
                                        {{ $parentCategory->name }}
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
                                    class="form-control @error('description') is-invalid @enderror">{{ old('description', $category->description) }}</textarea>
                                @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="submit_btn">Update Category</button>
                    <a href="{{ url()->previous() }}" class="back_btn ms-2">Back</a>

                </form>
            </div>
        </section>
    </div>
</div>
@endsection