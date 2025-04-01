<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <link href="{{ asset('css/nav.css') }}" rel="stylesheet">
    <style>
        .payment-method {
            border: 2px solid #e5e7eb;
            background-color: white;
            transition: all 0.3s ease;
        }
        .payment-method.active {
            border-color: #000;
            background-color: #f9fafb;
        }
        .check-icon {
            display: none;
        }
        .payment-method.active .check-icon {
            display: block;
        }
    </style>
    <title>Checkout</title>
</head>

<body class="bg-gray-100">
    <x-nav></x-nav>

    <div class="min-h-screen bg-gray-100 p-4 md:p-6 lg:p-8">
        <form id="payment-form" action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="payment_method" id="selected_payment_method" required>

            <div class="max-w-7xl mx-auto lg:flex lg:gap-8">
                <!-- Left Column -->
                <div class="lg:w-2/3">
                    <!-- Contact Section -->
                    <div class="bg-white rounded-lg shadow-sm p-4 md:p-6 mb-6">
                        <h2 class="text-3xl font-semibold mb-4 md:mb-6">CONTACT</h2>
                        <div class="mb-5">
                            <label class="block text-xl font-medium text-gray-700 mb-3">Email</label>
                            <input type="email" name="email" required
                                class="w-full px-5 py-4 border-2 rounded-lg text-xl @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="text-red-500 text-xl mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-5">
                            <label class="block text-xl font-medium text-gray-700 mb-3">Personnalisation</label>
                            <input type="text" name="text" required maxlength="8" placeholder="Entrez votre texte ici (8 caractères maximum)"
                                class="w-full px-5 py-4 border-2 rounded-lg text-xl @error('text') border-red-500 @enderror">
                            @error('text')
                                <p class="text-red-500 text-xl mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <!-- Delivery Section -->
                    <div class="bg-white rounded-lg shadow-sm p-4 md:p-6">
                        <h2 class="text-3xl font-semibold mb-4 md:mb-6">DELIVERY</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                            <div>
                                <label class="block text-xl font-medium text-gray-700 mb-3">First name</label>
                                <input type="text" name="first_name" required class="w-full px-5 py-4 border-2 rounded-lg text-xl">
                            </div>
                            <div>
                                <label class="block text-xl font-medium text-gray-700 mb-3">Last name</label>
                                <input type="text" name="last_name" required class="w-full px-5 py-4 border-2 rounded-lg text-xl">
                            </div>
                        </div>
                        <div class="mb-5">
                            <label class="block text-xl font-medium text-gray-700 mb-3">Address</label>
                            <input type="text" name="address" required class="w-full px-5 py-4 border-2 rounded-lg text-xl">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                            <div>
                                <label class="block text-xl font-medium text-gray-700 mb-3">City</label>
                                <input type="text" name="city" required class="w-full px-5 py-4 border-2 rounded-lg text-xl">
                            </div>
                            <div>
                                <label class="block text-xl font-medium text-gray-700 mb-3">Postal code</label>
                                <input type="text" name="postal_code" class="w-full px-5 py-4 border-2 rounded-lg text-xl">
                            </div>
                        </div>
                        <div class="mb-5">
                            <label class="block text-xl font-medium text-gray-700 mb-3">Phone</label>
                            <div class="flex">
                                <span class="inline-flex items-center px-5 border-2 border-r-0 rounded-l-lg bg-gray-50 text-xl">+33</span>
                                <input type="tel" name="phone" required class="w-full px-5 py-4 border-2 rounded-r-lg text-xl">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="lg:w-1/3 mt-6 lg:mt-0">
                    <div class="bg-white rounded-lg shadow-sm p-4 md:p-6">
                        <h2 class="text-3xl font-semibold mb-4 md:mb-6">Your Order</h2>
                        <div class="border-b pb-5 mb-5">
                            <div class="flex justify-between mb-3">
                                <span class="text-xl">{{ $product->name }}</span>
                                <span class="text-xl">{{ $product->price }} €</span>
                            </div>
                            <p class="text-lg md:text-xl text-gray-500">{{ $product->category }} / {{ $product->size }}</p>
                            <div class="flex items-center justify-between mt-4">
                                <span class="text-xl font-medium text-gray-700">Quantity</span>
                                <div class="flex items-center gap-1">
                                    <button type="button" class="quantity-minus p-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 active:scale-95">
                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                        </svg>
                                    </button>
                                    <input type="number" name="quantity" value="1" min="1" 
                                           class="w-20 h-11 text-center border border-gray-300 rounded-lg mx-1 text-xl font-medium focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors duration-200 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                    <button type="button" class="quantity-plus p-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 active:scale-95">
                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-5">
                            <div class="flex justify-between font-medium text-2xl">
                                <span>Total</span>
                                <span id="total-price">{{ number_format($product->price, 2) }} €</span>
                            </div>
                        </div>

                        <!-- Payment Methods -->
                        <div class="mb-6 mt-8">
                            <h3 class="text-xl font-semibold mb-4">Payment Methods</h3>
                            @error('payment_method')
                                <p class="text-red-500 text-xl mb-2">{{ $message }}</p>
                            @enderror
                            <div class="space-y-3">
                                <!-- Credit Card -->
                                <div class="payment-method rounded-lg p-4 cursor-pointer"
                                    data-method="card">
                                    <div class="flex items-center gap-4">
                                        <i class="bx bx-credit-card text-3xl"></i>
                                        <div class="flex-1">
                                            <span class="text-xl">Credit/Debit Card</span>
                                            <p class="text-gray-500 text-lg">Visa, Mastercard, American Express</p>
                                        </div>
                                        <i class="bx bx-check check-icon text-2xl text-green-500"></i>
                                    </div>
                                </div>

                                <!-- PayPal -->
                                <div class="payment-method rounded-lg p-4 cursor-pointer"
                                    data-method="paypal">
                                    <div class="flex items-center gap-4">
                                        <i class="bx bxl-paypal text-3xl"></i>
                                        <div class="flex-1">
                                            <span class="text-xl">PayPal</span>
                                            <p class="text-gray-500 text-lg">Secured online payment</p>
                                        </div>
                                        <i class="bx bx-check check-icon text-2xl text-green-500"></i>
                                    </div>
                                </div>

                                <!-- Apple Pay -->
                                <div class="payment-method rounded-lg p-4 cursor-pointer"
                                    data-method="card">
                                    <div class="flex items-center gap-4">
                                        <i class="bx bxl-apple text-3xl"></i>
                                        <div class="flex-1">
                                            <span class="text-xl">Apple Pay</span>
                                            <p class="text-gray-500 text-lg">Pay with Apple device</p>
                                        </div>
                                        <i class="bx bx-check check-icon text-2xl text-green-500"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" 
                            class="w-full mt-6 bg-black text-white py-5 text-2xl rounded-lg hover:bg-gray-800 transition">
                            Proceed to Payment
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentMethods = document.querySelectorAll('.payment-method');
        const paymentMethodInput = document.getElementById('selected_payment_method');
        const form = document.getElementById('payment-form');
        const quantityInput = document.querySelector('input[name="quantity"]');
        const minusButton = document.querySelector('.quantity-minus');
        const plusButton = document.querySelector('.quantity-plus');
        const totalPriceElement = document.getElementById('total-price');
        const productPrice = parseFloat({{ $product->price }});

        // Initialize first payment method as selected
        paymentMethods[0].classList.add('active');
        paymentMethodInput.value = paymentMethods[0].dataset.method;

        paymentMethods.forEach(method => {
            method.addEventListener('click', function() {
                // Remove active class from all methods
                paymentMethods.forEach(m => m.classList.remove('active'));
                
                // Add active class to selected method
                this.classList.add('active');
                
                // Set the selected payment method value
                paymentMethodInput.value = this.dataset.method;
            });
        });

        form.addEventListener('submit', function(e) {
            if (!paymentMethodInput.value) {
                e.preventDefault();
                alert('Please select a payment method');
            }
        });


        function updateTotal() {
            const quantity = parseInt(quantityInput.value, 10);
            const total = productPrice * quantity;
            totalPriceElement.textContent = total.toFixed(2) + ' €';
        }

        minusButton.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value, 10);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
                updateTotal();
            }
        });

        plusButton.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value, 10);
            quantityInput.value = currentValue + 1;
            updateTotal();
        });

        quantityInput.addEventListener('input', function() {
            let currentValue = parseInt(this.value, 10) || 1;
            if (currentValue < 1) {
                currentValue = 1;
            }
            this.value = currentValue;
            updateTotal();
        });

        // Initialize total on load
        updateTotal();
    });
    </script>
</body>
</html>