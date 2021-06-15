<?php
namespace App\Http\Controllers;

use DB;
use Session;
use App\Http\Models;
use App\Register;
use App\Home;
use App\Footer;
use App\Settings;
use App\Blog;
use App\Dashboard;
use App\Admodel;
use App\Member;
use App\PaymentInfo;
use Date;
use Illuminate\Support\Facades\File;
use App\Country;
use App\State;
use App\City;
use App\Theme;
use App\Category;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */


    public function add_member()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "customer");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_member');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $countryresult = Country::get_country_list();
            return view('siteadmin.add_member')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('countryresult', $countryresult);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_member($id)
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "customer");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_member');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $countryresult = Country::get_country_list();
            $customerresult = Member::get_member($id);
            return view('siteadmin.edit_member')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('countryresult', $countryresult)->with('customerresult', $customerresult);
        } else {
            return Redirect::to('siteadmin');
        }

    }


    public function manage_member()
    {
        if (Session::has('userid')) {

            $from_date = Input::get('from_date');
            $to_date = Input::get('to_date');

            $customerrep = Member::get_memberreports($from_date, $to_date);
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "customer");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_member');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $customerresult = Member::get_member_list();
            $citylist = City::get_city_list();
            return view('siteadmin.manage_member')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('customerresult', $customerresult)->with('customerrep', $customerrep)->with('cityresult', $citylist);
        } else {
            return Redirect::to('siteadmin');
        }

    }

    public function delete_member($id)
    {
        if (Session::has('userid')) {
            $member = Member::find($id);
            $mem_email = $member->mem_email;
            Member::delete_member($id);
            DB::table('nm_shipinfo')->where('ship_email', $mem_email)->delete();
            return Redirect::to('manage_member')->with('message', 'Member Deleted Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function activate_account_from_admin($id)
    {
        if (Session::has('userid')) {

            $member_id = base64_decode($id);
            $member = Member::find($member_id);
            if ($member) {
                $member->mem_confirmed = 1;
                $member->update();
                return Redirect::to('manage_member')->with('message', 'Member is Confirmed Successfully');
            } else {
                return Redirect::to('manage_member')->withErrors('Could not find the Member');
            }
        } else {
            return Redirect::to('manage_member')->with('message', 'Member is Confirmed Successfully');
        }
    }

    public function update_member_status($id, $status)
    {
        if (Session::has('userid')) {
            $return = Member::update_status_of_member($id, $status);
            return Redirect::to('manage_member')->withErrors('User Updated Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function add_member_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array(
                '_token'
            ));

            $rule = array(
                'Customer_FirstName' => 'required',
                'Customer_LastName' => 'required',
                'Customer_Email' => 'required|email',
                'Customer_UserID' => 'required',
                'Customer_Password' => 'required',
            );

            $validator = Validator::make($data, $rule);

            if ($validator->fails()) {
                return Redirect::to('add_member')->withErrors($validator->messages())->withInput();
            } else {
                $customer_email = Input::get('Customer_Email');

                $userid = Input::get('Customer_UserID');

                $checkemailaddr = Member::check_emailaddress($customer_email);
                $checkmemberid = Member::check_memberid($userid);

                if ($checkemailaddr) {
                    return Redirect::to('add_member')->withMessage("Already EmailId Exists")->withInput();
                } else if ($checkmemberid) {
                    return Redirect::to('add_member')->withMessage("Already UserId Exists")->withInput();
                } else {

                    $customer_fname = Input::get('Customer_FirstName');
                    $customer_lname = Input::get('Customer_LastName');

                    $customername = $customer_fname . ' ' . $customer_lname;
                    $pass = md5(Input::get('Customer_Password'));

                    date_default_timezone_set("America/New_York");
                    $date = date('Y-m-d H:i:s');

                    $entry = array(

                        'mem_fname' => $customer_fname,
                        'mem_lname' => $customer_lname,
                        'mem_email' => $customer_email,
                        'mem_password' => $pass,
                        'mem_userid' => $userid,
                        'mem_logintype' => Member::MEMBER_LOGIN_CUSTOMER,
                        'created_at' => $date,
                        'updated_at' => $date,
                    );

                    //Insert Member
                    $return = Member::insert_member($entry);

                    $email_data = array(
                        'username' => $customername,
                        'userid' => $userid,
                        'email' => $customer_email,
                        'action' => 'create',
                    );

                    if ($_SERVER['HTTP_HOST'] != 'localhost') {
                        Mail::send('emails.member_account_create', $email_data, function ($message) use ($customer_email) {
                            $message->to($customer_email)->subject('Living Lectionary Member Account Created Successfully');
                        });
                    }

                    return Redirect::to('manage_member')->with('message', 'User Created Successfully.');
                }
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function convert_member_to_contributor($mem_id)
    {
        if (Session::has('userid')) {
            $return = Member::update_member_to_contributor($mem_id);
            return Redirect::to('manage_member')->with('message', 'User Updated to Contributor Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_member_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array(
                '_token'
            ));
            $customerid = Input::get('customer_edit_id');
            $userid = Input::get('customer_userid');

            $member = Member::find($customerid);

            $rule = array(
                'Customer_FirstName' => 'required',
                'Customer_LastName' => 'required',
                'Customer_Email' => 'required|email',
                'Customer_UserID' => 'required',
            );

            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('edit_member/' . $customerid)->withErrors($validator->messages())->withInput();
            } else {

                $customer_email = Input::get('Customer_Email');
                $checkemailaddr = Member::check_emailaddress_edit($customer_email, $customerid);
                $checkmemberid = Member::check_memberid_edit($userid, $customerid);

                if ($checkemailaddr) {

                    return Redirect::to('edit_member/' . $customerid)->withMessage('Already EmailId Exists')->withInput();

                } else if ($checkmemberid) {

                    return Redirect::to('edit_member/' . $customerid)->withMessage("Already UserId Exists")->withInput();

                } else {

                    date_default_timezone_set("America/New_York");
                    $date = date('Y-m-d H:i:s');

                    //reset password
                    $password = $member->mem_password;

                    $reset_password = Input::get('Customer_Reset_Password');
                    if ($reset_password) {
                        $password = md5($reset_password);
                    }

                    $entry = array(
                        'mem_fname' => Input::get('Customer_FirstName'),
                        'mem_lname' => Input::get('Customer_LastName'),
                        'mem_email' => Input::get('Customer_Email'),
                        'mem_phone' => Input::get('Customer_Phone'),
                        'mem_password' => $password,
                        'updated_at' => $date
                    );


                    $return = Member::update_member($customerid, $entry);

                    $customer_name = Input::get('Customer_FirstName') . ' ' . Input::get('Customer_LastName');

                    $email_data = array(
                        'username' => $customer_name,
                        'userid' => $userid,
                        'email' => $customer_email,
                        'password' => $password,
                        'action' => 'update',
                    );

                    //if password changed, send email to member
                    if ($_SERVER['HTTP_HOST'] != 'localhost') {
                        Mail::send('emails.member_account_create', $email_data, function ($message) use ($customer_email) {
                            $message->to($customer_email)->subject('Living Lectionary Member Account Updated');
                        });
                    }

                    return Redirect::to('manage_member')->with('message', 'User Updated successfully');
                }

            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function manage_news_subscribers()
    {
        if (Session::has('userid')) {
            Session::put('newsubscriberscount', 0);
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "customer");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_member');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $subscriber_list = Member::subscriber_list();
            return view('siteadmin.manage_news_subscribers')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)
                ->with('adminfooter', $adminfooter)->with('subscriber_list', $subscriber_list);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function delete_news_subscriber($id)
    {
        if (Session::has('userid')) {
            $return = Member::delete_news_subscriber($id);
            return Redirect::to('manage_news_subscribers')->with('success', 'Subscriber Deleted Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_news_subscriber_status($id, $status)
    {
        if (Session::has('userid')) {
            Member::edit_news_subscriber_status($id, $status);
            return Redirect::to('manage_news_subscribers')->with('success', 'Subscriber Updated Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }


    /*Merchant*/
    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */


    public function add_contributor()
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "merchant");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_merchant');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $country_return = Country::get_country_list();

            return view('siteadmin.add_contributor')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)
                ->with('adminfooter', $adminfooter)->with('country_details', $country_return);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function manage_contributor()
    {
        if (Session::has('userid')) {
            $data = Input::except(array(
                '_token'
            ));
            $from_date = Input::get('from_date');
            $to_date = Input::get('to_date');

            $merchantrep = Member::get_merchantreports($from_date, $to_date);

            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "merchant");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_merchant');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $merchant_return = Member::get_merchant_list();
            $store_count = Member::get_store_count($merchant_return);
            $merchant_is_or_not_in_product = Member::merchant_is_or_not_in_product($merchant_return);
            return view('siteadmin.manage_contributor')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)
                ->with('adminfooter', $adminfooter)->with('merchant_return', $merchant_return)
                ->with('store_count', $store_count)
                ->with('merchant_is_or_not_in_product', $merchant_is_or_not_in_product)->with('merchantrep', $merchantrep);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function add_contributor_submit()
    {
        if (Session::has('userid')) {
            $data = Input::except(array(
                '_token'
            ));
            $date = date('m/d/Y');
            $rule = array(
                'first_name' => 'required|alpha_dash',
                'last_name' => 'required|alpha_dash',
                'email' => 'required|email',
                'userid' => 'required',
                'phone_no' => 'required',
                'password' => 'required',
                'select_mer_country' => 'required',
                'select_mer_state' => 'required',
                'select_mer_city' => 'required',
                'address_one' => 'required',
                'mem_zipcode' => 'required',
                'store_name' => 'required',
                'select_country' => 'required',
                'select_state' => 'required',
                'select_city' => 'required',
                'store_add_one' => 'required',
                'zip_code' => 'required',
                'store_phone' => 'required',
                'file' => 'required|mimes:jpeg,jpg,png,gif|max:10000'
            );

            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('add_contributor')->withErrors($validator->messages())->withInput();
            } else {
                $mem_email = Input::get('email');
                $check_merchant_id = Member::check_emailaddress($mem_email);

                $userid = Input::get('userid');
                $checkmemberid = Member::check_memberid($userid);

                if ($check_merchant_id) {
                    return Redirect::to('add_contributor')->withErrors('Merchant Email Exist')->withInput();
                } else if ($checkmemberid) {
                    return Redirect::to('add_contributor')->withErrors("Already UserId Exists")->withInput();
                } else {

                    $file = Input::file('file');
                    $destinationPath = './public/assets/images/storeimage/';

                    $filename = ImageEditController::save_image_edited($file, Input::get('x'), Input::get('y'), Input::get('w'), Input::get('h'), $destinationPath);

                    $mem_country = Input::get('select_mer_country');
                    $mem_state = Input::get('select_mer_state');
                    $mer_city_name = Input::get('select_mer_city');

                    $ci = City::check_exist_city_name2($mer_city_name, $mem_country, $mem_state);

                    $count = count($ci);

                    if ($count > 0) {
                        $mem_city = $ci[0]->ci_id;
                    } else {
                        return Redirect::to('add_contributor')->withErrors("City for Merchant Doesn't Exists")->withInput();
                    }

                    $store_co_id = Input::get('select_country');
                    $store_st_id = Input::get('select_state');
                    $store_city_name = Input::get('select_city');

                    $sci = City::check_exist_city_name2($store_city_name, $store_co_id, $store_st_id);

                    $sci_count = count($sci);
                    if ($sci_count > 0)
                        $store_ci_id = $sci[0]->ci_id;
                    else
                        return Redirect::to('add_contributor')->withErrors("City for Store Doesn't Exists")->withInput();


                    $get_new_password = Input::get('password');
                    $get_new_password = md5($get_new_password);

                    date_default_timezone_set("America/New_York");
                    $date = date('Y-m-d H:i:s');

                    $fname = Input::get('first_name');
                    $lname = Input::get('last_name');
                    $username = $fname . ' ' . $lname;
                    //Insert Member as merchant
                    $merchant_entry = array(
                        'mem_fname' => $fname,
                        'mem_lname' => $lname,
                        'mem_email' => $mem_email,
                        'mem_password' => $get_new_password,
                        'mem_userid' => $userid,
                        'mem_phone' => Input::get('phone_no'),
                        'mem_country' => $mem_country,
                        'mem_state' => $mem_state,
                        'mem_city' => $mem_city,
                        'mem_address1' => Input::get('address_one'),
                        'mem_address2' => Input::get('address_two'),
                        'mem_zipcode' => Input::get('mem_zipcode'),
                        'mem_payment' => Input::get('payment_account'),
                        'mem_logintype' => Member::MEMBER_LOGIN_MERCHANT,
                        'created_at' => $date,
                        'updated_at' => $date,
                    );

                    $inserted_merchant_id = Member::insert_member($merchant_entry);

                    $lat = Input::get('latitude');
                    $long = Input::get('longtitude');

                    //store addedby: 1->admin, 2->merchant
                    //Insert Store
                    $store_entry = array(
                        'stor_merchant_id' => $inserted_merchant_id,
                        'stor_name' => Input::get('store_name'),
                        'stor_org' => Input::get('store_org'),
                        'stor_title' => Input::get('store_title'),
                        'stor_website' => Input::get('store_web'),
                        'stor_country' => $store_co_id,
                        'stor_state' => $store_st_id,
                        'stor_city' => $store_ci_id,
                        'stor_address1' => Input::get('store_add_one'),
                        'stor_address2' => Input::get('store_add_two'),
                        'stor_zipcode' => Input::get('zip_code'),
                        'stor_phone' => Input::get('store_phone'),
                        'stor_metakeywords' => Input::get('meta_keyword'),
                        'stor_orgdesc' => Input::get('store_desc'),
                        'stor_latitude' => $lat,
                        'stor_longitude' => $long,
                        'stor_show_map' => Input::get('store_show_map'),
                        'stor_commission' => Input::get('store_commission'),
                        'stor_img' => $filename,
                        'created_at' => $date,
                        'stor_addedby' => 1
                    );

                    Member::insert_store($store_entry);


                    $email_data = array(
                        'email' => $mem_email,
                        'username' => $username,
                        'userid' => $userid,
                        'member_id' => $inserted_merchant_id,
                        'action' => 'create',
                    );

                    //if password changed, send email to member
                    if ($_SERVER['HTTP_HOST'] != 'localhost') {
                        Mail::send('emails.merchant_account_create', $email_data, function ($message) use ($mem_email) {
                            $message->to($mem_email)->subject('Living Lectionary Contributor Account Created Successfully');
                        });
                    }
                    return Redirect::to('manage_contributor')->with('result', 'Member and Store Inserted Successfully');

                }
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_contributor_submit()
    {
        if (Session::has('userid')) {
            $mem_id = Input::get('mem_id');

            $merchant = Member::findOrFail($mem_id);
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
                return Redirect::to('edit_contributor/' . $mem_id)->withErrors($validator->messages())->withInput();
            } else {
                $mem_email = Input::get('email_id');
                $check_merchant_id = Member::check_emailaddress_edit($mem_email, $mem_id);

                $userid = Input::get('userid');
                $checkmemberid = Member::check_memberid_edit($userid, $mem_id);

                if ($check_merchant_id) {
                    return Redirect::to('edit_contributor/' . $mem_id)->withErrors('Merchant Email Exist')->withInput();
                } else if ($checkmemberid) {

                    return Redirect::to('edit_contributor/' . $mem_id)->withMessage("Merchant UserId Exists")->withInput();

                } else {

                    $mem_country = Input::get('select_mer_country');
                    $mem_state = Input::get('select_mer_state');
                    $mer_city_name = Input::get('select_mer_city');

                    $ci = City::check_exist_city_name2($mer_city_name, $mem_country, $mem_state);

                    $count = count($ci);

                    if ($count > 0)
                        $mem_city = $ci[0]->ci_id;
                    else {
                        return Redirect::to('edit_contributor/' . $mem_id)->withErrors("City for Merchant Doesn't Exists")->withInput();
                    }

                    $password = $merchant->mem_password;
                    $reset_password = Input::get('userpwd');
                    if ($reset_password) {
                        $password = md5($reset_password);
                    }
                    $fname = Input::get('first_name');
                    $lname = Input::get('last_name');
                    $username = $fname . ' ' . $lname;

                    $merchant_entry = array(
                        'mem_fname' => $fname,
                        'mem_lname' => $lname,
                        'mem_email' => $mem_email,
                        'mem_userid' => $userid,
                        'mem_password' => $password,
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


                    //send password updated email
                    $encoded_merchant_id = base64_encode($mem_id);
                    $email_data = array(
                        'email' => $mem_email,
                        'username' => $username,
                        'userid' => $userid,
                        'member_id' => $encoded_merchant_id,
                        'action' => 'update',
                    );

                    //if password changed, send email to member
                    if ($_SERVER['HTTP_HOST'] != 'localhost') {
                        Mail::send('emails.merchant_account_create', $email_data, function ($message) use ($mem_email) {
                            $message->to($mem_email)->subject('Living Lectionary Contributor Account Updated Successfully');
                        });
                    }

                    return Redirect::to('manage_contributor')->with('result', 'Contributor Updated Successfully');

                }
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_contributor($id)
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "merchant");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_merchant');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $country_return = Country::get_country_list();
            $merchant_return = Member::get_member($id);
            return view('siteadmin.edit_contributor')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)->with('country_details', $country_return)->with('merchant_details', $merchant_return);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function delete_merchant($id)
    {
        if (Session::has('userid')) {
            $return = Member::delete_merchant($id);
            return Redirect::to('manage_contributor')->with('result', 'Merchant Deleted Successfully');
        } else {
            return Redirect::to('siteadmin');
        }
    }


    public function block_merchant($id, $status)
    {
        if (Session::has('userid')) {

            Member::update_status_of_member($id, $status);

            if ($status == 1) {
                return Redirect::to('manage_contributor')->with('result', 'Merchant Activated Successfully');
            } else {
                return Redirect::to('manage_contributor')->with('result', 'Merchant Blocked Successfully');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function manage_store($id)
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "merchant");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_merchant');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $store_return = Member::get_store_from_merchant($id);
            //print_r($store_return); exit;

            $store_is_or_not_in_product = Member::store_is_or_not_in_product($store_return);
            return view('siteadmin.manage_store')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('store_return', $store_return)
                ->with('store_is_or_not_in_product', $store_is_or_not_in_product);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function add_store($id)
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "merchant");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_merchant');
            $adminfooter = view('siteadmin.includes.admin_footer');
            $country_return = Country::get_country_list();
            $merchant_name = Member::find($id)->name;
            return view('siteadmin.add_store')->with('adminheader', $adminheader)->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('country_details', $country_return)->with('merchant_name', $merchant_name)->with('id', $id);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function add_store_submit()
    {
        if (Session::has('userid')) {
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
                return Redirect::to('add_store/' . $merchant_id)->withErrors($validator->messages())->withInput();
            } else {
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
                    return Redirect::to('add_store/' . $merchant_id)->withErrors("City for Store Doesn't Exists")->withInput();


                $lat = Input::get('latitude');
                $long = Input::get('longtitude');

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
                    'stor_show_map' => Input::get('store_show_map'),
                    'stor_phone' => Input::get('store_phone'),
                    'stor_metakeywords' => Input::get('meta_keyword'),
                    'stor_orgdesc' => Input::get('store_orgdesc'),
                    'stor_latitude' => $lat,
                    'stor_longitude' => $long,
                    'stor_commission' => Input::get('store_commission'),
                    'stor_img' => $filename
                );

                Member::insert_store($store_entry);
                return Redirect::to('manage_store/' . $merchant_id)->with('result', 'Record Inserted Successfully');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_store($id, $mem_id)
    {
        if (Session::has('userid')) {
            $adminheader = view('siteadmin.includes.admin_header')->with("routemenu", "merchant");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_merchant');
            $adminfooter = view('siteadmin.includes.admin_footer');

            $country_return = Country::get_country_list();
            $store_return = Member::get_store_detail($id);
            $merchant_name = Member::find($mem_id)->name;

            return view('siteadmin.edit_store')->with('adminheader', $adminheader)
                ->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('country_details', $country_return)->with('id', $id)->with('store_return', $store_return)
                ->with('mem_id', $mem_id)->with('merchant_name', $merchant_name);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function edit_store_submit()
    {
        if (Session::has('userid')) {
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

            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::to('edit_store/' . $merchant_id . '_' . $store_id)->withErrors($validator->messages())->withInput();
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
                    return Redirect::to('edit_store/' . $merchant_id . '_' . $store_id)->withErrors("City for Store Doesn't Exists")->withInput();

                $store_entry = array(
                    'stor_name' => Input::get('store_name'),
                    'stor_org' => Input::get('store_org'),
                    'stor_title' => Input::get('store_title'),
                    'stor_website' => Input::get('store_web'),
                    'stor_phone' => Input::get('store_phone'),
                    'stor_country' => Input::get('select_country'),
                    'stor_state' => Input::get('select_state'),
                    'stor_city' => $store_ci_id,
                    'stor_address1' => Input::get('store_add_one'),
                    'stor_address2' => Input::get('store_add_two'),
                    'stor_zipcode' => Input::get('zip_code'),
                    'stor_metakeywords' => Input::get('meta_keyword'),
                    'stor_orgdesc' => Input::get('store_orgdesc'),
                    'stor_show_map' => Input::get('store_show_map'),
                    'stor_latitude' => Input::get('latitude'),
                    'stor_longitude' => Input::get('longtitude'),
                    'stor_commission' => Input::get('store_commission'),
                    'stor_img' => $filename
                );

                Member::edit_store($store_id, $store_entry);
                return Redirect::to('manage_store/' . $merchant_id)->with('result', 'Record Updated Successfully');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function delete_store($id, $mem_id)
    {
        if (Session::has('userid')) {

            Member::delete_store($id, $mem_id);
            return Redirect::to('manage_store/' . $mem_id)->with('result', 'Store Deleted Successfully');

        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function block_store($id, $status, $mem_id)
    {
        if (Session::has('userid')) {
            $entry = array(
                'stor_status' => $status
            );
            Member::block_store_status($id, $entry);
            if ($status == 1) {
                return Redirect::to('manage_store/' . $mem_id)->with('result', 'Store Activated Successfully');
            } else {
                return Redirect::to('manage_store/' . $mem_id)->with('result', 'Store Blocked Successfully');
            }
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function register_getcity_shipping()
    {
        $cityid = $_GET['id'];
        $city_ajax = City::show_city_detail($cityid);
        if ($city_ajax) {
            $return = "";

            foreach ($city_ajax as $fetch_city_ajax) {
                $return .= "<option value='" . $fetch_city_ajax->ci_id . "'> " . $fetch_city_ajax->ci_name . " </option>";
            }
            echo $return;
        } else {
            echo $return = "<option value=''> No datas found </option>";
        }

    }

    public function save_image_edited($file, $x, $y, $w, $h, $path)
    {
        $filename_new_get = "";

        $file_more_name = $file->getClientOriginalName();
        $move_more_img = explode('.', $file_more_name);
        $filename_new = $move_more_img[0] . str_random(8) . "." . $move_more_img[1];

        $filename_new_get .= $filename_new;

        if ($file->move($path, $filename_new)) {
            $save_file = $path . $filename_new;
            $extension = File::extension($save_file);

            if ($extension == "png") {
                $quality = 1;
                $img = imagecreatefrompng($save_file);
                $dest = imagecreatetruecolor($w, $h);
                imagecopyresampled($dest, $img, 0, 0, $x,
                    $y, $w, $h,
                    $w, $h);
                imagepng($dest, $save_file, $quality);
            } else if ($extension == "jpg" || $extension == "jpeg") {
                $quality = 90;
                $img = imagecreatefromjpeg($save_file);
                $dest = imagecreatetruecolor($w, $h);
                imagecopyresampled($dest, $img, 0, 0, $x,
                    $y, $w, $h,
                    $w, $h);
                imagejpeg($dest, $save_file, $quality);
            } else if ($extension == "gif") {

                $img = imagecreatefromgif($save_file);
                $dest = imagecreatetruecolor($w, $h);
                imagecopyresampled($dest, $img, 0, 0, $x,
                    $y, $w, $h,
                    $w, $h);
                imagegif($dest, $save_file);
            } else {
                //
            }
        }

        return $filename_new_get;
    }
}
