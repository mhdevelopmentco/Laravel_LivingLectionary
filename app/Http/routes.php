<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*-----------------------------
 * 1. LIVE SITE ROUTES
 * ----------------------------
  */
//show index page
Route::get('/', 'HomeController@index');
Route::get('index', 'HomeController@index');
Route::get('home', 'HomeController@index');
//show about us page
Route::get('about_us','HomeController@aboutus');
//show forum page
Route::get('forums', 'HomeController@forums');
//show affirmations page
Route::get('affirmations', 'HomeController@affirmations');
//show one affirmation page
Route::get('affirmations/{theme_name}', 'HomeController@show_theme');
//Route::get('show_theme/{id}', 'HomeController@show_theme');

//show contributors
Route::get('contributors', 'HomeController@show_contributors');
Route::get('contributors', 'HomeController@show_contributors');

//custom 404 page
Route::get('not_found', 'HomeController@not_found');
Route::get('error_occurred', 'HomeController@error_occurred');

//show terms and conditions page
Route::get('terms_and_conditions', 'HomeController@termsandconditons');
//show privacy policy page
Route::get('privacy_policy', 'HomeController@privacy_policy');
//show faq page
Route::get('faq', 'HomeController@faq');
//show all store
Route::get('shops', 'HomeController@shops');
//show one store
Route::get('storeview/{id}', 'HomeController@storeview');
//search from live site
Route::get('do_search', 'HomeController@do_search');
//show search page
Route::get('search', 'HomeController@show_search_page');
//get sub theme from given parent theme
Route::get('get_sub_affirmation', 'ThemeController@get_sub_affirmation');
//show contact us page
Route::get('contactus', 'HomeController@contactus');
//Contact Submit from live site
Route::post('contact_submit', 'HomeController@contact_submit');
//search from theme
Route::get('search_from_theme', 'HomeController@search_from_theme');
//show all products
Route::get('products', 'HomeController@products');
//show products by category
Route::get('catproducts/{name}/{id}', 'HomeController@category_product_list');
//show one product
Route::get('productview/{id}', 'HomeController@productview');
//give comment to product
Route::post('productcomments','HomeController@productcomments');
//add product to cart at product page
Route::post('add_to_cart', 'HomeController@add_to_cart');
//add product to wishlist
Route::post('addtowish','HomeController@addtowish');
//remove product from wishlist
Route::get('remove_product_from_wishlist/{wishlist_id}', 'HomeController@remove_product_from_wishlist');

//subscribe to email list
Route::get('subscribe_submit', 'HomeController@subscribe_submit');
Route::post('subscribe_submit', 'HomeController@subscribe_submit');


/*CART AND PAYMENT PROCESSS */
//show cart page
Route::get('cart', 'HomeController@cart');
//check zipcode for delivership
Route::get('check_estimate_zipcode' , 'HomeController@check_estimate_zipcode');
//remove one item from cart
Route::get('remove_session_cart_data', 'HomeController@remove_session_cart_data');
//reset the product count for one item
Route::get('set_quantity_session_cart', 'HomeController@set_quantity_session_cart');
//show deal cart page
Route::get('deal_cart', 'HomeController@deal_cart');
Route::get('addtocart_deal', 'HomeController@deal_cart');
//add product to deal cart
Route::post('addtocart_deal', 'HomeController@add_to_cart_deal');
//remove one item from deal cart
Route::get('remove_session_dealcart_data', 'HomeController@remove_session_dealcart_data');
//reset the product count for deal cart item
Route::get('set_quantity_session_dealcart', 'HomeController@set_quantity_session_dealcart');
//show checkout page
Route::get('checkout', 'HomeController@checkout');
//Route::get('checkout', 'HomeController@comming_soon');

/*Payment*/
Route::post('process_checkout', 'PaymentController@process_checkout');
Route::post('pay_from_customer', array('as' => 'pay.pay_from_customer','uses' => 'PaymentController@pay_from_customer',));
Route::get('paypal', array('as' => 'get_payment_status','uses' => 'PaymentController@get_payment_status',));
Route::get('paypal_test', array('as' => 'get_payment_status_test','uses' => 'PaymentController@get_payment_status_test',));
Route::get('payment_success_from_customer', 'PaymentController@payment_success_from_customer');
Route::get('checkout_success', 'PaymentController@checkout_success');
Route::get('checkout_done', 'PaymentController@checkout_done');


//payment checkout process
Route::post('payment_checkout_process', 'HomeController@payment_checkout_process');
//show payment result
Route::get('show_payment_result/{orderid}', 'HomeController@show_payment_result');
Route::get('show_payment_result_cod/{orderid}', 'HomeController@show_payment_result_cod');


