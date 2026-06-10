<div>

<!-- Navigation Menu + All Departments Mega Menu (Desktop) WITH HERO SECTION SIDE BY SIDE -->
<div class="border-y border-gray-100 bg-white w-full">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Main row that contains both menu AND hero section -->
        <div class="flex flex-wrap relative">

            <!-- LEFT SIDE: All Departments Vertical Menu - Hidden on mobile, visible on desktop -->
           <div class="w-full sm:w-[270px] min-w-[270px] max-w-[270px] mt-2 hidden xl:block relative z-40">
                <div class="card border-0 shadow-sm rounded-lg relative overflow-visible">
                    <div class="card-header border-0 p-0">
                        <button type="button" id="categoriesToggleBtn" class="btn-link btn-remove-focus btn-block d-flex card-btn py-3 px-4 shadow-none bg-[#00349A] rounded border-0 font-weight-bold text-white items-center justify-between w-full hover:bg-[#00287a] transition">
                            <div class="flex items-center">
                                <span class="mr-2"><i class="fas fa-list-ul"></i></span>
                                <span class="text-center">Show All Categories</span>
                                <i class="fas fa-chevron-down text-sm ml-2 transition-transform duration-200" id="chevronIcon"></i>
                            </div>
                        </button>
                    </div>

                    <!-- OVERLAY DROPDOWN MENU - Positioned absolutely with high z-index -->
                    <div id="categoriesCollapse" class="hidden absolute top-full left-0 w-[270px] z-[60]">
                        <div class="p-0 bg-white shadow-2xl rounded-b-lg border border-gray-200 overflow-hidden">
                            <nav class="w-full">
                                <ul class="flex flex-col max-h-[400px] overflow-y-auto">
                                    @foreach($categories as $category)
                                    <li class="relative group border-b border-gray-100">
                                        <a href="{{route('shop.by.category', $category->slug)}}" wire:navigate class="flex items-center justify-between py-3 px-4 text-gray-700 hover:text-[#5B9F01] hover:bg-gray-50 transition">
                                            <span>{{ $category->name }}</span>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE: Secondary Navigation + Hero Section Combined -->
            <div class="flex-1 w-full relative mt-2 z-0">
                <!-- Secondary Top Navigation -->
                <nav class="w-full overflow-x-auto">
                    <ul class="flex items-center bg-white py-3 border-b border-gray-100 min-w-max">
                        <li class="relative group"><a href="#" class="text-red-600 font-semibold hover:text-[#5B9F01] transition px-3 whitespace-nowrap">Deals</a></li>
                        <li class="text-gray-300 whitespace-nowrap">|</li>
                        <li class="relative group"><a href="#" class="text-gray-700 hover:text-[#5B9F01] transition px-3 whitespace-nowrap">Hot</a></li>
                        <li class="text-gray-300 whitespace-nowrap">|</li>
                        <li class="relative group"><a href="#" class="text-gray-700 hover:text-[#5B9F01] transition px-3 whitespace-nowrap">Top Brands</a></li>
                        <li class="text-gray-300 whitespace-nowrap">|</li>
                        <li class="relative group"><a href="#" class="text-gray-700 hover:text-[#5B9F01] transition px-3 whitespace-nowrap">Best Sellers</a></li>
                        <li class="text-gray-300 whitespace-nowrap">|</li>
                        <li class="relative group"><a href="#" class="text-gray-700 hover:text-[#5B9F01] transition px-3 whitespace-nowrap">New Arrivals</a></li>
                        <li class="text-gray-300 whitespace-nowrap">|</li>
                        <li class="relative group"><a href="#" class="text-gray-700 hover:text-[#5B9F01] transition px-3 whitespace-nowrap">Clearance</a></li>
                        <li class="text-gray-300 whitespace-nowrap">|</li>
                        <li class="relative group"><a href="#" class="text-gray-700 hover:text-[#5B9F01] transition px-3 whitespace-nowrap">Support</a></li>
                        <li class="ml-auto hidden sm:block"><span class="text-gray-600 text-sm whitespace-nowrap">ðŸšš Free Shipping on Orders $50+</span></li>
                    </ul>
                </nav>

                <!-- Mobile Free Shipping Banner -->
                <div class="block sm:hidden text-center py-2 bg-gray-50 text-xs text-gray-600">ðŸšš Free Shipping on Orders $50+</div>
            </div>
        </div>

        <!-- Hero Section Content - Give it lower z-index -->
        <div class="mt-2 relative z-[1]" id="heroSectionContainer">
            <!-- Main Hero Row -->
            <div class="flex flex-col gap-5">
                <!-- Grid container: 2 columns side-by-side -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-1 sm:gap-1">

                    <!-- HERO BANNER 1 (LEFT COLUMN) -->
                    <div class="bg-gradient-to-br from-[#01285F] via-[#00349B] to-[#328429] rounded-xl sm:rounded-2xl p-4 sm:p-4 md:p-5 lg:p-6 relative z-0">
                        <div class="flex flex-col sm:flex-row items-center gap-6 sm:gap-6">
                            <!-- Left Content Area -->
                            <div class="flex-1 text-center sm:text-left w-full order-2 sm:order-1">
                                <div class="inline-flex items-center gap-1.5 sm:gap-2 bg-white/10 text-white px-3 sm:px-3 md:px-4 py-1 sm:py-1.5 rounded-full text-[11px] sm:text-xs md:text-sm font-semibold mb-3 sm:mb-3 md:mb-4">
                                    <span>NEW ARRIVAL</span>
                                </div>
                                <h1 class="text-2xl sm:text-xl md:text-2xl lg:text-2xl xl:text-3xl font-bold text-white mb-2 sm:mb-2 leading-tight">
                                    Power Your Devices.
                                </h1>
                                <h1 class="text-2xl sm:text-xl md:text-2xl lg:text-2xl xl:text-3xl font-bold text-[#76CA25] mb-2 sm:mb-2 leading-tight">
                                    Simplify Your Life.
                                </h1>
                                <p class="text-white text-sm sm:text-xs md:text-base lg:text-md mb-6 sm:mb-5 md:mb-6 max-w-md mx-auto sm:mx-0 px-2 sm:px-0">
                                    High-quality tech accessories built for performance, durability, and style.
                                </p>

                                <!-- Feature badges -->
                                <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3 sm:gap-3 md:gap-4 lg:gap-6 mb-5 sm:mb-4">
                                    <div class="flex items-center gap-2 sm:gap-2 md:gap-3">
                                        <div class="w-8 h-8 sm:w-6 sm:h-6 md:w-7 md:h-8 bg-[#003FAA] rounded-full flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-bolt text-white text-sm sm:text-sm md:text-base lg:text-xl"></i>
                                        </div>
                                        <div>
                                            <span class="text-white text-sm sm:text-xs md:text-sm font-semibold block leading-tight">35W</span>
                                            <span class="text-white/60 text-[10px] sm:text-[8px] md:text-[10px] block leading-tight">Fast Charging</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2 sm:gap-2 md:gap-3">
                                        <div class="w-8 h-8 sm:w-6 sm:h-6 md:w-7 md:h-8 bg-[#76CA25] rounded-full flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-shield-alt text-white text-sm sm:text-sm md:text-base lg:text-xl"></i>
                                        </div>
                                        <div>
                                            <span class="text-white text-sm sm:text-xs md:text-sm font-semibold block leading-tight">Heavy Duty</span>
                                            <span class="text-white/60 text-[10px] sm:text-[8px] md:text-[10px] block leading-tight">Durable Build</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action buttons -->
                                <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3 sm:gap-3 md:gap-4">
                                    <button class="bg-[#FFD700] text-gray-900 px-6 sm:px-4 md:px-5 lg:px-8 py-2.5 sm:py-2 md:py-2.5 lg:py-3 rounded-lg font-semibold hover:bg-[#FFE44D] transition shadow-md flex items-center gap-2 sm:gap-2 text-sm sm:text-sm md:text-base">
                                        Shop Now <i class="fas fa-arrow-right text-xs sm:text-xs md:text-sm"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Image Area -->
                            <div class="w-40 sm:w-40 md:w-48 lg:w-56 xl:w-64 flex-shrink-0 order-1 sm:order-2">
                                <div>
                                    <img src="{{asset('assets/images/hero/hero.png')}}" alt="USB Cable" class="w-full h-auto rounded-lg">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- HERO BANNER 2 (RIGHT COLUMN) -->
                    <div class="bg-gradient-to-br from-[#01285F] via-[#00349B] to-[#328429] rounded-xl sm:rounded-2xl p-4 sm:p-4 md:p-5 lg:p-6 relative z-0">
                        <div class="flex flex-col sm:flex-row items-center gap-6 sm:gap-6">
                            <!-- Left Content Area -->
                            <div class="flex-1 text-center sm:text-left w-full order-2 sm:order-1">
                                <div class="inline-flex items-center gap-1.5 sm:gap-2 bg-white/10 text-white px-3 sm:px-3 md:px-4 py-1 sm:py-1.5 rounded-full text-[11px] sm:text-xs md:text-sm font-semibold mb-3 sm:mb-3 md:mb-4">
                                    <span>NEW ARRIVAL</span>
                                </div>
                                <h1 class="text-2xl sm:text-xl md:text-2xl lg:text-2xl xl:text-3xl font-bold text-white mb-2 sm:mb-2 leading-tight">
                                    Power Your Devices.
                                </h1>
                                <h1 class="text-2xl sm:text-xl md:text-2xl lg:text-2xl xl:text-3xl font-bold text-[#76CA25] mb-2 sm:mb-2 leading-tight">
                                    Simplify Your Life.
                                </h1>
                                <p class="text-white text-sm sm:text-xs md:text-base lg:text-md mb-6 sm:mb-5 md:mb-6 max-w-md mx-auto sm:mx-0 px-2 sm:px-0">
                                    High-quality tech accessories built for performance, durability, and style.
                                </p>

                                <!-- Feature badges -->
                                <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3 sm:gap-3 md:gap-4 lg:gap-6 mb-5 sm:mb-4">
                                    <div class="flex items-center gap-2 sm:gap-2 md:gap-3">
                                        <div class="w-8 h-8 sm:w-6 sm:h-6 md:w-7 md:h-8 bg-[#003FAA] rounded-full flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-bolt text-white text-sm sm:text-sm md:text-base lg:text-xl"></i>
                                        </div>
                                        <div>
                                            <span class="text-white text-sm sm:text-xs md:text-sm font-semibold block leading-tight">35W</span>
                                            <span class="text-white/60 text-[10px] sm:text-[8px] md:text-[10px] block leading-tight">Fast Charging</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2 sm:gap-2 md:gap-3">
                                        <div class="w-8 h-8 sm:w-6 sm:h-6 md:w-7 md:h-8 bg-[#76CA25] rounded-full flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-shield-alt text-white text-sm sm:text-sm md:text-base lg:text-xl"></i>
                                        </div>
                                        <div>
                                            <span class="text-white text-sm sm:text-xs md:text-sm font-semibold block leading-tight">Heavy Duty</span>
                                            <span class="text-white/60 text-[10px] sm:text-[8px] md:text-[10px] block leading-tight">Durable Build</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action buttons -->
                                <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3 sm:gap-3 md:gap-4">
                                    <button class="bg-[#FFD700] text-gray-900 px-6 sm:px-4 md:px-5 lg:px-8 py-2.5 sm:py-2 md:py-2.5 lg:py-3 rounded-lg font-semibold hover:bg-[#FFE44D] transition shadow-md flex items-center gap-2 sm:gap-2 text-sm sm:text-sm md:text-base">
                                        Shop Now <i class="fas fa-arrow-right text-xs sm:text-xs md:text-sm"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Image Area -->
                            <div class="w-40 sm:w-40 md:w-48 lg:w-56 xl:w-64 flex-shrink-0 order-1 sm:order-2">
                                <div>
                                    <img src="{{asset('assets/images/hero/hero.png')}}" alt="USB Cable" class="w-full h-auto rounded-lg">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Trust Badges Section -->
            <div class="bg-white py-6 md:py-8 border-b border-gray-100">
                <div class="container mx-auto px-4 max-w-7xl">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                        <div class="flex items-center gap-3 p-3 md:p-4 bg-gray-50 rounded-xl"><div class="w-10 h-10 md:w-12 md:h-12 bg-[#5B9F01]/10 rounded-full flex items-center justify-center"><i class="fas fa-truck text-[#5B9F01] text-lg md:text-xl"></i></div><div><h3 class="text-sm md:text-sm font-bold text-gray-800">FREE SHIPPING</h3><p class="text-xs md:text-xs text-gray-500">On orders over $25</p></div></div>
                        <div class="flex items-center gap-3 p-3 md:p-4 bg-gray-50 rounded-xl"><div class="w-10 h-10 md:w-12 md:h-12 bg-[#5B9F01]/10 rounded-full flex items-center justify-center"><i class="fas fa-undo-alt text-[#5B9F01] text-lg md:text-xl"></i></div><div><h3 class="text-sm md:text-sm font-bold text-gray-800">30-DAY RETURNS</h3><p class="text-xs md:text-xs text-gray-500">Easy returns policy</p></div></div>
                        <div class="flex items-center gap-3 p-3 md:p-4 bg-gray-50 rounded-xl"><div class="w-10 h-10 md:w-12 md:h-12 bg-[#5B9F01]/10 rounded-full flex items-center justify-center"><i class="fas fa-lock text-[#5B9F01] text-lg md:text-xl"></i></div><div><h3 class="text-sm md:text-sm font-bold text-gray-800">SECURE PAYMENTS</h3><p class="text-xs md:text-xs text-gray-500">100% safe & secure</p></div></div>
                        <div class="flex items-center gap-3 p-3 md:p-4 bg-gray-50 rounded-xl"><div class="w-10 h-10 md:w-12 md:h-12 bg-[#5B9F01]/10 rounded-full flex items-center justify-center"><i class="fas fa-headset text-[#5B9F01] text-lg md:text-xl"></i></div><div><h3 class="text-sm md:text-sm font-bold text-gray-800">EXPERT SUPPORT</h3><p class="text-xs md:text-xs text-gray-500">24/7 customer support</p></div></div>
                    </div>
                </div>
            </div>



        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <!-- LEFT SIDE - COL 4 -->
            <div class="lg:col-span-3">
                 <!-- Deal of the Day Section -->
                <div class="bg-[#012D89] rounded-xl border border-gray-200 p-5 mt-4">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-bold text-[#FDCC02]">Deal of the Day</h2>
                        <span class="text-xs text-white">View All â†’</span>
                    </div>
                    <div class="mb-4">
                        <div class="flex items-center gap-2">
                            <div class="text-center">
                                <span class="bg-white/20 text-white text-xl font-bold px-4 py-2 rounded-lg min-w-[50px] inline-block">08</span>
                            </div>
                            <span class="text-white text-xl font-bold">:</span>
                            <div class="text-center">
                                <span class="bg-white/20 text-white text-xl font-bold px-4 py-2 rounded-lg min-w-[50px] inline-block">45</span>
                            </div>
                            <span class="text-white text-xl font-bold">:</span>
                            <div class="text-center">
                                <span class="bg-white/20 text-white text-xl font-bold px-4 py-2 rounded-lg min-w-[50px] inline-block">32</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 mt-1">
                            <div class="text-center min-w-[50px]"><span class="text-white/60 text-[10px]">HRS</span></div>
                            <div class="min-w-[10px]"></div>
                            <div class="text-center min-w-[50px]"><span class="text-white/60 text-[10px]">MINS</span></div>
                            <div class="min-w-[10px]"></div>
                            <div class="text-center min-w-[50px]"><span class="text-white/60 text-[10px]">SECS</span></div>
                        </div>
                    </div>
                    <div class="flex items-center justify-center gap-2 mb-1">
                        <span class="text-md text-white">Anker735Charger</span>
                        <span class="text-xs font-bold text-[#fdcc02]">ANKER</span>
                    </div>
                    <p class="text-center text-sm text-white mb-3">3-Port Fast Charger</p>
                    <div class="flex items-center justify-center gap-3 mb-3">
                        <span class="text-xl font-bold text-white">$39.99</span>
                        <span class="text-sm text-white line-through">$59.99</span>
                        <span class="bg-[#5B9F01] text-xs font-bold text-white p-2 rounded">33% OFF</span>
                    </div>
                    <button class="w-full bg-[#fdcc02] text-gray-900 py-2 rounded-lg text-sm font-medium hover:bg-[#fdcc02] transition">Add to Cart</button>
                </div>

                <!-- Rewards Banner Section -->
                <div class="bg-[#5B9F01] rounded-xl p-5 mb-6 mt-2">
                    <div class="flex flex-col sm:flex-row items-center gap-4">
                        <div class="flex-shrink-0"><div class="rounded-full flex items-center justify-center"><i class="fas fa-wallet text-white text-2xl"></i></div></div>
                        <div class="flex-1 text-center sm:text-left">
                            <h3 class="text-white text-md sm:text-sm font-bold mb-1">Get 5% Back in Rewards</h3>
                            <p class="text-white/80 text-xs">Join My Green Jack Rewards</p>
                            <p class="text-white/60 text-xs mt-0.5">It's free and easy.</p>
                        </div>
                    </div>
                </div>
                 <div class="rounded-xl overflow-hidden mt-4 relative group cursor-pointer shadow-lg">
    <!-- Full Width Banner Image from Unsplash -->
    <img src="https://images.unsplash.com/photo-1607083206869-4c7672e72a8a?w=1200&auto=format" 
         alt="Promotional Banner" 
         class="w-full h-auto object-cover">
    
    <!-- Optional Overlay with Text (if you want to add promotional message) -->
    <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-transparent flex items-center">
        <div class="text-white p-6 md:p-8">
            <h2 class="text-2xl md:text-3xl font-bold mb-2">Big Summer Sale</h2>
            <p class="text-sm md:text-base mb-3">Up to 50% off on selected items</p>
            <button class="bg-[#FDCC02] text-gray-900 px-5 py-2 rounded-lg text-sm font-semibold hover:bg-yellow-400 transition">Shop Now →</button>
        </div>
    </div>
</div>
            </div>
             <!-- LEFT SIDE - COL 8 -->
            <div class="lg:col-span-9">
                 <!-- Top Picks for You Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold text-gray-800">Top Picks for You</h2>
                    <a href="#" class="text-[#5B9F01] text-sm font-medium hover:underline">View All â†’</a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($products as $product)
                    <div class="product-card bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-300 group">
                        <div class="relative">
                            <a href="{{route('shop.details',$product->slug)}}" wire:navigate>
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Product" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            </a>
                            <span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">{{$product->category->name}}</span>
                            <button class="absolute top-2 right-2 w-8 h-8 bg-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition shadow-md">
                                <i class="far fa-heart text-gray-600 text-sm"></i>
                            </button>
                        </div>
                        <div class="p-3">
                            <a href="{{route('shop.details',$product->slug)}}" wire:navigate>
                                <h3 class="text-sm font-medium text-gray-800 line-clamp-2 mb-2">{{$product->name}}</h3>
                            </a>
                            <p class="text-gray-400 text-xs mb-2">{{ Str::limit($product->description, 60) }}</p>
                            <div class="flex items-center justify-between mt-3">
                                <span class="text-lg font-bold text-gray-900">${{$product->price}}</span>
                                <button wire:click="addToCart({{ $product->id }})" wire:loading.attr="disabled" wire:target="addToCart({{ $product->id }})" class="bg-[#FDCC02] text-gray-900 px-3 py-1.5 rounded-lg text-xs font-medium hover:bg-[#4a7f01] transition hover:text-white">
                                    <span wire:loading.remove wire:target="addToCart({{ $product->id }})"><i class="fas fa-shopping-cart"></i> Add to Cart</span>
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
                    @endforeach
                </div>
            </div>
                <!-- SECTION 1: Weekly Best Sellers -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-800">Weekly Best Sellers</h2>
                <a href="#" class="text-[#5B9F01] text-sm font-medium hover:underline">View All â†’</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Best Seller Product 1 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition group relative">
                    <div class="relative">
                        <img src="https://placehold.co/400x400/00349A/white?text=Wireless+Mouse" alt="Product" class="w-full h-48 object-cover">
                        <span class="absolute top-2 left-2 bg-[#FFD700] text-gray-900 text-xs font-bold px-2 py-1 rounded">#1 Best Seller</span>
                        <div class="absolute bottom-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded">4.8 â˜…</div>
                    </div>
                    <div class="p-3">
                        <h3 class="text-sm font-medium text-gray-800 mb-2">Wireless Bluetooth Mouse</h3>
                        <p class="text-gray-400 text-xs mb-2">Ergonomic design with 3-level DPI</p>
                        <div class="flex items-center justify-between mt-3">
                            <span class="text-lg font-bold text-gray-900">$24.99</span>
                            <button class="bg-[#FDCC02] text-gray-900 px-3 py-1.5 rounded-lg text-xs font-medium hover:bg-[#4a7f01] transition hover:text-white">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Best Seller Product 2 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition group relative">
                    <div class="relative">
                        <img src="https://placehold.co/400x400/328429/white?text=Keyboard" alt="Product" class="w-full h-48 object-cover">
                        <span class="absolute top-2 left-2 bg-[#FFD700] text-gray-900 text-xs font-bold px-2 py-1 rounded">#2 Best Seller</span>
                        <div class="absolute bottom-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded">4.7 â˜…</div>
                    </div>
                    <div class="p-3">
                        <h3 class="text-sm font-medium text-gray-800 mb-2">Mechanical Gaming Keyboard</h3>
                        <p class="text-gray-400 text-xs mb-2">RGB backlit with programmable keys</p>
                        <div class="flex items-center justify-between mt-3">
                            <span class="text-lg font-bold text-gray-900">$59.99</span>
                            <button class="bg-[#FDCC02] text-gray-900 px-3 py-1.5 rounded-lg text-xs font-medium hover:bg-[#4a7f01] transition hover:text-white">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Best Seller Product 3 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition group relative">
                    <div class="relative">
                        <img src="https://placehold.co/400x400/5B9F01/white?text=Monitor" alt="Product" class="w-full h-48 object-cover">
                        <span class="absolute top-2 left-2 bg-[#FFD700] text-gray-900 text-xs font-bold px-2 py-1 rounded">#3 Best Seller</span>
                        <div class="absolute bottom-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded">4.9 â˜…</div>
                    </div>
                    <div class="p-3">
                        <h3 class="text-sm font-medium text-gray-800 mb-2">27" 4K IPS Monitor</h3>
                        <p class="text-gray-400 text-xs mb-2">HDR10, 99% sRGB, USB-C</p>
                        <div class="flex items-center justify-between mt-3">
                            <span class="text-lg font-bold text-gray-900">$299.99</span>
                            <button class="bg-[#FDCC02] text-gray-900 px-3 py-1.5 rounded-lg text-xs font-medium hover:bg-[#4a7f01] transition hover:text-white">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Best Seller Product 4 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition group relative">
                    <div class="relative">
                        <img src="https://placehold.co/400x400/FDCC02/black?text=Webcam" alt="Product" class="w-full h-48 object-cover">
                        <span class="absolute top-2 left-2 bg-[#FFD700] text-gray-900 text-xs font-bold px-2 py-1 rounded">#4 Best Seller</span>
                        <div class="absolute bottom-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded">4.6 â˜…</div>
                    </div>
                    <div class="p-3">
                        <h3 class="text-sm font-medium text-gray-800 mb-2">1080P HD Webcam</h3>
                        <p class="text-gray-400 text-xs mb-2">Built-in microphone, auto-focus</p>
                        <div class="flex items-center justify-between mt-3">
                            <span class="text-lg font-bold text-gray-900">$49.99</span>
                            <button class="bg-[#FDCC02] text-gray-900 px-3 py-1.5 rounded-lg text-xs font-medium hover:bg-[#4a7f01] transition hover:text-white">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- SECTION 2: Limited Time Offers Banner -->


            </div>
        </div>
         <div class="mb-8">
            <div class="bg-gradient-to-r from-red-600 to-red-800 rounded-2xl p-6 relative overflow-hidden">
                <div class="absolute right-0 top-0 opacity-10">
                    <i class="fas fa-clock text-white text-9xl"></i>
                </div>
                <div class="relative z-10">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                        <div class="text-center md:text-left">
                            <span class="text-white/80 text-sm uppercase tracking-wider">Limited Time Offer</span>
                            <h3 class="text-white text-2xl font-bold mt-2">Flash Sale Ends in:</h3>
                            <div class="flex items-center gap-3 mt-3 justify-center md:justify-start">
                                <div class="text-center bg-white/20 rounded-lg px-3 py-2">
                                    <span class="text-white text-2xl font-bold">12</span>
                                    <span class="text-white text-xs block">HRS</span>
                                </div>
                                <span class="text-white text-2xl font-bold">:</span>
                                <div class="text-center bg-white/20 rounded-lg px-3 py-2">
                                    <span class="text-white text-2xl font-bold">45</span>
                                    <span class="text-white text-xs block">MINS</span>
                                </div>
                                <span class="text-white text-2xl font-bold">:</span>
                                <div class="text-center bg-white/20 rounded-lg px-3 py-2">
                                    <span class="text-white text-2xl font-bold">32</span>
                                    <span class="text-white text-xs block">SECS</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <p class="text-white text-sm mb-2">Extra 20% off on orders $100+</p>
                            <button class="bg-white text-red-600 px-6 py-2 rounded-lg font-bold hover:bg-gray-100 transition">
                                Shop Flash Sale â†’
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 3: Recently Viewed Products -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-800">Recently Viewed</h2>
                <a href="#" class="text-[#5B9F01] text-sm font-medium hover:underline">Clear All</a>
            </div>
            <div class="flex gap-4 overflow-x-auto pb-4 scrollbar-hide">
                <!-- Recently Viewed Item 1 -->
                <div class="min-w-[200px] bg-white rounded-lg shadow-sm hover:shadow-md transition p-3">
                    <img src="https://placehold.co/200x200/00349A/white?text=Phone+Case" alt="Product" class="w-full h-32 object-cover rounded-lg mb-2">
                    <h4 class="text-sm font-medium text-gray-800">Silicone Phone Case</h4>
                    <p class="text-gray-500 text-xs">$12.99</p>
                </div>

                <!-- Recently Viewed Item 2 -->
                <div class="min-w-[200px] bg-white rounded-lg shadow-sm hover:shadow-md transition p-3">
                    <img src="https://placehold.co/200x200/5B9F01/white?text=Charger" alt="Product" class="w-full h-32 object-cover rounded-lg mb-2">
                    <h4 class="text-sm font-medium text-gray-800">65W GaN Charger</h4>
                    <p class="text-gray-500 text-xs">$39.99</p>
                </div>

                <!-- Recently Viewed Item 3 -->
                <div class="min-w-[200px] bg-white rounded-lg shadow-sm hover:shadow-md transition p-3">
                    <img src="https://placehold.co/200x200/FF6B35/white?text=SSD" alt="Product" class="w-full h-32 object-cover rounded-lg mb-2">
                    <h4 class="text-sm font-medium text-gray-800">1TB External SSD</h4>
                    <p class="text-gray-500 text-xs">$89.99</p>
                </div>

                <!-- Recently Viewed Item 4 -->
                <div class="min-w-[200px] bg-white rounded-lg shadow-sm hover:shadow-md transition p-3">
                    <img src="https://placehold.co/200x200/012D89/white?text=Router" alt="Product" class="w-full h-32 object-cover rounded-lg mb-2">
                    <h4 class="text-sm font-medium text-gray-800">Wi-Fi 6 Router</h4>
                    <p class="text-gray-500 text-xs">$149.99</p>
                </div>

                <!-- Recently Viewed Item 5 -->
                <div class="min-w-[200px] bg-white rounded-lg shadow-sm hover:shadow-md transition p-3">
                    <img src="https://placehold.co/200x200/328429/white?text=Smartwatch" alt="Product" class="w-full h-32 object-cover rounded-lg mb-2">
                    <h4 class="text-sm font-medium text-gray-800">Smart Watch Pro</h4>
                    <p class="text-gray-500 text-xs">$199.99</p>
                </div>
                <!-- Recently Viewed Item 3 -->
                <div class="min-w-[200px] bg-white rounded-lg shadow-sm hover:shadow-md transition p-3">
                    <img src="https://placehold.co/200x200/FF6B35/white?text=SSD" alt="Product" class="w-full h-32 object-cover rounded-lg mb-2">
                    <h4 class="text-sm font-medium text-gray-800">1TB External SSD</h4>
                    <p class="text-gray-500 text-xs">$89.99</p>
                </div>
            </div>
        </div>
        <!-- SECTION 5: Customer Reviews & Testimonials -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">What Our Customers Say</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="text-gray-600 text-sm">5.0</span>
                    </div>
                    <p class="text-gray-600 text-sm mb-3">"Amazing product quality! Fast shipping and great customer service. Will definitely buy again!"</p>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-[#5B9F01] rounded-full flex items-center justify-center text-white text-sm font-bold">JD</div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-800">John Doe</h4>
                            <p class="text-xs text-gray-400">Verified Buyer</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="text-gray-600 text-sm">4.5</span>
                    </div>
                    <p class="text-gray-600 text-sm mb-3">"Great selection of products. The prices are competitive and delivery was quick."</p>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-[#00349A] rounded-full flex items-center justify-center text-white text-sm font-bold">JS</div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-800">Jane Smith</h4>
                            <p class="text-xs text-gray-400">Verified Buyer</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="text-gray-600 text-sm">5.0</span>
                    </div>
                    <p class="text-gray-600 text-sm mb-3">"Excellent customer support! They helped me choose the right product for my needs."</p>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-[#FDCC02] rounded-full flex items-center justify-center text-gray-900 text-sm font-bold">MC</div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-800">Mike Chen</h4>
                            <p class="text-xs text-gray-400">Verified Buyer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- SECTION 6: Newsletter Subscription -->
        <div class="mb-8">
            <div class="bg-gradient-to-br from-[#01285F] via-[#00349B] to-[#328429] rounded-2xl p-8 text-center">
                <h3 class="text-white text-2xl font-bold mb-2">Stay in the Loop</h3>
                <p class="text-white/80 mb-6">Subscribe to get special offers, free giveaways, and exclusive deals.</p>
                <div class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                    <input type="email" placeholder="Enter your email address" class=" bg-white flex-1 px-4 py-2 rounded-lg border-0 focus:outline-none focus:ring-2 focus:ring-[#5B9F01]">
                    <button class="bg-[#FDCC02] text-gray-900 px-6 py-2 rounded-lg font-semibold hover:bg-[#FFE44D] transition">
                        Subscribe â†’
                    </button>
                </div>
                <p class="text-white/60 text-xs mt-4">No spam. Unsubscribe anytime.</p>
            </div>
        </div>

        <style>
            /* Hide scrollbar for recently viewed section */
            .scrollbar-hide::-webkit-scrollbar {
                display: none;
            }
            .scrollbar-hide {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        </style>
    </div>
</div>

<script>
(function () {

    function initCategoriesToggle() {
        const toggleBtn = document.getElementById('categoriesToggleBtn');
        const collapseDiv = document.getElementById('categoriesCollapse');
        const chevronIcon = document.getElementById('chevronIcon');

        if (!toggleBtn || !collapseDiv) return;

        // prevent duplicate click events
        toggleBtn.onclick = function (e) {
            e.preventDefault();
            e.stopPropagation();

            const isHidden = collapseDiv.classList.contains('hidden');

            if (isHidden) {
                collapseDiv.classList.remove('hidden');

                if (chevronIcon) {
                    chevronIcon.style.transform = 'rotate(180deg)';
                }
            } else {
                collapseDiv.classList.add('hidden');

                if (chevronIcon) {
                    chevronIcon.style.transform = 'rotate(0deg)';
                }
            }
        };
    }

    document.addEventListener('click', function (e) {
        const toggleBtn = document.getElementById('categoriesToggleBtn');
        const collapseDiv = document.getElementById('categoriesCollapse');
        const chevronIcon = document.getElementById('chevronIcon');

        if (!toggleBtn || !collapseDiv) return;

        if (!toggleBtn.contains(e.target) && !collapseDiv.contains(e.target)) {
            collapseDiv.classList.add('hidden');

            if (chevronIcon) {
                chevronIcon.style.transform = 'rotate(0deg)';
            }
        }
    });

    document.addEventListener('DOMContentLoaded', initCategoriesToggle);
    document.addEventListener('livewire:navigated', initCategoriesToggle);

})();
</script>

<style>
    /* Smooth transition for collapse */
    #categoriesCollapse {
        transition: all 0.3s ease;
    }

    #categoriesCollapse:not(.hidden) {
        display: block;
        animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* CRITICAL: Ensure categories menu appears ABOVE everything */
    #categoriesCollapse {
    position: absolute !important;
    z-index: 60 !important;
}

    /* Make sure the overlay has highest z-index */
    /* #categoriesCollapse {
        z-index: 99999 !important;
    } */

    /* Ensure hero sections don't overlap the dropdown */
    #heroSectionContainer {
        position: relative;
        z-index: 1;
    }

    #categoriesCollapse {
    position: absolute !important;
    z-index: 99999 !important;
}

.card,
.card-header,
.card-body {
    overflow: visible !important;
}

#heroSectionContainer,
#heroSectionContainer * {
    z-index: auto;
}
</style>

</div>
