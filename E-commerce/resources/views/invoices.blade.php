@extends('dashboard')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Đơn mua</h3>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse($invoices as $invoice)
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Mã đơn: #{{ $invoice->id_invoice }} | Ngày đặt: {{ $invoice->invoice_date }}</span>
            <span class="badge bg-secondary text-capitalize">{{ $invoice->status }}</span>
        </div>

        <div class="card-body">
            @foreach($invoice->details as $detail)
            <div class="row mb-3 align-items-center">
                <div class="col-md-2">
                    <img src="{{ 'images/'.$detail->variant->product->image_url ?? 'https://via.placeholder.com/100' }}" alt="Ảnh sản phẩm" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h6>{{ $detail->variant->product->name }}</h6>
                    <p class="mb-0">Phân loại: {{ $detail->variant->size ?? 'Không rõ' }}, {{ $detail->variant->color ?? 'Không rõ' }}</p>
                </div>
                <div class="col-md-2 text-center">
                    x{{ $detail->quantity }}
                </div>
                <div class="col-md-2 text-end">
                    {{ number_format($detail->price, 0, ',', '.') }}₫
                </div>
            </div>
            @endforeach
        </div>

        <div class="card-footer d-flex justify-content-between align-items-center">
            <div>
                @if($invoice->status === 'pending')
                <button
                    type="button"
                    class="btn btn-outline-danger btn-sm btn-cancel-order"
                    data-url="{{ route('invoice.cancel', $invoice->id_invoice) }}"
                    data-bs-toggle="modal"
                    data-bs-target="#cancelModal">
                    Hủy đơn
                </button>
                @endif
            </div>

            <div>
                <strong>Tổng: {{ number_format($invoice->total_amount, 0, ',', '.') }}₫</strong>
            </div>
        </div>
    </div>
    @empty
    <div class="alert alert-info">
        Bạn chưa có đơn hàng nào.
    </div>
    @endforelse
</div>

<!-- Modal hủy đơn -->
<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="cancel-form" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelModalLabel">Hủy đơn hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="cancellation_reason" class="form-label">Lý do hủy (không bắt buộc)</label>
                        <textarea name="cancellation_reason" id="cancellation_reason" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-danger">Xác nhận hủy</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const cancelForm = document.getElementById('cancel-form');

    document.querySelectorAll('.btn-cancel-order').forEach(button => {
        button.addEventListener('click', function () {
            // Lấy URL hủy đơn từ attribute data-url
            const url = this.getAttribute('data-url');
            // Gán action form cancel
            cancelForm.action = url;
            // Reset textarea
            cancelForm.querySelector('#cancellation_reason').value = '';
        });
    });
});
</script>

@endsection
