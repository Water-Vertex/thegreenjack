<!-- Main Sidebar Container - Tailwind CSS + Material UI -->
<aside class="fixed left-0 top-0 h-full w-72 bg-gray-900  shadow-2xl z-30 transition-all duration-300 overflow-y-auto sidebar-scroll">

    <!-- Brand Logo -->
    <div class="p-5 border-b border-white/10">
        <a href="" class="flex items-center justify-center group">
            <img src="{{ asset('assets/images/logo/green-jack-white.png') }}"
                 alt="Logo"
                 class="w-auto object-contain transition-transform group-hover:scale-105">
        </a>
    </div>

    <!-- Sidebar Navigation -->
    <div class="px-3 py-4">
        <nav class="space-y-1">
            <!-- Dashboard -->
            <a href="{{ route('admin.index') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/80 hover:text-white hover:bg-[#5C9F01]/40 transition-all duration-200 group">
                <span class="material-icons text-2xl">dashboard</span>
                <span class="text-sm font-medium">Dashboard</span>
            </a>

            <a href="{{ route('admin.categories') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/80 hover:text-white hover:bg-[#5C9F01]/40 transition-all duration-200 group">
                <span class="material-icons text-2xl">category</span>
                <span class="text-sm font-medium">Category</span>
            </a>

            <a href="{{ route('admin.sub-categories') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/80 hover:text-white hover:bg-[#5C9F01]/40 transition-all duration-200 group">
                <span class="material-icons text-2xl">category</span>
                <span class="text-sm font-medium">Sub Category</span>
            </a>

            <a href="{{ route('admin.products') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/80 hover:text-white hover:bg-[#5C9F01]/40 transition-all duration-200 group">
                <span class="material-icons text-2xl">store</span>
                <span class="text-sm font-medium">Products</span>
            </a>

            <a href="{{ route('admin.brands') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/80 hover:text-white hover:bg-[#5C9F01]/40 transition-all duration-200 group">
                <span class="material-icons text-2xl">label</span>
                <span class="text-sm font-medium">Brands</span>
            </a>

            <a href="{{ route('admin.brand-models') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/80 hover:text-white hover:bg-[#5C9F01]/40 transition-all duration-200 group">
                <span class="material-icons text-2xl">label</span>
                <span class="text-sm font-medium">Brand Models</span>
            </a>

            <a href="{{ route('admin.problems') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/80 hover:text-white hover:bg-[#5C9F01]/40 transition-all duration-200 group">
                <span class="material-icons text-2xl">question_answer</span>
                <span class="text-sm font-medium">Problems</span>
            </a>

            <a href="{{ route('admin.repair-requests') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/80 hover:text-white hover:bg-[#5C9F01]/40 transition-all duration-200 group">
                <span class="material-icons text-2xl">assignment</span>
                <span class="text-sm font-medium">Repair Requests</span>
            </a>
            
<a href="{{ route('admin.contacts') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/80 hover:text-white hover:bg-[#5C9F01]/40 transition-all duration-200 group">
    <span class="material-icons text-2xl">contact_mail</span>
    <span class="text-sm font-medium">Contacts</span>
</a>

            <!-- Banner -->
            <a href="" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/80 hover:text-white hover:bg-[#5C9F01]/40 transition-all duration-200 group">
                <span class="material-icons text-2xl">campaign</span>
                <span class="text-sm font-medium">Banner</span>
            </a>

            <a href="" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/80 hover:text-white hover:bg-[#5C9F01]/40 transition-all duration-200 group">
                <span class="material-icons text-2xl">article</span>
                <span class="text-sm font-medium">Blog</span>
            </a>



            <!-- Site Content -->
            <a href="" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/80 hover:text-white hover:bg-[#5C9F01]/40 transition-all duration-200 group">
                <span class="material-icons text-2xl">web</span>
                <span class="text-sm font-medium">Site Content</span>
            </a>

            <!-- Site Settings -->
            <a href="" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/80 hover:text-white hover:bg-[#5C9F01]/40 transition-all duration-200 group">
                <span class="material-icons text-2xl">settings</span>
                <span class="text-sm font-medium">Site Settings</span>
            </a>
<!-- Programatic SEO -->
<a href="{{ route('admin.programatic-seo') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/80 hover:text-white hover:bg-[#5C9F01]/40 transition-all duration-200 group">
    <span class="material-icons text-2xl">travel_explore</span>
    <span class="text-sm font-medium">Programatic SEO</span>
</a>


            <!-- Pages -->
            <a href="{{route('admin.pages')}}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white/80 hover:text-white hover:bg-[#5C9F01]/40 transition-all duration-200 group">
                <span class="material-icons text-2xl">description</span>
                <span class="text-sm font-medium">Pages</span>
            </a>
        </nav>
    </div>
</aside>

<!-- Required CSS for scrollbar -->
<style>
    /* Custom scrollbar for sidebar */
    .sidebar-scroll::-webkit-scrollbar {
        width: 4px;
    }

    .sidebar-scroll::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.05);
    }

    .sidebar-scroll::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 4px;
    }

    .sidebar-scroll::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    /* Rotate animation for dropdown icons */
    .rotate-180 {
        transform: rotate(180deg);
    }
</style>

<!-- jQuery Script for Dropdown Functionality -->
<script>
$(document).ready(function() {
    // Dropdown toggle functionality
    $('.dropdown-trigger').click(function(e) {
        e.stopPropagation();

        var $trigger = $(this);
        var $content = $trigger.next('.dropdown-content');
        var $icon = $trigger.find('.dropdown-icon');

        // Close other dropdowns
        $('.dropdown-content').not($content).slideUp(200, function() {
            $(this).addClass('hidden');
        });
        $('.dropdown-icon').not($icon).removeClass('rotate-180');

        // Toggle current dropdown
        if ($content.hasClass('hidden')) {
            $content.removeClass('hidden').slideDown(200);
            $icon.addClass('rotate-180');
        } else {
            $content.slideUp(200, function() {
                $(this).addClass('hidden');
            });
            $icon.removeClass('rotate-180');
        }
    });

    // Active link highlighting
    var currentUrl = window.location.href;
    $('.dropdown-content a, a[href]').each(function() {
        if ($(this).attr('href') && currentUrl.indexOf($(this).attr('href')) !== -1) {
            $(this).addClass('bg-[#5C9F01] text-white');
            // Expand parent dropdown if current link is inside dropdown
            $(this).closest('.dropdown-content').removeClass('hidden').show();
            $(this).closest('.dropdown-content').prev('.dropdown-trigger').find('.dropdown-icon').addClass('rotate-180');
        }
    });

    // Close dropdowns when clicking outside (optional)
    $(document).click(function(e) {
        if (!$(e.target).closest('.dropdown-container').length) {
            $('.dropdown-content').slideUp(200, function() {
                $(this).addClass('hidden');
            });
            $('.dropdown-icon').removeClass('rotate-180');
        }
    });
});
</script>
