<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link
    href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
    rel="stylesheet"
  />
    @vite('resources/css/app.css') 
    <link href="{{ asset('css/nav.css') }}" rel="stylesheet"> 
    
    <title>Checkout</title>  
</head>  


<body class="bg-gray-100" >  

    <x-nav ></x-nav>

<div class="min-h-screen bg-gray-100 p-4 md:p-6 lg:p-8">
    <div class="max-w-7xl mx-auto lg:flex lg:gap-8">
        <!-- Left Column -->
        <div class="lg:w-2/3">
            <form id="payment-form" action="{{ route('checkout.process') }}" method="POST">
                @csrf
                
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
                    
                    <label class="flex items-center space-x-3">
                        <input type="checkbox" name="newsletter" class="rounded h-6 w-6">
                        <span class="text-xl">Email me with news and offers</span>
                    </label>
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
                            <span class="inline-flex items-center px-5 border-2 border-r-0 rounded-l-lg bg-gray-50 text-xl">+212</span>
                            <input type="tel" name="phone" required class="w-full px-5 py-4 border-2 rounded-r-lg text-xl">
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Right Column -->
        <div class="lg:w-1/3 mt-6 lg:mt-0">
            <div class="bg-white rounded-lg shadow-sm p-4 md:p-6">
                <h2 class="text-3xl font-semibold mb-4 md:mb-6">Your Order</h2>
                
                <!-- Order Items -->
                <div class="border-b pb-5 mb-5">
                    <div class="flex justify-between mb-3">
                        <span class="text-xl">Satin Trim Blouse | Soft Khaki</span>
                        <span class="text-xl">MAD 1,498.00</span>
                    </div>
                    <p class="text-lg md:text-xl text-gray-500">Soft Khaki / XS</p>
                </div>

                <div class="border-b pb-5 mb-5">
                    <div class="flex justify-between mb-3">
                        <span class="text-xl">The Unique Flock Premium | Black</span>
                        <span class="text-xl">MAD 488.00</span>
                    </div>
                    <p class="text-lg md:text-xl text-gray-500">Black / One Size</p>
                </div>

                <!-- Totals -->
                <div class="space-y-5">
                    <div class="flex justify-between">
                        <span class="text-xl">Subtotal (3 items)</span>
                        <span class="text-xl">MAD 1,988.00</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-xl">Shipping</span>
                        <span class="text-xl text-gray-500">Enter shipping address</span>
                    </div>
                    <div class="flex justify-between font-medium text-2xl">
                        <span>Total</span>
                        <span>MAD 1,986.00</span>
                    </div>
                </div>

                <!-- Stripe Payment Button -->
                <button id="submit-button" type="submit" form="payment-form" 
                    class="w-full mt-6 bg-black text-white py-5 text-2xl rounded-lg hover:bg-gray-800 transition">
                    Proceed to Payment
                </button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/index.js') }}"></script>
</body>  
</html>  