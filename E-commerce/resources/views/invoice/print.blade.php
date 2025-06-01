<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Hóa đơn #{{ $invoice->id_invoice }}</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            margin: 40px auto;
            max-width: 800px;
            color: #333;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #ccc;
            padding-bottom: 15px;
        }

        .logo img {
            height: 80px;
        }

        .header-info {
            text-align: right;
        }

        .section {
            margin-top: 30px;
        }

        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 5px 0;
        }

        .content-box {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 15px;
            background: #fafafa;
        }

        table.product-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .product-table th,
        .product-table td {
            padding: 8px 12px;
            border-bottom: 1px solid #e0e0e0;
            text-align: left;
        }

        .product-table th {
            background-color: #f0f0f0;
        }

        .footer {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .print-button {
            margin-top: 40px;
            text-align: right;
        }

        @media print {
            button {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="header">
    <div class="logo">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
    </div>
    <div class="header-info">
        <div>Ngày: {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y') }}</div>
        <div>Mã hóa đơn: {{ $invoice->id_invoice }}</div>
    </div>
</div>

<div class="section">
    <table class="info-table">
        <tr>
            <td><strong>Từ:</strong>SHOPE-COM</td>
            <td><strong>Đến:</strong> {{ $invoice->user->name ?? 'Khách hàng' }}</td>
        </tr>
    </table>
</div>

<div class="section content-box">
    <strong>Nội dung đơn hàng</strong>
    <table class="product-table">
        <thead>
        <tr>
            <th>STT</th>
            <th>Sản phẩm</th>
            <th>Phân loại</th>
            <th>Số lượng</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoice->details as $i => $detail)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $detail->variant->product->name }}</td>
            <td>
                Màu: {{ $detail->variant->color ?? 'Không rõ' }},
                Size: {{ $detail->variant->size ?? 'Không rõ' }}
            </td>
            <td>{{ $detail->quantity }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="footer">
    <div><strong>Tiền thu người nhận:</strong> {{ number_format($invoice->total_amount, 0, ',', '.') }}₫</div>
    <div style="text-align:right"><strong>Chữ ký người nhận</strong><br><br>___________________</div>
</div>

<div class="print-button">
    <button onclick="window.print()">🖨 In hóa đơn</button>
</div>

</body>
</html>
