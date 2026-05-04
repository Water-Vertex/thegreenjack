<!-- Dynamic Page View - Amazon Inspired Professional UI -->
<div class="bg-[#EAEDED] min-h-screen font-['Amazon Ember', 'Helvetica Neue', Arial, sans-serif]">

    <!-- Amazon Top Bar Breadcrumb -->
    <div class="bg-white border-b border-gray-200 sticky top-0 z-20">
        <div class="container mx-auto px-4 max-w-7xl py-3">
            <div class="flex items-center gap-1 text-xs text-[#007185]">
                <a href="/" class="hover:text-[#C7511F] hover:underline">Home</a>
                <span class="text-gray-400 mx-1">›</span>
                <a href="#" class="hover:text-[#C7511F] hover:underline">Services</a>
                <span class="text-gray-400 mx-1">›</span>
                <span class="text-gray-700 font-medium">{{ $page->title }}</span>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 max-w-7xl py-4">
        <div class="flex flex-col lg:flex-row gap-6">

            <!-- LEFT COLUMN - Product Images (Featured Image) -->
            <div class="lg:w-2/5">
                <div class="bg-white border border-gray-200 rounded-md p-4 sticky top-20">

                    <!-- Main Image -->
                    @if($page->featured_image)
                    <div class="relative group">
                        <div class="flex items-center justify-center bg-white">
                            <img src="{{ asset('storage/'. $page->featured_image) }}"
                                 alt="{{ $page->title }}"
                                 class="max-w-full h-auto mx-auto object-contain max-h-[400px]">
                        </div>
                        <!-- Zoom Icon (Amazon style) -->
                        <div class="absolute bottom-4 right-4 bg-white rounded-full p-2 shadow-md border border-gray-200 opacity-0 group-hover:opacity-100 transition">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                        </div>
                    </div>
                    @endif


                </div>
            </div>

            <!-- MIDDLE COLUMN - Product Details -->
            <div class="lg:w-3/5">
                <div class="bg-white border border-gray-200 rounded-md p-6">

                    <!-- Title -->
                    <h1 class="text-2xl md:text-3xl font-normal text-[#0F1111] leading-tight mb-2">
                        {{ $page->title }}
                    </h1>

                    <!-- Brand / Short Description -->
                    @if($page->short_description)
                    <div class="text-sm text-[#007185] mb-3">
                        {{ $page->short_description }}
                    </div>
                    @endif


                    <!-- Main Description (Your existing $page->description) -->
                    <div class="mb-6">
                        <div class="text-sm text-gray-700 leading-relaxed">
                            {!! $page->description !!}
                        </div>
                    </div>


                </div>
            </div>

            <!-- RIGHT COLUMN - Purchase Box -->
            <div class="lg:w-80">
                <div class="bg-white border border-gray-200 rounded-md p-4 sticky top-20">

                    <!-- Price Box -->
                    <div class="mb-4">
                        <div class="text-xl font-bold text-[#B12704]">Free Quote</div>
                    </div>

                    <!-- Delivery Info -->
                    <div class="text-sm mb-4 pb-4 border-b border-gray-300">
                        <div class="text-[#067D62] font-medium mb-1">Available Now</div>

                        {{-- <div class="text-gray-600">Payment: Secure & encrypted</div> --}}
                    </div>

                    <!-- Single CTA Button - Get Free Quote -->
                    <div class="space-y-2">
                        <a href="{{ route('repair') }}" wire:navigate
                           class="block w-full text-center py-3 bg-[#FFD814] hover:bg-[#F7CA00] border border-[#FCD200] rounded-lg text-sm font-semibold text-[#0F1111] transition">
                            Get Free Quote
                        </a>
                    </div>

                    <!-- Secure Transaction Message -->
                    <div class="flex items-center justify-center gap-1 mt-4 text-xs text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        <span>100% free quote | No hidden charges</span>
                    </div>
                </div>
            </div>
        </div>


        <!-- Related Services Section - Dynamic Pages from device_repair category -->
        @php
            $services = \App\Models\Page::where('page_category', 'device_repair')->get();
        @endphp

        @if($services->count() > 0)
        <div class="mt-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-[#0F1111]">Other repair services you may like</h2>
                <a href="#" class="text-[#007185] text-sm hover:text-[#C7511F] hover:underline">View all services →</a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach($services as $service)
                <a href="{{ route('device-repair', ['slug' => $service->slug]) }}" wire:navigate
                   class="bg-white border border-gray-200 rounded-md p-3 hover:shadow-md hover:border-[#FF9900] transition group">
                    <div class="bg-gray-100 rounded-md mb-2 flex items-center justify-center overflow-hidden">
                        @if($service->featured_image)
                            <img src="{{ asset('storage/'. $service->featured_image) }}"
                                 alt="{{ $service->title }}"
                                 class="w-30 h-40 object-cover group-hover:scale-105 transition duration-300">
                        @else
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        @endif
                    </div>
                    <p class="text-xs text-[#007185] group-hover:text-[#C7511F] line-clamp-2 font-medium">
                        {{ $service->title }}
                    </p>
                    <p class="text-sm font-bold text-[#B12704] mt-1">Free Quote</p>
                </a>
                @endforeach
            </div>
        </div>
        @endif


    </div>

    <!-- Back to Top Button (Amazon style) -->
    <button onclick="window.scrollTo({top:0,behavior:'smooth'})"
            class="fixed bottom-8 right-8 bg-[#37475A] hover:bg-[#485769] text-white px-4 py-2 rounded-md text-sm transition shadow-lg opacity-0 focus:opacity-100"
            id="backToTopBtn">
        Back to top ↑
    </button>

    <style>
        /* Amazon Ember Font */
        @import url('https://fonts.cdnfonts.com/css/amazon-ember');

        body {
            font-family: 'Amazon Ember', 'Helvetica Neue', Arial, sans-serif;
        }

        /* Line clamp for related products */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Prose styling for content */
        .prose {
            color: #0F1111;
            line-height: 1.6;
            font-size: 0.875rem;
        }

        .prose h2 {
            font-size: 1.25rem;
            font-weight: bold;
            margin-top: 1.5em;
            margin-bottom: 0.5em;
            color: #0F1111;
        }

        .prose h3 {
            font-size: 1.125rem;
            font-weight: 600;
            margin-top: 1.25em;
            margin-bottom: 0.5em;
            color: #0F1111;
        }

        .prose p {
            margin-bottom: 1em;
        }

        .prose ul, .prose ol {
            list-style: disc;
            padding-left: 1.5em;
            margin: 1em 0;
        }

        .prose li {
            margin: 0.25em 0;
        }

        .prose a {
            color: #007185;
            text-decoration: none;
        }

        .prose a:hover {
            color: #C7511F;
            text-decoration: underline;
        }

        /* Sticky positioning */
        .sticky {
            position: sticky;
            top: 20px;
        }

        /* Back to top button visibility */
        #backToTopBtn {
            transition: opacity 0.3s ease;
        }
    </style>

    <script>
        // Show/hide back to top button on scroll
        window.addEventListener('scroll', function() {
            const btn = document.getElementById('backToTopBtn');
            if (window.scrollY > 300) {
                btn.style.opacity = '1';
            } else {
                btn.style.opacity = '0';
            }
        });
    </script>
</div>