/*USER LOGIN AND REGISTER, LOGOUT*/
//show register page on live site
Route::get('join', 'HomeController@register');
//register user submit for live site member
Route::post('register_submit','HomeController@register_submit');
//resend member register success email
Route::get('resend_member_register_success', 'HomeController@resend_member_register_success');
//show member update page
Route::get('become_a_contributor', 'HomeController@become_a_contributor');
//register update as contributor from member
Route::get('register_as_contributor_submit', 'HomeController@register_as_contributor_submit');
Route::post('register_as_contributor_submit', 'HomeController@register_as_contributor_submit');
// show register update result page
Route::get('confirm_contributor', 'HomeController@confirm_contributor');
//user login submit for live site
Route::post('user_login_submit','HomeController@user_login_submit');
//send user forgot password
Route::get('user_forgot_submit','HomeController@password_emailcheck');
//send user forgot username
Route::get('username_forgot_submit','HomeController@username_forgot_submit');
//user log out from live site
Route::get('user_logout','HomeController@user_logout');
//resend register member success email
Route::get('resend_member_register_success', 'HomeController@resend_member_register_success');
//resend register update success email
Route::get('resend_contributor_register_success', 'HomeController@resend_contributor_register_success');
//show user reset password modal by email
Route::get('user_forgot_pwd_email/{email_id}','HomeController@user_forgot_pwd_email');
//reset user password
Route::get('user_reset_password_submit','HomeController@user_reset_password_submit');
//activate account
Route::get('activate_account/{encoded_member_id}', 'HomeController@activate_account');
//login only for checkout guest
Route::post('checkout_guest_submit', 'HomeController@checkout_as_guest_submit');

/*
 * Member Settings Page
 * Member Account, Store info(for contributor), Ship Info, Buys, Wishlist, Cod Details
 * */

//show member account info
Route::get('settings','HomeController@get_userprofile');
//show wish list
Route::get('my_wishlist','HomeController@get_userprofile');
//show order products list
Route::get('my_buys','HomeController@get_userprofile');
//show shipf info
Route::get('my_shipinfo','HomeController@get_userprofile');
//show newsletter settings
Route::get('my_newsget_setting','HomeController@get_userprofile');
//show contributor store info
Route::get('my_store','HomeController@get_userprofile');
//update user settings info from settings page
Route::get('update_username_ajax','HomeController@update_username_ajax');
Route::get('update_userid_ajax','HomeController@update_userid_ajax');
Route::post('update_password_ajax','HomeController@update_password_ajax');
Route::get('update_phonenumber_ajax','HomeController@update_phonenumber_ajax');
Route::get('update_address_ajax','HomeController@update_address_ajax');
Route::get('update_newsget_ajax','HomeController@update_newsget_ajax');
Route::get('update_city_ajax','HomeController@update_city_ajax');
Route::get('update_shipinfo','HomeController@update_shipinfo');
Route::post('update_store_info_of_contributor', 'HomeController@update_store_info_of_contributor');
Route::post('profile_image_submit','HomeController@profile_image_submit');
//show add product by contributor page
Route::get('add_my_resource', 'HomeController@add_product_by_contributor');
Route::get('ADD_MY_RESOURCE', 'HomeController@add_product_by_contributor');
//add product by contributor from live site
Route::get('add_product_submit_by_contributor', 'HomeController@add_product_submit_by_contributor');
Route::post('add_product_submit_by_contributor', 'HomeController@add_product_submit_by_contributor');



//todo
Route::get('autosearch', 'HomeController@autosearch');
Route::get('category_list/{id}', 'HomeController@category_list');
Route::get('cms/{id}', 'HomeController@cms');
Route::get('newsletter/', 'HomeController@newsletter');
Route::post('subscription_submit','HomeController@subscription_submit');
Route::get('compare','HomeController@compare');
Route::post('dealcomments','HomeController@dealcomments');
Route::post('storecomments','HomeController@storecomments');
Route::get('sold', 'HomeController@sold');
Route::get('front_newsletter_submit', 'FooterController@front_newsletter_submit');
Route::get('check_title','FooterController@check_title');
Route::post('user_ad_ajax','FooterController@user_ad_ajax');
Route::get('register_getcountry','RegisterController@register_getcountry_ajax');
Route::get('register_emailcheck','RegisterController@register_emailcheck_ajax');
Route::get('insert_inquriy_ajax','FooterController@insert_inquriy_ajax');
Route::get('blog', 'FooterController@blog');
Route::get('blog_category/{id}', 'FooterController@blog_category');
Route::get('blog_view/{id}', 'FooterController@blog_view');
Route::get('blog_comment/{id}', 'FooterController@blog_comment');
Route::post('blog_comment_submit', 'FooterController@blog_comment_submit');
Route::get('pages/{id}', 'FooterController@get_front_cms_pages');
Route::get('nearbystore', 'HomeController@nearmemap');
Route::get('paypal_checkout_success', 'HomeController@paypal_checkout_success');
Route::get('paypal_checkout_cancel', 'HomeController@paypal_checkout_cancel');
Route::post('bid_payment', 'HomeController@bid_payment');
Route::get('bid_payment', 'HomeController@bid_payment_error');
Route::post('place_bid_payment', 'HomeController@place_bid_payment');
Route::get('place_bid_payment', 'HomeController@bid_payment_error');
Route::get('register_getcity_shipping','MemberController@register_getcity_shipping');







/*
 * -------------------------
 * 2. SITE ADMIN
 * --------------------------
 * */

/*
 * SITE ADMIN LOGIN
 * */
// show admin login page
Route::get('siteadmin', 'AdminController@siteadmin');
// admin login submit
Route::post('login_check', 'AdminController@login_check');
// admin forgot password mail send
Route::post('forgot_check', 'AdminController@forgot_check');
// admin logout
Route::get('admin_logout', 'AdminController@admin_logout');
//show admin_dashboard page
Route::get('siteadmin_dashboard', 'AdminController@siteadmin_dashboard');

