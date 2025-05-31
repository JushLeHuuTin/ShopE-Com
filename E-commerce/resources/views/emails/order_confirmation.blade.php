<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Chào bạn,</h2>
    <p>Cảm ơn bạn đã đặt hàng tại Tên Shop!</p>

    <p>Chi tiết đơn hàng:</p>
    <ul>
        @foreach ($cartItems as $item)
        <li>{{ $item['name'] }} - SL: {{ $item['quantity'] }} - Giá: {{ number_format($item['price']) }}đ</li>
        @endforeach
    </ul>

    <p>Tổng tiền: <strong>{{ number_format($invoice['total_amount']) }}đ</strong></p>

    <p>Chúng tôi sẽ sớm xử lý và giao đơn hàng đến bạn.</p>

</body>

</html>