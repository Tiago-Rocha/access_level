<?php

class Client extends Eloquent {

    protected $guarded = array();
    protected $softDelete = true;
    protected $table = 'clients';
    public static $rules = array(
        'name' => 'required',
        'city' => 'required',
        'surname' => 'required',
        'email' => 'required',
        'phone' => 'required'
    );

    public static function company() {
        return $this->belongsTo('Company');
    }

    public function contracts() {
        return $this->hasMany('Contract');
    }

}