//ADMIN SETTINGS
Route::get('admin_settings', 'AdminController@admin_settings');
Route::post('admin_settings_submit', 'AdminController@admin_settings_submit');
Route::get('admin_profile', 'AdminController@admin_profile');

/*
 *  SITE ADMIN SETTINGS
 * */

// General Settings
Route::get('general_setting', 'SettingsController@general_setting');
Route::post('general_setting_submit', 'SettingsController@general_setting_submit');
// Email And contact settings
Route::get('email_setting', 'SettingsController@email_setting');
Route::post('email_setting_submit', 'SettingsController@email_setting_submit');
// Social Media settings
Route::get('social_media_settings','SettingsController@social_media_settings');
Route::post('social_media_setting_submit', 'SettingsController@social_media_setting_submit');
// Payment Settings
Route::get('payment_settings', 'SettingsController@payment_settings');
Route::get('select_currency_value_ajax', 'SettingsController@select_currency_value_ajax');
Route::post('payment_settings_submit', 'SettingsController@payment_settings_submit');
// Image settings
Route::get('img_settings', 'SettingsController@img_settings');
Route::post('add_logo_submit', 'SettingsController@add_logo_submit');
Route::post('add_favicon_submit', 'SettingsController@add_favicon_submit');
Route::post('add_noimage_submit', 'SettingsController@add_noimage_submit');

// Banner Settings
Route::get('add_banner_image', 'SettingsController@add_banner_image');
Route::post('add_banner_submit', 'SettingsController@add_banner_submit');
Route::get('manage_banner_image', 'SettingsController@manage_banner_image');
Route::get('edit_banner_image/{id}', 'SettingsController@edit_banner_image');
Route::post('edit_banner_submit', 'SettingsController@edit_banner_submit');
Route::get('delete_banner_submit/{id}', 'SettingsController@delete_banner_submit');
Route::get('status_banner_submit/{id}/{status}', 'SettingsController@status_banner_submit');

// Country Settings
Route::get('add_country', 'SettingsController@add_country');
Route::post('add_country_submit', 'SettingsController@add_country_submit');
Route::get('manage_country', 'SettingsController@manage_country');
Route::post('update_country_submit', 'SettingsController@update_country_submit');
Route::get('edit_country/{id}', 'SettingsController@edit_country');
Route::get('delete_country/{id}', 'SettingsController@delete_country');
Route::get('status_country_submit/{id}/{status}', 'SettingsController@update_status_country');
Route::post('update_default_country_submit', 'SettingsController@update_default_country_submit');

// State Settings
Route::get('add_state', 'SettingsController@add_state');
Route::post('add_state_submit', 'SettingsController@add_state_submit');
Route::get('manage_state', 'SettingsController@manage_state');
Route::post('edit_state_submit', 'SettingsController@edit_state_submit');
Route::get('edit_state/{id}', 'SettingsController@edit_state');
Route::get('delete_state/{id}', 'SettingsController@delete_state');
Route::get('status_state_submit/{id}/{status}', 'SettingsController@status_state_submit');
Route::post('update_default_state_submit', 'SettingsController@update_default_state_submit');
Route::get('select_state_by_country', 'SettingsController@select_state_by_country');

//Tax Settings
Route::get('add_tax', 'SettingsController@add_tax');
Route::post('add_tax_submit', 'SettingsController@add_tax_submit');
Route::get('manage_tax', 'SettingsController@manage_tax');
Route::post('edit_tax_submit', 'SettingsController@edit_tax_submit');
Route::get('edit_tax/{id}', 'SettingsController@edit_tax');
Route::get('delete_tax/{id}', 'SettingsController@delete_tax');
Route::get('status_tax_submit/{id}/{status}', 'SettingsController@status_tax_submit');
Route::post('update_default_tax_submit', 'SettingsController@update_default_tax_submit');


// City Settings
Route::get('add_city', 'SettingsController@add_city');
Route::post('add_city_submit', 'SettingsController@add_city_submit');
Route::get('manage_city', 'SettingsController@manage_city');
Route::post('edit_city_submit', 'SettingsController@edit_city_submit');
Route::get('edit_city/{id}', 'SettingsController@edit_city');
Route::get('delete_city/{id}', 'SettingsController@delete_city');
Route::get('status_city_submit/{id}/{status}', 'SettingsController@status_city_submit');
Route::post('update_default_city_submit', 'SettingsController@update_default_city_submit');
Route::get('select_city_by_state', 'SettingsController@select_city_by_state');


// CMS Settings
Route::get('add_cms_page', 'SettingsController@add_cms_page');
Route::post('cms_add_page_submit','SettingsController@cms_add_page_submit');
Route::get('manage_cms_page', 'SettingsController@manage_cms_page');
Route::get('edit_cms_page/{id}', 'SettingsController@edit_cms_page');
Route::post('edit_cms_page_submit', 'SettingsController@edit_cms_page_submit');
Route::get('block_cms_page/{id}/{status}', 'SettingsController@block_cms_page');
Route::get('delete_cms_page/{id}','SettingsController@delete_cms_page');
Route::get('aboutus_page','SettingsController@aboutus_page');
Route::post('aboutus_page_update','SettingsController@aboutus_page_update');
Route::get('aboutus_page_update','SettingsController@aboutus_page_update');
Route::get('terms','SettingsController@terms');
Route::post('terms_update','SettingsController@terms_update');
Route::get('privacy','SettingsController@privacy');
Route::post('privacy_update','SettingsController@privacy_update');


