<!-- resources/views/invoices/show.blade.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <h3>Chi tiết đơn hàng #{{ $invoice->id_invoice }}</h3>

    <p><strong>Ngày đặt:</strong> {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y H:i') }}</p>
    <p><strong>Tổng tiền:</strong> {{ number_format($invoice->total_amount, 0, ',', '.') }} đ</p>
    <p><strong>Trạng thái:</strong> {{ ucfirst($invoice->status) }}</p>
    <p><strong>Thanh toán:</strong> {{ $invoice->payment_method }}</p>
    @if($invoice->status === 'cancel')
        <p><strong>Lý do hủy:</strong> {{ $invoice->cancellation_reason }}</p>
    @endif

    <a href="{{ url('/transaction-history') }}" class="btn btn-secondary mt-3">Quay lại</a>
</div>
</body>
</html>
