<?php

class Contract extends Eloquent {
    protected $softDelete = true;
    protected $guarded = array();
    protected $table = 'contracts';
    public static $rules = array(
        'date' => 'required',
        'client_id' => 'required',
        'hourstotal' => 'required',
        'hoursleft' => 'required',
        'type' => 'required',
        'hourprice' => 'required',
        'travelprice' => 'required'
        );

    public static function client() {
        return $this->belongsTo('Client');
    }

    public function servicereports() {
        return $this->hasMany('Servicereport');
    }

    public static function getClient($id) {
        return Client::find($id)->name;
    }

    public static function getCompanyByClientId($id) {
        return Client::getCompany(Client::find($id)->company_id);
    }

}