// ADS Settings
Route::get('add_ad', 'SettingsController@add_ad');
Route::post('add_ad_submit', 'SettingsController@add_ad_submit');
Route::get('manage_ad', 'SettingsController@manage_ad');
Route::get('edit_ad/{id}', 'SettingsController@edit_ad');
Route::post('edit_ad_submit', 'SettingsController@edit_ad_submit');
Route::get('delete_ad/{id}', 'SettingsController@delete_ad');
Route::get('status_ad_submit/{id}/{status}', 'SettingsController@status_ad_submit');


// FAQ Settings
Route::get('add_faq', 'SettingsController@add_faq');
Route::get('manage_faq', 'SettingsController@manage_faq');
Route::post('add_faq_submit', 'SettingsController@add_faq_submit');
Route::post('update_faq_submit', 'SettingsController@update_faq_submit');
Route::get('edit_faq/{id}', 'SettingsController@edit_faq');
Route::get('delete_faq/{id}', 'SettingsController@delete_faq');
Route::get('status_faq_submit/{id}/{status}', 'SettingsController@update_status_faq');

// SECURITY QUESTIONS
Route::get('add_secq', 'SettingsController@add_secq');
Route::get('manage_secq', 'SettingsController@manage_secq');
Route::post('add_secq_submit', 'SettingsController@add_secq_submit');
Route::post('update_secq_submit', 'SettingsController@update_secq_submit');
Route::get('edit_secq/{id}', 'SettingsController@edit_secq');
Route::get('delete_secq/{id}', 'SettingsController@dexlete_secq');
Route::get('status_secq_submit/{id}/{status}', 'SettingsController@update_status_secq');

//NEWSLETTER SETTINGS
Route::get('send_newsletter', 'SettingsController@send_newsletter');
Route::post('send_newsletter_submit', 'SettingsController@send_newsletter_submit');
Route::get('manage_newsletter_subscribers', 'SettingsController@manage_newsletter_subscribers');
Route::get('edit_newsletter_subscriber_status/{id}/{status}', 'SettingsController@edit_newsletter_subscriber_status');
Route::get('delete_newsletter_subscriber/{id}', 'SettingsController@delete_newsletter_subscriber');
Route::get('unsubscribe_from_newsletter/{id}', 'SettingsController@unsubscribe_from_newsletter');

//STMP SETTINGS
Route::get('smtp_setting', 'SettingsController@smtp_setting');
Route::post('smtp_setting_submit', 'SettingsController@smtp_setting_submit');
Route::post('send_setting_submit', 'SettingsController@send_setting_submit');


//Zipcode Settings
Route::get('add_estimated_zipcode', 'ProductController@add_estimated_zipcode');
Route::post('add_estimated_zipcode_submit', 'ProductController@add_estimated_zipcode_submit');
Route::get('estimated_zipcode','ProductController@estimated_zipcode');
Route::get('edit_zipcode/{id}', 'ProductController@edit_zipcode');
Route::post('edit_estimated_zipcode_submit', 'ProductController@edit_estimated_zipcode_submit');
Route::get('block_zipcode/{id}/{status}', 'ProductController@block_zipcode');
Route::get('remove_zipcode/{id}', 'ProductController@remove_zipcode');




/*
 * SITE ADMIN CATEGORY SETTING
 * */
Route::get('add_category', 'CategoryController@add_category');
Route::post('add_category_submit', 'CategoryController@add_category_submit');
Route::get('manage_category', 'CategoryController@manage_category');
Route::get('edit_category/{id}', 'CategoryController@edit_category');
Route::post('edit_category_submit', 'CategoryController@edit_category_submit');
Route::get('status_category_submit/{id}/{status}', 'CategoryController@status_category_submit');
Route::get('delete_category/{id}', 'CategoryController@delete_category');
Route::get('select_category_from_theme', 'CategoryController@select_category_from_theme');

Route::get('add_main_category/{id}', 'CategoryController@add_main_category');
Route::post('add_main_category_submit', 'CategoryController@add_main_category_submit');
Route::get('manage_main_category/{id}', 'CategoryController@manage_main_category');
Route::get('edit_main_category/{id}', 'CategoryController@edit_main_category');
Route::post('edit_main_category_submit', 'CategoryController@edit_main_category_submit');
Route::get('status_main_category_submit/{id}/{mc_id}/{status}', 'CategoryController@status_main_category_submit');
Route::get('delete_main_category/{id}/{mc_id}', 'CategoryController@delete_main_category');

Route::get('add_sub_main_category/{id}', 'CategoryController@add_sub_main_category');
Route::post('add_sub_category_submit', 'CategoryController@add_sub_category_submit');
Route::get('manage_sub_category/{id}', 'CategoryController@manage_sub_category');
Route::get('status_sub_category_submit/{id}/{mc_id}/{status}', 'CategoryController@status_subsec_category_submit');
Route::get('delete_sub_category/{id}/{smc_id}/{mc_id}', 'CategoryController@delete_subsec_category');

