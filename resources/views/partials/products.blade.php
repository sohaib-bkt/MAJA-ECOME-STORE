@foreach ($products as $product)
    <x-product :product="$product"></x-product>
@endforeach
