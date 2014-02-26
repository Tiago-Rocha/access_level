<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddAllSoftdeletes extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('i_invoices', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('i_invoice_content', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('i_invoice_template', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('n_antivirus_info', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('n_backup_info', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('n_crm', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('n_desktop_info', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('n_firewall', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('n_internet_subscription', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('n_laptop_info', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('n_modem', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('n_ms_licenses', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('n_network', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('n_printer', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('n_remote_access', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('n_server', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('n_smartphone', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('n_sql', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('n_switch', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('n_tablet_info', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('n_user_accounts', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('n_vmware', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('n_website', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('n_wireless_access_point', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('servicereports', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('users', function(Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('utilizadors', function(Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

    }

}