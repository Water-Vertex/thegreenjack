<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('components.admin-layout')]
class Products extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $perPage = 10;

    // Form properties
    public $showForm = false;
    public $formType = 'create'; // 'create' or 'edit'
    public $productId = null;

    // Product fields
    public $name = '';
    public $slug = '';
    public $description = '';
    public $image;
    public $existingImage = null;
    public $price = 0;
    public $discounted_price = 0;
    public $stock = 0;
    public $is_active = true;
    public $upc = '';
    public $sku = '';
    public $asin = '';
    public $manufacturer = '';
    public $moq = null;
    public $meta_description = '';
    public $meta_title = '';
    public $meta_keywords = '';
    public $meta_tags = '';
    public $page_schemas = '';
    public $category_id = '';
    public $sub_category_id = '';

    // Product Images - For multiple file upload
    public $galleryImages = []; // For temporary uploaded multiple images
    public $existingGalleryImages = []; // For existing images from database
    public $deletedImages = []; // Track images to delete

    // SEO Analysis properties
    public $seoScore = 0;
    public $seoMetrics = [];

    // Dependent dropdown
    public $subCategories = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'name'],
        'sortDirection' => ['except' => 'asc'],
        'perPage' => ['except' => 10]
    ];

    protected $rules = [
        'name' => 'required|string|max:255',
        'slug' => 'nullable|string|max:255|unique:products,slug',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
        'galleryImages.*' => 'nullable|image|max:2048',
        'price' => 'required|numeric|min:0',
        'discounted_price' => 'nullable|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'is_active' => 'boolean',
        'upc' => 'nullable|string|max:50',
        'sku' => 'nullable|string|max:100',
        'asin' => 'nullable|string|max:50',
        'manufacturer' => 'nullable|string|max:255',
        'moq' => 'nullable|integer|min:1',
        'meta_description' => 'nullable|string',
        'meta_title' => 'nullable|string|max:255',
        'meta_keywords' => 'nullable|string',
        'meta_tags' => 'nullable|string',
        'page_schemas' => 'nullable|string',
        'category_id' => 'nullable|exists:categories,id',
        'sub_category_id' => 'nullable|exists:sub_categories,id',
    ];

    public function mount()
    {
        $this->resetForm();
        $this->subCategories = collect();
    }

    public function resetForm()
    {
        $this->reset([
            'showForm', 'formType', 'productId', 'name', 'slug', 'description',
            'image', 'existingImage', 'price', 'discounted_price', 'stock',
            'is_active', 'upc', 'sku', 'asin', 'manufacturer', 'moq',
            'meta_title', 'meta_description', 'meta_keywords', 'meta_tags',
            'page_schemas', 'category_id', 'sub_category_id', 'seoScore', 'seoMetrics',
            'galleryImages', 'deletedImages'
        ]);
        $this->subCategories = collect();
        $this->galleryImages = [];
        $this->existingGalleryImages = [];
        $this->deletedImages = [];
    }

    public function updatedCategoryId($value)
    {
        if ($value) {
            $this->subCategories = SubCategory::where('category_id', $value)
                ->where('is_active', true)
                ->orderBy('name')
                ->get();
        } else {
            $this->subCategories = collect();
            $this->sub_category_id = '';
        }
    }

    public function updatedName()
    {
        if ($this->formType === 'create' || !$this->slug) {
            $this->slug = Str::slug($this->name);
        }
        $this->analyzeSeo();
    }

    public function updatedPrice()
    {
        $this->analyzeSeo();
    }

    // Remove existing image from database
    public function removeExistingImage($imageId, $imagePath)
    {
        $this->deletedImages[] = [
            'id' => $imageId,
            'path' => $imagePath
        ];

        // Remove from the existingGalleryImages array
        $this->existingGalleryImages = array_filter($this->existingGalleryImages, function($img) use ($imageId) {
            return $img['id'] != $imageId;
        });

        // Reindex the array
        $this->existingGalleryImages = array_values($this->existingGalleryImages);
    }

    // Remove new uploaded image preview
    public function removeNewImage($index)
    {
        unset($this->galleryImages[$index]);
        $this->galleryImages = array_values($this->galleryImages);
    }

    public function analyzeSeo()
    {
        $this->seoMetrics = [];

        // Analyze Product Name
        $nameLength = strlen($this->name);
        $this->seoMetrics[] = [
            'name' => 'Product Name',
            'status' => $nameLength >= 10 && $nameLength <= 70,
            'message' => "{$nameLength}/70 chars",
            'weight' => 15
        ];

        // Analyze Meta Title
        $metaTitleLength = strlen($this->meta_title ?: $this->name);
        $this->seoMetrics[] = [
            'name' => 'Meta Title',
            'status' => $metaTitleLength >= 10 && $metaTitleLength <= 60,
            'message' => "{$metaTitleLength}/60 chars",
            'weight' => 15
        ];

        // Analyze Meta Description
        $metaDescLength = strlen($this->meta_description);
        $this->seoMetrics[] = [
            'name' => 'Meta Description',
            'status' => $metaDescLength >= 50 && $metaDescLength <= 160,
            'message' => "{$metaDescLength}/160 chars",
            'weight' => 15
        ];

        // Analyze Description Content
        $textContent = strip_tags($this->description);
        $wordCount = str_word_count($textContent);
        $this->seoMetrics[] = [
            'name' => 'Description Length',
            'status' => $wordCount >= 100,
            'message' => "{$wordCount}/100+ words",
            'weight' => 15
        ];

        // Analyze Price
        $hasPrice = $this->price > 0;
        $this->seoMetrics[] = [
            'name' => 'Product Price',
            'status' => $hasPrice,
            'message' => $hasPrice ? '$' . number_format($this->price, 2) : 'Missing',
            'weight' => 10
        ];

        // Analyze SKU/UPC
        $hasIdentifier = !empty($this->sku) || !empty($this->upc);
        $this->seoMetrics[] = [
            'name' => 'Product Identifier',
            'status' => $hasIdentifier,
            'message' => $hasIdentifier ? 'SKU/UPC added' : 'Missing SKU/UPC',
            'weight' => 10
        ];

        // Analyze Stock
        $this->seoMetrics[] = [
            'name' => 'Stock Status',
            'status' => $this->stock > 0,
            'message' => $this->stock > 0 ? "{$this->stock} in stock" : 'Out of stock',
            'weight' => 10
        ];

        // Analyze Category
        $hasCategory = !empty($this->category_id);
        $this->seoMetrics[] = [
            'name' => 'Category Assignment',
            'status' => $hasCategory,
            'message' => $hasCategory ? 'Assigned' : 'Not assigned',
            'weight' => 10
        ];

        // Calculate overall score
        $this->calculateSeoScore();
    }

    private function calculateSeoScore()
    {
        $totalWeight = 0;
        $achievedWeight = 0;

        foreach ($this->seoMetrics as $metric) {
            $totalWeight += $metric['weight'];
            if ($metric['status']) {
                $achievedWeight += $metric['weight'];
            }
        }

        $this->seoScore = $totalWeight > 0 ?
            round(($achievedWeight / $totalWeight) * 100) : 0;
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function create()
    {
        $this->resetForm();
        $this->formType = 'create';
        $this->showForm = true;
        $this->analyzeSeo();
    }

    public function edit($productId)
    {
        $product = Product::findOrFail($productId);

        $this->formType = 'edit';
        $this->productId = $product->id;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->description = $product->description;
        $this->existingImage = $product->image;
        $this->price = $product->price;
        $this->discounted_price = $product->discounted_price;
        $this->stock = $product->stock;
        $this->is_active = $product->is_active;
        $this->upc = $product->upc;
        $this->sku = $product->sku;
        $this->asin = $product->asin;
        $this->manufacturer = $product->manufacturer;
        $this->moq = $product->moq;
        $this->meta_title = $product->meta_title;
        $this->meta_description = $product->meta_description;
        $this->meta_keywords = $product->meta_keywords;
        $this->meta_tags = $product->meta_tags;
        $this->page_schemas = $product->page_schemas;
        $this->category_id = $product->category_id;
        $this->sub_category_id = $product->sub_category_id;

        // Load existing product gallery images
        $productImages = ProductImage::where('product_id', $productId)->first();
        if ($productImages && $productImages->images) {
            $images = json_decode($productImages->images, true);
            if (is_array($images)) {
                $this->existingGalleryImages = [];
                foreach ($images as $image) {
                    $this->existingGalleryImages[] = [
                        'id' => $productImages->id,
                        'path' => $image
                    ];
                }
            }
        }

        // Load subcategories if category selected
        if ($this->category_id) {
            $this->subCategories = SubCategory::where('category_id', $this->category_id)
                ->where('is_active', true)
                ->orderBy('name')
                ->get();
        }

        $this->showForm = true;
        $this->analyzeSeo();
    }

    public function save()
    {
        $rules = $this->rules;

        // Make slug unique rule for update
        if ($this->formType === 'edit' && $this->productId) {
            $rules['slug'] = 'nullable|string|max:255|unique:products,slug,' . $this->productId;
        }

        $this->validate($rules);

        // Generate slug if empty
        if (empty($this->slug)) {
            $this->slug = Str::slug($this->name);
        }

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'discounted_price' => $this->discounted_price ?: 0,
            'stock' => $this->stock,
            'is_active' => $this->is_active,
            'upc' => $this->upc,
            'sku' => $this->sku,
            'asin' => $this->asin,
            'manufacturer' => $this->manufacturer,
            'moq' => $this->moq,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'meta_tags' => $this->meta_tags,
            'page_schemas' => $this->page_schemas,
            'category_id' => $this->category_id ?: null,
            'sub_category_id' => $this->sub_category_id ?: null,
        ];

        // Handle main image upload
        if ($this->image) {
            $imagePath = $this->image->store('products', 'public');
            $data['image'] = $imagePath;

            // Delete old image if exists
            if ($this->formType === 'edit' && $this->existingImage) {
                Storage::disk('public')->delete($this->existingImage);
            }
        }

        if ($this->formType === 'create') {
            $product = Product::create($data);
            $productId = $product->id;
            session()->flash('success', 'Product created successfully.');
        } else {
            $product = Product::findOrFail($this->productId);
            $product->update($data);
            $productId = $this->productId;
            session()->flash('success', 'Product updated successfully.');

            // Delete removed gallery images from storage
            foreach ($this->deletedImages as $deletedImage) {
                Storage::disk('public')->delete($deletedImage['path']);
            }
        }

        // Handle multiple gallery images
        $imagePaths = [];

        // Keep existing images that weren't deleted
        if (!empty($this->existingGalleryImages)) {
            foreach ($this->existingGalleryImages as $existingImage) {
                $imagePaths[] = $existingImage['path'];
            }
        }

        // Process newly uploaded gallery images
        if (!empty($this->galleryImages) && is_array($this->galleryImages)) {
            foreach ($this->galleryImages as $galleryImage) {
                if ($galleryImage && is_object($galleryImage)) {
                    $path = $galleryImage->store('product-gallery', 'public');
                    $imagePaths[] = $path;
                }
            }
        }

        // Save to product_images table
        if (!empty($imagePaths)) {
            ProductImage::updateOrCreate(
                ['product_id' => $productId],
                ['images' => json_encode($imagePaths)]
            );
        } else {
            // If no images, delete the record
            ProductImage::where('product_id', $productId)->delete();
        }

        $this->resetForm();
    }

    public function delete($productId)
    {
        $product = Product::findOrFail($productId);

        // Delete main image
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // Delete gallery images from product_images table
        $productImages = ProductImage::where('product_id', $productId)->first();
        if ($productImages && $productImages->images) {
            $images = json_decode($productImages->images, true);
            if (is_array($images)) {
                foreach ($images as $imagePath) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
            $productImages->delete();
        }

        $product->delete();
        session()->flash('success', 'Product deleted successfully.');
    }

    public function toggleStatus($productId)
    {
        $product = Product::findOrFail($productId);
        $product->update(['is_active' => !$product->is_active]);

        session()->flash('success', 'Product status updated successfully.');
    }

    public function render()
    {
        $products = Product::with(['category', 'subCategory'])
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%')
                      ->orWhere('sku', 'like', '%' . $this->search . '%')
                      ->orWhere('upc', 'like', '%' . $this->search . '%')
                      ->orWhere('manufacturer', 'like', '%' . $this->search . '%')
                      ->orWhere('meta_title', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('livewire.admin.products', [
            'products' => $products,
            'categories' => $categories
        ]);
    }
}