Route::get('add_secsub_main_category/{id}', 'CategoryController@add_secsub_main_category');
Route::post('add_secsub_category_submit', 'CategoryController@add_secsub_main_category_submit');
Route::get('edit_secsub_main_category/{id}', 'CategoryController@edit_secsub_main_category');
Route::post('edit_secsub_category_submit', 'CategoryController@edit_secsub_category_submit');
Route::get('manage_secsubmain_category/{id}', 'CategoryController@manage_secsubmain_category');
Route::get('status_secsub_category_submit/{id}/{mc_id}/{status}', 'CategoryController@status_secsub_category_submit');
Route::get('delete_secsub_category/{id}/{sb_id}/{smc_id}', 'CategoryController@delete_secsub_category');
Route::get('edit_sec1sub_main_category/{id}', 'CategoryController@edit_sec1sub_main_category');
Route::post('edit_sec1sub_category_submit', 'CategoryController@edit_sec1sub_category_submit');



/*
 *  SITE ADMIN THEME SETTINGS
 * */
Route::get('add_affirmation', 'ThemeController@add_affirmation');
Route::post('add_affirmation_submit', 'ThemeController@add_affirmation_submit');
Route::get('add_sub_affirmation/{id}', 'ThemeController@add_sub_affirmation');
Route::post('add_sub_affirmation_submit', 'ThemeController@add_sub_affirmation_submit');
Route::get('edit_affirmation/{id}', 'ThemeController@edit_affirmation');
Route::post('edit_affirmation_submit', 'ThemeController@edit_affirmation_submit');
Route::get('edit_sub_affirmation/{id}', 'ThemeController@edit_sub_affirmation');
Route::post('edit_sub_affirmation_submit', 'ThemeController@edit_sub_affirmation_submit');
Route::get('manage_affirmation', 'ThemeController@manage_affirmations');
Route::get('manage_sub_affirmations/{id}', 'ThemeController@manage_sub_affirmations');
Route::get('delete_affirmation/{id}', 'ThemeController@delete_affirmation');
Route::get('status_affirmation_submit/{id}/{status}', 'ThemeController@status_affirmation_submit');



/*
 * SITE ADMIN PRODUCTS
 *
 */

Route::get('resource_dashboard', 'AdminController@resource_dashboard');

Route::get('add_product', 'ProductController@add_product');
Route::post('add_product_submit', 'ProductController@add_product_submit');
Route::post('edit_product_submit', 'ProductController@edit_product_submit');
Route::get('edit_product/{id}', 'ProductController@edit_product');
Route::get('delete_product/{id}', 'ProductController@delete_product');
Route::get('block_product/{id}/{status}','ProductController@block_product');
Route::get('set_trending_product/{id}/{status}','ProductController@set_trending_product');
Route::get('set_present_product/{id}/{status}','ProductController@set_present_product');
Route::get('product_details/{id}', 'ProductController@product_details');
Route::get('manage_pending_approved_product','ProductController@manage_pending_approved_product');
Route::post('manage_pending_approved_product','ProductController@manage_pending_approved_product');
Route::get('manage_disapproved_product','ProductController@manage_disapproved_product');
Route::post('manage_disapproved_product','ProductController@manage_disapproved_product');


Route::get('download_product/{file_name}', 'ProductController@download_product_file');

Route::get('sold_product', 'ProductController@sold_product');
Route::post('sold_product', 'ProductController@sold_product');
Route::get('manage_product_shipping_details','ProductController@manage_product_shipping_details');
Route::get('manage_cashondelivery_details','ProductController@manage_cashondelivery_details');

//product review
Route::get('manage_review','ProductController@manage_review');
Route::get('edit_review/{id}', 'ProductController@edit_review');
Route::post('edit_review_submit', 'ProductController@edit_review_submit');
Route::get('block_review/{id}/{status}','ProductController@block_review');
Route::get('delete_review/{id}', 'ProductController@delete_review');

//ajax
Route::get('product_getmaincategory', 'ProductController@product_getmaincategory');
Route::get('product_getsubcategory', 'ProductController@product_getsubcategory');
Route::get('product_getsecondsubcategory', 'ProductController@product_getsecondsubcategory');

Route::get('instant_search_by_name', 'ProductController@instant_search_by_name');
Route::get('product_getsubcategory_list/{level}', 'ProductController@product_getsubcategory_list');

Route::get('product_getmerchantshop', 'ProductController@product_getmerchantshop');
Route::get('product_getmerchantshop_ajax', 'ProductController@product_getmerchantshop');


//Transactions
//Merchant Products Transactions
Route::get('transaction_dashboard', 'AdminController@show_transaction_dashboard');
Route::get('resource_all_orders', 'TransactionController@resource_all_orders');
Route::post('resource_all_orders', 'TransactionController@resource_all_orders');
Route::get('resource_ship_orders', 'TransactionController@resource_ship_orders');
Route::post('resource_ship_orders', 'TransactionController@resource_ship_orders');
Route::get('resource_completed_orders', 'TransactionController@resource_completed_orders');
Route::post('resource_completed_orders', 'TransactionController@resource_completed_orders');


