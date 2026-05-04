<div>
    <div class="bg-gray-50 py-8 min-h-screen">
        <div class="container mx-auto px-4 max-w-7xl">
            <!-- Breadcrumb -->
            <div class="mb-6">
                <nav class="flex items-center gap-2 text-sm text-gray-500">
                    <a href="{{ route('home') }}" wire:navigate class="hover:text-[#5B9F01] transition">Home</a>
                    <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                    <a href="{{ route('shop') }}" wire:navigate class="hover:text-[#5B9F01] transition">Shop</a>
                    <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                    <a href="{{ route('cart.page') }}" wire:navigate class="hover:text-[#5B9F01] transition">Cart</a>
                    <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                    <span class="text-gray-800 font-medium">Checkout</span>
                </nav>
            </div>

            <!-- Order Confirmation Screen -->
            @if($orderPlaced)
            <div class="bg-white rounded-xl shadow-sm p-12 text-center max-w-2xl mx-auto">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-check-circle text-4xl text-green-600"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-3">Order Confirmed!</h1>
                <p class="text-gray-600 mb-2">Thank you for your purchase, {{ $firstName }}!</p>
                <p class="text-gray-500 text-sm mb-6">Your order number is: <strong class="text-[#5B9F01]">{{ $orderNumber }}</strong></p>

                <div class="bg-gray-50 rounded-lg p-6 mb-6 text-left">
                    <h3 class="font-semibold text-gray-800 mb-3">Order Details</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal:</span>
                            <span>${{ number_format($cartTotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Shipping:</span>
                            <span>{{ $shippingCost > 0 ? '$' . number_format($shippingCost, 2) : 'Free' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tax:</span>
                            <span>${{ number_format($taxAmount, 2) }}</span>
                        </div>
                        <div class="border-t pt-2 mt-2">
                            <div class="flex justify-between font-bold text-gray-800">
                                <span>Total:</span>
                                <span class="text-[#5B9F01]">${{ number_format($grandTotal, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex gap-4 justify-center">
                    <button wire:click="continueShopping" class="bg-[#5B9F01] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#4a7f01] transition">
                        Continue Shopping
                    </button>
                    <a href="{{ route('shop') }}" class="border border-gray-300 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-50 transition">
                        View Orders
                    </a>
                </div>

                <div class="mt-6 text-center text-xs text-gray-400">
                    <p>A confirmation email has been sent to <strong>{{ $email }}</strong></p>
                </div>
            </div>
            @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Checkout Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <!-- Step Progress Bar -->
                        <div class="border-b border-gray-200 p-6">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center">
                                        <!-- Step 1 -->
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $currentStep >= 1 ? 'bg-[#5B9F01] text-white' : 'bg-gray-200 text-gray-600' }}">
                                                1
                                            </div>
                                            <div class="ml-2 hidden md:block">
                                                <p class="text-sm font-medium">Shipping</p>
                                                <p class="text-xs text-gray-500">Address info</p>
                                            </div>
                                        </div>
                                        <div class="flex-1 h-0.5 mx-4 {{ $currentStep >= 2 ? 'bg-[#5B9F01]' : 'bg-gray-200' }}"></div>

                                        <!-- Step 2 -->
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $currentStep >= 2 ? 'bg-[#5B9F01] text-white' : 'bg-gray-200 text-gray-600' }}">
                                                2
                                            </div>
                                            <div class="ml-2 hidden md:block">
                                                <p class="text-sm font-medium">Payment</p>
                                                <p class="text-xs text-gray-500">Select method</p>
                                            </div>
                                        </div>
                                        <div class="flex-1 h-0.5 mx-4 {{ $currentStep >= 3 ? 'bg-[#5B9F01]' : 'bg-gray-200' }}"></div>

                                        <!-- Step 3 -->
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $currentStep >= 3 ? 'bg-[#5B9F01] text-white' : 'bg-gray-200 text-gray-600' }}">
                                                3
                                            </div>
                                            <div class="ml-2 hidden md:block">
                                                <p class="text-sm font-medium">Confirm</p>
                                                <p class="text-xs text-gray-500">Review order</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-6">
                            <!-- Step 1: Shipping Information -->
                            @if($currentStep == 1)
                            <div>
                                <h2 class="text-xl font-bold text-gray-800 mb-4">Shipping Information</h2>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">First Name *</label>
                                        <input type="text" wire:model="firstName" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#5B9F01]">
                                        @error('firstName') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Last Name *</label>
                                        <input type="text" wire:model="lastName" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#5B9F01]">
                                        @error('lastName') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                                        <input type="email" wire:model="email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#5B9F01]">
                                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number *</label>
                                        <input type="tel" wire:model="phone" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#5B9F01]">
                                        @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Street Address *</label>
                                    <input type="text" wire:model="address" placeholder="House number and street name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#5B9F01]">
                                    @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Apartment, suite, etc. (optional)</label>
                                    <input type="text" wire:model="apartment" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#5B9F01]">
                                </div>

                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">City *</label>
                                        <input type="text" wire:model="city" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#5B9F01]">
                                        @error('city') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">State *</label>
                                        <input type="text" wire:model="state" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#5B9F01]">
                                        @error('state') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">ZIP Code *</label>
                                        <input type="text" wire:model="zipCode" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#5B9F01]">
                                        @error('zipCode') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Country *</label>
                                        <select wire:model="country" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#5B9F01]">
                                            @foreach($countries as $code => $name)
                                                <option value="{{ $code }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox" wire:model="differentShippingAddress" class="rounded border-gray-300 text-[#5B9F01] focus:ring-[#5B9F01]">
                                        <span class="text-sm text-gray-700">Ship to a different address?</span>
                                    </label>
                                </div>

                                @if($differentShippingAddress)
                                <div class="border border-gray-200 rounded-lg p-4 mb-4 bg-gray-50">
                                    <h3 class="font-semibold text-gray-800 mb-3">Shipping Address</h3>
                                    <div class="grid grid-cols-1 gap-3">
                                        <input type="text" wire:model="shippingAddress" placeholder="Street Address" class="px-3 py-2 border border-gray-300 rounded-lg">
                                        <input type="text" wire:model="shippingApartment" placeholder="Apartment (optional)" class="px-3 py-2 border border-gray-300 rounded-lg">
                                        <div class="grid grid-cols-2 gap-3">
                                            <input type="text" wire:model="shippingCity" placeholder="City" class="px-3 py-2 border border-gray-300 rounded-lg">
                                            <input type="text" wire:model="shippingState" placeholder="State" class="px-3 py-2 border border-gray-300 rounded-lg">
                                            <input type="text" wire:model="shippingZipCode" placeholder="ZIP Code" class="px-3 py-2 border border-gray-300 rounded-lg">
                                            <select wire:model="shippingCountry" class="px-3 py-2 border border-gray-300 rounded-lg">
                                                @foreach($countries as $code => $name)
                                                    <option value="{{ $code }}">{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endif

                            <!-- Step 2: Payment Method -->
                            @if($currentStep == 2)
                            <div>
                                <h2 class="text-xl font-bold text-gray-800 mb-4">Payment Method</h2>

                                <div class="space-y-4">
                                    <!-- Credit Card Option -->
                                    <div class="border rounded-lg {{ $paymentMethod == 'credit_card' ? 'border-[#5B9F01] bg-[#5B9F01]/5' : 'border-gray-200' }}">
                                        <label class="flex items-start gap-3 p-4 cursor-pointer">
                                            <input type="radio" wire:model="paymentMethod" value="credit_card" class="mt-1">
                                            <div class="flex-1">
                                                <div class="flex items-center justify-between">
                                                    <span class="font-medium text-gray-800">Credit / Debit Card</span>
                                                    <div class="flex gap-2">
                                                        <i class="fab fa-cc-visa text-2xl text-blue-600"></i>
                                                        <i class="fab fa-cc-mastercard text-2xl text-orange-600"></i>
                                                        <i class="fab fa-cc-amex text-2xl text-blue-400"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>

                                        @if($paymentMethod == 'credit_card')
                                        <div class="border-t border-gray-200 p-4 bg-gray-50 rounded-b-lg">
                                            <div class="space-y-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Card Number *</label>
                                                    <input type="text" wire:model="cardNumber" placeholder="1234 5678 9012 3456" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                                    @error('cardNumber') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Name on Card *</label>
                                                    <input type="text" wire:model="cardName" placeholder="John Doe" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                                    @error('cardName') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="flex gap-4">
                                                    <div class="flex-1">
                                                        <label class="block text-sm font-medium text-gray-700 mb-1">Expiry Month</label>
                                                        <select wire:model="expiryMonth" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                                            <option value="">Month</option>
                                                            @foreach($expiryMonths as $month)
                                                                <option value="{{ $month }}">{{ $month }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="flex-1">
                                                        <label class="block text-sm font-medium text-gray-700 mb-1">Expiry Year</label>
                                                        <select wire:model="expiryYear" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                                            <option value="">Year</option>
                                                            @foreach($expiryYears as $year)
                                                                <option value="{{ $year }}">{{ $year }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="w-24">
                                                        <label class="block text-sm font-medium text-gray-700 mb-1">CVV</label>
                                                        <input type="text" wire:model="cvv" placeholder="123" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                                        @error('cvv') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                                    <!-- Bank Transfer Option -->
                                    <div class="border rounded-lg {{ $paymentMethod == 'bank_transfer' ? 'border-[#5B9F01] bg-[#5B9F01]/5' : 'border-gray-200' }}">
                                        <label class="flex items-start gap-3 p-4 cursor-pointer">
                                            <input type="radio" wire:model="paymentMethod" value="bank_transfer" class="mt-1">
                                            <div class="flex-1">
                                                <div class="flex items-center justify-between">
                                                    <span class="font-medium text-gray-800">Bank Transfer</span>
                                                    <i class="fas fa-university text-2xl text-gray-600"></i>
                                                </div>
                                                <p class="text-xs text-gray-500 mt-1">Direct bank transfer</p>
                                            </div>
                                        </label>

                                        @if($paymentMethod == 'bank_transfer')
                                        <div class="border-t border-gray-200 p-4 bg-gray-50 rounded-b-lg">
                                            <div class="mb-4">
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Select Bank *</label>
                                                <select wire:model="selectedBank" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                                    <option value="">Select a bank</option>
                                                    @foreach($banks as $code => $name)
                                                        <option value="{{ $code }}">{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('selectedBank') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="bg-blue-50 p-3 rounded-lg">
                                                <p class="text-xs text-blue-800">After placing order, you'll receive bank details to complete the transfer.</p>
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                                    <!-- Mobile Payment Option -->
                                    <div class="border rounded-lg {{ $paymentMethod == 'mobile_payment' ? 'border-[#5B9F01] bg-[#5B9F01]/5' : 'border-gray-200' }}">
                                        <label class="flex items-start gap-3 p-4 cursor-pointer">
                                            <input type="radio" wire:model="paymentMethod" value="mobile_payment" class="mt-1">
                                            <div class="flex-1">
                                                <div class="flex items-center justify-between">
                                                    <span class="font-medium text-gray-800">Mobile Payment</span>
                                                    <i class="fas fa-mobile-alt text-2xl text-gray-600"></i>
                                                </div>
                                                <p class="text-xs text-gray-500 mt-1">Pay with bKash, Nagad, Rocket</p>
                                            </div>
                                        </label>

                                        @if($paymentMethod == 'mobile_payment')
                                        <div class="border-t border-gray-200 p-4 bg-gray-50 rounded-b-lg">
                                            <div class="mb-4">
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Mobile Number *</label>
                                                <input type="tel" wire:model="mobileNumber" placeholder="01XXXXXXXXX" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                                @error('mobileNumber') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="flex gap-2 flex-wrap">
                                                @foreach($mobilePaymentMethods as $code => $name)
                                                    <span class="px-3 py-1 bg-gray-200 rounded-full text-xs">{{ $name }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                                    <!-- Cash on Delivery Option -->
                                    <div class="border rounded-lg {{ $paymentMethod == 'cod' ? 'border-[#5B9F01] bg-[#5B9F01]/5' : 'border-gray-200' }}">
                                        <label class="flex items-start gap-3 p-4 cursor-pointer">
                                            <input type="radio" wire:model="paymentMethod" value="cod" class="mt-1">
                                            <div class="flex-1">
                                                <div class="flex items-center gap-2">
                                                    <span class="font-medium text-gray-800">Cash on Delivery</span>
                                                    <span class="text-xs text-gray-500">Pay when you receive</span>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Order Notes (optional)</label>
                                    <textarea wire:model="orderNotes" rows="3" placeholder="Special instructions for delivery..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#5B9F01]"></textarea>
                                </div>
                            </div>
                            @endif

                            <!-- Step 3: Confirm Order -->
                            @if($currentStep == 3)
                            <div>
                                <h2 class="text-xl font-bold text-gray-800 mb-4">Review Your Order</h2>

                                <div class="space-y-6">
                                    <div class="border-b pb-4">
                                        <h3 class="font-semibold text-gray-800 mb-2 flex items-center gap-2">
                                            <i class="fas fa-user text-[#5B9F01] text-sm"></i>
                                            Customer Information
                                        </h3>
                                        <p class="text-sm text-gray-600">{{ $firstName }} {{ $lastName }}</p>
                                        <p class="text-sm text-gray-600">{{ $email }} | {{ $phone }}</p>
                                    </div>

                                    <div class="border-b pb-4">
                                        <h3 class="font-semibold text-gray-800 mb-2 flex items-center gap-2">
                                            <i class="fas fa-map-marker-alt text-[#5B9F01] text-sm"></i>
                                            Shipping Address
                                        </h3>
                                        <p class="text-sm text-gray-600">{{ $address }}, {{ $apartment ? $apartment . ', ' : '' }}{{ $city }}, {{ $state }} {{ $zipCode }}, {{ $countries[$country] }}</p>
                                        @if($differentShippingAddress)
                                            <div class="mt-2 pt-2 border-t">
                                                <p class="text-xs text-gray-500 font-medium mb-1">Different Shipping Address:</p>
                                                <p class="text-sm text-gray-600">{{ $shippingAddress }}, {{ $shippingCity }}, {{ $shippingState }} {{ $shippingZipCode }}</p>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="border-b pb-4">
                                        <h3 class="font-semibold text-gray-800 mb-2 flex items-center gap-2">
                                            <i class="fas fa-credit-card text-[#5B9F01] text-sm"></i>
                                            Payment Method
                                        </h3>
                                        <p class="text-sm text-gray-600">
                                            @if($paymentMethod == 'credit_card')
                                                <i class="fab fa-cc-visa"></i> Credit/Debit Card - ending in {{ substr($cardNumber, -4) }}
                                            @elseif($paymentMethod == 'bank_transfer')
                                                <i class="fas fa-university"></i> Bank Transfer - {{ $banks[$selectedBank] ?? '' }}
                                            @elseif($paymentMethod == 'mobile_payment')
                                                <i class="fas fa-mobile-alt"></i> Mobile Payment - {{ $mobileNumber }}
                                            @else
                                                <i class="fas fa-money-bill-wave"></i> Cash on Delivery
                                            @endif
                                        </p>
                                        @if($orderNotes)
                                            <p class="text-sm text-gray-600 mt-2"><strong>Order Notes:</strong> {{ $orderNotes }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm p-6 sticky top-24">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Order Summary</h3>

                        <div class="space-y-3 max-h-80 overflow-y-auto mb-4">
                            @foreach($cart as $item)
                            <div class="flex gap-3">
                                <img src="{{ asset('storage/' . $item['image']) }}" class="w-16 h-16 rounded object-cover">
                                <div class="flex-1">
                                    <p class="text-sm font-medium line-clamp-2">{{ $item['name'] }}</p>
                                    <p class="text-xs text-gray-500">Qty: {{ $item['quantity'] }}</p>
                                    <p class="text-sm font-semibold text-[#5B9F01]">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="border-t pt-4 space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Subtotal ({{ $cartCount }} items)</span>
                                <span class="font-medium">${{ number_format($cartTotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Shipping</span>
                                <span class="font-medium">{{ $shippingCost > 0 ? '$' . number_format($shippingCost, 2) : 'Free' }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Tax ({{ $taxRate * 100 }}%)</span>
                                <span class="font-medium">${{ number_format($taxAmount, 2) }}</span>
                            </div>
                            <div class="border-t pt-2 mt-2">
                                <div class="flex justify-between text-lg font-bold">
                                    <span>Total</span>
                                    <span class="text-[#5B9F01]">${{ number_format($grandTotal, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex gap-3">
                            @if($currentStep > 1)
                            <button wire:click="previousStep" class="flex-1 border border-gray-300 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-50 transition">
                                Back
                            </button>
                            @endif

                            @if($currentStep < 3)
                            <button wire:click="nextStep" class="flex-1 bg-[#5B9F01] text-white py-3 rounded-lg font-semibold hover:bg-[#4a7f01] transition">
                                Continue
                            </button>
                            @else
                            <button wire:click="placeOrder" wire:loading.attr="disabled" class="flex-1 bg-[#5B9F01] text-white py-3 rounded-lg font-semibold hover:bg-[#4a7f01] transition flex items-center justify-center gap-2">
                                <span wire:loading.remove>Place Order</span>
                                <span wire:loading class="flex items-center gap-2">
                                    <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Processing...
                                </span>
                            </button>
                            @endif
                        </div>

                        <div class="mt-4 text-center">
                            <div class="flex items-center justify-center gap-2 text-xs text-gray-500">
                                <i class="fas fa-lock text-[#5B9F01]"></i>
                                <span>Secure checkout powered by The Green Jack</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
</div>


