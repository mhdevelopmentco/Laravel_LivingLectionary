<?php
class BaseController extends Controller 
{

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */

   protected function setupLayout()
   {
	if(!is_null($this->layout))
	{
	$this->layout = view($this->layout);
	}
   }

   public function __construct()
   {
     $get_fb_app_id = Home::get_fb_app_id(); 
     View::share('get_fb_app_id', $get_fb_app_id);
   }

}
