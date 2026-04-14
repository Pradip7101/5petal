<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\SeasonCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductsController extends Controller
{
    // Display a listing of the products.
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    // Display a specific product.
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    // Show the form for creating a new product.
    public function create()
    {
        $categories = Category::all();
        $seasonCategories = SeasonCategory::all();
        $blouseProducts = Product::where('product_type', 'blouse')->get();
        return view('admin.products.create', compact('categories', 'seasonCategories', 'blouseProducts'));
    }

    // Store a newly created product in storage.
    public function store(Request $request)
    { 
        //dd($request);
        // Validate the product data
        $validated = $this->validateData($request);

        // Generate and ensure a unique slug
        $validated['slug'] = $this->generateUniqueSlug($validated['title']);

        // Handle additional information and QA fields
        $validated['additional_information'] = $this->formatJsonField($request->additional_information);
        $validated['qa'] = $this->formatJsonField($request->qa);
        
        // Handle size field for blouse/kurtas_kurtis products and matching blouse for saree
        $validated['product_type'] = $request->product_type;
        if (in_array($request->product_type, ['blouse', 'kurtas_kurtis']) && $request->has('size')) {
            $validated['size'] = $request->size;
            $validated['matching_blouse'] = null;
        } elseif ($request->product_type === 'saree' && $request->has('matching_blouse')) {
            $validated['matching_blouse'] = $request->matching_blouse;
            $validated['size'] = null;
        } else {
            $validated['size'] = null;
            $validated['matching_blouse'] = null;
        }

        // Process and save main product image
        if ($request->hasFile('product_image')) {
            // No need to delete an old file on creation, just upload the new file
            $validated['product_image'] = $this->handleFileUpload($request->file('product_image'));
        }

        // Process and save main product image 2
        if ($request->hasFile('product_image2')) {
            // No need to delete an old file on creation, just upload the new file
            $validated['product_image2'] = $this->handleFileUpload($request->file('product_image2'));
        }

        // Initialize gallery images array
        $galleryImages = [];

        // Check if there are product gallery images in the request
        if ($request->has('product_gallery_images')) {
            $submittedImages = $validated['product_gallery_images'];

            foreach ($submittedImages as $index => $subImages) {
                // Handle new image upload
                $galleryImages[$index] = [
                    'pro_image' => isset($subImages['pro_image']) ? $this->handleFileUpload($subImages['pro_image']) : null,
                ];
            }

            // Encode gallery images for storing in the database
            $validated['product_gallery_images'] = json_encode(array_values($galleryImages));
        } else {
            // If no gallery images are provided, ensure the field is stored as an empty array
            $validated['product_gallery_images'] = json_encode([]);
        }

        // Create the product with validated data
        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    // Show the form for editing the specified product.
    public function edit(Product $product)
    {
        $categories = Category::all();
        $seasonCategories = SeasonCategory::all();
        $blouseProducts = Product::where('product_type', 'blouse')->get();
        return view('admin.products.edit', compact('product', 'categories', 'seasonCategories', 'blouseProducts'));
    }

    // Update the specified product in storage.
    public function update(Request $request, Product $product)
    {
        // Validate the product data
        $validated = $this->validateData($request, $product->id);
    
        // Generate a slug if the title has changed, ensuring it's unique
        $validated['slug'] = $this->generateUniqueSlug($validated['title'], $product->id);
    
        // Handle additional information and QA fields
        $validated['additional_information'] = $this->formatJsonField($request->additional_information);
        $validated['qa'] = $this->formatJsonField($request->qa);
        
        // Handle product type, size and matching blouse
        $product->product_type = $request->product_type;
        if (in_array($request->product_type, ['blouse', 'kurtas_kurtis']) && $request->has('size')) {
            $product->size = $request->size;
            $product->matching_blouse = null;
        } elseif ($request->product_type === 'saree' && $request->has('matching_blouse')) {
            $product->matching_blouse = $request->matching_blouse;
            $product->size = null;
        } else {
            $product->size = null;
            $product->matching_blouse = null;
        }
    
        // Handle main product images
        if ($request->hasFile('product_image')) {
            $this->deleteOldFile($product->product_image);
            $validated['product_image'] = $this->handleFileUpload($request->file('product_image'));
        }
        if ($request->hasFile('product_image2')) {
            $this->deleteOldFile($product->product_image2);
            $validated['product_image2'] = $this->handleFileUpload($request->file('product_image2'));
        }
    
        // Manage product gallery images
        $existingImages = json_decode($product->product_gallery_images, true) ?? [];
        $updatedImages = []; // Start with an empty array to accumulate images
        $submittedExistingImages = array_column($request->input('product_gallery_images', []), 'pro_image');
        $removedImages = $request->input('removed_images', []);

        // Retain images that are not marked for deletion
        if ($existingImages) {
            foreach ($existingImages as $index => $existingImage) {
                if (
                    in_array($existingImage['pro_image'], $submittedExistingImages) &&
                    !in_array($existingImage['pro_image'], $removedImages)
                ) { 
                    $updatedImages[] = $existingImage;
                } elseif (in_array($index, $removedImages)) {
                    // Remove image file if marked for deletion by index
                    $imagePath = public_path('admin_assets/uploads/') . $existingImage['pro_image'];
                    if (file_exists($imagePath)) {
                        @unlink($imagePath);
                    }
                }
            }
        }

        // Process and save new images
        if ($request->file('product_gallery_images')) { 
            foreach ($request->file('product_gallery_images') as $file) {
                // Assuming $file['pro_image'] contains the actual UploadedFile instance
                if (isset($file['pro_image']) && $file['pro_image'] instanceof \Illuminate\Http\UploadedFile) {
                    // Call handleFileUpload with the correct file object
                    $newImagePath = $this->handleFileUpload($file['pro_image']);
                    $updatedImages[] = ['pro_image' => $newImagePath];
                }
            }
        }

        // Encode the updated gallery and store it
        $validated['product_gallery_images'] = json_encode($updatedImages);
    
        // Update the product in the database
        $product->update($validated);
        $product->save(); // Ensure the direct assignments are saved
    
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }
    
    
    // Remove the specified product from storage.
    public function destroy(Product $product)
    {
        // Delete old images associated with the product
        if(isset($product->product_image)){
            $this->deleteOldFile($product->product_image);
        }
        if(isset($product->product_image2)){
            $this->deleteOldFile($product->product_image2);
        }

        if(isset($product->product_gallery_images) && $product->product_gallery_images!=null){
            foreach (json_decode($product->product_gallery_images, true) as $image) {
                if($image['pro_image']){
                    $imagePath = public_path('admin_assets/uploads/') . $image['pro_image'];
                    if (file_exists($imagePath)) {
                        @unlink($imagePath);
                    }
                }
            }
        }

        // Delete the product record from the database
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    // Validate product data
    private function validateData(Request $request, $dataId = null)
    {
        $uniqueSkuRule = Rule::unique('products', 'sku')->ignore($dataId);
        
        // Define the validation rules
        $rules = [
            'title' => 'required|string|max:255',
            'sku' => ['required', 'string', 'max:255', $uniqueSkuRule],
            'product_type' => 'nullable|in:saree,blouse,kurtas_kurtis',
            'size' => 'nullable|array',
            'size.*' => 'in:XS,S,M,L,XL,XXL',
            'matching_blouse' => 'nullable|array',
            'matching_blouse.*' => 'exists:products,id',
            'craft' => 'nullable|string|max:255',
            'material' => 'nullable|string|max:255',
            'man_hours' => 'nullable|string|max:255',
            'first_order_free_gift' => 'nullable|string|max:255',
            'third_order_free_gift' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'disclaimer' => 'nullable|string',
            'model_info' => 'nullable|string|max:255',
            'regular_price' => ['required', 'numeric', function ($attribute, $value, $fail) use ($request) {
                if ($request->sale_price && $value <= $request->sale_price) {
                    $fail('The regular price must be greater than the sale price.');
                }
            }],
            'sale_price' => 'nullable|numeric|lt:regular_price',
            'sale_start' => 'nullable|date',
            'sale_end' => 'nullable|date|after_or_equal:sale_start',
            'stock' => 'required|integer|min:0',
            'reviews_count' => 'nullable|integer|min:0',
            'reviews_average' => 'nullable|numeric|min:0|max:5',

            'category_id' => 'required|exists:categories,id',
            'season_category_id' => 'nullable|exists:season_categories,id',
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'additional_information' => 'nullable|array',
            'additional_information.*.label' => 'nullable|string',
            'additional_information.*.value' => 'nullable|string',
            'qa' => 'nullable|array',
            'qa.*.question' => 'nullable|string',
            'qa.*.answer' => 'nullable|string',
            'product_image' => $dataId ? 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_image2' => $dataId ? 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_gallery_images' => 'nullable|array',
        ];
    
        // Validate only newly uploaded gallery images
        $customMessages = [];
        if ($request->file('product_gallery_images')) {  
            foreach ($request->file('product_gallery_images') as $key => $image) { 
                // Check if the image is a new upload
                if ($image['pro_image'] instanceof \Illuminate\Http\UploadedFile) {
                    $rules["product_gallery_images.$key.pro_image"] = [
                        'nullable', 
                        'image',    // Ensures the uploaded file is an image
                        'mimes:jpeg,png,jpg,gif,svg', // Allowed file types
                        'max:2048', // Max size of each image in kilobytes
                    ];
                }
            }

            // Define user-friendly custom error messages
            foreach ($request->file('product_gallery_images') as $key => $image) {
                $customMessages["product_gallery_images.$key.pro_image.image"] = "The file at position $key must be an image.";
                $customMessages["product_gallery_images.$key.pro_image.mimes"] = "The file at position $key must be a jpeg, png, jpg, gif, or svg image.";
                $customMessages["product_gallery_images.$key.pro_image.max"] = "The file at position $key may not exceed 2 MB.";
            }
        }
    
        // Perform the validation
        return $request->validate($rules, $customMessages);
    }
    

    // Format field to handle empty arrays
    private function formatJsonField($field)
    {
        return $field ? json_encode($field) : null;
    }

    // Generate a unique slug
    private function generateUniqueSlug($title, $productId = null)
    {
        $slug = Str::slug($title);
        $i = 1;
        while (Product::where('slug', $slug)->where('id', '!=', $productId)->exists()) {
            $slug = $slug . '-' . $i++;
        }
        return $slug;
    }

    // Handle file upload
    private function handleFileUpload($file)
    { 
        //dd($file);
        $timestamp = time();
        $originalNameWithExtension = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $originalName = pathinfo($originalNameWithExtension, PATHINFO_FILENAME);
        $imageName = $originalName . '_' . $timestamp . '.' . $extension;
        $file->move(public_path('admin_assets/uploads'), $imageName);
        return $imageName;
    }

    // Delete old file
    private function deleteOldFile($filename)
    {
        $filePath = public_path('admin_assets/uploads/' . $filename);
        if ($filename && file_exists($filePath)) {
            unlink($filePath);
        }
    }
}
