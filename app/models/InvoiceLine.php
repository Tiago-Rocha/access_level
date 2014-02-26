<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of invoice_content_line
 *
 * @author trocha
 */
class InvoiceLine extends Eloquent {
    protected $softDelete = true;
    protected $guarded = array();
    protected $table = 'i_invoice_content';
    public static $rules = array(
        'quantity' => 'required',
        'price_unit' => 'required',
        'invoice_id' => 'required'
    );

    public function Invoice() {
        return $this->belongsTo('Invoice');
    }

}
