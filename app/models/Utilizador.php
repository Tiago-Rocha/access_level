<?php

class Utilizador extends Eloquent {
	protected $guarded = array();
        
        protected $table = 'utilizadors';
        protected $softDelete = true;        

        /**
         * The attributes excluded from the model's JSON form.
         *
         * @var array
         */
        protected $hidden = array('password');
        
        public static $rules = array(
		'name' => 'required',
		'password' => 'required',
		'admin' => '',
		'humanresource' => '',
		'servicereport' => '',
		'clientmanager' => ''
	);
        	
        
        
        public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
                   
        public static function getUtilizador(){
            return Utilizador::where('name','=',Auth::user()->name)->get();
        }
        public static function isServiceReport(){
                $utilizador = Utilizador::where('username','=',Auth::user()->username)->get();
                return $utilizador;
        }
        public static function isHumanResource(){
            $utilizador = Utilizador::where('username','=',Auth::user()->username)->get();
                return $utilizador->humanresource->get();
        }
        public static function isClientManager(){
            $utilizador = Utilizador::where('username','=',Auth::user()->username)->get();
                return $utilizador->clientmanager;
        }
          public static function isAdmin(){
            $utilizador = Utilizador::where('username','=',Auth::user()->username)->get();
                return $utilizador->admin;
        }
        /*
        public function isContractManager(){
                return $this->user->servicereport;
        }
        
        public function isNetworkManager(){
                return $this->user->servicereport;
        }
*/

}
