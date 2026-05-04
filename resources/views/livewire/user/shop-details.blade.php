<div>
    <main class="bg-gray-50 py-6">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Breadcrumb -->
        <div class="mb-6">
            <nav class="flex items-center gap-2 text-sm text-gray-500 overflow-x-auto pb-2">
                <a href="#" class="hover:text-[#5B9F01] transition">Home</a>
                <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                <a href="#" class="hover:text-[#5B9F01] transition">{{$product->category->name}}</a>
                <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                <span class="text-gray-800 font-medium">{{$product->name}}</span>
            </nav>
        </div>

        <!-- Product Main Section -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-6">
                <!-- Product Images Gallery -->
                <div>
                    <!-- Main Image -->
                    <div class="relative mb-4 bg-gray-100 rounded-lg overflow-hidden">
                        <img id="mainImage" src="{{asset('storage/' . $product->image)}}" alt="Product" class="w-full h-auto object-cover">
                        <button class="absolute top-4 right-4 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md hover:bg-gray-100 transition">
                            <i class="far fa-heart text-gray-600"></i>
                        </button>
                        {{-- <span class="absolute top-4 left-4 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full">-35%</span> --}}
                    </div>

                    <!-- Thumbnail Images -->
                    <div class="grid grid-cols-5 gap-3">
                         <div class="thumbnail-item border-2 border-transparent rounded-lg overflow-hidden cursor-pointer hover:border-[#5B9F01] transition"
                                data-image="{{ asset('storage/' . $product->image) }}">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="w-full h-auto">
                            </div>
                       @if($product->productimages && $product->productimages->isNotEmpty() && $product->productimages->first()->images)
                            @foreach(json_decode($product->productimages->first()->images, true) as $index => $imagePath)
                                <div class="thumbnail-item border-2 border-transparent rounded-lg overflow-hidden cursor-pointer hover:border-[#5B9F01] transition"
                                    data-image="{{ asset('storage/' . $imagePath) }}">
                                    <img src="{{ asset('storage/' . $imagePath) }}" alt="Product Image {{ $index + 1 }}" class="w-full h-auto">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Product Info -->
                <div>
                    <!-- Category -->
                    <a href="#" class="text-[#5B9F01] text-sm font-medium mb-2 inline-block">{{$product->category->name}}</a>

                    <!-- Title -->
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">{{$product->name}}</h1>

                    <!-- Ratings -->
                    <div class="flex items-center gap-3 mb-4">
                        <div class="flex items-center gap-1 text-yellow-400">
                            <i class="fas fa-star text-sm"></i>
                            <i class="fas fa-star text-sm"></i>
                            <i class="fas fa-star text-sm"></i>
                            <i class="fas fa-star text-sm"></i>
                            <i class="far fa-star text-sm"></i>
                        </div>
                        <span class="text-sm text-gray-500">(3 customer reviews)</span>
                        <span class="text-green-600 text-sm font-medium flex items-center gap-1">
                            <i class="fas fa-check-circle"></i> In Stock
                        </span>
                    </div>

                    <!-- Brand & SKU -->
                    <div class="flex flex-wrap items-center gap-4 mb-4 pb-4 border-b border-gray-200">
                        {{-- <div class="flex items-center gap-2">
                            <span class="text-sm text-gray-500">Brand:</span>
                            <img src="https://placehold.co/80x30/e2e8f0/475569?text=Brand" alt="Brand" class="h-6">
                        </div> --}}
                        <div class="text-sm text-gray-500">
                            <span class="font-medium">SKU:</span> {{$product->sku}}
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="mb-4">
                        <div class="flex items-baseline gap-3">
                            <span class="text-3xl font-bold text-[#5B9F01]">${{$product->price}}</span>
                            {{-- <span class="text-lg text-gray-400 line-through">$2,299.00</span> --}}
                            {{-- <span class="bg-red-100 text-red-600 text-xs font-bold px-2 py-1 rounded">Save $300</span> --}}
                        </div>
                    </div>

                    <!-- Features List -->
                    {{-- <div class="mb-4">
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check-circle text-[#5B9F01] mt-0.5"></i>
                                <span>4.5 inch HD Touch Screen (1280 x 720)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check-circle text-[#5B9F01] mt-0.5"></i>
                                <span>Android 4.4 KitKat OS</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check-circle text-[#5B9F01] mt-0.5"></i>
                                <span>1.4 GHz Quad Core™ Processor</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fas fa-check-circle text-[#5B9F01] mt-0.5"></i>
                                <span>20 MP Electro and 28 megapixel CMOS rear camera</span>
                            </li>
                        </ul>
                    </div> --}}

                    <p class="text-gray-600 text-sm mb-4">{{$product->description}}</p>

                    <!-- Color Selection -->
                    {{-- <div class="mb-4 pb-4 border-b border-gray-200">
                        <h6 class="text-sm font-semibold text-gray-800 mb-2">Color</h6>
                        <div class="flex items-center gap-3">
                            <button class="color-option w-10 h-10 rounded-full bg-gradient-to-r from-white to-gray-200 border-2 border-[#5B9F01] ring-2 ring-[#5B9F01]/20"></button>
                            <button class="color-option w-10 h-10 rounded-full bg-red-500 border-2 border-transparent hover:border-gray-300 transition"></button>
                            <button class="color-option w-10 h-10 rounded-full bg-blue-500 border-2 border-transparent hover:border-gray-300 transition"></button>
                            <button class="color-option w-10 h-10 rounded-full bg-green-500 border-2 border-transparent hover:border-gray-300 transition"></button>
                            <button class="color-option w-10 h-10 rounded-full bg-black border-2 border-transparent hover:border-gray-300 transition"></button>
                        </div>
                    </div> --}}

                    <!-- Quantity and Add to Cart -->
<div class="flex flex-wrap items-center gap-4 mb-4">
    <div class="flex items-center border border-gray-300 rounded-lg">
        <button wire:click="decreaseQuantity" wire:loading.attr="disabled" class="qty-btn w-10 h-10 flex items-center justify-center text-gray-600 hover:bg-gray-100 transition disabled:opacity-50">-</button>
        <input type="number" wire:model="quantity" wire:change="updatedQuantity($event.target.value)" class="qty-input w-14 h-10 text-center border-x border-gray-300 focus:outline-none">
        <button wire:click="increaseQuantity" wire:loading.attr="disabled" class="qty-btn w-10 h-10 flex items-center justify-center text-gray-600 hover:bg-gray-100 transition disabled:opacity-50">+</button>
    </div>
    <button wire:click="addToCart" wire:loading.attr="disabled" class="flex-1 bg-[#FFD814] hover:bg-[#F7CA00] text-gray-800 font-semibold py-3 px-6 rounded-lg transition flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
        <span wire:loading.remove wire:target="addToCart">
            <i class="fas fa-shopping-cart"></i>
            Add to Cart
        </span>
        <span wire:loading wire:target="addToCart" class="flex items-center gap-2">
            <svg class="animate-spin h-4 w-4 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Adding...
        </span>
    </button>
    <button class="w-12 h-12 border border-gray-300 rounded-lg hover:bg-gray-50 transition flex items-center justify-center">
        <i class="far fa-heart text-gray-600"></i>
    </button>
    <button class="w-12 h-12 border border-gray-300 rounded-lg hover:bg-gray-50 transition flex items-center justify-center">
        <i class="fas fa-exchange-alt text-gray-600"></i>
    </button>
</div>

                    <!-- Delivery Info -->
                    <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                        <div class="flex items-center gap-2 text-sm">
                            <i class="fas fa-truck text-[#5B9F01]"></i>
                            <span class="text-gray-600">Free Shipping on orders over $50</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <i class="fas fa-undo-alt text-[#5B9F01]"></i>
                            <span class="text-gray-600">30-day easy returns</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <i class="fas fa-shield-alt text-[#5B9F01]"></i>
                            <span class="text-gray-600">2-year warranty included</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Tabs -->
        {{-- <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
            <!-- Tab Headers -->
            <div class="border-b border-gray-200 overflow-x-auto">
                <div class="flex min-w-max">
                    <button class="tab-btn px-6 py-4 text-sm font-semibold border-b-2 border-[#5B9F01] text-[#5B9F01] transition" data-tab="accessories">
                        Accessories
                    </button>
                    <button class="tab-btn px-6 py-4 text-sm font-semibold border-b-2 border-transparent text-gray-600 hover:text-gray-800 transition" data-tab="description">
                        Description
                    </button>
                    <button class="tab-btn px-6 py-4 text-sm font-semibold border-b-2 border-transparent text-gray-600 hover:text-gray-800 transition" data-tab="specification">
                        Specification
                    </button>
                    <button class="tab-btn px-6 py-4 text-sm font-semibold border-b-2 border-transparent text-gray-600 hover:text-gray-800 transition" data-tab="reviews">
                        Reviews (3)
                    </button>
                </div>
            </div>

            <!-- Tab Content - Accessories -->
            <div id="tab-accessories" class="tab-content p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Accessories List -->
                    <div>
                        <div class="space-y-4">
                            <div class="flex items-start gap-3 pb-4 border-b border-gray-100">
                                <input type="checkbox" class="mt-1 w-5 h-5 rounded border-gray-300 text-[#5B9F01] focus:ring-[#5B9F01]" checked>
                                <div class="flex-1">
                                    <div class="flex items-center gap-4">
                                        <img src="https://placehold.co/80x80/e2e8f0/475569?text=Case" alt="Accessory" class="w-16 h-16 rounded-lg object-cover">
                                        <div class="flex-1">
                                            <h4 class="font-medium text-gray-800">Universal Headphones Case in Black</h4>
                                            <p class="text-sm text-gray-500">Protective carrying case</p>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-lg font-bold text-[#5B9F01]">$159.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 pb-4 border-b border-gray-100">
                                <input type="checkbox" class="mt-1 w-5 h-5 rounded border-gray-300 text-[#5B9F01] focus:ring-[#5B9F01]" checked>
                                <div class="flex-1">
                                    <div class="flex items-center gap-4">
                                        <img src="https://placehold.co/80x80/e2e8f0/475569?text=Cable" alt="Accessory" class="w-16 h-16 rounded-lg object-cover">
                                        <div class="flex-1">
                                            <h4 class="font-medium text-gray-800">Headphones USB Cables</h4>
                                            <p class="text-sm text-gray-500">Charging cable set</p>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-lg font-bold text-[#5B9F01]">$50.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 pb-4 border-b border-gray-100">
                                <input type="checkbox" class="mt-1 w-5 h-5 rounded border-gray-300 text-[#5B9F01] focus:ring-[#5B9F01]">
                                <div class="flex-1">
                                    <div class="flex items-center gap-4">
                                        <img src="https://placehold.co/80x80/e2e8f0/475569?text=Adapter" alt="Accessory" class="w-16 h-16 rounded-lg object-cover">
                                        <div class="flex-1">
                                            <h4 class="font-medium text-gray-800">Bluetooth Adapter</h4>
                                            <p class="text-sm text-gray-500">Wireless connectivity adapter</p>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-lg font-bold text-[#5B9F01]">$35.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Section -->
                    <div class="bg-gray-50 rounded-lg p-6 h-fit">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Bundle Summary</h3>
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Main Product:</span>
                                <span class="font-medium">$1,999.00</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Accessories (2 items):</span>
                                <span class="font-medium">$209.00</span>
                            </div>
                            <div class="border-t border-gray-200 pt-2 mt-2">
                                <div class="flex justify-between font-bold text-lg">
                                    <span>Total:</span>
                                    <span class="text-[#5B9F01]">$2,208.00</span>
                                </div>
                            </div>
                        </div>
                        <button class="w-full bg-[#5B9F01] hover:bg-[#4a7f01] text-white font-semibold py-3 rounded-lg transition">
                            Add Bundle to Cart
                        </button>
                        <p class="text-xs text-gray-500 text-center mt-3">Save $35 when buying together</p>
                    </div>
                </div>
            </div>

            <!-- Tab Content - Description -->
            <div id="tab-description" class="tab-content hidden p-6">
                <div class="max-w-4xl mx-auto">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Perfectly Done</h3>
                    <p class="text-gray-600 mb-6">Praesent ornare, ex a interdum consectetur, lectus diam sodales elit, vitae egestas est enim ornare nisl. Nullam in lectus nec sem semper viverra. In lobortis egestas massa. Nam nec massa nisi. Suspendisse potenti. Quisque suscipit vulputate dui quis volutpat. Ut id elit facilisis, feugiat est in, tempus lacus. Ut ultrices dictum metus, a ultricies ex vulputate ac. Ut id cursus tellus, non tempor quam. Morbi porta diam nisi, id finibus nunc tincidunt eu.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div>
                            <h4 class="text-xl font-bold text-gray-800 mb-3">Wireless Technology</h4>
                            <p class="text-gray-600 mb-6">Fusce vitae nibh mi. Integer posuere, libero et ullamcorper facilisis, enim eros tincidunt orci, eget vestibulum sapien nisi ut leo. Cras finibus vel est ut mollis. Donec luctus condimentum ante et euismod.</p>
                            <h4 class="text-xl font-bold text-gray-800 mb-3">Fresh Design</h4>
                            <p class="text-gray-600">Integer bibendum aliquet ipsum, in ultrices enim sodales sed. Quisque ut urna vitae lacus laoreet malesuada eu at massa. Pellentesque nibh augue, pellentesque nec dictum vel, pretium a arcu.</p>
                        </div>
                        <div>
                            <img src="https://placehold.co/500x400/e2e8f0/475569?text=Product+Image" alt="Product" class="rounded-lg w-full">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <img src="https://placehold.co/500x400/e2e8f0/475569?text=Product+Image+2" alt="Product" class="rounded-lg w-full">
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-800 mb-3">Intelligent Bass</h4>
                            <p class="text-gray-600 mb-6">Fusce vitae nibh mi. Integer posuere, libero et ullamcorper facilisis, enim eros tincidunt orci, eget vestibulum sapien nisi ut leo. Cras finibus vel est ut mollis.</p>
                            <h4 class="text-xl font-bold text-gray-800 mb-3">Long Battery Life</h4>
                            <p class="text-gray-600">Integer bibendum aliquet ipsum, in ultrices enim sodales sed. Quisque ut urna vitae lacus laoreet malesuada eu at massa.</p>
                        </div>
                    </div>

                    <!-- Product Tags -->
                    <div class="flex flex-wrap items-center gap-4 pt-6 mt-6 border-t border-gray-200">
                        <span class="text-sm font-medium text-gray-700">SKU:</span>
                        <span class="text-sm text-gray-500">FW511948218</span>
                        <span class="text-gray-300">|</span>
                        <span class="text-sm font-medium text-gray-700">Category:</span>
                        <a href="#" class="text-sm text-[#5B9F01] hover:underline">Headphones</a>
                        <span class="text-gray-300">|</span>
                        <span class="text-sm font-medium text-gray-700">Tags:</span>
                        <a href="#" class="text-sm text-[#5B9F01] hover:underline">Fast</a>
                        <a href="#" class="text-sm text-[#5B9F01] hover:underline">Gaming</a>
                        <a href="#" class="text-sm text-[#5B9F01] hover:underline">Strong</a>
                    </div>
                </div>
            </div>

            <!-- Tab Content - Specification -->
            <div id="tab-specification" class="tab-content hidden p-6">
                <div class="max-w-3xl mx-auto">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Technical Specifications</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <tbody class="divide-y divide-gray-200">
                                <tr class="hover:bg-gray-50">
                                    <th class="text-left py-3 px-4 font-medium text-gray-600 w-1/3">Brand</th>
                                    <td class="py-3 px-4 text-gray-800">Apple</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <th class="text-left py-3 px-4 font-medium text-gray-600">Item Height</th>
                                    <td class="py-3 px-4 text-gray-800">18 Millimeters</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <th class="text-left py-3 px-4 font-medium text-gray-600">Item Width</th>
                                    <td class="py-3 px-4 text-gray-800">31.4 Centimeters</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <th class="text-left py-3 px-4 font-medium text-gray-600">Screen Size</th>
                                    <td class="py-3 px-4 text-gray-800">13 Inches</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <th class="text-left py-3 px-4 font-medium text-gray-600">Item Weight</th>
                                    <td class="py-3 px-4 text-gray-800">1.6 Kg</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <th class="text-left py-3 px-4 font-medium text-gray-600">Product Dimensions</th>
                                    <td class="py-3 px-4 text-gray-800">21.9 x 31.4 x 1.8 cm</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <th class="text-left py-3 px-4 font-medium text-gray-600">Processor Brand</th>
                                    <td class="py-3 px-4 text-gray-800">Intel</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <th class="text-left py-3 px-4 font-medium text-gray-600">Processor Type</th>
                                    <td class="py-3 px-4 text-gray-800">Core i5</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <th class="text-left py-3 px-4 font-medium text-gray-600">RAM Size</th>
                                    <td class="py-3 px-4 text-gray-800">8 GB</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <th class="text-left py-3 px-4 font-medium text-gray-600">Hard Drive Size</th>
                                    <td class="py-3 px-4 text-gray-800">512 GB</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <th class="text-left py-3 px-4 font-medium text-gray-600">Operating System</th>
                                    <td class="py-3 px-4 text-gray-800">Mac OS</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <th class="text-left py-3 px-4 font-medium text-gray-600">Battery Life</th>
                                    <td class="py-3 px-4 text-gray-800">9 hours</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tab Content - Reviews -->
            <div id="tab-reviews" class="tab-content hidden p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Ratings Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-gray-50 rounded-lg p-6 text-center">
                            <h3 class="text-lg font-bold text-gray-800 mb-2">Overall Rating</h3>
                            <div class="text-5xl font-bold text-[#5B9F01] mb-2">4.3</div>
                            <div class="flex justify-center gap-1 text-yellow-400 mb-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <p class="text-sm text-gray-500">Based on 3 reviews</p>
                        </div>

                        <!-- Rating Breakdown -->
                        <div class="mt-4 space-y-2">
                            <div class="flex items-center gap-2">
                                <span class="text-sm w-12">5 star</span>
                                <div class="flex-1 bg-gray-200 rounded-full h-2 overflow-hidden">
                                    <div class="bg-yellow-400 h-full rounded-full" style="width: 100%"></div>
                                </div>
                                <span class="text-sm text-gray-600 w-10">205</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-sm w-12">4 star</span>
                                <div class="flex-1 bg-gray-200 rounded-full h-2 overflow-hidden">
                                    <div class="bg-yellow-400 h-full rounded-full" style="width: 53%"></div>
                                </div>
                                <span class="text-sm text-gray-600 w-10">55</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-sm w-12">3 star</span>
                                <div class="flex-1 bg-gray-200 rounded-full h-2 overflow-hidden">
                                    <div class="bg-yellow-400 h-full rounded-full" style="width: 20%"></div>
                                </div>
                                <span class="text-sm text-gray-600 w-10">23</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-sm w-12">2 star</span>
                                <div class="flex-1 bg-gray-200 rounded-full h-2 overflow-hidden">
                                    <div class="bg-yellow-400 h-full rounded-full" style="width: 0%"></div>
                                </div>
                                <span class="text-sm text-gray-600 w-10">0</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-sm w-12">1 star</span>
                                <div class="flex-1 bg-gray-200 rounded-full h-2 overflow-hidden">
                                    <div class="bg-yellow-400 h-full rounded-full" style="width: 1%"></div>
                                </div>
                                <span class="text-sm text-gray-600 w-10">4</span>
                            </div>
                        </div>
                    </div>

                    <!-- Write Review Form -->
                    <div class="lg:col-span-2">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Write a Review</h3>
                        <form class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Your Rating</label>
                                <div class="flex gap-1 text-2xl text-gray-300 cursor-pointer">
                                    <i class="far fa-star hover:text-yellow-400 transition"></i>
                                    <i class="far fa-star hover:text-yellow-400 transition"></i>
                                    <i class="far fa-star hover:text-yellow-400 transition"></i>
                                    <i class="far fa-star hover:text-yellow-400 transition"></i>
                                    <i class="far fa-star hover:text-yellow-400 transition"></i>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Your Review</label>
                                <textarea rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5B9F01] focus:border-transparent"></textarea>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5B9F01] focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                                    <input type="email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5B9F01] focus:border-transparent">
                                </div>
                            </div>
                            <button type="submit" class="bg-[#5B9F01] hover:bg-[#4a7f01] text-white font-semibold px-6 py-2 rounded-lg transition">
                                Submit Review
                            </button>
                        </form>

                        <!-- Existing Reviews -->
                        <div class="mt-8 space-y-6">
                            <div class="border-b border-gray-100 pb-4">
                                <div class="flex items-center gap-2 text-yellow-400 mb-2">
                                    <i class="fas fa-star text-sm"></i>
                                    <i class="fas fa-star text-sm"></i>
                                    <i class="fas fa-star text-sm"></i>
                                    <i class="far fa-star text-sm"></i>
                                    <i class="far fa-star text-sm"></i>
                                </div>
                                <p class="text-gray-600 text-sm mb-2">Fusce vitae nibh mi. Integer posuere, libero et ullamcorper facilisis, enim eros tincidunt orci, eget vestibulum sapien nisi ut leo.</p>
                                <div class="flex items-center gap-2 text-sm">
                                    <span class="font-medium text-gray-800">John Doe</span>
                                    <span class="text-gray-400">- April 3, 2024</span>
                                </div>
                            </div>
                            <div class="border-b border-gray-100 pb-4">
                                <div class="flex items-center gap-2 text-yellow-400 mb-2">
                                    <i class="fas fa-star text-sm"></i>
                                    <i class="fas fa-star text-sm"></i>
                                    <i class="fas fa-star text-sm"></i>
                                    <i class="fas fa-star text-sm"></i>
                                    <i class="fas fa-star text-sm"></i>
                                </div>
                                <p class="text-gray-600 text-sm mb-2">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse eget facilisis odio.</p>
                                <div class="flex items-center gap-2 text-sm">
                                    <span class="font-medium text-gray-800">Anna Kowalsky</span>
                                    <span class="text-gray-400">- April 3, 2024</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Related Products -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-800">Related Products</h3>
                <a href="#" class="text-[#5B9F01] text-sm font-medium hover:underline">View All →</a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                <!-- Product Card 1 -->
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
                    {{-- <div class="flex items-center gap-1 mb-1">
                        <div class="flex text-yellow-400 text-xs">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="text-xs text-gray-500">(1,234)</span>
                    </div> --}}
                    <a href="{{route('shop.details',$product->slug)}}" wire:navigate>
                    <h3 class="text-sm font-medium text-gray-800 line-clamp-2 mb-2">{{$product->name}}</h3>
                    </a>
                    <p class="text-gray-400 text-xs mb-2">{{$product->description}}</p>
                    <div class="flex items-baseline gap-2 mb-2">
                        <span class="text-lg font-bold text-gray-900">${{$product->price}}</span>
                        {{-- <span class="text-xs text-gray-400 line-through">$1,149<sup>99</sup></span> --}}
                    </div>
                    {{-- <div class="flex items-center gap-1 mb-2">
                        <i class="fas fa-truck text-green-600 text-xs"></i>
                        <span class="text-xs text-green-600">FREE Shipping</span>
                    </div> --}}
                   <button wire:click="addRelatedToCart({{ $product->id }})"
        wire:loading.attr="disabled"
        wire:target="addRelatedToCart({{ $product->id }})"
        class="w-full bg-[#5B9F01] hover:bg-[#F7CA00] text-white hover:text-gray-800 text-sm font-medium py-2 rounded-md transition flex items-center justify-center gap-2">
    <span wire:loading.remove wire:target="addRelatedToCart({{ $product->id }})">
        <i class="fas fa-shopping-cart"></i>
        Add to Cart
    </span>
    <span wire:loading wire:target="addRelatedToCart({{ $product->id }})" class="flex items-center gap-2">
        <svg class="animate-spin h-3 w-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
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
        </div>

       
    </div>
</main>

<script>
    $(document).ready(function() {
        // Initialize all functions
        initTabs();
        initThumbnails();
        initQuantitySelector();
    });

    // Re-initialize after Livewire navigation
    document.addEventListener('livewire:navigated', function() {
        initTabs();
        initThumbnails();
        initQuantitySelector();
    });

    // Tab switching functionality
    function initTabs() {
        $('.tab-btn').off('click').on('click', function() {
            const tabId = $(this).data('tab');

            // Update active states for buttons
            $('.tab-btn').removeClass('border-[#5B9F01] text-[#5B9F01]');
            $('.tab-btn').addClass('border-transparent text-gray-600');
            $(this).addClass('border-[#5B9F01] text-[#5B9F01]');
            $(this).removeClass('border-transparent text-gray-600');

            // Show selected tab content
            $('.tab-content').addClass('hidden');
            $(`#tab-${tabId}`).removeClass('hidden');
        });
    }

    // Thumbnail image switcher
    function initThumbnails() {
        $('.thumbnail-item').off('click').on('click', function() {
            const imageUrl = $(this).data('image');
            const mainImage = $('#mainImage');

            if (mainImage.length) {
                mainImage.attr('src', imageUrl);
            }

            // Update active thumbnail border
            $('.thumbnail-item').removeClass('border-[#5B9F01]').addClass('border-transparent');
            $(this).addClass('border-[#5B9F01]').removeClass('border-transparent');
        });
    }

    // Quantity selector
    function initQuantitySelector() {
        const maxStock = parseInt('{{ $product->stock ?? 99 }}');

        $('.qty-btn').off('click').on('click', function() {
            const qtyInput = $('.qty-input');
            let value = parseInt(qtyInput.val());

            if ($(this).text() === '+' && value < maxStock) {
                qtyInput.val(value + 1);
            } else if ($(this).text() === '-' && value > 1) {
                qtyInput.val(value - 1);
            }
        });
    }
</script>
</div>
