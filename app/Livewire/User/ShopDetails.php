<?php

namespace App\Livewire\User;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

#[Layout('components.shop-layout')]

class ShopDetails extends Component
{
    public $slug;
    public $products;
    public $brands;
    public $product;
    public $categoryId;
    public $quantity = 1;
    public $cartCount = 0;
    public $addingToCart = false; // Track adding to cart state

    public function mount($slug = null)
    {
        $this->slug = $slug;
        $this->loadData();
        $this->getCartCount();
    }

    public function getCartCount()
    {
        $cart = Session::get('cart', []);
        $this->cartCount = array_sum(array_column($cart, 'quantity'));
    }

    public function loadData()
    {
        // Find the current product
        if ($this->slug) {
            $this->product = Product::with('category', 'productimages')->where('slug', $this->slug)->first();

            if (!$this->product) {
                return redirect()->route('index')->with('error', 'Product not found');
            }
        } else {
            return redirect()->route('index')->with('error', 'Product not specified');
        }

        // Get category ID from the product
        $this->categoryId = $this->product->category->id ?? null;

        // Load brands
        $this->brands = Brand::with('categories')->get();

        // Load other products (excluding current)
        $this->products = Product::with('category')
            ->where('slug', '!=', $this->slug)
            ->where('is_active', true)
            ->orderBy('id', 'asc')
            ->limit(12)
            ->get();
    }

    public function increaseQuantity()
    {
        if ($this->quantity < $this->product->stock) {
            $this->quantity++;
        }
    }

    public function decreaseQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function updatedQuantity($value)
    {
        if ($value > $this->product->stock) {
            $this->quantity = $this->product->stock;
        } elseif ($value < 1) {
            $this->quantity = 1;
        }
    }

    public function addToCart()
    {
        // Set loading state
        $this->addingToCart = true;

        // Check stock
        if ($this->quantity > $this->product->stock) {
            session()->flash('error', 'Only ' . $this->product->stock . ' items available in stock.');
            $this->addingToCart = false;
            return;
        }

        // Get current cart from session
        $cart = Session::get('cart', []);

        $productId = $this->product->id;
        $price = $this->product->discounted_price > 0 ? $this->product->discounted_price : $this->product->price;

        // Check if product already in cart
        if (isset($cart[$productId])) {
            // Update quantity
            $newQuantity = $cart[$productId]['quantity'] + $this->quantity;
            if ($newQuantity > $this->product->stock) {
                session()->flash('error', 'Cannot add more than available stock.');
                $this->addingToCart = false;
                return;
            }
            $cart[$productId]['quantity'] = $newQuantity;
            session()->flash('success', 'Cart updated successfully!');
        } else {
            // Add new item to cart
            $cart[$productId] = [
                'id' => $productId,
                'name' => $this->product->name,
                'slug' => $this->product->slug,
                'image' => $this->product->image,
                'price' => $price,
                'quantity' => $this->quantity,
                'stock' => $this->product->stock
            ];
            session()->flash('success', 'Product added to cart successfully!');
        }

        // Save cart back to session
        Session::put('cart', $cart);

        // Reset quantity and update cart count
        $this->quantity = 1;
        $this->getCartCount();

        // Dispatch event to update cart counter in header
        $this->dispatch('cart-updated');

        // Clear loading state
        $this->addingToCart = false;
    }

    // Add to cart for related products
    public function addRelatedToCart($productId, $quantity = 1)
    {
        $product = Product::find($productId);

        if (!$product || $product->stock < $quantity) {
            session()->flash('error', 'Product not available in requested quantity.');
            return;
        }

        $cart = Session::get('cart', []);
        $price = $product->discounted_price > 0 ? $product->discounted_price : $product->price;

        if (isset($cart[$productId])) {
            $newQuantity = $cart[$productId]['quantity'] + $quantity;
            if ($newQuantity > $product->stock) {
                session()->flash('error', 'Cannot add more than available stock.');
                return;
            }
            $cart[$productId]['quantity'] = $newQuantity;
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'name' => $product->name,
                'slug' => $product->slug,
                'image' => $product->image,
                'price' => $price,
                'quantity' => $quantity,
                'stock' => $product->stock
            ];
        }

        Session::put('cart', $cart);
        $this->dispatch('cart-updated');
        session()->flash('success', $product->name . ' added to cart!');
    }

    public function refreshData()
    {
        $this->loadData();
        $this->dispatch('data-refreshed');
    }

    public function render()
    {
        return view('livewire.user.shop-details', [
            'product' => $this->product,
            'products' => $this->products,
            'brands' => $this->brands,
            'categoryId' => $this->categoryId,
        ]);
    }
}
