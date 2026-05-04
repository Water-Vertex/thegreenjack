<div>
    <!-- Header Section -->
    <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Brand Models Management</h1>
                <p class="text-gray-600 mt-1">Manage your brand models with SEO optimization</p>
            </div>
            <button 
                wire:click="create"
                wire:loading.attr="disabled"
                class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 transition-colors flex items-center space-x-2 text-sm font-medium disabled:opacity-50 disabled:cursor-not-allowed"
            >
                <span wire:loading.remove wire:target="create">
                    <i class="fas fa-plus"></i>
                    <span>Add Brand Model</span>
                </span>
                <span wire:loading wire:target="create" class="flex items-center space-x-2">
                    <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-white"></div>
                    <span>Opening...</span>
                </span>
            </button>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
        <div class="flex flex-col md:flex-row gap-4">
            <!-- Search -->
            <div class="flex-1">
                <div class="relative">
                    <div class="flex items-center bg-gray-100 rounded-lg px-3 py-2 w-full">
                        <i class="fas fa-search text-gray-400 mr-2"></i>
                        <input 
                            type="text" 
                            wire:model.live="search"
                            placeholder="Search brand models by name, description, or meta data..." 
                            class="bg-transparent border-none focus:outline-none focus:ring-0 w-full text-sm"
                        >
                    </div>
                </div>
            </div>

            <!-- Sort and Per Page -->
            <div class="flex gap-4">
                <select wire:model.live="sortField" class="bg-gray-100 border-none rounded-lg px-3 py-2 text-sm focus:ring-0">
                    <option value="name">Sort by Name</option>
                    <option value="created_at">Sort by Date</option>
                    <option value="updated_at">Sort by Update</option>
                </select>

                <select wire:model.live="perPage" class="bg-gray-100 border-none rounded-lg px-3 py-2 text-sm focus:ring-0">
                    <option value="10">10 per page</option>
                    <option value="25">25 per page</option>
                    <option value="50">50 per page</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Brand Models Table -->
    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <!-- Table Header -->
        <div class="border-b border-gray-200">
            <div class="grid grid-cols-12 gap-4 px-6 py-3 bg-gray-50 text-xs font-medium text-gray-500 uppercase tracking-wider">
                <div class="col-span-3">Brand Model</div>
                <div class="col-span-3">Description</div>
                <div class="col-span-2">Meta Title</div>
                <div class="col-span-2">Last Updated</div>
                <div class="col-span-2 text-center">Actions</div>
            </div>
        </div>

        <!-- Table Body -->
        <div class="divide-y divide-gray-200">
            @if($models->count() > 0)
                @foreach($models as $model)
                <div class="grid grid-cols-12 gap-4 px-6 py-4 items-center hover:bg-gray-50 transition-colors">
                    <!-- Model Info -->
                    <div class="col-span-3">
                        <div class="flex items-center space-x-3">
                            @if($model->featured_image)
                                <img src="{{ asset('storage/' . $model->featured_image) }}" 
                                     alt="{{ $model->name }}" 
                                     class="w-12 h-12 rounded-lg object-cover border border-gray-200">
                            @else
                                <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center border border-gray-200">
                                    <i class="fas fa-tag text-gray-400"></i>
                                </div>
                            @endif
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $model->name }}</p>
                                <p class="text-xs text-gray-500">/{{ $model->slug }}</p>
                                @if($model->brand_id)
                                    <p class="text-xs text-gray-400">Brand ID: {{ $model->brand_id }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-span-3">
                        @if($model->description)
                            <p class="text-sm text-gray-600 truncate" title="{{ $model->description }}">
                                {{ $model->excerpt }}
                            </p>
                        @else
                            <span class="text-sm text-gray-400">No description</span>
                        @endif
                    </div>

                    <!-- Meta Title -->
                    <div class="col-span-2">
                        @if($model->meta_title)
                            <p class="text-sm text-gray-900 truncate" title="{{ $model->meta_title }}">
                                {{ Str::limit($model->meta_title, 30) }}
                            </p>
                        @else
                            <span class="text-sm text-gray-400">-</span>
                        @endif
                    </div>

                    <!-- Last Updated -->
                    <div class="col-span-2">
                        <span class="text-sm text-gray-600">{{ $model->updated_at->format('M d, Y') }}</span>
                    </div>

                    <!-- Actions -->
                    <div class="col-span-2">
                        <div class="flex items-center justify-center space-x-2">
                            <button 
                                wire:click="edit({{ $model->id }})"
                                wire:loading.attr="disabled"
                                class="px-3 py-1 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 transition-colors text-xs font-medium flex items-center space-x-1 disabled:opacity-50"
                                title="Edit Model"
                            >
                                <span wire:loading.remove wire:target="edit({{ $model->id }})">
                                    <i class="fas fa-edit text-xs"></i>
                                    <span>Edit</span>
                                </span>
                                <span wire:loading wire:target="edit({{ $model->id }})" class="flex items-center space-x-1">
                                    <div class="animate-spin rounded-full h-3 w-3 border-b-2 border-blue-700"></div>
                                    <span>Loading...</span>
                                </span>
                            </button>
                            
                            <button 
                                wire:click="delete({{ $model->id }})"
                                wire:confirm="Are you sure you want to delete this brand model?"
                                wire:loading.attr="disabled"
                                class="px-3 py-1 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition-colors text-xs font-medium flex items-center space-x-1 disabled:opacity-50"
                                title="Delete Model"
                            >
                                <span wire:loading.remove wire:target="delete({{ $model->id }})">
                                    <i class="fas fa-trash text-xs"></i>
                                    <span>Delete</span>
                                </span>
                                <span wire:loading wire:target="delete({{ $model->id }})" class="flex items-center space-x-1">
                                    <div class="animate-spin rounded-full h-3 w-3 border-b-2 border-red-700"></div>
                                    <span>Deleting...</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="px-6 py-12 text-center">
                    <i class="fas fa-tags text-4xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500">No brand models found.</p>
                    @if($search)
                        <p class="text-sm text-gray-400 mt-1">Try adjusting your search criteria</p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($models->hasPages())
            <div class="border-t border-gray-200 px-6 py-4 bg-gray-50">
                {{ $models->links() }}
            </div>
        @endif
    </div>

    <!-- Create/Edit Modal -->
    @if($showForm)
    <div class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm transition-all duration-300">
        <div class="fixed inset-0 z-50 flex items-start justify-center pt-20 px-4 overflow-y-auto">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-6xl max-h-[90vh] overflow-hidden">
                <!-- Modal Header with Loading State -->
                <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <h3 class="text-lg font-semibold text-gray-900">
                            {{ $formType === 'create' ? 'Create New Brand Model' : 'Edit Brand Model' }}
                        </h3>
                        <div wire:loading wire:target="create,edit" class="ml-3">
                            <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-orange-500"></div>
                        </div>
                    </div>
                    <button wire:click="resetForm" 
                            class="text-gray-400 hover:text-gray-600 transition-colors"
                            wire:loading.attr="disabled" 
                            wire:target="create,edit,save">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-6 overflow-y-auto max-h-[70vh]">
                    <form wire:submit="save" class="space-y-6">
                        <!-- Basic Information -->
                        <div class="grid grid-cols-1 gap-6">
                            <!-- Name -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Brand Model Name *</label>
                                <input 
                                    type="text" 
                                    wire:model="name"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 disabled:opacity-50"
                                    placeholder="Enter brand model name"
                                    wire:loading.attr="disabled" 
                                    wire:target="create,edit,save"
                                >
                                @error('name') 
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Brand ID -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Brand ID</label>
                                
                                <select wire:model="brand_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 disabled:opacity-50">
                                    <option value="">Select a brand</option>
                                    @foreach($brands as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('brand_id') 
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Slug -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Slug *</label>
                                <div class="flex items-center">
                                    <span class="px-3 py-2 bg-gray-100 border border-r-0 border-gray-300 rounded-l-md text-gray-500">/</span>
                                    <input 
                                        type="text" 
                                        wire:model="slug"
                                        class="flex-1 px-3 py-2 border border-gray-300 rounded-r-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 disabled:opacity-50"
                                        placeholder="brand-model-slug"
                                        wire:loading.attr="disabled" 
                                        wire:target="create,edit,save"
                                    >
                                </div>
                                @error('slug') 
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                                <p class="text-xs text-gray-500 mt-1">URL-friendly version of the brand model name</p>
                            </div>

                            <!-- Featured Image -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Featured Image</label>
                                <div class="flex items-center space-x-4">
                                    @if($featured_image)
                                        <div class="flex items-center space-x-2">
                                            <img src="{{ $featured_image->temporaryUrl() }}" alt="Preview" class="w-16 h-16 object-cover rounded border">
                                            <button type="button" wire:click="$set('featured_image', null)" class="text-red-600 hover:text-red-800 text-sm">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @elseif($formType === 'edit' && $modelId)
                                        @php
                                            $brandModel = \App\Models\BrandModel::find($modelId);
                                        @endphp
                                        @if($brandModel && $brandModel->featured_image)
                                            <div class="flex items-center space-x-2">
                                                <img src="{{ Storage::url($brandModel->featured_image) }}" alt="{{ $brandModel->name }}" class="w-16 h-16 object-cover rounded border">
                                                <button type="button" wire:click="removeImage" class="text-red-600 hover:text-red-800 text-sm">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        @endif
                                    @endif
                                    <input 
                                        type="file" 
                                        wire:model="featured_image"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100"
                                        accept="image/*"
                                    >
                                </div>
                                @error('featured_image') 
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                                <p class="text-xs text-gray-500 mt-1">Recommended: 400x400px PNG/JPG</p>
                            </div>

                            <!-- Description -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                <textarea 
                                    wire:model="description"
                                    rows="4"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 disabled:opacity-50"
                                    placeholder="Brief description about the brand model"
                                    wire:loading.attr="disabled" 
                                    wire:target="create,edit,save"
                                ></textarea>
                                @error('description') 
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Blog Description -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Blog Description</label>
                                <textarea 
                                    wire:model="blog_description"
                                    rows="4"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 disabled:opacity-50"
                                    placeholder="Detailed description for blog posts or brand model pages"
                                    wire:loading.attr="disabled" 
                                    wire:target="create,edit,save"
                                ></textarea>
                                @error('blog_description') 
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- SEO Section -->
                        <div class="border-t border-gray-200 pt-6">
                            <h4 class="text-md font-semibold text-gray-900 mb-4">SEO Settings</h4>
                            
                            <div class="space-y-4">
                                <!-- Meta Title -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
                                    <input 
                                        type="text" 
                                        wire:model="meta_title"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 disabled:opacity-50"
                                        placeholder="Meta title for SEO (defaults to brand model name)"
                                        wire:loading.attr="disabled" 
                                        wire:target="create,edit,save"
                                    >
                                    @error('meta_title') 
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Meta Description -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                                    <textarea 
                                        wire:model="meta_description"
                                        rows="3"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 disabled:opacity-50"
                                        placeholder="Meta description for SEO"
                                        wire:loading.attr="disabled" 
                                        wire:target="create,edit,save"
                                    ></textarea>
                                    @error('meta_description') 
                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions with Loading State -->
                        <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                            <button 
                                type="button"
                                wire:click="resetForm"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 transition-colors disabled:opacity-50"
                                wire:loading.attr="disabled" 
                                wire:target="save"
                            >
                                Cancel
                            </button>
                            <button 
                                type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-orange-500 rounded-md hover:bg-orange-600 transition-colors flex items-center space-x-2 disabled:opacity-50 disabled:cursor-not-allowed"
                                wire:loading.attr="disabled" 
                                wire:target="save"
                            >
                                <span wire:loading.remove wire:target="save">
                                    {{ $formType === 'create' ? 'Create Brand Model' : 'Update Brand Model' }}
                                </span>
                                <span wire:loading wire:target="save" class="flex items-center space-x-2">
                                    <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-white"></div>
                                    <span>Saving...</span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div x-data="{ show: true }" 
             x-show="show" 
             x-init="setTimeout(() => show = false, 3000)"
             class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transition-all duration-300">
            <div class="flex items-center space-x-2">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div x-data="{ show: true }" 
             x-show="show" 
             x-init="setTimeout(() => show = false, 5000)"
             class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg transition-all duration-300">
            <div class="flex items-center space-x-2">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif
</div>