//FUND REQUESTS
Route::get('requested_withdraws', 'TransactionController@requested_withdraws');
Route::get('disallowed_withdraws', 'TransactionController@disallowed_withdraws');
Route::get('success_withdraws', 'TransactionController@success_withdraws');
Route::get('failed_withdraws', 'TransactionController@failed_withdraws');
Route::get('allow_withdraw/{withdraw_id}', 'PaymentController@allow_withdraw');
Route::get('disallow_withdraw/{withdraw_id}', 'TransactionController@disallow_withdraw');

//Pay With Paypal
Route::get('fund_paypal/{data}', 'TransactionController@fund_paypal');
Route::post('paypal_success', 'TransactionController@paypal_success');
Route::post('paypal_ipn', 'TransactionController@paypal_ipn');
Route::get('paypal_cancel', 'TransactionController@paypal_cancel');


/*
 * SITE ADMIN BLOGS
 *
 * */
Route::get('manage_publish_blog', 'BlogController@manage_publish_blog');
Route::get('add_blog', 'BlogController@add_blog');
Route::post('add_blog_submit', 'BlogController@add_blog_submit');
Route::get('edit_blog/{id}', 'BlogController@edit_blog');
Route::post('edit_blog_submit', 'BlogController@edit_blog_submit');
Route::get('manage_draft_blog', 'BlogController@manage_draft_blog');
Route::get('block_blog/{id}/{status}/{blog_type}', 'BlogController@block_blog');
Route::get('delete_blog_submit/{id}/{blog_type}', 'BlogController@delete_blog_submit');
Route::get('blog_details/{id}', 'BlogController@blog_details');
Route::get('blog_settings', 'BlogController@blog_settings');
Route::post('blog_settings_submit', 'BlogController@blog_settings_submit');
Route::get('manage_blogcmts', 'BlogController@manage_blogcomments');
Route::get('status_blogcmt_submit/{cmtid}/{status}','BlogController@status_blogcmt_submit');
Route::get('reply_blogcmts/{cmtid}', 'BlogController@reply_blogcmts');
Route::post('admin_blogreply_submit', 'BlogController@admin_blogreply_submit');



/*
 * SITE ADMIN MERCHANT MANAGEMENT
 *  */
Route::get('merchant_dashboard', 'AdminController@merchant_dashboard');

//manage merchant
Route::get('manage_contributor', 'MemberController@manage_contributor');
Route::post('manage_contributor', 'MemberController@manage_contributor');

Route::get('add_contributor','MemberController@add_contributor');
Route::post('add_contributor_submit', 'MemberController@add_contributor_submit');

Route::get('edit_contributor/{id}','MemberController@edit_contributor');
Route::post('edit_contributor_account_submit', 'MemberController@edit_contributor_submit');

Route::get('delete_merchant/{id}', 'MemberController@delete_merchant');
Route::get('block_merchant/{id}/{status}', 'MemberController@block_merchant');

//manage merchant store
Route::get('manage_store/{id}', 'MemberController@manage_store');
Route::get('add_store/{id}', 'MemberController@add_store');
Route::post('add_store_submit','MemberController@add_store_submit');
Route::get('edit_store/{id}_{mem_id}','MemberController@edit_store');
Route::post('edit_store_submit','MemberController@edit_store_submit');
Route::get('block_store/{id}/{status}/{mem_id}', 'MemberController@block_store');
Route::get('delete_store/{id}/{mem_id}','MemberController@delete_store');




/*
 * SITE ADMIN CUSTOMER
 * */
//manage customer
Route::get('member_dashboard', 'AdminController@member_dashboard');
Route::get('manage_member','MemberController@manage_member');
Route::post('manage_member','MemberController@manage_member');
Route::get('add_member','MemberController@add_member');
Route::post('add_member_submit','MemberController@add_member_submit');
Route::get('edit_member/{id}','MemberController@edit_member');
Route::post('edit_member_submit','MemberController@edit_member_submit');

Route::get('convert_member_to_contributor/{id}', 'MemberController@convert_member_to_contributor');
Route::get('delete_member/{id}','MemberController@delete_member');
Route::get('activate_account_from_admin/{id}','MemberController@activate_account_from_admin');
Route::get('update_member_status/{id}/{status}','MemberController@update_member_status');

//manage subscriber
Route::get('manage_news_subscribers','MemberController@manage_news_subscribers');
Route::get('edit_news_subscriber_status/{id}/{status}','MemberController@edit_news_subscriber_status');
Route::get('delete_news_subscriber/{id}','MemberController@delete_news_subscriber');

/*
 * 3. SITE ADMIN CURATORS and CURATOER ROUTES
 */

//show curator dashboard from admin dashbaord
Route::get('curator_dashboard', 'AdminController@curator_dashboard');
//show add curator page from admin dashboard
Route::get('add_curator','CuratorController@add_curator');
//add curator from admin dashboard
Route::post('add_curator_submit', 'CuratorController@add_curator_submit');
//edit curator from admin dashbaord
Route::get('edit_curator/{id}','CuratorController@edit_curator');
//submit edit curator from admin dashboard
Route::post('edit_curator_submit', 'CuratorController@edit_curator_submit');
//delete curator from admin dashboard
Route::get('delete_curator/{id}', 'CuratorController@delete_curator');
//update curator from admin dashboard
Route::get('updae_curator/{id}/{status}', 'CuratorController@update_curator');
//show all curators from admin dashboard
Route::get('manage_curator', 'CuratorController@manage_curator');
Route::post('manage_curator', 'CuratorController@manage_curator');

