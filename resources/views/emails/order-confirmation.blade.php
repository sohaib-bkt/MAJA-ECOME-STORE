<!DOCTYPE html>
<html>
<head>  
    <title>Confirmation de commande</title>  
</head>  
<body>  
    <h1>Merci pour votre commande!</h1>  
    <p>ID de commande : {{ $order->id }}</p>  
    <p>Produit : {{ $order->product->name }}</p>  
    <p>Total : {{ $order->product->price * $order->quantity }}€</p>  
    <p>Adresse de livraison :</p>  
    <address>  
        {{ $order->first_name }} {{ $order->last_name }}<br>  
        {{ $order->address }}<br>  
        {{ $order->city }}<br>  
        {{ $order->phone }}  
    </address>  
 
</body>
</html>