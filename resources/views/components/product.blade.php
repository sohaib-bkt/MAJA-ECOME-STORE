<style>
  .product-item {
    position: relative;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
}

.discount-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: linear-gradient(135deg, #ff4444, #ff6b6b);
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 700;
    z-index: 2;
}

.price-container {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 12px;
}

.original-price {
    color: #a0aec0;
    text-decoration: line-through;
    font-size: 0.9rem;
}

.discounted-price {
    color: #e53e3e;
    font-weight: 700;
    font-size: 1.25rem;
}

/* Correction pour la modale */
#simple-modal {
    backdrop-filter: blur(3px);
}
</style>

<div class="product-item">
  <div class="overlay">
      <a class="product-thumb">
          <img src="{{ asset('storage/'.$product->image) }}" alt="" />
      </a>
  </div>

  <div class="product-info">
      <span>{{ $product->category }}</span>
      <a href="">{{ $product->name }}</a>
      <div class="">
          @if($product->price_before_discount)
              <span class="text-xl font-bold text-red-500">{{ number_format($product->price, 2) }}€</span>
              <span class="text-gray-400 line-through text-sm">{{ number_format($product->price_before_discount, 2) }}€</span>
          @else
              <span class="text-xl font-bold text-gray-900">{{ number_format($product->price, 2) }}€</span>
          @endif
      </div>
  </div>

  <ul class="icons">
      <li><i class="bx bx-heart" onclick="addToWishlist({{ $product->id }})"></i></li>
      <li>
          <i class="bx bx-search" 
             onclick="window.location.href='{{ route('product.show', $product->id) }}';"
             style="cursor: pointer;"></i>
      </li>
  </ul>
</div>

<!-- La modale DOIT être placée EN DEHORS de la boucle de produits -->
<div id="simple-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 1000;">
  <div style="position: relative; width: 90%; max-width: 400px; margin: 15% auto; background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
      <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 15px;">
          <svg id="success-icon" style="width: 30px; height: 30px; margin-right: 10px; color: #C9B194; display: none;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <svg id="error-icon" style="width: 30px; height: 30px; margin-right: 10px; color: #E53E3E; display: none;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <h3 id="modal-title" style="font-size: 18px; font-weight: bold;"></h3>
      </div>
      <p id="modal-message" style="text-align: center; margin-bottom: 20px; color: #4A5568;"></p>
      <button onclick="closeSimpleModal()" 
              style="width: 100%; padding: 10px; background-color: #C9B194; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: 600;">
          Fermer
      </button>
  </div>
</div>

<script>
  // Fonctions modales améliorées
  function showSimpleModal(type, title, message) {
    const modal = document.getElementById('simple-modal');
    const successIcon = document.getElementById('success-icon');
    const errorIcon = document.getElementById('error-icon');
    
    modal.style.display = 'flex';
    modal.style.alignItems = 'center';
    modal.style.justifyContent = 'center';
    
    successIcon.style.display = type === 'success' ? 'block' : 'none';
    errorIcon.style.display = type === 'error' ? 'block' : 'none';
    
    document.getElementById('modal-title').textContent = title;
    document.getElementById('modal-message').textContent = message;
  }
  
  function closeSimpleModal() {
    document.getElementById('simple-modal').style.display = 'none';
    if(reloadOnClose) window.location.reload();
  }
  
  // Gestionnaire d'événement pour fermer la modale
  window.onclick = function(event) {
    const modal = document.getElementById('simple-modal');
    if (event.target === modal) {
      closeSimpleModal();
    }
  };
  
  // Reste du code JavaScript inchangé
  var reloadOnClose = false;
  
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
        showSimpleModal('success', 'Succès !', data.message);
        reloadOnClose = true;
      } else {
        showSimpleModal('error', 'Erreur !', data.message || 'Le produit est déjà dans la liste de souhaits !');
        reloadOnClose = false;
      }
    })
    .catch(error => {
      console.error('Error:', error);
      showSimpleModal('error', 'Erreur !', 'Une erreur est survenue.');
      reloadOnClose = false;
    });
  }
  </script>