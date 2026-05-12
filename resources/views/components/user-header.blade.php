<!-- Header Start -->
<header class="bg-white shadow-sm z-50">
    <!-- Top Bar - Store Info & Currency/Lang/Account -->
    <div class="border-b border-gray-100 bg-[#5B9F01] hidden lg:block">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="flex items-center justify-between h-10 text-xs">
                <div class="text-white font-medium flex items-center gap-1">
                    <i class="fas fa-store mr-1 text-white"></i>
                    Welcome to Worldwide Electronics Store
                </div>
                <div class="flex items-center gap-5">
                    <a href="#" class="text-white transition"><i class="fas fa-map-marker-alt mr-1"></i> Store Locator</a>
                    <a href="#" class="text-white transition"><i class="fas fa-truck mr-1"></i> Track Your Order</a>
                    <div class="relative">
                        <button class="currency-btn text-white transition flex items-center gap-1">
                            <i class="fas fa-dollar-sign mr-1"></i> Dollar (US) <i class="fas fa-chevron-down text-[9px]"></i>
                        </button>
                        <div class="currency-dropdown absolute right-0 mt-2 w-36 bg-white border border-gray-200 rounded-lg shadow-lg hidden z-50">
                            <a href="#" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-50">Dollar (US)</a>
                            <a href="#" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-50">Euro (EUR)</a>
                            <a href="#" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-50">Pound (GBP)</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header Area - Mobile optimized -->
    <div class="container mx-auto px-4 max-w-7xl py-4">
        <!-- Desktop Layout (lg and above) -->
        <div class="hidden lg:flex lg:flex-row lg:items-center lg:gap-4 lg:gap-6">
            <!-- Logo -->
            <div class="flex items-center justify-between w-full lg:w-auto">
                <a href="#" class="flex items-center gap-2">
                    <img src="{{asset('assets/images/logo/green-jack-logo-header.png')}}" alt="Logo" class="h-10 md:h-auto">
                </a>
            </div>

            <!-- Contact Information Cards - Desktop only -->
            <div class="grid grid-cols-3 gap-4 flex-1">
                <!-- Address Card -->
                <div class="contact-card group relative overflow-hidden bg-gradient-to-br from-gray-50 to-white rounded-2xl p-3 border border-gray-100 hover:border-[#5B9F01]/30 transition-all duration-300 hover:shadow-lg">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-[#5B9F01]/5 rounded-full -mr-10 -mt-10 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="flex items-start gap-3 relative z-10">
                        <div class="icon-wrapper bg-gradient-to-br from-[#5B9F01] to-[#4a7f01] w-10 h-10 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-map-marker-alt text-white text-lg"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Visit Us</p>
                            <p class="text-sm font-semibold text-gray-800">123 Electronics Blvd, Tech City, TC 90210</p>
                        </div>
                    </div>
                </div>

                <!-- Email Card -->
                <div class="contact-card group relative overflow-hidden bg-gradient-to-br from-gray-50 to-white rounded-2xl p-3 border border-gray-100 hover:border-[#5B9F01]/30 transition-all duration-300 hover:shadow-lg">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-[#5B9F01]/5 rounded-full -mr-10 -mt-10 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="flex items-start gap-3 relative z-10">
                        <div class="icon-wrapper bg-gradient-to-br from-[#5B9F01] to-[#4a7f01] w-10 h-10 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-envelope text-white text-lg"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Email Us</p>
                            <p class="text-sm font-semibold text-gray-800">support@electronics.com</p>
                            <p class="text-xs text-gray-500">24/7 Support</p>
                        </div>
                    </div>
                </div>

                <!-- Phone Card -->
                <div class="contact-card group relative overflow-hidden bg-gradient-to-br from-gray-50 to-white rounded-2xl p-3 border border-gray-100 hover:border-[#5B9F01]/30 transition-all duration-300 hover:shadow-lg">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-[#5B9F01]/5 rounded-full -mr-10 -mt-10 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="flex items-start gap-3 relative z-10">
                        <div class="icon-wrapper bg-gradient-to-br from-[#5B9F01] to-[#4a7f01] w-10 h-10 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-phone-alt text-white text-lg"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Call Us</p>
                            <p class="text-sm font-semibold text-gray-800">+1 (555) 123-4567</p>
                            <p class="text-xs text-gray-500">Mon-Fri 9am-6pm</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Layout (below lg) -->
        <div class="lg:hidden">
            <div class="flex items-center justify-between w-full">
                <button id="mobileMenuBtn" class="text-gray-700 text-2xl hover:text-[#5B9F01] transition">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="#" class="flex items-center gap-2">
                    <img src="{{asset('assets/images/logo/green-jack-logo-header.png')}}" alt="Logo" class="h-10">
                </a>
                <div></div>
            </div>
        </div>
    </div>

    <!-- Navigation Menu - Sticky on scroll -->
    <div class="menu-container border-t border-gray-200 bg-white w-full">
        <div class="container mx-auto px-4 max-w-7xl">
            <!-- Desktop Menu -->
            <div class="hidden lg:flex lg:flex-wrap lg:items-center lg:justify-between">
                <div class="flex items-center flex-wrap">
                    <a href="{{ route('home') }}" wire:navigate class="py-3 px-5 text-gray-700 font-semibold hover:text-[#5B9F01] border-b-2 border-transparent hover:border-[#5B9F01] transition whitespace-nowrap">Home</a>

                    <div class="relative repair-menu">
                        <button class="repair-btn py-3 px-5 text-gray-700 font-semibold hover:text-[#5B9F01] border-b-2 border-transparent hover:border-[#5B9F01] transition flex items-center gap-1 whitespace-nowrap">
                            Device Repair <i class="fas fa-chevron-down text-[10px] ml-1"></i>
                        </button>
                        <div class="repair-submenu absolute left-0 top-full mt-0 w-64 bg-white shadow-xl border border-gray-100 rounded-lg hidden z-50">
                            <div class="py-2">
                                @php
                                    $pages = \App\Models\Page::where('page_category', 'device_repair')->get();
                                @endphp
                                @foreach($pages as $page)
                                <a href="{{ route('device-repair', ['slug' => $page->slug]) }}" wire:navigate class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#5B9F01] whitespace-nowrap">{{$page->title}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <a href="{{route('shop')}}" wire:navigate class="py-3 px-5 text-gray-700 font-semibold hover:text-[#5B9F01] border-b-2 border-transparent hover:border-[#5B9F01] transition whitespace-nowrap">Shop</a>

                    <div class="relative repair-menu">
                        <button class="repair-btn py-3 px-5 text-gray-700 font-semibold hover:text-[#5B9F01] border-b-2 border-transparent hover:border-[#5B9F01] transition flex items-center gap-1 whitespace-nowrap">
                           Printing & Marketing <i class="fas fa-chevron-down text-[10px] ml-1"></i>
                        </button>
                        <div class="repair-submenu absolute left-0 top-full mt-0 w-64 bg-white shadow-xl border border-gray-100 rounded-lg hidden z-50">
                            <div class="py-2">
                                <a href="{{route('printing')}}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#5B9F01] whitespace-nowrap">Document Printing</a>
                                <a href="{{route('printing')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#5B9F01] whitespace-nowrap">Business Cards</a>
                                <a href="{{route('printing')}}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#5B9F01] whitespace-nowrap">Signs, Banners, & Posters</a>
                                <a href="{{route('printing')}}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#5B9F01] whitespace-nowrap">Marketing Materials</a>
                                <a href="{{route('printing')}}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#5B9F01] whitespace-nowrap">Cards & Invitations</a>
                                <a href="{{route('printing')}}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#5B9F01] whitespace-nowrap">Label & Stickers</a>
                                <a href="{{route('printing')}}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#5B9F01] whitespace-nowrap">Envelope & Stationery</a>
                                <a href="{{route('printing')}}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#5B9F01] whitespace-nowrap">Photo Gifts</a>
                                <a href="{{route('printing')}}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#5B9F01] whitespace-nowrap">Business Solutions</a>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="py-3 px-5 text-gray-600 hover:text-[#5B9F01] font-semibold transition whitespace-nowrap">Finance</a>
                    <a href="{{ route('contact-us') }}" wire:navigate class="py-3 px-5 text-gray-600 hover:text-[#5B9F01] font-semibold transition whitespace-nowrap">Contact Us</a>

                      <a href="{{ route('blogs') }}" wire:navigate class="py-3 px-5 text-gray-600 hover:text-[#5B9F01] font-semibold transition whitespace-nowrap">Blog</a>
                </div>

                <span class="hidden lg:inline-block text-sm text-gray-500 py-3 whitespace-nowrap"><i class="fas fa-truck"></i> Free Shipping on Orders $50+</span>
            </div>
            <!-- Mobile Menu Toggle - Shows only on mobile -->
            <div class="lg:hidden py-3">
                <button id="mobileMenuToggle" class="flex items-center justify-between w-full text-gray-700 font-semibold">
                    <span>Menu</span>
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>
            </div>

        </div>
    </div>
</header>

<!-- Mobile Sidebar Menu -->
<div id="mobileSidebar" class="fixed top-0 left-0 h-full w-80 bg-white z-[9999] shadow-2xl transform -translate-x-full transition-transform duration-300 overflow-y-auto">
    <div class="p-4 border-b border-gray-200 flex justify-between items-center">
        <div>
            <img src="{{asset('assets/images/logo/green-jack-logo-header.png')}}" alt="Logo" class="h-10">
        </div>
        <button id="closeSidebar" class="text-gray-500 text-2xl hover:text-gray-700">&times;</button>
    </div>

    <!-- Navigation Links -->
    <div class="p-4">
        <a href="{{ route('home') }}" wire:navigate class="block py-3 text-gray-700 border-b border-gray-200 font-semibold hover:text-[#5B9F01]">Home</a>

        <div class="border-b border-gray-200 ">
            <button id="repairMobileBtn" class="flex justify-between items-center w-full py-3 text-gray-700 font-semibold hover:text-[#5B9F01]">
                Device Repair <i class="fas fa-chevron-down text-xs transition-transform"></i>
            </button>
            <div id="repairMobileSubmenu" class="hidden pl-4 pb-3 space-y-2">
                @php
                    $pages = \App\Models\Page::where('page_category', 'device_repair')->get();
                @endphp
                @foreach($pages as $page)
                <a href="{{ route('device-repair', ['slug' => $page->slug]) }}" wire:navigate class="block py-2 text-sm text-gray-600 hover:text-[#5B9F01]">{{$page->title}}</a>
                @endforeach
            </div>
        </div>

        <a href="{{route('shop')}}" wire:navigate class="block py-3 text-gray-700 border-b border-gray-200  font-semibold hover:text-[#5B9F01]">Shop</a>

        <div class="border-b border-gray-200 ">
            <button id="printingMobileBtn" class="flex justify-between items-center w-full py-3 text-gray-700 font-semibold hover:text-[#5B9F01]">
                Printing & Marketing <i class="fas fa-chevron-down text-xs transition-transform"></i>
            </button>
            <div id="printingMobileSubmenu" class="hidden pl-4 pb-3 space-y-2">
                <a href="{{route('printing')}}" wire:navigate class="block py-2 text-sm text-gray-600 hover:text-[#5B9F01]">Document Printing</a>
                <a href="{{route('printing')}}" class="block py-2 text-sm text-gray-600 hover:text-[#5B9F01]">Business Cards</a>
                <a href="{{route('printing')}}" wire:navigate class="block py-2 text-sm text-gray-600 hover:text-[#5B9F01]">Signs, Banners, & Posters</a>
                <a href="{{route('printing')}}" wire:navigate class="block py-2 text-sm text-gray-600 hover:text-[#5B9F01]">Marketing Materials</a>
                <a href="{{route('printing')}}" wire:navigate class="block py-2 text-sm text-gray-600 hover:text-[#5B9F01]">Cards & Invitations</a>
                <a href="{{route('printing')}}" wire:navigate class="block py-2 text-sm text-gray-600 hover:text-[#5B9F01]">Label & Stickers</a>
                <a href="{{route('printing')}}" wire:navigate class="block py-2 text-sm text-gray-600 hover:text-[#5B9F01]">Envelope & Stationery</a>
                <a href="{{route('printing')}}" wire:navigate class="block py-2 text-sm text-gray-600 hover:text-[#5B9F01]">Photo Gifts</a>
                <a href="{{route('printing')}}" wire:navigate class="block py-2 text-sm text-gray-600 hover:text-[#5B9F01]">Business Solutions</a>
            </div>
        </div>

        <a href="#" class="block py-3 text-gray-600 border-b border-gray-200  hover:text-[#5B9F01]">Finance</a>
        <a href="{{ route('contact-us') }}" wire:navigate class="block py-3 text-gray-600 border-b border-gray-200 hover:text-[#5B9F01]">Contact Us</a>
 <a href="{{ route('blogs') }}" wire:navigate class="block py-3 text-gray-600 border-b border-gray-200 font-semibold hover:text-[#5B9F01]">Blog</a>
        <!-- CTA Button -->
        <div class="mt-6 pt-4 border-t border-gray-200 ">
            <a href="#" class="block w-full text-center bg-[#5B9F01] text-white py-3 rounded-lg font-semibold hover:bg-[#4a7f01] transition">
                BOOK YOUR SERVICE TODAY!
            </a>
        </div>

        <div class="pt-4 mt-2 space-y-2">
            <a href="#" class="block py-2 text-sm text-gray-600 hover:text-[#5B9F01]"><i class="fas fa-map-marker-alt mr-2"></i> Store Locator</a>
            <a href="#" class="block py-2 text-sm text-gray-600 hover:text-[#5B9F01]"><i class="fas fa-truck mr-2"></i> Track Your Order</a>
            <a href="#" class="block py-2 text-sm text-gray-600 hover:text-[#5B9F01]"><i class="fas fa-user mr-2"></i> Register or Sign in</a>
        </div>
    </div>

    <!-- Contact Details -->
    <div class="p-4 bg-gradient-to-r from-[#5B9F01]/10 to-transparent border-b border-gray-200">
        <div class="space-y-4">
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 bg-[#5B9F01] rounded-lg flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-map-marker-alt text-white text-sm"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider">Visit Us</p>
                    <p class="text-sm font-medium text-gray-800">123 Electronics Blvd, Tech City, TC 90210</p>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 bg-[#5B9F01] rounded-lg flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-envelope text-white text-sm"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider">Email Us</p>
                    <p class="text-sm font-medium text-gray-800">support@electronics.com</p>
                    <p class="text-xs text-gray-500">24/7 Support</p>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 bg-[#5B9F01] rounded-lg flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-phone-alt text-white text-sm"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider">Call Us</p>
                    <p class="text-sm font-medium text-gray-800">+1 (555) 123-4567</p>
                    <p class="text-xs text-gray-500">Mon-Fri 9am-6pm</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="overlay" class="fixed inset-0 bg-black/50 z-[9998] hidden"></div>

<!-- jQuery and Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function() {
    // Desktop Repair Submenu - Hover
    $('.repair-menu').on('mouseenter', function(e) {
        $(this).find('.repair-submenu').stop(true, true).show();
    });
    $('.repair-menu').on('mouseleave', function(e) {
        $(this).find('.repair-submenu').stop(true, true).hide();
    });

    // Currency Dropdown
    $('.currency-btn').click(function(e) {
        e.stopPropagation();
        $('.currency-dropdown').toggle();
    });
    $(document).click(function() { $('.currency-dropdown').hide(); });
    $('.currency-dropdown').click(function(e) { e.stopPropagation(); });

    // Mobile Menu Sidebar
    $('#mobileMenuBtn, #mobileMenuToggle').click(function() {
        $('#mobileSidebar').addClass('translate-x-0').removeClass('-translate-x-full');
        $('#overlay').removeClass('hidden');
        $('body').css('overflow', 'hidden');
    });

    $('#closeSidebar, #overlay').click(function() {
        $('#mobileSidebar').addClass('-translate-x-full').removeClass('translate-x-0');
        $('#overlay').addClass('hidden');
        $('body').css('overflow', '');
    });

    // Mobile Submenu Toggles
    $('#repairMobileBtn').click(function() {
        $('#repairMobileSubmenu').slideToggle(200);
        $(this).find('i').toggleClass('rotate-180');
    });

    $('#printingMobileBtn').click(function() {
        $('#printingMobileSubmenu').slideToggle(200);
        $(this).find('i').toggleClass('rotate-180');
    });

    // Sticky Menu on Scroll
    var menuContainer = $('.menu-container');
    var header = $('header');
    var menuOffset = menuContainer.offset().top;

    $(window).on('scroll', function() {
        var scrollPos = $(window).scrollTop();

        if (scrollPos >= menuOffset) {
            menuContainer.addClass('fixed-menu');
            $('body').css('padding-top', menuContainer.outerHeight() + 'px');
        } else {
            menuContainer.removeClass('fixed-menu');
            $('body').css('padding-top', '0');
        }
    });
});
</script>

<style>
    .rotate-180 { transform: rotate(180deg); }
    .repair-submenu, .cart-dropdown, .currency-dropdown, #categoryDropdown {
        position: absolute;
        z-index: 9999;
    }
    .repair-menu {
        position: relative;
    }
    .repair-submenu {
        position: absolute;
        left: 0;
        top: 100%;
        min-width: 240px;
    }

    /* Contact Card Animations */
    .contact-card {
        transition: all 0.3s ease;
    }

    .contact-card:hover .icon-wrapper {
        transform: scale(1.1);
    }

    @keyframes subtlePulse {
        0%, 100% { opacity: 0.05; }
        50% { opacity: 0.1; }
    }

    .contact-card .absolute {
        animation: subtlePulse 3s ease-in-out infinite;
    }

    /* Fixed Menu Styles */
    .fixed-menu {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background: white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        z-index: 999;
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            transform: translateY(-100%);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* Mobile Responsive */
    @media (max-width: 1023px) {
        .fixed-menu {
            position: fixed;
            top: 0;
        }
    }

    @media (max-width: 768px) {
        button, .repair-btn, #mobileMenuToggle {
            cursor: pointer;
            -webkit-tap-highlight-color: transparent;
        }

        #mobileSidebar {
            -webkit-overflow-scrolling: touch;
        }
    }
</style>
