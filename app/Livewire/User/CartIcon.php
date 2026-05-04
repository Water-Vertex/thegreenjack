<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class CartIcon extends Component
{
    public $cartCount = 0;
    public $cartTotal = 0;
    public $cartItems = [];

    protected $listeners = ['cart-updated' => 'loadCart'];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $cart = Session::get('cart', []);
        $this->cartCount = array_sum(array_column($cart, 'quantity'));
        $this->cartTotal = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));
        $this->cartItems = $cart;
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
        return view('livewire.user.cart-icon');
    }
}
