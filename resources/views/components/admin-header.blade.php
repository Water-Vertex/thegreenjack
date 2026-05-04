<!-- Modern Header - Tailwind CSS + Material UI -->
<header class="bg-white/80 backdrop-blur-md shadow-lg sticky top-0 z-20 border-b border-gray-100">
    <div class="px-6 py-4 flex items-center justify-between">
        <!-- Left Section -->
        <div class="flex items-center gap-4">

            <!-- Page Title & Greeting -->
            <div class="hidden sm:block">

                <p class="text-sm text-gray-500 mt-0.5 flex items-center gap-1">
                    <span class="material-icons text-base text-gray-400">waving_hand</span>
                    Welcome back, Admin
                </p>
            </div>
        </div>

        <!-- Right Section -->
        <div class="flex items-center gap-2">
            <!-- Search Bar (Optional) -->
            <div class="hidden md:flex items-center gap-2 px-3 py-1.5 rounded-xl bg-gray-50 border border-gray-200 focus-within:border-indigo-300 focus-within:ring-2 focus-within:ring-indigo-200 transition-all">
                <span class="material-icons text-gray-400 text-xl">search</span>
                <input type="text" placeholder="Search..." class="bg-transparent border-none outline-none text-sm w-48 text-gray-700 placeholder-gray-400">
            </div>

            <!-- Notifications Button -->
            <button class="relative p-2.5 rounded-xl text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition-all duration-200">
                <span class="material-icons text-2xl">notifications_none</span>
                <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
            </button>

            <!-- Settings Button -->
            <button class="hidden sm:flex p-2.5 rounded-xl text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition-all duration-200">
                <span class="material-icons text-2xl">settings</span>
            </button>

            <!-- Divider -->
            <div class="hidden sm:block w-px h-8 bg-gray-200 mx-1"></div>

            <!-- User Profile Dropdown -->
            <div class="relative dropdown-container">
                <button class="dropdown-trigger-user flex items-center gap-2 p-1.5 pr-3 rounded-xl hover:bg-gray-100 transition-all duration-200 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center shadow-md group-hover:scale-105 transition-transform">
                        <span class="material-icons text-white text-2xl">person</span>
                    </div>
                    <div class="hidden md:block text-left">
                        <p class="text-sm font-semibold text-gray-700">Admin User</p>
                        <p class="text-xs text-gray-400">Administrator</p>
                    </div>
                    <span class="material-icons text-gray-400 text-xl hidden md:inline-block dropdown-user-icon transition-transform duration-200">expand_more</span>
                </button>

                <!-- User Dropdown Menu -->
                <div class="dropdown-user-content absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden hidden z-50">
                    <div class="p-3 border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-purple-50">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center shadow-md">
                                <span class="material-icons text-white text-2xl">person</span>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">Admin User</p>
                                <p class="text-xs text-gray-500">admin@example.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="py-2">

                        <div class="border-t border-gray-100 my-1"></div>
                        <a href="" class="flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors" >
                            <span class="material-icons text-red-500 text-xl">logout</span>
                            <span>Logout</span>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- jQuery Script for User Dropdown -->
<script>
$(document).ready(function() {
    // User dropdown toggle
    $('.dropdown-trigger-user').click(function(e) {
        e.stopPropagation();

        var $content = $('.dropdown-user-content');
        var $icon = $('.dropdown-user-icon');

        // Close if already open
        if ($content.hasClass('hidden')) {
            // Close other dropdowns first
            $('.dropdown-user-content').not($content).addClass('hidden');
            $('.dropdown-user-icon').not($icon).removeClass('rotate-180');

            $content.removeClass('hidden').slideDown(200);
            $icon.addClass('rotate-180');
        } else {
            $content.slideUp(200, function() {
                $(this).addClass('hidden');
            });
            $icon.removeClass('rotate-180');
        }
    });

    // Close dropdown when clicking outside
    $(document).click(function(e) {
        if (!$(e.target).closest('.dropdown-container').length) {
            $('.dropdown-user-content').slideUp(200, function() {
                $(this).addClass('hidden');
            });
            $('.dropdown-user-icon').removeClass('rotate-180');
        }
    });
});
</script>

<style>
    /* Rotate animation */
    .rotate-180 {
        transform: rotate(180deg);
    }

    /* Smooth dropdown animation */
    .dropdown-user-content {
        display: none;
        animation: fadeInDown 0.2s ease-out;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
