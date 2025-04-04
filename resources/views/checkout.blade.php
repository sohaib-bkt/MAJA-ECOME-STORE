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
    
        .shipping-method {
            border-color: #e5e7eb;
        }
        
        .shipping-method:hover {
            border-color: #C9B194;
            background-color: #fafafa;
        }
        
        .radio-indicator {
            transition: all 0.2s ease;
        }
        
        .shipping-method.active .inner-circle {
            transform: scale(1);
        }
        
        .shipping-method {
            position: relative;
            overflow: hidden;
        }
        
        .shipping-method::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 2px solid transparent;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }
        
    </style>
    <title>Checkout - MAJA</title>
</head>

<body class="bg-gray-100">
        <x-nav></x-nav>
    
        <div class="min-h-screen bg-gray-100 p-4 md:p-6 lg:p-8">
            <form id="payment-form" action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <input type="hidden" name="shipping_method" id="selected_shipping_method">
                <input type="hidden" name="total_price" id="total_price_value">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="payment_method" id="selected_payment_method" required>
                <input type="hidden" name="selected_size" value="{{ old('selected_size', $selectedSize ?? 'S/M') }}">  
                <div class="max-w-7xl mx-auto lg:flex lg:gap-8">
                    <!-- Left Column -->
                    <div class="lg:w-2/3">
                        <!-- Contact Section -->
                        <div class="bg-white rounded-lg shadow-sm p-4 md:p-6 mb-6">
                            <h2 class="text-3xl font-semibold mb-4 md:mb-6">CONTACT</h2>
                            <div class="mb-5">
                                <label class="block text-xl font-medium text-gray-700 mb-3">Email</label>
                                <input type="email" name="email" required
                                    class="w-full px-5 py-4 border-2 rounded-lg text-xl @error('email') border-red-500 @enderror"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <p class="text-red-500 text-xl mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label class="block text-xl font-medium text-gray-700 mb-3">Personnalisation</label>
                                <input type="text" name="text" required maxlength="5" 
                                       placeholder="Entrez votre texte ici (5 caractères maximum)"
                                       class="w-full px-5 py-4 border-2 rounded-lg text-xl @error('text') border-red-500 @enderror"
                                       value="{{ $selectedText  }}">
                                @error('text')
                                    <p class="text-red-500 text-xl mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
    
                        <!-- Delivery Section -->
                        <div class="bg-white rounded-lg shadow-sm p-4 md:p-6">
                            <h2 class="text-3xl font-semibold mb-4 md:mb-6">LIVRAISON</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                                <div>
                                    <label class="block text-xl font-medium text-gray-700 mb-3">Prénom</label>
                                    <input type="text" name="first_name" required 
                                           class="w-full px-5 py-4 border-2 rounded-lg text-xl @error('first_name') border-red-500 @enderror"
                                           value="{{ old('first_name') }}">
                                    @error('first_name')
                                        <p class="text-red-500 text-xl mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-xl font-medium text-gray-700 mb-3">Nom de famille</label>
                                    <input type="text" name="last_name" required 
                                           class="w-full px-5 py-4 border-2 rounded-lg text-xl @error('last_name') border-red-500 @enderror"
                                           value="{{ old('last_name') }}">
                                    @error('last_name')
                                        <p class="text-red-500 text-xl mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-5">
                                <label class="block text-xl font-medium text-gray-700 mb-3">Adresse</label>
                                <input type="text" name="address" required 
                                       class="w-full px-5 py-4 border-2 rounded-lg text-xl @error('address') border-red-500 @enderror"
                                       value="{{ old('address') }}">
                                @error('address')
                                    <p class="text-red-500 text-xl mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                                <div>
                                    <label class="block text-xl font-medium text-gray-700 mb-3">Ville</label>
                                    <input type="text" name="city" required 
                                           class="w-full px-5 py-4 border-2 rounded-lg text-xl @error('city') border-red-500 @enderror"
                                           value="{{ old('city') }}">
                                    @error('city')
                                        <p class="text-red-500 text-xl mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-xl font-medium text-gray-700 mb-3">Code postal</label>
                                    <input type="text" name="postal_code" required 
                                           class="w-full px-5 py-4 border-2 rounded-lg text-xl @error('postal_code') border-red-500 @enderror"
                                           value="{{ old('postal_code') }}">
                                    @error('postal_code')
                                        <p class="text-red-500 text-xl mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-5">
                                <label class="block text-xl font-medium text-gray-700 mb-3">Téléphone</label>
                                <div class="flex">
                                    <span class="inline-flex items-center px-5 border-2 border-r-0 rounded-l-lg bg-gray-50 text-xl">+33</span>
                                    <input type="tel" name="phone" required 
                                           class="w-full px-5 py-4 border-2 rounded-r-lg text-xl @error('phone') border-red-500 @enderror"
                                           value="{{ old('phone') }}">
                                </div>
                                @error('phone')
                                    <p class="text-red-500 text-xl mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                <!-- Right Column -->
                <div class="lg:w-1/3 mt-6 lg:mt-0">
                    <div class="bg-white rounded-lg shadow-sm p-4 md:p-6">
                        <h2 class="text-3xl font-semibold mb-4 md:mb-6">Votre commande</h2>
                        <div class="border-b pb-5 mb-5">
                            <div class="flex justify-between mb-3">
                                <span class="text-xl">{{ $product->name }}</span>
                                <span class="text-xl">{{ $product->price }} €</span>
                            </div>
                            <p class="text-lg md:text-xl text-gray-500">{{ $product->category }} / {{ $selectedSize ?? 'S/M' }}</p>
                            <div class="flex items-center justify-between mt-4">
                                <span class="text-xl font-medium text-gray-700">Quantité</span>
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

                        <!-- Shipping Methods -->
                        <div class="mb-6 mt-8">
                            <h3 class="text-xl font-semibold mb-4">Mode d'expédition</h3>
                            <div class="space-y-3 shipping-methods">
                                <!-- Mondial Relay -->
                                <div class="shipping-method rounded-lg p-4 cursor-pointer border-2 transition-colors"
                                    data-price="5.50"  data-carrier="Mondial Relay">
                                    <div class="flex items-center gap-4">
                                        <div class="shipping-radio flex items-center">
                                            <div class="radio-indicator w-5 h-5 rounded-full border-2 border-gray-300 
                                                    flex items-center justify-center mr-3">
                                                <div class="inner-circle w-3 h-3 rounded-full bg-[#C9B194] 
                                                        scale-0 transition-transform"></div>
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex justify-between items-center">
                                                <div>
                                                    <span class="text-xl font-medium">Mondial Relay</span>
                                                    <p class="text-gray-500 text-lg">Point Relais</p>
                                                </div>
                                                <span class="text-xl font-semibold text-[#C9B194]">5,50 €</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Colissimo -->
                                <div class="shipping-method rounded-lg p-4 cursor-pointer border-2 transition-colors"
                                    data-price="8.50" data-carrier="Colissimo">
                                    <div class="flex items-center gap-4">
                                        <div class="shipping-radio flex items-center">
                                            <div class="radio-indicator w-5 h-5 rounded-full border-2 border-gray-300 
                                                    flex items-center justify-center mr-3">
                                                <div class="inner-circle w-3 h-3 rounded-full bg-[#C9B194] 
                                                        scale-0 transition-transform"></div>
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex justify-between items-center">
                                                <div>
                                                    <span class="text-xl font-medium">Colissimo</span>
                                                    <p class="text-gray-500 text-lg">À domicile</p>
                                                </div>
                                                <span class="text-xl font-semibold text-[#C9B194]">8,50 €</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Section -->
                        <div class="space-y-5">
                            <div class="flex justify-between font-medium text-2xl">
                                <span>Sous-total</span>
                                <span id="subtotal-price">{{ number_format($product->price, 2) }} €</span>
                            </div>
                            <div class="flex justify-between font-medium text-2xl">
                                <span>Expédition</span>
                                <span id="shipping-price">0,00 €</span>
                            </div>
                            <div class="border-t pt-4">
                                <div class="flex justify-between font-bold text-2xl">
                                    <span>Total</span>
                                    <span id="total-price">{{ number_format($product->price, 2) }} €</span>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Methods -->
                        <div class="mb-6 mt-8">
                            <h3 class="text-xl font-semibold mb-4">Méthodes de paiement</h3>
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
                                            <span class="text-xl">Carte de crédit/débit</span>
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
                                            <p class="text-gray-500 text-lg">Paiement en ligne sécurisé</p>
                                        </div>
                                        <i class="bx bx-check check-icon text-2xl text-green-500"></i>
                                    </div>
                                </div>

                                <!-- Apple Pay -->
                                {{-- <div class="payment-method rounded-lg p-4 cursor-pointer"
                                    data-method="card">
                                    <div class="flex items-center gap-4">
                                        <i class="bx bxl-apple text-3xl"></i>
                                        <div class="flex-1">
                                            <span class="text-xl">Apple Pay</span>
                                            <p class="text-gray-500 text-lg">Payer avec un appareil Apple</p>
                                        </div>
                                        <i class="bx bx-check check-icon text-2xl text-green-500"></i>
                                    </div>
                                </div> --}}
                            </div>
                        </div>

                        <button type="submit" 
                            class="w-full mt-6 bg-black text-white py-5 text-2xl rounded-lg hover:bg-gray-800 transition">
                            Procéder au paiement
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elements communs
            const paymentMethods = document.querySelectorAll('.payment-method');
            const paymentMethodInput = document.getElementById('selected_payment_method');
            const form = document.getElementById('payment-form');
            const quantityInput = document.querySelector('input[name="quantity"]');
            const minusButton = document.querySelector('.quantity-minus');
            const plusButton = document.querySelector('.quantity-plus');
            const totalPriceElement = document.getElementById('total-price');
            const productPrice = parseFloat({{ $product->price }});
            
            // Elements d'expédition
            const shippingMethods = document.querySelectorAll('.shipping-method');
            let selectedShippingPrice = 0;
        
            // Initialisation des méthodes de paiement
            function initPaymentMethods() {
                paymentMethods[0].classList.add('active');
                paymentMethodInput.value = paymentMethods[0].dataset.method;
        
                paymentMethods.forEach(method => {
                    method.addEventListener('click', function() {
                        paymentMethods.forEach(m => m.classList.remove('active'));
                        this.classList.add('active');
                        paymentMethodInput.value = this.dataset.method;
                    });
                });
            }
        
            // Initialisation des méthodes d'expédition
            function initShippingMethods() {
                shippingMethods.forEach(method => {
                    method.addEventListener('click', function() {
                        shippingMethods.forEach(m => {
                            m.classList.remove('border-[#C9B194]', 'bg-[#F7F1E9]');
                            m.querySelector('.inner-circle').classList.add('scale-0');
                        });

                        this.classList.add('border-[#C9B194]', 'bg-[#F7F1E9]');
                        this.querySelector('.inner-circle').classList.remove('scale-0');
                        
                        // Mise à jour des valeurs
                        selectedShippingPrice = parseFloat(this.dataset.price);
                        document.getElementById('selected_shipping_method').value = this.dataset.carrier;
                        updateTotal();
                    });
                });

                // Sélection initiale
                shippingMethods[0].click();
            }

            // Calcul du total
            function updateTotal() {
                const quantity = parseInt(quantityInput.value, 10) || 1;
                const subtotal = productPrice * quantity;
                const total = subtotal + selectedShippingPrice;

                // Mise à jour des affichages
                document.getElementById('subtotal-price').textContent = subtotal.toFixed(2) + ' €';
                document.getElementById('shipping-price').textContent = selectedShippingPrice.toFixed(2) + ' €';
                totalPriceElement.textContent = total.toFixed(2) + ' €';

                // Mise à jour du champ caché
                document.getElementById('total_price_value').value = total.toFixed(2);
            }
        
            // Gestion de la quantité
            function setupQuantityControls() {
                minusButton.addEventListener('click', () => {
                    let currentValue = parseInt(quantityInput.value, 10);
                    if (currentValue > 1) {
                        quantityInput.value = currentValue - 1;
                        updateTotal();
                    }
                });
        
                plusButton.addEventListener('click', () => {
                    quantityInput.value = parseInt(quantityInput.value, 10) + 1;
                    updateTotal();
                });
        
                quantityInput.addEventListener('input', () => {
                    let currentValue = parseInt(quantityInput.value, 10) || 1;
                    quantityInput.value = Math.max(1, currentValue);
                    updateTotal();
                });
            }
        
            // Validation du formulaire
            form.addEventListener('submit', function(e) {
                if (!paymentMethodInput.value) {
                    e.preventDefault();
                    alert('Veuillez sélectionner un mode de paiement');
                }
            });
        
            // Initialisation
            initPaymentMethods();
            initShippingMethods();
            setupQuantityControls();
            updateTotal(); // Calcul initial
        });
        </script>
    
</body>
</html>