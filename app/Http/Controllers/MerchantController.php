<?php
namespace App\Http\Controllers;

use App\Country;
use App\State;
use App\City;
use App\Theme;
use App\Category;
use App\Member;
use App\Register;
use App\Home;
use App\Footer;
use App\Settings;
use App\Blog;
use App\Dashboard;
use App\Admodel;
use App\Transactions;
use App\Products;

use App\Fund;
use App\Merchant;
use App\MerchantTransactions;
use App\Merchantadminlogin;

use App\Withdraw;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use DB;
use File;
use Session;
use DateTime;


class MerchantController extends Controller
{

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */

    /*Merchant Login*/
    public function merchant_login()
    {
        if (Session::has('merchantid')) {
            Return Redirect::to('sitemerchant_dashboard')->with('success', 'Login Success');
        } else {
            return view('sitemerchant.merchant_login');
        }
    }

    public function merchant_login_check()
    {
        $username = Input::get('mer_user');
        $pwd = Input::get('mer_pwd');

        $encpwd = md5($pwd);

        $logincheck = Merchantadminlogin::checkmerchantlogin($username, $encpwd);

        if ($logincheck == 1) {
            return Redirect::to('sitemerchant_dashboard')->with('success', 'Login Success');
        } else if ($logincheck == 0) {

            return Redirect::to('sitemerchant')->with('error', 'Invalid Username and Password');
        }

    }

    public function merchant_logout()
    {
        Session::forget('merchantid');
        Session::forget('merchantname');
        Session::flush();
        return Redirect::to('sitemerchant')->with('login_success', 'Logout Success');
    }

    public function merchant_forgot_check()
    {
        $inputs = Input::all();
        $merchant_email = Input::get('merchant_email');

        $encode_email = base64_encode(base64_encode(base64_encode(($merchant_email))));

        $check_valid_email = Merchantadminlogin::checkvalidemail($merchant_email);

        if ($check_valid_email) {
            $forgot_check = Merchantadminlogin::forgot_check_details_merchant($merchant_email);

            $name = 'merchant';

            $send_mail_data = array(
                'name' => $forgot_check[0]->mem_fname,
                'encodeemail' => $encode_email
            );
            if ($_SERVER['HTTP_HOST'] != 'localhost') {
                # It will show these lines as error but no issue it will work fine Line no 119 - 122
                Mail::send('emails.merchant_passwordrecoverymail', $send_mail_data, function ($message) {
                    $message->to(Input::get('merchant_email'), 'Merchant')->subject('Password Recovery Details');
                });
            }
            return Redirect::to('sitemerchant')->with('login_success', 'Mail Send Successfully');
        } else {
            return Redirect::to('sitemerchant')->with('forgot_error', 'Invalid Email');

        }

    }

    public function forgot_pwd_email($email)
    {
        $merchat_decode_email = base64_decode(base64_decode(base64_decode($email)));

        $merchantdetails = Merchantadminlogin::get_merchant_details($merchat_decode_email);

        return view('sitemerchant.forgot_pwd_mail')->with('merchantdetails', $merchantdetails);

    }

    public function forgot_pwd_email_submit()
    {
        $inputs = Input::all();
        $merchant_id = Input::get('merchant_id');
        $pwd = Input::get('pwd');
        $confirmpwd = Input::get('confirmpwd');

        Merchantadminlogin::update_newpwd($merchant_id, $confirmpwd);

        return Redirect::to('sitemerchant')->with('login_success', 'Password Changed Successfully');

    }


