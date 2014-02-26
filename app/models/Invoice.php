<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Invoice
 *
 * @author trocha
 */
class Invoice extends Eloquent {
    protected $softDelete = true;
    protected $guarded = array();
    protected $table = 'i_invoices';
    public static $rules = array(
        'start' => 'required',
        'end' => 'required',
        'date' => 'required',
        'company_id' => 'required',
        'state' => 'required'
    );

    public function InvoiceLines() {
        return $this->hasMany('InvoiceLine');
    }

    public static function getHours($id, $type) {
        $invoice = Invoice::find($id);
        $lines = InvoiceLine::where('invoice_id', '=', $id)->get();
        if ($type == 'external') {
            $external = 0;
            foreach ($lines as $line) {
                if ($line['code'] == $type) {
                    $external += 1;
                }
            }
            return $external;
        } else {
            foreach ($lines as $line) {
                if ($line['code'] == $type) {
                    return number_format($line['quantity'], 2);
                }
            }
        }
        return 0;
    }

}
