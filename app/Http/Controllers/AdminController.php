<?php
namespace App\Http\Controllers;

use DB;
use Session;
use App\Http\Models;
use App\AdminModel;
use App\Register;
use App\Home;
use App\Footer;
use App\Settings;
use App\Member;
use App\Country;
use App\State;
use App\City;
use App\Blog;
use App\Dashboard;
use App\Admodel;
use App\Merchantadminlogin;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
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
    |   Here, the admin has "userid" as session.
    |
    */

    //show site admin login page
    public function siteadmin()
    {
        if (Session::has('userid')) {
            return Redirect::to('siteadmin_dashboard')->with('login_success', 'Login Success');
        } else {
            return view('siteadmin.admin_login');
        }
    }

    //site admin login check
    public function login_check()
    {
        $uname = Input::get('admin_name');
        $password = Input::get('admin_pass');
        $check = Merchantadminlogin::login_check($uname, $password);
        if ($check > 0) {
            return Redirect::to('siteadmin_dashboard')->with('login_success', 'Login Success');
        } else {
            return Redirect::to('siteadmin')->with('login_error', 'Invalid Username and Password');
        }
    }

    //site admin forgot password mail send
    public function forgot_check()
    {
        $email = Input::get('admin_email');
        $check = Merchantadminlogin::forgot_check($email);
        if ($check > 0) {
            $forgot_check = Merchantadminlogin::forgot_check_details($email);
            $email = $forgot_check[0]->adm_email;
            $send_mail_data = array('name' => $forgot_check[0]->adm_fname, 'password' => $forgot_check[0]->adm_password);
            if ($_SERVER['HTTP_HOST'] != 'localhost') {
                Mail::send('emails.admin_password_recovery_email', $send_mail_data, function ($message) use ($email) {
                    $message->to($email)->subject('Password Recovery Details');
                });
            }
            return Redirect::to('siteadmin')->with('forgot_success', 'Mail Send Successfully');
        } else {
            return Redirect::to('siteadmin')->with('forgot_error', 'Invalid Email');
        }
    }

    // site admin logout
    public function admin_logout()
    {
        Session::forget('userid');
        Session::forget('username');
        Session::flush();
        return Redirect::to('siteadmin')->with('login_success', 'Logout Success');
    }

    // show site admin dashboard page
    public function siteadmin_dashboard()
    {
        if (Session::has('userid')) {

            //all data
            $all_resources_cnt = Dashboard::get_all_resource_cnt();
            $all_members_cnt = Dashboard::get_all_members_cnt();
            $all_merchants_cnt = Dashboard::get_all_merchants_cnt();
            $all_stores_cnt = Dashboard::get_all_stores_cnt();
            $all_news_subscribers_cnt = Dashboard::get_all_newsletter_subscribers_cnt();
            $all_subscribers_cnt = Dashboard::get_all_subscribers_cnt();
            $all_curators_cnt = Dashboard::get_all_curators_cnt();

            //acitve data
            $active_resources_cnt = Dashboard::get_active_resources_cnt();
            $active_members_cnt = Dashboard::get_active_members_cnt();
            $active_merchants_cnt = Dashboard::get_active_merchants_cnt();
            $active_stores_cnt = Dashboard::get_active_stores_cnt();
            $active_news_subscribers_cnt = Dashboard::get_active_newsletter_subscribers_cnt();
            $active_subscribers_cnt = Dashboard::get_active_subscribers_cnt();
            $active_curators_cnt = Dashboard::get_active_curators_cnt();

            $approved_resources_cnt = Dashboard::get_approved_resources_cnt();
            $disapproved_resources_cnt = Dashboard::get_disapproved_resources_cnt();
            $pending_resources_cnt = Dashboard::get_pending_resources_cnt();

            $transaction_chart_data = Dashboard::get_this_year_transaction_charts();

            $blogcmtcount = Blog::get_msgcount();
            $adrequestcnt = Admodel::get_msgcount();

            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "dashboard")
                ->with("blogcmtcount", "blogcmtcount")
                ->with("newsubscriberscount", "newsubscriberscount")
                ->with("adrequestcnt", "adrequestcnt");

            $adminfooter = view('siteadmin.includes.admin_footer');

            return view('siteadmin.admin_dashboard')->with('adminheader', $adminheader)
                ->with('adminfooter', $adminfooter)
                ->with('all_resources_cnt', $all_resources_cnt)->with('active_resources_cnt', $active_resources_cnt)
                ->with('approved_resources_cnt', $approved_resources_cnt)->with('disapproved_resources_cnt', $disapproved_resources_cnt)
                ->with('pending_resources_cnt', $pending_resources_cnt)
                ->with('all_merchants_cnt', $all_merchants_cnt)->with('active_merchants_cnt', $active_merchants_cnt)
                ->with('all_members_cnt', $all_members_cnt)->with('active_members_cnt', $active_members_cnt)
                ->with('all_subscribers_cnt', $all_subscribers_cnt)->with('active_subscribers_cnt', $active_subscribers_cnt)
                ->with('all_news_subscribers_cnt', $all_news_subscribers_cnt)->with('active_news_subscribers_cnt', $active_news_subscribers_cnt)
                ->with('all_stores_cnt', $all_stores_cnt)->with('active_stores_cnt', $active_stores_cnt)
                ->with('all_curators_cnt', $all_curators_cnt)->with('active_curators_cnt', $active_curators_cnt)
                ->with('transaction_chart_data', $transaction_chart_data);
        } else {
            return Redirect::to('siteadmin');
        }

    }


    public function admin_settings()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "settings");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $admin_setting_details = AdminModel::get_admin_details();
            $country_return = Country::get_country_list();
            return view('siteadmin.admin_settings')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)
                ->with('adminfooter', $adminfooter)->with('admin_setting_details', $admin_setting_details)
                ->with('country_result', $country_return);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function admin_profile()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "null");
            $adminleftmenus = view('siteadmin.includes.admin_left_menus');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $admin_setting_details = AdminModel::get_admin_details();
            return view('siteadmin.admin_profile')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)
                ->with('adminfooter', $adminfooter)->with('admin_setting_details', $admin_setting_details);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function admin_settings_submit()
    {
        $data = Input::except(array('_token'));
        $rule = array(
            'first_name' => 'required|alpha_dash',
            'last_name' => 'required|alpha_dash',
            'old_password' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address_one' => 'required',
            'address_two' => 'required',
            'select_admin_country' => 'required',
            'select_admin_state' => 'required',
            'select_admin_city' => 'required',
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::to('admin_settings')->withErrors($validator->messages())->withInput();
        } else {
            if (Input::get('new_password') == "") {
                $password = Input::get('old_password');
            } else {
                $password = Input::get('new_password');
            }

            //find the city_id from city_name and co+id, state_id
            $co_id = Input::get('select_admin_country');
            $st_id = Input::get('select_admin_state');
            $city_name = Input::get('select_admin_city');

            $ci = City::check_exist_city_name2($city_name, $co_id, $st_id);

            if (count($ci) > 0)
                $ci_id = $ci[0]->ci_id;
            else
                return Redirect::to('admin_settings')->withErrors("City Doesn't Exists")->withInput();

            $entry = array(
                'adm_fname' => Input::get('first_name'),
                'adm_lname' => Input::get('last_name'),
                'adm_password' => $password,
                'adm_email' => Input::get('email'),
                'adm_phone' => Input::get('phone'),
                'adm_address1' => Input::get('address_one'),
                'adm_address2' => Input::get('address_two'),
                'adm_co_id' => Input::get('select_admin_country'),
                'adm_st_id' => Input::get('select_admin_state'),
                'adm_ci_id' => $ci_id
            );
            $country_return = AdminModel::update_admin_details($entry);
            return Redirect::to('admin_settings')->with('success', 'Record Updated Successfully');
        }
    }

    /*
     * NOT TESTED
     *
     * */

    public function chart()
    {
        $result = AdminModel::get_chart_details();
        return view('siteadmin.chart_view');
    }


    //show curator dashboard from admin dashbaord
    public function curator_dashboard()
    {

        $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "curator");
        $adminleftmenus = view('siteadmin.includes.admin_left_menu_curator');
        $adminfooter = view('siteadmin.includes.admin_footer');

        $all_curator_cnt = Dashboard::get_all_curators_cnt();
        $active_curator_cnt = Dashboard::get_active_curators_cnt();

        $curator_resource_check_history_data = Dashboard::get_curator_resource_check_history_year_data();

        return view('siteadmin.curator_dashboard')->with('adminheader', $adminheader)
            ->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
            ->with('all_curator_cnt', $all_curator_cnt)->with('active_curator_cnt', $active_curator_cnt)
            ->with('curator_resource_check_history_data', $curator_resource_check_history_data);
    }

    //show merchant dashboard
    public function merchant_dashboard()
    {
        if (Session::has('userid')) {

            $all_merchants_cnt = Dashboard::get_all_merchants_cnt();
            $active_merchants_cnt = Dashboard::get_active_merchants_cnt();
            $all_stores_cnt = Dashboard::get_all_stores_cnt();
            $active_stores_cnt = Dashboard::get_active_stores_cnt();

            $register_contributor_history_chart_data = Dashboard::get_contributor_register_history_year();

            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "merchant");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_merchant');
            $adminfooter = view('siteadmin.includes.admin_footer');

            return view('siteadmin.merchant_dashboard')->with('adminheader', $adminheader)
                ->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('all_merchants_cnt', $all_merchants_cnt)->with('active_merchants_cnt', $active_merchants_cnt)
                ->with('all_stores_cnt', $all_stores_cnt)->with('active_stores_cnt', $active_stores_cnt)
                ->with('contributor_register_chart_data', $register_contributor_history_chart_data);

        } else {

            return Redirect::to('siteadmin');
        }

    }

    //show member dashboard
    public function member_dashboard()
    {
        if (Session::has('userid')) {

            $all_members_count = Dashboard::get_all_members_cnt();
            $active_members_count = Dashboard::get_active_members_cnt();
            $confirmed_members_count = Dashboard::get_confirmed_members_cnt();

            $all_newssubscribers_count = Dashboard::get_all_newsletter_subscribers_cnt();
            $active_newssubscribers_count = Dashboard::get_active_newsletter_subscribers_cnt();
            $member_newssubscribers_count = Dashboard::get_member_newsletter_subscribers_cnt();

            $member_register_history_chart_data = Dashboard::get_member_register_history_year();

            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "customer");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_member');
            $adminfooter = view('siteadmin.includes.admin_footer');

            return view('siteadmin.member_dashboard')->with('adminheader', $adminheader)
                ->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('all_members_cnt', $all_members_count)->with('active_members_cnt', $active_members_count)
                ->with('confirmed_member_cnt', $confirmed_members_count)
                ->with('all_newsub_cnt', $all_newssubscribers_count)->with('active_newsub_cnt', $active_newssubscribers_count)
                ->with('member_newsub_cnt', $member_newssubscribers_count)
                ->with('member_register_history_year_chart_data', $member_register_history_chart_data);

        } else {
            return Redirect::to('siteadmin');
        }
    }

    /*Show transaction dashboard*/
    public function show_transaction_dashboard()
    {
        if (Session::has('userid')) {

            //all orders
            $all_orders = Dashboard::get_all_orders();
            $all_orders_cnt = count($all_orders);

            //completed orders
            $completed_orders = Dashboard::get_completed_orders();
            $completed_orders_cnt = count($completed_orders);

            //shipped_orders
            $shipping_orders_cnt = count(Dashboard::get_ship_orders());

            //email_orders
            $email_orders_cnt = count(Dashboard::get_email_orders());

            //today
            $orders_today = Dashboard::get_today_orders();
            $orders_today_count = count($orders_today);
            $orders_today_amount = 0;
            foreach ($orders_today as $order_today) {
                $orders_today_amount += $order_today->order_amount;
            }


            //week
            $orders_week = Dashboard::get_week_orders();
            $orders_week_count = count($orders_week);
            $orders_week_amount = 0;
            foreach ($orders_week as $order_week) {

                $orders_week_amount += $order_week->order_amount;
            }

            //month
            $orders_month = Dashboard::get_month_orders();
            $orders_month_count = count($orders_month);
            $orders_month_amount = 0;
            foreach ($orders_month as $order_month) {
                $orders_month_amount += $order_month->order_amount;
            }


            //month
            $orders_year = Dashboard::get_year_orders();
            $orders_year_count = count($orders_year);
            $orders_year_amount = 0;
            foreach ($orders_year as $order_year) {
                $orders_year_amount += $order_year->order_amount;
            }

            $this_year_charts = Dashboard::get_this_year_transaction_charts();
            //$this_year_charts = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "transaction");
            $adminfooter = view('siteadmin.includes.admin_footer');
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_transaction');


            return view('siteadmin.transaction_dashboard')->with('adminheader', $adminheader)
                ->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('all_orders', $all_orders)->with('all_orders_cnt', $all_orders_cnt)
                ->with('completed_orders', $completed_orders)->with('completed_orders_cnt', $completed_orders_cnt)
                ->with('orders_today_count', $orders_today_count)->with('orders_today_amount', $orders_today_amount)
                ->with('orders_week_count', $orders_week_count)->with('orders_week_amount', $orders_week_amount)
                ->with('orders_month_count', $orders_month_count)->with('orders_month_amount', $orders_month_amount)
                ->with('orders_year_count', $orders_year_count)->with('orders_year_amount', $orders_year_amount)
                ->with('shipping_orders_count', $shipping_orders_cnt)
                ->with('email_orders_count', $email_orders_cnt)
                ->with('this_year_charts', $this_year_charts);
        } else {
            return Redirect::to('siteadmin');
        }

    }


    //show resource dashboard
    public function resource_dashboard()
    {

        if (Session::has('userid')) {

            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "products");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_product');
            $adminfooter = view('siteadmin.includes.admin_footer');

            $all_resources_cnt = Dashboard::get_all_resource_cnt();
            $active_resources_cnt = Dashboard::get_active_resources_cnt();

            $approved_resources_cnt = Dashboard::get_approved_resources_cnt();
            $disapproved_resources_cnt = Dashboard::get_disapproved_resources_cnt();
            $pending_resources_cnt = Dashboard::get_pending_resources_cnt();

            $ship_all_cnt = Dashboard::get_ship_all_cnt();
            $ship_done_cnt = Dashboard::get_ship_done_cnt();

            $resource_register_chart_data = Dashboard::get_resource_register_history_this_year_charts();
            $resource_sold_chart_data = Dashboard::get_resource_sold_history_this_year_charts();

            return view('siteadmin.resource_dashboard')->with('adminheader', $adminheader)
                ->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('all_resources_cnt', $all_resources_cnt)->with('active_resources_cnt', $active_resources_cnt)
                ->with('approved_resources_cnt', $approved_resources_cnt)->with('disapproved_resources_cnt', $disapproved_resources_cnt)
                ->with('pending_resources_cnt', $pending_resources_cnt)
                ->with('ship_all_cnt', $ship_all_cnt)->with('ship_done_cnt', $ship_done_cnt)
                ->with('resource_register_chart_data', $resource_register_chart_data)
                ->with('resource_sold_chart_data', $resource_sold_chart_data);

        } else {

            return Redirect::to('siteadmin');

        }


    }


}
