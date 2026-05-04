<div class="container mx-auto px-4 max-w-7xl py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Shopping Cart</h1>

    @if(count($cartItems) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="divide-y divide-gray-200">
                        @foreach($cartItems as $item)
                            <div class="p-4 flex gap-4">
                                <img src="{{ asset('storage/' . $item['image']) }}" class="w-24 h-24 rounded object-cover">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-800">{{ $item['name'] }}</h3>
                                    <p class="text-sm text-gray-500">Price: ${{ number_format($item['price'], 2) }}</p>
                                    <div class="flex items-center gap-3 mt-2">
                                        <div class="flex items-center border border-gray-300 rounded">
                                            <button wire:click="updateQuantity({{ $item['id'] }}, {{ $item['quantity'] - 1 }})" class="w-8 h-8 flex items-center justify-center hover:bg-gray-100">-</button>
                                            <span class="w-12 text-center">{{ $item['quantity'] }}</span>
                                            <button wire:click="updateQuantity({{ $item['id'] }}, {{ $item['quantity'] + 1 }})" class="w-8 h-8 flex items-center justify-center hover:bg-gray-100">+</button>
                                        </div>
                                        <button wire:click="removeItem({{ $item['id'] }})" class="text-red-500 text-sm hover:underline">Remove</button>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-800">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Order Summary</h2>
                    <div class="space-y-2 border-b pb-4">
                        <div class="flex justify-between">
                            <span>Subtotal ({{ $cartCount }} items)</span>
                            <span>${{ number_format($cartTotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>
                    </div>
                    <div class="flex justify-between pt-4 mb-4">
                        <span class="font-bold text-lg">Total</span>
                        <span class="font-bold text-xl text-[#5B9F01]">${{ number_format($cartTotal, 2) }}</span>
                    </div>
                    <a href="{{ route('checkout') }}" class="block w-full bg-[#5B9F01] text-white py-3 rounded-lg font-semibold text-center hover:bg-[#4a7f01] transition">
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm p-12 text-center">
            <i class="fas fa-shopping-cart text-6xl text-gray-300 mb-4"></i>
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Your cart is empty</h2>
            <p class="text-gray-500 mb-6">Looks like you haven't added any items to your cart yet.</p>
            <a href="{{ route('shop') }}" class="inline-block bg-[#5B9F01] text-white px-6 py-3 rounded-lg hover:bg-[#4a7f01] transition">
                Continue Shopping
            </a>
        </div>
    @endif
</div>
