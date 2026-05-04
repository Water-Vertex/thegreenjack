<div>

    
   <!-- Hero Banner - Stronger Blur Effect -->
<section class="relative h-[400px] md:h-[500px] flex items-center overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0">
        <img src="{{asset('assets/images/logo/background.jpg')}}" alt="Background" class="w-full h-full object-cover">
        <!-- Multiple Blur Layers -->
        {{-- <div class="absolute inset-0 backdrop-blur-xl bg-black/60"></div> --}}
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-transparent"></div>
        <!-- Additional Frosted Glass Effect -->
        <div class="absolute inset-0 bg-white/5"></div>
    </div>

    <!-- Content -->
    <div class="container mx-auto px-4 max-w-7xl relative z-10 w-full">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-12">

            <!-- Text Content with Glass Card -->
            <div class="flex-1 text-center lg:text-left">
                <div class="inline-block lg:block mb-5">
                    <span class="backdrop-blur-md bg-[#5B9F01]/20 text-[#5B9F01] font-bold text-sm uppercase tracking-wider px-4 py-2 rounded-full inline-flex items-center gap-2 border border-[#5B9F01]/30">
                        <span class="w-2 h-2 bg-[#5B9F01] rounded-full animate-pulse"></span>
                        Book your service today!
                    </span>
                </div>

                <h1 class="text-white text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-extrabold leading-tight mb-5 drop-shadow-2xl">
                    We repair
                    <span class="block text-2xl md:text-3xl lg:text-4xl mt-3 text-transparent bg-clip-text bg-gradient-to-r from-[#5B9F01] to-[#8BC34A]">
                        iPhones, iPads, Tablets, Computers,<br>
                        iMacs, Android Phones, and much more.
                    </span>
                </h1>

                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="#" class="bg-[#5B9F01] hover:bg-[#4a7f01] text-white font-semibold px-8 py-3.5 rounded-full transition duration-300 inline-flex items-center justify-center gap-2 shadow-lg shadow-black/40">
                        Discover More <i class="fas fa-arrow-right"></i>
                    </a>
                    <a href="#" class="backdrop-blur-md bg-white/10 hover:bg-white/20 border border-white/30 text-white font-semibold px-8 py-3.5 rounded-full transition duration-300 inline-flex items-center justify-center gap-2">
                        <i class="fas fa-phone"></i> Contact Us
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Brands Section - Light Mode Card Style with Auto Scroll -->
<section class="py-16 bg-white overflow-hidden">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <span class="text-[#5B9F01] font-bold text-sm uppercase tracking-wider bg-[#5B9F01]/10 px-4 py-1.5 rounded-full inline-block mb-4">OUR TRUSTED PARTNER</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800">
                The Brands we work with <br>
                and believe in...
            </h2>
            <div class="w-20 h-1 bg-[#5B9F01] mx-auto mt-4 rounded-full"></div>
        </div>

        <!-- Auto Scrolling Container -->
        <div class="relative">
            <!-- Soft Edge Fade (Light Mode) -->
            <div class="absolute left-0 top-0 bottom-0 w-32 bg-gradient-to-r from-white to-transparent z-10 pointer-events-none"></div>
            <div class="absolute right-0 top-0 bottom-0 w-32 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none"></div>

            <div class="overflow-hidden py-4">
                <div class="brand-track flex items-center gap-8 animate-scroll-slow hover:animate-pause">
                    <!-- Brand Cards -->
                    <div class="brand-card bg-white shadow-md rounded-xl px-6 py-4 flex items-center justify-center min-w-[140px] hover:shadow-lg transition-shadow duration-300 border border-gray-100">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/b/b8/Lenovo_logo_2015.svg" alt="Lenovo" class="h-10 w-auto object-contain  transition duration-300">
                    </div>
                    <div class="brand-card bg-white shadow-md rounded-xl px-6 py-4 flex items-center justify-center min-w-[140px] hover:shadow-lg transition-shadow duration-300 border border-gray-100">
                        <img src="{{asset('assets/images/brands/sony.png')}}" alt="Sony" class="h-10 w-auto object-contain  transition duration-300">
                    </div>
                    <div class="brand-card bg-white shadow-md rounded-xl px-6 py-4 flex items-center justify-center min-w-[140px] hover:shadow-lg transition-shadow duration-300 border border-gray-100">
                        <img src="{{asset('assets/images/brands/samsung.png')}}" alt="Samsung" class="h-10 w-auto  transition duration-300">
                    </div>
                    <div class="brand-card bg-white shadow-md rounded-xl px-6 py-4 flex items-center justify-center min-w-[140px] hover:shadow-lg transition-shadow duration-300 border border-gray-100">
                        <img src="{{asset('assets/images/brands/apple.png')}}" alt="Apple" class="h-10 w-auto object-contain  transition duration-300">
                    </div>
                    <div class="brand-card bg-white shadow-md rounded-xl px-6 py-4 flex items-center justify-center min-w-[140px] hover:shadow-lg transition-shadow duration-300 border border-gray-100">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/1/18/Dell_logo_2016.svg" alt="Dell" class="h-10 w-auto object-contain  transition duration-300">
                    </div>
                    <div class="brand-card bg-white shadow-md rounded-xl px-6 py-4 flex items-center justify-center min-w-[140px] hover:shadow-lg transition-shadow duration-300 border border-gray-100">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/a/ad/HP_logo_2012.svg" alt="HP" class="h-10 w-auto object-contain  transition duration-300">
                    </div>


                    <!-- Duplicate for seamless loop -->
                    <div class="brand-card bg-white shadow-md rounded-xl px-6 py-4 flex items-center justify-center min-w-[140px] hover:shadow-lg transition-shadow duration-300 border border-gray-100">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/b/b8/Lenovo_logo_2015.svg" alt="Lenovo" class="h-10 w-auto object-contain  transition duration-300">
                    </div>
                    <div class="brand-card bg-white shadow-md rounded-xl px-6 py-4 flex items-center justify-center min-w-[140px] hover:shadow-lg transition-shadow duration-300 border border-gray-100">
                        <img src="{{asset('assets/images/brands/sony.png')}}" alt="Sony" class="h-10 w-auto object-contain  transition duration-300">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    @keyframes scrollSlow {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }

    .animate-scroll-slow {
        animation: scrollSlow 25s linear infinite;
        width: max-content;
    }

    .hover\:animate-pause:hover {
        animation-play-state: paused;
    }

    .brand-card {
        transition: all 0.3s ease;
    }

    .brand-card:hover {
        transform: translateY(-2px);
    }
