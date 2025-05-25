<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoicesDetail;
use Illuminate\Http\Request;

class OrderAdminController extends Controller
{
    public function orderAdmin()
    {
        return view('orders.order_admin');
    }
    public function orderCancelled()
    {
        return view('orders.order_cancelled');
    }
    public function orderProcess()
    {
        return view('orders.order_process');
    }
    // public function cancel(Invoice $invoice)
    // {
    //     if($invoice->status !== 'pending') {
    //         return back()->with('error', 'Không thể hủy đơn hàng');
    //     }
    //     $invoice->status = 'cancelled';
    //     $invoice->date_cancel = now();
    //     $invoice->save();

    //     return back()->with('sussess', 'Đơn hàng đã được hủy');
    // }


    public function processInvoices()
    {
        $processInvoices = Invoice::select(
            'invoices.id_invoice as invoice_id',
            'users.username as customer_name',
            'invoices.total_amount as total_money',
            'invoices.created_at as dateOrder',
            'invoices.status as status'
        )
            ->join('users', 'invoices.id_user', '=', 'users.id_user')
            ->whereIn('invoices.status', ['pending', 'delivering', 'complete'])
            ->orderByRaw("FIELD(invoices.status, 'pending', 'delivering', 'complete')")
            ->with(['invoiceDetails.variant.product']) // nested eager loading
            ->paginate(10);
        $invoicesDetail = [];
        foreach ($processInvoices as $invoice) {
            $details = InvoicesDetail::where('id_invoice', $invoice->invoice_id)
                ->select(
                    'products.name as product_name',
                    'products.image_url as product_image_url',
                    'invoices_detail.quantity as invoice_quantity',
                    'product_variants.price as priceProduct'
                )
                ->join('product_variants', 'invoices_detail.id_variant', '=', 'product_variants.id_variant')
                ->join('products', 'product_variants.id_product', '=', 'products.id_product')
                ->get();

            $invoicesDetail[$invoice->invoice_id] = $details;
        }

        return view('orders.order_admin', compact('processInvoices', 'invoicesDetail'));
    }

    public function confirm($id)
    {
        $invoice = Invoice::findOrFail($id);
        if ($invoice->status === 'pending') {
            $invoice->status = 'delivering';
            $invoice->save();

            return redirect()->back()->with('message', 'Xác nhận đơn hàng thành công');
        }
        return redirect()->back()->with('error', 'Xác nhận đơn hàng thất bại. Đơn hàng đang ở trạng thái khác');
    }

    public function cancellInvoice()
    {
        $cancellInvoice = Invoice::select(
            'invoices.id_invoice as invoice_id',
            'users.username as customer_name',
            'invoices.cancellation_reason as cancellation_reason',
            'invoices.status as status_cancelled',
            'invoices.date_cancel as date_cancel'
        )
            ->join('users', 'invoices.id_user', '=', 'users.id_user')
            ->where('invoices.status', '=', 'cancelled')
            ->with(['invoiceDetails.variant.product']) // nested eager loading
            ->paginate(10);

        $invoicesDetail = [];

        foreach ($cancellInvoice as $invoice) {
            $details = InvoicesDetail::where('id_invoice', $invoice->invoice_id)
                ->select(
                    'products.name as product_name',
                    'products.image_url as product_image_url',
                    'invoices_detail.quantity as invoice_quantity',
                    'product_variants.price as priceProduct'
                )
                ->join('product_variants', 'invoices_detail.id_variant', '=', 'product_variants.id_variant')
                ->join('products', 'product_variants.id_product', '=', 'products.id_product')
                ->get();

            $invoicesDetail[$invoice->invoice_id] = $details;
        }
        return view('orders.order_cancelled', compact('cancellInvoice', 'invoicesDetail'));
    }
    public function deleteInvoiceCancel($invoice_id)
    {
        $invoice = Invoice::find($invoice_id);

        if (!$invoice) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn hàng');
        }
        try {
            $invoice->invoiceDetails()->delete();
            $invoice->delete();
            return redirect()->back()->with('message', 'Xóa đơn hàng thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi khi xóa đơn hàng: ' . $e->getMessage());
        }
    }
}