    /*Merchant Dashboard*/
    public function sitemerchant_dashboard()
    {
        if (Session::has('merchantid')) {

            $date = date('Y-m-d H:i:s');
            $mer_id = Session::get('merchantid');

            //resource
            $mer_all_resource_count = Merchant::get_mer_all_resources_count($mer_id);
            $mer_active_resource_count = Merchant::get_mer_active_resources_count($mer_id);
            $mer_approved_resource_count = Merchant::get_mer_approved_resources_count($mer_id);
            $mer_disapproved_resource_count = Merchant::get_mer_disapproved_resources_count($mer_id);
            $mer_pending_resource_count = Merchant::get_mer_pending_resource_count($mer_id);
            $mer_sold_resource_count = Merchant::get_mer_sold_resources_count($mer_id);

            //shops
            $mer_all_shop_count = Merchant::get_mer_all_shop_count($mer_id);
            $mer_active_shop_count = Merchant::get_mer_active_shop_count($mer_id);

            //Transactions
            $mer_transaction_chart_data = Merchant::get_mer_year_transaction_chart_data($mer_id);
            $mer_all_transaction_count = Merchant::get_mer_transaction_count($mer_id);

            $merchantheader = view('sitemerchant.includes.merchant_header')->with("routemenu", "dashboard");
            $merchantfooter = view('sitemerchant.includes.merchant_footer');

            return view('sitemerchant.merchant_dashboard')->with('merchantheader', $merchantheader)
                ->with('merchantfooter', $merchantfooter)
                ->with('mer_all_resource_count', $mer_all_resource_count)
                ->with('mer_active_resource_count', $mer_active_resource_count)
                ->with('mer_approved_resource_count', $mer_approved_resource_count)
                ->with('mer_disapproved_resource_count', $mer_disapproved_resource_count)
                ->with('mer_pending_resource_count', $mer_pending_resource_count)
                ->with('mer_sold_resource_count', $mer_sold_resource_count)
                ->with('mer_sold_resource_count', $mer_sold_resource_count)
                ->with('mer_all_shop_count', $mer_all_shop_count)
                ->with('mer_active_shop_count', $mer_active_shop_count)
                ->with('mer_all_transaction_count', $mer_all_transaction_count)
                ->with('mer_transaction_chart_data', $mer_transaction_chart_data);

        } else {
            return Redirect::to('sitemerchant');
        }
    }

    /*Merchant Profile and Settings*/
    //show merchant settings
    public function show_merchant_profile()
    {
        if (Session::has('merchantid')) {

            $merchant_id = Session::get('merchantid');
            $merchantheader = view('sitemerchant.includes.merchant_header')->with('routemenu', "settings");
            $merchantleftmenus = view('sitemerchant.includes.merchant_left_menu_settings')->with('');
            $merchantfooter = view('sitemerchant.includes.merchant_footer');

            $merchant_return = Merchant::get_member($merchant_id);

            return view('sitemerchant.merchant_profile')->with('merchantheader', $merchantheader)
                ->with('merchantleftmenus', $merchantleftmenus)->with('merchantfooter', $merchantfooter)
                ->with('merchant_details', $merchant_return);
        } else {
            return Redirect::to('sitemerchant');
        }
    }

    //edit merchant info
    public function edit_contributor_profile()
    {
        if (Session::has('merchantid')) {

            $merchant_id = Session::get('merchantid');
            $merchantheader = view('sitemerchant.includes.merchant_header')->with('routemenu', "settings");
            $merchantleftmenus = view('sitemerchant.includes.merchant_left_menu_settings');
            $merchantfooter = view('sitemerchant.includes.merchant_footer');

            $country_return = Country::get_country_list();
            $merchant_return = Merchant::get_member($merchant_id);

            return view('sitemerchant.edit_contributor_account')->with('merchantheader', $merchantheader)->with('merchantleftmenus', $merchantleftmenus)->with('merchantfooter', $merchantfooter)
                ->with('country_details', $country_return)->with('merchant_details', $merchant_return);

        } else {
            return Redirect::to('sitemerchant');
        }

    }

