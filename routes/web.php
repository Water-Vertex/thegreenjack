<?php

use App\Livewire\Admin\Brands;
use App\Livewire\Admin\Categories;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Models;
use App\Livewire\Admin\Pages;
use App\Livewire\Admin\Problems;
use App\Livewire\Admin\Products;
use App\Livewire\Admin\RepairRequests;
use App\Livewire\Admin\SubCategories;
use App\Livewire\Admin\PageMetaService;
use App\Livewire\Admin\BlogManager;
use App\Livewire\Admin\Sitemap;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Logout;
use App\Livewire\User\Cart;
use App\Livewire\User\Checkout;
use App\Livewire\User\Contact;
use App\Livewire\User\DeviceRepair;
use App\Livewire\User\Home;
use App\Livewire\User\PrintingMarketing;
use App\Livewire\User\Products as UserProducts;
use App\Livewire\User\Repair;
use App\Livewire\User\Shop;
use App\Livewire\User\ShopDetails;
use App\Livewire\Admin\Settings;
use Illuminate\Support\Facades\Route;


Route::get('/login', Login::class)->name('login');
Route::get('/logout', Logout::class)->name('logout');

Route::get('/', Home::class,)->name('home');
Route::get('/contact-us', Contact::class,)->name('contact-us');
Route::get('/device-repair/{slug}', DeviceRepair::class,)->name('device-repair');
Route::get('/repair',Repair::class)->name('repair');
Route::get('/printing-marketing', PrintingMarketing::class)->name('printing');
Route::get('/shop',Shop::class)->name('shop');
Route::get('/products',UserProducts::class)->name('products');
Route::get('/product/{slug}',ShopDetails::class)->name('shop.details');
Route::get('/cart', Cart::class)->name('cart.page');
Route::get('/checkout', Checkout::class)->name('checkout');

Route::middleware(['auth','preventback'])->prefix('admin')->name('admin.')->group(function () {
	Route::get('/dashboard',Dashboard::class)->name('index');
	Route::get('/pages',Pages::class)->name('pages');
    Route::get('/categories', Categories::class)->name('categories');
    Route::get('/sub-categories', SubCategories::class)->name('sub-categories');
    Route::get('/products', Products::class)->name('products');
        
    Route::get('/sitemap', Sitemap::class)->name('sitemap');
    
    // YEH NAYA ROUTE ADD KARO
    Route::get('/sitemap/download-xml', function () {
        $urls = [];

        $statics = [
            ['url' => url('/'),           'priority' => '1.0', 'changefreq' => 'daily',   'lastmod' => now()->toDateString()],
            ['url' => url('/contact-us'), 'priority' => '0.7', 'changefreq' => 'monthly', 'lastmod' => now()->toDateString()],
            ['url' => url('/blogs'),      'priority' => '0.9', 'changefreq' => 'weekly',  'lastmod' => now()->toDateString()],
            ['url' => url('/shop'),       'priority' => '0.9', 'changefreq' => 'weekly',  'lastmod' => now()->toDateString()],
        ];
        $urls = array_merge($urls, $statics);

        \App\Models\Blog::latest()->get()->each(fn($i) => $urls[] = [
            'url' => url('/blog/' . $i->slug), 'priority' => '0.8',
            'changefreq' => 'monthly', 'lastmod' => optional($i->updated_at)->toDateString()
        ]);
        \App\Models\Category::latest()->get()->each(fn($i) => $urls[] = [
            'url' => url('/category/' . $i->slug), 'priority' => '0.6',
            'changefreq' => 'weekly', 'lastmod' => optional($i->updated_at)->toDateString()
        ]);
        \App\Models\Product::latest()->get()->each(fn($i) => $urls[] = [
            'url' => url('/product/' . $i->slug), 'priority' => '0.7',
            'changefreq' => 'weekly', 'lastmod' => optional($i->updated_at)->toDateString()
        ]);

        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($urls as $url) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . e($url['url']) . "</loc>\n";
            $xml .= "    <lastmod>{$url['lastmod']}</lastmod>\n";
            $xml .= "    <changefreq>{$url['changefreq']}</changefreq>\n";
            $xml .= "    <priority>{$url['priority']}</priority>\n";
            $xml .= "  </url>\n";
        }
        $xml .= "</urlset>";

        return response()->streamDownload(
            fn() => print($xml),
            'sitemap.xml',
            ['Content-Type' => 'application/xml']
        );
    })->name('sitemap.download');
    Route::get('/brands', Brands::class)->name('brands');
    Route::get('/brand-models', Models::class)->name('brand-models');
    Route::get('/problems', Problems::class)->name('problems');
    Route::get('/repair-requests', RepairRequests::class)->name('repair-requests');
    Route::get('/settings', Settings::class)->name('settings');
    Route::get('/seo-settings', PageMetaService::class)->name('seo-settings');
    Route::get('/blogs', BlogManager::class)->name('blogs'); 
});
