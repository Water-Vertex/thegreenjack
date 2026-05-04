<!-- Header Start -->
<header class="bg-white shadow-sm sticky top-0 z-50">
    <!-- Top Bar - Minimal with only essentials -->
    <div class="border-b border-gray-100 bg-[#00349a] hidden lg:block">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="flex items-center justify-between h-8 text-xs">
                <div class="text-white flex items-center gap-4">
                    <span><i class="fas fa-check-circle text-[#5B9F01] mr-1 text-white"></i> Free Shipping on Orders $50+ </span>
                    <span><i class="far fa-clock text-[#5B9F01] mr-1 text-white"></i> 30-Day Returns</span>
                    <span><i class="fas fa-shield-alt text-[#5B9F01] mr-1 text-white"></i> Secure Checkout</span>
                </div>
                <div class="flex items-center gap-4">
                    <a href="#" class="text-white transition"><i class="fas fa-store mr-1"></i> Store Locator</a>
                    <a href="#" class="text-white transition"><i class="fas fa-headset mr-1"></i> Support</a>
                    <div class="relative">
                        <button class="currency-btn text-white transition flex items-center gap-1">
                            <i class="fas fa-dollar-sign mr-1"></i> USD <i class="fas fa-chevron-down text-[9px]"></i>
                        </button>
                        <div class="currency-dropdown absolute right-0 mt-2 w-32 bg-white border border-gray-200 rounded-lg shadow-lg hidden z-50">
                            <a href="#" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-50">USD - Dollar</a>
                            <a href="#" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-50">EUR - Euro</a>
                            <a href="#" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-50">GBP - Pound</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header - Desktop -->
    <div class="container mx-auto px-4 max-w-7xl py-3">
        <!-- Desktop Layout -->
        <div class="hidden lg:flex lg:flex-row lg:items-center lg:gap-3">
            <!-- Logo -->
            <div class="flex items-center justify-between w-full md:w-auto">
                <a href="#" class="flex items-center gap-2">
                    <img src="{{asset('assets/images/logo/green-jack-logo-header.png')}}" alt="Logo" class="h-20 md:h-20">
                </a>
            </div>

            <!-- Search Bar -->
            <div class="flex-1 w-full">
                <div class="flex w-full">
                    <!-- Category Dropdown -->
                    <div class="relative">
                        <button id="categoryDropdownBtn" class="flex items-center gap-2 px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-l-lg border-r-0 text-sm font-medium text-gray-700 hover:bg-gray-100 transition">
                            All Categories <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div id="categoryDropdownMenu" class="hidden absolute top-full left-0 mt-1 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                            <ul class="py-1 text-sm">
                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-50 transition">All Categories</a></li>
                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-50 transition">Cables & Connectors</a></li>
                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-50 transition">Chargers</a></li>
                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-50 transition">Audio</a></li>
                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-50 transition">Power Banks</a></li>
                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-50 transition">Accessories</a></li>
                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-50 transition">Smart Home</a></li>
                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-50 transition">Mobile Phones</a></li>
                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-50 transition">Laptops</a></li>
                                <li><a href="#" class="block px-4 py-2 hover:bg-gray-50 transition">Tablets</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Search Input -->
                    <div class="relative flex-1">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input type="text" placeholder="Search products..." class="w-full pl-10 pr-4 py-2.5 border border-gray-300 focus:outline-none focus:border-[#5B9F01] text-sm">
                    </div>

                    <!-- Search Button -->
                    <button class="bg-[#00349A] text-white px-6 rounded-r-lg hover:bg-[#4a7f01] transition text-sm font-medium">Search</button>
                </div>
            </div>

            <!-- Header Icons -->
            <div class="flex items-center gap-4">
                <a href="#" class="hidden md:flex flex-col items-center text-gray-600 hover:text-[#5B9F01] transition">
                    <i class="far fa-heart text-xl"></i>
                    <span class="text-[10px] mt-0.5">Wishlist</span>
                </a>
                <a href="#" class="hidden md:flex flex-col items-center text-gray-600 hover:text-[#5B9F01] transition">
                    <i class="far fa-user text-xl"></i>
                    <span class="text-[10px] mt-0.5">Account</span>
                </a>
                @livewire('user.cart-icon')
            </div>
        </div>

        <!-- Mobile Layout -->
        <div class="lg:hidden">
            <div class="flex items-center justify-between w-full">
                <button id="mobileMenuBtn" class="text-gray-700 text-2xl hover:text-[#5B9F01] transition">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="#" class="flex items-center gap-2">
                    <img src="{{asset('assets/images/logo/green-jack-logo-header.png')}}" alt="Logo" class="h-12">
                </a>
                <div class="flex items-center gap-3">
                    <a href="#" class="text-gray-600 hover:text-[#5B9F01] transition">
                        <i class="far fa-heart text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-600 hover:text-[#5B9F01] transition">
                        <i class="far fa-user text-xl"></i>
                    </a>
                    @livewire('user.cart-icon')
                </div>
            </div>
            <div class="flex w-full mt-3">
                <div class="relative flex-1">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="text" placeholder="Search products..." class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-l-lg focus:outline-none focus:border-[#5B9F01] text-sm">
                </div>
                <button class="bg-[#5B9F01] text-white px-4 rounded-r-lg hover:bg-[#4a7f01] transition text-sm font-medium">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>
    <!-- Simple Desktop Navigation (for lg/xl without mega menu) -->
    <div class="border-y border-gray-100 bg-white w-full lg:block xl:hidden">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="flex items-center justify-between">
                <nav class="flex items-center space-x-6">
                    <a href="#" class="py-3 text-gray-700 font-medium hover:text-[#5B9F01] transition text-sm">Home</a>
                    <a href="#" class="py-3 text-gray-700 font-medium hover:text-[#5B9F01] transition text-sm">Shop</a>
                    <a href="#" class="py-3 text-gray-700 font-medium hover:text-[#5B9F01] transition text-sm">Contact</a>
                </nav>
                <div class="flex items-center gap-4 text-xs text-gray-500">
                    <span><i class="fas fa-truck text-[#5B9F01]"></i> Fast Delivery</span>
                    <span><i class="fas fa-lock text-[#5B9F01]"></i> Secure Payment</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Sidebar Menu -->
<div id="mobileSidebar" class="fixed top-0 left-0 h-full w-80 max-w-[85%] bg-white z-[9999] shadow-2xl transform -translate-x-full transition-transform duration-300 overflow-y-auto">
    <div class="p-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
        <div>
            <img src="{{asset('assets/images/logo/green-jack-logo-header.png')}}" alt="Logo" class="h-10 md:h-10">
        </div>
        <button id="closeSidebar" class="text-gray-500 text-2xl hover:text-gray-700">&times;</button>
    </div>
    <div class="p-4 border-b border-gray-200">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center">
                <i class="fas fa-user text-gray-500"></i>
            </div>
            <div>
                <p class="text-sm font-medium">Welcome Guest</p>
                <a href="#" class="text-xs text-[#5B9F01]">Sign in / Register</a>
            </div>
        </div>
    </div>
    <div class="p-4">
        <a href="#" class="flex items-center gap-3 py-3 text-gray-700 border-b border-gray-200 hover:text-[#5B9F01] transition">
            <i class="fas fa-home w-5 text-gray-400"></i>
            <span>Home</span>
        </a>
        <a href="#" class="flex items-center gap-3 py-3 text-gray-700 border-b border-gray-200 hover:text-[#5B9F01] transition">
            <i class="fas fa-store w-5 text-gray-400"></i>
            <span>Shop</span>
        </a>
        <a href="#" class="flex items-center gap-3 py-3 text-gray-700 border-b border-gray-200 hover:text-[#5B9F01] transition">
            <i class="fas fa-headset w-5 text-gray-400"></i>
            <span>Contact Support</span>
        </a>
    </div>
    <div class="p-4 bg-gray-50 mt-4">
        <p class="text-xs font-semibold text-gray-500 mb-2">CONTACT INFO</p>
        <div class="space-y-2">
            <a href="tel:+15551234567" class="flex items-center gap-2 text-sm text-gray-600 hover:text-[#5B9F01] transition">
                <i class="fas fa-phone-alt text-[#5B9F01] text-xs"></i>
                +1 (555) 123-4567
            </a>
            <a href="mailto:support@electronics.com" class="flex items-center gap-2 text-sm text-gray-600 hover:text-[#5B9F01] transition">
                <i class="fas fa-envelope text-[#5B9F01] text-xs"></i>
                support@electronics.com
            </a>
        </div>
    </div>
</div>

<div id="overlay" class="fixed inset-0 bg-black/50 z-[9998] hidden"></div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    // Category dropdown
    const dropdownBtn = document.getElementById('categoryDropdownBtn');
    const dropdownMenu = document.getElementById('categoryDropdownMenu');
    if (dropdownBtn && dropdownMenu) {
        dropdownBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdownMenu.classList.toggle('hidden');
        });
        document.addEventListener('click', (e) => {
            if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
        const categoryLinks = dropdownMenu.querySelectorAll('a');
        categoryLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                dropdownBtn.innerHTML = `${link.textContent} <i class="fas fa-chevron-down text-xs"></i>`;
                dropdownMenu.classList.add('hidden');
            });
        });
    }

    // All Departments toggle
    const toggleBtn = document.getElementById('allDepartmentsBtn');
    const menu = document.getElementById('allDepartmentsMenu');
    if (toggleBtn && menu) {
        toggleBtn.addEventListener('click', function() {
            menu.classList.toggle('hidden');
        });
    }

    // Currency dropdown
    $(document).ready(function() {
        $('.currency-btn').click(function(e) {
            e.stopPropagation();
            $('.currency-dropdown').toggle();
        });
        $(document).click(function() { $('.currency-dropdown').hide(); });
        $('.currency-dropdown').click(function(e) { e.stopPropagation(); });

        // Mobile Menu Sidebar
        $('#mobileMenuBtn').click(function() {
            $('#mobileSidebar').addClass('translate-x-0').removeClass('-translate-x-full');
            $('#overlay').removeClass('hidden');
            $('body').css('overflow', 'hidden');
        });

        $('#closeSidebar, #overlay').click(function() {
            $('#mobileSidebar').addClass('-translate-x-full').removeClass('translate-x-0');
            $('#overlay').addClass('hidden');
            $('body').css('overflow', '');
        });
    });
</script>

<style>
    .rotate-180 { transform: rotate(180deg); }
    #mobileSidebar { width: 85%; max-width: 340px; }
    @media (max-width: 768px) {
        button, a { cursor: pointer; -webkit-tap-highlight-color: transparent; }
    }
</style>
