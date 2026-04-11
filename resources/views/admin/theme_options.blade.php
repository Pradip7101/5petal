@extends('admin.admin_layouts.admin_app')
@section('content')
<div class="content-wrapper">
    <div class="content-margin">
        <div class="dashboard_heading flex-css">
            <div class="name">
                <h2 class="m-0">Theme Options</h2>
            </div>
            <div class="list_links">
                <ul class="p-0 flex-css">
                    <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li>/</li>
                    <li class="active">Theme Option</li>
                </ul>
            </div>
        </div>
        <section class="dashboard_box users_edit product_create theme_option">
            <div class="border-box profile_edit">
                @if(session('success'))
                    <div id="success-alert">
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
                <form role="form" action="{{ route('admin.theme-options.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body card-padding">
                        <div class="form-group-background">
                            <div class="row">
                                <div class="col-6">
                                    <div>
                                        @if($themeOptions->mega_menu_banner && file_exists(public_path('admin_assets/uploads/' . $themeOptions->mega_menu_banner)))
                                            <div id="image-preview" class="mb-4 profile_image_box" style="display: block;">
                                                <img id="preview-img" src="{{ asset('admin_assets/uploads/' . $themeOptions->mega_menu_banner) }}" class="img-thumbnail" alt="Image Preview" />
                                            </div>
                                        @else
                                            <div id="image-preview" class="mb-4 profile_image_box" style="display: none;">
                                                <img id="preview-img" src="" class="img-thumbnail" alt="Image Preview" />
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Mega Menu Banner</label>
                                        <div>
                                            <label for="upload_image" class="custom-file-upload form-control">
                                                Upload Your Image 
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 448 512"><path d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3 192 320c0 17.7 14.3 32 32 32s32-14.3 32-32l0-210.7 73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-64z"/></svg>
                                                </span>
                                            </label>
                                            <input id="upload_image" name="mega_menu_banner" type="file" accept="image/*" class="form-control @error('mega_menu_banner') is-invalid @enderror" style="display: none">
                                            @error('mega_menu_banner')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div>
                                        @if($themeOptions->header_logo && file_exists(public_path('admin_assets/uploads/' . $themeOptions->header_logo)))
                                            <div id="image-preview2" class="mb-4 profile_image_box" style="display: block;">
                                                <img id="preview-img2" src="{{ asset('admin_assets/uploads/' . $themeOptions->header_logo) }}" class="img-thumbnail" alt="Image Preview" />
                                            </div>
                                        @else
                                            <div id="image-preview2" class="mb-4 profile_image_box" style="display: none;">
                                                <img id="preview-img2" src="" class="img-thumbnail" alt="Image Preview" />
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Header Logo</label>
                                        <div>
                                            <label for="upload_image2" class="custom-file-upload form-control">
                                                Upload Your Image 
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 448 512"><path d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3 192 320c0 17.7 14.3 32 32 32s32-14.3 32-32l0-210.7 73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-64z"/></svg>
                                                </span>
                                            </label>
                                            <input id="upload_image2" name="header_logo" type="file" accept="image/*" class="form-control  @error('header_logo') is-invalid @enderror" style="display: none">
                                            @error('header_logo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Top Header 1 Text</label>

                                    <div class="top_header1_repeater">
                                        <div data-repeater-list="top_header1_texts">

                                            @php
                                                $topHeaderTexts = json_decode($themeOptions->top_header1_text ?? '[]', true);
                                            @endphp

                                            @forelse($topHeaderTexts as $index => $text)
                                                <div data-repeater-item class="d-flex align-items-end mb-2">

                                                    <div class="flex-grow-1">
                                                        <label
                                                            for="top_header1_text_{{ $index }}"
                                                            class="form-label mb-1"
                                                        >
                                                            Text
                                                        </label>

                                                        <input
                                                            type="text"
                                                            id="top_header1_text_{{ $index }}"
                                                            name="text"
                                                            class="form-control"
                                                            value="{{ $text['text'] ?? '' }}"
                                                            placeholder="Enter Top Header Text"
                                                        >
                                                    </div>

                                                    <button
                                                        data-repeater-delete
                                                        type="button"
                                                        class="btn btn-danger ms-2 mb-1"
                                                    >
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            @empty
                                                <div data-repeater-item class="d-flex align-items-end mb-2">

                                                    <div class="flex-grow-1">
                                                        <label
                                                            for="top_header1_text_0"
                                                            class="form-label mb-1"
                                                        >
                                                            Text
                                                        </label>

                                                        <input
                                                            type="text"
                                                            id="top_header1_text_0"
                                                            name="text"
                                                            class="form-control"
                                                            placeholder="Enter Top Header Text"
                                                        >
                                                    </div>

                                                    <button
                                                        data-repeater-delete
                                                        type="button"
                                                        class="btn btn-danger ms-2 mb-1"
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="14" height="14">
                                                            <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            @endforelse

                                        </div>

                                        <button data-repeater-create type="button" class="submit_btn mt-2">
                                            <i class="fas fa-plus-circle"></i> Add More
                                        </button>
                                    </div>
                                </div>


                                
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="top_header2_text" class="form-label">Top Header 2 Text</label>
                                        <input type="text" class="form-control @error('top_header2_text') is-invalid @enderror" id="top_header2_text" name="top_header2_text" value="{{ old('top_header2_text', $themeOptions->top_header2_text) }}">
                                        @error('top_header2_text')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="top_header2_text_price" class="form-label">Top Header 2 Text Price</label>
                                        <input type="text" class="form-control @error('top_header2_text_price') is-invalid @enderror" id="top_header2_text_price" name="top_header2_text_price" value="{{ old('top_header2_text_price', $themeOptions->top_header2_text_price) }}">
                                        @error('top_header2_text_price')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="footer_description" class="form-label">Footer Description</label>
                                        <textarea name="footer_description"
                                            class="form-control @error('footer_description') is-invalid @enderror"
                                            id="footer_description">{{ old('footer_description', $themeOptions->footer_description) }}</textarea>
                                        @error('footer_description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group-background">
                            <!-- Social Links Repeater -->
                            <div class="mb-3 form-group">
                                <label for="social_links_repeater" class="form-label from-label-links">Social Links</label>
                                <div class="social_links_repeater">
                                    <div data-repeater-list="social_links">
                                        @php
                                            $socialLinks = json_decode($themeOptions->social_links, true) ?? [[]];
                                        @endphp

                                        @forelse($socialLinks as $index => $link)
                                            <div data-repeater-item class="margin-top" data-index="{{ $index }}">
                                                <div class="row align-items-end">
                                                    <div class="col-12">
                                                        <div id="social-preview-{{ $index }}" class="mb-4 profile_image_box" style="{{ isset($link['social_icon']) ? 'display: block;' : 'display: none;' }}">
                                                            <img id="preview-social-{{ $index }}" src="{{ isset($link['social_icon']) ? asset('admin_assets/uploads/' . $link['social_icon']) : '' }}" class="img-thumbnail" alt="Image Preview" />
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label block">Social Icon</label>
                                                        <label for="social_image_{{ $index }}" class="custom-file-upload form-control mb-0">
                                                            Upload Your Image
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 448 512">
                                                                    <path d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3 192 320c0 17.7 14.3 32 32 32s32-14.3 32-32V109.3l73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32v64c0 53 43 96 96 96h256c53 0 96-43 96-96v-64c0-17.7-14.3-32-32-32s-32 14.3-32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32v-64z"/>
                                                                </svg>
                                                            </span>
                                                        </label>
                                                        <input id="social_image_{{ $index }}" name="social_links[{{ $index }}][social_icon]" type="file" accept="image/*" class="form-control" style="display: none" onchange="previewImage_sl(event, {{ $index }})">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label">Social Link URL</label>
                                                        <input type="text" name="social_links[{{ $index }}][social_link_url]" class="form-control" value="{{ $link['social_link_url'] ?? '' }}">
                                                    </div>
                                                    <div class="theme_delete_btn">
                                                        <button data-repeater-delete type="button" class="btn btn-danger ms-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="14" height="14">
                                                                <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64s14.3-32 32-32h96l7.2-14.3zM32 128h384v320c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16v224c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16v224c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16v224c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <!-- Template for Empty State -->
                                            <div data-repeater-item class="margin-top">
                                                <div class="row align-items-end">
                                                    <div class="col-12">
                                                        <div id="social-preview-0" class="mb-4 profile_image_box" style="display: none;">
                                                            <img id="preview-social-0" src="" class="img-thumbnail" alt="Image Preview" />
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label block">Social Icon</label>
                                                        <label for="social_image_0" class="custom-file-upload form-control mb-0">
                                                            Upload Your Image
                                                            <span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 448 512"><path d="..."/></svg></span>
                                                        </label>
                                                        <input id="social_image_0" name="social_links[0][social_icon]" type="file" accept="image/*" class="form-control" style="display: none" onchange="previewImage_sl(event, 0)">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label">Social Link URL</label>
                                                        <input type="url" name="social_links[0][social_link_url]" class="form-control" value="">
                                                    </div>
                                                    <div class="theme_delete_btn">
                                                        <button data-repeater-delete type="button" class="btn btn-danger ms-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="14" height="14"><path d="..."/></svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                    <button data-repeater-create type="button" class="submit_btn">
                                        <i class="fas fa-plus-circle"></i> Add More
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group-background">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name">Admin Email</label>
                                        <input type="text" class="form-control @error('admin_email') is-invalid @enderror"
                                            id="admin_email" name="admin_email" placeholder="Admin Email"
                                            value="{{ old('admin_email', $themeOptions->admin_email) }}">
                                        @error('admin_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name">Admin Phone</label>
                                        <input type="text" class="form-control @error('admin_phone') is-invalid @enderror"
                                            id="admin_phone" name="admin_phone" placeholder="Admin Phone"
                                            value="{{ old('admin_phone', $themeOptions->admin_phone) }}">
                                        @error('admin_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    @if($themeOptions->footer_payment_logo && file_exists(public_path('admin_assets/uploads/' . $themeOptions->footer_payment_logo)))
                                        <div id="image-preview-fpl" class="mb-4 profile_image_box" style="display: block;">
                                            <img id="preview-img-fpl" src="{{ asset('admin_assets/uploads/' . $themeOptions->footer_payment_logo) }}" class="img-thumbnail" alt="Image Preview" />
                                        </div>
                                    @else
                                        <div id="image-preview-fpl" class="mb-4 profile_image_box" style="display: none;">
                                            <img id="preview-img-fpl" src="" class="img-thumbnail" alt="Image Preview" />
                                        </div>
                                    @endif
                                </div>
                                <label for="image">Footer Payment Logo</label>
                                <div>
                                    <label for="upload_image_fpl" class="custom-file-upload form-control">
                                        Upload Your Image 
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 448 512"><path d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3 192 320c0 17.7 14.3 32 32 32s32-14.3 32-32l0-210.7 73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-64z"/></svg>
                                        </span>
                                    </label>
                                    <input id="upload_image_fpl" name="footer_payment_logo" type="file" accept="image/*" class="form-control  @error('footer_payment_logo') is-invalid @enderror" style="display: none">
                                    @error('footer_payment_logo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <div>
                                            @if($themeOptions->footer_image1 && file_exists(public_path('admin_assets/uploads/' . $themeOptions->footer_image1)))
                                                <div id="image-preview-fi1" class="mb-4 profile_image_box" style="display: block;">
                                                    <img id="preview-img-fi1" src="{{ asset('admin_assets/uploads/' . $themeOptions->footer_image1) }}" class="img-thumbnail" alt="Image Preview" />
                                                </div>
                                            @else
                                                <div id="image-preview-fi1" class="mb-4 profile_image_box" style="display: none;">
                                                    <img id="preview-img-fi1" src="" class="img-thumbnail" alt="Image Preview" />
                                                </div>
                                            @endif
                                        </div>
                                        <label for="image">Footer Image 1</label>
                                        <div>
                                            <label for="upload_image_fi1" class="custom-file-upload form-control">
                                                Upload Your Image 
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 448 512"><path d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3 192 320c0 17.7 14.3 32 32 32s32-14.3 32-32l0-210.7 73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-64z"/></svg>
                                                </span>
                                            </label>
                                            <input id="upload_image_fi1" name="footer_image1" type="file" accept="image/*" class="form-control @error('footer_image1') is-invalid @enderror" style="display: none">
                                            @error('footer_image1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <div>
                                            @if($themeOptions->footer_image2 && file_exists(public_path('admin_assets/uploads/' . $themeOptions->footer_image2)))
                                                <div id="image-preview-fi2" class="mb-4 profile_image_box" style="display: block;">
                                                    <img id="preview-img-fi2" src="{{ asset('admin_assets/uploads/' . $themeOptions->footer_image2) }}" class="img-thumbnail" alt="Image Preview" />
                                                </div>
                                            @else
                                                <div id="image-preview-fi2" class="mb-4 profile_image_box" style="display: none;">
                                                    <img id="preview-img-fi2" src="" class="img-thumbnail" alt="Image Preview" />
                                                </div>
                                            @endif
                                        </div>
                                        <label for="image">Footer Image 2</label>
                                        <div>
                                            <label for="upload_image_fi2" class="custom-file-upload form-control">
                                                Upload Your Image 
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 448 512"><path d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3 192 320c0 17.7 14.3 32 32 32s32-14.3 32-32l0-210.7 73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-64z"/></svg>
                                                </span>
                                            </label>
                                            <input id="upload_image_fi2" name="footer_image2" type="file" accept="image/*" class="form-control @error('footer_image2') is-invalid @enderror" style="display: none">
                                            @error('footer_image2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group-background">
                            <!-- Above Footer Section Repeater -->
                            <div class="mb-3 form-group">
                                <label for="above_footer_repeater" class="form-label from-label-links">Above Footer Section</label>
                                <div class="above_footer_repeater">
                                    <div data-repeater-list="above_footer_section">
                                        @php
                                            $above_footer_section = $themeOptions->above_footer_section;
                                            if (is_string($above_footer_section)) {
                                                $above_footer_section = json_decode($above_footer_section, true) ?? [];
                                            } elseif (is_array($above_footer_section)) {
                                                $above_footer_section = $above_footer_section;
                                            } else {
                                                $above_footer_section = [];
                                            }
                                        @endphp

                                        @forelse($above_footer_section as $index => $section)
                                            <div data-repeater-item class="margin-top" data-index="{{ $index }}">
                                                <div class="row align-items-end">
                                                    <div class="col-12">
                                                        <div id="afs-preview-{{ $index }}" class="mb-4 profile_image_box" style="{{ isset($section['fs_image']) ? 'display: block;' : 'display: none;' }}">
                                                            <img id="preview-afs-{{ $index }}" src="{{ isset($section['fs_image']) ? asset('admin_assets/uploads/' . $section['fs_image']) : '' }}" class="img-thumbnail" alt="Image Preview" />
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <label class="form-label block">Image</label>
                                                        <label for="afs_image_{{ $index }}" class="custom-file-upload form-control mb-0">
                                                            Upload Your Image
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 448 512">
                                                                    <path d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3 192 320c0 17.7 14.3 32 32 32s32-14.3 32-32V109.3l73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32v64c0 53 43 96 96 96h256c53 0 96-43 96-96v-64c0-17.7-14.3-32-32-32s-32 14.3-32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32v-64z"/>
                                                                </svg>
                                                            </span>
                                                        </label>
                                                        <input id="afs_image_{{ $index }}" name="above_footer_section[{{ $index }}][fs_image]" type="file" accept="image/*" class="form-control" style="display: none" onchange="previewImage_afs(event, {{ $index }})">
                                                    </div>
                                                    <div class="col-3">
                                                        <label class="form-label">Title</label>
                                                        <input type="text" name="above_footer_section[{{ $index }}][fs_title]" class="form-control" value="{{ $section['fs_title'] ?? '' }}">
                                                    </div>
                                                    <div class="col-3">
                                                        <label class="form-label">Description</label>
                                                        <input type="text" name="above_footer_section[{{ $index }}][fs_description]" class="form-control" value="{{ $section['fs_description'] ?? '' }}">
                                                    </div>
                                                    <div class="col-3 theme_delete_btn">
                                                        <button data-repeater-delete type="button" class="btn btn-danger ms-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="14" height="14">
                                                                <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div data-repeater-item class="margin-top">
                                                <div class="row align-items-end">
                                                    <div class="col-12">
                                                        <div id="afs-preview-0" class="mb-4 profile_image_box" style="display: none;">
                                                            <img id="preview-afs-0" src="" class="img-thumbnail" alt="Image Preview" />
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <label class="form-label block">Image</label>
                                                        <label for="afs_image_0" class="custom-file-upload form-control mb-0">
                                                            Upload Your Image
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 448 512">
                                                                    <path d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3 192 320c0 17.7 14.3 32 32 32s32-14.3 32-32V109.3l73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32v64c0 53 43 96 96 96h256c53 0 96-43 96-96v-64c0-17.7-14.3-32-32-32s-32 14.3-32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32v-64z"/>
                                                                </svg>
                                                            </span>
                                                        </label>
                                                        <input id="afs_image_0" name="above_footer_section[0][fs_image]" type="file" accept="image/*" class="form-control" style="display: none" onchange="previewImage_afs(event, 0)">
                                                    </div>
                                                    <div class="col-3">
                                                        <label class="form-label">Title</label>
                                                        <input type="text" name="above_footer_section[0][fs_title]" class="form-control" value="">
                                                    </div>
                                                    <div class="col-3">
                                                        <label class="form-label">Description</label>
                                                        <input type="text" name="above_footer_section[0][fs_description]" class="form-control" value="">
                                                    </div>
                                                    <div class="col-3 theme_delete_btn">
                                                        <button data-repeater-delete type="button" class="btn btn-danger ms-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="14" height="14">
                                                                <path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse

                                    </div>
                                    <!-- Add More Button -->
                                    <button data-repeater-create type="button" class="submit_btn">
                                        <i class="fas fa-plus-circle"></i> Add More
                                    </button>
                                </div>
                            </div>
                            <!-- Above Footer Section Repeater end -->
                        </div>

                        <div class="form-group-background">
                            <label for="" class="form-label from-label-links">Modal Content Section</label>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="modal_title">Modal Title</label>
                                        <input type="text" class="form-control" id="modal_title" name="modal_title" value="{{ old('modal_title', $themeOptions->modal_title) }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="modal_subtitle">Modal Subtitle</label>
                                        <input type="text" class="form-control" id="modal_subtitle" name="modal_subtitle" value="{{ old('modal_subtitle', $themeOptions->modal_subtitle) }}">
                                    </div>
                                </div>
                               
                            </div>
                            <div class="mb-3 form-group">
                                <label class="form-label from-label-links">Modal Features (Maximum 3)</label>
                                <div class="modal_features_repeater">
                                    <div data-repeater-list="modal_features">
                                        @php
                                            $modalFeatures = $themeOptions->modal_features;
                                            if (is_string($modalFeatures)) {
                                                $modalFeatures = json_decode($modalFeatures, true) ?? [];
                                            } elseif (is_array($modalFeatures)) {
                                                $modalFeatures = $modalFeatures;
                                            } else {
                                                $modalFeatures = [];
                                            }
                                        @endphp
                                        @forelse($modalFeatures as $index => $feature)
                                            <div data-repeater-item class="margin-top">
                                                <div class="row align-items-end">
                                                    <div class="col-12">
                                                        <div id="mf-preview-{{ $index }}" class="mb-4 profile_image_box" style="{{ isset($feature['icon']) ? 'display: block;' : 'display: none;' }}">
                                                            <img id="preview-mf-{{ $index }}" src="{{ isset($feature['icon']) ? asset('admin_assets/uploads/' . $feature['icon']) : '' }}" class="img-thumbnail" alt="Image Preview" />
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <label class="form-label">Icon</label>
                                                        <label for="mf_icon_{{ $index }}" class="custom-file-upload form-control mb-0">
                                                            Upload Icon
                                                            <span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 448 512"><path d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3 192 320c0 17.7 14.3 32 32 32s32-14.3 32-32V109.3l73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32v64c0 53 43 96 96 96h256c53 0 96-43 96-96v-64c0-17.7-14.3-32-32-32s-32 14.3-32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32v-64z"/></svg></span>
                                                        </label>
                                                        <input id="mf_icon_{{ $index }}" name="icon" type="file" accept="image/*" class="form-control" style="display: none" onchange="previewImage_mf(event, {{ $index }})">
                                                    </div>
                                                    <div class="col-4">
                                                        <label class="form-label">Title</label>
                                                        <input type="text" name="title" class="form-control" value="{{ $feature['title'] ?? '' }}">
                                                    </div>
                                                    <div class="col-4">
                                                        <label class="form-label">Description</label>
                                                        <input type="text" name="description" class="form-control" value="{{ $feature['description'] ?? '' }}">
                                                    </div>
                                                    <div class="theme_delete_btn">
                                                        <button data-repeater-delete type="button" class="btn btn-danger ms-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="14" height="14"><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"/></svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div data-repeater-item class="margin-top">
                                                <div class="row align-items-end">
                                                    <div class="col-12">
                                                        <div id="mf-preview-0" class="mb-4 profile_image_box" style="display: none;">
                                                            <img id="preview-mf-0" src="" class="img-thumbnail" alt="Image Preview" />
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <label class="form-label">Icon</label>
                                                        <label for="mf_icon_0" class="custom-file-upload form-control mb-0">
                                                            Upload Icon
                                                            <span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 448 512"><path d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3 192 320c0 17.7 14.3 32 32 32s32-14.3 32-32V109.3l73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32v64c0 53 43 96 96 96h256c53 0 96-43 96-96v-64c0-17.7-14.3-32-32-32s-32 14.3-32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32v-64z"/></svg></span>
                                                        </label>
                                                        <input id="mf_icon_0" name="icon" type="file" accept="image/*" class="form-control" style="display: none" onchange="previewImage_mf(event, 0)">
                                                    </div>
                                                    <div class="col-4">
                                                        <label class="form-label">Title</label>
                                                        <input type="text" name="title" class="form-control">
                                                    </div>
                                                    <div class="col-4">
                                                        <label class="form-label">Description</label>
                                                        <input type="text" name="description" class="form-control">
                                                    </div>
                                                    <div class="theme_delete_btn">
                                                        <button data-repeater-delete type="button" class="btn btn-danger ms-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="14" height="14"><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"/></svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                    <button data-repeater-create type="button" class="submit_btn">
                                        <i class="fas fa-plus-circle"></i> Add More
                                    </button>
                                </div>
                            </div>
                             <div class="col-12">
                                    <div class="form-group">
                                        <label for="modal_below_text">Modal Box Below Text</label>
                                        <textarea class="form-control" id="modal_below_text" name="modal_below_text">{{ old('modal_below_text', $themeOptions->modal_below_text) }}</textarea>
                                    </div>
                                </div>
                        </div>

                        <div class="form-group-background update_btn">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="submit_btn">Update</button>
                                <a href="{{ route('admin.theme-options') }}" class="back_btn">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
<script>

$(document).ready(function () {

/* ---------------- TOP HEADER 1 REPEATER ---------------- */

$('.top_header1_repeater').repeater({
    initEmpty: false,
    show: function () {
        $(this).slideDown();
        updateRepeaterIndexes_th1();
    },
    hide: function (deleteElement) {
        if (confirm('Are you sure you want to delete this item?')) {
            $(this).slideUp(deleteElement, function () {
                $(this).remove();
                updateRepeaterIndexes_th1(); // Recalculate indexes
            });
        }
    }
});

// Initial index fix on page load
updateRepeaterIndexes_th1();

/* ---------------- INDEX HANDLER ---------------- */

function updateRepeaterIndexes_th1() {
    $('.top_header1_repeater')
        .find('[data-repeater-item]')
        .each(function (index) {

            // Update label for attribute
            $(this)
                .find('label[for*="top_header1_text_"]')
                .attr('for', 'top_header1_text_' + index);

            // Update input ID
            $(this)
                .find('input[type="text"]')
                .attr('id', 'top_header1_text_' + index);
        });
}

});

    
    $(document).ready(function () {
        // Initialize the repeater
        $('.social_links_repeater').repeater({
            initEmpty: false,
            show: function () {
                $(this).slideDown();
                // Hide the image preview and clear the src attribute for a new row
                $(this).find('.profile_image_box').hide();
                $(this).find('img').attr('src', '');
                updateRepeaterIndexes_sl();
            },
            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this item?')) {
                    $(this).slideUp(deleteElement, function () {
                        $(this).remove();
                        updateRepeaterIndexes_sl(); // Recalculate indexes after deletion
                    });
                }
            }
        });
        $('.above_footer_repeater').repeater({
            initEmpty: false,
            show: function () {
                $(this).slideDown();
                // Hide the image preview and clear the src attribute for a new row
                $(this).find('.profile_image_box').hide();
                $(this).find('img').attr('src', '');
                updateRepeaterIndexes_afs();
            },
            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this item?')) {
                    $(this).slideUp(deleteElement, function () {
                        $(this).remove();
                        updateRepeaterIndexes_afs(); // Recalculate indexes after deletion
                    });
                }
            }
        });

        $('.modal_features_repeater').repeater({
            initEmpty: false,
            show: function () {
                if ($('.modal_features_repeater [data-repeater-item]').length <= 3) {
                    $(this).slideDown();
                    $(this).find('.profile_image_box').hide();
                    $(this).find('img').attr('src', '');
                    updateRepeaterIndexes_mf();
                } else {
                    alert('Maximum 3 features allowed');
                    return false;
                }
            },
            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this item?')) {
                    $(this).slideUp(deleteElement, function () {
                        $(this).remove();
                        updateRepeaterIndexes_mf();
                    });
                }
            }
        });

        function updateRepeaterIndexes_mf() {
            $('.modal_features_repeater').find('[data-repeater-item]').each(function (index) {
                const existingSrc = $(this).find('img').attr('src');
                $(this).find('label[for*="mf_icon_"]').attr('for', 'mf_icon_' + index);
                $(this).find('input[type="file"]').attr('id', 'mf_icon_' + index).attr('onchange', 'previewImage_mf(event, ' + index + ')');
                $(this).find('.profile_image_box').attr('id', 'mf-preview-' + index);
                $(this).find('img').attr('id', 'preview-mf-' + index).attr('src', existingSrc);
            });
        }

        function updateRepeaterIndexes_sl() {
            $('.social_links_repeater').find('[data-repeater-item]').each(function (index) {
                // Get existing src value to avoid resetting previews
                const existingSrc = $(this).find('img').attr('src');

                // Update IDs and names for unique identification of inputs and previews
                $(this).find('label[for*="social_image_"]').attr('for', 'social_image_' + index);
                $(this).find('input[type="file"]').attr('id', 'social_image_' + index).attr('onchange', 'previewImage_sl(event, ' + index + ')');
                $(this).find('.profile_image_box').attr('id', 'social-preview-' + index);
                $(this).find('img').attr('id', 'preview-social-' + index).attr('src', existingSrc); // Retain the existing preview image
            });
        }
        function updateRepeaterIndexes_afs() {
            $('.above_footer_repeater').find('[data-repeater-item]').each(function (index) {
                // Get existing src value to avoid resetting previews
                const existingSrc = $(this).find('img').attr('src');

                // Update IDs and names for unique identification of inputs and previews
                $(this).find('label[for*="afs_image_"]').attr('for', 'afs_image_' + index);
                $(this).find('input[type="file"]').attr('id', 'afs_image_' + index).attr('onchange', 'previewImage_afs(event, ' + index + ')');
                $(this).find('.profile_image_box').attr('id', 'afs-preview-' + index);
                $(this).find('img').attr('id', 'preview-afs-' + index).attr('src', existingSrc); // Retain the existing preview image
            });
        }
    });

    // Image Preview Function
    function previewImage_sl(event, index) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#preview-social-' + index).attr('src', e.target.result);
                $('#social-preview-' + index).show();
            };
            reader.readAsDataURL(file);
        }
    }
    function previewImage_afs(event, index) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#preview-afs-' + index).attr('src', e.target.result);
                $('#afs-preview-' + index).show();
            };
            reader.readAsDataURL(file);
        }
    }
    function previewImage_mf(event, index) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#preview-mf-' + index).attr('src', e.target.result);
                $('#mf-preview-' + index).show();
            };
            reader.readAsDataURL(file);
        }
    }
</script>

@endsection