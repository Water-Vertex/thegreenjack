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
    Route::get('/brands', Brands::class)->name('brands');
    Route::get('/brand-models', Models::class)->name('brand-models');
    Route::get('/problems', Problems::class)->name('problems');
    Route::get('/repair-requests', RepairRequests::class)->name('repair-requests');

});
