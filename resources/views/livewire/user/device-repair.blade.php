<!-- Dynamic Page View - Modern Design Inspired by Coupon Page -->
<div class="bg-gray-50 min-h-screen">
    
    <!-- Hero/Breadcrumb Section -->
    <div class="bg-gradient-to-r from-gray-900 to-gray-800 text-white">
        <div class="container mx-auto px-4 max-w-7xl py-12">
            <!-- Breadcrumb -->
            <div class="flex items-center gap-2 text-sm text-gray-300 mb-6">
                <a href="/" class="hover:text-white transition">Home</a>
                <i class="fas fa-chevron-right text-xs"></i>
                <span class="text-white font-medium">{{ $page->title }}</span>
            </div>
            
            <!-- Header Info -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold mb-2">{{ $page->title }}</h1>
                    @if($page->short_description)
                        <p class="text-gray-300 text-sm max-w-2xl">{{ $page->short_description }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 max-w-7xl py-10">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Main Content -->
            <div class="flex-1">
                
                <!-- Featured Image Card -->
                @if($page->featured_image)
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 mb-8">
        <div class="flex items-start gap-4">
            <div class="rounded-xl flex items-center justify-center">
                <img src="{{ asset('storage/'. $page->featured_image) }}" 
                     alt="{{ $page->title }}" 
                     class="w-full h-full object-cover">
            </div>
            <div class="flex-1">
                <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $page->title }}</h2>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                   {!!$page->description!!}
                </p>
                <a href="{{ route('repair') }}" wire:navigate
                   class="inline-flex items-center px-4 py-2 mt-5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition duration-200 ease-in-out transform hover:scale-105">
                   Get a free quote
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
@endif

               

                <!-- Left Image + Content Section -->
                @if($page->section_image_left || $page->content_left)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6 hover:shadow-md transition-shadow">
                    <div class="flex flex-col md:flex-row">
                        @if($page->section_image_left)
                        <div class="md:w-2/5">
                            <img src="{{ asset('storage/'. $page->section_image_left) }}" 
                                 alt="{{ $page->title }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        @endif
                        <div class="flex-1 p-6">
                            <div class="inline-flex items-center gap-2 bg-[#5B9F01]/10 px-3 py-1 rounded-full mb-4">
                                <span class="w-2 h-2 bg-[#5B9F01] rounded-full"></span>
                                <span class="text-[#5B9F01] text-xs font-semibold tracking-wide">Featured</span>
                            </div>
                            <div class="prose prose-sm max-w-none text-gray-600">
                                {!! $page->content_left !!}
                            </div>
                            <div class="mt-4 flex items-center gap-3">
                                <span class="text-[#5B9F01] font-semibold text-sm">LEARN MORE</span>
                                <i class="fas fa-arrow-right text-[#5B9F01] text-xs"></i>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Right Image + Content Section -->
                @if($page->section_image_right || $page->content_right)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6 hover:shadow-md transition-shadow">
                    <div class="flex flex-col md:flex-row-reverse">
                        @if($page->section_image_right)
                        <div class="md:w-2/5">
                            <img src="{{ asset('storage/'. $page->section_image_right) }}" 
                                 alt="{{ $page->title }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        @endif
                        <div class="flex-1 p-6">
                            <div class="inline-flex items-center gap-2 bg-[#5B9F01]/10 px-3 py-1 rounded-full mb-4">
                                <i class="fas fa-star text-[#5B9F01] text-xs"></i>
                                <span class="text-[#5B9F01] text-xs font-semibold tracking-wide">Why Choose Us</span>
                            </div>
                            <div class="prose prose-sm max-w-none text-gray-600">
                                {!! $page->content_right !!}
                            </div>
                            <div class="mt-6 flex items-center gap-4">
                                <div class="flex -space-x-2">
                                    <div class="w-8 h-8 rounded-full bg-gray-200 border-2 border-white flex items-center justify-center text-xs font-bold">JD</div>
                                    <div class="w-8 h-8 rounded-full bg-gray-300 border-2 border-white flex items-center justify-center text-xs font-bold">MK</div>
                                    <div class="w-8 h-8 rounded-full bg-gray-400 border-2 border-white flex items-center justify-center text-xs font-bold text-white">+</div>
                                </div>
                                <span class="text-xs text-gray-500">Trusted by <strong>10,000+</strong> customers</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:w-80 flex-shrink-0">
                
                <!-- Quick Stats Card -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 mb-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-chart-line text-[#5B9F01]"></i>
                        Quick Stats
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                            <span class="text-gray-600 text-sm">Active</span>
                            <span class="font-semibold text-green-600">8</span>
                        </div>
                        <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                            <span class="text-gray-600 text-sm">Expired</span>
                            <span class="font-semibold text-gray-400">8</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 text-sm">Total</span>
                            <span class="font-semibold text-gray-800">16</span>
                        </div>
                    </div>
                </div>

                <!-- Popular / Related Links -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-fire text-[#5B9F01]"></i>
                        Popular Services
                    </h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="#" class="flex items-center justify-between text-gray-600 hover:text-[#5B9F01] transition group">
                                <span>iPhone Repair</span>
                                <i class="fas fa-chevron-right text-xs opacity-0 group-hover:opacity-100 transition"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-between text-gray-600 hover:text-[#5B9F01] transition group">
                                <span>iPad Repair</span>
                                <i class="fas fa-chevron-right text-xs opacity-0 group-hover:opacity-100 transition"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-between text-gray-600 hover:text-[#5B9F01] transition group">
                                <span>MacBook Repair</span>
                                <i class="fas fa-chevron-right text-xs opacity-0 group-hover:opacity-100 transition"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-between text-gray-600 hover:text-[#5B9F01] transition group">
                                <span>Android Phone Repair</span>
                                <i class="fas fa-chevron-right text-xs opacity-0 group-hover:opacity-100 transition"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center justify-between text-gray-600 hover:text-[#5B9F01] transition group">
                                <span>Game Console Repair</span>
                                <i class="fas fa-chevron-right text-xs opacity-0 group-hover:opacity-100 transition"></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Card -->
                <div class="bg-gradient-to-r from-[#5B9F01] to-[#4a7f01] rounded-2xl p-6 mt-6 text-white">
                    <i class="fas fa-headset text-3xl mb-3"></i>
                    <h4 class="text-lg font-bold mb-2">Need Help?</h4>
                    <p class="text-sm opacity-90 mb-4">Our experts are here to assist you</p>
                    <a href="/contact" class="inline-flex items-center gap-2 bg-white text-[#5B9F01] px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-100 transition">
                        Contact Us <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <style>
    /* Custom Prose Styling */
    .prose {
        color: #4b5563;
        line-height: 1.6;
    }
    
    .prose h1, .prose h2, .prose h3 {
        color: #1f2937;
        font-weight: 600;
        margin-top: 1.5em;
        margin-bottom: 0.5em;
    }
    
    .prose h1 { font-size: 1.875rem; }
    .prose h2 { font-size: 1.5rem; }
    .prose h3 { font-size: 1.25rem; }
    
    .prose p {
        margin-bottom: 1em;
    }
    
    .prose ul, .prose ol {
        margin: 1em 0;
        padding-left: 1.5em;
    }
    
    .prose li {
        margin: 0.25em 0;
    }
    
    .prose a {
        color: #5B9F01;
        text-decoration: none;
    }
    
    .prose a:hover {
        text-decoration: underline;
    }
    
    /* Hover Effects */
    .hover-lift {
        transition: all 0.3s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-2px);
    }
</style>
</div>

