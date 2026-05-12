<div>
    <!-- Header Section -->
    <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Products Management</h1>
                <p class="text-gray-600 mt-1">Manage your product catalog with SEO optimization</p>
            </div>
            <button
                wire:click="create"
                wire:loading.attr="disabled"
                class="px-4 py-2 bg-[#5C9F01] text-white rounded-md hover:bg-[#4a7e01] transition-colors flex items-center space-x-2 text-sm font-medium disabled:opacity-50 disabled:cursor-not-allowed"
            >
                <span wire:loading.remove wire:target="create">
                    <i class="fas fa-plus"></i>
                    <span>Add Product</span>
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
                            placeholder="Search products, SKU, manufacturer, meta titles..."
                            class="bg-transparent border-none focus:outline-none focus:ring-0 w-full text-sm"
                        >
                    </div>
                </div>
            </div>

            <!-- Sort and Per Page -->
            <div class="flex gap-4">
                <select wire:model.live="sortField" class="bg-gray-100 border-none rounded-lg px-3 py-2 text-sm focus:ring-0">
                    <option value="name">Sort by Name</option>
                    <option value="price">Sort by Price</option>
                    <option value="stock">Sort by Stock</option>
                    <option value="created_at">Sort by Date</option>
                </select>

                <select wire:model.live="perPage" class="bg-gray-100 border-none rounded-lg px-3 py-2 text-sm focus:ring-0">
                    <option value="5">5 per page</option>
                    <option value="10">10 per page</option>
                    <option value="25">25 per page</option>
                    <option value="50">50 per page</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Products Table -->
    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <!-- Table Header -->
        <div class="border-b border-gray-200">
            <div class="grid grid-cols-12 gap-4 px-6 py-3 bg-gray-50 text-xs font-medium text-gray-500 uppercase tracking-wider">
                <div class="col-span-3">Product</div>
                <div class="col-span-2">SKU / UPC</div>
                <div class="col-span-2">Price</div>
                <div class="col-span-1 text-center">Stock</div>
                <div class="col-span-2 text-center">Category</div>
                <div class="col-span-1 text-center">Status</div>
                <div class="col-span-1 text-center">Actions</div>
            </div>
        </div>

        <!-- Table Body -->
        <div class="divide-y divide-gray-200">
            @if($products->count() > 0)
                @foreach($products as $product)
                <div class="grid grid-cols-12 gap-4 px-6 py-4 items-center hover:bg-gray-50 transition-colors">
                    <!-- Product Info -->
                    <div class="col-span-3">
                        <div class="flex items-center space-x-3">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="w-10 h-10 rounded-lg object-cover border border-gray-200">
                            @else
                                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center border border-gray-200">
                                    <i class="fas fa-box text-gray-400"></i>
                                </div>
                            @endif
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ Str::limit($product->name, 40) }}</p>
                                <p class="text-xs text-gray-500">{{ $product->slug }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- SKU / UPC -->
                    <div class="col-span-2">
                        <p class="text-sm text-gray-600">{{ $product->sku ?? '-' }}</p>
                        <p class="text-xs text-gray-400">UPC: {{ $product->upc ?? '-' }}</p>
                    </div>

                    <!-- Price -->
                    <div class="col-span-2">
                        @if($product->discounted_price > 0 && $product->discounted_price < $product->price)
                            <p class="text-sm font-semibold text-green-600">${{ number_format($product->discounted_price, 2) }}</p>
                            <p class="text-xs text-gray-400 line-through">${{ number_format($product->price, 2) }}</p>
                        @else
                            <p class="text-sm font-semibold text-gray-900">${{ number_format($product->price, 2) }}</p>
                        @endif
                    </div>

                    <!-- Stock -->
                    <div class="col-span-1 text-center">
                        <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{ $product->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $product->stock }}
                        </span>
                    </div>

                    <!-- Category -->
                    <div class="col-span-2">
                        <p class="text-sm text-gray-600">{{ $product->category?->name ?? '-' }}</p>
                        @if($product->subCategory)
                            <p class="text-xs text-gray-400">{{ $product->subCategory->name }}</p>
                        @endif
                    </div>

                    <!-- Status -->
                    <div class="col-span-1 text-center">
                        <button
                            wire:click="toggleStatus({{ $product->id }})"
                            wire:loading.attr="disabled"
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium transition-colors {{ $product->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-red-100 text-red-800 hover:bg-red-200' }} disabled:opacity-50"
                        >
                            <span wire:loading.remove wire:target="toggleStatus({{ $product->id }})">
                                <i class="fas fa-circle text-[10px] mr-1"></i>
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                            <span wire:loading wire:target="toggleStatus({{ $product->id }})">
                                <div class="animate-spin rounded-full h-3 w-3 border-b-2 border-current mr-1"></div>
                                Updating...
                            </span>
                        </button>
                    </div>

                    <!-- Actions -->
                    <div class="col-span-1">
                        <div class="flex items-center justify-center space-x-2">
                            <button
                                wire:click="edit({{ $product->id }})"
                                wire:loading.attr="disabled"
                                class="px-3 py-1 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 transition-colors text-xs font-medium flex items-center space-x-1 disabled:opacity-50"
                                title="Edit Product"
                            >
                                <span wire:loading.remove wire:target="edit({{ $product->id }})">
                                    <i class="fas fa-edit text-xs"></i>
                                    <span>Edit</span>
                                </span>
                                <span wire:loading wire:target="edit({{ $product->id }})" class="flex items-center space-x-1">
                                    <div class="animate-spin rounded-full h-3 w-3 border-b-2 border-blue-700"></div>
                                    <span>Loading...</span>
                                </span>
                            </button>

                            <button
                                wire:click="delete({{ $product->id }})"
                                wire:confirm="Are you sure you want to delete this product?"
                                wire:loading.attr="disabled"
                                class="px-3 py-1 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition-colors text-xs font-medium flex items-center space-x-1 disabled:opacity-50"
                                title="Delete Product"
                            >
                                <span wire:loading.remove wire:target="delete({{ $product->id }})">
                                    <i class="fas fa-trash text-xs"></i>
                                    <span>Delete</span>
                                </span>
                                <span wire:loading wire:target="delete({{ $product->id }})" class="flex items-center space-x-1">
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
                    <i class="fas fa-box-open text-4xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500">No products found.</p>
                    @if($search)
                        <p class="text-sm text-gray-400 mt-1">Try adjusting your search criteria</p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
            <div class="border-t border-gray-200 px-6 py-4 bg-gray-50">
                {{ $products->links() }}
            </div>
        @endif
    </div>

    <!-- Create/Edit Modal -->
    @if($showForm)
    <div class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm transition-all duration-300">
        <div class="fixed inset-0 z-50 flex items-start justify-center pt-20 px-4 overflow-y-auto">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-6xl max-h-[90vh] overflow-hidden">
                <!-- Modal Header -->
                <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <h3 class="text-lg font-semibold text-gray-900">
                            {{ $formType === 'create' ? 'Create New Product' : 'Edit Product' }}
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
                    <form wire:submit="save" class="space-y-4">
                        <!-- SEO Analysis Panel -->
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="text-md font-semibold text-gray-900">SEO Analysis</h4>
                                <div class="flex items-center space-x-2">
                                    <span class="text-sm font-medium text-gray-700">Score:</span>
                                    <span class="text-lg font-bold {{ $seoScore >= 80 ? 'text-green-600' : ($seoScore >= 60 ? 'text-yellow-600' : 'text-red-600') }}">
                                        {{ $seoScore }}%
                                    </span>
                                </div>
                            </div>

                            <!-- Score Bar -->
                            <div class="bg-gray-200 rounded-full h-2 mb-4">
                                <div class="h-2 rounded-full {{ $seoScore >= 80 ? 'bg-green-500' : ($seoScore >= 60 ? 'bg-yellow-500' : 'bg-red-500') }}"
                                    style="width: {{ $seoScore }}%"></div>
                            </div>

                            <!-- SEO Metrics -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach($seoMetrics as $metric)
                                <div class="flex justify-between items-center p-2 rounded text-sm {{ $metric['status'] ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200' }}">
                                    <span class="font-medium text-gray-700">{{ $metric['name'] }}</span>
                                    <span class="{{ $metric['status'] ? 'text-green-600' : 'text-red-600' }} font-medium">
                                        {{ $metric['message'] }}
                                    </span>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Basic Information -->
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Name -->
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Product Name *</label>
                                <input
                                    type="text"
                                    wire:model="name"
                                    wire:keyup="analyzeSeo"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01] disabled:opacity-50"
                                    placeholder="Enter product name"
                                >
                                @error('name')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Slug -->
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                                <input
                                    type="text"
                                    wire:model="slug"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01] disabled:opacity-50"
                                    placeholder="auto-generated from name"
                                >
                                @error('slug')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Categories -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                <select
                                    wire:model="category_id"
                                    wire:change="analyzeSeo"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]"
                                >
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Sub Category</label>
                                <select
                                    wire:model="sub_category_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]"
                                    {{ $subCategories->isEmpty() ? 'disabled' : '' }}
                                >
                                    <option value="">Select Sub Category</option>
                                    @foreach($subCategories as $subCategory)
                                        <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Price Fields -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Price *</label>
                                <input
                                    type="number"
                                    step="0.01"
                                    wire:model="price"
                                    wire:keyup="analyzeSeo"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]"
                                    placeholder="0.00"
                                >
                                @error('price')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Discounted Price</label>
                                <input
                                    type="number"
                                    step="0.01"
                                    wire:model="discounted_price"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]"
                                    placeholder="0.00"
                                >
                            </div>

                            <!-- Stock & MOQ -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Stock *</label>
                                <input
                                    type="number"
                                    wire:model="stock"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]"
                                    placeholder="0"
                                >
                                @error('stock')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Minimum Order Quantity (MOQ)</label>
                                <input
                                    type="number"
                                    wire:model="moq"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]"
                                    placeholder="1"
                                >
                            </div>

                            <!-- Identifiers -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">SKU</label>
                                <input
                                    type="text"
                                    wire:model="sku"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]"
                                    placeholder="Product SKU"
                                >
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">UPC</label>
                                <input
                                    type="text"
                                    wire:model="upc"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]"
                                    placeholder="Universal Product Code"
                                >
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">ASIN</label>
                                <input
                                    type="text"
                                    wire:model="asin"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]"
                                    placeholder="Amazon Standard ID"
                                >
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Manufacturer</label>
                                <input
                                    type="text"
                                    wire:model="manufacturer"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]"
                                    placeholder="Manufacturer name"
                                >
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea
                                wire:model="description"
                                wire:keyup="analyzeSeo"
                                rows="4"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]"
                                placeholder="Product description"
                            ></textarea>
                        </div>

                        <!-- Main Image -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Main Product Image</label>
                            <input
                                type="file"
                                wire:model="image"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]"
                                accept="image/*"
                            >
                            @error('image')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror

                            @if($image)
                                <div class="mt-2">
                                    <img src="{{ $image->temporaryUrl() }}" class="w-20 h-20 object-cover rounded border">
                                </div>
                            @elseif($existingImage)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $existingImage) }}" class="w-20 h-20 object-cover rounded border">
                                </div>
                            @endif
                        </div>

                        <!-- Multiple Product Images Gallery -->
                      <!-- Multiple Product Images Gallery -->
