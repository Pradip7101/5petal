@extends('admin.admin_layouts.admin_app')
@section('content')
<div class="content-wrapper">
    <div class="content-margin">
        <div class="dashboard_heading flex-css">
            <div class="name">
                <h2 class="m-0">Edit Product</h2>
            </div>
            <div class="list_links">
                <ul class="p-0 flex-css">
                    <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li>/</li>
                    <li><a href="{{ route('admin.products.index') }}">Product</a></li>
                    <li>/</li>
                    <li class="active">Edit Product</li>
                </ul>
            </div>
        </div>
  
        <section class="dashboard_box users_edit product_create">
            <div class="border-box">
                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-header justify-content-start">
                        <h2>Product Details</h2>
                    </div>
                    
                    <div class="card-body card-padding">
                        <div class="row">
                            <!-- Product Image -->
                            <div class="col-6">
                                <div> 
                                    @if($product->product_image && file_exists(public_path('admin_assets/uploads/' . $product->product_image)))
                                        <div id="image-preview" class="mb-4 profile_image_box" style="display: block;">
                                            <img id="preview-img" src="{{ asset('admin_assets/uploads/' . $product->product_image) }}" class="img-thumbnail" alt="Image Preview" />
                                        </div>
                                    @else
                                        <div id="image-preview" class="mb-4 profile_image_box" style="display: none;">
                                            <img id="preview-img" src="" class="img-thumbnail" alt="Image Preview" />
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="image" class="form-label">Product Image</label>
                                    <div>
                                        <label for="upload_image" class="custom-file-upload form-control">
                                            Upload Your Image 
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 448 512"><path d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3 192 320c0 17.7 14.3 32 32 32s32-14.3 32-32l0-210.7 73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-64z"/></svg>
                                            </span>
                                        </label>
                                        <input id="upload_image" name="product_image" type="file" accept="image/*" class="form-control-file @error('product_image') is-invalid @enderror" style="display: none">
                                        @error('product_image')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Product Image 2 -->
                            <div class="col-6">
                                <div>
                                    @if($product->product_image2 && file_exists(public_path('admin_assets/uploads/' . $product->product_image2)))
                                        <div id="image-preview2" class="mb-4 profile_image_box" style="display: block;">
                                            <img id="preview-img2" src="{{ asset('admin_assets/uploads/' . $product->product_image2) }}" class="img-thumbnail" alt="Image Preview" />
                                        </div>
                                    @else
                                        <div id="image-preview2" class="mb-4 profile_image_box" style="display: none;">
                                            <img id="preview-img2" src="" class="img-thumbnail" alt="Image Preview" />
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="image2" class="form-label">Product Image 2</label>
                                    <div>
                                        <label for="upload_image2" class="custom-file-upload form-control">
                                            Upload Your Image 
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 448 512"><path d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3 192 320c0 17.7 14.3 32 32 32s32-14.3 32-32l0-210.7 73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-64z"/></svg>
                                            </span>
                                        </label>
                                        <input id="upload_image2" name="product_image2" type="file" accept="image/*" class="form-control-file @error('product_image2') is-invalid @enderror" style="display: none">
                                        @error('product_image2')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="product_gallery_images" class="form-label">Product Gallery Images</label>
                            <label for="file-input" class="custom-file-upload form-control">
                                <input type="file" id="file-input" multiple accept="image/*" class="form-control" style="display: none">
                                Upload Your Image Gallery
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 448 512">
                                        <path d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3 192 320c0 17.7 14.3 32 32 32s32-14.3 32-32l0-210.7 73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 64c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-64z"/>
                                    </svg>
                                </span>
                            </label>
                        </div>
                        <div id="preview" class="image_gallery_flex" style="display:flex;">
                            <!-- Existing images preview -->
                            @foreach(json_decode($product->product_gallery_images, true) ?? [] as $index => $image)
                                <div class="galley_image_box" data-index="{{ $index }}">
                                    <img src="{{ asset('admin_assets/uploads/' . $image['pro_image']) }}" alt="Image {{ $index + 1 }}">
                                    <button class="remove-btn" type="button" data-index="{{ $index }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="14" height="14">
                                            <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
                                        </svg>
                                    </button>
                                    <input type="hidden" name="product_gallery_images[{{ $index }}][pro_image]" value="{{ $image['pro_image'] }}">
                                </div>
                            @endforeach
                        </div>
                        <div id="hidden-inputs"></div>
                        @error('product_gallery_images')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror

                        <!-- Specific error for each item in the product_gallery_images array -->
                        @foreach($errors->get('product_gallery_images.*.pro_image') as $errorMessage)
                            <span class="invalid-feedback d-block">{{ $errorMessage[0] }}</span>
                        @endforeach

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title', $product->title) }}">
                                @error('title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="sku" class="form-label">SKU</label>
                                <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror" id="sku" value="{{ old('sku', $product->sku) }}">
                                @error('sku')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="regular_price" class="form-label">Regular Price</label>
                                <input type="number" step="0.01" name="regular_price" class="form-control @error('regular_price') is-invalid @enderror" id="regular_price" value="{{ old('regular_price', $product->regular_price) }}">
                                @error('regular_price')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="sale_price" class="form-label">Sale Price</label>
                                <input type="number" step="0.01" name="sale_price" class="form-control @error('sale_price') is-invalid @enderror" id="sale_price" value="{{ old('sale_price', $product->sale_price) }}">
                                @error('sale_price')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="sale_start" class="form-label">Sale Start</label>
                                <input type="datetime-local" name="sale_start" class="form-control @error('sale_start') is-invalid @enderror" id="sale_start" value="{{ old('sale_start', $product->sale_start ? $product->sale_start->format('Y-m-d\TH:i') : '') }}">
                                @error('sale_start')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="sale_end" class="form-label">Sale End</label>
                                <input type="datetime-local" name="sale_end" class="form-control @error('sale_end') is-invalid @enderror" id="sale_end" value="{{ old('sale_end', $product->sale_end ? $product->sale_end->format('Y-m-d\TH:i') : '') }}">
                                @error('sale_end')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" id="stock" value="{{ old('stock', $product->stock) }}" min="0">
                                @error('stock')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="reviews_count" class="form-label">Reviews Count</label>
                                <input type="number" name="reviews_count" class="form-control @error('reviews_count') is-invalid @enderror" id="reviews_count" value="{{ old('reviews_count', $product->reviews_count ?? 0) }}" min="0">
                                @error('reviews_count')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="reviews_average" class="form-label">Reviews Average (0-5)</label>
                                <input type="number" step="0.1" name="reviews_average" class="form-control @error('reviews_average') is-invalid @enderror" id="reviews_average" value="{{ old('reviews_average', $product->reviews_average ?? 0) }}" min="0" max="5">
                                @error('reviews_average')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="rating" class="form-label">Rating (0-5)</label>
                                <input type="number" step="0.1" name="rating" class="form-control @error('rating') is-invalid @enderror" id="rating" value="{{ old('rating', $product->rating ?? 0) }}" min="0" max="5">
                                @error('rating')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="product_type" class="form-label">Product Type</label>
                                <select name="product_type" class="custom-select @error('product_type') is-invalid @enderror" id="product_type">
                                    <option value="" selected>Select Product Type</option>
                                    <option value="saree" {{ old('product_type', $product->product_type) == 'saree' ? 'selected' : '' }}>Saree</option>
                                    <option value="blouse" {{ old('product_type', $product->product_type) == 'blouse' ? 'selected' : '' }}>Blouse</option>
                                    <option value="kurtas_kurtis" {{ old('product_type', $product->product_type) == 'kurtas_kurtis' ? 'selected' : '' }}>Kurtas & Kurtis</option>
                                </select>
                                @error('product_type')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" class="custom-select @error('category_id') is-invalid @enderror" id="category_id">
                                    <option value="" selected>Select Category</option>
                                    @foreach($categories as $category)
                                        @if(!$category->parent_id)
                                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                            @foreach($category->children as $child)
                                                <option value="{{ $child->id }}" {{ old('category_id', $product->category_id) == $child->id ? 'selected' : '' }}>
                                                    &nbsp;&nbsp;&mdash; {{ $child->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="season_category_id" class="form-label">Season Category</label>
                                <select name="season_category_id" class="custom-select @error('season_category_id') is-invalid @enderror" id="season_category_id">
                                <option value="">Select Season Category...</option>
                                    @foreach($seasonCategories as $seasonCategory)
                                        <option value="{{ $seasonCategory->id }}" {{ old('season_category_id', $product->season_category_id) == $seasonCategory->id ? 'selected' : '' }}>
                                            {{ $seasonCategory->title }}
                                        </option>
                                    @endforeach 
                                </select>
                                @error('season_category_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Size Field - Only show for Blouse -->
                        @php
                            $selectedSizes = $product->size ?? [];
                        @endphp
                        <div class="row" id="size-field" style="display: {{ old('product_type', $product->product_type) == 'blouse' ? 'block' : 'none' }};">
                            <div class="col-md-6 form-group">
                                <label for="size" class="form-label">Size</label>
                                <div class="size-checkbox-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="size[]" value="XS" id="size_xs" {{ in_array('XS', old('size', $selectedSizes)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="size_xs">XS</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="size[]" value="S" id="size_s" {{ in_array('S', old('size', $selectedSizes)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="size_s">S</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="size[]" value="M" id="size_m" {{ in_array('M', old('size', $selectedSizes)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="size_m">M</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="size[]" value="L" id="size_l" {{ in_array('L', old('size', $selectedSizes)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="size_l">L</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="size[]" value="XL" id="size_xl" {{ in_array('XL', old('size', $selectedSizes)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="size_xl">XL</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="size[]" value="XXL" id="size_xxl" {{ in_array('XXL', old('size', $selectedSizes)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="size_xxl">XXL</label>
                                    </div>
                                </div>
                                @error('size')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Matching Blouse Field - Only show for Saree -->
                        @php
                            $selectedMatchingBlouse = $product->matching_blouse ?? [];
                        @endphp
                        <div class="row" id="matching-blouse-field" style="display: {{ old('product_type', $product->product_type) == 'saree' ? 'block' : 'none' }};">
                            <div class="col-md-6 form-group">
                                <label for="matching_blouse" class="form-label">Matching Blouse</label>
                                <select name="matching_blouse[]" class="custom-select @error('matching_blouse') is-invalid @enderror" id="matching_blouse" multiple>
                                    @foreach($blouseProducts as $blouse)
                                        <option value="{{ $blouse->id }}" {{ in_array($blouse->id, old('matching_blouse', $selectedMatchingBlouse)) ? 'selected' : '' }}>
                                            {{ $blouse->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('matching_blouse')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- New Product Details Fields -->
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="craft" class="form-label">Craft</label>
                                <input type="text" name="craft" class="form-control @error('craft') is-invalid @enderror" id="craft" value="{{ old('craft', $product->craft) }}">
                                @error('craft')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="material" class="form-label">Material</label>
                                <input type="text" name="material" class="form-control @error('material') is-invalid @enderror" id="material" value="{{ old('material', $product->material) }}">
                                @error('material')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="man_hours" class="form-label">Man Hours</label>
                                <input type="text" name="man_hours" class="form-control @error('man_hours') is-invalid @enderror" id="man_hours" value="{{ old('man_hours', $product->man_hours) }}">
                                @error('man_hours')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="first_order_free_gift" class="form-label">1st Order Free Gift</label>
                                <input type="text" name="first_order_free_gift" class="form-control @error('first_order_free_gift') is-invalid @enderror" id="first_order_free_gift" value="{{ old('first_order_free_gift', $product->first_order_free_gift) }}">
                                @error('first_order_free_gift')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="third_order_free_gift" class="form-label">3rd Order Free Gift</label>
                                <input type="text" name="third_order_free_gift" class="form-control @error('third_order_free_gift') is-invalid @enderror" id="third_order_free_gift" value="{{ old('third_order_free_gift', $product->third_order_free_gift) }}">
                                @error('third_order_free_gift')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="color" class="form-label">Color</label>
                                <input type="text" name="color" class="form-control @error('color') is-invalid @enderror" id="color" value="{{ old('color', $product->color) }}">
                                @error('color')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="model_info" class="form-label">Model Info</label>
                                <input type="text" name="model_info" class="form-control @error('model_info') is-invalid @enderror" id="model_info" value="{{ old('model_info', $product->model_info) }}" placeholder="e.g., The model (height 5'8) is wearing a size S.">
                                @error('model_info')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="disclaimer" class="form-label">Disclaimer</label>
                            <textarea name="disclaimer" class="form-control @error('disclaimer') is-invalid @enderror" id="disclaimer" rows="3" placeholder="e.g., There might be a slight variation in the actual color of the product due to different screen resolutions.">{{ old('disclaimer', $product->disclaimer) }}</textarea>
                            @error('disclaimer')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="short_description" class="form-label">Short Description</label>
                                    <textarea name="short_description" class="form-control @error('short_description') is-invalid @enderror" id="proShortDesc">{{ old('short_description', $product->short_description) }}</textarea>
                                    @error('short_description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="long_description" class="form-label">Long Description</label>
                                    <textarea name="long_description" class="form-control @error('long_description') is-invalid @enderror" id="proLongDesc">{{ old('long_description', $product->long_description) }}</textarea>
                                    @error('long_description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="additional_information" class="form-label">Additional Information</label>
                            <div id="additional-information-fields">
                                <div class="add_info_repeater">
                                    <div data-repeater-list="additional_information">
                                        @php
                                            $additionalInformation = json_decode($product->additional_information, true) ?? [];
                                        @endphp
                                        @forelse($additionalInformation as $info)
                                            <div data-repeater-item>
                                                <div class="input-group mb-3">
                                                    <div class="col-5">
                                                        <input type="text" name="additional_information[][label]" class="form-control @error('additional_information.*.label') is-invalid @enderror" placeholder="Label" value="{{ old('additional_information.*.label', $info['label']) }}">
                                                    </div>
                                                    <div class="col-5">
                                                        <input type="text" name="additional_information[][value]" class="form-control ms-2 @error('additional_information.*.value') is-invalid @enderror" placeholder="Value" value="{{ old('additional_information.*.value', $info['value']) }}">
                                                        @error('additional_information.*.label')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                        @error('additional_information.*.value')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-2 pt-3">
                                                        <button data-repeater-delete type="button" class="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20"><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"></path></svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div data-repeater-item>
                                                <div class="input-group mb-3">
                                                    <div class="col-5">
                                                        <input type="text" name="additional_information[][label]" class="form-control @error('additional_information.*.label') is-invalid @enderror" placeholder="Label" value="{{ old('additional_information.*.label') }}">
                                                    </div>
                                                    <div class="col-5">
                                                        <input type="text" name="additional_information[][value]" class="form-control ms-2 @error('additional_information.*.value') is-invalid @enderror" placeholder="Value" value="{{ old('additional_information.*.value') }}">
                                                        @error('additional_information.*.label')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                        @error('additional_information.*.value')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-2 pt-3">
                                                        <button data-repeater-delete type="button" class="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20"><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"></path></svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                    <button data-repeater-create type="button" class="submit_btn"><i class="fas fa-plus-circle"></i> Add More</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="qa" class="form-label">Q&A</label>
                            <div id="qa-fields">
                                <div class="qa_repeater">
                                    <div data-repeater-list="qa">
                                        @php
                                            $qas = json_decode($product->qa, true) ?? [];
                                        @endphp
                                        @forelse ($qas as $qa)
                                            <div data-repeater-item>
                                                <div class="input-group mb-3">
                                                    <div class="col-5">
                                                        <textarea type="text" name="qa[][question]" class="form-control @error('qa.*.question') is-invalid @enderror" placeholder="Question">{{ old('qa.*.question', $qa['question']) }}</textarea>
                                                    </div>
                                                    <div class="col-5">
                                                        <textarea type="text" name="qa[][answer]" class="form-control ms-2 @error('qa.*.answer') is-invalid @enderror" placeholder="Answer">{{ old('qa.*.answer', $qa['answer']) }}</textarea>
                                                        @error('qa.*.question')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                        @error('qa.*.answer')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-2 pt-3">
                                                        <button data-repeater-delete type="button" class="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20"><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"></path></svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div data-repeater-item>
                                                <div class="input-group mb-3">
                                                    <div class="col-5">
                                                        <textarea type="text" name="qa[][question]" class="form-control @error('qa.*.question') is-invalid @enderror" placeholder="Question">{{ old('qa.*.question') }}</textarea>
                                                    </div>
                                                    <div class="col-5">
                                                        <textarea type="text" name="qa[][answer]" class="form-control ms-2 @error('qa.*.answer') is-invalid @enderror" placeholder="Answer">{{ old('qa.*.answer') }}</textarea>
                                                        @error('qa.*.question')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                        @error('qa.*.answer')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-2 pt-3">
                                                        <button data-repeater-delete type="button" class="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20"><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"></path></svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                    <button data-repeater-create type="button" class="submit_btn"><i class="fas fa-plus-circle"></i> Add More</button>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="submit_btn">Update Product</button>
                            <a href="{{ route('admin.products.index') }}" class="back_btn">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
<script>
    let fileIndex = {{ count(json_decode($product->product_gallery_images, true) ?? []) }};
    let removedImages = []; // Track removed images

    if(fileIndex === 0){
        $('#preview').css('display', 'none');
    }
    $('#file-input').on('change', function(e) {
        const files = e.target.files;

        if (files.length > 0) {
            $('#preview').css('display', 'flex');
            $('#hidden-inputs').empty();

            Array.from(files).forEach((file) => {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const imageHTML = `
                        <div class="galley_image_box" data-index="${fileIndex}">
                            <img src="${e.target.result}" alt="Image ${fileIndex + 1}">
                            <button class="remove-btn" type="button" data-index="${fileIndex}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" width="14" height="14">
                                    <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
                                </svg>
                            </button>
                        </div>
                    `;
                    $('#preview').append(imageHTML);

                    const fileInput = document.createElement('input');
                    fileInput.type = 'file';
                    fileInput.name = `product_gallery_images[${fileIndex}][pro_image]`;
                    fileInput.style.display = 'none';

                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    fileInput.files = dataTransfer.files;

                    document.getElementById('hidden-inputs').appendChild(fileInput);

                    fileIndex++;
                };

                reader.readAsDataURL(file);
            });
        } else {
            $('#preview').hide();
        }
    });

    $('#preview').on('click', '.remove-btn', function() {
        const index = $(this).data('index');
        removedImages.push(index);

        $(`div[data-index="${index}"]`).remove();
        $(`#hidden-inputs input[name="product_gallery_images[${index}][pro_image]"]`).remove();

        if ($('#preview').children().length === 0) {
            $('#preview').hide();
        }
    });

    $('form').on('submit', function() {
        if(removedImages){
            removedImages.forEach(function(image) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'removed_images[]',
                    value: image
                }).appendTo('form');
            });
        }
    });
</script>
<script>
    // Show/hide size field based on product type selection
    $('#product_type').on('change', function() {
        if ($(this).val() === 'blouse' || $(this).val() === 'kurtas_kurtis') {
            $('#size-field').show();
            $('#matching-blouse-field').hide();
            $('#matching_blouse').val([]);
        } else if ($(this).val() === 'saree') {
            $('#size-field').hide();
            $('#matching-blouse-field').show();
            $('input[name="size[]"]').prop('checked', false);
        } else {
            $('#size-field').hide();
            $('#matching-blouse-field').hide();
            $('input[name="size[]"]').prop('checked', false);
            $('#matching_blouse').val([]);
        }
    });
    
    // Show appropriate field on page load
    $(document).ready(function() {
        if ($('#product_type').val() === 'blouse' ||  $('#product_type').val() === 'kurtas_kurtis') {
            $('#size-field').show();
        } else if ($('#product_type').val() === 'saree') {
            $('#matching-blouse-field').show();
        }
    });
</script>


@endsection
