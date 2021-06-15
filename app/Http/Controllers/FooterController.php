<?php
namespace App\Http\Controllers;

use App\Category;
use App\City;
use App\Country;
use App\Footer;
use App\Home;
use App\Http\Models;
use App\Settings;
use App\Theme;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Session;

class FooterController extends Controller
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
    |
    */

    //Front Pages Deatisl

    public function get_front_cms_pages($id)
    {
        $city_details = City::get_city_list();
        $header_category = Home::get_header_category();
        $cms_page_title = Home::get_cms_page_title();
        $get_category_header = Home::get_category_header();

        $get_social_media_url = Footer::get_social_media_url();
        $country_details = Country::get_country_list();
        $get_meta_details = Home::get_meta_details();
        $get_image_favicons_details = Home::get_image_favicons_details();
        $get_image_logoicons_details = Home::get_image_logoicons_details();
        $general = Home::get_general_settings();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();

        $header = view('includes.header')->with('theme_list', $get_theme_list)->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)->with('catg_list', $get_category_list);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url);
        $cms_result = Footer::fetch_front_cms_details($id);
        return view('pages')->with('cms_result', $cms_result)->with('header', $header)->with('footer', $footer)->with('get_meta_details', $get_meta_details)->with('get_image_favicons_details', $get_image_favicons_details)->with('general', $general);
    }

    public function blog()
    {
        $city_details = City::get_city_list();
        $header_category = Home::get_header_category();
        $cms_page_title = Home::get_cms_page_title();
        $get_social_media_url = Footer::get_social_media_url();
        $get_meta_details = Home::get_meta_details();
        $country_details = Country::get_country_list();
        $get_image_favicons_details = Home::get_image_favicons_details();
        $get_image_logoicons_details = Home::get_image_logoicons_details();
        $get_blog_list = Footer::get_blog_list();
        $get_blog_list_count = Footer::get_blog_list_count($get_blog_list);
        $get_blog_list_cat_name = Footer::get_blog_list_cat_name($get_blog_list);
        $get_blog_list_popular = Footer::get_blog_list_popular();
        $get_blog_comment_check = Footer::get_blog_comment_check();
        $get_contact_det = Footer::get_contact_details();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();

        $header = view('includes.header')->with('theme_list', $get_theme_list)->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)->with('catg_list', $get_category_list);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $getanl);
        $faq_deatils = Footer::get_faq_details();
        return view('blog')->with('faq_result', $faq_deatils)->with('header', $header)->with('footer', $footer)->with('get_meta_details', $get_meta_details)->with('get_image_favicons_details', $get_image_favicons_details)->with('getheader_category', $header_category)->with('get_blog_list', $get_blog_list)->with('get_blog_list_popular', $get_blog_list_popular)->with('get_blog_comment_check', $get_blog_comment_check)->with('get_social_media_url', $get_social_media_url)->with('get_blog_list_count', $get_blog_list_count)->with('get_blog_list_cat_name', $get_blog_list_cat_name)->with('get_contact_det', $get_contact_det)->with('general', $general);
    }

    public function blog_category($id)
    {
        $city_details = City::get_city_list();
        $header_category = Home::get_header_category();
        $cms_page_title = Home::get_cms_page_title();
        $get_social_media_url = Footer::get_social_media_url();
        $get_meta_details = Home::get_meta_details();
        $country_details = Country::get_country_list();
        $get_image_favicons_details = Home::get_image_favicons_details();
        $get_image_logoicons_details = Home::get_image_logoicons_details();
        $get_blog_list = Footer::get_blog_list_by_category($id);
        $get_blog_list_count = Footer::get_blog_list_count($get_blog_list);
        $get_blog_list_popular = Footer::get_blog_list_popular();
        $get_blog_comment_check = Footer::get_blog_comment_check();
        $get_blog_list_cat_name = Footer::get_blog_list_cat_name($get_blog_list);
        $get_contact_det = Footer::get_contact_details();
        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();


        $header = view('includes.header')->with('theme_list', $get_theme_list)->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)->with('catg_list', $get_category_list);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $getanl);
        $faq_deatils = Footer::get_faq_details();
        return view('blog')->with('faq_result', $faq_deatils)->with('header', $header)->with('footer', $footer)->with('get_meta_details', $get_meta_details)->with('get_image_favicons_details', $get_image_favicons_details)->with('getheader_category', $header_category)->with('get_blog_list', $get_blog_list)->with('get_blog_list_popular', $get_blog_list_popular)->with('get_blog_comment_check', $get_blog_comment_check)->with('get_social_media_url', $get_social_media_url)->with('get_blog_list_count', $get_blog_list_count)->with('get_blog_list_cat_name', $get_blog_list_cat_name)->with('get_contact_det', $get_contact_det)->with('general', $general);
    }

    public function blog_view($id)
    {
        $city_details = City::get_city_list();
        $header_category = Home::get_header_category();
        $cms_page_title = Home::get_cms_page_title();
        $get_social_media_url = Footer::get_social_media_url();
        $get_meta_details = Home::get_meta_details();
        $country_details = Country::get_country_list();
        $get_image_favicons_details = Home::get_image_favicons_details();
        $get_image_logoicons_details = Home::get_image_logoicons_details();
        $get_blog_list = Footer::get_blog_list_by_id($id);
        $get_blog_list_count = Footer::get_blog_list_count($get_blog_list);
        $get_blog_comment_check = Footer::get_blog_comment_check();
        $get_blog_list_popular = Footer::get_blog_list_popular();
        $get_blog_list_cat_name = Footer::get_blog_list_cat_name($get_blog_list);
        $get_contact_det = Footer::get_contact_details();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();

        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();
        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();

        $header = view('includes.header')->with('theme_list', $get_theme_list)->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)->with('catg_list', $get_category_list);

        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $getanl);
        $faq_deatils = Footer::get_faq_details();
        return view('blog_view')->with('faq_result', $faq_deatils)->with('header', $header)->with('footer', $footer)->with('get_meta_details', $get_meta_details)->with('get_image_favicons_details', $get_image_favicons_details)->with('getheader_category', $header_category)->with('get_blog_list', $get_blog_list)->with('get_blog_list_popular', $get_blog_list_popular)->with('get_social_media_url', $get_social_media_url)->with('get_blog_comment_check', $get_blog_comment_check)->with('get_blog_list_count', $get_blog_list_count)->with('get_blog_list_cat_name', $get_blog_list_cat_name)->with('get_contact_det', $get_contact_det)->with('general', $general);
    }

    public function blog_comment($id)
    {
        $city_details = City::get_city_list();
        $header_category = Home::get_header_category();
        $cms_page_title = Home::get_cms_page_title();
        $get_social_media_url = Footer::get_social_media_url();
        $get_meta_details = Home::get_meta_details();
        $country_details = Country::get_country_list();
        $get_image_favicons_details = Home::get_image_favicons_details();
        $get_image_logoicons_details = Home::get_image_logoicons_details();
        $get_blog_list = Footer::get_blog_list_by_id($id);
        $get_blog_list_count = Footer::get_blog_list_count($get_blog_list);
        $get_blog_comment_check = Footer::get_blog_comment_check();
        $get_blog_list_popular = Footer::get_blog_list_popular();
        $get_blog_list_cat_name = Footer::get_blog_list_cat_name($get_blog_list);
        $get_blog_cus_cmt = Footer::get_blog_cus_cmt($id);
        $get_admin_reply = Footer::get_admin_reply();
        $get_contact_det = Footer::get_contact_details();
        $getlogodetails = Home::getlogodetails();
        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();

        $header = view('includes.header')->with('header_category', $header_category)->with('product_name', '')->with('get_image_logoicons_details', $get_image_logoicons_details)->with('logodetails', $getlogodetails)->with('catg_list', $get_category_list);

        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $getanl);
        $faq_deatils = Footer::get_faq_details();
        return view('blog_comment')->with('faq_result', $faq_deatils)->with('header', $header)->with('footer', $footer)->with('get_meta_details', $get_meta_details)->with('get_image_favicons_details', $get_image_favicons_details)->with('getheader_category', $header_category)->with('get_blog_list', $get_blog_list)->with('get_blog_list_popular', $get_blog_list_popular)->with('get_social_media_url', $get_social_media_url)->with('get_blog_comment_check', $get_blog_comment_check)->with('get_blog_list_count', $get_blog_list_count)->with('get_blog_list_cat_name', $get_blog_list_cat_name)->with('get_blog_cus_cmt', $get_blog_cus_cmt)->with('get_admin_reply', $get_admin_reply)->with('get_contact_det', $get_contact_det)->with('general', $general);
    }

    public function blog_comment_submit()
    {
        $inputs = Input::all();
        $data = Input::except(array(
            '_token'
        ));
        $rule = array(
            'name' => 'required',
            'email' => 'required|email',
            'website' => 'required|url',
            'message' => 'required'
        );

        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            if (Input::get('cmt_page') == 1) {
                return Redirect::to('blog_view/' . Input::get('cmt_id'))->withErrors($validator->messages())->withInput();
            } else if (Input::get('cmt_page') == 2) {
                return Redirect::to('blog_comment/' . Input::get('cmt_id'))->withErrors($validator->messages())->withInput();
            }
        } else {
            $entry = array(
                'cmt_blog_id' => Input::get('cmt_id'),
                'cmt_name' => Input::get('name'),
                'cmt_email' => Input::get('email'),
                'cmt_website' => Input::get('website'),
                'cmt_msg' => Input::get('message')
            );
            $insert_result = Footer::insert_blog_cmt($entry);
            if (Input::get('cmt_page') == 1) {
                return Redirect::to('blog_view/' . Input::get('cmt_id'))->with('success', 'Your comments will be shown after admin approval.');
            } else if (Input::get('cmt_page') == 2) {
                return Redirect::to('blog_comment/' . Input::get('cmt_id'))->with('success', 'Your comments will be shown after admin approval.');
            }

        }

    }

    public function front_newsletter_submit()
    {
        $email = $_GET['semail'];
        Footer::insert_newsletter_submit($email);
    }

    public function insert_inquriy_ajax()
    {
        $iname = $_GET['iname'];
        $iemail = $_GET['iemail'];
        $iphone = $_GET['iphone'];
        $idesc = $_GET['idesc'];

        $entry = array(
            'iq_name' => $iname,
            'iq_emailid' => $iemail,
            'iq_phonenumber' => $iphone,
            'iq_content' => $idesc

        );
        $return = Footer::insert_inquires_submit($entry);
        if ($return) {
            echo "success";
        }

    }

    public function show_msg()
    {

        echo "success";
    }

    public function check_title()
    {
        $title = $_GET['title'];
        $check_exist_ad_title = Admodel::check_exist_ad_title($title);
        if ($check_exist_ad_title) {
            echo "fail";
        } else {
            echo "success";

        }
    }

    public function user_ad_ajax()
    {
        $inputs = Input::all();
        $adtitle = Input::get('ad_title');
        $adposition = Input::get('ad_pos');
        $adpage = Input::get('ad_pages');
        $adredirecturl = Input::get('ad_url');
        $file = Input::file('file');
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
            'ad_type' => 2,
            'ad_read_status' => 0,
            'ad_status' => 1
        );
        $return = Admodel::save_ad($entry);
        return Redirect::to('/');
    }

}