<div class="border border-gray-200 rounded-lg p-4">
    <label class="block text-sm font-medium text-gray-700 mb-3">Product Gallery Images</label>

    <!-- Multiple File Input -->
    <input
        type="file"
        wire:model="galleryImages"
        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]"
        accept="image/*"
        multiple
    >
    @error('galleryImages.*')
        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
    @enderror

    <!-- Existing Images Display -->
    @if(count($existingGalleryImages) > 0)
        <div class="mt-4">
            <p class="text-xs text-gray-500 mb-2">Existing Images:</p>
            <div class="grid grid-cols-4 gap-3">
                @foreach($existingGalleryImages as $existingImageItem)
                    <div class="relative group border rounded-lg p-2">
                        <img src="{{ asset('storage/' . $existingImageItem['path']) }}" class="w-full h-24 object-cover rounded">
                        <button
                            type="button"
                            wire:click="removeExistingImage({{ $existingImageItem['id'] }}, '{{ $existingImageItem['path'] }}')"
                            class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition"
                        >
                            <i class="fas fa-times text-xs"></i>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- New Uploaded Images Preview -->
    @if($galleryImages && count($galleryImages) > 0)
        <div class="mt-4">
            <p class="text-xs text-gray-500 mb-2">New Images:</p>
            <div class="grid grid-cols-4 gap-3">
                @foreach($galleryImages as $index => $galleryImage)
                    @if($galleryImage)
                        <div class="relative group border rounded-lg p-2">
                            <img src="{{ $galleryImage->temporaryUrl() }}" class="w-full h-24 object-cover rounded">
                            <button
                                type="button"
                                wire:click="removeNewImage({{ $index }})"
                                class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition"
                            >
                                <i class="fas fa-times text-xs"></i>
                            </button>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif
