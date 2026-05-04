<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;

#[Layout('components.admin-layout')]
class Brands extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $perPage = 10;

    // Form properties
    public $showForm = false;
    public $formType = 'create';
    public $brandId = null;
    public $selectedCategories = []; // Changed to array for multiple selection
    public $name = '';
    public $slug = '';
    public $description = '';
    public $blog_description = '';
    public $meta_title = '';
    public $meta_description = '';
    public $featured_image;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'name'],
        'sortDirection' => ['except' => 'asc'],
        'perPage' => ['except' => 10]
    ];

    protected $rules = [
        'name' => 'required|string|max:255',
        'selectedCategories' => 'required|array|min:1', // At least one category required
        'selectedCategories.*' => 'exists:categories,id',
        'description' => 'nullable|string',
        'blog_description' => 'nullable|string',
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string',
        'featured_image' => 'nullable|image|max:2048',
    ];

    protected $messages = [
        'selectedCategories.required' => 'Please select at least one category.',
        'selectedCategories.min' => 'Please select at least one category.',
    ];

    public function mount()
    {
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'showForm', 'formType', 'brandId', 'selectedCategories', 'name', 'slug', 'description',
            'blog_description', 'meta_title', 'meta_description', 'featured_image'
        ]);
        $this->resetErrorBag();
    }

    public function updatedName($value)
    {
        if ($this->formType === 'create' && !$this->slug) {
            $this->slug = Str::slug($value);
        }
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
    }

    public function edit($brandId)
    {
        $brand = Brand::with('categories')->findOrFail($brandId);
        
        $this->formType = 'edit';
        $this->brandId = $brand->id;
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->description = $brand->description;
        $this->blog_description = $brand->blog_description;
        $this->meta_title = $brand->meta_title;
        $this->meta_description = $brand->meta_description;
        $this->selectedCategories = $brand->categories->pluck('id')->toArray(); // Get selected category IDs
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'blog_description' => $this->blog_description,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
        ];

        // Handle featured image upload
        if ($this->featured_image) {
            $imagePath = $this->featured_image->store('brands', 'public');
            $data['featured_image'] = $imagePath;
        }

        if ($this->formType === 'create') {
            $brand = Brand::create($data);
            // Attach categories
            $brand->categories()->attach($this->selectedCategories);
            session()->flash('success', 'Brand created successfully.');
        } else {
            $brand = Brand::findOrFail($this->brandId);
            
            // Delete old featured image if new one is uploaded
            if ($this->featured_image && $brand->featured_image) {
                Storage::disk('public')->delete($brand->featured_image);
            }
            
            $brand->update($data);
            // Sync categories (remove old, add new)
            $brand->categories()->sync($this->selectedCategories);
            session()->flash('success', 'Brand updated successfully.');
        }

        $this->resetForm();
    }

    public function delete($brandId)
    {
        $brand = Brand::findOrFail($brandId);
        
        // Delete associated featured image if exists
        if ($brand->featured_image) {
            Storage::disk('public')->delete($brand->featured_image);
        }

        // Detach categories (pivot table records will be deleted automatically due to cascade)
        $brand->categories()->detach();
        
        $brand->delete();
        session()->flash('success', 'Brand deleted successfully.');
    }

    public function removeImage()
    {
        if ($this->brandId) {
            $brand = Brand::findOrFail($this->brandId);
            if ($brand->featured_image) {
                Storage::disk('public')->delete($brand->featured_image);
                $brand->update(['featured_image' => null]);
                session()->flash('success', 'Featured image removed successfully.');
            }
        }
        $this->featured_image = null;
    }

    public function render()
    {
        $categories = Category::orderBy('name')->get();
        $brands = Brand::with('categories')->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%')
                      ->orWhere('blog_description', 'like', '%' . $this->search . '%')
                      ->orWhere('meta_title', 'like', '%' . $this->search . '%')
                      ->orWhere('meta_description', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.brands', [
            'brands' => $brands,
            'categories' => $categories
        ]);
    }
}