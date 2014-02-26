<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class NetworkTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
            
            
                Schema::create('n_network', function(Blueprint $table){
                    $table->engine = 'InnoDB';
                    $table->increments('id')->unsigned();
                    $table->integer('company_id');
                });
                Schema::create('n_internet_subscription', function(Blueprint $table){
                    $table->engine = 'InnoDB';
                    $table->increments('id');
                    $table->integer('network_id')->unsigned();
                    $table->string('provider');
                    $table->string('fixed_ip');
                    $table->string('download_rate');
                    $table->string('upload_rate');
                    $table->string('tech_number');
                    $table->string('tech_email');
                    $table->string('line_number');
                    $table->string('subscription_type');
                    $table->string('subscription_name');
                });
                Schema::create('n_modem', function(Blueprint $table){
                    $table->engine = 'InnoDB';
                    $table->increments('id');
                    $table->integer('network_id')->unsigned();
                    $table->string('info');
                });
                Schema::create('n_remote_access', function(Blueprint $table){
                    $table->engine = 'InnoDB';
                    $table->increments('id');
                    $table->integer('network_id')->unsigned();
                    $table->string('user');
                    $table->string('credentials');
                    $table->string('rdp_connection');
                });
                Schema::create('n_firewall', function(Blueprint $table){
                    $table->engine = 'InnoDB';
                    $table->increments('id');
                    $table->integer('network_id')->unsigned();
                    $table->string('brand');
                    $table->string('model');
                    $table->string('serial');
                    $table->string('ip');
                    $table->string('admin_page');
                    $table->string('admin_user');
                    $table->string('password_user');
                    $table->string('config_info');
                });
                Schema::create('n_switch', function(Blueprint $table){
                    $table->engine = 'InnoDB';
                    $table->increments('id');
                    $table->integer('network_id')->unsigned();
                    $table->string('info');
                });
                Schema::create('n_antivirus_info', function(Blueprint $table){
                    $table->engine = 'InnoDB';
                    $table->increments('id');
                    $table->integer('network_id')->unsigned();
                    $table->string('brand');
                    $table->string('user_nbr');
                    $table->string('admin_login');
                    $table->string('admin_pw');
                    $table->string('admin_page_url');
                    $table->string('product_key');
                });
                Schema::create('n_wireless_access_point', function(Blueprint $table){
                    $table->engine = 'InnoDB';
                    $table->increments('id');
                    $table->integer('network_id')->unsigned();
                    $table->string('brand');
                    $table->string('model');
                    $table->string('serial');
                    $table->string('ip');
                    $table->string('gateway');
                    $table->string('security_type');
                    $table->string('ssid');
                    $table->string('security_key');
                    $table->string('admin_user');
                    $table->string('admin_pw');
                });
                Schema::create('n_server', function(Blueprint $table){
                    $table->engine = 'InnoDB';
                    $table->increments('id');
                    $table->integer('network_id')->unsigned();
                    $table->string('brand');
                    $table->string('model');
                    $table->string('serial');
                    $table->string('ip');
                    $table->string('reseller_name');
                    $table->string('reseller_phone');
                    $table->string('reseller_email');
                    $table->string('setup_type');
                    $table->string('servername');
                    $table->string('domain');
                    $table->string('gateway');
                    $table->string('dhcp_range');
                    $table->string('admin_user');
                    $table->string('admin_pw');
                    $table->string('remote_access_info');
                    $table->string('server_roles');
                });
                Schema::create('n_vmware', function(Blueprint $table){
                    $table->engine = 'InnoDB';
                    $table->increments('id');
                    $table->integer('network_id')->unsigned();
                    $table->string('su_name');
                    $table->string('su_email');
                    $table->string('su_login');
                    $table->string('su_pw');
                    $table->string('su2_name');
                    $table->string('su2_email');
                    $table->string('su2_login');
                    $table->string('su2_pw');
                    $table->string('vmware_account_id');
                });
                Schema::create('n_ms_licenses', function(Blueprint $table){
                    $table->engine = 'InnoDB';
                    $table->increments('id');
                    $table->integer('network_id')->unsigned();
                    $table->string('contract_type');
                    $table->string('contract_id');
                    $table->string('admin_page');
                    $table->string('login');
                    $table->string('pw');
                    $table->string('email');
                });
                Schema::create('n_laptop_info', function(Blueprint $table){
                    $table->engine = 'InnoDB';
                    $table->increments('id');
                    $table->integer('network_id')->unsigned();
                    $table->string('brand');
                    $table->string('model');
                    $table->string('serial');
                    $table->string('computer_name');
                    $table->string('user_name');
                    $table->string('admin_login');
                    $table->string('admin_pw');
                    $table->string('user_login');
                    $table->string('user_pw');
                    $table->string('os_version');
                    $table->string('antivirus');
                    $table->string('office_version');
                    $table->string('office_key');
                });
                Schema::create('n_desktop_info', function(Blueprint $table){
                    $table->engine = 'InnoDB';
                    $table->increments('id');
                    $table->integer('network_id')->unsigned();
                    $table->string('brand');
                    $table->string('model');
                    $table->string('serial');
                    $table->string('computer_name');
                    $table->string('user_name');
                    $table->string('admin_login');
                    $table->string('admin_pw');
                    $table->string('user_login');
                    $table->string('user_pw');
                    $table->string('os_version');
                    $table->string('antivirus');
                    $table->string('office_version');
                    $table->string('office_key');
                    $table->string('remote_access_info');
                });
                Schema::create('n_printer', function(Blueprint $table){
                    $table->engine = 'InnoDB';
                    $table->increments('id');
                    $table->integer('network_id')->unsigned();
                    $table->string('brand');
                    $table->string('model');
                    $table->string('serial');
                    $table->string('ip');
                    $table->string('drivers_used');
                    $table->string('admin_page');
                    $table->string('admin_user');
                    $table->string('admin_pw');
                    $table->string('warranty');
                });
                Schema::create('n_tablet_info', function(Blueprint $table){
                    $table->engine = 'InnoDB';
                    $table->increments('id');
                    $table->integer('network_id')->unsigned();
                    $table->string('brand');
                    $table->string('model');
                    $table->string('serial');
                    $table->string('computer_name');
                    $table->string('user_name');
                    $table->string('admin_login');
                    $table->string('admin_pw');
                    $table->string('user_login');
                    $table->string('user_pw');
                    $table->string('os_version');
                    $table->string('antivirus');
                    $table->string('office_version');
                    $table->string('office_key');
                    $table->string('remote_access_info');
                });
                Schema::create('n_smartphone', function(Blueprint $table){
                    $table->engine = 'InnoDB';
                    $table->increments('id');
                    $table->integer('network_id')->unsigned();
                    $table->string('brand');
                    $table->string('model');
                    $table->string('username');
                });
                Schema::create('n_user_accounts', function(Blueprint $table){
                    $table->engine = 'InnoDB';
                    $table->increments('id');
                    $table->integer('network_id')->unsigned();
                    $table->string('username');
                    $table->string('phone');
                    $table->string('gsm');
                    $table->string('email');
                    $table->string('function');
                    $table->string('login');
                    $table->string('pw');
                });
                Schema::create('n_backup_info', function(Blueprint $table){
                    $table->engine = 'InnoDB';
                    $table->increments('id');
                    $table->integer('network_id')->unsigned();
                    $table->string('brand');
                    $table->string('type');
                    $table->string('admin_page');
                    $table->string('admin_user');
                    $table->string('admin_pw');
                    $table->string('encryption_key');
                }); 
                Schema::create('n_website', function(Blueprint $table){
                    $table->engine = 'InnoDB';
                    $table->increments('id');
                    $table->integer('network_id')->unsigned();
                    $table->string('domain');
                    $table->string('hosting_provider_name');
                    $table->string('logon_account');
                    $table->string('tfp_logon_account');
                    $table->string('tfp_password_account');
                    $table->string('ftp_name');
                    $table->string('ftp_port');
                });
                Schema::create('n_sql', function(Blueprint $table){
                    $table->engine = 'InnoDB';
                    $table->increments('id');
                    $table->integer('network_id')->unsigned();
                    $table->string('brand');
                    $table->string('version');
                    $table->string('name');
                    $table->string('admin_user');
                    $table->string('admin_pw');
                });
                Schema::create('n_crm', function(Blueprint $table){
                    $table->engine = 'InnoDB';
                    $table->increments('id');
                    $table->integer('network_id')->unsigned();
                    $table->string('brand');
                    $table->string('version');
                    $table->string('name');
                    $table->string('usage');
                    $table->string('admin_user');
                    $table->string('admin_pw');
                    $table->string('tech_support_phone');
                    $table->string('tech_support_email');
                });
              
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('n_network');
                Schema::drop('n_internet_subscription');
                Schema::drop('n_modem');
                Schema::drop('n_remote_access');
                Schema::drop('n_firewall');
                Schema::drop('n_switch');
                Schema::drop('n_antivirus_info');
                Schema::drop('n_wireless_access_point');
                Schema::drop('n_server');
                Schema::drop('n_vmware');
                Schema::drop('n_ms_licenses');
                Schema::drop('n_laptop_info');
                Schema::drop('n_desktop_info');
                Schema::drop('n_printer');
                Schema::drop('n_tablet_info');
                Schema::drop('n_smartphone');
                Schema::drop('n_user_accounts');
                Schema::drop('n_website');
                Schema::drop('n_sql');
                Schema::drop('n_crm');
                Schema::drop('n_backup_info');
	}

}