</div>

                        <!-- SEO Section -->
                        <div class="border-t border-gray-200 pt-4">
                            <h4 class="text-md font-semibold text-gray-900 mb-3">SEO Settings</h4>

                            <div class="space-y-4">

                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Focus Keyword
                                        <span class="text-xs text-gray-500"></span>
                                    </label>
                                    <input
                                        type="text"
                                        wire:model="focus_keyword"
                                        wire:keyup="analyzeSeo"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]"
                                        placeholder="e.g., organic cotton t-shirt"
                                    >
                                    <div class="mt-2 flex items-center justify-between">
                                        <!-- <p class="text-xs text-gray-500">
                                            <i class="fas fa-info-circle"></i>
                                            This keyword will be used to optimize your product for search engines
                                        </p> -->
                                        @if(!empty($focus_keyword))
                                            <span class="text-xs text-green-600 bg-green-100 px-2 py-1 rounded-full">
                                                <i class="fas fa-check-circle"></i> Keyword set: {{ Str::limit($focus_keyword, 30) }}
                                            </span>
                                        @endif

                                </div>
<!-- Product Type Selection - Add this in Basic Information section after Manufacturer -->
<div class="col-span-2">
    <label class="block text-sm font-medium text-gray-700 mb-1">
        Product Type
        <span class="text-xs text-gray-500">(Optional)</span>
    </label>
    <select
        wire:model="type"
        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]"
    >
        <option value="">Select Type</option>
        <option value="featured"> Featured</option>
        <option value="best_seller"> Best Seller</option>
    </select>
