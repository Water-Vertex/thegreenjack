<div>
    <!-- Header Section -->
    <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Problems Management</h1>
                <p class="text-gray-600 mt-1">Manage device problems, repairs, and pricing</p>
            </div>
            <button 
                wire:click="create"
                wire:loading.attr="disabled"
                class="px-4 py-2 bg-[#5C9F01] text-white rounded-md hover:bg-[#5C9F01] transition-colors flex items-center space-x-2 text-sm font-medium disabled:opacity-50 disabled:cursor-not-allowed"
            >
                <span wire:loading.remove wire:target="create">
                    <i class="fas fa-plus"></i>
                    <span>Add Problem</span>
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
            <div class="flex-1">
                <div class="relative">
                    <div class="flex items-center bg-gray-100 rounded-lg px-3 py-2 w-full">
                        <i class="fas fa-search text-gray-400 mr-2"></i>
                        <input 
                            type="text" 
                            wire:model.live="search"
                            placeholder="Search problems by name or description..." 
                            class="bg-transparent border-none focus:outline-none focus:ring-0 w-full text-sm"
                        >
                    </div>
                </div>
            </div>

            <div class="flex gap-4">
                <select wire:model.live="sortField" class="bg-gray-100 border-none rounded-lg px-3 py-2 text-sm focus:ring-0">
                    <option value="name">Sort by Name</option>
                    <option value="price">Sort by Price</option>
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

    <!-- Problems Table -->
    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <div class="border-b border-gray-200">
            <div class="grid grid-cols-12 gap-4 px-6 py-3 bg-gray-50 text-xs font-medium text-gray-500 uppercase tracking-wider">
                <div class="col-span-3">Problem</div>
                <div class="col-span-2">Device Model</div>
                <div class="col-span-3">Description</div>
                <div class="col-span-2">Pricing</div>
                <div class="col-span-1">Status</div>
                <div class="col-span-1 text-center">Actions</div>
            </div>
        </div>

        <div class="divide-y divide-gray-200">
            @if($problems->count() > 0)
                @foreach($problems as $problem)
                <div class="grid grid-cols-12 gap-4 px-6 py-4 items-center hover:bg-gray-50 transition-colors">
                    <!-- Problem Info -->
                    <div class="col-span-3">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $problem->name }}</p>
                            <p class="text-xs text-gray-500">/{{ $problem->slug }}</p>
                        </div>
                    </div>

                    <!-- Device Model -->
                    <div class="col-span-2">
                        @if($problem->brand_model_id)
                            <p class="text-sm text-gray-900">{{ $problem->model->name }}</p>
                            <p class="text-xs text-gray-500">{{ $problem->model->brand->name ?? '' }}</p>
                        @else
                            <span class="text-sm text-gray-400">-</span>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="col-span-3">
                        @if($problem->description)
                            <p class="text-sm text-gray-600 truncate" title="{{ $problem->description }}">
                                {{ Str::limit($problem->description, 80) }}
                            </p>
                        @else
                            <span class="text-sm text-gray-400">No description</span>
                        @endif
                    </div>

                    <!-- Pricing -->
                    <div class="col-span-2">
                        @if($problem->discounted_price)
                            <p class="text-sm text-gray-500 line-through">${{ number_format($problem->price, 2) }}</p>
                            <p class="text-sm font-semibold text-green-600">${{ number_format($problem->discounted_price, 2) }}</p>
                        @elseif($problem->price)
                            <p class="text-sm font-semibold text-gray-900">${{ number_format($problem->price, 2) }}</p>
                        @else
                            <span class="text-sm text-gray-400">-</span>
                        @endif
                    </div>

                    <!-- Status -->
                    <div class="col-span-1">
                        <button 
                            wire:click="toggleStatus({{ $problem->id }})"
                            class="px-2 py-1 rounded-full text-xs font-medium transition-colors
                                {{ $problem->status == 'active' ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-red-100 text-red-700 hover:bg-red-200' }}">
                            {{ ucfirst($problem->status) }}
                        </button>
                    </div>

                    <!-- Actions -->
                    <div class="col-span-1">
                        <div class="flex items-center justify-center space-x-2">
                            <button 
                                wire:click="edit({{ $problem->id }})"
                                wire:loading.attr="disabled"
                                class="px-3 py-1 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 transition-colors text-xs font-medium flex items-center space-x-1 disabled:opacity-50"
                                title="Edit Problem"
                            >
                                <span wire:loading.remove wire:target="edit({{ $problem->id }})">
                                    <i class="fas fa-edit text-xs"></i>
                                    <span>Edit</span>
                                </span>
                                <span wire:loading wire:target="edit({{ $problem->id }})" class="flex items-center space-x-1">
                                    <div class="animate-spin rounded-full h-3 w-3 border-b-2 border-blue-700"></div>
                                    <span>Loading...</span>
                                </span>
                            </button>
                            
                            <button 
                                wire:click="delete({{ $problem->id }})"
                                wire:confirm="Are you sure you want to delete this problem?"
                                wire:loading.attr="disabled"
                                class="px-3 py-1 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition-colors text-xs font-medium flex items-center space-x-1 disabled:opacity-50"
                                title="Delete Problem"
                            >
                                <span wire:loading.remove wire:target="delete({{ $problem->id }})">
                                    <i class="fas fa-trash text-xs"></i>
                                    <span>Delete</span>
                                </span>
                                <span wire:loading wire:target="delete({{ $problem->id }})" class="flex items-center space-x-1">
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
                    <i class="fas fa-wrench text-4xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500">No problems found.</p>
                    @if($search)
                        <p class="text-sm text-gray-400 mt-1">Try adjusting your search criteria</p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($problems->hasPages())
            <div class="border-t border-gray-200 px-6 py-4 bg-gray-50">
                {{ $problems->links() }}
            </div>
        @endif
    </div>

    <!-- Create/Edit Modal -->
    @if($showForm)
    <div class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm transition-all duration-300">
        <div class="fixed inset-0 z-50 flex items-start justify-center pt-20 px-4 overflow-y-auto">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-3xl max-h-[90vh] overflow-hidden">
                <!-- Modal Header -->
                <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <h3 class="text-lg font-semibold text-gray-900">
                            {{ $formType === 'create' ? 'Create New Problem' : 'Edit Problem' }}
                        </h3>
                        <div wire:loading wire:target="create,edit" class="ml-3">
                            <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-[#5C9F01]"></div>
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
                        <!-- Category Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                            <select wire:model.live="selectedCategory" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('selectedCategory') 
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Brand Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Brand *</label>
                            <select wire:model.live="selectedBrand" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]"
                                {{ !$selectedCategory ? 'disabled' : '' }}>
                                <option value="">Select Brand</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @error('selectedBrand') 
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Model Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Model *</label>
                            <select wire:model.live="selectedModel" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]"
                                {{ !$selectedBrand ? 'disabled' : '' }}>
                                <option value="">Select Model</option>
                                @foreach($models as $model)
                                    <option value="{{ $model->id }}">{{ $model->name }}</option>
                                @endforeach
                            </select>
                            @error('selectedModel') 
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Problem Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Problem Name *</label>
                            <input type="text" wire:model="name" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]"
                                placeholder="e.g., Screen Replacement, Battery Issue">
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Slug -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Slug *</label>
                            <div class="flex items-center">
                                <span class="px-3 py-2 bg-gray-100 border border-r-0 border-gray-300 rounded-l-md text-gray-500">/</span>
                                <input type="text" wire:model="slug" 
                                    class="flex-1 px-3 py-2 border border-gray-300 rounded-r-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]"
                                    placeholder="problem-slug">
                            </div>
                            @error('slug') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Pricing -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Price ($)</label>
                                <input type="number" step="0.01" wire:model="price" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]"
                                    placeholder="0.00">
                                @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Discounted Price ($)</label>
                                <input type="number" step="0.01" wire:model="discounted_price" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]"
                                    placeholder="0.00">
                                @error('discounted_price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select wire:model="status" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea wire:model="description" rows="4" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]"
                                placeholder="Detailed description of the problem and repair process..."></textarea>
                            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                            <button type="button" wire:click="resetForm" 
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 transition-colors">
                                Cancel
                            </button>
                            <button type="submit" 
                                class="px-4 py-2 text-sm font-medium text-white bg-[#5C9F01] rounded-md hover:bg-[#5C9F01] transition-colors flex items-center space-x-2">
                                <span wire:loading.remove wire:target="save">
                                    {{ $formType === 'create' ? 'Create Problem' : 'Update Problem' }}
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
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" 
            class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transition-all duration-300">
            <div class="flex items-center space-x-2">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" 
            class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg transition-all duration-300">
            <div class="flex items-center space-x-2">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif
</div>