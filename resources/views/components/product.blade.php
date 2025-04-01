<div class="product-item">
    <div class="overlay" >
        <a class="product-thumb " >
            {{-- <img src="{{ asset('storage/'.$product->image) }}" alt="" /> --}}
            <img src="{{ asset('images/'.$product->image) }}"  alt="" />
        </a>
    </div>
    <div class="product-info">
        <span>{{ $product->category }}</span>
        <a href="">{{ $product->name }}</a>
        <h4>€{{ $product->price }}</h4>
    </div>
    <ul class="icons">
        <li>
            <i class="bx bx-heart" onclick="addToWishlist({{ $product->id }})"></i>
        </li>
        <li>
            <i class="bx bx-search" onclick="window.location.href='{{ route('product.show', $product->id) }}';" style="cursor: pointer;">  
            </i>  
        </li>
    </ul>
    
  
    <!-- Custom Modal -->
    <div id="custom-modal" class="hidden fixed inset-0 z-50 bg-black/50 backdrop-blur-sm">
      <div class="min-h-screen flex items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6 relative transition-all duration-300">
          <div class="text-center">
            <div class="flex items-center justify-center mb-4">
              <div id="modal-icon" class="mr-3">
                <!-- Success Icon -->
                <svg id="success-icon" class="hidden w-10 h-10 text-[#C9B194]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                
                <!-- Error Icon -->
                <svg id="error-icon" class="hidden w-10 h-10 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              
              <h3 id="modal-title" class="text-xl font-bold"></h3>
            </div>
            
            <p id="modal-message" class="text-gray-600 mb-6"></p>
            
            <button onclick="hideModal()" 
                    class="w-full py-2 px-6 bg-[#C9B194] hover:bg-[#B89E80] text-white rounded-lg transition-colors">
              Fermer
            </button>
          </div>
        </div>
      </div>
    </div>
  
    <script>
      function showModal(type, title, message) {
        const modal = document.getElementById('custom-modal');
        const successIcon = document.getElementById('success-icon');
        const errorIcon = document.getElementById('error-icon');
        
        document.getElementById('modal-title').textContent = title;
        document.getElementById('modal-message').textContent = message;
        
        if(type === 'success') {
          successIcon.classList.remove('hidden');
          errorIcon.classList.add('hidden');
        } else {
          errorIcon.classList.remove('hidden');
          successIcon.classList.add('hidden');
        }
        
        modal.classList.remove('hidden');
      }
  
      function hideModal() {
        document.getElementById('custom-modal').classList.add('hidden');
      }
  
      // Close modal when clicking outside
      document.getElementById('custom-modal').addEventListener('click', (e) => {
        if(e.target.id === 'custom-modal') hideModal();
      });
  
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
          if(data.status === 'success') {
            showModal('success', 'Succès', data.message);
            setTimeout(() => {
              location.reload();
            }, 1500);
          } else {
            showModal('error', 'Erreur', data.message);
          }
        })
        .catch(error => {
          console.error('Error:', error);
          showModal('error', 'Erreur', 'Une erreur est survenue.');
        });
      }
    </script>
  </div>