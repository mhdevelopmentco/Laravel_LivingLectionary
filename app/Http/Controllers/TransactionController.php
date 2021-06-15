<?php
namespace App\Http\Controllers;
use App\Merchant;
use App\Withdraw;
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
use App\Transactions;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\PaymentController;

class TransactionController extends Controller
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

    

    public function resource_all_orders()
    {
        if (Session::get('userid')) {

            $from_date = Input::get('from_date');
            $to_date = Input::get('to_date');

            if ($from_date || $to_date) {
                $orders = Dashboard::get_all_orders_by_period($from_date, $to_date);
            } else {
                $orders = Dashboard::get_all_orders();
            }

            $adminheader    = view('siteadmin.includes.admin_header')->with("routemenu", "transaction");
            $adminfooter    = view('siteadmin.includes.admin_footer');
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_transaction');

            return view('siteadmin.resource_all_orders')->with('adminheader', $adminheader)
                ->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('orders', $orders);
        } else {
            return Redirect::to('sitemerchant');
        }

    }

    public function resource_ship_orders()
    {
        if (Session::get('userid')) {

            $from_date = Input::get('from_date');
            $to_date = Input::get('to_date');

            if ($from_date || $to_date) {
                $orders = Dashboard::get_ship_orders_by_period($from_date, $to_date);
            } else {
                $orders = Dashboard::get_ship_orders();
            }

            $adminheader    = view('siteadmin.includes.admin_header')->with("routemenu", "transaction");
            $adminfooter    = view('siteadmin.includes.admin_footer');
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_transaction');

            return view('siteadmin.resource_ship_orders')->with('adminheader', $adminheader)
                ->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('orders', $orders);
        } else {
            return Redirect::to('sitemerchant');
        }
    }

    public function resource_completed_orders()
    {
        if (Session::get('userid')) {

            $from_date = Input::get('from_date');
            $to_date = Input::get('to_date');

            if ($from_date || $to_date) {
                $orders = Dashboard::get_completed_orders_by_period($from_date, $to_date);
            } else {
                $orders = Dashboard::get_completed_orders();
            }

            $adminheader    = view('siteadmin.includes.admin_header')->with("routemenu", "transaction");
            $adminfooter    = view('siteadmin.includes.admin_footer');
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_transaction');

            return view('siteadmin.resource_completed_orders')->with('adminheader', $adminheader)
                ->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('orders', $orders);
        } else {
            return Redirect::to('sitemerchant');
        }
    }




    //Fund Controller
    public function requested_withdraws()
    {
        if (Session::has('userid')) {

            $withdraws = Withdraw::where('status', Withdraw::WITHDRAW_STATUS_REQUEST)->get();

            $adminheader    = view('siteadmin.includes.admin_header')->with("routemenu", "transaction");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_transaction');
            $adminfooter    = view('siteadmin.includes.admin_footer');

            return view('siteadmin.withdraw_list')->with('adminheader', $adminheader)
                ->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('withdraws', $withdraws)->with('type', Withdraw::WITHDRAW_STATUS_REQUEST);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function disallowed_withdraws()
    {
        if (Session::has('userid')) {

            $withdraws = Withdraw::where('status', Withdraw::WITHDRAW_STATUS_DISALLOWED)->get();

            $adminheader    = view('siteadmin.includes.admin_header')->with("routemenu", "transaction");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_transaction');
            $adminfooter    = view('siteadmin.includes.admin_footer');

            return view('siteadmin.withdraw_list')->with('adminheader', $adminheader)
                ->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('withdraws', $withdraws)->with('type', Withdraw::WITHDRAW_STATUS_DISALLOWED);
        } else {
            return Redirect::to('siteadmin');
        }
    }

    public function success_withdraws()
    {
        if (Session::has('userid')) {

            $withdraws = Withdraw::where('status', Withdraw::WITHDRAW_STATUS_SUCCESS)->get();

            $adminheader    = view('siteadmin.includes.admin_header')->with("routemenu", "transaction");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_transaction');
            $adminfooter    = view('siteadmin.includes.admin_footer');
            return view('siteadmin.withdraw_list')->with('adminheader', $adminheader)
                ->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('withdraws', $withdraws)->with('type', Withdraw::WITHDRAW_STATUS_SUCCESS);
        } else {
            return Redirect::to('siteadmin');
        }
    }


    public function failed_withdraws()
    {
        if (Session::has('userid')) {

            $withdraws = Withdraw::where('status', Withdraw::WITHDRAW_STATUS_FAILED)->get();

            $adminheader    = view('siteadmin.includes.admin_header')->with("routemenu", "transaction");
            $adminleftmenus = view('siteadmin.includes.admin_left_menu_transaction');
            $adminfooter    = view('siteadmin.includes.admin_footer');

            return view('siteadmin.withdraw_list')->with('adminheader', $adminheader)
                ->with('adminleftmenus', $adminleftmenus)->with('adminfooter', $adminfooter)
                ->with('withdraws', $withdraws)->with('type', Withdraw::WITHDRAW_STATUS_FAILED);
        } else {
            return Redirect::to('siteadmin');
        }
    }


    public function disallow_withdraw($withdraw_id)
    {
        $withdraw = Withdraw::find($withdraw_id);
        $withdraw->status = Withdraw::WITHDRAW_STATUS_DISALLOWED;
        $withdraw->save();
        return Redirect::to('disallowed_withdraws')->with('message', "Disallowed Withdraw");
    }

    public function fund_paypal($data)
    {
        $result = explode('/**/', base64_decode($data));
        
        $id      = $result[0];
        $name    = $result[1];
        $paymail = $result[2];
        $amt     = $result[3];
        require 'paypal_new/paypal.class.php';
        $p             = new paypal_class; // initiate an instance of the class
        $p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; // testing paypal url
       
        
        // setup a variable for this script (ie: 'http://www.micahcarrick.com/paypal.php')
        $this_script = url();
        
        // if there is not action variable, set the default action of 'process'
     
        $product_amount = $amt;
        $item_name      = "Paying fund to" . $name;
        $custom         = $name;
        $item_number    = $id;
     
        $payment_email    = $paymail;
        $product_quantity = 1;
        
        $p->add_field('business', $payment_email);
        $p->add_field('return', $this_script . '/paypal_success');
        $p->add_field('cancel_return', $this_script . '/paypal_cancel');
        $p->add_field('notify_url', $this_script . '/paypal_ipn');
        $p->add_field('item_name', $item_name);
        $p->add_field('amount', $product_amount);
        $p->add_field('quantity', $product_quantity);
        $p->add_field('custom', $custom);
        $p->add_field('item_number', $item_number);
        $p->add_field('currency_code', 'USD');
        $p->submit_paypal_post();
    }
    
    public function paypal_success()
    {
        $txn_id  = Input::get('txn_id');
        $email   = Input::get('payer_email');
        $name    = Input::get('custom');
        $txn_id  = Input::get('txn_id');
        $paidamt = Input::get('mc_gross');
        $mem_id  = Input::get('item_number');
        $status  = Input::get('payment_status');
        $entry   = array(
            'wr_mem_id' => $mem_id,
            'wr_mer_name' => $name,
            'wr_mem_payment_email' => $email,
            'wr_paid_amount' => $paidamt,
            'wr_txn_id' => $txn_id,
            'wr_status' => $status
        );
        Transactions::insert_funds_paypal($entry);
        return Redirect::to('index')->with('result_success', 'Payment Completed Successfully');
    }
    
    public function paypal_ipn()
    {
        $status = Input::get('payment_status');
        $txn_id = Input::get('txn_id');
        $entry  = array(
            'wr_status' => $status
        );
        Transactions::update_funds_paypal($entry, $txn_id);
    }
    
    public function paypal_cancel()
    {
        return Redirect::to('index')->with('result_cancel', 'Payment Cancelled');
    }

    public function update_order_cod()
    {
        $orderid = $_GET['order_id'];
        $status  = $_GET['id'];

        $updaters = Transactions::update_cod_status($status, $orderid);
        if ($updaters) {
            echo "success";
        }

    }
}
