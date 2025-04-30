<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier - MAJĀA</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}" />
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-size: 1.125rem; }
    </style>
</head>
<body class="bg-gray-50">
    <x-nav></x-nav>

    <div class="max-w-[100rem] mx-auto px-4 py-8">

        <!-- Contenu principal -->
        <div class="lg:grid lg:grid-cols-3 lg:gap-8">
            <!-- Liste des articles -->
            <div class="lg:col-span-2">
                @if(session('cart') && count(session('cart')) > 0)
                    @foreach(session('cart') as $index => $item)
                    <div class="bg-white rounded-xl shadow-sm p-8 mb-6">
                        <div class="flex gap-8">
                            <img src="{{ asset('storage/' . $item['image']) }}" alt="Produit" 
                                class="w-40 object-cover rounded-lg">
                            
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <h3 class="text-4xl font-semibold text-gray-800">
                                        <a href="{{ route('product.show', $item['product_id']) }}" 
                                           class="hover:text-[#C9B194] transition-colors">
                                            {{ $item['name'] }}
                                        </a>
                                    </h3>
                                    <span class="text-2xl text-[#C9B194] font-medium">EUR {{ $item['price'] }}</span>
                                </div>
                                
                                @if($item['custom_text'])
                                <p class="text-2xl text-gray-600 mt-4">
                                    Personnalisation : {{ $item['custom_text'] }}
                                </p>
                                @endif
                                
                                <div class="mt-6 space-y-4">
                                    <div class="flex items-center gap-3 text-2xl">
                                        <span class="text-gray-700">Taille : {{ $item['size'] }}</span>
                                        <span class="text-gray-400">•</span>
                                        <span id="quantity-{{ $index }}" class="text-gray-700">Quantité : {{ $item['quantity'] ?? 1 }}</span>
                                    </div>
                                    
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-6">
                                            <form action="{{ route('cart.update', $index) }}" method="POST" data-index="{{ $index }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="flex items-center border-2 rounded-xl">
                                                    <button type="button" 
                                                        class="px-5 py-3 text-gray-500 hover:bg-gray-50 text-2xl quantity-minus">−</button>
                                                    <input type="number" 
                                                        name="quantity" 
                                                        value="{{ $item['quantity'] ?? 1 }}" 
                                                        class="w-20 text-center border-0 bg-transparent text-2xl font-medium"
                                                        readonly>
                                                    <button type="button" 
                                                        class="px-5 py-3 text-gray-500 hover:bg-gray-50 text-2xl quantity-plus">+</button>
                                                </div>
                                            </form>
                                            <button class="text-[#C9B194] hover:text-[#B89E7D] text-2xl" onclick="addToWishlist({{ $item['product_id'] }})">
                                                Enregistrer pour plus tard
                                            </button>
                                        </div>
                                        <form action="{{ route('cart.remove', $index) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-[#C9B194]">
                                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                        <p class="text-2xl text-gray-500">Votre panier est vide</p>
                        <a href="{{ route('collections.abayas') }}" class="mt-4 inline-block text-[#C9B194] hover:underline text-2xl">
                            Commencez vos achats →
                        </a>
                    </div>
                @endif
            </div>

            <!-- Récapitulatif -->
            <div class="bg-white rounded-xl shadow-sm p-8 h-fit sticky top-8">
                <h2 class="text-4xl font-bold text-gray-800 mb-8">Récapitulatif</h2>
                
                <div class="space-y-6">
                    @php
                        $subtotal = 0;
                        if(session('cart')) {
                            foreach(session('cart') as $item) {
                                $subtotal += $item['price'] * ($item['quantity'] ?? 1);
                            }
                        }
                    @endphp
                    
                    <div class="pt-6 border-t-2 border-gray-100">
                        <div class="flex justify-between text-3xl font-bold">
                            <span>Total</span>
                            <span id="subtotal">EUR {{ number_format($subtotal, 2) }}</span>
                        </div>
                    </div>
                </div>
            
                @if(session('cart') && count(session('cart')) > 0)
                <div class="mt-8 pt-6 border-t-2 border-gray-100">
                    <a href="{{ route('checkout') }}"
                       class="w-full bg-[#C9B194] text-white py-5 rounded-xl hover:bg-[#B89E7D] 
                              transition-colors font-semibold text-2xl block text-center">
                        Passer la commande
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <script src="{{ asset('js/index.js') }}"></script>
    <script>
        function addToWishlist(productId) {
            fetch('{{ route('wishlist.add') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        title: 'Success!',
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then(() => {
                        // Reload the page after closing the SweetAlert
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: data.message,
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'Something went wrong.',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            });
        }
       
    </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.quantity-minus, .quantity-plus').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form');
                const input = form.querySelector('input[name="quantity"]');
                const index = form.dataset.index;
                
                // Calcul de la nouvelle quantité
                let newQuantity = parseInt(input.value);
                newQuantity = this.classList.contains('quantity-minus') ? 
                    Math.max(1, newQuantity - 1) : 
                    newQuantity + 1;

                // Mise à jour immédiate de l'interface
                input.value = newQuantity;
                document.getElementById(`quantity-${index}`).textContent = `Quantité : ${newQuantity}`;

                // Envoi de la requête
                fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Mise à jour finale avec les données serveur
                        input.value = data.quantity;
                        document.getElementById(`quantity-${index}`).textContent = `Quantité : ${data.quantity}`;
                        document.getElementById('subtotal').textContent = `EUR ${data.subtotal}`;
                    }
                })
                .catch(error => console.error('Erreur:', error));
            });
        });
    });
</script>
</body>
</html>