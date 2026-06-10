<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;

#[Layout('components.shop-layout')]
class Checkout extends Component
{


    // Step management
    public $currentStep = 1;
    public $totalSteps = 4; // Changed to 4 steps

    // Customer Information
    public $firstName = '';
    public $lastName = '';
    public $email = '';
    public $phone = '';

    // Shipping Address
    public $address = '';
    public $apartment = '';
    public $city = '';
    public $state = '';
    public $zipCode = '';
    public $country = 'US';

    // Different address option
    public $differentShippingAddress = false;
    public $shippingAddress = '';
    public $shippingApartment = '';
    public $shippingCity = '';
    public $shippingState = '';
    public $shippingZipCode = '';
    public $shippingCountry = 'US';

    // Payment Method
    public $paymentMethod = 'credit_card';
    public $selectedBank = '';
    public $mobileNumber = '';
    public $transactionId = '';

    // Card Details (for credit card)
    public $cardNumber = '';
    public $cardName = '';
    public $expiryMonth = '';
    public $expiryYear = '';
    public $cvv = '';

    // Bank Transfer Details
    public $banks = [
        'chase' => 'Chase Bank',
        'bank_of_america' => 'Bank of America',
        'wells_fargo' => 'Wells Fargo',
        'citi' => 'Citibank',
    ];

    // Mobile Payment
    public $mobilePaymentMethods = [
        'bkash' => 'bKash',
        'nagad' => 'Nagad',
        'rocket' => 'Rocket',
        'upay' => 'Upay',
    ];

    // Order notes
    public $orderNotes = '';

    // Cart data
    public $cart = [];
    public $cartTotal = 0;
    public $cartCount = 0;
    public $shippingCost = 0;
    public $taxRate = 0.1;
    public $taxAmount = 0;
    public $grandTotal = 0;
    public $orderPlaced = false;
    public $orderNumber = '';

    // Countries list
    public $countries = [
        'US' => 'United States',
        'CA' => 'Canada',
        'UK' => 'United Kingdom',
        'AU' => 'Australia',
        'DE' => 'Germany',
        'FR' => 'France',
    ];

    public $expiryMonths = [];
    public $expiryYears = [];

    public function mount()
    {
        $this->loadCart();
        $this->populateExpiryDates();
    }

    public function populateExpiryDates()
    {
        for ($i = 1; $i <= 12; $i++) {
            $this->expiryMonths[] = sprintf('%02d', $i);
        }

        $currentYear = date('Y');
        for ($i = 0; $i <= 10; $i++) {
            $this->expiryYears[] = $currentYear + $i;
        }
    }

    public function loadCart()
    {
        $this->cart = Session::get('cart', []);
        $this->cartCount = array_sum(array_column($this->cart, 'quantity'));
        $this->cartTotal = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $this->cart));

        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $subtotal = $this->cartTotal;
        $this->shippingCost = $subtotal >= 50 ? 0 : 10;
        $this->taxAmount = ($subtotal + $this->shippingCost) * $this->taxRate;
        $this->grandTotal = $subtotal + $this->shippingCost + $this->taxAmount;
    }

    public function nextStep()
    {
        $this->validateCurrentStep();

        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    

    public function validateCurrentStep()
    {
        $rules = [];

        switch ($this->currentStep) {
            case 1:
                $rules = [
                    'firstName' => 'required|string|max:100',
                    'lastName' => 'required|string|max:100',
                    'email' => 'required|email|max:255',
                    'phone' => 'required|string|max:20',
                    'address' => 'required|string|max:255',
                    'city' => 'required|string|max:100',
                    'state' => 'required|string|max:100',
                    'zipCode' => 'required|string|max:20',
                    'country' => 'required|string|max:2',
                ];

                if ($this->differentShippingAddress) {
                    $rules['shippingAddress'] = 'required|string|max:255';
                    $rules['shippingCity'] = 'required|string|max:100';
                    $rules['shippingState'] = 'required|string|max:100';
                    $rules['shippingZipCode'] = 'required|string|max:20';
                    $rules['shippingCountry'] = 'required|string|max:2';
                }
                break;

            case 2:
                if ($this->paymentMethod === 'credit_card') {
                    $rules = [
                        'cardNumber' => 'required|string|min:15|max:16',
                        'cardName' => 'required|string|max:100',
                        'expiryMonth' => 'required|string',
                        'expiryYear' => 'required|string',
                        'cvv' => 'required|string|min:3|max:4',
                    ];
                } elseif ($this->paymentMethod === 'bank_transfer') {
                    $rules = [
                        'selectedBank' => 'required|string',
                    ];
                } elseif ($this->paymentMethod === 'mobile_payment') {
                    $rules = [
                        'mobileNumber' => 'required|string|min:10|max:15',
                    ];
                }
                break;
        }

       
        if (!empty($rules)) {
            $this->validate(rules: $rules);
        }
    }

    

    public function placeOrder()
{
    $this->validateCurrentStep();

    if (empty($this->cart)) {
        session()->flash('error', 'Your cart is empty.');
        return redirect()->route('shop');
    }

    $this->orderNumber = 'ORD-' . strtoupper(uniqid());

    // ✅ 1. Order save 
    $order = \App\Models\Order::create([
        'order_number'   => $this->orderNumber,
        'user_id'        => auth()->id() ?? null,
        'first_name'     => $this->firstName,
        'last_name'      => $this->lastName,
        'email'          => $this->email,
        'phone'          => $this->phone,
        'payment_method' => $this->paymentMethod,
        'subtotal'       => $this->cartTotal,
        'shipping_cost'  => $this->shippingCost,
        'tax_amount'     => $this->taxAmount,
        'grand_total'    => $this->grandTotal,
        'order_notes'    => $this->orderNotes,
        'status'         => 'pending',
    ]);

    // ✅ 2. Shipping details save 
    \App\Models\ShippingDetail::create([
        'order_id'           => $order->id,
        'address'            => $this->address,
        'apartment'          => $this->apartment,
        'city'               => $this->city,
        'state'              => $this->state,
        'zip_code'           => $this->zipCode,
        'country'            => $this->country,
        'different_shipping' => $this->differentShippingAddress,
        'shipping_address'   => $this->shippingAddress,
        'shipping_apartment' => $this->shippingApartment,
        'shipping_city'      => $this->shippingCity,
        'shipping_state'     => $this->shippingState,
        'shipping_zip_code'  => $this->shippingZipCode,
        'shipping_country'   => $this->shippingCountry,
    ]);

    // ✅ 3. Order items save 
    foreach ($this->cart as $item) {
        \App\Models\OrderItem::create([
            'order_id'     => $order->id,
            'product_id'   => $item['id'],
            'product_name' => $item['name'],
            'price'        => $item['price'],
            'quantity'     => $item['quantity'],
            'subtotal'     => $item['price'] * $item['quantity'],
        ]);
    }

    Session::forget('cart');
    $this->dispatch('cart-updated');
    $this->orderPlaced = true;
    $this->currentStep = 4;
}

    public function continueShopping()
    {
        return redirect()->route('shop');
    }

    public function render()
    {
        if (empty($this->cart) && !$this->orderPlaced) {
            return redirect()->route('shop')->with('error', 'Your cart is empty.');
        }

        return view('livewire.user.checkout');
    }
}
