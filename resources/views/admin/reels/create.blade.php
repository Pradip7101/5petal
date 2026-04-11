@extends('admin.admin_layouts.admin_app')

@section('content')
<div class="content-wrapper">
    <div class="content-margin">
        <div class="dashboard_heading flex-css">
            <div class="name">
                <h2 class="m-0">Add New Reel</h2>
            </div>
            <div class="list_links">
                <ul class="p-0 flex-css">
                    <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li>/</li>
                    <li><a href="{{ route('admin.reels.index') }}">Reels</a></li>
                    <li>/</li>
                    <li class="active">Add New</li>
                </ul>
            </div>
        </div>

        <section class="dashboard_box users_edit product_create">
            <div class="border-box">
                <form action="{{ route('admin.reels.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header justify-content-start">
                        <h2>Reel Details</h2>
                    </div>
                    <div class="card-body card-padding">

                        {{-- Title --}}
                        <div class="form-group">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                            @error('title')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        {{-- YouTube ID --}}
                        <div class="form-group">
                            <label class="form-label">YouTube Video ID</label>
                            <input type="text" name="youtube_id" class="form-control @error('youtube_id') is-invalid @enderror" value="{{ old('youtube_id') }}" placeholder="e.g. F8VDoF5WB3Y">
                            <small class="text-muted">If provided, the YouTube video will be used. Leave blank to upload an MP4.</small>
                            @error('youtube_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        {{-- Video File --}}
                        <div class="form-group">
                            <label class="form-label">Video File (MP4)</label>
                            <input type="file" name="video_file" accept="video/mp4,video/webm" class="form-control @error('video_file') is-invalid @enderror">
                            <small class="text-muted">Only used when no YouTube ID is set. Max 100MB.</small>
                            @error('video_file')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        {{-- Thumbnail --}}
                        <div class="form-group">
                            <div id="image-preview" class="mb-4 profile_image_box" style="display:none;">
                                <img id="preview-img" src="" class="img-thumbnail" alt="Preview">
                            </div>
                            <label class="form-label">Thumbnail Image</label>
                            <div>
                                <label for="upload_image" class="custom-file-upload form-control">
                                    Upload Thumbnail
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 448 512"><path d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3 192 320c0 17.7 14.3 32 32 32s32-14.3 32-32l0-210.7 73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-64z"/></svg>
                                    </span>
                                </label>
                                <input id="upload_image" name="thumbnail_image" type="file" accept="image/*" class="form-control-file @error('thumbnail_image') is-invalid @enderror" style="display:none;">
                                @error('thumbnail_image')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        {{-- Price row --}}
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label class="form-label">Sale Price (₹) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                                @error('price')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="form-label">Original Price (₹) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" name="original_price" class="form-control @error('original_price') is-invalid @enderror" value="{{ old('original_price') }}">
                                @error('original_price')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="form-label">Discount % <span class="text-danger">*</span></label>
                                <input type="number" name="discount_percent" min="0" max="100" class="form-control @error('discount_percent') is-invalid @enderror" value="{{ old('discount_percent', 0) }}">
                                @error('discount_percent')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        {{-- Views & Sort --}}
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="form-label">Views Count</label>
                                <input type="text" name="views_count" class="form-control @error('views_count') is-invalid @enderror" value="{{ old('views_count', '0') }}" placeholder="e.g. 2.7K">
                                @error('views_count')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="form-label">Sort Order</label>
                                <input type="number" name="sort_order" min="0" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', 0) }}">
                                @error('sort_order')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        {{-- Active Status --}}
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">Active (visible on frontend)</label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="submit_btn">Save Reel</button>
                            <a href="{{ route('admin.reels.index') }}" class="back_btn">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection
