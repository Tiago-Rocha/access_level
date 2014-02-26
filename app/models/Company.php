<?php

class Company extends Eloquent {

    protected $guarded = array();
    protected $softDelete = true;
    protected $table = 'companies';
    public static $rules = array(
        'name' => 'required',
        'address' => 'required',
        'zip_code' => 'required',
        'city' => 'required',
        'country' => 'required',
        'bic' => 'required',
        'iban' => 'required',
        'vat_number' => 'required',
        'tva_rate' => 'required',
        'travel_expenses' => 'required',
        'due_days' => 'required'
    );

    public function clients() {
        return $this->hasMany('Client');
    }

    public function servicereports() {
        return $this->hasMany('Servicereport');
    }

    public static function getCompanies() {
        $companies = DB::table('companies')->orderBy('name', 'asc')->lists('name', 'id');
        return $companies;
    }

    public static function contracts($id) {
        // return Contract::leftJoin('employees', 'contract.employee_id', '=', 'employees.id')->where('employees.company_id,' '=', $this->id)->get(['contracts.*']);
        return Contract::leftJoin('clients', 'contracts.client_id', '=', 'clients.id')->where('clients.company_id', '=', $id)->orderBy('hoursleft', 'ASC')->get(['contracts.*']);
    }

}
