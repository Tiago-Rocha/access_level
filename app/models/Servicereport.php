<?php

class Servicereport extends Eloquent {
	protected $guarded = array();
        protected $softDelete = true;

	public static $rules = array(
		'company_id' => 'required',
		'utilizador_id' => 'required',
		'contract_id' => 'required',
                'company_id' => 'required',
		'internal' => 'required',
		'start' => 'required',
		'end' => 'required',
		'duration' => 'required',
		'subject' => 'required'
	);
         public static function contract(){
            return $this->belongsTo('Contract');
        }
        public static function company(){
            return $this->belongsTo('Company');
        }
        public static function getClient($id){
            return Client::find($id)->name;
        }


}