//reset curator password
Route::get('sitecurator_reset_pwd/{encoded_curator_email}', 'CuratorController@sitecurator_reset_pwd');
Route::post('reset_curator_password_submit', 'CuratorController@reset_curator_password_submit');
Route::get('reset_curator_password_submit', 'CuratorController@reset_curator_password_submit');



/*For one curator: One curator Dashboard*/
//show sitecurator login page
Route::get('sitecurator', 'CuratorController@sitecurator');
//curator login
Route::post('curator_login_check', 'CuratorController@curator_login_check');
//curator logout
Route::get('curator_logout', 'CuratorController@curator_logout');
//show curator dashboard for one curator
Route::get('one_curator_dashboard', 'CuratorController@one_curator_dashboard');
//show curator profile page for one curator
Route::get('curator_profile', 'CuratorController@curator_profile');
//update curator profile for one curator
Route::post('update_curator_profile_submit', 'CuratorController@update_curator_profile_submit');
//show approved products by this curator
Route::get('curator_approved_resource', 'CuratorController@curator_approved_resource');
//show unapproved products by this contributor
Route::get('curator_disapproved_resource', 'CuratorController@curator_disapproved_resource');
//show unchecked products by this contributor
Route::get('curator_pending_resource', 'CuratorController@curator_pending_resource');
//show product details from curator dashboard
Route::get('curator_resource_details/{id}', 'CuratorController@curator_resource_details');
//show product from curator dashboard to approve-upapprove
Route::get('curator_check_resource/{id}', 'CuratorController@curator_check_resource');
//submit curator result
Route::post('submit_check_result_by_curator', 'CuratorController@submit_check_result_by_curator');
//send reset password for one curator
Route::post('forgot_check_curator', 'CuratorController@forgot_check_curator');
//edit the product by curator
Route::get('edit_product_by_curator/{pro_id}', 'CuratorController@edit_product_by_curator');
//submit the edit product by curator
Route::post('edit_product_submit_by_curator', 'CuratorController@edit_product_submit_by_curator');

// Miscellous
Route::get('chart', 'AdminController@chart');




/*
 * -------------------------
 * 4. SITE MERCHANT
 * --------------------------
 * */


/*
  * Merchant Login
 * */

Route::get('sitemerchant', 'MerchantController@merchant_login');
Route::post('mer_login_check', 'MerchantController@merchant_login_check');
Route::post('merchant_forgot_check', 'MerchantController@merchant_forgot_check');
Route::get('forgot_pwd_email/{email}', 'MerchantController@forgot_pwd_email');
Route::post('forgot_pwd_email_submit', 'MerchantController@forgot_pwd_email_submit');
Route::get('merchant_logout', 'MerchantController@merchant_logout');

/*
  * Merchant Dashboard
 * */

Route::get('sitemerchant_dashboard', 'MerchantController@sitemerchant_dashboard');


/*
  * Merchant Profile and Settings
 * */

Route::get('merchant_profile', 'MerchantController@show_merchant_profile');
//edit merchant info
Route::get('edit_contributor_profile', 'MerchantController@edit_contributor_profile');
Route::post('edit_contributor_submit_in_merchant', 'MerchantController@edit_contributor_submit_in_merchant');
//change password
Route::get('change_merchant_password', 'MerchantController@change_merchant_password');
Route::post('change_password_submit', 'MerchantController@change_password_submit');
Route::get('merchant_settings', 'MerchantController@show_merchant_settings');
Route::post('update_merchant_settings', 'MerchantController@update_merchant_settings');



/*
 * Merchant Shop Management
 * */

Route::get('merchant_manage_shop', 'MerchantController@manage_shop');
Route::post('merchant_manage_shop', 'MerchantController@manage_shop');
Route::get('merchant_add_shop', 'MerchantController@add_shop');
Route::post('merchant_add_shop_submit', 'MerchantController@add_shop_submit');
Route::get('merchant_edit_shop/{store_id}/{merchant_id}', 'MerchantController@edit_shop');
Route::post('merchant_edit_shop_submit', 'MerchantController@edit_shop_submit');
Route::get('merchant_block_shop/{store_id}/{status}/{merchant_id}', 'MerchantController@block_shop');
Route::get('merchant_delete_shop/{store_id}/{merchant_id}', 'MerchantController@delete_shop');



/*
 * Merchant Product Management
 * */
