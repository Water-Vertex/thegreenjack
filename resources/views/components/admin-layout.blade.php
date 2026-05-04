<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Material Admin Dashboard - {{ config('app.name') }}</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js' , 'resources/js/ckeditor.js'])

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- jQuery (Make sure it's loaded before your scripts) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <x-admin-styles />

    <style>
        /* Additional custom styles if needed */
        * {
            font-family: 'Inter', sans-serif;
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar for webkit browsers */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Main content transition */
        .main-content {
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
        }

        /* Loading state */
        .loading {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.9);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .loading.hide {
            display: none;
        }
    </style>
    @livewireStyles
    @yield('page-style')
</head>

<body class="bg-gray-50 antialiased">
    <!-- Loading Spinner (Optional) -->
    <div class="loading hide" id="loading">
        <div class="w-12 h-12 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin"></div>
    </div>

    <!-- Sidebar Navigation -->

    <!-- Modern Header -->
    <x-admin-sidebar />


    <!-- Page Content -->
    <main class="main-content md:ml-72 transition-all duration-300">
    <x-admin-header />

        <div class="p-6">
            {{ $slot }}
        </div>
        <!-- Footer (Optional) -->
    <footer class="main-content md:ml-72 transition-all duration-300 mt-8">
        <div class="p-6 text-center text-gray-500 text-sm border-t border-gray-200">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </footer>
    </main>



    <x-admin-scripts />
    @livewireScripts
    @stack('scripts')
    <script>
    $(document).ready(function() {
        // Dropdown Toggle for Sidebar
        $('.dropdown-trigger').click(function(e) {
            e.stopPropagation();
            var $trigger = $(this);
            var $content = $trigger.next('.dropdown-content');
            var $icon = $trigger.find('.dropdown-icon');

            // Close other dropdowns
            $('.dropdown-content').not($content).slideUp(200, function() {
                $(this).removeClass('open');
            });
            $('.dropdown-icon').not($icon).removeClass('rotate-180');

            // Toggle current
            $content.slideToggle(200);
            $content.toggleClass('open');
            $icon.toggleClass('rotate-180');
        });

        // Sidebar Collapse (Desktop)
        let collapsed = false;
        $('#collapseBtn').click(function() {
            collapsed = !collapsed;
            const $sidebar = $('#sidebar');
            const $mainContent = $('.main-content');

            if (collapsed) {
                $sidebar.addClass('w-20').removeClass('w-72');
                $mainContent.addClass('md:ml-20').removeClass('md:ml-72');
                $('#sidebar .brand-text, #sidebar .nav-label, #sidebar .dropdown-trigger span:not(.material-icons), #sidebar .dropdown-trigger .dropdown-icon, #sidebar .dropdown-content').hide();
                $('#sidebar .dropdown-content').hide();
                $(this).find('.material-icons').text('menu');

                // Store preference in localStorage
                localStorage.setItem('sidebarCollapsed', 'true');
            } else {
                $sidebar.addClass('w-72').removeClass('w-20');
                $mainContent.addClass('md:ml-72').removeClass('md:ml-20');
                $('#sidebar .brand-text, #sidebar .nav-label, #sidebar .dropdown-trigger span:not(.material-icons)').show();
                $('#sidebar .dropdown-trigger .dropdown-icon').show();
                $(this).find('.material-icons').text('menu_open');

                // Store preference in localStorage
                localStorage.setItem('sidebarCollapsed', 'false');
            }
        });

        // Restore sidebar state from localStorage
        const savedState = localStorage.getItem('sidebarCollapsed');
        if (savedState === 'true') {
            $('#collapseBtn').click();
        }

        // Mobile Menu
        $('#mobileMenuBtn').click(function() {
            $('#sidebar').addClass('translate-x-0').removeClass('-translate-x-full');
            $('#sidebarOverlay').addClass('block').removeClass('hidden');
            $('body').css('overflow', 'hidden');
        });

        $('#sidebarOverlay').click(function() {
            $('#sidebar').addClass('-translate-x-full').removeClass('translate-x-0');
            $(this).addClass('hidden').removeClass('block');
            $('body').css('overflow', '');
        });

        // Active link highlighting
        var currentUrl = window.location.href;
        $('.dropdown-content a, .nav-item a').each(function() {
            if ($(this).attr('href') && currentUrl.indexOf($(this).attr('href')) !== -1) {
                $(this).addClass('bg-gradient-to-r from-indigo-600/20 to-purple-600/20 text-white');
                // Expand parent dropdown if any
                $(this).closest('.dropdown-content').addClass('open').show();
                $(this).closest('.dropdown-content').prev('.dropdown-trigger').find('.dropdown-icon').addClass('rotate-180');
            }
        });

        // Close dropdowns when clicking outside (optional)
        $(document).click(function(e) {
            if (!$(e.target).closest('.dropdown-container').length && !$(e.target).closest('.dropdown-trigger').length) {
                $('.dropdown-content').slideUp(200, function() {
                    $(this).removeClass('open');
                });
                $('.dropdown-icon').removeClass('rotate-180');
            }
        });

        // Add loading state for AJAX requests
        $(document).ajaxStart(function() {
            $('#loading').removeClass('hide');
        }).ajaxStop(function() {
            $('#loading').addClass('hide');
        });
    });
    </script>

    @yield('page-script')
</body>
</html>
