<?php

namespace App\Http\Controllers;

use App\Category;
use App\City;
use App\Country;
use App\Curator;
use App\Footer;
use App\Home;
use App\Http\Models;
use App\Member;
use App\PaymentInfo;
use App\Products;
use App\Register;
use App\SecurityQuestion;
use App\Settings;
use App\Tax;
use App\Theme;
use App\Userlogin;
use DB;
use File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use MyPayPal;
use Session;


class HomeController extends Controller
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

    /*Live Site Pages*/
    //show index page
    public function index()
    {
        $general = Home::get_general_settings();
        $get_social_media_url = Home::get_social_media_url();
        $trending_products = Home::get_trending_product();
        $cms_page_title = Home::get_cms_page_title();
        $country_details = Country::get_country_list();
        $addetails = Home::get_ad_details();
        $getbannerimagedetails = Home::getbannerimagedetails();
        $getmetadetails = Home::get_meta_details();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $get_contact_det = Footer::get_contact_details();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();

        $get_top_theme_list = Theme::get_top_theme_list();

        $header = view('includes.header')->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)->with('theme_list', $get_theme_list)->with('catg_list', $get_category_list);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $get_social_media_url);

        return view('index')->with('header', $header)->with('footer', $footer)
            ->with('trending_products', $trending_products)->with('addetails', $addetails)
            ->with('bannerimagedetails', $getbannerimagedetails)->with('metadetails', $getmetadetails)
            ->with('get_contact_det', $get_contact_det)->with('general', $general)->with('metadetails', $getmetadetails)
            ->with('category_details', $get_category_list)->with('top_theme_list', $get_top_theme_list);
    }

    //show about us page
    public function aboutus()
    {
        $cms_page_title = Home::get_cms_page_title();
        $get_social_media_url = Footer::get_social_media_url();
        $get_meta_details = Home::get_meta_details();
        $country_details = Country::get_country_list();
        $get_contact_det = Footer::get_contact_details();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $getanl = Settings::social_media_settings();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();
        $faq_deatils = Footer::get_aboutus_details();


        $header = view('includes.header')->with('theme_list', $get_theme_list)->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)
            ->with('catg_list', $get_category_list)->with('menu_inverse', true);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $getanl);

        return view('aboutus')->with('cms_result', $faq_deatils)
            ->with('header', $header)->with('footer', $footer)
            ->with('metadetails', $get_meta_details);
    }

    //show about us page
    public function comming_soon()
    {
        $cms_page_title = Home::get_cms_page_title();
        $get_social_media_url = Footer::get_social_media_url();
        $get_meta_details = Home::get_meta_details();
        $country_details = Country::get_country_list();
        $get_contact_det = Footer::get_contact_details();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $getanl = Settings::social_media_settings();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();
        $faq_deatils = Footer::get_aboutus_details();


        $header = view('includes.header')->with('theme_list', $get_theme_list)->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)
            ->with('catg_list', $get_category_list)->with('menu_inverse', true);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $getanl);

        return view('comming_soon')->with('cms_result', $faq_deatils)
            ->with('header', $header)->with('footer', $footer)
            ->with('metadetails', $get_meta_details);
    }


    public function show_contributors()
    {
        $cms_page_title = Home::get_cms_page_title();
        $get_social_media_url = Footer::get_social_media_url();
        $get_meta_details = Home::get_meta_details();
        $country_details = Country::get_country_list();
        $get_contact_det = Footer::get_contact_details();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $getanl = Settings::social_media_settings();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();
        $faq_deatils = Footer::get_aboutus_details();

        $header = view('includes.header')->with('theme_list', $get_theme_list)->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)
            ->with('catg_list', $get_category_list)->with('menu_inverse', true);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $getanl);

        return view('contributors')->with('cms_result', $faq_deatils)
            ->with('header', $header)->with('footer', $footer)
            ->with('metadetails', $get_meta_details);
    }

    //show forum pge
    public function forums()
    {
        $general = Home::get_general_settings();
        $get_social_media_url = Home::get_social_media_url();
        $trending_products = Home::get_trending_product();
        $cms_page_title = Home::get_cms_page_title();
        $country_details = Country::get_country_list();
        $addetails = Home::get_ad_details();
        $getbannerimagedetails = Home::getbannerimagedetails();
        $getmetadetails = Home::get_meta_details();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $get_contact_det = Footer::get_contact_details();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();

        // $laravel = app();
        // echo "Laravel Version : ".$laravel::VERSION;


        $header = view('includes.header')->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)->with('theme_list', $get_theme_list)->with('catg_list', $get_category_list)->with('menu_inverse', true);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $get_social_media_url);

        return view('forum')->with('header', $header)->with('footer', $footer)
            ->with('trending_products', $trending_products)->with('addetails', $addetails)
            ->with('bannerimagedetails', $getbannerimagedetails)->with('metadetails', $getmetadetails)
            ->with('get_contact_det', $get_contact_det)->with('general', $general)->with('metadetails', $getmetadetails)
            ->with('category_details', $get_category_list);

    }


    //show affirmations page
    public function affirmations()
    {
        $general = Home::get_general_settings();
        $get_social_media_url = Home::get_social_media_url();
        $trending_products = Home::get_trending_product();
        $cms_page_title = Home::get_cms_page_title();
        $country_details = Country::get_country_list();
        $addetails = Home::get_ad_details();
        $getbannerimagedetails = Home::getbannerimagedetails();
        $getmetadetails = Home::get_meta_details();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $get_contact_det = Footer::get_contact_details();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();

        $get_level_list = ThemeController::get_affirmation_level_list();


        $header = view('includes.header')->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)->with('theme_list', $get_theme_list)->with('catg_list', $get_category_list)->with('menu_inverse', true);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $get_social_media_url);

        return view('affirmations')->with('header', $header)->with('footer', $footer)
            ->with('trending_products', $trending_products)->with('addetails', $addetails)
            ->with('bannerimagedetails', $getbannerimagedetails)->with('metadetails', $getmetadetails)
            ->with('get_contact_det', $get_contact_det)->with('general', $general)->with('metadetails', $getmetadetails)
            ->with('category_details', $get_category_list)->with('theme_details', $get_level_list);

    }

    //show one theme page
    public function show_theme($theme_name)
    {
        //$theme = Theme::where('theme_name', $theme_name)->get()->first();
        $theme = null;
        $themes = Theme::all();
        foreach ($themes as $find_theme) {
            if ($theme_name == strtolower($find_theme->theme_name)) {
                $theme = $find_theme;
                break;
            }
        }

        if (!$theme) {
            return Redirect::to('home')->withErrors('Such Affirmation Does not exist');
        }

        $theme_id = $theme->theme_id;

        $general = Home::get_general_settings();
        $get_social_media_url = Home::get_social_media_url();
        $cms_page_title = Home::get_cms_page_title();
        $country_details = Country::get_country_list();
        $addetails = Home::get_ad_details();
        $getbannerimagedetails = Home::getbannerimagedetails();
        $getmetadetails = Home::get_meta_details();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $get_contact_det = Footer::get_contact_details();
        $get_theme_list = Theme::get_theme_normal_list();

        $get_category_list = Category::maincatg_active_list();

        $theme_result = Theme::get_individual_theme_detail_not_blocked($theme_id);
        if (count($theme_result) == 0) {
            return Redirect::to('/index');
        }

        $theme_details = $theme_result[0];

        $trending_products = Theme::find($theme_id)->get_theme_trending_products();

        // $laravel = app();
        // echo "Laravel Version : ".$laravel::VERSION;

        $header = view('includes.header')->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)->with('theme_list', $get_theme_list)->with('catg_list', $get_category_list);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $get_social_media_url);

        return view('theme_view')->with('header', $header)->with('footer', $footer)
            ->with('trending_products', $trending_products)->with('addetails', $addetails)
            ->with('bannerimagedetails', $getbannerimagedetails)->with('metadetails', $getmetadetails)
            ->with('get_contact_det', $get_contact_det)->with('general', $general)->with('metadetails', $getmetadetails)
            ->with('theme_details', $theme_details)->with('category_details', $get_category_list);

    }

    //show terms and conditions page
    public function termsandconditons()
    {
        $city_details = City::get_city_list();
        $header_category = Home::get_header_category();
        $cms_page_title = Home::get_cms_page_title();
        $get_social_media_url = Footer::get_social_media_url();
        $get_meta_details = Home::get_meta_details();
        $country_details = Country::get_country_list();
        $get_image_favicons_details = Home::get_image_favicons_details();
        $get_image_logoicons_details = Home::get_image_logoicons_details();
        $get_contact_det = Footer::get_contact_details();

        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();

        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();


        $header = view('includes.header')->with('header_category', $header_category)->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('theme_list', $get_theme_list)->with('country_details', $country_details)->with('catg_list', $get_category_list)->with('menu_inverse', true);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $getanl);

        $terms = Home::get_termsandconditons_details();

        return view('terms')->with('header', $header)->with('footer', $footer)
            ->with('metadetails', $get_meta_details)->with('terms', $terms);
    }

    //show privacy policy page
    public function privacy_policy()
    {
        $city_details = City::get_city_list();
        $header_category = Home::get_header_category();
        $cms_page_title = Home::get_cms_page_title();
        $get_social_media_url = Footer::get_social_media_url();
        $get_meta_details = Home::get_meta_details();
        $country_details = Country::get_country_list();
        $get_contact_det = Footer::get_contact_details();

        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();

        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();


        $header = view('includes.header')->with('header_category', $header_category)->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('theme_list', $get_theme_list)->with('country_details', $country_details)->with('catg_list', $get_category_list)->with('menu_inverse', true);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $getanl);

        $privacy = Home::get_privacy_details();

        return view('privacy')->with('header', $header)->with('footer', $footer)
            ->with('metadetails', $get_meta_details)->with('terms', $privacy);
    }

    //show faq page
    public function faq()
    {
        $city_details = City::get_city_list();
        $cms_page_title = Home::get_cms_page_title();
        $get_social_media_url = Footer::get_social_media_url();
        $get_meta_details = Home::get_meta_details();
        $country_details = Country::get_country_list();
        $get_image_favicons_details = Home::get_image_favicons_details();
        $get_contact_det = Footer::get_contact_details();

        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();

        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();

        $header = view('includes.header')->with('theme_list', $get_theme_list)->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)->with('catg_list', $get_category_list)->with('menu_inverse', true);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $getanl);
        $faq_details = Home::get_faq_details();
        $help_details = Home::get_help_details();

        return view('faq')->with('header', $header)->with('footer', $footer)
            ->with('metadetails', $get_meta_details)->with('get_image_favicons_details', $get_image_favicons_details)
            ->with('cms_result', $help_details)->with('get_contact_det', $get_contact_det)->with('general', $general)->with('faq_result', $faq_details);
    }

    //show all stores
    public function shops()
    {
        $header_category = Home::get_header_category();
        $most_visited_product = Home::get_most_visited_product();
        $get_social_media_url = Home::get_social_media_url();
        $cms_page_title = Home::get_cms_page_title();
        $country_details = Country::get_country_list();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $getmetadetails = Home::get_meta_details();
        $get_contact_det = Footer::get_contact_details();
        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();


        $header = view('includes.header')->with('theme_list', $get_theme_list)->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)->with('catg_list', $get_category_list)->with('menu_inverse', true);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $getanl);

        $get_store_details = Home::get_store_list();
        $get_store_product_count = Home::get_store_product_count($get_store_details);

        return view('stores')->with('header', $header)->with('footer', $footer)
            ->with('header_category', $header_category)->with('most_visited_product', $most_visited_product)
            ->with('get_store_details', $get_store_details)
            ->with('get_store_product_count', $get_store_product_count)
            ->with('metadetails', $getmetadetails)->with('get_contact_det', $get_contact_det)->with('general', $general);
    }

    //show one store
    public function storeview($id)
    {
        $id = base64_decode(base64_decode(base64_decode($id)));
        $city_details = City::get_city_list();
        $header_category = Home::get_header_category();
        $product_name_single = "";

        $get_product_details_by_cat = Home::get_product_details_by_category($header_category);
        $category_count = Home::get_category_count($header_category);
        $get_product_details_typeahed = Home::get_product_details_typeahed();
        $main_category = Home::get_header_category();
        $sub_main_category = Home::get_sub_main_category($main_category);
        $second_main_category = Home::get_second_main_category($main_category, $sub_main_category);
        $second_sub_main_category = Home::get_second_sub_main_category();
        $get_social_media_url = Home::get_social_media_url();
        $cms_page_title = Home::get_cms_page_title();
        $country_details = Country::get_country_list();
        $get_store_by_id = Home::get_store_by_id($id);

        $get_store_product_by_id = Home::get_store_product_by_id($id);
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $getmetadetails = Home::get_meta_details();
        $get_storebranch = Home::get_store_sub_details($id);
        $one_count = Home::get_storecountone($id);
        $two_count = Home::get_storecounttwo($id);
        $three_count = Home::get_storecountthree($id);
        $four_count = Home::get_storecountfour($id);
        $five_count = Home::get_storecountfive($id);
        $customer_details = Member::get_member_details();
        $review_comments = Home::get_review_details();
        $get_store = Home::get_store_deatils($id);
        $get_contact_det = Footer::get_contact_details();
        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();

        $most_visited_product = Home::get_most_visited_product();

        $header = view('includes.header')->with('theme_list', $get_theme_list)->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)->with('catg_list', $get_category_list)->with('menu_inverse', true);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $getanl);

        return view('storeview')->with('header', $header)->with('footer', $footer)->with('header_category', $header_category)
            ->with('get_product_details_by_cat', $get_product_details_by_cat)->with('most_visited_product', $most_visited_product)
            ->with('category_count', $category_count)->with('get_product_details_typeahed', $get_product_details_typeahed)->with('main_category', $main_category)
            ->with('sub_main_category', $sub_main_category)->with('second_main_category', $second_main_category)->with('second_sub_main_category', $second_sub_main_category)
            ->with('get_store_product_by_id', $get_store_product_by_id)
            ->with('store', $get_store_by_id[0])->with('metadetails', $getmetadetails)
            ->with('get_storebranch', $get_storebranch)->with('one_count', $one_count)
            ->with('two_count', $two_count)->with('three_count', $three_count)
            ->with('four_count', $four_count)->with('five_count', $five_count)
            ->with('customer_details', $customer_details)->with('review_comments', $review_comments)
            ->with('get_store', $get_store)->with('get_contact_det', $get_contact_det)
            ->with('general', $general);


    }

    //show all products
    public function products()
    {
        $header_category = Home::get_header_category();
        $product_details = Home::get_product_details();
        $most_visited_product = Home::get_most_visited_product();
        $get_product_details_by_cat = Home::get_product_details_by_category($header_category);
        $category_count = Home::get_category_count($header_category);
        $get_product_details_typeahed = Home::get_product_details_typeahed();
        $main_category = Home::get_header_category();
        $sub_main_category = Home::get_sub_main_category($main_category);
        $second_main_category = Home::get_second_main_category($main_category, $sub_main_category);
        $second_sub_main_category = Home::get_second_sub_main_category();
        $get_social_media_url = Home::get_social_media_url();
        $cms_page_title = Home::get_cms_page_title();
        $country_details = Country::get_country_list();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $getmetadetails = Home::get_meta_details();
        $get_contact_det = Footer::get_contact_details();
        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();


        $header = view('includes.header')->with('theme_list', $get_theme_list)->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)
            ->with('country_details', $country_details)->with('catg_list', $get_category_list)->with('menu_inverse', true);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)
            ->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)
            ->with('getanl', $getanl);

        return view('products')->with('header', $header)->with('footer', $footer)
            ->with('header_category', $header_category)->with('product_details', $product_details)
            ->with('get_product_details_by_cat', $get_product_details_by_cat)
            ->with('most_visited_product', $most_visited_product)
            ->with('category_count', $category_count)
            ->with('get_product_details_typeahed', $get_product_details_typeahed)
            ->with('main_category', $main_category)->with('sub_main_category', $sub_main_category)
            ->with('second_main_category', $second_main_category)
            ->with('second_sub_main_category', $second_sub_main_category)
            ->with('metadetails', $getmetadetails)->with('get_contact_det', $get_contact_det)
            ->with('general', $general);

    }

    //show products by category
    public function category_product_list($name, $id)
    {
        $product_id = base64_decode($id);
        $id = base64_decode(base64_decode(base64_decode($id)));

        $header_category = Home::get_header_category();

        $country_details = Country::get_country_list();
        if ($name == "viewcategorylist") {
            $get_cat_name_listby = Home::get_catname_listby($product_id);

            $product_details = Home::get_category_product_details_listby($product_id);
            $get_listby_id = explode(",", $product_id);

            $get_cat_name_listby_single = $get_cat_name_listby[0];

            if ($get_listby_id[0] == 1) {
                $product_name_single = $get_cat_name_listby_single->mc_name;

            } else if ($get_listby_id[0] == 2) {
                $product_name_single = $get_cat_name_listby_single->smc_name;
            } else if ($get_listby_id[0] == 3) {
                $product_name_single = $get_cat_name_listby_single->sb_name;
            } else if ($get_listby_id[0] == 4) {
                $product_name_single = $get_cat_name_listby_single->ssb_name;
            }

        } else {
            $product_details = Home::get_category_product_details_listby($id);
            $product_name_single = "";
        }

        $most_visited_product = Home::get_most_visited_product();
        $get_product_details_by_cat = Home::get_product_details_by_category($header_category);
        $category_count = Home::get_category_count($header_category);
        $get_product_details_typeahed = Home::get_product_details_typeahed();
        $main_category = Home::get_header_category();

        $sub_main_category = Home::get_sub_main_category($main_category);
        $second_main_category = Home::get_second_main_category($main_category, $sub_main_category);
        $second_sub_main_category = Home::get_second_sub_main_category();
        $get_social_media_url = Home::get_social_media_url();
        $cms_page_title = Home::get_cms_page_title();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $getmetadetails = Home::get_meta_details();
        $get_contact_det = Footer::get_contact_details();
        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();


        $header = view('includes.header')->with('theme_list', $get_theme_list)->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)->with('catg_list', $get_category_list)->with('menu_inverse', true);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $getanl);

        return view('products')->with('header', $header)->with('footer', $footer)->with('header_category', $header_category)->with('product_details', $product_details)
            ->with('get_product_details_by_cat', $get_product_details_by_cat)->with('most_visited_product', $most_visited_product)->with('category_count', $category_count)->with('get_product_details_typeahed', $get_product_details_typeahed)->with('main_category', $main_category)->with('sub_main_category', $sub_main_category)->with('second_main_category', $second_main_category)->with('second_sub_main_category', $second_sub_main_category)->with('product_name_single', $product_name_single)->with('metadetails', $getmetadetails)->with('get_contact_det', $get_contact_det)->with('general', $general);

    }

    //show one product
    public function productview($id)
    {
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();
        $get_social_media_url = Home::get_social_media_url();
        $cms_page_title = Home::get_cms_page_title();
        $get_contact_det = Footer::get_contact_details();
        $getmetadetails = Home::get_meta_details();

        $product_id = base64_decode($id);

        //related products
        $get_related_product = Home::get_related_product($product_id);

        //Resources Details
        $product_details_by_id = Home::get_product_details_by_id($product_id);
        if (count($product_details_by_id) == 0) {
            return Redirect::to('home')->withErrors("That product doesn't exist");
        }
        $product_details_by_id = $product_details_by_id[0];

        //Product Reviews
        $one_count = Home::get_countone($product_id);
        $two_count = Home::get_counttwo($product_id);
        $three_count = Home::get_countthree($product_id);
        $four_count = Home::get_countfour($product_id);
        $five_count = Home::get_countfive($product_id);

        //Product Store Info
        $get_store = Home::get_prd_deatils($product_id);

        //Product Rate and Comment Info
        $customer_comment_reviews = Products::get_customer_comment_review($product_id);

        $header_category = Home::get_header_category();
        $country_details = Country::get_country_list();
        $most_visited_product = Home::get_most_visited_product();
        $get_product_details_by_cat = Home::get_product_details_by_category($header_category);
        $category_count = Home::get_category_count($header_category);
        $get_product_details_typeahed = Home::get_product_details_typeahed();

        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();

        $present_products = [];
        if (Session::has('subscribe')) {
            $subscribe = Session::get('subscribe');
            if ($subscribe == 1) {
                $present_products = Products::get_present_products();
            }
        }

        $header = view('includes.header')->with('country_details', $country_details)
            ->with('header_category', $header_category)->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)
            ->with('theme_list', $get_theme_list)->with('catg_list', $get_category_list)->with('menu_inverse', true);

        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $getanl);

        return view('productview')->with('header', $header)->with('footer', $footer)->with('header_category', $header_category)
            ->with('get_product_details_by_cat', $get_product_details_by_cat)
            ->with('most_visited_product', $most_visited_product)
            ->with('get_product_details_typeahed', $get_product_details_typeahed)
            ->with('product_details_by_id', $product_details_by_id)->with('get_related_product', $get_related_product)
            ->with('metadetails', $getmetadetails)
            ->with('one_count', $one_count)->with('two_count', $two_count)->with('three_count', $three_count)
            ->with('four_count', $four_count)->with('five_count', $five_count)
            ->with('review_comments', $customer_comment_reviews)->with('get_store', $get_store)
            ->with('get_contact_det', $get_contact_det)->with('general', $general)
            ->with('present_products', $present_products);

    }

    //add comment to product
    public function productcomments()
    {

        $data = Input::except(array(
            '_token'
        ));

        $customem_id = Input::get('customer_id');
        $product_id = Input::get('product_id');
        $title = Input::get('title');
        $comments = Input::get('comments');
        $ratings = Input::get('ratings');

        $entry = array(
            'customer_id' => Input::get('customer_id'),
            'product_id' => Input::get('product_id'),
            'title' => Input::get('title'),
            'comments' => Input::get('comments'),
            'ratings' => Input::get('ratings')
        );

        $comments = Home::comment_insert($entry);

        return Redirect::to('products')->with('success1', 'Your Product Review Post Successfully');

    }

    //serach from navbar, category selection, advanded search
    public function do_search()
    {
        $main_category = Home::get_header_category();
        $sub_main_category = Home::get_sub_main_category($main_category);
        $second_main_category = Home::get_second_main_category($main_category, $sub_main_category);
        $second_sub_main_category = Home::get_second_sub_main_category();

        $get_social_media_url = Home::get_social_media_url();
        $cms_page_title = Home::get_cms_page_title();
        $country_details = Country::get_country_list();
        $getbannerimagedetails = Home::getbannerimagedetails();
        $getmetadetails = Home::get_meta_details();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $header_category = Home::get_header_category();
        $most_visited_product = Home::get_most_visited_product();
        $category_count = Home::get_category_count($header_category);
        $get_product_details_typeahed = Home::get_product_details_typeahed();
        $get_contact_det = Footer::get_contact_details();
        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();

        $get_theme_level_list = ThemeController::get_affirmation_level_list();
        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();

        //common search
        $keyword = Input::get('search_token');

        $normal_search = Input::get('normal_search');

        //pro_mr_id
        $product_contributor = Input::get('product_contributor');

        //pro_mc_id
        $product_category = Input::get('product_category');
        //$product_main_category = Input::get('product_main_category');
        //$product_sub_category = Input::get('product_sub_category');
        //$product_secsub_category = Input::get('product_secsub_category');

        //pro_theme_ids: had_theme_id
        $product_theme = Input::get('product_theme');


        //1. search store with that name
        $search_stores = Home::get_store_by_name($keyword);

        if ($product_contributor) {
            $search_stores2 = Home::get_store_by_name($product_contributor);
            $search_stores = array_merge($search_stores, $search_stores2);
        }

        $search_store_products = Home::get_store_product_count($search_stores);

        $store_array = [];
        foreach ($search_stores as $search_store) {
            $store_array[$search_store->stor_id] = $search_store;
        }

        $search_active_stores = [];
        foreach ($search_store_products as $store_id => $product_count) {
            if ($product_count > 0) {
                $search_active_stores[$store_id] = $store_array[$store_id];
            }
        }

        //products with searched store
        $find_store_products = [];
        if (count($search_active_stores) > 0) {
            foreach ($search_active_stores as $store) {
                $store_id = $store->stor_id;
                $p1 = Home::get_store_product_by_id($store_id);
                $find_store_products = array_merge($find_store_products, $p1);
            }
        }

        //2. search contributor with that name
        $search_contributors = Home::get_merchant_by_name($keyword);

//        if($product_contributor)
//        {
//            $search_contributors2 = Home::get_merchant_by_name($product_contributor);
//            $search_contributors = array_merge($search_contributors, $search_contributors2);
//        }

        //var_dump($search_products_bget);
        //3. search products with that name
        $search_products_bget = Home::get_product_list_search($keyword);


        // Filter by Category
        if ($product_category != 0) {
            $search_products_bget = $search_products_bget->where('pro_mc_id', $product_category);
        }

//        if ($product_main_category != 0) {
//            $search_products_bget = $search_products_bget->where('pro_smc_id', $product_main_category);
//        }
//
//        if ($product_sub_category != 0) {
//            $search_products_bget = $search_products_bget->where('pro_sb_id', $product_sub_category);
//        }
//
//        if ($product_secsub_category != 0) {
//            $search_products_bget = $search_products_bget->where('pro_ssb_id', $product_secsub_category);
//        }

        // Filter by Contributor
        if ($product_contributor) {
            $product_contributor_ids = Home::get_merchant_ids_by_name($product_contributor);

            if (count($product_contributor_ids) > 0) {
                $pids = [];
                foreach ($product_contributor_ids as $product_contributor_id) {
                    $pids[] = $product_contributor_id->mem_id;
                }

                $search_products_bget = $search_products_bget->whereIn('pro_mr_id', $pids);
                $search_products = $search_products_bget->get();
            } else {

                $search_products = $search_products_bget->get();
                $search_products = [];
            }

        } else {

            $search_products = $search_products_bget->get();
        }


        //add search products by store with keyword
        if (count($find_store_products) > 0) {
            $search_products = array_merge($search_products, $find_store_products);
        }

        // Filter by Theme
        $search_theme_count = count($product_theme);

        if ($search_theme_count > 0) {
            $products = [];
            foreach ($search_products as $search_product) {
                $pro_theme_ids = $search_product->pro_theme_ids;
                $pro_theme_idsa = explode(':', $pro_theme_ids);

                $inserted = false;
                foreach ($product_theme as $pt) {
                    if (in_array($pt, $pro_theme_idsa)) {
                        $products[] = $search_product;
                        $inserted = true;
                    }

                    if ($inserted) {
                        break;
                    }
                }
            }
            $search_products = $products;
        }

        $header = view('includes.header')->with('header_category', $header_category)->with('catg_list', $get_category_list)
            ->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)
            ->with('theme_list', $get_theme_list);

        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)
            ->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)
            ->with('getanl', $getanl);


        return view('search')->with('theme_details', $get_theme_level_list)->with('catg_list', $get_category_list)->with('header', $header)->with('footer', $footer)
            ->with('header_category', $header_category)
            ->with('most_visited_product', $most_visited_product)->with('category_count', $category_count)
            ->with('get_product_details_typeahed', $get_product_details_typeahed)
            ->with('main_category', $main_category)->with('sub_main_category', $sub_main_category)
            ->with('second_main_category', $second_main_category)->with('second_sub_main_category', $second_sub_main_category)
            ->with('bannerimagedetails', $getbannerimagedetails)->with('metadetails', $getmetadetails)
            ->with('get_contact_det', $get_contact_det)->with('general', $general)
            ->with('search_products', $search_products)
            ->with('search_stores', $search_active_stores)
            ->with('search_contributors', $search_contributors);

    }

    //show search page
    public function show_search_page()
    {
        $main_category = Home::get_header_category();
        $sub_main_category = Home::get_sub_main_category($main_category);
        $second_main_category = Home::get_second_main_category($main_category, $sub_main_category);
        $second_sub_main_category = Home::get_second_sub_main_category();

        $get_social_media_url = Home::get_social_media_url();
        $cms_page_title = Home::get_cms_page_title();
        $country_details = Country::get_country_list();
        $getbannerimagedetails = Home::getbannerimagedetails();
        $getmetadetails = Home::get_meta_details();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $header_category = Home::get_header_category();
        $most_visited_product = Home::get_most_visited_product();
        $category_count = Home::get_category_count($header_category);
        $get_product_details_typeahed = Home::get_product_details_typeahed();
        $get_contact_det = Footer::get_contact_details();
        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_theme_level_list = ThemeController::get_affirmation_level_list();
        $get_category_list = Category::maincatg_active_list();


        //Show all products here
        $search_products = Products::where('pro_status', Products::PRODUCT_STATUS_ACTIVATED)->where('pro_approved_status', Products::PRODUCT_STATUS_APPROVED)->get()->all();


        $header = view('includes.header')->with('header_category', $header_category)->with('catg_list', $get_category_list)
            ->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)
            ->with('theme_list', $get_theme_list);

        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)
            ->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)
            ->with('getanl', $getanl);

        $search_stores = [];
        $get_store_deal_count = [];
        $get_store_auction_count = [];
        $get_store_product_count = [];
        $search_contributors = [];


        return view('search')->with('theme_details', $get_theme_level_list)->with('catg_list', $get_category_list)->with('header', $header)->with('footer', $footer)
            ->with('header_category', $header_category)
            ->with('most_visited_product', $most_visited_product)->with('category_count', $category_count)
            ->with('get_product_details_typeahed', $get_product_details_typeahed)
            ->with('main_category', $main_category)->with('sub_main_category', $sub_main_category)
            ->with('second_main_category', $second_main_category)->with('second_sub_main_category', $second_sub_main_category)
            ->with('bannerimagedetails', $getbannerimagedetails)->with('metadetails', $getmetadetails)
            ->with('get_contact_det', $get_contact_det)->with('general', $general)
            ->with('search_products', $search_products)
            ->with('search_stores', $search_stores)
            ->with('get_store_deal_count', $get_store_deal_count)
            ->with('get_store_auction_count', $get_store_auction_count)
            ->with('get_store_product_count', $get_store_product_count)
            ->with('search_contributors', $search_contributors);

    }

    //Contact us page
    public function contactus()
    {
        $city_details = City::get_city_list();
        $header_category = Home::get_header_category();
        $cms_page_title = Home::get_cms_page_title();
        $get_social_media_url = Footer::get_social_media_url();
        $country_details = Country::get_country_list();
        $get_meta_details = Home::get_meta_details();
        $get_image_favicons_details = Home::get_image_favicons_details();
        $get_image_logoicons_details = Home::get_image_logoicons_details();
        $get_contact_det = Footer::get_contact_details();
        $getanl = Settings::social_media_settings();
        $getlogodetails = Home::getlogodetails();
        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();

        $header = view('includes.header')->with('header_category', $header_category)->with('product_name', '')->with('get_image_logoicons_details', $get_image_logoicons_details)
            ->with('logodetails', $getlogodetails)->with('catg_list', $get_category_list)->with('theme_list', $get_theme_list)->with('menu_inverse', true);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $getanl)->with('getanl', $getanl);

        return view('contactus')->with('header', $header)->with('footer', $footer)
            ->with('metadetails', $get_meta_details)->with('get_image_favicons_details', $get_image_favicons_details)
            ->with('get_contact_det', $get_contact_det)->with('general', $general);
    }

    //Contact us Submit
    public function contact_submit()
    {

        $data = Input::except(array(
            '_token'
        ));


        $name = Input::get('name');
        $email = Input::get('email');
        $phone = Input::get('phone');
        $content = Input::get('message');

        $entry = array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'content' => $content
        );

        $customerid = Home::insert_enquiry($entry);


        if ($_SERVER['HTTP_HOST'] != 'localhost') {
            //to user
            Mail::send('emails.contactus_confirm', $entry, function ($message) use ($email) {
                $message->to($email)->subject('Contact Request Received');
            });

            //to owner
            Mail::send('emails.contactus', $entry, function ($message) {
                $message->to('contact@livinglectionary.com')->subject('Contact Request Received');
            });
        }


        return Redirect::to('contactus')->with('success', 'Your Enquiry Details Posted Successfully, We will contact you soon');

    }


    //search from theme page
    public function search_from_theme()
    {
        //common search
        $keyword = Input::get('search_token');

        //pro_theme_ids: had_theme_id
        $product_theme = Input::get('product_theme');

        //pro_mc_id
        $product_category = Input::get('product_category');

        $main_category = Home::get_header_category();
        $sub_main_category = Home::get_sub_main_category($main_category);
        $second_main_category = Home::get_second_main_category($main_category, $sub_main_category);
        $second_sub_main_category = Home::get_second_sub_main_category();

        $get_social_media_url = Home::get_social_media_url();
        $cms_page_title = Home::get_cms_page_title();
        $country_details = Country::get_country_list();
        $getbannerimagedetails = Home::getbannerimagedetails();
        $getmetadetails = Home::get_meta_details();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $header_category = Home::get_header_category();
        $most_visited_product = Home::get_most_visited_product();
        $category_count = Home::get_category_count($header_category);
        $get_product_details_typeahed = Home::get_product_details_typeahed();
        $get_contact_det = Footer::get_contact_details();
        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_theme_level_list = ThemeController::get_affirmation_level_list();
        $get_category_list = Category::maincatg_active_list();

        //search products with that name
        $search_products_bget = Home::get_product_list_search($keyword);

        //1 Filter Search
        $search_stores = [];

        //3 Filter by Category
        if ($product_category != 0) {
            $search_products_bget = $search_products_bget->where('pro_mc_id', $product_category);
        }

        // Filter by Theme
        $search_products = $search_products_bget->get();

        if ($product_theme != 0) {
            $products = [];
            foreach ($search_products as $search_product) {
                $pro_theme_ids = $search_product->pro_theme_ids;
                $pro_theme_idsa = explode(':', $pro_theme_ids);
                if (in_array($product_theme, $pro_theme_idsa)) {
                    $products[] = $search_product;
                }
            }
            $search_products = $products;
        }

        $header = view('includes.header')->with('header_category', $header_category)
            ->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)
            ->with('theme_list', $get_theme_list)->with('catg_list', $get_category_list);

        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)
            ->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)
            ->with('getanl', $getanl);

        return view('search')->with('header', $header)->with('footer', $footer)
            ->with('header_category', $header_category)
            ->with('most_visited_product', $most_visited_product)->with('category_count', $category_count)
            ->with('get_product_details_typeahed', $get_product_details_typeahed)
            ->with('main_category', $main_category)->with('sub_main_category', $sub_main_category)
            ->with('second_main_category', $second_main_category)->with('second_sub_main_category', $second_sub_main_category)
            ->with('bannerimagedetails', $getbannerimagedetails)->with('metadetails', $getmetadetails)
            ->with('get_contact_det', $get_contact_det)->with('general', $general)
            ->with('search_products', $search_products)
            ->with('search_stores')
            ->with('theme_details', $get_theme_level_list)->with('catg_list', $get_category_list);

    }

    //add product to cart
    public function add_to_cart()
    {
        $cart_id = Input::get('addtocart_pro_id');
        $cart_qty = Input::get('addtocart_qty');

        if (isset($_SESSION['cart'])) {

            $check_product = Products::check_exist_in_cart($cart_id);

            if ($check_product == 0) {
                $max = count($_SESSION['cart']);
                $_SESSION['cart'][$max]['productid'] = $cart_id;
                $_SESSION['cart'][$max]['qty'] = $cart_qty;
            } else {
                //there is already that product added in Cart. So increase qty
                Products::increase_product_quantity_in_cart($cart_id, $cart_qty);
            }
        } else {
            //session_start();
            $_SESSION['cart'] = array();
            $_SESSION['cart'][0]['productid'] = $cart_id;
            $_SESSION['cart'][0]['qty'] = $cart_qty;
        }

        if (Input::has('from')) {
            $wish_id = Input::get('wish_id');
            Member::remove_wish($wish_id);
        }

        return Redirect::to('cart');

    }

    //add product to wishlist
    public function addtowish()
    {
        $data = Input::except(array(
            '_token'
        ));

        $pro_id = Input::get('pro_id');
        $mem_id = Input::get('mem_id');

        $entry = array(
            'ws_pro_id' => Input::get('pro_id'),
            'ws_mem_id' => Input::get('mem_id')
        );

        $wish = Member::insert_wish($entry);
        return Redirect::to('my_wishlist');
    }

    //remove product from wishlist
    public function remove_product_from_wishlist($wishlist_id)
    {
        Member::remove_wish($wishlist_id);
        return Redirect::to('my_wishlist');
    }


    //show Cart Page
    public function cart()
    {
        $result_cart = Home::get_product_details_in_cart();

        $country_details = Country::get_country_list();
        $most_visited_product = Home::get_most_visited_product();
        $header_category = Home::get_header_category();
        $category_count = Home::get_category_count($header_category);
        $get_product_details_typeahed = Home::get_product_details_typeahed();
        $get_social_media_url = Home::get_social_media_url();
        $cms_page_title = Home::get_cms_page_title();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $getmetadetails = Home::get_meta_details();
        $get_contact_det = Footer::get_contact_details();
        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();


        $header = view('includes.header')->with('theme_list', $get_theme_list)->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)->with('catg_list', $get_category_list)->with('menu_inverse', true);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $getanl);


        return view('cart')->with('header', $header)->with('footer', $footer)
            ->with('header_category', $header_category)->with('category_count', $category_count)
            ->with('get_product_details_typeahed', $get_product_details_typeahed)
            ->with('most_visited_product', $most_visited_product)->with('result_cart', $result_cart)
            ->with('metadetails', $getmetadetails)->with('get_contact_det', $get_contact_det
            )->with('general', $general);
    }

    //check estimate zipcode
    public function check_estimate_zipcode()
    {
        $result = Home::get_estimate_zipcode_range($_GET['estimate_check_val']);
        if ($result) {
            foreach ($result as $estimate_result) {
            }
            echo $estimate_result->ez_code_days;
        } else {
            echo 0;
        }
    }

    //remove one kind of product from cart
    public function remove_session_cart_data()
    {
        // session_start();
        $pid = intval($_GET['id']);

        $max = count($_SESSION['cart']);
        for ($i = 0; $i < $max; $i++) {
            if ($pid == $_SESSION['cart'][$i]['productid']) {
                unset($_SESSION['cart'][$i]);
                break;
            }
        }
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    //reset the product count for one item
    public function set_quantity_session_cart()
    {

        $pid = intval($_GET['pid']);
        $qty = intval($_GET['id']);
        // session_start();
        $max = count($_SESSION['cart']);
        for ($i = 0; $i < $max; $i++) {
            if ($pid == $_SESSION['cart'][$i]['productid']) {
                $_SESSION['cart'][$i]['qty'] = $qty;
                break;
            }
        }
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }


    //show checkout page
    public function checkout()
    {
        $get_social_media_url = Home::get_social_media_url();
        $cms_page_title = Home::get_cms_page_title();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $getmetadetails = Home::get_meta_details();
        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();
        $get_contact_det = Footer::get_contact_details();
        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();

        //customer info
        $cus_info = null;
        $guest_checkout = false;

        if (Session::has('customerid')) {
            $cust_id = Session::get('customerid');
            $cus_info = Member::get_member($cust_id);
            $cus_info = $cus_info[0];
            $shipping_addr_details = Member::get_shipinfo_details($cust_id);
            $tax = Tax::get_tax_by_customer($cust_id);
        } else {
            $guest_checkout = true;
            $shipping_addr_details = null;
            $tax = 0;
        }

        //cart data
        if (isset($_SESSION['cart'])) {
            $cart_data = Home::get_product_details_in_cart();
        } else {
            $cart_data = [];
        }

        $sub_total_price = $shipping_price = $tax_price = 0;

        foreach ($cart_data as $cart_product) {
            $sub_total_price += $cart_product['pro_sub_total'];
            $shipping_price += $cart_product['pro_ship_amount'];
        }

        $tax_price = round($sub_total_price * $tax / 100, 2);

        $total_price = round($sub_total_price + $shipping_price + $tax_price, 2);

        //check shipping needs
        $ship_needs = false;
        foreach ($cart_data as $product) {
            if ($product['pro_content_kind'] == Products::PRODUCT_TYPE_SHIP) {
                $ship_needs = true;
                break;
            }
        }

        //save total_price, sub_total, tax_price, shipping_price
        $checkout_data = ['cart_data' => $cart_data, 'total_price' => $total_price,
            'tax_price' => $tax_price, 'shipping_price' => $shipping_price,
            'subtotal_price' => $sub_total_price, 'ship_needs' => $ship_needs];

        Session::put('checkout_data', $checkout_data);

        $header = view('includes.header')->with('theme_list', $get_theme_list)->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('catg_list', $get_category_list)->with('menu_inverse', true);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $getanl)->with('general', $general);

        return view('checkout')->with('header', $header)->with('footer', $footer)
            ->with('metadetails', $getmetadetails)
            ->with('get_contact_det', $get_contact_det)->with('general', $general)
            ->with('shipping_addr_details', $shipping_addr_details)->with('cus_info', $cus_info)
            ->with('checkout_data', $checkout_data)->with('tax', $tax)
            ->with('ship_needs', $ship_needs)->with('guest_checkout', $guest_checkout);
    }


    //show register page on live site
    public function register()
    {
        $header_category = Home::get_header_category();

        $get_social_media_url = Home::get_social_media_url();
        $cms_page_title = Home::get_cms_page_title();
        $country_details = Country::get_country_list();
        $getmetadetails = Home::get_meta_details();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();

        $get_contact_det = Footer::get_contact_details();
        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();

        $security_questions = SecurityQuestion::get_all_active_quesiton_list();

        $privacy = Home::get_privacy_details();
        if (count($privacy) > 0)
            $privacy = $privacy[0];
        else
            $privacy = "Yet to be Filled";

        $terms = Home::get_termsandconditons_details();
        if (count($terms) > 0)
            $term = $terms[0];
        else
            $term = "Yet to be Filled";


        $header = view('includes.header')->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)
            ->with('theme_list', $get_theme_list)->with('country_details', $country_details)->with('catg_list', $get_category_list)->with('menu_inverse', true);

        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $getanl);

        return view('register')->with('header', $header)->with('footer', $footer)->with('metadetails', $getmetadetails)
            ->with('security_questions', $security_questions)->with('privacy', $privacy)->with('term', $term);
    }

    //register user submit for live site
    public function register_submit()
    {
        $data = Input::except(array(
            '_token'
        ));

        $mem_email = Input::get('mem_email');
        $check_email = Member::check_emailaddress($mem_email);

        $mem_userid = Input::get('mem_userid');
        $check_id = Member::check_memberid($mem_userid);

        if ($check_email) {
            return Redirect::to('join')->withErrors('Already User Email Exist')->withInput();
        } else if ($check_id) {
            return Redirect::to('join')->withErrors('Already User ID Exist')->withInput();
        } else {

            $mem_fname = Input::get('mem_fname');
            $mem_lname = Input::get('mem_lname');

            $password = Input::get('mem_password');
            $mem_password = md5($password);

            $mem_secq = Input::get('mem_secq');
            $mem_seca = Input::get('mem_seca');
            $mem_username = $mem_fname . ' ' . $mem_lname;

            $mem_newsget = 0;
            $mem_newsget_check = Input::get('newsletter');
            if ($mem_newsget_check == "on") {
                $mem_newsget = 1;
                $subscribe_entry = array('name' => $mem_username, 'email' => $mem_email, 'status' => 1, 'from_member' => 1);
                DB::table('nm_newsletter_subscribers')->insert($subscribe_entry);
            }

            date_default_timezone_set("America/New_York");
            $date = date('Y-m-d H:i:s');

            $entry = array(
                'mem_fname' => $mem_fname,
                'mem_lname' => $mem_lname,
                'mem_email' => $mem_email,
                'mem_password' => $mem_password,
                'mem_userid' => $mem_userid,
                'mem_secq' => $mem_secq,
                'mem_seca' => $mem_seca,
                'mem_logintype' => 2,
                'mem_newsget' => $mem_newsget,
                'created_at' => $date,
                'added_by' => 2,
            );

            $customerid = Member::insert_member($entry);
            $encoded_customer_id = base64_encode($customerid);

            Session::put('logintype', Member::MEMBER_LOGIN_CUSTOMER);

            if ($_SERVER['HTTP_HOST'] != 'localhost') {

                //Mail Send
                Mail::send('emails.member_account_create', array(
                    'email' => $mem_email,
                    'username' => $mem_username,
                    'userid' => $mem_userid,
                    'member_id' => $encoded_customer_id,
                    'action' => 'create',
                ), function ($message) {
                    $message->to(Input::get('mem_email'))->subject('Living Lectionary Member Account Created Successfully');
                });
            }


            $entry_shippinfo = array(
                'ship_mem_id' => $customerid,
                'ship_name' => $mem_username,
                'ship_email' => $mem_email,
            );

            Member::insert_shipinfo($entry_shippinfo);

            $get_social_media_url = Home::get_social_media_url();
            $cms_page_title = Home::get_cms_page_title();
            $getlogodetails = Home::getlogodetails();
            $getlogo2details = Home::getinverselogodetails();
            $getmetadetails = Home::get_meta_details();
            $get_contact_det = Footer::get_contact_details();
            $getanl = Settings::social_media_settings();

            $get_theme_list = Theme::get_theme_normal_list();
            $get_category_list = Category::maincatg_active_list();


            $header = view('includes.header')->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('theme_list', $get_theme_list)->with('catg_list', $get_category_list)->with('menu_inverse', true);
            $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $getanl);

            //to confirm email and username
            return view('member_submission')->with('header', $header)->with('footer', $footer)
                ->with('metadetails', $getmetadetails)->with('encoded_customer_id', $encoded_customer_id);
        }
    }

    //Register as Merchant
    public function become_a_contributor()
    {

        //if that is not loggedin user, go to back
        if (!Session::has('customerid')) {
            return Redirect::to('home')->with('need_to_register', 'true');
        } else if (Session::has('logintype')) {
            if (Session::get('logintype') == Member::MEMBER_LOGIN_MERCHANT) {
                return Redirect::to('add_my_resource');
            }
        }

        $header_category = Home::get_header_category();

        $get_social_media_url = Home::get_social_media_url();
        $cms_page_title = Home::get_cms_page_title();
        $country_details = Country::get_country_list();
        $getmetadetails = Home::get_meta_details();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();

        $get_contact_det = Footer::get_contact_details();
        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();

        $security_questions = SecurityQuestion::get_all_active_quesiton_list();

        $privacy = Home::get_privacy_details();
        if (count($privacy) > 0)
            $privacy = $privacy[0];
        else
            $privacy = "Yet to be Filled";

        $terms = Home::get_termsandconditons_details();
        if (count($terms) > 0)
            $term = $terms[0];
        else
            $term = "Yet to be Filled";


        $header = view('includes.header')->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)
            ->with('theme_list', $get_theme_list)->with('country_details', $country_details)->with('catg_list', $get_category_list)->with('menu_inverse', true);

        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $getanl);

        return view('register_merchant')->with('header', $header)->with('footer', $footer)->with('metadetails', $getmetadetails)
            ->with('security_questions', $security_questions)->with('privacy', $privacy)->with('term', $term)->with('country_details', $country_details);

    }

    //register update as contributor from member
    public function register_as_contributor_submit()
    {
        $customerid = Session::get('customerid');
        $logintype = Session::get('logintype');

        if (!$customerid || in_array($logintype, [1, 3])) {
            return Redirect::to('home');
        }

        $data = Input::except(array(
            '_token'
        ));

        $rule = array(
            'store_name' => 'required',
            'select_country' => 'required',
            'select_state' => 'required',
            'select_city' => 'required',
            'store_add_one' => 'required',
            'store_zipcode' => 'required',
            'store_phone' => 'required',
            /*'store_payment' => 'required',*/
            'store_img' => 'required | image'
        );

        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {

            return Redirect::to('become_a_contributor')->withErrors($validator->messages())->withInput();

        } else {

            $store_country = Input::get('select_country');
            $store_state = Input::get('select_state');
            $store_city_name = Input::get('select_city');
            $check_city = City::check_exist_city_name2($store_city_name, $store_country, $store_state);

            $sci_count = count($check_city);
            if ($sci_count > 0)
                $store_city_id = $check_city[0]->ci_id;
            else
                return Redirect::to('become_a_contributor')->withErrors("City for Store Doesn't Exists")->withInput();


            //upload store image

            $filename = "";
            $path = './public/assets/images/storeimage/';

            if (!file_exists($path))
                $result = File::makeDirectory($path, 0777, true);

            $file = Input::file('store_img');

            //upload curator image
            if ($file) {

                if (Input::get('x') == NAN || Input::get('y') == NAN || Input::get('w') == NAN || Input::get('h') == NAN) {
                    return Redirect::to('become_a_contributor')->withErrors('Please select the Store Image Region')->withInput();
                }
                $filename = ImageEditController::save_image_edited($file, Input::get('x'), Input::get('y'), Input::get('w'), Input::get('h'), $path);
            }

            date_default_timezone_set("America/New_York");
            $date = date('Y-m-d H:i:s');
            $store_name = Input::get('store_name');

            //Insert store city
            $store_entry = array(
                'stor_merchant_id' => $customerid,
                'stor_name' => $store_name,
                'stor_org' => Input::get('store_org'),
                'stor_title' => Input::get('store_title'),
                'stor_website' => Input::get('store_web'),
                'stor_country' => $store_country,
                'stor_state' => $store_state,
                'stor_city' => $store_city_id,
                'stor_address1' => Input::get('store_add_one'),
                'stor_address2' => Input::get('store_add_two'),
                'stor_zipcode' => Input::get('store_zipcode'),
                'stor_phone' => Input::get('store_phone'),
                'stor_metakeywords' => Input::get('meta_keyword'),
                'stor_orgdesc' => Input::get('store_orgdesc'),
                'stor_addedby' => 2,
                'stor_img' => $filename,
                'stor_show_map' => Input::get('show_map'),
                'created_at' => $date,
            );

            Member::insert_store($store_entry);

            //update member as merchant and payment info
            $payment = Input::get('store_payment');

            //update payment info
            if ($payment == Member::MEMBER_PAYMENT_PAYPAL || $payment == Member::MEMBER_PAYMENT_OTHER) {

                $paypal_email = '';
                $stripe_email = '';

                if ($payment == 1) {
                    //paypal
                    $paypal_email = Input::get('paypal_email');

                } else if ($payment == 2) {
                    //stripe
                    $stripe_email = Input::get('stripe_email');
                }

                $tax_profit = Input::get('tax_profit');

                $tax_us_resident = Input::get('tax_us_resident');

                //init
                if ($tax_us_resident == 1) {

                    $security = Input::get('social_security');
                    $name_on_tax = Input::get('full_name_on_tax');

                } else {
                    $security = Input::get('fed_tax_id');
                    $name_on_tax = Input::get('business_name_on_tax');
                }

                $payment_entry = array(
                    'member_id' => $customerid,
                    'pay_kind' => $payment,
                    'paypal_email' => $paypal_email,
                    'stripe_email' => $stripe_email,
                    'tax_profit' => $tax_profit,
                    'tax_us_resident' => $tax_us_resident,
                    'tax_social_fed_id' => $security,
                    'name_on_tax' => $name_on_tax
                );

                $payment_info_id = PaymentInfo::insert_payment_info($payment_entry);
            }

            $mem_newsget = Input::get('newsletter');

            $update_member_entry = ['mem_logintype' => Member::MEMBER_LOGIN_MERCHANT, 'mem_payment' => $payment, 'mem_newsget' => $mem_newsget, 'updated_at' => $date];

            Member::update_member($customerid, $update_member_entry);
            Session::put('logintype', Member::MEMBER_LOGIN_MERCHANT);

            $member = Member::find($customerid);
            if ($member) {
                $mem_email = $member->mem_email;
                $mem_username = $member->name;
                if ($_SERVER['HTTP_HOST'] != 'localhost') {
                    //Mail Send
                    Mail::send('emails.merchant_confirm', array(
                        'username' => $mem_username,
                        'storename' => $store_name,
                    ), function ($message) use ($mem_email) {
                        $message->to($mem_email)->subject('You were updated as a Contributor');
                    });
                }
            }

            $get_social_media_url = Home::get_social_media_url();
            $cms_page_title = Home::get_cms_page_title();
            $getlogodetails = Home::getlogodetails();
            $getlogo2details = Home::getinverselogodetails();
            $getmetadetails = Home::get_meta_details();
            $get_contact_det = Footer::get_contact_details();
            $getanl = Settings::social_media_settings();

            $get_theme_list = Theme::get_theme_normal_list();
            $get_category_list = Category::maincatg_active_list();


            $header = view('includes.header')->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('theme_list', $get_theme_list)->with('catg_list', $get_category_list)->with('menu_inverse', true);
            $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $getanl);

            //to confirm email and username
            return view('merchant_submission')->with('header', $header)->with('footer', $footer)
                ->with('metadetails', $getmetadetails)->with('store_name', $store_name);
        }
    }

    //show register update result page
    public function confirm_contributor()
    {
        $get_social_media_url = Home::get_social_media_url();
        $cms_page_title = Home::get_cms_page_title();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $getmetadetails = Home::get_meta_details();
        $get_contact_det = Footer::get_contact_details();
        $getanl = Settings::social_media_settings();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();


        $header = view('includes.header')->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('theme_list', $get_theme_list)->with('catg_list', $get_category_list);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $getanl);

        return view('merchant_confirm')->with('header', $header)->with('footer', $footer)
            ->with('metadetails', $getmetadetails);
    }

    //user login submit
    public function user_login_submit()
    {
        $logemail = $_POST['email'];//or login user id
        $logpwd = $_POST['pwd'];
        $logmd5pwd = md5($logpwd);
        $logcheck = Userlogin::check_user($logmd5pwd, $logemail);

        if (count($logcheck) > 0) {

            $confirmed = $logcheck[0]->mem_confirmed;
            if ($confirmed == 1) {
                Session::put('customerid', $logcheck[0]->mem_id);
                Session::put('useremail', $logcheck[0]->mem_email);
                Session::put('username', $logcheck[0]->mem_fname . ' ' . $logcheck[0]->mem_lname);
                Session::put('logintype', $logcheck[0]->mem_logintype);
                Session::put('subscribe', $logcheck[0]->mem_subscribe);

                $entry = array(
                    'mem_id' => $logcheck[0]->mem_id
                );

                //save user login history
                Userlogin::save_log($entry);

                return response()->json(['result' => 'success']);
            } else {
                $customer_id = base64_encode($logcheck[0]->mem_id);
                return response()->json(['result' => 'not_confirmed', 'customer_id' => $customer_id]);
            }

        } else {
            return response()->json(['result' => 'not_exist']);
        }
    }

    //user forgot password
    public function password_emailcheck()
    {
        $user_email = Input::get('pwdemail');

        $encode_email = base64_encode(base64_encode(base64_encode(($user_email))));
        $check_valid_email = Member::check_emailaddress($user_email);

        if (count($check_valid_email) > 0) {
            $send_mail_data = array(
                'username' => $check_valid_email[0]->mem_fname . ' ' . $check_valid_email[0]->mem_lname,
                'encodeemail' => $encode_email,
                'kind' => "forgot_password"
            );

            if ($_SERVER['HTTP_HOST'] != 'localhost') {
                Mail::send('emails.user_passwordrecoverymail', $send_mail_data, function ($message) use ($user_email) {
                    $message->to($user_email)->subject('[Living Lectionary] Password Recovery Details');
                });
            }
            echo "success";
        } else {
            echo "fail";
        }
    }


    //user forgot password
    public function username_forgot_submit()
    {
        $user_email = Input::get('pwdemail');
        $check_valid_email = Member::check_emailaddress($user_email);


        if (count($check_valid_email) > 0) {
            $user_id = $check_valid_email[0]->mem_userid;

            $send_mail_data = array(
                'username' => $check_valid_email[0]->mem_fname . ' ' . $check_valid_email[0]->mem_lname,
                'userid' => $user_id,
                'kind' => "forgot_username"
            );

            if ($_SERVER['HTTP_HOST'] != 'localhost') {
                Mail::send('emails.user_passwordrecoverymail', $send_mail_data, function ($message) use ($user_email) {
                    $message->to($user_email)->subject('[Living Lectionary] Username Recovery Details');
                });
            }
            echo "success";
        } else {
            echo "fail";
        }
    }


    //user logout
    public function user_logout()
    {
        Session::forget('customerid');
        Session::forget('username');
        Session::forget('useremail');
        Session::forget('logintype');
        Session::forget('subscribe');

        //unset($_SESSION['cart']);
        //unset($_SESSION['deal_cart']);

        Session::flush();

        return Redirect::to('/');
    }

    //reset user password
    public function user_reset_password_submit()
    {

        $new_pwd = md5(Input::get('newpwd'));
        $user_email = Input::get('useremail');

        $check = Member::update_member_password($user_email, $new_pwd);

        if ($check) {
            Session::remove('reset_user_email');
            echo "success";
        } else {
            echo "fail";

        }

    }

    //show user reset password modal by email
    public function user_forgot_pwd_email($email)
    {
        $customer_decode_email = base64_decode(base64_decode(base64_decode($email)));
        Session::put('reset_user_email', $customer_decode_email);
        return Redirect::to('home#reset_pwd');
    }

    //resend register member success email
    public function resend_member_register_success()
    {
        $encoded_customer_id = Input::get('encoded_customer_id');
        $customer_id = base64_decode($encoded_customer_id);

        $customer = Member::findOrFail($customer_id);

        $mem_email = $customer->mem_email;
        $mem_username = $customer->mem_fname . ' ' . $customer->mem_lname;
        $mem_userid = $customer->mem_userid;

        if ($_SERVER['HTTP_HOST'] != 'localhost') {
            //Working EMail

            Mail::send('emails.member_account_create', array(
                'email' => $mem_email,
                'username' => $mem_username,
                'userid' => $mem_userid,
                'member_id' => $encoded_customer_id,
                'action' => 'create'
            ), function ($message) use ($mem_email) {
                $message->to($mem_email)->subject('Living Lectionary Member Account Created Successfully');
            });
        }

        return response()->json(['result' => 'success']);
    }

    //resend register update success email
    public function resend_contributor_register_success()
    {

        $memberid = Session::get('customerid');
        $member = Member::find($memberid);
        $logintype = Session::get('logintype');

        if ($member && $logintype == Member::MEMBER_LOGIN_MERCHANT) {
            $mem_email = $member->mem_email;
            $mem_username = $member->name;
            $store_name = Input::get('store_name');

            if ($_SERVER['HTTP_HOST'] != 'localhost') {
                //Mail Send
                Mail::send('emails.merchant_confirm', array(
                    'username' => $mem_username,
                    'storename' => $store_name,
                ), function ($message) use ($mem_email) {
                    $message->to($mem_email)->subject('You were updated as a Contributor');
                });
            }
        }

        return response()->json(['result' => 'success']);
    }


    //activate account
    public function activate_account($encoded_member_id)
    {
        $customer_id = base64_decode($encoded_member_id);
        $customer = Member::find($customer_id);
        if ($customer) {
            $customer->mem_confirmed = 1;
            $customer->update();
            return Redirect::to('home#login');

        } else {
            return Redirect::to('home')->withMessage('That Account does not exist! Please register again.');
        }

    }

    /*User settings page*/
    //show user settings page(accouont, store, ship, code, buys, wishlist)
    public function get_userprofile()
    {
        if (Session::has('customerid')) {

            $customerid = Session::get('customerid');

            $product_details = Home::get_product_details();
            $customerdetails = Member::get_member($customerid);
            $customerdetails = $customerdetails[0];

            $general = Member::get_general_settings();

            $wishlistdetails = Member::get_wishlistdetails($customerid);
            $wishlistcnt = Member::get_wishlistdetailscnt($customerid);

            $country_details = Country::get_country_list();

            $order_products = Member::get_order_products_list($customerid);

            $cms_page_title = Home::get_cms_page_title();
            $get_social_media_url = Footer::get_social_media_url();
            $get_meta_details = Home::get_meta_details();

            $getlogodetails = Home::getlogodetails();
            $getlogo2details = Home::getinverselogodetails();

            $get_contact_det = Footer::get_contact_details();

            $get_theme_list = Theme::get_theme_normal_list();
            $get_category_list = Category::maincatg_active_list();


            $header = view('includes.header')->with('theme_list', $get_theme_list)->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)
                ->with('country_details', $country_details)->with('catg_list', $get_category_list)->with('menu_inverse', true);
            $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)
                ->with('get_social_media_url', $get_social_media_url)
                ->with('get_contact_det', $get_contact_det)->with('getanl', $get_social_media_url);

            $checkcustomership = Member::get_member_shipping_details($customerid);
            $shippingdetails = Member::get_shipinfo_details($customerid);

            $shipinfo = [];
            if (count($shippingdetails) > 0) {
                $shipinfo = $shippingdetails[0];
            };


            //if member is merchant, show store
            if ($customerdetails->mem_logintype == Member::MEMBER_LOGIN_MERCHANT) {
                $store_infos = Member::get_store_from_merchant($customerid);

                if (count($store_infos) == 0) {
                    return Redirect::to('home')->withErrors("Your Store doesn't exist");
                }

                //show as merchant
                return view('customer_profile')->with('header', $header)->with('footer', $footer)
                    ->with('metadetails', $get_meta_details)->with('general', $general)
                    ->with('customer_info', $customerdetails)
                    ->with('country_details', $country_details)
                    ->with('shipinfo', $shipinfo)
                    ->with('order_products', $order_products)
                    ->with('wishlistdetails', $wishlistdetails)->with('wishlistcnt', $wishlistcnt)
                    ->with('store_infos', $store_infos);

            } else {
                //show as cusotmer
                return view('customer_profile')->with('header', $header)->with('footer', $footer)
                    ->with('metadetails', $get_meta_details)->with('general', $general)
                    ->with('customer_info', $customerdetails)
                    ->with('country_details', $country_details)
                    ->with('shipinfo', $shipinfo)
                    ->with('order_products', $order_products)
                    ->with('wishlistdetails', $wishlistdetails)->with('wishlistcnt', $wishlistcnt);
            }

        } else {
            return Redirect::to('/');
        }

    }

    //update username from settings page
    public function update_username_ajax()
    {
        $customerid = Session::get('customerid');
        $fname = $_GET['fname'];
        $lname = $_GET['lname'];

        $checkinsert = Member::update_member_name($fname, $lname, $customerid);
        if ($checkinsert) {
            echo "success";
        } else {
            echo "fail";
        }
    }

    //update user id from settings page
    public function update_userid_ajax()
    {
        $customerid = Session::get('customerid');
        $nuid = $_GET['newuserid'];

        $checkdup = Member::check_memberid_edit($nuid, $customerid);
        if ($checkdup) {
            echo 'fail_dup';
            return;
        }

        $checkinsert = Member::update_member_userid($nuid, $customerid);
        if ($checkinsert) {
            echo "success";
        } else {
            echo "fail";
        }
    }

    //update phone number from settings page
    public function update_phonenumber_ajax()
    {
        $customerid = Session::get('customerid');
        $phonenum = $_GET['phonenum'];

        date_default_timezone_set("America/New_York");
        $date = date('Y-m-d H:i:s');

        $entry = array(
            'mem_phone' => $phonenum,
            'updated_at' => $date
        );

        $checkupdate = Member::update_member($customerid, $entry);

        if ($checkupdate) {
            echo "success";
        } else {
            echo "fail";
        }
    }

    //update city from settings page
    public function update_city_ajax()
    {
        $customerid = Session::get('customerid');
        $cityid = $_GET['cityid'];
        $countryid = $_GET['countryid'];

        $citynameres = Member::getcityname($cityid);
        $cityname = $citynameres[0]->ci_name;
        $countrynameres = Member::getcountryname($countryid);
        $countryname = $countrynameres[0]->co_name;
        $checkupdate = Member::update_city($cityid, $countryid, $customerid);
        if ($checkupdate) {
            echo "success," . $countryname . "," . $cityname;
        } else {
            echo "fail,";
        }
    }

    //update shipinfo from settins page
    public function update_shipinfo()
    {

        $customerid = Session::get('customerid');

        $ship_name = $_GET['name'];
        $ship_email = $_GET['email'];
        $ship_phone = $_GET['phone'];
        $ship_country = $_GET['country'];
        $ship_state = $_GET['state'];
        $ship_city = $_GET['city'];
        $ship_addr1 = $_GET['address1'];
        $ship_addr2 = $_GET['address2'];
        $ship_zipcode = $_GET['zipcode'];

        $check_city = City::check_exist_city_name2($ship_city, $ship_country, $ship_state);
        $sci_count = count($check_city);

        if ($sci_count > 0)
            $city_id = $check_city[0]->ci_id;
        else {
            echo 'fail';
            return;
        }

        $entry = array(
            'ship_mem_id' => $customerid,
            'ship_name' => $ship_name,
            'ship_email' => $ship_email,
            'ship_phone' => $ship_phone,
            'ship_country' => $ship_country,
            'ship_state' => $ship_state,
            'ship_city' => $city_id,
            'ship_address1' => $ship_addr1,
            'ship_address2' => $ship_addr2,
            'ship_zipcode' => $ship_zipcode,
        );

        $checkcustomerid = Member::get_shipinfo_details($customerid);

        if ($checkcustomerid) {

            $return = Member::update_shipinfo($customerid, $entry);

            if ($return) {
                echo "success";
            } else {
                echo "fail";
            }
        } else {

            $return = Member::insert_shipinfo($entry);

            if ($return) {
                echo "success";
            } else {
                echo "fail";
            }
        }

    }

    //update address from settings page
    public function update_address_ajax()
    {
        $customerid = Session::get('customerid');

        $country = $_GET['country'];
        $state = $_GET['state'];
        $city = $_GET['city'];
        $addr1 = $_GET['addr1'];
        $addr2 = $_GET['addr2'];

        $check_city = City::check_exist_city_name2($city, $country, $state);

        $sci_count = count($check_city);

        if ($sci_count > 0)
            $city_id = $check_city[0]->ci_id;
        else {
            echo 'fail';
            return;
        }

        date_default_timezone_set("America/New_York");
        $date = date('Y-m-d H:i:s');

        $entry = array(
            'mem_country' => $country,
            'mem_state' => $state,
            'mem_city' => $city_id,
            'mem_address1' => $addr1,
            'mem_address2' => $addr2,
            'updated_at' => $date
        );

        Member::update_member($customerid, $entry);

        echo 'success';
        return;
    }

    //update user password from settings page
    public function update_password_ajax()
    {
        $customerid = Session::get('customerid');
        $oldpwd = $_POST['oldpwd'];
        $md5oldpwd = md5($oldpwd);

        $newpwd = $_POST['newpwd'];
        $md5newpwd = md5($newpwd);

        $oldpwdcheck = Member::check_oldpwd($customerid, $md5oldpwd);

        if ($oldpwdcheck) {
            date_default_timezone_set("America/New_York");
            $date = date('Y-m-d H:i:s');

            $entry = array(
                'mem_password' => $md5newpwd,
                'updated_at' => $date
            );

            $updatecheck = Member::update_member($customerid, $entry);

            if ($updatecheck) {
                echo "success";
            } else {
                echo "fail";
            }
        } else {
            echo "fail";
        }
        return;
    }

    //update newsletter get setting from settings page
    public function update_newsget_ajax()
    {
        $customerid = Session::get('customerid');
        $newsget = $_GET['newsget'];

        $entry = array('mem_newsget' => $newsget);
        $updatecheck = Member::update_member($customerid, $entry);

        if ($updatecheck) {
            echo "success";
        } else {
            echo "fail";
        }
        return;
    }

    //update user profile image from settings page
    public function profile_image_submit()
    {

        $customerid = Session::get('customerid');
        $inputs = Input::all();
        $file = Input::file('imgfile');
        $filename = $file->getClientOriginalName();
        $move_img = explode('.', $filename);
        $filename = $move_img[0] . str_random(8) . "." . $move_img[1];
        $destinationPath = './public/assets/images/profile/';
        $uploadSuccess = Input::file('imgfile')->move($destinationPath, $filename);
        $updateimage = Member::update_profileimage($customerid, $filename);
        if ($updateimage) {
            return Redirect::to('settings');
        }
    }

    //update store info from setting page for only contributor
    public function update_store_info_of_contributor()
    {
        $customerid = Session::get('customerid');
        $logintype = Session::get('logintype');


        if (!$customerid || $logintype != Member::MEMBER_LOGIN_MERCHANT) {
            return Redirect::to('home');
        }

        $data = Input::except(array(
            '_token'
        ));

        $rule = array(
            'store_name' => 'required',
            'select_store_country' => 'required',
            'select_store_state' => 'required',
            'select_store_city' => 'required',
            'store_add_one' => 'required',
            'store_zipcode' => 'required',
            'store_phone' => 'required'
        );

        $validator = Validator::make($data, $rule);

        if ($validator->fails()) {

            return Redirect::to('my_store')->withErrors($validator->messages())->withInput();

        } else {

            $store_country = Input::get('select_store_country');
            $store_state = Input::get('select_store_state');
            $store_city_name = Input::get('select_store_city');
            $check_city = City::check_exist_city_name2($store_city_name, $store_country, $store_state);

            $sci_count = count($check_city);
            if ($sci_count > 0)
                $store_city_id = $check_city[0]->ci_id;
            else
                return Redirect::to('become_a_contributor')->withErrors("City for Store Doesn't Exists")->withInput();

            //upload store image
            $filename = Input::get('store_old_image');
            $path = './public/assets/images/storeimage/';

            if (!file_exists($path))
                $result = File::makeDirectory($path, 0777, true);

            $file = Input::file('store_img');

            //upload curator image
            if ($file) {
                //delete origin image
                $file_old_name = Input::get('store_old_image');
                if ($file_old_name) {
                    unlink($path . $file_old_name);
                }
                if (Input::get('x') == NAN || Input::get('y') == NAN || Input::get('w') == NAN || Input::get('h') == NAN) {
                    return Redirect::to('become_a_contributor')->withErrors('Please select the Store Image Region')->withInput();
                }
                $filename = ImageEditController::save_image_edited($file, Input::get('x'), Input::get('y'), Input::get('w'), Input::get('h'), $path);
            }

            date_default_timezone_set("America/New_York");
            $date = date('Y-m-d H:i:s');
            $store_name = Input::get('store_name');

            $store_id = Input::get('store_id');
            $merchant_id = Input::get('store_merchant_id');

            //Insert store city
            $store_entry = array(
                'stor_merchant_id' => $customerid,
                'stor_name' => $store_name,
                'stor_org' => Input::get('store_org'),
                'stor_title' => Input::get('store_title'),
                'stor_website' => Input::get('store_web'),
                'stor_country' => $store_country,
                'stor_state' => $store_state,
                'stor_city' => $store_city_id,
                'stor_address1' => Input::get('store_add_one'),
                'stor_address2' => Input::get('store_add_two'),
                'stor_zipcode' => Input::get('store_zipcode'),
                'stor_phone' => Input::get('store_phone'),
                'stor_metakeywords' => Input::get('meta_keyword'),
                'stor_orgdesc' => Input::get('store_orgdesc'),
                'stor_img' => $filename,
                'stor_show_map' => Input::get('show_map'),
                'updated_at' => $date,
            );

            Member::update_store_by_merchant_store($merchant_id, $store_id, $store_entry);

            return Redirect::to('my_store')->with('success', 'Your Store info updated Successfully');
        }
    }

    //show add product by contributor page
    public function add_product_by_contributor()
    {

        if (Session::has('customerid')) {

            $mem_id = Session::get('customerid');
            $member = Member::find($mem_id);

            if ($member) {
                if ($member->mem_logintype == Member::MEMBER_LOGIN_MERCHANT) {

                    $getlogodetails = Home::getlogodetails();
                    $getlogo2details = Home::getinverselogodetails();
                    $get_theme_list = Theme::get_theme_normal_list();
                    $get_category_list = Category::maincatg_active_list();
                    $get_social_media_url = Home::get_social_media_url();
                    $cms_page_title = Home::get_cms_page_title();
                    $get_contact_det = Footer::get_contact_details();

                    $getmetadetails = Home::get_meta_details();

                    $country_details = Country::get_country_list();

                    $header = view('includes.header')->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)->with('theme_list', $get_theme_list)->with('catg_list', $get_category_list)->with('menu_inverse', true);
                    $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $get_social_media_url);

                    $theme_details = ThemeController::get_affirmation_level_list();
                    $productcategory = Products::get_product_category();

                    $store_details = Member::get_store_from_merchant($mem_id);
                    $payment = $member->mem_payment;

                    return view('add_product_by_contributor')->with('header', $header)->with('footer', $footer)
                        ->with('metadetails', $getmetadetails)->with('productcategory', $productcategory)
                        ->with('merchant_id', $mem_id)->with('payment', $payment)
                        ->with('storedetails', $store_details)->with('theme_details', $theme_details);;

                }
            }
        }

        return Redirect::to('/');
    }

    //add product by contributor from live site
    public function add_product_submit_by_contributor()
    {

        if (Session::has('customerid')) {

            date_default_timezone_set("America/New_York");
            $date = date('m/d/Y');
            $data = Input::except(array(
                '_token'
            ));

            //theme select
            $theme_selection = Input::get('selected_theme');

            $themeids = explode(',', $theme_selection);
            $new_theme_ids = explode(',', $theme_selection);


            foreach ($themeids as $theme_id) {

                $theme = Theme::find($theme_id);

                if ($theme) {

                    $parent_theme_id = $theme->parent_theme;
                    if ($parent_theme_id != 0) {
                        //check whether parent theme exist
                        if (!in_array($parent_theme_id, $new_theme_ids)) {
                            array_push($new_theme_ids, $parent_theme_id);
                        }
                    }
                }

            }

            $theme_selection = implode(',', $new_theme_ids);

            $select_theme = str_replace(',', ':', $theme_selection);

            $select_theme = rtrim($select_theme, ':');

            $count = Input::get('count');
            $aid = Input::get('aid');

            $filename_new_get = "";
            $destination_path = './public/assets/images/product/';

            $first = true;

            for ($i = 1; $i < $aid; $i++) {

                if (Input::file('file_more' . $i)) {
                    $file_more = Input::file('file_more' . $i);

                    if (Input::get('x' . $i) == NAN || Input::get('y' . $i) == NAN || Input::get('w' . $i) == NAN || Input::get('h' . $i) == NAN) {
                        return Redirect::to('add_my_resource')->withErrors('Please select the Store Image Region')->withInput();
                    }

                    $filename_new = ImageEditController::save_image_edited($file_more, Input::get('x' . $i), Input::get('y' . $i), Input::get('w' . $i), Input::get('h' . $i), $destination_path);
                    if ($first) {
                        $filename_new_get = $filename_new;
                        $first = false;
                    } else {
                        $filename_new_get .= "/**/" . $filename_new;
                    }

                }

            }

            $file = Input::file('file0');

            if (Input::get('x0') == NAN || Input::get('y0') == NAN || Input::get('w0') == NAN || Input::get('h0') == NAN) {
                return Redirect::to('add_my_resource')->withErrors('Please select the Store Image Region')->withInput();
            }

            $filename = ImageEditController::save_image_edited($file, Input::get('x0'), Input::get('y0'), Input::get('w0'), Input::get('h0'), $destination_path);

            $file_name_insert = $filename . "/**/" . $filename_new_get;

            $Product_Title = Input::get('Product_Title');

            $Product_Category = Input::get('Product_Category');

            /*$Product_MainCategory = Input::get('Product_MainCategory');

            $Product_SubCategory = Input::get('Product_SubCategory');

            $Product_SecondSubCategory = Input::get('Product_SecondSubCategory');*/

            $price_free = Input::get('product_price_free');

            if ($price_free == 1) {
                $Original_Price = 0;
            } else {
                $Original_Price = Input::get('Original_Price');
            }

            $Description = Input::get('Description');

            $scripture = Input::get('Scripture');

            $Select_Merchant = Input::get('merchant_id');

            $Select_Shop = Input::get('Select_Shop');

            $inc_tax = Input::get('inctax');

            $postfb = Input::get('postfb');

            $img_count = Input::get('count') + 1;

            $product_content = Input::get('product_content');

            //product content = 1
            $Shipping_Amount = Input::get('Shipping_Amount');

            if ($Shipping_Amount == "") {

                $Shipping_Amount = 0;

            }

            //product content =2
            $file_down = Input::file('file_down');
            $filename_down = "";
            if ($file_down) {
                $dest_dir = './public/assets/images/product/download';

                if (!file_exists($dest_dir))
                    $result = File::makeDirectory($dest_dir, 0777, true);

                $filedown_name = $file_down->getClientOriginalName();

                $move_name = explode('.', $filedown_name);
                $fd_name = reset($move_name);
                $fd_extension = end($move_name);

                $fd_name = str_replace(array(' ', '?', '<', '>', '&', '{', '}', '*'), array('_'), $fd_name);

                $filename_down = $fd_name . "." . $fd_extension;
                $uploadSuccess2 = Input::file('file_down')->move($dest_dir, $filename_down);
            }

            //product content 3
            $product_link = Input::get('product_link');

            $check_store = Products::check_store($Product_Title, $Select_Shop);

            if ($check_store) {
                return Redirect::to('add_my_resource')->withErrors('The Product Already exist in the Store');
            } else {

                $merchant = Member::find($Select_Merchant);

                $merchant_email = $merchant->mem_email;
                $merchant_name = $merchant->mem_fname . ' ' . $merchant->mem_lname;
                $merchant_self = $merchant->mer_self;

                $pro_approved_status = ($merchant_self) ? Products::PRODUCT_STATUS_APPROVED : Products::PRODUCT_STATUS_PENDING;
                $pro_checked_by = ($merchant_self) ? 0 : -1;

                $entry = array(
                    'pro_title' => $Product_Title,
                    'pro_mc_id' => $Product_Category,
                    /*'pro_smc_id' => $Product_MainCategory,
                    'pro_sb_id' => $Product_SubCategory,
                    'pro_ssb_id' => $Product_SecondSubCategory,*/
                    'pro_free' => $price_free,
                    'pro_price' => $Original_Price,
                    'pro_inctax' => $inc_tax,
                    'pro_content_kind' => $product_content,
                    'pro_shippamt' => $Shipping_Amount,
                    'pro_file_down' => $filename_down,
                    'pro_file_link' => $product_link,
                    'pro_desc' => $Description,
                    'pro_mr_id' => $Select_Merchant,
                    'pro_sh_id' => $Select_Shop,
                    'pro_scripture' => $scripture,
                    'pro_Img' => $file_name_insert,
                    'pro_image_count' => $img_count,
                    'pro_theme_ids' => $select_theme,
                    'pro_status' => Products::PRODUCT_STATUS_ACTIVATED,
                    'pro_approved_status' => $pro_approved_status,
                    'pro_checked_by' => $pro_checked_by,
                    'created_date' => $date
                );

                $productid = Products::insert_product($entry);
                $encoded_productid = base64_encode($productid);

                //send add product confirm

                if ($_SERVER['HTTP_HOST'] != 'localhost') {
                    //$Product_Title, $productid
                    Mail::send('emails.merchant_product_upload', array('merchant_name' => $merchant_name, 'product_title' => $Product_Title, 'product_id' => $encoded_productid),
                        function ($message) use ($merchant_email) {
                            $message->to($merchant_email)->subject("Your resource has been submitted successfully");
                        });

                    $curators = Curator::get()->all();

                    //add this product to curator's check list
                    if ($curators && !$merchant_self) {
                        foreach ($curators as $curator) {
                            if ($curator && $curator->has_theme_in_charge($select_theme)) {
                                $curator_email = $curator->curator_email;
                                $curator_name = $curator->curator_name;

                                Mail::send('emails.curator_product_upload_inform', array('curator_name' => $curator_name, 'merchant_name' => $merchant_name, 'product_title' => $Product_Title, 'product_id' => $encoded_productid),
                                    function ($message) use ($curator_email) {
                                        $message->to($curator_email)->subject("New content is ready for review at This We Affirm");
                                    });
                            }
                        }
                    }

                }
            }

            return Redirect::to('add_my_resource')->with('message', 'Thank you! Your resource has been uploaded and is pending curator review. You will receive an email confirmation letting you know when the resource has been reviewed.');

        } else {

            return Redirect::to('/');

        }
    }


    //todo

    public function autosearch()
    {

        $q = $_GET['searchword'];
        if ($q != "") {
            $header_category = Home::get_autosearch_category($q);
            $header_category_get = Home::get_header_category();
            $category_count = Home::get_category_count($header_category_get);
            $get_product_details_typeahed = Home::get_product_details_autosearch($q);
            $get_cat_out = "";
            $general = Home::get_general_settings();
            foreach ($header_category as $header_categ) {
                $count = $category_count[$header_categ->mc_id];
                $get_cat_out .= '<a href="' . url('category_list/' . base64_encode($header_categ->mc_id)) . '" style="cursor:pointer;" >' . $header_categ->mc_name . '</a>' . '(' . $count . ')' . '<br/>';
            }
            $final_typeahed_result_one = $get_cat_out;

            if ($get_product_details_typeahed) {
                $final_typeahed_result_three = '=== Special Products ===';
            } else {
                $final_typeahed_result_three = '';
            }
            $get_product_out = "";

            foreach ($get_product_details_typeahed as $product_typeahed) {
                if ($product_typeahed->pro_no_of_purchase < $product_typeahed->pro_qty) {
                    $pro_type_img = explode('/**/', $product_typeahed->pro_Img);
                    $href = url('productview/' . $product_typeahed->pro_id);
                    $get_product_out .= '<div class="display_box" align="left"><table><tr><td><img src="' . url('') . '/public/assets/images/product' . $pro_type_img[0] . '" alt="" height="100" width="70" ></td><td width="5"> </td><td><table><tr> <td>' . substr($product_typeahed->pro_title, 0, 25) . '...<br> $' . $product_typeahed->pro_price . '<br><a href="' . $href . '" class="btn align_brn icon_me" style="width:60px; height:50px;" href="">Add To Cart</a> </td> </tr> </table> </td></tr></table> </div>.............................................';
                }
            }

            $final_typeahed_result_two = $get_product_out;
            $final_result = $final_typeahed_result_one . $final_typeahed_result_three . $final_typeahed_result_two;
            if ($final_result == "") {
                echo $final_typeahed_result = '<div class="display_box" align="left"> No Result Found.. </div>';
            } else {
                echo $final_typeahed_result = '<b><div class="display_box"  align="left">' . $final_typeahed_result_one . $final_typeahed_result_three . $final_typeahed_result_two . "</div></b>";
            }
        } else {
            echo "";
        }

    }

    public function cms($id)
    {
        $city_details = City::get_city_list();
        $header_category = Home::get_header_category();
        $cms_page_title = Home::get_cms_page_title();
        $get_social_media_url = Footer::get_social_media_url();
        $get_meta_details = Home::get_meta_details();
        $country_details = Country::get_country_list();
        $get_image_favicons_details = Home::get_image_favicons_details();
        $get_image_logoicons_details = Home::get_image_logoicons_details();
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
        //$help_deatils = Footer::get_help_details();
        $help_deatils = Footer::fetch_front_cms_details($id);
        return view('cms')->with('faq_result', $faq_deatils)->with('header', $header)->with('footer', $footer)->with('metadetails', $get_meta_details)->with('get_image_favicons_details', $get_image_favicons_details)->with('cms_result', $help_deatils)->with('get_contact_det', $get_contact_det)->with('general', $general);
    }

    public function nearmemap()
    {

        $city_details = City::get_city_list();
        $header_category = Home::get_header_category();
        $product_details = Home::get_product_details();
        $most_visited_product = Home::get_most_visited_product();

        $get_product_details_by_cat = Home::get_product_details_by_category($header_category);
        $category_count = Home::get_category_count($header_category);
        $get_product_details_typeahed = Home::get_product_details_typeahed();
        $main_category = Home::get_header_category();
        $sub_main_category = Home::get_sub_main_category($main_category);
        $second_main_category = Home::get_second_main_category($main_category, $sub_main_category);
        $second_sub_main_category = Home::get_second_sub_main_category();
        $get_social_media_url = Home::get_social_media_url();
        $cms_page_title = Home::get_cms_page_title();
        $country_details = Country::get_country_list();

        $get_store_details = Home::get_store_list();

        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $getmetadetails = Home::get_meta_details();
        $get_storeall = Home::get_store_all();
        $get_store_main = Home::get_store_setting();
        $get_store_all = Home::get_store_all();
        $get_default_city = Home::get_default_city();

        $get_contact_det = Footer::get_contact_details();
        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();


        $header = view('includes.header')->with('theme_list', $get_theme_list)->with('logodetails', $getlogodetails)
            ->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)
            ->with('catg_list', $get_category_list);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)
            ->with('get_social_media_url', $get_social_media_url)
            ->with('get_contact_det', $get_contact_det)->with('getanl', $getanl);

        return view('nearmemap')->with('header', $header)->with('footer', $footer)->with('header_category', $header_category)
            ->with('product_details', $product_details)
            ->with('get_product_details_by_cat', $get_product_details_by_cat)->with('most_visited_product', $most_visited_product)
            ->with('category_count', $category_count)->with('get_product_details_typeahed', $get_product_details_typeahed)
            ->with('main_category', $main_category)->with('sub_main_category', $sub_main_category)
            ->with('second_main_category', $second_main_category)->with('second_sub_main_category', $second_sub_main_category)
            ->with('get_store_details', $get_store_details)->with('metadetails', $getmetadetails)->with('get_storeall', $get_storeall)
            ->with('get_store_main', $get_store_main)->with('get_store_all', $get_store_all)
            ->with('get_contact_det', $get_contact_det)->with('get_default_city', $get_default_city)->with('general', $general);
    }


    public function sold()
    {
        $city_details = City::get_city_list();
        $header_category = Home::get_header_category();
        $product_name_single = "";
        $most_visited_product = Home::get_auction_details();
        $get_product_details_by_cat = Home::get_product_details_by_category($header_category);
        $category_count = Home::get_category_count($header_category);
        $get_product_details_typeahed = Home::get_product_details_typeahed();
        $main_category = Home::get_header_category();
        $sub_main_category = Home::get_sub_main_category($main_category);
        $second_main_category = Home::get_second_main_category($main_category, $sub_main_category);
        $second_sub_main_category = Home::get_second_sub_main_category();
        $get_social_media_url = Home::get_social_media_url();
        $cms_page_title = Home::get_cms_page_title();
        $country_details = Country::get_country_list();
        $get_store_deal_by_id = Home::get_sold_deal_by_id();

        $get_store_auction_by_id = Home::get_sold_auction_by_id();
        $get_store_product_by_id = Home::get_sold_product_by_id();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $getmetadetails = Home::get_meta_details();
        $get_contact_det = Footer::get_contact_details();
        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();


        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();


        $header = view('includes.header')->with('theme_list', $get_theme_list)->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)->with('catg_list', $get_category_list);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $getanl);

        return view('sold')->with('header', $header)->with('footer', $footer)->with('header_category', $header_category)->with('get_product_details_by_cat', $get_product_details_by_cat)->with('most_visited_product', $most_visited_product)->with('category_count', $category_count)->with('get_product_details_typeahed', $get_product_details_typeahed)->with('main_category', $main_category)->with('sub_main_category', $sub_main_category)->with('second_main_category', $second_main_category)->with('second_sub_main_category', $second_sub_main_category)->with('get_store_deal_by_id', $get_store_deal_by_id)->with('get_store_auction_by_id', $get_store_auction_by_id)->with('get_store_product_by_id', $get_store_product_by_id)->with('metadetails', $getmetadetails)->with('get_contact_det', $get_contact_det)->with('general', $general);


    }

    public function category_list($id)
    {
        $id = base64_decode($id);
        $city_details = City::get_city_list();
        $header_category = Home::get_header_category();
        $product_details = Home::get_product_details_use_catid($id);
        $most_visited_product = Home::get_most_visited_product();
        $get_product_details_by_cat = Home::get_product_details_by_category($header_category);
        $category_count = Home::get_category_count($header_category);
        $get_product_details_typeahed = Home::get_product_details_typeahed();
        $main_category = Home::get_header_category();
        $sub_main_category = Home::get_sub_main_category($main_category);
        $second_main_category = Home::get_second_main_category($main_category, $sub_main_category);
        $second_sub_main_category = Home::get_second_sub_main_category();
        $get_social_media_url = Home::get_social_media_url();
        $cms_page_title = Home::get_cms_page_title();
        $country_details = Country::get_country_list();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $getmetadetails = Home::get_meta_details();
        $get_contact_det = Footer::get_contact_details();
        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();


        $header = view('includes.header')->with('theme_list', $get_theme_list)->with('logodetails', $getlogodetails)
            ->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)->with('catg_list', $get_category_list);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)
            ->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)
            ->with('getanl', $getanl);

        return view('category_list')->with('header', $header)->with('footer', $footer)->with('header_category', $header_category)
            ->with('product_details', $product_details)
            ->with('get_product_details_by_cat', $get_product_details_by_cat)->with('most_visited_product', $most_visited_product)
            ->with('category_count', $category_count)->with('get_product_details_typeahed', $get_product_details_typeahed)
            ->with('main_category', $main_category)->with('sub_main_category', $sub_main_category)
            ->with('second_main_category', $second_main_category)->with('second_sub_main_category', $second_sub_main_category)
            ->with('metadetails', $getmetadetails)->with('get_contact_det', $get_contact_det)->with('general', $general);
    }

    public function paypal_checkout_success()
    {
        $set = Home::get_settings();
        foreach ($set as $se) {
        }

        if ($se->ps_paypal_pay_mode == '0') {
            $mode = 'sandbox';
        } elseif ($se->ps_paypal_pay_mode == '1') {
            $mode = 'live';
        } else {
            $mode = "sandbox";
        }
        //session_start();
        $PayPalMode = $mode; // sandbox or live
        $PayPalApiUsername = $se->ps_paypalaccount;

        $PayPalApiPassword = $se->ps_paypal_api_pw;

        $PayPalApiSignature = $se->ps_paypal_api_signature;

        $PayPalCurrencyCode = $se->ps_curcode; //Paypal Currency Code
        $PayPalReturnURL = url('paypal_checkout_success'); //Point to process.php page
        $PayPalCancelURL = url('paypal_checkout_cancel'); //Cancel URL if user clicks cancel
        require 'library/paypal/paypal.class.php';
        if (isset($_GET["token"]) && isset($_GET["PayerID"])) {
            //we will be using these two variables to execute the "DoExpressCheckoutPayment"
            //Note: we haven't received any payment yet.

            $token = $_GET["token"];
            $payer_id = $_GET["PayerID"];

            //get session variables
            $paypal_product = $_SESSION["paypal_products"];
            $paypal_data = '';
            $ItemTotalPrice = 0;

            foreach ($paypal_product['items'] as $key => $p_item) {
                $paypal_data .= '&L_PAYMENTREQUEST_0_QTY' . $key . '=' . urlencode($p_item['itm_qty']);
                $paypal_data .= '&L_PAYMENTREQUEST_0_AMT' . $key . '=' . urlencode($p_item['itm_price']);
                $paypal_data .= '&L_PAYMENTREQUEST_0_NAME' . $key . '=' . urlencode($p_item['itm_name']);
                $paypal_data .= '&L_PAYMENTREQUEST_0_NUMBER' . $key . '=' . urlencode($p_item['itm_code']);

                // item price X quantity
                $subtotal = ($p_item['itm_price'] * $p_item['itm_qty']);

                //total price
                $ItemTotalPrice = ($ItemTotalPrice + $subtotal);
            }

            $padata = '&TOKEN=' . urlencode($token) . '&PAYERID=' . urlencode($payer_id) . '&PAYMENTREQUEST_0_PAYMENTACTION=' . urlencode("SALE") . $paypal_data . '&PAYMENTREQUEST_0_ITEMAMT=' . urlencode($ItemTotalPrice) . '&PAYMENTREQUEST_0_TAXAMT=' . urlencode($paypal_product['assets']['tax_total']) . '&PAYMENTREQUEST_0_SHIPPINGAMT=' . urlencode($paypal_product['assets']['shippin_cost']) . '&PAYMENTREQUEST_0_HANDLINGAMT=' . urlencode($paypal_product['assets']['handaling_cost']) . '&PAYMENTREQUEST_0_SHIPDISCAMT=' . urlencode($paypal_product['assets']['shippin_discount']) . '&PAYMENTREQUEST_0_INSURANCEAMT=' . urlencode($paypal_product['assets']['insurance_cost']) . '&PAYMENTREQUEST_0_AMT=' . urlencode($paypal_product['assets']['grand_total']) . '&PAYMENTREQUEST_0_CURRENCYCODE=' . urlencode($PayPalCurrencyCode);

            //We need to execute the "DoExpressCheckoutPayment" at this point to Receive payment from user.
            $paypal = new MyPayPal();
            $httpParsedResponseAr = $paypal->PPHttpPost('DoExpressCheckoutPayment', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);

            //Check if everything went ok..
            if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {

                echo '<h2>Success</h2>';
                echo 'Your Transaction ID : ' . urldecode($httpParsedResponseAr["PAYMENTINFO_0_TRANSACTIONID"]);

                /*
                //Sometimes Payment are kept pending even when transaction is complete.
                //hence we need to notify user about it and ask him manually approve the transiction
                */

                if ('Completed' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"]) {
                    echo '<div style="color:green">Payment Received! Your product will be sent to you very soon!</div>';

                } elseif ('Pending' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"]) {

                }

                // we can retrive transection details using either GetTransactionDetails or GetExpressCheckoutDetails
                // GetTransactionDetails requires a Transaction ID, and GetExpressCheckoutDetails requires Token returned by SetExpressCheckOut
                $padata = '&TOKEN=' . urlencode($token);
                $paypal = new MyPayPal();
                $httpParsedResponseAr = $paypal->PPHttpPost('GetExpressCheckoutDetails', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);


                if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
                    $data = array(
                        'transaction_id' => urldecode($httpParsedResponseAr['PAYMENTREQUEST_0_TRANSACTIONID']),
                        'token_id' => urldecode($httpParsedResponseAr['TOKEN']),
                        'payer_email' => urldecode($httpParsedResponseAr['EMAIL']),
                        'payer_id' => urldecode($httpParsedResponseAr['PAYERID']),
                        'payer_name' => urldecode($httpParsedResponseAr['FIRSTNAME']),
                        'currency_code' => urldecode($httpParsedResponseAr['PAYMENTREQUEST_0_CURRENCYCODE']),
                        'payment_ack' => urldecode($httpParsedResponseAr['ACK']),
                        'payer_status' => urldecode($httpParsedResponseAr['PAYERSTATUS']),
                        'order_status' => 1,
                        'order_paytype' => 1
                    );
                    Home::paypal_checkout_update($data, Session::get('last_insert_id'));
                    unset($_SESSION['cart']);
                    unset($_SESSION['deal_cart']);
                    Session::flash('payment_success', 'Your Payment Has Been Completed Successfully');
                    include('library/SMTP/sendmail.php');
                    $emailsubject = "Your Payment Successfully completed.....";
                    $subject = "Payment Acknowledgement.....";
                    $name = $data['payer_name'];
                    $transid = $data['transaction_id'];
                    $payid = $data['payer_id'];
                    $ack = $data['payment_ack'];
                    $address = "yamuna@nexplocindia.com";

                    $resultmail = "success";
                    ob_start();
                    include('library/Emailsub/paymentemail.php');
                    $body = ob_get_contents();
                    ob_clean();
                    Send_Mail($address, $subject, $body);
                    $currenttransactionorderid = base64_encode(Session::get('last_insert_id'));
                    return Redirect::to('show_payment_result' . '/' . $currenttransactionorderid)->with('result', $data);
                } else {
                    unset($_SESSION['cart']);
                    unset($_SESSION['deal_cart']);
                    Session::flash('payment_failed', 'Your Payment Has Been Failed');
                    $currenttransactionorderid = base64_encode(0);
                    return Redirect::to('show_payment_result' . '/' . $currenttransactionorderid)->with('fail', "fail");

                }

            } else {
                unset($_SESSION['cart']);
                unset($_SESSION['deal_cart']);
                Session::flash('payment_error', 'Some error Occured during Payment');
                return Redirect::to('home');
            }
        }
    }

    public function paypal_checkout_cancel()
    {
        unset($_SESSION['cart']);
        unset($_SESSION['deal_cart']);
        Session::flash('payment_cancel', 'Your Payment Has Been Cancelled');
        return Redirect::to('home');

    }

    public function bid_payment()
    {
        $bid_price = Input::get('bid_update_value');
        $bid_auc_id = Input::get('auction_bid_proid_popup');
        $return_url = Input::get('return_url');
        if (Session::get('customerid')) {
            $customerid = Session::get('customerid');
        } else {
            $customerid = 0;
        }
        $customerdetails = Member::get_member($customerid);
        $get_social_media_url = Home::get_social_media_url();
        $cms_page_title = Home::get_cms_page_title();
        $get_image_logoicons_details = Home::get_image_logoicons_details();
        $get_acution_details = Home::get_action_details_by_id($bid_auc_id);
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $getmetadetails = Home::get_meta_details();
        $get_contact_det = Footer::get_contact_details();
        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $get_social_media_url);

        return view('bid_payment')->with('footer', $footer)->with('get_image_logoicons_details', $get_image_logoicons_details)->with('get_acution_details', $get_acution_details)->with('price', $bid_price)->with('customerdetails', $customerdetails)->with('return_url', $return_url)->with('metadetails', $getmetadetails)->with('get_contact_det', $get_contact_det)->with('general', $general);

    }

    public function place_bid_payment()
    {

        $bid_price = Input::get('bid_amt');
        $bid_auc_id = Input::get('auction_bid_proid_popup');
        $bid_auc_shipping = Input::get('bid_shipping');
        $return_url = Input::get('return_url');
        $entry = array(
            'oa_pro_id' => Input::get('oa_pro_id'),
            'oa_cus_id' => Input::get('oa_cus_id'),
            'oa_cus_name' => Input::get('oa_cus_name'),
            'oa_cus_email' => Input::get('oa_cus_email'),
            'oa_cus_address' => Input::get('oa_cus_address'),
            'oa_bid_amt' => Input::get('oa_bid_amt'),
            'oa_bid_shipping_amt' => Input::get('bid_shipping'),
            'oa_original_bit_amt' => Input::get('oa_original_bit_amt')
        );

        Home::save_bidding_details($entry);
        $get_social_media_url = Home::get_social_media_url();
        $cms_page_title = Home::get_cms_page_title();
        $get_image_logoicons_details = Home::get_image_logoicons_details();
        $get_acution_details = Home::get_action_details_by_id($bid_auc_id);
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $getmetadetails = Home::get_meta_details();
        $get_contact_det = Footer::get_contact_details();
        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $get_social_media_url);

        return view('place_bid_payment')->with('footer', $footer)->with('get_image_logoicons_details', $get_image_logoicons_details)->with('get_acution_details', $get_acution_details)->with('price', $bid_price)->with('return_url', $return_url)->with('metadetails', $getmetadetails)->with('get_contact_det', $get_contact_det)->with('general', $general);

    }

    public function bid_payment_error()
    {
        return Redirect::to('home')->with('error', ' Error!  Already Auction has bid. Try with new amount!');
    }

    public function newsletter()
    {

        $city_details = City::get_city_list();
        $header_category = Home::get_header_category();
        $product_details = Home::get_product_details();
        $most_visited_product = Home::get_most_visited_product();
        $get_product_details_by_cat = Home::get_product_details_by_category($header_category);
        $category_count = Home::get_category_count($header_category);
        $get_product_details_typeahed = Home::get_product_details_typeahed();
        $main_category = Home::get_header_category();
        $sub_main_category = Home::get_sub_main_category($main_category);
        $second_main_category = Home::get_second_main_category($main_category, $sub_main_category);
        $second_sub_main_category = Home::get_second_sub_main_category();
        $get_social_media_url = Home::get_social_media_url();
        $cms_page_title = Home::get_cms_page_title();
        $country_details = Country::get_country_list();
        $addetails = Home::get_ad_details();
        $noimagedetails = Home::get_noimage_details();
        $getbannerimagedetails = Home::getbannerimagedetails();
        $getmetadetails = Home::get_meta_details();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $get_contact_det = Footer::get_contact_details();
        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();

        $header = view('includes.header')->with('header_category', $header_category)->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('theme_list', $get_theme_list)->with('catg_list', $get_category_list);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $getanl);
        $country_return = Country::get_country_list();
        return view('newsletter')->with('header', $header)->with('footer', $footer)->with('header_category', $header_category)->with('get_product_details_by_cat', $get_product_details_by_cat)
            ->with('most_visited_product', $most_visited_product)->with('category_count', $category_count)
            ->with('get_product_details_typeahed', $get_product_details_typeahed)->with('main_category', $main_category)
            ->with('sub_main_category', $sub_main_category)->with('second_main_category', $second_main_category)
            ->with('second_sub_main_category', $second_sub_main_category)->with('country_details', $country_return)
            ->with('metadetails', $getmetadetails)->with('get_contact_det', $get_contact_det)->with('general', $general);
    }

    public function subscription_submit()
    {
        $data = Input::except(array(
            '_token'
        ));

        $email = Input::get('email');
        $check_email = Register::check_email_ajaxs($email);
        if ($check_email) {
            return Redirect::to('newsletter')->with('Error_letter', 'Already Use Email Exist');
        } else {
            $email = Input::get('email');

            if ($_SERVER['HTTP_HOST'] != 'localhost') {
                Mail::send('emails.subscription_mail', array(
                    'email' => Input::get('email')
                ), function ($message) {
                    $message->to(Input::get('email'))->subject('Email Has Been Subscription Successfully');
                });
            }
            $entry = array(

                'email' => Input::get('email')
            );
            $email = Register::insert_email($entry);
        }
        return Redirect::to('newsletter')->with('subscribe', 'Your Email Subscribed Successfully');
    }

    public function compare()
    {
        return view('compare');
    }

    public function dealcomments()
    {

        $data = Input::except(array(
            '_token'
        ));

        $customem_id = Input::get('customem_id');

        $deal_id = Input::get('deal_id');
        $title = Input::get('title');
        $comments = Input::get('comments');
        $ratings = Input::get('ratings');

        $entry = array(
            'customem_id' => Input::get('customem_id'),

            'deal_id' => Input::get('deal_id'),
            'title' => Input::get('title'),
            'comments' => Input::get('comments'),
            'ratings' => Input::get('ratings')
        );

        $comments = Home::comment_insert($entry);

        return Redirect::to('deals')->with('success1', 'Your Deal Product Review Post Successfully');

    }

    public function storecomments()
    {

        $data = Input::except(array(
            '_token'
        ));

        $customem_id = Input::get('customem_id');

        $store_id = Input::get('store_id');
        $title = Input::get('title');
        $comments = Input::get('comments');
        $ratings = Input::get('ratings');
        $entry = array(
            'customem_id' => Input::get('customem_id'),

            'store_id' => Input::get('store_id'),
            'title' => Input::get('title'),
            'comments' => Input::get('comments'),
            'ratings' => Input::get('ratings')
        );

        $comments = Home::comment_insert($entry);

        return Redirect::to('shops')->with('success_store', 'Your Deal Store Review Post Successfully');

    }

    public function smtp_mail_settings()
    {

        $smtp_mail = Home::get_smtp_mail();

        return view('app/config/mail')->with('smtp_mail', $smtp_mail);
    }


    //Custom not found error page
    public function not_found()
    {
        $general = Home::get_general_settings();
        $get_social_media_url = Home::get_social_media_url();
        $trending_products = Home::get_trending_product();
        $cms_page_title = Home::get_cms_page_title();
        $country_details = Country::get_country_list();
        $addetails = Home::get_ad_details();
        $getbannerimagedetails = Home::getbannerimagedetails();
        $getmetadetails = Home::get_meta_details();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $get_contact_det = Footer::get_contact_details();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();

        $header = view('includes.header')->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)->with('theme_list', $get_theme_list)->with('catg_list', $get_category_list)->with('menu_inverse', true);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $get_social_media_url);

        return view('errors.404')->with('header', $header)->with('footer', $footer)
            ->with('trending_products', $trending_products)->with('addetails', $addetails)
            ->with('bannerimagedetails', $getbannerimagedetails)->with('metadetails', $getmetadetails)
            ->with('get_contact_det', $get_contact_det)->with('general', $general)->with('metadetails', $getmetadetails)
            ->with('category_details', $get_category_list);
    }

    //custom error page
    public function error_occurred()
    {
        $general = Home::get_general_settings();
        $get_social_media_url = Home::get_social_media_url();
        $trending_products = Home::get_trending_product();
        $cms_page_title = Home::get_cms_page_title();
        $country_details = Country::get_country_list();
        $addetails = Home::get_ad_details();
        $getbannerimagedetails = Home::getbannerimagedetails();
        $getmetadetails = Home::get_meta_details();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $get_contact_det = Footer::get_contact_details();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();

        $header = view('includes.header')->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)->with('theme_list', $get_theme_list)->with('catg_list', $get_category_list)->with('menu_inverse', true);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $get_social_media_url);

        return view('errors.custom_error')->with('header', $header)->with('footer', $footer)
            ->with('trending_products', $trending_products)->with('addetails', $addetails)
            ->with('bannerimagedetails', $getbannerimagedetails)->with('metadetails', $getmetadetails)
            ->with('get_contact_det', $get_contact_det)->with('general', $general)->with('metadetails', $getmetadetails)
            ->with('category_details', $get_category_list);
    }


    /*Payment Temp*/
    //payment checkout process
    public function payment_checkout_process()
    {
        // session_start();
        $cust_id = Session::get('customerid');
        $pay_type = Input::get('select_payment_type');
        if ($pay_type == 1) {
            $settings = Home::get_settings();
            //print_r($settings);
            foreach ($settings as $s) {
            }

            if ($s->ps_paypal_pay_mode == '0') {
                $mode = 'sandbox';
            } elseif ($s->ps_paypal_pay_mode == '1') {
                $mode = 'live';
            }

            $PayPalMode = $mode; // sandbox or live
            $PayPalApiUsername = $s->ps_paypalaccount;

            $PayPalApiPassword = $s->ps_paypal_api_pw;

            $PayPalApiSignature = $s->ps_paypal_api_signature;

            $PayPalCurrencyCode = $s->ps_curcode;
            $PayPalReturnURL = url('paypal_checkout_success'); //Point to process.php page
            $PayPalCancelURL = url('paypal_checkout_cancel'); //Cancel URL if user clicks cancel
            require 'library/paypal/paypal.class.php';

            $paypalmode = ($PayPalMode == $mode) ? '.' . $mode : '';
            if ($_POST) //Post Data received from product list page.
            {
                //Other important variables like tax, shipping cost
                if (isset($_POST['tax_price']) && $_POST['tax_price'] != '') {
                    $TotalTaxAmount = $_POST['tax_price']; //Sum of tax for all items in this order.
                } else {
                    $TotalTaxAmount = 0;
                }
                $HandalingCost = 0.00; //Handling cost for this order.
                $InsuranceCost = 0.00; //shipping insurance cost for this order.
                $ShippinDiscount = 0.00; //Shipping discount for this order. Specify this as negative number.
                if (isset($_POST['shipping_price']) && $_POST['shipping_price'] != '') {
                    $ShippinCost = $_POST['shipping_price']; //Although you may change the value later, try to pass in a shipping amount that is reasonably accurate.
                } else {
                    $ShippinCost = 0;
                }
                //we need 4 variables from product page Item Name, Item Price, Item Number and Item Quantity.
                //Please Note : People can manipulate hidden field amounts in form,
                //In practical world you must fetch actual price from database using item id.
                //eg : $ItemPrice = $mysqli->query("SELECT item_price FROM products WHERE id = Product_Number");
                $paypal_data = '';
                $ItemTotalPrice = 0;
                $now = date('Y-m-d h:i:sa');
                $insert_id = '';
                foreach ($_POST['item_name'] as $key => $itmname) {
                    $product_code = filter_var($_POST['item_code'][$key], FILTER_SANITIZE_STRING);

                    $paypal_data .= '&L_PAYMENTREQUEST_0_NAME' . $key . '=' . urlencode($_POST['item_name'][$key]);
                    $paypal_data .= '&L_PAYMENTREQUEST_0_NUMBER' . $key . '=' . urlencode($_POST['item_code'][$key]);
                    $paypal_data .= '&L_PAYMENTREQUEST_0_AMT' . $key . '=' . urlencode($_POST['item_price'][$key]);
                    $paypal_data .= '&L_PAYMENTREQUEST_0_QTY' . $key . '=' . urlencode($_POST['item_qty'][$key]);
                    $paypal_data .= '&L_PAYMENTREQUEST_0_DESC' . $key . '=' . urlencode("Color : " . $_POST['item_color_name'][$key] . " - Size : " . $_POST['item_size_name'][$key]);


                    // item price X quantity

                    $subtotal = ($_POST['item_price'][$key] * $_POST['item_qty'][$key]);

                    //total price
                    $ItemTotalPrice = $ItemTotalPrice + $subtotal;

                    //create items for session
                    $paypal_product['items'][] = array(
                        'itm_name' => $_POST['item_name'][$key],
                        'itm_price' => $_POST['item_price'][$key],
                        'itm_code' => $_POST['item_code'][$key],
                        'itm_qty' => $_POST['item_qty'][$key]

                    );
                    $shipaddresscus = Input::get('fname') . ',' . Input::get('addr_line') . ',' . Input::get('addr1_line') . ',' . Input::get('state') . ',' . Input::get('zipcode') . ',' . Input::get('phone1_line') . ',' . Input::get('email');

                    // $shipaddresscus            = Input::get('fname' . $key) . ',' . Input::get('addr_line' . $key) . ',' . Input::get('addr1_line' . $key) . ',' . Input::get('state' . $key) . ',' . Input::get('zipcode' . $key) . ',' . Input::get('phone1_line' . $key);
                    //print_r($shipaddresscus);
                    //exit();
                    $data = array(
                        'order_cus_id' => Session::get('customerid'),
                        'order_pro_id' => $_POST['item_code'][$key],
                        'order_type' => $_POST['item_type'][$key],
                        'order_qty' => $_POST['item_qty'][$key],
                        'order_amt' => $subtotal,
                        'order_tax' => $_POST['item_tax'][$key],
                        'order_date' => $now,
                        'order_status' => 3,
                        'order_paytype' => 'paypal',
                        'order_pro_color' => $_POST['item_color'][$key],
                        'order_pro_size' => $_POST['item_size'][$key],
                        'order_shipping_add' => $shipaddresscus
                    );

                    if (($_POST['item_type'][$key]) != 2) {
                        Home::purchased_checkout_product_insert($_POST['item_code'][$key]);
                    }
                    Home::paypal_checkout_insert($data);
                    $new_insert = DB::getPdo()->lastInsertId();
                    $insert_id .= DB::getPdo()->lastInsertId() . ',';
                    if (Input::get('load_ship' . $key) != 1) {
                        $data = array(
                            'ship_name' => Input::get('fname'),
                            'ship_address1' => Input::get('addr_line'),
                            'ship_address2' => Input::get('addr1_line'),
                            'ship_state' => Input::get('state'),
                            'ship_postalcode' => Input::get('zipcode'),
                            'ship_phone' => Input::get('phone1_line'),
                            'ship_email' => Input::get('email'),
                            'ship_cus_id' => $cust_id,
                            'ship_order_id' => $new_insert
                        );

                        Home::insert_shipping_addr($data, $cust_id);
                    }

                }

                Session::put('last_insert_id', trim($insert_id, ','));
                //Grand total including all tax, insurance, shipping cost and discount
                $GrandTotal = ($ItemTotalPrice + $TotalTaxAmount + $HandalingCost + $InsuranceCost + $ShippinCost + $ShippinDiscount);


                $paypal_product['assets'] = array(
                    'tax_total' => $TotalTaxAmount,
                    'handaling_cost' => $HandalingCost,
                    'insurance_cost' => $InsuranceCost,
                    'shippin_discount' => $ShippinDiscount,
                    'shippin_cost' => $ShippinCost,
                    'grand_total' => $GrandTotal
                );

                //create session array for later use
                $_SESSION["paypal_products"] = $paypal_product;


                //Parameters for SetExpressCheckout, which will be sent to PayPal
                $padata = '&METHOD=SetExpressCheckout' . '&RETURNURL=' . urlencode($PayPalReturnURL) . '&CANCELURL=' . urlencode($PayPalCancelURL) . '&PAYMENTREQUEST_0_PAYMENTACTION=' . urlencode("SALE") . $paypal_data . '&NOSHIPPING=0' . //set 1 to hide buyer's shipping address, in-case products that does not require shipping
                    '&PAYMENTREQUEST_0_ITEMAMT=' . urlencode($ItemTotalPrice) . '&PAYMENTREQUEST_0_TAXAMT=' . urlencode($TotalTaxAmount) . '&PAYMENTREQUEST_0_SHIPPINGAMT=' . urlencode($ShippinCost) . '&PAYMENTREQUEST_0_HANDLINGAMT=' . urlencode($HandalingCost) . '&PAYMENTREQUEST_0_SHIPDISCAMT=' . urlencode($ShippinDiscount) . '&PAYMENTREQUEST_0_INSURANCEAMT=' . urlencode($InsuranceCost) . '&PAYMENTREQUEST_0_AMT=' . urlencode($GrandTotal) . '&PAYMENTREQUEST_0_CURRENCYCODE=' . urlencode($PayPalCurrencyCode) . '&LOCALECODE=EN' . //PayPal pages to match the language on your website.

                    //'&LOGOIMG=http://www.sanwebe.com/wp-content/themes/sanwebe/img/logo.png'. //site logo
                    '&CARTBORDERCOLOR=FFFFFF' . //border color of cart
                    '&ALLOWNOTE=1';

                //We need to execute the "SetExpressCheckOut" method to obtain paypal token
                $paypal = new MyPayPal();
                $httpParsedResponseAr = $paypal->PPHttpPost('SetExpressCheckout', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);

                //print_r($httpParsedResponseAr["ACK"]); exit();
                //Respond according to message we receive from Paypal
                if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
                    //Redirect user to PayPal store with Token received.

                    $paypalurl = 'https://www' . $paypalmode . '.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=' . $httpParsedResponseAr["TOKEN"] . '';
                    //header('Location: '.$paypalurl);
                    echo '<script>window.location="' . $paypalurl . '"</script>';
                } else {
                    //Show error message
                    return Redirect::to('home');
                }
            }
        } else {
            $now = date('Y-m-d h:i:sa');
            $insert_id = '';
            $ItemTotalPrice = 0;
            $transaction_id = str_random(8);
            $trans_check = Home::trans_check($transaction_id);

            if ($trans_check) {
                $transaction_id = str_random(8);
            }
            foreach ($_POST['item_name'] as $key => $itmname) {
                $product_code = $_POST['item_code'][$key];

                $subtotal = ($_POST['item_price'][$key] * $_POST['item_qty'][$key]);
                //total price
                $ItemTotalPrice = $ItemTotalPrice + $subtotal;

                $shipaddresscus = Input::get('fname') . ',' . Input::get('addr_line') . ',' . Input::get('addr1_line') . ',' . Input::get('state') . ',' . Input::get('zipcode') . ',' . Input::get('phone1_line') . ',' . Input::get('email');

                $data = array(
                    'cod_cus_id' => Session::get('customerid'),
                    'cod_order_type' => $_POST['item_type'][$key],
                    'cod_transaction_id' => $transaction_id,
                    'cod_pro_id' => $product_code,
                    'cod_qty' => $_POST['item_qty'][$key],
                    'cod_amt' => $subtotal,
                    'cod_tax' => $_POST['item_tax'][$key],
                    'cod_date' => $now,
                    'cod_status' => 3,
                    'cod_paytype' => 'COD',

                    'cod_pro_color' => $_POST['item_color'][$key],
                    'cod_pro_size' => $_POST['item_size'][$key],
                    'cod_ship_addr' => $shipaddresscus
                );


                if (($_POST['item_type'][$key]) != 2) {
                    Home::purchased_checkout_product_insert($_POST['item_code'][$key]);
                }
                Home::cod_checkout_insert($data);
                $new_insert = DB::getPdo()->lastInsertId();
                $insert_id .= DB::getPdo()->lastInsertId() . ',';
                if (Input::get('load_ship' . $key) != 1) {
                    $data_ship = array(
                        'ship_name' => Input::get('fname'),
                        'ship_address1' => Input::get('addr_line'),
                        'ship_address2' => Input::get('addr1_line'),
                        'ship_state' => Input::get('state'),
                        'ship_postalcode' => Input::get('zipcode'),
                        'ship_phone' => Input::get('phone1_line'),
                        'ship_cus_id' => $cust_id,
                        'ship_order_id' => $new_insert,
                        'ship_email' => Input::get('email')
                    );

                    Home::insert_shipping_addr($data_ship, $cust_id);
                }


            }
            Session::put('last_insert_id', trim($insert_id, ','));

            unset($_SESSION['cart']);
            unset($_SESSION['deal_cart']);
            Session::flash('payment_success', 'Your Cod Payment is Success');
            include('library/SMTP/sendmail.php');
            $emailsubject = "Your COD  Successfully Registered.....";
            $subject = "COD Acknowledgement.....";
            $name = Session::get('username');
            $transid = $transaction_id;
            $shipaddress = $shipaddresscus;
            $address = "";

            $resultmail = "success";
            ob_start();
            include('library/Emailsub/paymentcod.php');
            $body = ob_get_contents();
            ob_clean();
            Send_Mail($address, $subject, $body);

            $trans = Session::get('last_insert_id');
            $trans_id = Home::transaction_id($trans);
            $get_subtotal = Home::get_subtotal($trans_id);
            $get_tax = Home::get_tax($trans_id);
            $get_shipping_amount = Home::get_shipping_amount($trans_id);

            $currenttransactionorderid = base64_encode($trans_id);

            //$currenttransactionorderid = base64_encode(Session::get('last_insert_id'));


            $value = DB::table('nm_product')->where('pro_id', '=', $data['cod_pro_id'])->first();

            $merchant_details = DB::table('nm_product')->join('nm_member', 'nm_product.pro_mr_id', '=', 'nm_member.mem_id')->where('pro_id', '=', $data['cod_pro_id'])->first();

            if ($_SERVER['HTTP_HOST'] != 'localhost') {
                //Member Mail after order complete
                Mail::send('emails.ordermail', array(
                    'customer_name' => $name,
                    'transaction_id' => $transid,
                    'Sub_total' => $get_subtotal,
                    'Tax' => $get_tax,
                    'Shipping_amount' => $get_shipping_amount,
                    'qty' => $data['cod_qty'],
                    'item_price' => $subtotal,
                    'address1' => $data['cod_ship_addr'],
                    'product_name' => $value->pro_title
                ), function ($message) use ($data) {

                    $customer_mail = $data['cod_ship_addr'];

                    $allpas = explode(",", $customer_mail);
                    $cus_mail = $allpas[6];
                    //echo $allpas[6];
                    $message->to($cus_mail)->subject('Your Order Confirmation Details Placed Successfully');
                });
            }


            //Merchant Mail after order complete
            $merchant_trans_id = Home::get_merchant_based_transaction_id($trans_id);
            if (isset($merchant_trans_id) && $merchant_trans_id != "") {
                foreach ($merchant_trans_id as $mer => $m) {
                    $merchant_id = $m->cod_merchant_id;
                    $get_mer_subtotal = Home::get_mer_subtotal($trans_id, $merchant_id);
                    $get_mer_tax = Home::get_mer_tax($trans_id, $merchant_id);
                    $get_mer_shipping_amount = Home::get_mer_shipping_amount($trans_id, $merchant_id);

                    if ($_SERVER['HTTP_HOST'] != 'localhost') {
                        Mail::send('emails.order-merchantmail', array(
                            'transaction_id' => $trans_id,
                            'Sub_total' => $get_mer_subtotal,
                            'Tax' => $get_mer_tax,
                            'Shipping_amount' => $get_mer_shipping_amount, 'merchant_id' => $merchant_id), function ($message) use ($data) {
                            if (isset($_SESSION['deal_cart']) && !empty($_SESSION['deal_cart'])) {
                                $merchant = DB::table('nm_deals')->where('deal_id', '=', $data['cod_pro_id'])->LeftJoin('nm_member', 'nm_member.mem_id', '=', 'nm_deals.deal_merchant_id')->first();
                                $merchant_mail = $merchant->mem_email;
                            }
                            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                                $merchant = DB::table('nm_product')->where('pro_id', '=', $data['cod_pro_id'])->LeftJoin('nm_member', 'nm_member.mem_id', '=', 'nm_product.pro_mr_id')->first();
                                $merchant_mail = $merchant->mem_email;
                                echo $merchant_mail;
                            }

                            $message->to('kailashkumar.r@pofitec.com')->subject('Hi Merchant! Your Product Purchased!!');
                        });
                    }
                }
                unset($_SESSION['cart']);
                unset($_SESSION['deal_cart']);

                return Redirect::to('show_payment_result_cod' . '/' . $currenttransactionorderid)->with('result', $data);

            }
        }
    }

    //show payment result
    public function show_payment_result($orderid)
    {
        $cust_id = Session::get('customerid');

        $converorderid = base64_decode($orderid);

        $getorderdetails = Home::getorderdetails($converorderid);

        //common
        $city_details = City::get_city_list();
        $header_category = Home::get_header_category();

        $most_visited_product = Home::get_most_visited_product();

        $get_product_details_by_cat = Home::get_product_details_by_category($header_category);
        $category_count = Home::get_category_count($header_category);
        $get_product_details_typeahed = Home::get_product_details_typeahed();
        $main_category = Home::get_header_category();
        $sub_main_category = Home::get_sub_main_category($main_category);
        $second_main_category = Home::get_second_main_category($main_category, $sub_main_category);
        $second_sub_main_category = Home::get_second_sub_main_category();
        $get_social_media_url = Home::get_social_media_url();
        $cms_page_title = Home::get_cms_page_title();
        $country_details = Country::get_country_list();
        $addetails = Home::get_ad_details();
        $noimagedetails = Home::get_noimage_details();
        $getbannerimagedetails = Home::getbannerimagedetails();
        $getmetadetails = Home::get_meta_details();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();

        $get_contact_det = Footer::get_contact_details();
        $country_details = Country::get_country_list();
        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();


        $header = view('includes.header')->with('theme_list', $get_theme_list)->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)->with('catg_list', $get_category_list);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $getanl);

        return view('paymentresult')->with('header', $header)->with('footer', $footer)->with('header_category', $header_category)->with('get_product_details_by_cat', $get_product_details_by_cat)->with('most_visited_product', $most_visited_product)->with('category_count', $category_count)->with('get_product_details_typeahed', $get_product_details_typeahed)->with('main_category', $main_category)->with('sub_main_category', $sub_main_category)->with('second_main_category', $second_main_category)->with('second_sub_main_category', $second_sub_main_category)->with('addetails', $addetails)->with('noimagedetails', $noimagedetails)->with('bannerimagedetails', $getbannerimagedetails)->with('meta_details', $getmetadetails)->with('orderdetails', $getorderdetails)->with('get_contact_det', $get_contact_det)->with('general', $general);
    }


    //show payment result code
    public function show_payment_result_cod($orderid)
    {
        $cust_id = Session::get('customerid');

        $converorderid = base64_decode($orderid);

        $getorderdetails = Home::getordercoddetails($converorderid);
        $get_subtotal = Home::get_subtotal($converorderid);
        $get_tax = Home::get_tax($converorderid);
        $get_shipping_amount = Home::get_shipping_amount($converorderid);
        //common
        $city_details = City::get_city_list();
        $header_category = Home::get_header_category();

        $most_visited_product = Home::get_most_visited_product();

        $get_product_details_by_cat = Home::get_product_details_by_category($header_category);
        $category_count = Home::get_category_count($header_category);
        $get_product_details_typeahed = Home::get_product_details_typeahed();
        $main_category = Home::get_header_category();
        $sub_main_category = Home::get_sub_main_category($main_category);
        $second_main_category = Home::get_second_main_category($main_category, $sub_main_category);
        $second_sub_main_category = Home::get_second_sub_main_category();
        $get_social_media_url = Home::get_social_media_url();
        $cms_page_title = Home::get_cms_page_title();
        $country_details = Country::get_country_list();
        $addetails = Home::get_ad_details();
        $noimagedetails = Home::get_noimage_details();
        $getbannerimagedetails = Home::getbannerimagedetails();
        $getmetadetails = Home::get_meta_details();
        $getlogodetails = Home::getlogodetails();
        $getlogo2details = Home::getinverselogodetails();
        $get_contact_det = Footer::get_contact_details();
        $getanl = Settings::social_media_settings();
        $general = Home::get_general_settings();

        $get_theme_list = Theme::get_theme_normal_list();
        $get_category_list = Category::maincatg_active_list();


        $country_details = Country::get_country_list();


        $header = view('includes.header')->with('theme_list', $get_theme_list)->with('logodetails', $getlogodetails)->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)->with('catg_list', $get_category_list);
        $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)->with('get_social_media_url', $get_social_media_url)->with('get_contact_det', $get_contact_det)->with('getanl', $getanl);

        return view('paymentresultcod')->with('header', $header)->with('footer', $footer)->with('header_category', $header_category)->with('get_product_details_by_cat', $get_product_details_by_cat)->with('most_visited_product', $most_visited_product)->with('category_count', $category_count)->with('get_product_details_typeahed', $get_product_details_typeahed)->with('main_category', $main_category)->with('sub_main_category', $sub_main_category)->with('second_main_category', $second_main_category)->with('second_sub_main_category', $second_sub_main_category)->with('addetails', $addetails)->with('noimagedetails', $noimagedetails)->with('bannerimagedetails', $getbannerimagedetails)->with('metadetails', $getmetadetails)->with('orderdetails', $getorderdetails)->with('get_contact_det', $get_contact_det)->with('get_subtotal', $get_subtotal)->with('get_tax', $get_tax)->with('get_shipping_amount', $get_shipping_amount)->with('general', $general);
    }


    //checkout as guest
    public function checkout_as_guest_submit()
    {
        Session::put('guest_checkout', true);
        return response()->json(['result' => 'success']);
    }

    //subscribe submit
    public function subscribe_submit()
    {
        $subscribe_email = strtolower(Input::get('subscribe_email'));
        $subscribe_name = Input::get('subscribe_name');

        $count = count(DB::table('nm_newsletter_subscribers')->where('email', $subscribe_email)->get());

        if ($count > 0) {
            return response()->json(['result' => 'fail', 'message' => "Same Subscriber E-mail exists"]);
        }

        $from_member = 0;
        $member_exist = count(Member::where('mem_email', $subscribe_email)->get());
        if ($member_exist)
            $from_member = 1;
        $entry = array('name' => $subscribe_name, 'email' => $subscribe_email, 'status' => 1, 'from_member' => $from_member);

        DB::table('nm_newsletter_subscribers')->insert($entry);

        return response()->json(['result' => 'success']);

    }
}


    