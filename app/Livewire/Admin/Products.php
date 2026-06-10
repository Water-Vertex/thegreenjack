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
use App\Imports\ProductsImport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

#[Layout('components.admin-layout')]
class Products extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $perPage = 10;

    public $showForm = false;
    public $formType = 'create';
    public $productId = null;

    public $name = '';
    public $slug = '';
    public $description = '';
    public $image;
    public $existingImage = null;
    public $price = 0;
    public $discounted_price = null;
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
    public $focus_keyword = '';
    public $type = '';

    public $galleryImages = [];
    public $existingGalleryImages = [];

    public $seoScore = 0;
    public $seoMetrics = [];
    public $subCategories;

    public $excelFile = null;
    public $showImportModal = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'name'],
        'sortDirection' => ['except' => 'asc'],
        'perPage' => ['except' => 10],
    ];

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug,' . $this->productId,
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
            'focus_keyword' => 'nullable|string|max:255',
            'type' => 'nullable|in:featured,best_seller',
        ];
    }

    public function mount()
    {
        $this->subCategories = collect();
    }

    public function create()
    {
        $this->resetForm();
        $this->showForm = true;
        $this->formType = 'create';
        $this->is_active = true;
    }

    public function resetForm()
    {
        $this->reset([
            'showForm',
            'formType',
            'productId',
            'name',
            'slug',
            'description',
            'image',
            'existingImage',
            'price',
            'discounted_price',
            'stock',
            'is_active',
            'upc',
            'sku',
            'asin',
            'manufacturer',
            'moq',
            'meta_title',
            'meta_description',
            'meta_keywords',
            'meta_tags',
            'page_schemas',
            'category_id',
            'sub_category_id',
            'focus_keyword',
            'type',
            'galleryImages',
            'existingGalleryImages',
            'seoScore',
            'seoMetrics',
        ]);

        $this->formType = 'create';
        $this->price = 0;
        $this->stock = 0;
        $this->is_active = true;
        $this->subCategories = collect();

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updatedName()
    {
        if ($this->formType === 'create') {
            $this->slug = Str::slug($this->name);
        }

        $this->analyzeSeo();
    }

    public function updatedCategoryId($value)
    {
        $this->sub_category_id = '';

        if ($value) {
            $this->subCategories = SubCategory::where('category_id', $value)
                ->orderBy('name')
                ->get();
        } else {
            $this->subCategories = collect();
        }

        $this->analyzeSeo();
    }

    public function save()
    {
        $this->validate();

        if (empty($this->slug)) {
            $this->slug = Str::slug($this->name);
        }

        $imagePath = $this->existingImage;

        if ($this->image) {
            if ($this->existingImage) {
                Storage::disk('public')->delete($this->existingImage);
            }

            $imagePath = $this->image->store('products', 'public');
        }

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'image' => $imagePath,
            'price' => $this->price,
            'discounted_price' => $this->discounted_price ?: null,
            'stock' => $this->stock,
            'is_active' => $this->is_active ? 1 : 0,
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
            'focus_keyword' => $this->focus_keyword,
            'type' => $this->type ?: null,
        ];

        if ($this->formType === 'edit' && $this->productId) {
            $product = Product::findOrFail($this->productId);
            $product->update($data);

            session()->flash('success', 'Product updated successfully.');
        } else {
            $product = Product::create($data);

            session()->flash('success', 'Product created successfully.');
        }

        if (!empty($this->galleryImages)) {
            foreach ($this->galleryImages as $galleryImage) {
                $path = $galleryImage->store('products/gallery', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                    'path' => $path,
                ]);
            }
        }

        $this->resetForm();
        $this->resetPage();
    }

    public function edit($id)
    {
        $product = Product::with('images')->findOrFail($id);

        $this->resetForm();

        $this->productId = $product->id;
        $this->formType = 'edit';
        $this->showForm = true;

        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->description = $product->description;
        $this->existingImage = $product->image;
        $this->price = $product->price;
        $this->discounted_price = $product->discounted_price;
        $this->stock = $product->stock;
        $this->is_active = (bool) $product->is_active;
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
        $this->focus_keyword = $product->focus_keyword;
        $this->type = $product->type;

        if ($product->category_id) {
            $this->subCategories = SubCategory::where('category_id', $product->category_id)
                ->orderBy('name')
                ->get();
        }

        $this->existingGalleryImages = $product->images->map(function ($image) {
            return [
                'id' => $image->id,
                'path' => $image->image ?? $image->path,
            ];
        })->toArray();

        $this->analyzeSeo();
    }

    public function delete($id)
    {
        $product = Product::with('images')->findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image ?? $image->path);
            $image->delete();
        }

        $product->delete();

        session()->flash('success', 'Product deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $product = Product::findOrFail($id);
        $product->update([
            'is_active' => !$product->is_active,
        ]);

        session()->flash('success', 'Status updated successfully.');
    }

    public function removeNewImage($index)
    {
        unset($this->galleryImages[$index]);
        $this->galleryImages = array_values($this->galleryImages);
    }

    public function removeExistingImage($id, $path)
    {
        $image = ProductImage::find($id);

        if ($image) {
            Storage::disk('public')->delete($path);
            $image->delete();
        }

        $this->existingGalleryImages = collect($this->existingGalleryImages)
            ->reject(fn ($item) => $item['id'] == $id)
            ->values()
            ->toArray();

        session()->flash('success', 'Gallery image removed successfully.');
    }

    public function analyzeSeo()
    {
        $score = 0;
        $metrics = [];

        $metrics[] = [
            'name' => 'Product Name',
            'status' => !empty($this->name),
            'message' => !empty($this->name) ? 'Good' : 'Missing',
        ];

        if (!empty($this->name)) $score += 20;

        $metrics[] = [
            'name' => 'Meta Title',
            'status' => !empty($this->meta_title),
            'message' => !empty($this->meta_title) ? 'Good' : 'Missing',
        ];

        if (!empty($this->meta_title)) $score += 20;

        $metrics[] = [
            'name' => 'Meta Description',
            'status' => !empty($this->meta_description),
            'message' => !empty($this->meta_description) ? 'Good' : 'Missing',
        ];

        if (!empty($this->meta_description)) $score += 20;

        $metrics[] = [
            'name' => 'Focus Keyword',
            'status' => !empty($this->focus_keyword),
            'message' => !empty($this->focus_keyword) ? 'Good' : 'Missing',
        ];

        if (!empty($this->focus_keyword)) $score += 20;

        $metrics[] = [
            'name' => 'Description',
            'status' => !empty($this->description),
            'message' => !empty($this->description) ? 'Good' : 'Missing',
        ];

        if (!empty($this->description)) $score += 20;

        $this->seoScore = $score;
        $this->seoMetrics = $metrics;
    }

    public function openImportModal()
    {
        $this->reset(['excelFile']);
        $this->resetErrorBag();
        $this->resetValidation();
        $this->showImportModal = true;
    }

    public function closeImportModal()
    {
        $this->reset(['excelFile', 'showImportModal']);
        $this->resetErrorBag();
        $this->resetValidation();
    }

 public function importProducts()
{
    if (!$this->excelFile) {
        session()->flash('error', 'Please select an Excel file to import');
        return;
    }

    $extension = strtolower($this->excelFile->getClientOriginalExtension());
    if (!in_array($extension, ['xlsx', 'xls', 'csv'])) {
        session()->flash('error', 'The file must be an Excel file (.xlsx, .xls, or .csv)');
        return;
    }

    try {
        $import = new ProductsImport();
        Excel::import($import, $this->excelFile->getRealPath());

        $count = $import->getSuccessCount();
        session()->flash('success', "Successfully imported {$count} products!");

        $this->closeImportModal();
        $this->resetPage();

    } catch (\Exception $e) {
        Log::error('Import error: ' . $e->getMessage());
        session()->flash('error', 'Import failed: ' . $e->getMessage());
    }
}
    public function downloadTemplate()
    {
        $headers = [
            'name',
            'description',
            'stock',
            'discounted_price',
            'price',
            'category_id',
            'is_active',
            'upc',
            'asin',
            'sku',
            'manufacturer',
            'moq',
            'meta_title',
            'meta_description',
            'meta_keywords',
            'meta_tags',
            'page_schemas',
            'sub_category_id',
            'focus_keyword',
            'type',
        ];

        $callback = function () use ($headers) {
            $file = fopen('php://output', 'w');

            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($file, $headers);

            fputcsv($file, [
                'Premium Laptop',
                'High-performance laptop',
                '50',
                '999.99',
                '1299.99',
                '1',
                '1',
                '123456789012',
                'B08N5WRWNW',
                'LAP-001',
                'Dell',
                '5',
                'Premium Laptop - Best Deal',
                'Buy premium laptop online',
                'laptop, premium',
                'premium-laptop',
                '{"@context":"https://schema.org"}',
                '1',
                'premium laptop',
                'featured',
            ]);

            fclose($file);
        };

        return response()->streamDownload($callback, 'product_import_template.csv', [
            'Content-Type' => 'text/csv',
        ]);
    }

    public function render()
    {
        $products = Product::with(['category', 'subCategory'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
                        ->orWhere('sku', 'like', '%' . $this->search . '%')
                        ->orWhere('upc', 'like', '%' . $this->search . '%')
                        ->orWhere('manufacturer', 'like', '%' . $this->search . '%')
                        ->orWhere('meta_title', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('livewire.admin.products', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
