<div>
    <div class="bg-gray-50 py-6">
        <div class="container mx-auto px-4 max-w-7xl">
            <!-- Breadcrumb -->
            <div class="mb-6">
                <nav class="flex items-center gap-2 text-sm text-gray-500">
                    <a href="{{ route('home') }}" wire:navigate class="hover:text-[#5B9F01] transition">Home</a>
                    <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                    <span class="text-gray-800 font-medium">Shop</span>
                </nav>
            </div>

            <!-- Page Header -->
            <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Shop Collection</h1>
                    <p class="text-gray-500 text-sm mt-1">Browse our wide range of products</p>
                </div>
                <div class="flex items-center gap-3">
                    <!-- View Toggle Buttons -->
                    <div class="flex items-center gap-2 border border-gray-200 rounded-lg p-1 bg-white">
                        <button wire:click="toggleView('grid')"
                                class="p-2 rounded-md transition {{ $viewType === 'grid' ? 'bg-[#5B9F01] text-white' : 'text-gray-500 hover:bg-gray-100' }}">
                            <i class="fas fa-th-large text-sm"></i>
                        </button>
                        <button wire:click="toggleView('list')"
                                class="p-2 rounded-md transition {{ $viewType === 'list' ? 'bg-[#5B9F01] text-white' : 'text-gray-500 hover:bg-gray-100' }}">
                            <i class="fas fa-list text-sm"></i>
                        </button>
                    </div>

                    <!-- Sort & Per Page -->
                    <select wire:model.live="sortBy" class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-[#5B9F01]">
                        <option value="latest">Latest Arrivals</option>
                        <option value="price_low">Price: Low to High</option>
                        <option value="price_high">Price: High to Low</option>
                        <option value="popular">Most Popular</option>
                    </select>

                    <select wire:model.live="perPage" class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-[#5B9F01]">
                        <option value="12">12 per page</option>
                        <option value="24">24 per page</option>
                        <option value="36">36 per page</option>
                        <option value="48">48 per page</option>
                    </select>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-6">
                <!-- Sidebar Filters -->
                <div class="lg:w-1/4">
                    <div class="bg-white rounded-xl shadow-sm p-5 sticky top-24">
                        <!-- Search -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Search</h3>
                            <div class="relative">
                                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                                <input type="text"
                                       wire:model.live.debounce="search"
                                       placeholder="Search products..."
                                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#5B9F01] text-sm">
                            </div>
                        </div>

                        <!-- Categories Filter -->
                        <div class="mb-6">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-lg font-semibold text-gray-800">Categories</h3>
                                <button wire:click="clearFilters" class="text-xs text-[#5B9F01] hover:underline">Clear All</button>
                            </div>
                            <div class="space-y-2 max-h-64 overflow-y-auto">
                                @foreach($categories as $category)
                                    <label class="flex items-center gap-2 cursor-pointer hover:text-[#5B9F01] transition">
                                        <input type="checkbox"
                                               wire:model.live="selectedCategories"
                                               value="{{ $category->id }}"
                                               class="rounded border-gray-300 text-[#5B9F01] focus:ring-[#5B9F01]">
                                        <span class="text-sm text-gray-600 flex-1">{{ $category->name }}</span>
                                        <span class="text-xs text-gray-400">({{ $category->products_count }})</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Price Range Filter -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Price Range</h3>
                            <div class="px-2">
                                <div class="flex items-center justify-between gap-3 mb-4">
                                    <div class="flex-1">
                                        <label class="text-xs text-gray-500">Min</label>
                                        <div class="relative">
                                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">$</span>
                                            <input type="number"
                                                   wire:model.live="minPrice"
                                                   class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#5B9F01]">
                                        </div>
                                    </div>
                                    <span class="text-gray-400">—</span>
                                    <div class="flex-1">
                                        <label class="text-xs text-gray-500">Max</label>
                                        <div class="relative">
                                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">$</span>
                                            <input type="number"
                                                   wire:model.live="maxPrice"
                                                   class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#5B9F01]">
                                        </div>
                                    </div>
                                </div>
                                <input type="range"
                                       wire:model.live="priceRange"
                                       min="{{ $globalMinPrice }}"
                                       max="{{ $globalMaxPrice }}"
                                       step="1"
                                       class="w-full">
                                <div class="flex justify-between text-xs text-gray-500 mt-2">
                                    <span>${{ number_format($globalMinPrice) }}</span>
                                    <span>${{ number_format($globalMaxPrice) }}</span>
                                </div>
                            </div>
                        </div>



                        <!-- Active Filters -->
                        @if(count($selectedCategories) > 0 || $search || ($minPrice != $globalMinPrice || $maxPrice != $globalMaxPrice))
                            <div class="pt-4 border-t border-gray-200">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Active Filters:</h4>
                                <div class="flex flex-wrap gap-2">
                                    @if($search)
                                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded">
                                            Search: {{ $search }}
                                            <button wire:click="$set('search', '')" class="hover:text-red-500">&times;</button>
                                        </span>
                                    @endif
                                    @if($minPrice != $globalMinPrice || $maxPrice != $globalMaxPrice)
                                        <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded">
                                            ${{ number_format($minPrice) }} - ${{ number_format($maxPrice) }}
                                            <button wire:click="$set('priceRange', [{{ $globalMinPrice }}, {{ $globalMaxPrice }}])" class="hover:text-red-500">&times;</button>
                                        </span>
                                    @endif
                                    <button wire:click="clearFilters" class="text-xs text-[#5B9F01] hover:underline">Clear All Filters</button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Products Grid/List -->
                <div class="lg:w-3/4">
                    <!-- Results Count -->
                    <div class="mb-4 flex items-center justify-between">
                        <p class="text-sm text-gray-500">
                            Showing {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} products
                        </p>
                    </div>

                    @if($products->count() > 0)
                        @if($viewType === 'grid')
                            <!-- Grid View -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach($products as $product)
                                    <div class="product-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 group">
                                        <div class="relative">
                                            <a href="{{ route('shop.details', $product->slug) }}" wire:navigate>
                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                     alt="{{ $product->name }}"
                                                     class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-300">
                                            </a>
                                            @if($product->discounted_price > 0 && $product->discounted_price < $product->price)
                                                @php $discount = round((($product->price - $product->discounted_price) / $product->price) * 100); @endphp
                                                <span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">-{{ $discount }}%</span>
                                            @endif
                                            <button class="absolute top-2 right-2 w-8 h-8 bg-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition shadow-md">
                                                <i class="far fa-heart text-gray-600 text-sm"></i>
                                            </button>
                                        </div>
                                        <div class="p-4">
                                            <a href="{{ route('shop.details', $product->slug) }}" wire:navigate>
                                                <h3 class="text-sm font-medium text-gray-800 line-clamp-2 mb-1 hover:text-[#5B9F01] transition">{{ $product->name }}</h3>
                                            </a>
                                            <p class="text-xs text-gray-500 mb-2">{{ $product->category->name ?? 'Uncategorized' }}</p>
                                            <div class="flex items-baseline gap-2 mb-3">
                                                @if($product->discounted_price > 0 && $product->discounted_price < $product->price)
                                                    <span class="text-lg font-bold text-[#5B9F01]">${{ number_format($product->discounted_price, 2) }}</span>
                                                    <span class="text-xs text-gray-400 line-through">${{ number_format($product->price, 2) }}</span>
                                                @else
                                                    <span class="text-lg font-bold text-[#5B9F01]">${{ number_format($product->price, 2) }}</span>
                                                @endif
                                            </div>
                                            <button wire:click="addToCart({{ $product->id }})"
        wire:loading.attr="disabled"
        wire:target="addToCart({{ $product->id }})"
        class="w-full bg-[#FFD814] hover:bg-[#F7CA00] text-gray-800 text-sm font-medium py-2 rounded-lg transition flex items-center justify-center gap-2">
    <span wire:loading.remove wire:target="addToCart({{ $product->id }})">
        <i class="fas fa-shopping-cart"></i>
        Add to Cart
    </span>
    <span wire:loading wire:target="addToCart({{ $product->id }})" class="flex items-center gap-2">
        <svg class="animate-spin h-4 w-4 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Adding...
    </span>
</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <!-- List View -->
                            <div class="space-y-4">
                                @foreach($products as $product)
                                    <div class="product-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 group">
                                        <div class="flex flex-col sm:flex-row gap-4 p-4">
                                            <div class="relative sm:w-48">
                                                <a href="{{ route('shop.details', $product->slug) }}" wire:navigate>
                                                    <img src="{{ asset('storage/' . $product->image) }}"
                                                         alt="{{ $product->name }}"
                                                         class="w-full h-40 object-cover rounded-lg group-hover:scale-105 transition-transform duration-300">
                                                </a>
                                                @if($product->discounted_price > 0 && $product->discounted_price < $product->price)
                                                    @php $discount = round((($product->price - $product->discounted_price) / $product->price) * 100); @endphp
                                                    <span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">-{{ $discount }}%</span>
                                                @endif
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2">
                                                    <div class="flex-1">
                                                        <a href="{{ route('shop.details', $product->slug) }}" wire:navigate>
                                                            <h3 class="text-lg font-semibold text-gray-800 hover:text-[#5B9F01] transition">{{ $product->name }}</h3>
                                                        </a>
                                                        <p class="text-xs text-gray-500 mb-2">{{ $product->category->name ?? 'Uncategorized' }}</p>
                                                        <p class="text-sm text-gray-600 line-clamp-2 mb-3">{{ $product->description }}</p>
                                                        <div class="flex items-center gap-2 text-sm text-gray-500">
                                                            @if($product->sku)
                                                                <span>SKU: {{ $product->sku }}</span>
                                                            @endif
                                                            @if($product->stock > 0)
                                                                <span class="text-green-600">✓ In Stock</span>
                                                            @else
                                                                <span class="text-red-600">Out of Stock</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="text-right">
                                                        <div class="mb-2">
                                                            @if($product->discounted_price > 0 && $product->discounted_price < $product->price)
                                                                <span class="text-xl font-bold text-[#5B9F01]">${{ number_format($product->discounted_price, 2) }}</span>
                                                                <span class="text-xs text-gray-400 line-through block">${{ number_format($product->price, 2) }}</span>
                                                            @else
                                                                <span class="text-xl font-bold text-[#5B9F01]">${{ number_format($product->price, 2) }}</span>
                                                            @endif
                                                        </div>
                                                        <button wire:click="addToCart({{ $product->id }})"
        wire:loading.attr="disabled"
        wire:target="addToCart({{ $product->id }})"
        class="w-full sm:w-auto bg-[#5B9F01] hover:bg-[#4a7f01] text-white text-sm font-medium px-6 py-2 rounded-lg transition flex items-center justify-center gap-2">
    <span wire:loading.remove wire:target="addToCart({{ $product->id }})">
        <i class="fas fa-shopping-cart"></i>
        Add to Cart
    </span>
    <span wire:loading wire:target="addToCart({{ $product->id }})" class="flex items-center gap-2">
        <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Adding...
    </span>
</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $products->links() }}
                        </div>
                    @else
                        <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                            <i class="fas fa-search text-5xl text-gray-300 mb-3"></i>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">No products found</h3>
                            <p class="text-gray-500 mb-6">Try adjusting your search or filter criteria</p>
                            <button wire:click="clearFilters" class="bg-[#5B9F01] text-white px-6 py-2 rounded-lg hover:bg-[#4a7f01] transition">
                                Clear All Filters
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    input[type="range"] {
        -webkit-appearance: none;
        height: 4px;
        background: #e5e7eb;
        border-radius: 5px;
        outline: none;
    }

    input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 16px;
        height: 16px;
        background: #5B9F01;
        border-radius: 50%;
        cursor: pointer;
        border: none;
    }

    input[type="range"]::-webkit-slider-thumb:hover {
        background: #4a7f01;
    }
    .toast-notification {
    animation: slideInRight 0.3s ease-out;
}

@keyframes slideInRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}
</style>

</div>
