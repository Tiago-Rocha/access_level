<?php

/**
 * Description of GlobalVar
 *
 * @author trocha
 */
class GlobalVar extends Eloquent {

    protected $guarded = array();
    protected $softDelete = true;
    protected $table = 'global_vars';
    public static $rules = array(
        'short_name' => 'required',
        'name' => 'required',
        'address' => 'required',
        'zip_code' => 'required',
        'city' => 'required',
        'country' => 'required',
        'mail' => 'required',
        'phone' => 'required',
        'fax' => 'required',
        'website' => 'required',
        'account_number' => 'required',
        'bic' => 'required',
        'iban' => 'required',
        'vat_rate' => 'required',
        'vat_number' => 'required',
        'pdf_directory' => 'required',
        'default_due_days' => 'required',
        'conditions' => 'required',
        'policy' => 'required'
    );

}
