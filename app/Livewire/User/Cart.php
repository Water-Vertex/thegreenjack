<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;

#[Layout('components.shop-layout')]

class Cart extends Component
{
    public $cartItems = [];
    public $cartTotal = 0;
    public $cartCount = 0;

    protected $listeners = ['cart-updated' => 'loadCart'];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $cart = Session::get('cart', []);
        $this->cartItems = $cart;
        $this->cartCount = array_sum(array_column($cart, 'quantity'));
        $this->cartTotal = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));
    }

    public function removeItem($productId)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
            $this->loadCart();
            $this->dispatch('cart-updated');
            session()->flash('success', 'Item removed from cart.');
        }
    }

    public function updateQuantity($productId, $quantity)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$productId])) {
            if ($quantity <= 0) {
                $this->removeItem($productId);
                return;
            }
            $cart[$productId]['quantity'] = $quantity;
            Session::put('cart', $cart);
            $this->loadCart();
            $this->dispatch('cart-updated');
        }
    }

    public function render()
    {
        return view('livewire.user.cart');
    }
}
