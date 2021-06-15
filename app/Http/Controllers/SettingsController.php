<?php
namespace App\Http\Controllers;

use App\Http\Models;
use App\Register;
use App\Home;
use App\Footer;
use App\Settings;
use App\Country;
use App\State;
use App\City;
use App\Member;
use App\Blog;
use App\Dashboard;
use App\Admodel;
use App\Faqmodel;
use App\Bannerset;
use App\Cms;
use App\SecurityQuestion;
use App\Tax;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


use DB;
use Session;


class SettingsController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@showWelcome');
    */

    //general settings
    public function general_setting()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $general_settings = Settings::view_general_setting();
            $language_list = Settings::view_language_list();
            $theme_list = Settings::view_theme_list();
            return view('siteadmin.general_settings')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('general_settings', $general_settings)->with('language_list', $language_list)->with('theme_list', $theme_list);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function general_setting_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array(
                '_token'
            ));
            $rule = array(
                'site_name' => 'required',
                'meta_title' => 'required',
                'meta_key' => 'required',
                'meta_desc' => 'required'
            );

            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('general_setting')->withErrors($validator->messages())->withInput();

            } else {

                $entry = array(
                    'gs_sitename' => Input::get('site_name'),
                    'gs_metatitle' => Input::get('meta_title'),
                    'gs_metakeywords' => Input::get('meta_key'),
                    'gs_metadesc' => Input::get('meta_desc'),
                    'gs_payment_status' => Input::get('payment_status'),
                    'gs_themes' => Input::get('themes')
                );
                $return = Settings::save_general_set($entry);
                return Redirect::to('general_setting')->with('success', 'Record Updated Successfully');

            }
        } else {
            return Redirect::to('siteadmin');
        }
    }


    //email and contact settings
    public function email_setting()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $email_settings = Settings::view_email_settings();
            return view('siteadmin.email_settings')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('email_settings', $email_settings);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function email_setting_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array(
                '_token'
            ));
            $rule = array(
                'Contact_Name' => 'required',
                'Contact_Email' => 'required|email',
                'Webmaster_Email' => 'required|email',
            );

            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('email_setting')->withErrors($validator->messages())->withInput();

            } else {

                $entry = array(
                    'es_contactname' => Input::get('Contact_Name'),
                    'es_contactemail' => Input::get('Contact_Email'),
                    'es_webmasteremail' => Input::get('Webmaster_Email'),
                    'es_noreplyemail' => Input::get('No_Reply_Email'),
                    'es_phone1' => Input::get('Contact_Phone1'),
                    'es_phone2' => Input::get('Contact_Phone2'),
                    'es_latitude' => Input::get('lati'),
                    'es_longitude' => Input::get('long')

                );
                $return = Settings::save_email_set($entry);
                return Redirect::to('email_setting')->with('success', 'Email Settings Updated Successfully');

            }
        } else {
            return Redirect::to('siteadmin');
        }
    }


    //Social Media Settings
    public function social_media_settings()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $social_settings = Settings::social_media_settings();
            return view('siteadmin.social_media_settings')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('social_settings', $social_settings);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function social_media_setting_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array(
                '_token'
            ));
            $rule = array(
                'fb_app_id' => 'required',
                'fb_secret_key' => 'required',
                'fb_page_url' => 'required|url',
                'fb_like_box_url' => 'required|url',
                'twitter_page_url' => 'required|url',
                'twitter_app_id' => 'required',
                'twitter_secret_key' => 'required',
                'linkedin_page_url' => 'required|url',
                'youtube_page_url' => 'required|url',
                'gmap_app_key' => 'required',
                'analytics_code' => 'required'
            );

            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('social_media_settings')->withErrors($validator->messages())->withInput();
            } else {
                $entry = array(
                    'sm_fb_app_id' => Input::get('fb_app_id'),
                    'sm_fb_sec_key' => Input::get('fb_secret_key'),
                    'sm_fb_page_url' => Input::get('fb_page_url'),
                    'sm_fb_like_page_url' => Input::get('fb_like_box_url'),
                    'sm_twitter_url' => Input::get('twitter_page_url'),
                    'sm_twitter_app_id' => Input::get('twitter_app_id'),
                    'sm_twitter_sec_key' => Input::get('twitter_secret_key'),
                    'sm_linkedin_url' => Input::get('linkedin_page_url'),
                    'sm_youtube_url' => Input::get('youtube_page_url'),
                    'sm_gmap_app_key' => Input::get('gmap_app_key'),
                    'sm_android_page_url' => Input::get('android_page_url'),
                    'sm_iphone_url' => Input::get('iphone_page_url'),
                    'sm_analytics_code' => Input::get('analytics_code')
                );
                $result = Settings::update_social_media_settings($entry);
                if ($result) {
                    return Redirect::to('social_media_settings')->with('success', 'Record updated successfully');
                } else {
                    return Redirect::to('social_media_settings')->with('success', 'Something Went wrong');
                }
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }


    // Payment Settings
    public function payment_settings()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $country_settings = Country::get_country_list();
            $get_pay_settings = Settings::get_pay_settings();
            return view('siteadmin.payment_settings')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('country_settings', $country_settings)->with('get_pay_settings', $get_pay_settings);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function payment_settings_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array(
                '_token'
            ));
            $rule = array(
                'country_name' => 'required',
                'country_code' => 'required',
                'currency_symbol' => 'required',
                'currency_code' => 'required',
                'payment_mode' => 'required'
            );

            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('payment_settings')->withErrors($validator->messages())->withInput();
            } else {
                $entry = array(
                    'ps_flatshipping' => Input::get('flat_shipping'),
                    'ps_taxpercentage' => Input::get('tax_percentage'),
                    'ps_extenddays' => Input::get('extended_days'),
                    'ps_alertdays' => Input::get('alert_day'),
                    'ps_minfundrequest' => Input::get('maximum_fund_request'),
                    'ps_maxfundrequest' => Input::get('maximum_fund_request'),
                    'ps_referralamount' => Input::get('referral_amount'),
                    'ps_countryid' => Input::get('country_name'),
                    'ps_countrycode' => Input::get('country_code'),
                    'ps_cursymbol' => Input::get('currency_symbol'),
                    'ps_curcode' => Input::get('currency_code'),
                    'ps_paypalaccount' => Input::get('paypal_account'),
                    'ps_paypal_api_pw' => Input::get('paypal_api_password'),
                    'ps_paypal_api_signature' => Input::get('paypal_api_signature'),
                    'ps_authorize_trans_key' => Input::get('authorizenet_trans_key'),
                    'ps_authorize_api_id' => Input::get('authorizenet_api_id'),
                    'ps_paypal_pay_mode' => Input::get('payment_mode')
                );
                $get_pay_settings = Settings::update_payment_settings($entry);
                return Redirect::to('payment_settings')->with('success', 'Record updated successfully');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function select_currency_value_ajax()
    {
        $id = $_GET['id'];
        $get_currency_ajax = Settings::get_country_value_ajax($id);
        if ($get_currency_ajax && count($get_currency_ajax) > 0) {

            $get_currency_ajax = $get_currency_ajax[0];

            return response()->json(['result' => 'success', 'co_code' => $get_currency_ajax->co_code, 'cur_symbol' => $get_currency_ajax->co_cursymbol, 'cur_code' => $get_currency_ajax->co_curcode]);
        } else {
            return response()->json(['result' => 'fail']);
        }

    }


    // Image Settings
    public function img_settings()
    {
        if (Session::has('userid')) {

            $adminheader = view('siteadmin.includes.admin_header')->with('routemenu', "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $first_logodetails = Settings::get_logo_details();
            $second_logodetails = Settings::get_inverse_logo_details();

            $favicondetails = Settings::get_favicon_details();
            $noimagedetails = Settings::get_noimage_details();

            return view('siteadmin.logosettings')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('logodetails', $first_logodetails)->with('inverse_logodetails', $second_logodetails)
                ->with('favicondetails', $favicondetails)->with('noimagedetails', $noimagedetails);
        } else {
            return Redirect::to('siteadmin');
        }

    }

    public function add_logo_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array(
                '_token'
            ));
            $file = Input::file('logofile');
            $file2 = Input::file('logofile2');


            $dest_dir = './themes/images/logo/';

            if (!file_exists($dest_dir)) {
                File::makeDirectory($dest_dir, 0777, true);
            }

            if ($file != '') {

                $checklogorecord = Settings::get_logo_details();

                $filename = $file->getClientOriginalName();
                $move_img = explode('.', $filename);
                $filename = "sitelogo1." . $move_img[1];

                if ($checklogorecord) {

                    $file_old = $checklogorecord[0]->imgs_name;
                    $file_old_name = $dest_dir . $file_old;
                    if (file_exists($file_old_name))
                        unlink($file_old_name);

                    $uploadSuccess = $file->move($dest_dir, $filename);

                    Settings::update_logo($filename);
                } else {

                    $uploadSuccess = $file->move($dest_dir, $filename);

                    $entry = array(
                        'imgs_name' => $filename,
                        'imgs_type' => 1
                    );
                    Settings::insert_logo($entry);
                }
            }

            if ($file2 != '') {

                $filename2 = $file2->getClientOriginalName();
                $move_img2 = explode('.', $filename2);
                $filename2 = "sitelogo2." . $move_img2[1];


                $checklogorecord2 = Settings::get_inverse_logo_details();

                if ($checklogorecord2) {

                    $file_old2 = $checklogorecord2[0]->imgs_name;
                    $file_old_name2 = $dest_dir . $file_old2;

                    if (file_exists($file_old_name2))
                        unlink($file_old_name2);

                    $uploadSuccess2 = $file2->move($dest_dir, $filename2);

                    Settings::update_logo2($filename2);
                } else {

                    $entry2 = array(
                        'imgs_name' => $filename2,
                        'imgs_type' => 4
                    );

                    $uploadSuccess2 = $file2->move($dest_dir, $filename2);
                    Settings::insert_logo($entry2);
                }
            }

            if ($file2 == '' && $file == "") {
                return Redirect::to('img_settings')->withErrors("Image field required")->withInput();
            } else {
                return Redirect::to('img_settings')->withMessage("Logo Updated")->withInput();
            }

        } else {
            return Redirect::to('siteadmin');
        }

    }

    public function add_favicon_submit()
    {
        if (Session::has('userid')) {

            $data = Input::except(array(
                '_token'
            ));

            $file = Input::file('favfile');
            if ($file != '') {
                $filename = $file->getClientOriginalName();
                $move_img = explode('.', $filename);
                $filename = 'favicon.ico';

                $dest_dir = './themes/images/favicon/';

                if (!file_exists($dest_dir)) {
                    $result = File::makeDirectory($dest_dir, 0777, true);
                }

                $favicondetails = Settings::get_favicon_details();

                if ($favicondetails) {

                    $file_old = $favicondetails[0]->imgs_name;
                    $file_old_name = $dest_dir . $file_old;

                    if (file_exists($file_old_name))
                        unlink($file_old_name);

                    Input::file('favfile')->move($dest_dir, $filename);
                    Settings::update_favicon($filename);
                } else {
                    $entry = array(
                        'imgs_name' => $filename,
                        'imgs_type' => 2
                    );

                    Input::file('favfile')->move($dest_dir, $filename);
                    Settings::insert_favicon($entry);
                }

                return Redirect::to('img_settings')->withMessage("Favicon Updated")->withInput();
            } else {
                return Redirect::to('img_settings')->withErrors("Image field required")->withInput();
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function add_noimage_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array(
                '_token'
            ));

            $file = Input::file('noimgfile');
            if ($file != '') {
                $filename = $file->getClientOriginalName();
                $move_img = explode('.', $filename);
                $filename = $move_img[0] . str_random(8) . "." . $move_img[1];

                $dest_dir = './themes/images/noimage/';

                if (!file_exists($dest_dir)) {
                    $result = File::makeDirectory($dest_dir, 0777, true);
                }

                $noimagedetails = Settings::get_noimage_details();

                if ($noimagedetails) {

                    $file_old = $noimagedetails[0]->imgs_name;
                    $file_old_name = $dest_dir . $file_old;

                    if (file_exists($file_old_name))
                        unlink($file_old_name);

                    Input::file('noimgfile')->move($dest_dir, $filename);

                    Settings::update_noimage($filename);
                } else {
                    $entry = array(
                        'imgs_name' => $filename,
                        'imgs_type' => 3
                    );

                    Input::file('noimgfile')->move($dest_dir, $filename);
                    Settings::insert_noimage($entry);
                }
                return Redirect::to('img_settings')->withMessage("NoImage Updated")->withInput();
            } else {
                return Redirect::to('img_settings')->withErrors("Image field required")->withInput();
            }

        } else {
            return Redirect::to('siteadmin');
        }

    }


    //Banner Settings
    public function add_banner_image()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');
            return view('siteadmin.add_banner')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function manage_banner_image()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $mnge_banner = Bannerset::view_banner_list();
            return view('siteadmin.manage_banner')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('mnge_banner', $mnge_banner);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_banner_image($id)
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $banner_detail = Bannerset::banner_detail($id);
            return view('siteadmin.edit_banner')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('banner_detail', $banner_detail);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function status_banner_submit($id, $status)
    {
        if (Session::has('userid')) {
            $return = Bannerset::status_banner($id, $status);
            return Redirect::to('manage_banner_image')->with('success', 'Record Updated Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function delete_banner_submit($id)
    {
        if (Session::has('userid')) {
            $return = Bannerset::delete_banner($id);
            return Redirect::to('manage_banner_image')->with('success', 'Record Deleted Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function add_banner_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array('_token'));
            $rule = array(
                'bn_title' => 'required'
            );
            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('add_banner_image')->withErrors($validator->messages())->withInput();
            } else {
                $inputs = Input::all();
                $file = Input::file('file');
                if ($file != '') {
                    $filename = $file->getClientOriginalName();
                    $move_img = explode('.', $filename);
                    $filename = $move_img[0] . str_random(8) . "." . $move_img[1];
                    $destinationPath = './public/assets/images/bannerimage/';
                    $uploadSuccess = Input::file('file')->move($destinationPath, $filename);
                    $bn_type = '1,1,1';
                    $entry = array(
                        'bn_title' => Input::get('bn_title'),
                        'bn_type' => $bn_type,
                        'bn_img' => $filename,
                        'bn_redirecturl' => Input::get('bn_redirecturl'),
                    );
                    $return = Bannerset::save_banner($entry);
                    return Redirect::to('manage_banner_image')->with('success', 'Record Inserted Successfully');
                } else {
                    return Redirect::to('add_banner_image')->with('error', 'Image field required')->withInput();
                }
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_banner_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array('_token'));
            $id = Input::get('bn_id');
            $rule = array(
                'bn_title' => 'required'
            );
            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('edit_banner_image/' . $id)->withErrors($validator->messages())->withInput();
            } else {
                $inputs = Input::all();
                $bn_type = '1,1,1';
                $file = Input::file('file');
                if ($file != '') {
                    $filename = $file->getClientOriginalName();
                    $move_img = explode('.', $filename);
                    $filename = $move_img[0] . str_random(8) . "." . $move_img[1];
                    $destinationPath = './public/assets/images/bannerimage/';
                    $uploadSuccess = Input::file('file')->move($destinationPath, $filename);
                    $entry = array(
                        'bn_title' => Input::get('bn_title'),
                        'bn_type' => $bn_type,
                        'bn_img' => $filename,
                        'bn_redirecturl' => Input::get('bn_redirecturl'),
                    );
                } else {
                    $entry = array(
                        'bn_title' => Input::get('bn_title'),
                        'bn_type' => $bn_type,
                        'bn_redirecturl' => Input::get('bn_redirecturl'),
                    );
                }
                $return = Bannerset::update_banner_detail($entry, $id);
                return Redirect::to('manage_banner_image')->with('success', 'Record Updated Successfully');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }


    //Country Settings
    public function add_country()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');
            return view('siteadmin.add_countries')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function manage_country()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');

            $countryresult = Country::view_country_detail();

            return view('siteadmin.manage_countries')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('countryresult', $countryresult);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_country($id)
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');

            $countryresult = Country::showindividual_country_detail($id);

            return view('siteadmin.edit_countries')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('countryresult', $countryresult)->with('id', $id);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function delete_country($id)
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');

            $affected = Country::delete_country_detail($id);
            $countryresult = Country::view_country_detail();

            /* return view('siteadmin.manage_countries')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('specificationresult',$countryresult);*/

            return Redirect::to('manage_country')->with('success', 'Country Deleted Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function update_status_country($id, $status)
    {
        if (Session::has('userid')) {
            $return = Country::update_status_country($id, $status);
            return Redirect::to('manage_country')->with('success', 'Record Updated Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function update_default_country_submit()
    {
        if (Session::has('userid')) {
            $id = Input::get('default_country_id');

            $entry = array(
                'co_default' => 0
            );
            $return = Country::update_default_country_before($entry);

            $entry = array(
                'co_default' => 1
            );
            $return = Country::update_default_country($id, $entry);

            return Redirect::to('manage_country')->with('success', 'Record Updated Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function add_country_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array(
                '_token'
            ));
            $rule = array(
                'cname' => 'required',
                'ccode' => 'required',
                'cursymbol' => 'required',
                'curcode' => 'required'
            );

            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('add_country')->withErrors($validator->messages())->withInput();

            } else {
                $countryname = Input::get('cname');
                $countrycode = Input::get('ccode');
                $currencysymbol = Input::get('cursymbol');
                $currencycode = Input::get('curcode');


                $check_exist_country_name = Country::check_exist_country_name($countryname);
                $check_exist_country_code = Country::check_exist_country_code($countrycode);


                if ($check_exist_country_name) {
                    return Redirect::to('add_country')->withErrors("Country Already Exists")->withInput();
                } else if ($check_exist_country_code) {
                    return Redirect::to('add_country')->withErrors("Country Code  Already Exists")->withInput();
                } else {

                    $entry = array(
                        'co_code' => Input::get('ccode'),
                        'co_name' => $countryname,
                        'co_cursymbol' => $currencysymbol,
                        'co_curcode' => $currencycode
                    );

                    $return = Country::save_country_detail($entry);
                    return Redirect::to('manage_country')->with('success', 'Record Inserted');
                }
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function update_country_submit()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');

            //$inputs = Input::all();
            $data = Input::except(array(
                '_token'
            ));
            $id = Input::get('id');
            $rule = array(
                'ceditname' => 'required',
                'ceditcode' => 'required',
                'cureditsymbol' => 'required',
                'cureditcode' => 'required'
            );

            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('edit_country/' . $id)->withErrors($validator->messages())->withInput();
            } else {

                if ($id != "") {

                    $countryname = Input::get('ceditname');
                    $countrycode = Input::get('ceditcode');
                    $currencysymbol = Input::get('cureditsymbol');
                    $currencycode = Input::get('cureditcode');

                    $entry = array(
                        'co_code' => $countrycode,
                        'co_name' => $countryname,
                        'co_cursymbol' => $currencysymbol,
                        'co_curcode' => $currencycode
                    );


                    $check_exist_country_name = Country::check_exist_country_name_update($countryname, $id);
                    $check_exist_country_code = Country::check_exist_country_code_update($countrycode, $id);

                    if ($check_exist_country_name) {
                        return Redirect::to('edit_country/' . $id)->withErrors("Country Already Exists")->withInput();
                    } else if ($check_exist_country_code) {
                        return Redirect::to('edit_country/' . $id)->withErrors("Country Code  Already Exists")->withInput();
                    } else {
                        $affected = Country::update_country_detail($id, $entry);
                        return Redirect::to('manage_country')->with('success', 'Record Updated');

                    }
                }
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }


    //State Settings
    public function add_state()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $country_details = State::view_country_details();
            return view('siteadmin.add_state')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('country_details', $country_details);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function manage_state()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');

            $statedetails = State::view_state_detail();

            return view('siteadmin.manage_states')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('statedetails', $statedetails);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_state($id)
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');

            $country_details = State::view_country_details();

            $stateresult = State::show_state_detail($id);

            return view('siteadmin.edit_state')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('stateresult', $stateresult)->with('country_details', $country_details);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function delete_state($id)
    {
        if (Session::has('userid')) {
            $affected = State::delete_state_detail($id);
            return Redirect::to('manage_state')->with('success', 'States Deleted successfully');
        } else {
            return Redirect::to('siteadmin');
        }


    }

    public function status_state_submit($id, $status)
    {
        if (Session::has('userid')) {
            $return = State::status_state($id, $status);
            return Redirect::to('manage_state')->with('success', 'Record Updated Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function add_state_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array(
                '_token'
            ));
            $rule = array(
                'country_name' => 'required',
                'state_name' => 'required'
            );

            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('add_state')->withErrors($validator->messages())->withInput();

            } else {
                $statename = Input::get('state_name');
                $countrycode = Input::get('country_name');
                $check_exist_state_name = State::check_exist_state_name($statename, $countrycode);

                if ($check_exist_state_name) {
                    return Redirect::to('add_state')->with('error', "state Already Exists")->withInput();
                } else {
                    $entry = array(

                        'st_name' => Input::get('state_name'),
                        'st_con_id' => Input::get('country_name'),
                        'st_abbr' => Input::get('state_abbr'),
                        'st_default' => 0,
                        'st_status' => 1
                    );

                    $return = State::save_state_detail($entry);
                    return Redirect::to('manage_state')->with('success', 'Record Inserted Successfully');
                }
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_state_submit()
    {
        if (Session::has('userid')) {

            //$inputs = Input::all();
            $data = Input::except(array(
                '_token'
            ));
            $id = Input::get('state_id');
            $rule = array(
                'country_name' => 'required',
                'state_name' => 'required'
            );

            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('edit_state/' . $id)->withErrors($validator->messages())->withInput();

            } else {

                $entry = array(
                    'st_name' => Input::get('state_name'),
                    'st_con_id' => Input::get('country_name'),
                    'st_abbr' => Input::get('state_abbr')
                );

                $affected = State::update_state_detail($id, $entry);
                return Redirect::to('manage_state')->with('success', 'Record Updated Successfully');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function update_default_state_submit()
    {
        if (Session::has('userid')) {
            $id = Input::get('default_state_id');
            $entry = array(
                'st_default' => 0
            );
            $return = State::update_default_state_submit1($entry);
            $entry = array(
                'st_default' => 1
            );
            $return = State::update_default_state_submit($id, $entry);
            return Redirect::to('manage_state')->with('success', 'Record Updated Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function select_state_by_country()
    {
        $co_id = Input::get('id');
        $states = State::select_states_by_country($co_id);

        return response()->json(['states' => $states]);
    }


    //City Settings
    public function add_city()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $country_details = City::view_country_details();
            return view('siteadmin.add_city')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('country_details', $country_details);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function manage_city()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');

            $citydetails = City::view_city_detail2();

            return view('siteadmin.manage_cities')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('citydetails', $citydetails);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_city($id)
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');

            $country_details = City::view_country_details();

            $cityresult = City::show_city_detail($id);

            return view('siteadmin.edit_city')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('cityres', $cityresult[0])->with('country_details', $country_details);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function delete_city($id)
    {
        if (Session::has('userid')) {
            $affected = City::delete_city_detail($id);
            return Redirect::to('manage_city')->with('success', 'Cities Deleted successfully');
        } else {
            return Redirect::to('siteadmin');
        }


    }

    public function status_city_submit($id, $status)
    {
        if (Session::has('userid')) {
            $return = City::status_city($id, $status);
            return Redirect::to('manage_city')->with('success', 'Record Updated Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function add_city_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array(
                '_token'
            ));
            $rule = array(
                'country_name' => 'required',
                'city_name' => 'required',
                'state_name' => 'required',
                'city_lat' => 'required',
                'city_lng' => 'required'
            );

            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('add_city')->withErrors($validator->messages())->withInput();

            } else {
                $cityname = Input::get('city_name');
                $statename = Input::get('state_name');
                $countrycode = Input::get('country_name');

                $check_exist_city_name = City::check_exist_city_name2($cityname, $countrycode, $statename);

                if ($check_exist_city_name) {
                    return Redirect::to('add_city')->with('error', "City Already Exists")->withInput();

                } else {
                    $entry = array(
                        'ci_name' => $cityname,
                        'ci_con_id' => $countrycode,
                        'ci_state_id' => $statename,
                        'ci_lati' => Input::get('city_lat'),
                        'ci_long' => Input::get('city_lng'),
                        'ci_default' => 0,
                        'ci_status' => 1
                    );

                    $return = City::save_City_detail($entry);
                    return Redirect::to('manage_city')->with('success', 'Record Inserted Successfully');
                }
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_city_submit()
    {
        if (Session::has('userid')) {

            //$inputs = Input::all();
            $data = Input::except(array(
                '_token'
            ));
            $id = Input::get('city_id');
            $rule = array(
                'country_name' => 'required',
                'state_name' => 'required',
                'city_name' => 'required',
                'city_lat' => 'required',
                'city_lng' => 'required'
            );

            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('edit_city/' . $id)->withErrors($validator->messages())->withInput();

            } else {

                $entry = array(
                    'ci_name' => Input::get('city_name'),
                    'ci_state_id' => Input::get('state_name'),
                    'ci_con_id' => Input::get('country_name'),
                    'ci_lati' => Input::get('city_lat'),
                    'ci_long' => Input::get('city_lng')
                );

                $affected = City::update_City_detail($id, $entry);
                return Redirect::to('manage_city')->with('success', 'Record Updated Successfully');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function update_default_city_submit()
    {
        if (Session::has('userid')) {
            $id = Input::get('default_city_id');
            $entry = array(
                'ci_default' => 0
            );
            $return = City::update_default_city_submit1($entry);
            $entry = array(
                'ci_default' => 1
            );
            $return = City::update_default_city_submit($id, $entry);
            return Redirect::to('manage_city')->with('success', 'Record Updated Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function select_city_by_state()
    {
        $st_id = Input::get('state_id');
        $cities = City::get_cities_from_states($st_id);

        return response()->json(['cities' => $cities]);
    }


    // CMS Settings
    public function add_cms_page()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');
            return view('siteadmin.cms_add_page')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function cms_add_page_submit()
    {
        if (Session::has('userid')) {

            $data = Input::except(array(
                '_token'
            ));
            $rule = array(
                'page_title' => 'required',
                'page_description' => 'required'
            );

            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('add_cms_page')->withErrors($validator->messages())->withInput();
            } else {
                $now = date('Y-m-d H:i:s');
                $entry = array(
                    'cp_title' => Input::get('page_title'),
                    'cp_description' => Input::get('page_description'),
                    'cp_created_date' => $now
                );
                $check_title = Input::get('page_title');
                $check_title_exist = Cms::check_cms_page($check_title);
                if ($check_title_exist) {
                    return Redirect::to('add_cms_page')->with('error_message', 'Title Already Exist')->withInput();
                } else {
                    $return = Cms::add_cms_page($entry);
                    return Redirect::to('manage_cms_page')->with('insert_result', 'Record Inserted');
                }
            }
        } else {
            return Redirect::to('siteadmin');
        }

    }

    public function manage_cms_page()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $reurn = Cms::get_cms_page();
            return view('siteadmin.manage_cms_page')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('result', $reurn);

        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_cms_page($id)
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $reurn = Cms::getsingle_cms_page($id);
            return view('siteadmin.cms_edit_page')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('result', $reurn);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_cms_page_submit()
    {
        if (Session::has('userid')) {
            $id = Input::get('cms_id');
            $data = Input::except(array(
                '_token'
            ));
            $rule = array(
                'page_title' => 'required',
                'page_description' => 'required'
            );

            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('edit_cms_page/' . $id)->withErrors($validator->messages())->withInput();
            } else {

                $now = date('Y-m-d H:i:s');
                $entry = array(
                    'cp_title' => Input::get('page_title'),
                    'cp_description' => Input::get('page_description'),
                    'cp_created_date' => $now
                );
                $check_title = Input::get('page_title');
                $check_title_exist = Cms::check_cms_page_update($id, $check_title);
                if ($check_title_exist) {
                    return Redirect::to('edit_cms_page/' . $id)->with('error_message', 'Title Already Exist')->withInput();
                } else {
                    $reurn = Cms::update_cms_page($id, $entry);
                    return Redirect::to('manage_cms_page')->with('updated_result', 'Record Updated');
                }
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function block_cms_page($id, $status)
    {
        if (Session::has('userid')) {
            $entry = array(
                'cp_status' => $status
            );
            Cms::block_cms_page($id, $entry);
            if ($status == 1) {
                return Redirect::to('manage_cms_page')->with('block_result', 'Page Activated');
            } else {
                return Redirect::to('manage_cms_page')->with('block_result', 'Page Blocked');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function delete_cms_page($id)
    {
        if (Session::has('userid')) {
            Cms::delete_cms_page($id);
            return Redirect::to('manage_cms_page')->with('delete_result', 'Record Deleted');
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function aboutus_page()
    {

        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');

            $about_data = Cms::get_aboutus_page();
            if (count($about_data) == 0)
                $about_data = "";
            else
                $about_data = $about_data[0]->ap_description;

            return view('siteadmin.aboutus_page')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('about_data', $about_data);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function aboutus_page_update()
    {
        if (Session::has('userid')) {
            $data = Input::except(array(
                '_token'
            ));
            $rule = array(
                'aboutus_data' => 'required'
            );
            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('aboutus_page')->withErrors($validator->messages())->withInput();
            } else {
                $entry = array(
                    'ap_description' => Input::get('aboutus_data')
                );
                Cms::update_aboutus_page($entry);
                return Redirect::to('aboutus_page')->with('update_result', 'About Page Data Updated');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function terms()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $return = Cms::get_terms_page();

            return view('siteadmin.terms')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('result', $return);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function terms_update()
    {
        if (Session::has('userid')) {
            $data = Input::except(array(
                '_token'
            ));
            $rule = array(
                'data' => 'required'

            );
            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('aboutus_page')->withErrors($validator->messages())->withInput();
            } else {
                $entry = array(
                    'tr_description' => Input::get('data')
                );
                Cms::update_terms_page($entry);
                return Redirect::to('terms')->with('update_result', 'Record Updated');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function privacy()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $return = Cms::get_privacy_page();

            return view('siteadmin.privacy')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('result', $return);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function privacy_update()
    {
        if (Session::has('userid')) {
            $data = Input::except(array(
                '_token'
            ));
            $rule = array(
                'data' => 'required'

            );
            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('privacy')->withErrors($validator->messages())->withInput();
            } else {
                $entry = array(
                    'pri_text' => Input::get('data')
                );
                Cms::update_privacy_page($entry);
                return Redirect::to('privacy')->with('update_result', 'Record Updated');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }


    // AD Settings
    public function add_ad()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');
            return view('siteadmin.add_ad')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function manage_ad()
    {
        if (Session::has('userid')) {
            Session::put('adrequestcnt', 0);
            Admodel::update_ad_msgstatus();
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $adresult = Admodel::view_ad_list();
            return view('siteadmin.manage_ad')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('adresult', $adresult);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_ad($id)
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $adresult = Admodel::ad_detail($id);
            return view('siteadmin.edit_ad')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('adresult', $adresult)->with('id', $id);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function status_ad_submit($id, $status)
    {
        if (Session::has('userid')) {
            $return = Admodel::status_ad($id, $status);
            return Redirect::to('manage_ad')->with('updated_result', 'Record Updated Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function delete_ad($id)
    {
        if (Session::has('userid')) {
            $return = Admodel::delete_ad($id);
            return Redirect::to('manage_ad')->with('delete_result', 'Record Deleted Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function add_ad_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array('_token'));
            $rule = array(
                'adtitle' => 'required',
                'adposition' => 'required',
                'redirecturl' => 'required',
            );
            $adtitle = Input::get('adtitle');
            $adposition = Input::get('adposition');
            $adpage = 1;
            $adredirecturl = Input::get('redirecturl');
            $validator = Validator::make($data, $rule);
            $check_exist_ad_title = Admodel::check_exist_ad_title($adtitle);
            if ($validator->fails()) {
                return Redirect::to('add_ad')->withErrors($validator->messages())->withInput();
            } else if ($check_exist_ad_title) {
                return Redirect::to('add_ad')->withMessage("Ad Title Already Exists")->withInput();
            } else {
                $inputs = Input::all();
                $file = Input::file('file');
                if ($file != '') {
                    $filename = $file->getClientOriginalName();
                    $move_img = explode('.', $filename);
                    $filename = $move_img[0] . str_random(8) . "." . $move_img[1];
                    $destinationPath = './public/assets/images/adimage/';
                    $uploadSuccess = Input::file('file')->move($destinationPath, $filename);
                    $entry = array(
                        'ad_name' => $adtitle,
                        'ad_position' => $adposition,
                        'ad_pages' => $adpage,
                        'ad_redirecturl' => $adredirecturl,
                        'ad_img' => $filename,
                    );
                    $return = Admodel::save_ad($entry);
                    return Redirect::to('manage_ad')->with('insert_result', 'Record Inserted Successfully');
                } else {
                    return Redirect::to('add_ad')->withMessage("Image field required")->withInput();
                }
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_ad_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array('_token'));
            $id = Input::get('id');
            $adtitle = Input::get('editadtitle');
            $adposition = Input::get('editadposition');
            $adpage = 1;
            $adredirecturl = Input::get('editredirecturl');
            $rule = array(
                'editadtitle' => 'required',
                'editadposition' => 'required',
                'editredirecturl' => 'required',
            );
            $check_exist_ad_title = Admodel::check_exist_ad_title_update($adtitle, $id);
            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('edit_ad/' . $id)->withErrors($validator->messages())->withInput();
            } else if ($check_exist_ad_title) {
                return Redirect::to('edit_ad/' . $id)->withMessage("Ad Title Already Exists")->withInput();
            } else {
                $inputs = Input::all();
                $file = Input::file('file');
                $id = Input::get('id');
                if ($file != '') {
                    $filename = $file->getClientOriginalName();
                    $move_img = explode('.', $filename);
                    $filename = $move_img[0] . str_random(8) . "." . $move_img[1];
                    $destinationPath = './public/assets/images/adimage/';
                    $uploadSuccess = Input::file('file')->move($destinationPath, $filename);
                    $entry = array(
                        'ad_name' => $adtitle,
                        'ad_position' => $adposition,
                        'ad_pages' => $adpage,
                        'ad_redirecturl' => $adredirecturl,
                        'ad_img' => $filename,
                    );
                } else {
                    $entry = array(
                        'ad_name' => $adtitle,
                        'ad_position' => $adposition,
                        'ad_pages' => $adpage,
                        'ad_redirecturl' => $adredirecturl,
                    );
                }
                $return = Admodel::update_ad_detail($entry, $id);
                return Redirect::to('manage_ad')->with('updated_result', 'Record Updated Successfully');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }


    // FAQ Settings
    public function add_faq()
    {
        $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
        $adminleftmenus = view('siteadmin.includes.admin_left_menus');
        $adminfooter = view('siteadmin.includes.admin_footer');

        return view('siteadmin.add_faq')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter);
    }

    public function add_faq_submit()
    {

        $data = Input::except(array(
            '_token'
        ));
        $rule = array(
            'faqquestion' => 'required',
            'faqanswer' => 'required'

        );

        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::to('add_faq')->withErrors($validator->messages())->withInput();

        } else {
            $entry = array(
                'faq_name' => Input::get('faqquestion'),
                'faq_ans' => Input::get('faqanswer')

            );

            $return = Faqmodel::save_faq_detail($entry);
            return Redirect::to('manage_faq')->with('result', 'Record Inserted');


        }
    }

    public function manage_faq()
    {
        $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
        $adminleftmenus = view('siteadmin.includes.admin_left_menus');
        $adminfooter = view('siteadmin.includes.admin_footer');

        $faqresult = Faqmodel::view_faq_detail();

        return view('siteadmin.manage_faq')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('faqresult', $faqresult);
    }

    public function edit_faq($id)
    {
        $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
        $adminleftmenus = view('siteadmin.includes.admin_left_menus');
        $adminfooter = view('siteadmin.includes.admin_footer');

        $faqresult = Faqmodel::showindividual_faq_detail($id);

        return view('siteadmin.edit_faq')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('faqresult', $faqresult)->with('id', $id);
    }

    public function update_faq_submit()
    {

        $data = Input::except(array(
            '_token'
        ));
        $rule = array(
            'editfaqquestion' => 'required',
            'editfaqanswer' => 'required'

        );
        $id = Input::get('id');
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::to('add_faq')->withErrors($validator->messages())->withInput();

        } else {
            $entry = array(
                'faq_name' => Input::get('editfaqquestion'),
                'faq_ans' => Input::get('editfaqanswer')

            );

            $return = Faqmodel::update_faq_detail($id, $entry);
            return Redirect::to('manage_faq')->with('result', 'Record Updated');
        }
    }

    public function delete_faq($id)
    {
        $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
        $adminleftmenus = view('siteadmin.includes.admin_left_menus');
        $adminfooter = view('siteadmin.includes.admin_footer');

        $affected = Faqmodel::delete_faq_detail($id);
        return Redirect::to('manage_faq')->with('result', 'Record Deleted Successfully');
    }

    public function update_status_faq($id, $status)
    {
        $return = Faqmodel::update_status_faq($id, $status);
        return Redirect::to('manage_faq')->with('result', 'Record Updated Successfully');
    }


    // Security Question Setting
    public function add_secq()
    {
        $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
        $adminleftmenus = view('siteadmin.includes.admin_left_menus');
        $adminfooter = view('siteadmin.includes.admin_footer');

        return view('siteadmin.add_secq')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter);
    }

    public function manage_secq()
    {
        $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
        $adminleftmenus = view('siteadmin.includes.admin_left_menus');
        $adminfooter = view('siteadmin.includes.admin_footer');

        $secqresult = SecurityQuestion::view_secq_detail();

        return view('siteadmin.manage_secq')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('secqresult', $secqresult);
    }

    public function edit_secq($id)
    {
        $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
        $adminleftmenus = view('siteadmin.includes.admin_left_menus');
        $adminfooter = view('siteadmin.includes.admin_footer');

        $secqresult = SecurityQuestion::showindividual_secq_detail($id);

        return view('siteadmin.edit_secq')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
            ->with('secqresult', $secqresult)->with('id', $id);
    }

    public function delete_secq($id)
    {
        $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
        $adminleftmenus = view('siteadmin.includes.admin_left_menus');
        $adminfooter = view('siteadmin.includes.admin_footer');

        $affected = SecurityQuestion::delete_secq_detail($id);
        return Redirect::to('manage_secq')->with('result', 'Record Deleted Successfully');
    }

    public function update_status_secq($id, $status)
    {
        $return = SecurityQuestion::update_status_secq($id, $status);
        return Redirect::to('manage_secq')->with('result', 'Record Updated Successfully');
    }

    public function add_secq_submit()
    {

        $data = Input::except(array(
            '_token'
        ));
        $rule = array(
            'secquestion' => 'required',
        );

        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::to('add_secq')->withErrors($validator->messages())->withInput();
        } else {
            $entry = array(
                'question' => Input::get('secquestion'),
            );

            $return = SecurityQuestion::save_secq_detail($entry);
            return Redirect::to('manage_secq')->with('result', 'Record Inserted');
        }
    }

    public function update_secq_submit()
    {

        $data = Input::except(array(
            '_token'
        ));
        $rule = array(
            'editsecquestion' => 'required',

        );
        $id = Input::get('id');
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::to('add_secq')->withErrors($validator->messages())->withInput();

        } else {
            $entry = array(
                'question' => Input::get('editsecquestion'),
            );

            $return = SecurityQuestion::update_secq_detail($id, $entry);
            return Redirect::to('manage_secq')->with('result', 'Record Updated');
        }
    }


    // Newsletter Settings
    public function manage_newsletter_subscribers()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');

            $subscriber_list = Settings::get_newsletter_subscribers();
            return view('siteadmin.manage_news_subscribers')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('subscriber_list', $subscriber_list);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_newsletter_subscriber_status($id, $status)
    {
        if (Session::has('userid')) {
            $return = Settings::edit_newsletter_subs_status($id, $status);
            if ($status == 0) {
                return Redirect::to('manage_news_subscribers')->with('success', 'Record Blocked Successfully');
            } else if ($status == 1) {
                return Redirect::to('manage_news_subscribers')->with('success', 'Record Unblocked Successfully');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function unsubscribe_from_newsletter($id)
    {
        $id = base64_decode($id);
        Settings::edit_newsletter_subs_status($id, 0);
        return Redirect::to('Home')->with('unsubscribed', 1);
    }

    public function delete_newsletter_subscriber($id)
    {
        if (Session::has('userid')) {
            Settings::delete_newsletter_subs($id);
            return Redirect::to('manage_news_subscribers')->with('success', 'Record Deleted Successfully');

        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function send_newsletter()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');
            return view('siteadmin.send_newsletter')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function send_newsletter_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array(
                '_token'
            ));

            $rule = array(
                'subject' => 'required',
                'message' => 'required'
            );

            $validator = Validator::make($data, $rule);

            if ($validator->fails()) {
                return Redirect::to('send_newsletter')->withErrors($validator->messages())->withInput();
            } else {

                if ($_SERVER['HTTP_HOST'] != 'localhost') {
                    //send newsletters to all subscribers who has enabled to get the newsletter
                    $send_message = Input::get('message');
                    $subject = Input::get('subject');
                    $members = DB::table('nm_newsletter_subscribers')->where('status', 1)->get();
                    foreach ($members as $member) {
                        $email = $member->email;
                        $username = $member->name;
                        $userid = base64_encode($member->id);

                        if($email == "valtor_111@outlook.com")
                        {
                            Mail::send('emails.send_newsletter', array('send_message' => $send_message, 'username' => $username, 'userid' => $userid),
                                function ($message) use ($subject, $email) {
                                    $message->to($email)->subject($subject);
                                });
                        }
                    }
                }

                return Redirect::to('send_newsletter')->with('success', 'Newsletter Sent Successfully');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    // SMTP Settings
    public function smtp_setting()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $smtp_settings = Settings::view_smtp_settings();
            $send_settings = Settings::view_send_settings();
            return view('siteadmin.smtp_settings')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('smtp_settings', $smtp_settings)->with('send_settings', $send_settings);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function smtp_setting_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array(
                '_token'
            ));
            $rule = array(
                'smtp_host' => 'required',
                'smtp_port' => 'required',
                'smtp_username' => 'required',
                'password' => 'required'
            );

            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('smtp_setting')->withErrors($validator->messages())->withInput();

            } else {

                $entry = array(
                    'sm_host' => Input::get('smtp_host'),
                    'sm_port' => Input::get('smtp_port'),
                    'sm_uname' => Input::get('smtp_username'),
                    'sm_pwd' => Input::get('password'),
                    'sm_isactive' => 1
                );
                $return = Settings::save_smtp_set_def();
                $return = Settings::save_smtp_set($entry);
                return Redirect::to('smtp_setting')->with('success', 'Record Updated Successfully');

            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function send_setting_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array(
                '_token'
            ));
            $rule = array(
                'send_host' => 'required',
                'send_port' => 'required',
                'send_username' => 'required',
                'send_password' => 'required'

            );

            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('smtp_setting')->withErrors($validator->messages())->withInput();

            } else {

                $entry = array(
                    'sm_host' => Input::get('send_host'),
                    'sm_port' => Input::get('send_port'),
                    'sm_uname' => Input::get('send_username'),
                    'sm_pwd' => Input::get('send_password'),
                    'sm_isactive' => 1

                );
                $return = Settings::save_smtp_set_def();
                $return = Settings::save_send_set($entry);
                return Redirect::to('smtp_setting')->with('success', 'Record Updated Successfully');

            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    //Tax Settings
    //State Settings
    public function add_tax()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');

            $country_details = State::view_country_details();

            return view('siteadmin.add_tax')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('country_details', $country_details);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function add_tax_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array(
                '_token'
            ));
            $rule = array(
                'country_id' => 'required',
                'state_id' => 'required',
                'tax_amount' => 'required|numeric'
            );

            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('add_tax')->withErrors($validator->messages())->withInput();

            } else {

                $country_id = Input::get('country_id');
                $state_id = Input::get('state_id');
                Tax::updateOrCreate(['tax_co_id' => $country_id, 'tax_st_id' => $state_id], ['tax_amount' => Input::get('tax_amount'), 'tax_status' => 1]);
                return Redirect::to('manage_tax')->with('success', 'Tax Created Successfully');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function manage_tax()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');

            $all_tax = Tax::get()->all();

            return view('siteadmin.manage_taxes')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('tax_details', $all_tax);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_tax($id)
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');

            $country_details = State::view_country_details();
            $tax = Tax::find($id);

            return view('siteadmin.edit_tax')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('tax', $tax)->with('country_details', $country_details);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_tax_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array(
                '_token'
            ));
            $rule = array(
                'country_id' => 'required',
                'state_id' => 'required',
                'tax_amount' => 'required|numeric'
            );

            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator->messages())->withInput();

            } else {

                $country_id = Input::get('country_id');
                $state_id = Input::get('state_id');
                Tax::updateOrCreate(['tax_co_id' => $country_id, 'tax_st_id' => $state_id], ['tax_amount' => Input::get('tax_amount'), 'tax_status' => 1]);
                return Redirect::to('manage_tax')->with('success', 'Tax Changed Successfully');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function delete_tax($id)
    {
        if (Session::has('userid')) {
            $tax = Tax::find($id);
            $tax->delete();
            return Redirect::to('manage_tax')->with('success', 'Tax Deleted successfully');
        } else {
            return Redirect::to('siteadmin');
        }


    }

    public function status_tax_submit($id, $status)
    {
        if (Session::has('userid')) {
            $tax = Tax::find($id);
            $tax->update(['tax_status' => $status]);

            return Redirect::to('manage_tax')->with('success', 'Tax Updated Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }

}

?>