</style>

<!-- Our Services Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center gap-2 bg-[#5B9F01]/10 px-4 py-1.5 rounded-full mb-4">
                <span class="w-2 h-2 bg-[#5B9F01] rounded-full animate-pulse"></span>
                <span class="text-[#5B9F01] font-semibold text-sm uppercase tracking-wider">Our Services</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800">See Our Services</h2>
            <div class="w-20 h-1 bg-[#5B9F01] mx-auto mt-4 rounded-full"></div>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Service Card 1 - Repair -->
            <div class="service-card group bg-white rounded-2xl p-6 text-center shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                <div class="service-icon mb-5">
                    <div class="w-20 h-20 bg-[#5B9F01]/10 rounded-2xl flex items-center justify-center mx-auto group-hover:bg-[#5B9F01] transition-colors duration-300">
                        <img src="http://technician.watervertex.com/wp-content/uploads/2026/03/Untitled-design-1.png" alt="Repair Icon" class="w-12 h-12 object-contain group-hover:brightness-0 group-hover:invert transition duration-300">
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">
                    <a href="#" class="hover:text-[#5B9F01] transition">Repair</a>
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    When you need fast repairs for your iPhone, iPad, tablet, computer, game console, or any other device, trust the experts at The Green Jack.
                </p>
                <div class="mt-4">
                    <a href="#" class="inline-flex items-center gap-1 text-[#5B9F01] text-sm font-medium hover:gap-2 transition-all">
                        Learn More <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Service Card 2 - Buy a Devices -->
            <div class="service-card group bg-white rounded-2xl p-6 text-center shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                <div class="service-icon mb-5">
                    <div class="w-20 h-20 bg-[#5B9F01]/10 rounded-2xl flex items-center justify-center mx-auto group-hover:bg-[#5B9F01] transition-colors duration-300">
                        <img src="http://technician.watervertex.com/wp-content/uploads/2026/03/Untitled-design-3.png" alt="Buy Devices Icon" class="w-12 h-12 object-contain group-hover:brightness-0 group-hover:invert transition duration-300">
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">
                    <a href="#" class="hover:text-[#5B9F01] transition">Buy a Devices</a>
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    At The Green Jack, get the latest pre-owned devices without paying premium prices—iPhones, iPads, tablets, Samsung Galaxy devices.
                </p>
                <div class="mt-4">
                    <a href="#" class="inline-flex items-center gap-1 text-[#5B9F01] text-sm font-medium hover:gap-2 transition-all">
                        Learn More <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Service Card 3 - Trade & Sell -->
            <div class="service-card group bg-white rounded-2xl p-6 text-center shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                <div class="service-icon mb-5">
                    <div class="w-20 h-20 bg-[#5B9F01]/10 rounded-2xl flex items-center justify-center mx-auto group-hover:bg-[#5B9F01] transition-colors duration-300">
                        <img src="http://technician.watervertex.com/wp-content/uploads/2026/03/Untitled-design-4.png" alt="Trade & Sell Icon" class="w-12 h-12 object-contain group-hover:brightness-0 group-hover:invert transition duration-300">
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">
                    <a href="#" class="hover:text-[#5B9F01] transition">Trade & Sell</a>
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Let The Green Jack turn your old or damaged phone into cash and help you find a device you'll love. You've got options—sell or trade!
                </p>
                <div class="mt-4">
                    <a href="#" class="inline-flex items-center gap-1 text-[#5B9F01] text-sm font-medium hover:gap-2 transition-all">
                        Learn More <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Service Card 4 - Finance -->
            <div class="service-card group bg-white rounded-2xl p-6 text-center shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                <div class="service-icon mb-5">
                    <div class="w-20 h-20 bg-[#5B9F01]/10 rounded-2xl flex items-center justify-center mx-auto group-hover:bg-[#5B9F01] transition-colors duration-300">
                        <img src="http://technician.watervertex.com/wp-content/uploads/2026/03/Untitled-design.png" alt="Finance Icon" class="w-12 h-12 object-contain group-hover:brightness-0 group-hover:invert transition duration-300">
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">
                    <a href="#" class="hover:text-[#5B9F01] transition">Finance</a>
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Get the device you've always wanted today—for as low as $80 USD! Including iPhones, Samsung Galaxy devices, iPads, tablets, game systems.
                </p>
                <div class="mt-4">
                    <a href="#" class="inline-flex items-center gap-1 text-[#5B9F01] text-sm font-medium hover:gap-2 transition-all">
                        Learn More <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Explore All Services Button -->
        <div class="text-center mt-12">
            <a href="#" class="inline-flex items-center gap-2 bg-[#5B9F01] hover:bg-[#4a7f01] text-white font-semibold px-8 py-3 rounded-full transition duration-300 shadow-md hover:shadow-lg">
                Explore All Services <i class="fas fa-arrow-right text-sm"></i>
            </a>
        </div>
    </div>
</section>
<!-- iPhone Repair Services Section -->
<section class="py-10 bg-white">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-16">

            <!-- Left Side - Image -->
            <div class="flex-1 relative group">
                <div class="relative">
                    <!-- Main Image -->
                    <div class="rounded-2xl overflow-hidden shadow-xl relative">
                        <img src="http://technician.watervertex.com/wp-content/uploads/2026/03/Mobile-Repair-Optimized.webp" alt="iPhone Repair Services" class="w-full h-auto object-cover rounded-2xl">
                        <!-- Ripple Effect Overlay -->
                        <div class="ripple-shape absolute inset-0 pointer-events-none">
                            <span class="absolute inset-0 rounded-2xl bg-[#5B9F01]/0 group-hover:bg-[#5B9F01]/10 transition-all duration-700"></span>
                        </div>
                    </div>


                </div>
            </div>

            <!-- Right Side - Content -->
            <div class="flex-1">
                <!-- Section Badge -->
                <div class="inline-flex items-center gap-2 bg-[#5B9F01]/10 px-4 py-1.5 rounded-full mb-4">
                    <span class="w-2 h-2 bg-[#5B9F01] rounded-full animate-pulse"></span>
                    <span class="text-[#5B9F01] font-semibold text-sm uppercase tracking-wider">Expert Service</span>
                </div>

                <!-- Heading -->
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    iPhone Repair Services
                </h2>

                <!-- Description -->
                <p class="text-gray-500 leading-relaxed mb-6">
                    When you need fast, professional iPhone repair that won't break the bank, trust The Green Jack. From cracked screens to liquid damage, our skilled technicians have years of experience handling all common iPhone issues. Whether you have an iPhone 13 or an iPhone 6, we have the tools and expertise to get your device back up and running in no time!
                </p>

                <!-- Features List -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-8">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-[#5B9F01] text-sm"></i>
                        <span class="text-gray-600 text-sm">Cracked Screen Repair</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-[#5B9F01] text-sm"></i>
                        <span class="text-gray-600 text-sm">Battery Replacement</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-[#5B9F01] text-sm"></i>
                        <span class="text-gray-600 text-sm">Water Damage Repair</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-[#5B9F01] text-sm"></i>
                        <span class="text-gray-600 text-sm">Charging Port Fix</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-[#5B9F01] text-sm"></i>
                        <span class="text-gray-600 text-sm">Camera Repair</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-[#5B9F01] text-sm"></i>
                        <span class="text-gray-600 text-sm">Speaker & Mic Repair</span>
                    </div>
                </div>

                <!-- Button -->
                <a href="#" class="inline-flex items-center gap-2 bg-[#5B9F01] hover:bg-[#4a7f01] text-white font-semibold px-8 py-3 rounded-full transition duration-300 shadow-md hover:shadow-lg">
                    Read More <i class="fas fa-arrow-right text-sm"></i>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- iPad Repair Services Section -->
<section class="py-10 bg-gray-50">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-16">

            <!-- Left Side - Content -->
            <div class="flex-1">
                <!-- Section Badge -->
                <div class="inline-flex items-center gap-2 bg-[#5B9F01]/10 px-4 py-1.5 rounded-full mb-4">
                    <span class="w-2 h-2 bg-[#5B9F01] rounded-full animate-pulse"></span>
                    <span class="text-[#5B9F01] font-semibold text-sm uppercase tracking-wider">Expert Service</span>
                </div>

                <!-- Heading -->
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    iPad Repair Services
                </h2>

                <!-- Divider -->
                <div class="w-16 h-1 bg-[#5B9F01] rounded-full mb-6"></div>

                <!-- Description -->
                <p class="text-gray-500 leading-relaxed mb-6">
                    We take iPad repairs seriously at The Green Jack. Our experienced technicians work on all models and have handled nearly every type of issue—from cracked screens and faulty dock connectors to unresponsive home buttons and more. We complete repairs quickly so you can get your iPad back in your hands fast. Plus, with our 1-year warranty on parts and labor, you can have complete peace of mind knowing you're covered if anything goes wrong.
                </p>

                <!-- Features List -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-8">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-[#5B9F01] text-sm"></i>
                        <span class="text-gray-600 text-sm">Cracked Screen Repair</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-[#5B9F01] text-sm"></i>
                        <span class="text-gray-600 text-sm">Battery Replacement</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-[#5B9F01] text-sm"></i>
                        <span class="text-gray-600 text-sm">Dock Connector Repair</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-[#5B9F01] text-sm"></i>
                        <span class="text-gray-600 text-sm">Home Button Fix</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-[#5B9F01] text-sm"></i>
                        <span class="text-gray-600 text-sm">Water Damage Repair</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-[#5B9F01] text-sm"></i>
                        <span class="text-gray-600 text-sm">1-Year Warranty</span>
                    </div>
                </div>

                <!-- Button -->
                <a href="#" class="inline-flex items-center gap-2 bg-[#5B9F01] hover:bg-[#4a7f01] text-white font-semibold px-8 py-3 rounded-full transition duration-300 shadow-md hover:shadow-lg">
                    Read More <i class="fas fa-arrow-right text-sm"></i>
                </a>
            </div>

            <!-- Right Side - Image -->
            <div class="flex-1 relative group">
                <div class="relative">
                    <!-- Main Image -->
                    <div class="rounded-2xl overflow-hidden shadow-xl relative">
                        <img src="http://technician.watervertex.com/wp-content/uploads/2026/03/ipad_mini_exploded_view.jpg" alt="iPad Repair Services" class="w-full h-auto object-cover rounded-2xl">
                        <!-- Ripple Effect Overlay -->
                        <div class="ripple-shape absolute inset-0 pointer-events-none">
                            <span class="absolute inset-0 rounded-2xl bg-[#5B9F01]/0 group-hover:bg-[#5B9F01]/10 transition-all duration-700"></span>
                        </div>
                    </div>



                    <!-- Decorative Elements -->
                    <div class="absolute -top-4 -right-4 w-24 h-24 bg-[#5B9F01]/20 rounded-full blur-xl animate-pulse"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Cell Phone Repair Services Section -->
<section class="py-10 bg-white">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-16">

            <!-- Left Side - Image -->
            <div class="flex-1 relative group">
                <div class="relative">
                    <!-- Main Image -->
                    <div class="rounded-2xl overflow-hidden shadow-xl relative">
                        <img src="http://technician.watervertex.com/wp-content/uploads/2026/03/pngtree-phone-repair-service-pro-png-image_15060154.png" alt="Cell Phone Repair Services" class="w-full h-auto object-cover rounded-2xl">
                        <!-- Ripple Effect Overlay -->
                        <div class="ripple-shape absolute inset-0 pointer-events-none">
                            <span class="absolute inset-0 rounded-2xl bg-[#5B9F01]/0 group-hover:bg-[#5B9F01]/10 transition-all duration-700"></span>
                        </div>
                    </div>



                </div>
            </div>

            <!-- Right Side - Content -->
            <div class="flex-1">
                <!-- Section Badge -->
                <div class="inline-flex items-center gap-2 bg-[#5B9F01]/10 px-4 py-1.5 rounded-full mb-4">
                    <span class="w-2 h-2 bg-[#5B9F01] rounded-full animate-pulse"></span>
                    <span class="text-[#5B9F01] font-semibold text-sm uppercase tracking-wider">Smartphone Repair</span>
                </div>

                <!-- Heading -->
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    Fast, reliable, and affordable <br>
                    <span class="text-[#5B9F01]">cell phone repair.</span>
                </h2>

                <!-- Divider -->
                <div class="w-16 h-1 bg-[#5B9F01] rounded-full mb-6"></div>

                <!-- Description -->
                <p class="text-gray-500 leading-relaxed mb-6">
                    If you own a smartphone, you rely on it every day. It keeps you updated with the latest news, connects you with important contacts, stores your favorite memories, and helps you stay on schedule—you might even use it for calls! At The Green Jack, we understand how important your device is. That's why we offer fast, affordable smartphone repair services. Our skilled technicians are trained to handle a wide range of smartphone models, so you can get your trusted device back in your hands as quickly as possible.
                </p>

                <!-- Features List -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-8">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-[#5B9F01] text-sm"></i>
                        <span class="text-gray-600 text-sm">Same Day Repair</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-[#5B9F01] text-sm"></i>
                        <span class="text-gray-600 text-sm">Affordable Pricing</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-[#5B9F01] text-sm"></i>
                        <span class="text-gray-600 text-sm">Skilled Technicians</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-[#5B9F01] text-sm"></i>
                        <span class="text-gray-600 text-sm">All Models Supported</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-[#5B9F01] text-sm"></i>
                        <span class="text-gray-600 text-sm">Quality Parts</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-[#5B9F01] text-sm"></i>
                        <span class="text-gray-600 text-sm">90-Day Warranty</span>
                    </div>
                </div>

                <!-- Button -->
                <a href="#" class="inline-flex items-center gap-2 bg-[#5B9F01] hover:bg-[#4a7f01] text-white font-semibold px-8 py-3 rounded-full transition duration-300 shadow-md hover:shadow-lg">
                    Read More <i class="fas fa-arrow-right text-sm"></i>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- Why Choosing Our Services Section -->
<section class="py-10 bg-gray-50">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-16">

            <!-- Left Side - Content -->
            <div class="flex-1">
                <!-- Section Badge -->
                <div class="inline-flex items-center gap-2 bg-[#5B9F01]/10 px-4 py-1.5 rounded-full mb-4">
                    <span class="w-2 h-2 bg-[#5B9F01] rounded-full animate-pulse"></span>
                    <span class="text-[#5B9F01] font-semibold text-sm uppercase tracking-wider">Why Choosing Our Services</span>
                </div>

                <!-- Heading -->
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    Urgent Services for <br>
                    <span class="text-[#5B9F01]">Small Business and Residents</span>
                </h2>

                <!-- Divider -->
                <div class="w-16 h-1 bg-[#5B9F01] rounded-full mb-6"></div>

                <!-- Description -->
                <div class="space-y-4 text-gray-500 leading-relaxed">
                    <p>
                        We repair all models of iPhone, iPod, and iPad at The Green Jack. From cracked glass and damaged LCD screens to faulty buttons, charging ports, and more—we've got you covered.
                    </p>

                    <p>
                        <strong class="text-gray-700">Gaming Console Repairs:</strong> We fix disc drive issues, DVD drive problems, power faults, and more. We service devices like Nintendo DS, DSi, 3DS (including LCD, touchscreen, and power switch repairs), Xbox One, One S, and all versions of PS4.
                    </p>

                    <p>
                        <strong class="text-gray-700">Fast, Same-Day Service:</strong> We're committed to quality and speed. Many repairs are completed in under an hour!
                    </p>
                </div>

                <!-- Features List -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-6 mb-8">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-[#5B9F01] text-sm"></i>
                        <span class="text-gray-600 text-sm">iPhone, iPod & iPad Repair</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-[#5B9F01] text-sm"></i>
                        <span class="text-gray-600 text-sm">Cracked Screen & LCD Repair</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-[#5B9F01] text-sm"></i>
                        <span class="text-gray-600 text-sm">Gaming Console Repair</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-[#5B9F01] text-sm"></i>
                        <span class="text-gray-600 text-sm">Same-Day Service Available</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-[#5B9F01] text-sm"></i>
                        <span class="text-gray-600 text-sm">Nintendo DS, 3DS & Switch</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle text-[#5B9F01] text-sm"></i>
                        <span class="text-gray-600 text-sm">Xbox One, PS4 & More</span>
                    </div>
                </div>

                <!-- Button -->
                <a href="#" class="inline-flex items-center gap-2 bg-[#5B9F01] hover:bg-[#4a7f01] text-white font-semibold px-8 py-3 rounded-full transition duration-300 shadow-md hover:shadow-lg">
                    Learn More <i class="fas fa-arrow-right text-sm"></i>
                </a>
            </div>

            <!-- Right Side - Image -->
            <div class="flex-1 relative group">
                <div class="relative">
                    <!-- Main Image -->
                    <div class="rounded-2xl overflow-hidden shadow-xl relative">
                        <img src="https://thegreenjack.com/wp-content/uploads/2026/03/pngtree-repairing-and-upgrade-mobile-phone-electronic-computer-hardware-and-technology-concept-image_15645837-1.jpg" alt="Repair Services" class="w-full h-auto object-cover rounded-2xl transition-transform duration-500 group-hover:scale-105">
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-tr from-black/10 to-transparent"></div>
                    </div>





                </div>
            </div>
        </div>
    </div>
</section>
<!-- Counter/Stats Section - Green Background with Dividers -->
<section class="py-16 bg-[#5B9F01]">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

            <!-- Counter 1 -->
            <div class="text-center border-r border-white/20 last:border-r-0 lg:border-r">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white/15 rounded-full mb-4">
                    <i class="fas fa-laptop-code text-2xl text-white"></i>
                </div>
                <div class="text-4xl md:text-5xl font-bold text-white mb-2">
                    1.25<span class="text-xl">k</span>
                </div>
                <p class="text-white/80 text-sm uppercase tracking-wider">Successful Devices</p>
            </div>

            <!-- Counter 2 -->
            <div class="text-center border-r border-white/20 last:border-r-0 lg:border-r">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white/15 rounded-full mb-4">
                    <i class="fas fa-smile text-2xl text-white"></i>
                </div>
                <div class="text-4xl md:text-5xl font-bold text-white mb-2">
                    1.24<span class="text-xl">k</span>
                </div>
                <p class="text-white/80 text-sm uppercase tracking-wider">Satisfied Customers</p>
            </div>

            <!-- Counter 3 -->
            <div class="text-center border-r border-white/20 last:border-r-0 lg:border-r">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white/15 rounded-full mb-4">
                    <i class="fas fa-user-tie text-2xl text-white"></i>
                </div>
                <div class="text-4xl md:text-5xl font-bold text-white mb-2">
                    20<span class="text-xl">+</span>
                </div>
                <p class="text-white/80 text-sm uppercase tracking-wider">Expert Technicians</p>
            </div>

            <!-- Counter 4 -->
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white/15 rounded-full mb-4">
                    <i class="fas fa-medal text-2xl text-white"></i>
                </div>
                <div class="text-4xl md:text-5xl font-bold text-white mb-2">
                    100<span class="text-xl">%</span>
                </div>
                <p class="text-white/80 text-sm uppercase tracking-wider">Quality Products</p>
            </div>
        </div>
    </div>
</section>
<!-- Testimonials Section with Carousel Slider -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 max-w-7xl">

        <!-- Section Header -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center gap-2 bg-[#5B9F01]/10 px-4 py-1.5 rounded-full mb-4">
                <span class="w-2 h-2 bg-[#5B9F01] rounded-full animate-pulse"></span>
                <span class="text-[#5B9F01] font-semibold text-sm uppercase tracking-wider">Testimonials</span>
            </div>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-800">
                What Our Customer Says?
            </h2>
            <div class="w-20 h-1 bg-[#5B9F01] mx-auto mt-5 rounded-full"></div>
        </div>

        <!-- Testimonial Cards - Slider Grid -->
        <div class="testimonial-slider grid grid-cols-1 md:grid-cols-2 gap-6" id="testimonialSlider">

            <!-- Slide 1 -->
            <div class="testimonial-item">
                <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-lg transition-all duration-300 h-full">
                    <div class="flex flex-col sm:flex-row gap-5">

                        <div class="flex-1">
                            <div class="flex items-center gap-1 mb-2">
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Alex Fernandes</h3>
                            <span class="text-sm text-[#5B9F01] block mb-3">UI/UX Designer</span>
                            <p class="text-gray-500 text-sm leading-relaxed">
                                Enthusiastically matrix visionary e-commerce after enterprise-wide collaboration and idea-sharing. Objectively administrate bleeding-edge best practices through interactive niche markets.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="testimonial-item">
                <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-lg transition-all duration-300 h-full">
                    <div class="flex flex-col sm:flex-row gap-5">

                        <div class="flex-1">
                            <div class="flex items-center gap-1 mb-2">
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Abraham Khalil</h3>
                            <span class="text-sm text-[#5B9F01] block mb-3">CEO at Corola</span>
                            <p class="text-gray-500 text-sm leading-relaxed">
                                Enthusiastically matrix visionary e-commerce after enterprise-wide collaboration and idea-sharing. Objectively administrate bleeding-edge best practices through interactive niche markets.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="testimonial-item">
                <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-lg transition-all duration-300 h-full">
                    <div class="flex flex-col sm:flex-row gap-5">

                        <div class="flex-1">
                            <div class="flex items-center gap-1 mb-2">
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">Mariana Sonia</h3>
                            <span class="text-sm text-[#5B9F01] block mb-3">UI/UX Designer</span>
                            <p class="text-gray-500 text-sm leading-relaxed">
                                Enthusiastically matrix visionary e-commerce after enterprise-wide collaboration and idea-sharing. Objectively administrate bleeding-edge best practices through interactive niche markets.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slider Navigation Dots -->
        <div class="flex justify-center gap-2 mt-8">
            <button class="slider-dot w-2 h-2 rounded-full bg-gray-300 transition-all duration-300"></button>
            <button class="slider-dot w-2 h-2 rounded-full bg-gray-300 transition-all duration-300"></button>
            <button class="slider-dot w-2 h-2 rounded-full bg-gray-300 transition-all duration-300"></button>
        </div>
    </div>
</section>

<!-- Simple Slider JavaScript -->
<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.testimonial-item');
    const dots = document.querySelectorAll('.slider-dot');
    let slidesToShow = window.innerWidth >= 768 ? 2 : 1;

    function updateSlider() {
        slides.forEach((slide, index) => {
            if (index >= currentSlide && index < currentSlide + slidesToShow) {
                slide.style.display = 'block';
            } else {
                slide.style.display = 'none';
            }
        });

        dots.forEach((dot, index) => {
            if (index === Math.floor(currentSlide / slidesToShow)) {
                dot.classList.add('bg-[#5B9F01]', 'w-6');
                dot.classList.remove('bg-gray-300', 'w-2');
            } else {
                dot.classList.remove('bg-[#5B9F01]', 'w-6');
                dot.classList.add('bg-gray-300', 'w-2');
            }
        });
    }

    function nextSlide() {
        if (currentSlide + slidesToShow < slides.length) {
            currentSlide += slidesToShow;
        } else {
            currentSlide = 0;
        }
        updateSlider();
    }

    // Initialize
    updateSlider();

    // Auto slide every 5 seconds
    setInterval(nextSlide, 5000);

    // Handle window resize
    window.addEventListener('resize', () => {
        slidesToShow = window.innerWidth >= 768 ? 2 : 1;
        updateSlider();
    });
</script>
</div>