    public function edit_contributor_submit_in_merchant()
    {
        if (Session::has('merchantid')) {

            $mem_id = Input::get('mem_id');
            $data = Input::except(array(
                '_token'
            ));
            $rule = array(
                'first_name' => 'required|alpha_dash',
                'last_name' => 'required|alpha_dash',
                'email_id' => 'required|email',
                'userid' => 'required',
                'phone_no' => 'required',
                'select_mer_country' => 'required',
                'select_mer_state' => 'required',
                'select_mer_city' => 'required',
                'address_one' => 'required'
            );

            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('edit_contributor_profile')->withErrors($validator->messages())->withInput();
            } else {
                $mem_email = Input::get('email_id');
                $check_merchant_id = Member::check_emailaddress_edit($mem_email, $mem_id);

                $userid = Input::get('userid');
                $checkmemberid = Member::check_memberid_edit($userid, $mem_id);

                if ($check_merchant_id) {
                    return Redirect::to('edit_contributor_profile')->withErrors('Merchant Email Exist')->withInput();
                } else if ($checkmemberid) {

                    return Redirect::to('edit_contributor_profile')->withMessage("Merchant UserId Exists")->withInput();

                } else {

                    $mem_country = Input::get('select_mer_country');
                    $mem_state = Input::get('select_mer_state');
                    $mer_city_name = Input::get('select_mer_city');

                    $ci = City::check_exist_city_name2($mer_city_name, $mem_country, $mem_state);

                    $count = count($ci);

                    if ($count > 0)
                        $mem_city = $ci[0]->ci_id;
                    else {
                        return Redirect::to('edit_contributor_profile')->withErrors("City for Merchant Doesn't Exists")->withInput();
                    }

                    $merchant_entry = array(
                        'mem_fname' => Input::get('first_name'),
                        'mem_lname' => Input::get('last_name'),
                        'mem_email' => Input::get('email_id'),
                        'mem_userid' => $userid,
                        'mem_phone' => Input::get('phone_no'),
                        'mem_country' => $mem_country,
                        'mem_state' => $mem_state,
                        'mem_city' => $mem_city,
                        'mem_address1' => Input::get('address_one'),
                        'mem_address2' => Input::get('address_two'),
                        'mem_zipcode' => Input::get('mem_zipcode'),
                        'mem_payment' => Input::get('payment_account'),
                    );
                    $edited_merchant_id = Member::update_member($mem_id, $merchant_entry);
                    return Redirect::to('merchant_profile')->with('result', 'Record Updated Successfully');
                }
            }
        } else {
            return Redirect::to('siteadmin');
        }

    }

    //change merchant password
    public function change_merchant_password()
    {
        if (Session::has('merchantid')) {
            $merchantheader = view('sitemerchant.includes.merchant_header')->with('routemenu', "settings");
            $merchantleftmenus = view('sitemerchant.includes.merchant_left_menu_settings');
            $merchantfooter = view('sitemerchant.includes.merchant_footer');

            $mer_id = Session::get('merchantid');

            return view('sitemerchant.merchant_change_password')->with('merchantheader', $merchantheader)->with('merchantleftmenus', $merchantleftmenus)->with('merchantfooter', $merchantfooter)->with('mem_id', $mer_id);

        } else {
            return Redirect::to('sitemerchant');
        }

    }

    public function change_password_submit()
    {
        $merchant_id = Input::get('merchant_id');
        $oldpwd = Input::get('oldpwd');
        $pwd = Input::get('pwd');

        $check_pwd = md5($oldpwd);

        $oldpwdcheck = Merchant::check_oldpwd($merchant_id, $check_pwd);

        $pwd = md5($pwd);

        if ($oldpwdcheck) {
            Merchant::update_newpwd($merchant_id, $pwd);
            return Redirect::to('change_merchant_password')->with('success', 'Password Changed Successfully');
        } else {
            return Redirect::to('change_merchant_password')->withErrors('Old Password does not match');
        }
    }

    public function show_merchant_settings()
    {
        if (Session::has('merchantid')) {

            $merchant_id = Session::get('merchantid');
            $merchantheader = view('sitemerchant.includes.merchant_header')->with('routemenu', "settings");
            $merchantleftmenus = view('sitemerchant.includes.merchant_left_menu_settings');
            $merchantfooter = view('sitemerchant.includes.merchant_footer');

            $merchant = Merchant::find($merchant_id);

            $minimum = $merchant->mer_minimum_amt;
            $mer_paypal_email = $merchant->mer_pay_email;

            return view('sitemerchant.merchant_settings')->with('merchantheader', $merchantheader)
                ->with('merchantleftmenus', $merchantleftmenus)->with('merchantfooter', $merchantfooter)
                ->with('minimum', $minimum)->with('mer_paypal_email', $mer_paypal_email);

        } else {
            return Redirect::to('sitemerchant');
        }
    }

    public function update_merchant_settings()
    {
        if (Session::has('merchantid')) {

            $data = Input::except(array(
                '_token'
            ));
            $rule = array(
                'Paypal_Email' => 'required',
                'Minimum_Amount' => 'required',
            );

            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('merchant_settings')->withErrors($validator->messages())->withInput();
            } else {
                $merchant_id = Session::get('merchantid');
                $merchant = Merchant::find($merchant_id);

                $paypal_email = Input::get('Paypal_Email');
                $minimum_amt = Input::get('Minimum_Amount');

                $merchant->mer_pay_email = $paypal_email;
                $merchant->mer_minimum_amt = $minimum_amt;

                $merchant->save();

                return Redirect::to('merchant_settings')->with('success', "Your Payment Settings Updated Successfully");
            }
        } else {
            return Redirect::to('sitemerchant');
        }
    }


    /*Merchant Store*/
    public function manage_shop()
    {
        if (Session::has('merchantid')) {
            $merchantid = Session::get('merchantid');

            $merchantheader = view('sitemerchant.includes.merchant_header')->with('routemenu', "shop");
            $merchantleftmenus = view('sitemerchant.includes.merchant_left_menu_Shop');
            $merchantfooter = view('sitemerchant.includes.merchant_footer');

            $store_return = Member::get_store_from_merchant($merchantid);
            $store_is_or_not_in_product = Member::store_is_or_not_in_product($store_return);
            return view('sitemerchant.manage_shop')->with('merchantheader', $merchantheader)
                ->with('merchantleftmenus', $merchantleftmenus)->with('merchantfooter', $merchantfooter)
                ->with('store_return', $store_return)
                ->with('store_is_or_not_in_product', $store_is_or_not_in_product);

        } else {
            return Redirect::to('sitemerchant');
        }
    }

    public function add_shop()
    {
        if (Session::has('merchantid')) {

            $merchantid = Session::get('merchantid');

            $merchantheader = view('sitemerchant.includes.merchant_header')->with('routemenu', "shop");
            $merchantleftmenus = view('sitemerchant.includes.merchant_left_menu_Shop');
            $merchantfooter = view('sitemerchant.includes.merchant_footer');

            $country_return = Country::get_country_list();
            $merchant_name = Member::find($merchantid)->name;

            return view('sitemerchant.add_shop')->with('merchantheader', $merchantheader)
                ->with('merchantleftmenus', $merchantleftmenus)->with('merchantfooter', $merchantfooter)
                ->with('country_details', $country_return)->with('merchantid', $merchantid)
                ->with('merchant_name', $merchant_name);

        } else {
            return Redirect::to('sitemerchant');

        }
    }

    public function add_shop_submit()
    {
        if (Session::has('merchantid')) {
            $merchant_id = Input::get('store_merchant_id');
            $data = Input::except(array(
                '_token'
            ));
            $rule = array(
                'store_name' => 'required',
                'select_country' => 'required',
                'select_state' => 'required',
                'select_city' => 'required',
                'store_add_one' => 'required',
                'zip_code' => 'required|numeric',
                'store_phone' => 'required',
                'file' => 'image'
            );

            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('merchant_add_shop')->withErrors($validator->messages())->withInput();
            } else {

                $lat = Input::get('latitude');
                $long = Input::get('longitude');

                $store_show_map = Input::get('show_map');

                if ($store_show_map == 1 && (!$lat || !$long)) {
                    return Redirect::to('merchant_add_shop')->withErrors("Please choose the address on the map if you want to display your store.")->withInput();
                }

                $mem_email = Input::get('email_id');

                $file = Input::file('file');
                $destinationPath = './public/assets/images/storeimage/';

                $filename = ImageEditController::save_image_edited($file, Input::get('x'), Input::get('y'), Input::get('w'), Input::get('h'), $destinationPath);

                $store_city_name = Input::get('select_city');

                $store_co_id = Input::get('select_country');
                $store_st_id = Input::get('select_state');
                $sci = City::check_exist_city_name2($store_city_name, $store_co_id, $store_st_id);

                $sci_count = count($sci);
                if ($sci_count > 0)
                    $store_ci_id = $sci[0]->ci_id;
                else
                    return Redirect::to('merchant_add_shop')->withErrors("City for Store Doesn't Exists")->withInput();

                $store_entry = array(
                    'stor_merchant_id' => $merchant_id,
                    'stor_name' => Input::get('store_name'),
                    'stor_org' => Input::get('store_org'),
                    'stor_title' => Input::get('store_title'),
                    'stor_website' => Input::get('store_web'),
                    'stor_country' => Input::get('select_country'),
                    'stor_state' => Input::get('select_state'),
                    'stor_city' => $store_ci_id,
                    'stor_address1' => Input::get('store_add_one'),
                    'stor_address2' => Input::get('store_add_two'),
                    'stor_zipcode' => Input::get('zip_code'),
                    'stor_show_map' => $store_show_map,
                    'stor_phone' => Input::get('store_phone'),
                    'stor_metakeywords' => Input::get('meta_keyword'),
                    'stor_orgdesc' => Input::get('store_orgdesc'),
                    'stor_latitude' => $lat,
                    'stor_longitude' => $long,
                    'stor_commission' => Input::get('store_commission'),
                    'stor_img' => $filename
                );

                Member::insert_store($store_entry);
                return Redirect::to('merchant_manage_shop')->with('success', 'Shop Added Successfully');
            }
        } else {
            return Redirect::to('sitemerchant');
        }
    }

    public function edit_shop($id, $mer_id)
    {

        if (Session::has('merchantid')) {
            $merchantid = Session::get('merchantid');

            if ($merchantid != $mer_id) {
                return Redirect::to('merchant_manage_shop')->withErrors("You can't edit the other's shop.")->withInput();
            }

            $merchantheader = view('sitemerchant.includes.merchant_header')->with('routemenu', "shop");
            $merchantleftmenus = view('sitemerchant.includes.merchant_left_menu_Shop');
            $merchantfooter = view('sitemerchant.includes.merchant_footer');

            $country_return = Country::get_country_list();
            $store_return = Member::get_store_from_id_and_merchant($id, $mer_id);
            $merchant_name = Member::find($mer_id)->name;

            if ($store_return) {
                return view('sitemerchant.edit_shop')->with('merchantheader', $merchantheader)
                    ->with('merchantleftmenus', $merchantleftmenus)->with('merchantfooter', $merchantfooter)
                    ->with('country_details', $country_return)->with('store_return', $store_return)
                    ->with('merchant_id', $mer_id)->with('store_id', $id)->with('merchant_name', $merchant_name);
            } else {
                return Redirect::to('sitemerchant');
            }

        } else {
            return Redirect::to('sitemerchant');
        }
    }

    public function edit_shop_submit()
    {
        if (Session::has('merchantid')) {
            $merchant_id = Input::get('mem_id');
            $store_id = Input::get('store_id');
            $data = Input::except(array(
                '_token'
            ));
            $rule = array(
                'store_name' => 'required',
                'select_country' => 'required',
                'select_state' => 'required',
                'select_city' => 'required',
                'store_add_one' => 'required',
                'zip_code' => 'required|numeric',
                'store_phone' => 'required',
            );

            $lat = Input::get('latitude');
            $long = Input::get('longitude');

            $store_show_map = Input::get('show_map');

            if ($store_show_map == 1 && (!$lat || !$long)) {
                return Redirect::to('merchant_edit_shop/' . $store_id . '/' . $merchant_id)->withErrors("Please choose the address on the map if you want to display your store.")->withInput();
            }

            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('merchant_edit_shop/' . $store_id . '/' . $merchant_id)->withErrors($validator->messages())->withInput();
            } else {

                $file = Input::file('file');
                if ($file == '') {
                    $filename = Input::get('file_new');
                } else {

                    $destinationPath = './public/assets/images/storeimage/';

                    $filename = ImageEditController::save_image_edited($file, Input::get('x'), Input::get('y'), Input::get('w'), Input::get('h'), $destinationPath);

                    $file_new = Input::get('file_new');
                    if ($file_new) {
                        $file_old_name = $destinationPath . $file_new;
                        unlink($file_old_name);
                    }

                }

                $store_city_name = Input::get('select_city');
                $store_co_id = Input::get('select_country');
                $store_st_id = Input::get('select_state');

                $sci = City::check_exist_city_name2($store_city_name, $store_co_id, $store_st_id);

                $sci_count = count($sci);
                if ($sci_count > 0)
                    $store_ci_id = $sci[0]->ci_id;
                else
                    return Redirect::to('merchant_edit_shop/' . $store_id . '/' . $merchant_id)->withErrors("City for Store Doesn't Exists")->withInput();

                $store_entry = array(
                    'stor_name' => Input::get('store_name'),
                    'stor_org' => Input::get('store_org'),
                    'stor_title' => Input::get('store_title'),
                    'stor_website' => Input::get('store_web'),
                    'stor_phone' => Input::get('store_phone'),
                    'stor_show_map' => $store_show_map,
                    'stor_country' => Input::get('select_country'),
                    'stor_state' => Input::get('select_state'),
                    'stor_city' => $store_ci_id,
                    'stor_address1' => Input::get('store_add_one'),
                    'stor_address2' => Input::get('store_add_two'),
                    'stor_zipcode' => Input::get('zip_code'),
                    'stor_metakeywords' => Input::get('meta_keyword'),
                    'stor_orgdesc' => Input::get('store_orgdesc'),
                    'stor_latitude' => $lat,
                    'stor_longitude' => $long,
                    'stor_commission' => Input::get('store_commission'),
                    'stor_img' => $filename
                );

                Member::edit_store($store_id, $store_entry);

                return Redirect::to('merchant_manage_shop')->with('success', 'Shop Updated Successfully');
            }
        } else {
            return Redirect::to('sitemerchant');
        }
    }

    public function block_shop($store_id, $status, $mer_id)
    {
        if (Session::has('merchantid')) {

            $merchant_id = Session::get('merchantid');

            if ($mer_id == $merchant_id) {

                $entry = array(
                    'stor_status' => $status
                );

                Member::block_store_status($store_id, $entry);

                if ($status == 1) {
                    return Redirect::to('merchant_manage_shop')->with('success', 'Shop Activated Successfully');
                } else {
                    return Redirect::to('merchant_manage_shop')->with('success', 'Shop Blocked Successfully');
                }

            } else {
                return Redirect::to('merchant_manage_shop')->withErrors("You can't block other's store");
            }

        } else {
            return Redirect::to('sitemerchant');
        }


    }

    public function delete_shop($id, $mem_id)
    {
        if (Session::has('merchantid')) {

            $merchant_id = Session::get('merchantid');

            if ($mem_id == $merchant_id) {
                Member::delete_store($id, $mem_id);
            } else {
                return Redirect::to('merchant_manage_shop')->withErrors("You can't delete other's store");
            }

            return Redirect::to('merchant_manage_shop')->with('success', 'Shop Deleted Successfully');

        } else {
            return Redirect::to('sitemerchant');
        }
    }


    /*Merchant Transaction*/
    public function show_merchant_transactions()
    {
        if (Session::has('merchantid')) {
            $merid = Session::get('merchantid');

            $all_orders = Merchant::get_all_orders($merid);
            $all_orders_cnt = count($all_orders);

            $completed_orders = Merchant::get_completed_orders($merid);
            $completed_orders_cnt = count($completed_orders);

            $shipping_orders_cnt = count(Merchant::get_ship_orders($merid));


            //today
            $orders_today = Merchant::get_today_orders($merid);
            $orders_today_count = count($orders_today);
            $orders_today_amount = 0;
            foreach ($orders_today as $order_today) {

                $products = $order_today->get_products_by_merchant($merid);
                foreach ($products as $product)
                    $orders_today_amount += $product->product_subtotal;
            }


            //week
            $orders_week = Merchant::get_week_orders($merid);
            $orders_week_count = count($orders_week);
            $orders_week_amount = 0;
            foreach ($orders_week as $order_week) {

                $products = $order_week->get_products_by_merchant($merid);
                foreach ($products as $product)
                    $orders_week_amount += $product->product_subtotal;
            }

            //month
            $orders_month = Merchant::get_month_orders($merid);
            $orders_month_count = count($orders_month);
            $orders_month_amount = 0;
            foreach ($orders_month as $order_month) {

                $products = $order_month->get_products_by_merchant($merid);
                foreach ($products as $product)
                    $orders_month_amount += $product->product_subtotal;
            }

            $mer_transaction_chart_data = Merchant::get_mer_year_transaction_chart_data($merid);

            $adminheader = view('sitemerchant.includes.merchant_header')->with("routemenu", "transaction");
            $adminfooter = view('sitemerchant.includes.merchant_footer');
            $adminleftmenus = view('sitemerchant.includes.merchant_left_menu_transaction');

            return view('sitemerchant.merchant_transactiondashboard')->with('merchantheader', $adminheader)
                ->with('merchantfooter', $adminfooter)->with('merchantleftmenus', $adminleftmenus)
                ->with('all_orders_cnt', $all_orders_cnt)
                ->with('completed_orders_cnt', $completed_orders_cnt)
                ->with('shipping_order_count', $shipping_orders_cnt)
                ->with('orders_today_count', $orders_today_count)->with('orders_today_amount', $orders_today_amount)
                ->with('orders_week_count', $orders_week_count)->with('orders_week_amount', $orders_week_amount)
                ->with('orders_month_count', $orders_month_count)->with('orders_month_amount', $orders_month_amount)
                ->with('mer_transaction_chart_data', $mer_transaction_chart_data);
        } else {
            return Redirect::to('sitemerchant');
        }

    }

    public function resource_all_orders()
    {
        if (Session::get('merchantid')) {

            $merchant_id = Session::get('merchantid');

            $from_date = Input::get('from_date');
            $to_date = Input::get('to_date');

            if ($from_date || $to_date) {
                $orders = Merchant::get_all_orders_by_period($merchant_id, $from_date, $to_date);
            } else {
                $orders = Merchant::get_all_orders($merchant_id);
            }

            $merchantheader = view('sitemerchant.includes.merchant_header')->with("routemenu", "transaction");
            $merchantfooter = view('sitemerchant.includes.merchant_footer');
            $merchantleftmenus = view('sitemerchant.includes.merchant_left_menu_transaction');

            return view('sitemerchant.resource_all_orders')->with('merchantheader', $merchantheader)->with('merchantfooter', $merchantfooter)->with('merchantleftmenus', $merchantleftmenus)
                ->with('orders', $orders)->with('merchant_id', $merchant_id);
        } else {
            return Redirect::to('sitemerchant');
        }

    }

    public function resource_ship_orders()
    {
        if (Session::get('merchantid')) {

            $merchant_id = Session::get('merchantid');

            $from_date = Input::get('from_date');
            $to_date = Input::get('to_date');

            if ($from_date || $to_date) {
                $orders = Merchant::get_ship_orders_by_period($merchant_id, $from_date, $to_date);
            } else {
                $orders = Merchant::get_ship_orders($merchant_id);
            }

            $merchantheader = view('sitemerchant.includes.merchant_header')->with("routemenu", "transaction");
            $merchantfooter = view('sitemerchant.includes.merchant_footer');
            $merchantleftmenus = view('sitemerchant.includes.merchant_left_menu_transaction');

            return view('sitemerchant.resource_ship_orders')->with('merchantheader', $merchantheader)
                ->with('merchantfooter', $merchantfooter)->with('merchantleftmenus', $merchantleftmenus)
                ->with('orders', $orders)->with('merchant_id', $merchant_id);
        } else {
            return Redirect::to('sitemerchant');
        }
    }

    public function resource_completed_orders()
    {
        if (Session::get('merchantid')) {

            $merchant_id = Session::get('merchantid');

            $from_date = Input::get('from_date');
            $to_date = Input::get('to_date');

            if ($from_date || $to_date) {
                $orders = Merchant::get_completed_orders_by_period($merchant_id, $from_date, $to_date);
            } else {
                $orders = Merchant::get_completed_orders($merchant_id);
            }

            $merchantheader = view('sitemerchant.includes.merchant_header')->with("routemenu", "transaction");
            $merchantfooter = view('sitemerchant.includes.merchant_footer');
            $merchantleftmenus = view('sitemerchant.includes.merchant_left_menu_transaction');

            return view('sitemerchant.resource_completed_orders')->with('merchantheader', $merchantheader)
                ->with('merchantfooter', $merchantfooter)->with('merchantleftmenus', $merchantleftmenus)
                ->with('orders', $orders)->with('merchant_id', $merchant_id);
        } else {
            return Redirect::to('sitemerchant');
        }
    }

    /*Merchant Fund Requests*/
    public function withdraw_report()
    {
        if (Session::has('merchantid')) {

            $merchant_id = Session::get('merchantid');
            $merchantheader = view('sitemerchant.includes.merchant_header')->with("routemenu", "funds");
            $merchantfooter = view('sitemerchant.includes.merchant_footer');
            $merchantleftmenus = view('sitemerchant.includes.merchant_left_menu_fund');

            $withdraws = Withdraw::where('merchant_id', $merchant_id)->get();

            return view('sitemerchant.withdraw_report')->with('merchantheader', $merchantheader)
                ->with('merchantfooter', $merchantfooter)->with('merchantleftmenus', $merchantleftmenus)
                ->with('withdraws', $withdraws);
        } else {
            return Redirect::to('sitemerchant');
        }
    }

    public function withdraw_request()
    {

        if (Session::has('merchantid')) {

            $merchant_id = Session::get('merchantid');

            $available = $new_pay = $least = $rest = 0;

            $merchant = Merchant::find($merchant_id);

            $new_pay = $merchant->avail_withdraw_amount;
            $rest = $merchant->mer_rest_amt;
            $available = $new_pay + $rest;
            $least = $merchant->mer_minimum_amt;

            $merchantheader = view('sitemerchant.includes.merchant_header')->with("routemenu", "funds");
            $merchantfooter = view('sitemerchant.includes.merchant_footer');
            $merchantleftmenus = view('sitemerchant.includes.merchant_left_menu_fund');

            return view('sitemerchant.withdraw_request')->with('merchantheader', $merchantheader)
                ->with('merchantfooter', $merchantfooter)->with('merchantleftmenus', $merchantleftmenus)
                ->with('available', $available)->with('least', $least)->with('rest', $rest)
                ->with('merchant_id', $merchant_id);

        } else {
            return Redirect::to('sitemerchant');
        }

    }


}
