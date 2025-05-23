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
    public function cancel(Invoice $invoice)
    {
        if($invoice->status !== 'pending') {
            return back()->with('error', 'Khong the huy don hang');
        }
        $invoice->status = 'cancelled';
        $invoice->date_cancel = now();
        $invoice->save();

        return back()->with('sussess', 'Don hang da duoc huy');
    }
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
            ->where('invoices.status', '=', 'pending')
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

        if(!$invoice) {
            return redirect()->back()->with('error', 'Khong tim thay don hang');
        }
        try
        {
            $invoice->invoiceDetails()->delete();
            $invoice->delete();
            return redirect()->back()->with('success', 'Xoa don hang thanh cong');
        }
        catch(\Exception $e) {
            return redirect()->back()->with('error', 'Co loi khi xoa don hang: '.$e->getMessage());
        }
    }
}
