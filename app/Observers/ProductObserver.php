<?php

namespace App\Observers;

use App\Models\Invoice;
use App\Models\Product;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        $invoice = Invoice::find($product->invoice_id);
        $invoice->total += ($product->quantity * $product->price);
        $invoice->save();
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        $invoice = $product->invoice;
        $invoice->total = $this->getTotal($invoice->id);
        $invoice->save();

    }

    private function getTotal($invoice_id){
        $query = Invoice::where('invoices.id',$invoice_id)
            ->leftJoin('products','products.invoice_id','=','invoices.id')
            ->groupBy('invoices.id')
            ->selectRaw('sum(products.price * products.quantity) as total, invoices.id')
            ->first();
        return $query->total;
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
