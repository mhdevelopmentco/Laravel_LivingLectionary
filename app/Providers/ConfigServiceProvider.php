<?php 
namespace App\Providers;
use DB;
use Config;
use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider {

	/**
	 * Overwrite any vendor / package configuration.
	 *
	 * This service provider is intended to provide a convenient location for you
	 * to overwrite any "vendor" or package configuration that you may want to
	 * modify before the application handles the incoming request / command.
	 *
	 * @return void
	 */
	public function boot()
	{
		// $smtp_data = DB::table('nm_smtp')->first();
		// Config::set('mail.host', $smtp_data->sm_host);
		// Config::set('mail.port', $smtp_data->sm_port);
		// Config::set('mail.username', $smtp_data->sm_uname);
		// Config::set('mail.password', $smtp_data->sm_pwd);
	}
	public function register()
	{
		// $smtp_data = DB::table('nm_smtp')->first();
		// echo $smtp_data->sm_uname;
		// echo $smtp_data->sm_pwd;
		// Config::set('mail.host', $smtp_data->sm_host);
		// Config::set('mail.port', $smtp_data->sm_port);
		// Config::set('mail.username', $smtp_data->sm_uname);
		// Config::set('mail.password', $smtp_data->sm_pwd);
		config([
		]);
	}

}
