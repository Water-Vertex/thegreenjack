<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use App\Models\BrandModel;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;

#[Layout('components.admin-layout')]
class Models extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $perPage = 10;

    // Form properties
    public $showForm = false;
    public $formType = 'create';
    public $modelId = null;
    public $name = '';
    public $brand_id = '';
    public $slug = '';
    public $description = '';
    public $blog_description = '';
    public $meta_title = '';
    public $meta_description = '';
    public $featured_image;
    public $existing_image = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'name'],
        'sortDirection' => ['except' => 'asc'],
        'perPage' => ['except' => 10]
    ];

    protected $rules = [
        'name' => 'required|string|max:255',
        'brand_id' => 'nullable|integer',
        'slug' => 'required|string|max:255|unique:brand_models,slug',
        'description' => 'nullable|string',
        'blog_description' => 'nullable|string',
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string',
        'featured_image' => 'nullable|image|max:2048',
    ];

    public function mount()
    {
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'showForm', 'formType', 'modelId', 'name', 'brand_id', 'slug', 'description',
            'blog_description', 'meta_title', 'meta_description', 'featured_image', 'existing_image'
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

    public function edit($modelId)
    {
        $model = BrandModel::findOrFail($modelId);
        
        $this->formType = 'edit';
        $this->modelId = $model->id;
        $this->name = $model->name;
        $this->brand_id = $model->brand_id;
        $this->slug = $model->slug;
        $this->description = $model->description;
        $this->blog_description = $model->blog_description;
        $this->meta_title = $model->meta_title;
        $this->meta_description = $model->meta_description;
        $this->existing_image = $model->featured_image;
        $this->showForm = true;

        // Update rules for edit
        $this->rules['slug'] = 'required|string|max:255|unique:brand_models,slug,' . $modelId;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'brand_id' => $this->brand_id ?: null,
            'slug' => $this->slug,
            'description' => $this->description,
            'blog_description' => $this->blog_description,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
        ];

        // Handle featured image upload
        if ($this->featured_image) {
            // Delete old image if exists
            if ($this->formType === 'edit' && $this->existing_image) {
                Storage::disk('public')->delete($this->existing_image);
            }
            
            $imagePath = $this->featured_image->store('brand_models', 'public');
            $data['featured_image'] = $imagePath;
        } elseif ($this->formType === 'edit' && $this->existing_image) {
            $data['featured_image'] = $this->existing_image;
        }

        if ($this->formType === 'create') {
            BrandModel::create($data);
            session()->flash('success', 'Brand model created successfully.');
        } else {
            $model = BrandModel::findOrFail($this->modelId);
            $model->update($data);
            session()->flash('success', 'Brand model updated successfully.');
        }

        $this->resetForm();
    }

    public function delete($modelId)
    {
        $model = BrandModel::findOrFail($modelId);
        
        // Delete associated featured image if exists
        if ($model->featured_image) {
            Storage::disk('public')->delete($model->featured_image);
        }

        $model->delete();
        session()->flash('success', 'Brand model deleted successfully.');
    }

    public function removeImage()
    {
        if ($this->modelId) {
            $model = BrandModel::findOrFail($this->modelId);
            if ($model->featured_image) {
                Storage::disk('public')->delete($model->featured_image);
                $model->update(['featured_image' => null]);
                session()->flash('success', 'Featured image removed successfully.');
            }
        }
        $this->featured_image = null;
        $this->existing_image = null;
    }

    public function render()
    {
        $brands = Brand::pluck('name', 'id');
        $models = BrandModel::when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%')
                      ->orWhere('blog_description', 'like', '%' . $this->search . '%')
                      ->orWhere('meta_title', 'like', '%' . $this->search . '%')
                      ->orWhere('meta_description', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.admin.models', [
            'brands' => $brands,
            'models' => $models
        ]);
    }
}