Route::get('mer_manage_pending_approved_product','ProductController@mer_manage_pending_approved_product');
Route::post('mer_manage_pending_approved_product','ProductController@mer_manage_pending_approved_product');
Route::get('mer_manage_disapproved_product','ProductController@mer_manage_disapproved_product');
Route::post('mer_manage_disapproved_product','ProductController@mer_manage_disapproved_product');
Route::get('mer_manage_product','ProductController@mer_manage_pending_approved_product');
Route::post('mer_manage_product','ProductController@mer_manage_pending_approved_product');
Route::get('mer_add_product', 'ProductController@mer_add_product');
Route::post('mer_add_product_submit', 'ProductController@mer_add_product_submit');
Route::get('mer_edit_product/{id}', 'ProductController@mer_edit_product');
Route::post('mer_edit_product_submit', 'ProductController@mer_edit_product_submit');
Route::get('mer_delete_product/{id}', 'ProductController@mer_delete_product');
Route::get('mer_block_product/{id}/{status}','ProductController@block_product');
Route::get('mer_set_trending_product/{id}/{status}','ProductController@mer_set_trending_product');
Route::get('mer_set_present_product/{id}/{status}','ProductController@mer_set_present_product');
Route::get('mer_product_details/{id}', 'ProductController@mer_product_details');
Route::get('mer_sold_product', 'ProductController@mer_sold_product');
Route::post('mer_sold_product', 'ProductController@mer_sold_product');
Route::get('mer_manage_product_shipping_details','ProductController@mer_manage_product_shipping_details');
Route::post('mer_manage_product_shipping_details','ProductController@mer_manage_product_shipping_details');
Route::get('report_as_delivered/{sold_product_id}', 'ProductController@report_as_delivered');




/*
 * Merchant Transaction Management
 *
 * */

//Merchant Products Transactions
Route::get('show_merchant_transactions', 'MerchantController@show_merchant_transactions');
Route::get('merchant_resource_all_orders', 'MerchantController@resource_all_orders');
Route::post('merchant_resource_all_orders', 'MerchantController@resource_all_orders');
Route::get('merchant_resource_ship_orders', 'MerchantController@resource_ship_orders');
Route::post('merchant_resource_ship_orders', 'MerchantController@resource_ship_orders');
Route::get('merchant_resource_completed_orders', 'MerchantController@resource_completed_orders');
Route::post('merchant_resource_completed_orders', 'MerchantController@resource_completed_orders');


/*
 * Merchant Fund Management
 * */

Route::get('withdraw_report', 'MerchantController@withdraw_report');
Route::get('withdraw_request', 'MerchantController@withdraw_request');
Route::post('merchant_withdraw_submit', 'PaymentController@merchant_withdraw_submit');













//local mobile json route

Route::any('front_end_banner_image', 'MobileController@home_page_banner_image');
Route::any('country_list', 'MobileController@country_list');
Route::any('city_list', 'MobileController@mobile_city_list');
Route::any('normal_signup/{name}/{email}/{password}/{country}/{city}', 'MobileController@user_signup');
Route::any('signin/{email}/{password}', 'MobileController@user_login');
Route::any('all_main_category_list', 'MobileController@all_main_category_list');
Route::any('mobile_products', 'MobileController@Products');
Route::any('product_detail_page/{id}', 'MobileController@product_mobile_category_list');
Route::any('product_detail_page_image_list/{id}', 'MobileController@product_detail_page_image_list');
Route::any('mobile_bid_payment/{bid_auc_id}/{oa_cus_id}/{oa_cus_name}/{oa_cus_email}/{oa_cus_address}/{oa_bid_amt}/{oa_bid_shipping_amt}/{oa_original_bit_amt}', 'MobileController@mobile_bid_payment');
Route::any('update_user_profile/{mem_id}/{name}/{email}/{phone}/{country_id}/{city_id}', 'MobileController@update_user_profile');
Route::any('my_buys/{id}', 'MobileController@product_my_buys');
Route::any('profile_image_submit/{mem_id}', 'MobileController@profile_image_submit');
Route::any('sub_category_list/{id}', 'MobileController@sub_category_list');
Route::any('country_selected_city/{id}', 'MobileController@country_selected_city');
Route::any('cash_and_delivery/{mem_id}/{cust_name}/{cust_address}/{cust_mobile}/{cust_city}/{cust_country}/{cust_zip}', 'MobileController@shipping_delivery');
Route::any('purchase_cod_order_list/{mem_id}/{pro_id}/{cod_qty}/{cod_amt}/{cod_pro_color}/{cod_pro_size}/{order_type}/{ship_addr}/{token_id}', 'MobileController@purchase_cod_order_list');
Route::any('paypal/{mem_id}/{pro_id}/{cod_qty}/{cod_amt}/{cod_pro_color}/{cod_pro_size}/{order_type}/{ship_addr}/{token_id}', 'MobileController@paypal');
Route::any('bidding_history/{mem_id}', 'MobileController@bidding_history');

Route::any('near_me_map_products', 'MobileController@near_me_map_products');
Route::any('stores_list', 'MobileController@stores_list');


Route::any('get_profile_image/{mem_id}', 'MobileController@get_profile_image');
Route::any('store_productview_detail_by_id/{store_id}', 'MobileController@store_productview_detail_by_id');
Route::any('terms_condition', 'MobileController@terms_condition');
Route::any('related_product_details/{pid}', 'MobileController@related_product_details');
Route::any('add_position', 'MobileController@add_position');
Route::any('add_pages', 'MobileController@add_pages');
Route::any('request_for_advertisment/{add_title}/{ads_position}/{ads_pages}/{url}', 'MobileController@request_for_advertisment');
Route::any('forgot_password_check/{email}', 'MobileController@forgot_password_check');


// Vinod mobile api

Route::any('home_page', 'MobileController@home_page_details');