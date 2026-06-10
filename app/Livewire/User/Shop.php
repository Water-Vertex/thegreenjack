<?php

namespace App\Livewire\User;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

#[Layout('components.shop-layout')]
class Shop extends Component
{
    public $addingToCart = null; // Track which product is being added

    public function addToCart($productId, $quantity = 1)
    {
        // Set loading state for this product
        $this->addingToCart = $productId;

        $product = Product::find($productId);

        if (!$product || $product->stock < $quantity) {
            session()->flash('error', 'Product not available in requested quantity.');
            $this->addingToCart = null;
            return;
        }

        $cart = Session::get('cart', []);
        $price = $product->discounted_price > 0 ? $product->discounted_price : $product->price;

        if (isset($cart[$productId])) {
            $newQuantity = $cart[$productId]['quantity'] + $quantity;
            if ($newQuantity > $product->stock) {
                session()->flash('error', 'Cannot add more than available stock.');
                $this->addingToCart = null;
                return;
            }
            $cart[$productId]['quantity'] = $newQuantity;
            session()->flash('success', 'Cart updated successfully!');
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
            session()->flash('success', 'Product added to cart!');
        }

        Session::put('cart', $cart);
        $this->dispatch('cart-updated');

        // Clear loading state
        $this->addingToCart = null;
    }

    public function render()
    {
        $products = Product::with('category')->where('is_active', true)->get();
        $categories = Category::get();
        return view('livewire.user.shop', get_defined_vars());
    }
}
