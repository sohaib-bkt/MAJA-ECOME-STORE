<div class="product-item">
<div class="overlay">
    <a href="" class="product-thumb">
        {{-- <img src="{{ asset('storage/'.$product->image) }}" alt="" /> --}}
        <img src="{{ asset('images/'.$product->image) }}" alt="" />
    </a>
</div>
<div class="product-info">
    <span>{{ $product->category }}</span>
    <a href="">{{ $product->name }}</a>
    <h4>${{ $product->price }}</h4>
</div>
<ul class="icons">
    <li>
        <i class="bx bx-heart" onclick="addToWishlist({{ $product->id }})"></i>
    </li>
    <li>
        <a href="{{ route('product.show', $product->id) }}"><i class="bx bx-search"></i></a>
    </li>
</ul>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