</div>
                                <div>

                                    <label class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
                                    <input
                                        type="text"
                                        wire:model="meta_title"
                                        wire:keyup="analyzeSeo"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]"
                                        placeholder="Meta title for SEO"
                                    >
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                                    <textarea
                                        wire:model="meta_description"
                                        wire:keyup="analyzeSeo"
                                        rows="2"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]"
                                        placeholder="Meta description for SEO"
                                    ></textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Meta Keywords</label>
                                    <input
                                        type="text"
                                        wire:model="meta_keywords"
                                        wire:keyup="analyzeSeo"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]"
                                        placeholder="keyword1, keyword2, keyword3"
                                    >
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Meta Tags</label>
                                    <textarea
                                        wire:model="meta_tags"
                                        rows="2"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01]"
                                        placeholder="Additional meta tags"
                                    ></textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Page Schemas (JSON)</label>
                                    <textarea
                                        wire:model="page_schemas"
                                        rows="3"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#5C9F01] focus:border-[#5C9F01] font-mono text-sm"
                                        placeholder=""
                                    ></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Active Status -->
                        <div class="flex items-center">
                            <input
                                type="checkbox"
                                wire:model="is_active"
                                id="is_active"
                                class="rounded border-gray-300 text-[#5C9F01] focus:ring-[#5C9F01]"
                            >
                            <label for="is_active" class="ml-2 text-sm text-gray-700">Active Product</label>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                            <button
                                type="button"
                                wire:click="resetForm"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 transition-colors"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-[#5C9F01] rounded-md hover:bg-[#4a7e01] transition-colors flex items-center space-x-2 disabled:opacity-50"
                                wire:loading.attr="disabled"
                            >
                                <span wire:loading.remove wire:target="save">
                                    {{ $formType === 'create' ? 'Create Product' : 'Update Product' }}
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
