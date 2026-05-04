<div class="relative cart-wrapper" x-data="{ open: false }">
    <button @click="open = !open" class="flex flex-col items-center text-gray-600 hover:text-[#5B9F01] transition">
        <div class="relative">
            <i class="fas fa-shopping-bag text-xl"></i>
            @if($cartCount > 0)
                <span class="absolute -top-2 -right-3 bg-[#5B9F01] text-white text-[10px] font-bold rounded-full min-w-[18px] h-[18px] flex items-center justify-center px-1">
                    {{ $cartCount }}
                </span>
            @endif
        </div>
        <span class="text-[10px] mt-0.5 hidden md:block">Cart</span>
    </button>

    <!-- Cart Dropdown -->
    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-3 w-96 bg-white rounded-xl shadow-xl border border-gray-100 z-50"
         x-cloak>
        <div class="p-4">
            <h4 class="font-semibold text-gray-800 pb-2 border-b">Shopping Cart ({{ $cartCount }})</h4>

            @if(count($cartItems) > 0)
                <div class="py-3 space-y-3 max-h-96 overflow-y-auto">
                    @foreach($cartItems as $item)
                        <div class="flex gap-3">
                            <img src="{{ asset('storage/' . $item['image']) }}"
                                 class="w-12 h-12 rounded object-cover"
                                 onerror="this.src='https://placehold.co/60x60/e2e8f0/475569?text=No+Image'">
                            <div class="flex-1">
                                <p class="text-sm font-medium line-clamp-2">{{ $item['name'] }}</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <div class="flex items-center border border-gray-200 rounded">
                                        <button wire:click="updateQuantity({{ $item['id'] }}, {{ $item['quantity'] - 1 }})"
                                                class="w-6 h-6 flex items-center justify-center text-gray-500 hover:bg-gray-100">-</button>
                                        <span class="w-8 text-center text-sm">{{ $item['quantity'] }}</span>
                                        <button wire:click="updateQuantity({{ $item['id'] }}, {{ $item['quantity'] + 1 }})"
                                                class="w-6 h-6 flex items-center justify-center text-gray-500 hover:bg-gray-100">+</button>
                                    </div>
                                    <span class="text-sm font-semibold text-[#5B9F01]">${{ number_format($item['price'], 2) }}</span>
                                </div>
                            </div>
                            <button wire:click="removeItem({{ $item['id'] }})" class="text-gray-400 hover:text-red-500">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endforeach
                </div>

                <div class="pt-3 border-t">
                    <div class="flex justify-between mb-3">
                        <span class="text-sm font-medium">Subtotal:</span>
                        <span class="text-sm font-bold">${{ number_format($cartTotal, 2) }}</span>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('cart.page') }}" wire:navigate class="flex-1 text-center border border-gray-300 py-2 rounded-lg text-sm hover:bg-gray-50 transition">View Cart</a>
                        <a href="{{ route('checkout') }}" wire:navigate class="flex-1 text-center bg-[#5B9F01] text-white py-2 rounded-lg text-sm hover:bg-[#4a7f01] transition">Checkout</a>
                    </div>
                </div>
            @else
                <div class="py-8 text-center">
                    <i class="fas fa-shopping-bag text-4xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500">Your cart is empty</p>
                    <a href="{{ route('shop') }}" class="inline-block mt-3 text-[#5B9F01] text-sm hover:underline">Continue Shopping</a>
                </div>
            @endif
        </div>
    </div>
    <style>
    [x-cloak] { display: none !important; }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

</div>

