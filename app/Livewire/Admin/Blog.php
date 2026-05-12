<?php

namespace App\Livewire\Admin;

use App\Models\Blog as BlogModel;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;

#[Layout('components.admin-layout')]
class Blog extends Component
{
    use WithPagination, WithFileUploads;

    public $showModal = false;
    public $isEdit = false;
    public $blogId = null;

    // Form fields
    public $name = '';
    public $slug = '';
    public $description = '';
    public $image = null;
    public $oldImage = null;
    public $meta_title = '';
    public $meta_description = '';
    public $meta_keywords = '';
    public $meta_tags = '';
    public $page_schemas = '';
    public $is_active = true;

    // Filters
    public $search = '';
    public $perPage = 10;

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'slug' => 'required|regex:/^[a-z0-9-]+$/|unique:blogs,slug',
        'description' => 'required|min:20',
        'image' => 'nullable|image|max:2048',
        'meta_title' => 'nullable|max:60',
        'meta_description' => 'nullable|max:160',
        'meta_keywords' => 'nullable|max:255',
        'meta_tags' => 'nullable|max:255',
        'is_active' => 'boolean',
    ];

    protected $messages = [
        'name.required' => 'Blog title is required',
        'slug.unique' => 'This slug already exists',
        'slug.regex' => 'Slug can only contain letters, numbers and hyphens',
        'description.min' => 'Content must be at least 20 characters',
        'image.max' => 'Image must be less than 2MB',
    ];

    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }

    public function updatedSlug($value)
    {
        $this->slug = Str::slug($value);
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
        $this->isEdit = false;
    }

    public function edit($id)
    {
        $blog = BlogModel::findOrFail($id);
        $this->blogId = $blog->id;
        $this->name = $blog->name;
        $this->slug = $blog->slug;
        $this->description = $blog->description;
        $this->oldImage = $blog->image;
        $this->meta_title = $blog->meta_title;
        $this->meta_description = $blog->meta_description;
        $this->meta_keywords = $blog->meta_keywords;
        $this->meta_tags = $blog->meta_tags;
        $this->page_schemas = $blog->page_schemas;
        $this->is_active = $blog->is_active;
        $this->isEdit = true;
        $this->showModal = true;
    }

    public function save()
    {
        $rules = $this->rules;
        if ($this->isEdit) {
            $rules['slug'] = 'required|regex:/^[a-z0-9-]+$/|unique:blogs,slug,' . $this->blogId;
        }
        $this->validate($rules);

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'meta_tags' => $this->meta_tags,
            'page_schemas' => $this->page_schemas,
            'is_active' => $this->is_active,
        ];

        if ($this->image) {
            $path = $this->image->store('blogs', 'public');
            $data['image'] = $path;

            if ($this->isEdit && $this->oldImage) {
                Storage::disk('public')->delete($this->oldImage);
            }
        } elseif ($this->isEdit) {
            $data['image'] = $this->oldImage;
        }

        if ($this->isEdit) {
            Blog::find($this->blogId)->update($data);
            session()->flash('message', 'Blog updated successfully!');
        } else {
            Blog::create($data);
            session()->flash('message', 'Blog created successfully!');
        }

        $this->resetForm();
    }

    public function delete($id)
    {
        $blog = BlogModel::findOrFail($id);
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }
        $blog->delete();
        session()->flash('message', 'Blog deleted successfully!');
    }

    public function toggleStatus($id)
    {
        $blog = BlogModel::findOrFail($id);
        $blog->is_active = !$blog->is_active;
        $blog->save();
        session()->flash('message', 'Status changed successfully!');
    }

    public function resetForm()
    {
        $this->reset(['showModal', 'isEdit', 'blogId', 'name', 'slug', 'description',
                      'image', 'oldImage', 'meta_title', 'meta_description',
                      'meta_keywords', 'meta_tags', 'page_schemas']);
        $this->is_active = true;
        $this->resetValidation();
    }

    public function closeModal()
    {
        $this->resetForm();
    }

   public function render()
{
    $blogs = BlogModel::query()
        ->when($this->search, function($q) {
            $q->where('name', 'like', '%' . $this->search . '%')
              ->orWhere('slug', 'like', '%' . $this->search . '%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate($this->perPage);

    return view('livewire.admin.blog', [
        'blogs' => $blogs
    ]);
}
}
