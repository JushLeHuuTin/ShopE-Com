<!-- resources/views/invoices/index.blade.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Lịch sử giao dịch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <h2>Lịch sử giao dịch</h2>
     <p>Tên người dùng: {{ $user->name }}</p>
    @if($invoices->count())
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->id_invoice }}</td>
                    <td>{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y H:i') }}</td>
                    <td>{{ number_format($invoice->total_amount, 0, ',', '.') }} đ</td>
                    <td>{{ ucfirst($invoice->status) }}</td>
                    <td>
                        <a href="{{ url('/hoa-don/' . $invoice->id_invoice) }}" class="btn btn-success btn-sm">Xem chi tiết</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $invoices->links('pagination::bootstrap-5') }}
    @else
        <div class="alert alert-info">Lịch sử giao dịch trống.</div>
    @endif
</div>
</body>
</html>
