<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Thank you for your order!</h1>
    <p>Order ID: {{ $order->id }}</p>
    <p>Product: {{ $order->product->name }}</p>
    <p>Total: {{ $order->product->price }}€</p>
    <p>Shipping Address:</p>
    <address>
        {{ $order->first_name }} {{ $order->last_name }}<br>
        {{ $order->address }}<br>
        {{ $order->city }}<br>
        {{ $order->phone }}
    </address>
</body>
</html>