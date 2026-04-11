@extends('admin.admin_layouts.admin_app')

@section('content')
<div class="content-wrapper">
    <div class="content-margin">
        <div class="dashboard_heading flex-css">
            <div class="name">
                <h2 class="m-0">Product Details</h2>
            </div>
            <div class="list_links">
                <ul class="p-0 flex-css">
                    <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li>/</li>
                    <li><a href="{{ route('admin.products.index') }}">Product</a></li>
                    <li>/</li>
                    <li class="active">Product Details</li>
                </ul>
            </div>
        </div>
        <section class="dashboard_box dashboard_padding product_show">
            <div class="border-box profile_edit">
                <div class="card-header">
                    <h2>Product Details</h2>
                </div>
                <div class="card-body background-colour">
                    <div class="border-box-two">
                        <div class="row ">
                            <!-- <div class="col-md-6">
                                <p><strong>Product Image:</strong></p>
                                @if($product->product_image)
                                    <img src="{{ asset('admin_assets/uploads/' . $product->product_image) }}" alt="Product Image" class="img-fluid">
                                @else
                                    <p>No image available.</p>
                                @endif
                            </div> -->
                            <div class="col-md-6">
                                <p><strong>Product Image:</strong></p>
                                <div class="galley_image_box">
                                    @if($product->product_image)
                                        <img src="{{ asset('admin_assets/uploads/' . $product->product_image) }}" alt="Product Image" class="img-fluid">
                                    @else
                                        <p>No image available.</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Product Image 2:</strong></p>
                                <div class="galley_image_box ">
                                    @if($product->product_image2)
                                        <img src="{{ asset('admin_assets/uploads/' . $product->product_image2) }}" alt="Product Image 2" class="img-fluid">
                                    @else
                                        <p>No image available.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-4 border-box-two">
                        <p><strong>Gallery Images:</strong></p>
                        @if(!empty(json_decode($product->product_gallery_images)))
                            <div class="image_gallery_flex galley_image_show">
                                @foreach(json_decode($product->product_gallery_images) as $galleryImage)
                                    <div class="galley_image_box">
                                        <img src="{{ asset('admin_assets/uploads/' . $galleryImage->pro_image) }}" alt="Gallery Image" class="img-fluid">
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p>No gallery images available.</p>
                        @endif
                    </div>

                    <div class="mt-4 border-box-two">
                        <div class="row">
                            <div class="col-6">
                                <p><strong>Product Title:</strong> {{ $product->name }}</p>
                            </div>
                            <div class="col-6">
                                <p><strong>SKU:</strong> {{ $product->sku }}</p>
                            </div>
                            <div class="col-6">
                                <p><strong>Regular Price:</strong> ${{ number_format($product->regular_price, 2) }}</p>    
                            </div>
                            <div class="col-6">
                                <p><strong>Sale Price:</strong> ${{ number_format($product->sale_price, 2) }}</p>    
                            </div>
                            <div class="col-6">
                                <p><strong>Stock:</strong> {{ $product->stock }}</p>
                            </div>
                            <div class="col-6">
                                <p><strong>Category:</strong> {{ $product->category->name }}</p>    
                            </div>
                            <div class="col-12">
                                <p><strong>Sale Time:</strong>
                                    @if($product->sale_start && $product->sale_end)
                                        {{ $product->sale_start->format('Y-m-d H:i') }} to {{ $product->sale_end->format('Y-m-d H:i') }}
                                    @else
                                        Not on Sale
                                    @endif
                                </p>    
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 mt-4 border-box-two">
                        <p><strong>Short Description:</strong></p>
                        <p>{{ $product->short_description }}</p>
                        <p><strong>Long Description:</strong></p>
                        <p>{{ $product->long_description }}</p>
                    </div>

                    <div class="mt-4 border-box-two">
                        <p><strong>Additional Information:</strong></p>
                        <div class="row">
                            @if(!empty($product->additional_information))
                                @foreach(json_decode($product->additional_information) as $info)
                                    <div class="col-6">
                                        <p><strong>{{ $info->label }}:</strong> {{ $info->value }}</p>
                                    </div>
                                @endforeach
                            @else
                                <p>No additional information available.</p>
                            @endif
                        </div>
                    </div>

                    <div class="mt-4 border-box-two">
                        <p><strong>Questions & Answers:</strong></p>
                        @if(!empty($product->qa))
                            @foreach(json_decode($product->qa) as $qa)
                                <p><strong>Question : </strong> {{ $qa->question }}</p>
                                <p><strong>Ans : </strong> {{ $qa->answer }}</p>
                            @endforeach
                        @else
                            <p>No Q&A available.</p>
                        @endif
                    </div>

                    <div class="text-right mt-4">
                        <a href="{{ route('admin.products.index') }}" class="submit_btn">Back to Product Management</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
