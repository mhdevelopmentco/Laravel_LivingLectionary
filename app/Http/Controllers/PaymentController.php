<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;


/** All Paypal Details class **/
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Api\ShippingAddress;

use PayPal\Api\Payout;
use PayPal\Api\PayoutSenderBatchHeader;
use PayPal\Api\PayoutItem;
use PayPal\Api\Currency;

use App\Category;
use App\City;
use App\Curator;
use App\Country;
use App\Footer;
use App\Home;
use App\Http\Models;
use App\Member;
use App\PaymentInfo;
use App\Products;
use App\Register;
use App\SecurityQuestion;
use App\Settings;
use App\Theme;
use App\Userlogin;
use DB;
use File;
use App\Merchant;
use App\State;

use App\Order;
use App\OrderShip;
use App\OrderPayout;
use App\Withdraw;


use URL;
use Session;


class PaymentController extends Controller
{
    private $_api_context;

    public function __construct()
    {
        //parent::__construct();

        /** setup PayPal api context **/
        $paypal_conf = config('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }


    //process checkout from front checkout page
    public function process_checkout()
    {
        if (Session::has('customerid') || Session::has('guest_checkout')) {
            $data = Input::except(array(
                '_token'
            ));

            $ship_needs = Input::get('ship_needs');
            if ($ship_needs == true) {
                $rule = array(
                    'ship_first_name' => 'required',
                    'ship_last_name' => 'required',
                    'ship_email' => 'required',
                    'ship_phone' => 'required',
                    'ship_country' => 'required',
                    'ship_state' => 'required',
                    'ship_city' => 'required',
                    'ship_addr1' => 'required',
                );

            } else {
                $rule = array(
                    'ship_first_name' => 'required',
                    'ship_last_name' => 'required',
                    'ship_email' => 'required',
                );
            }

            $validator = Validator::make($data, $rule);

            if ($validator->fails()) {

                return Redirect::to('checkout')->withErrors($validator->messages())->withInput();

            } else {

                $inputs = Input::all();
                Session::put('order_ship', $inputs);
                $checkout_data = Session::get('checkout_data');

                //get total price
                $total_price = $checkout_data['total_price'];
                //payment type
                $payment_type = Input::get('select_payment_type');

                if ($total_price > 0) {
                    if ($payment_type == Order::ORDER_TYPE_PAYPAL) {
                        return PaymentController::process_money_checkout_via_paypal();
                        //PaymentController::pay_from_customer();
                    } else {
                        return PaymentController::process_money_checkout_via_other();
                    }
                } else {
                    return PaymentController::process_free_checkout();
                }
            }

        } else {
            return Redirect::to('Home#login');
        }
    }

    //process checkout via paypal
    public function process_money_checkout_via_paypal()
    {
        $checkout_data = Session::get('checkout_data');

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $cart_data = $checkout_data['cart_data'];


        //Set Item List
        $item_prepare_list = [];
        foreach ($cart_data as $cart_product) {

            $item = new Item();

            $item_name = $cart_product['pro_title'];
            $item_quantity = $cart_product['qty'];
            $item_price = $cart_product['pro_price'];

            $item->setName($item_name)
                ->setCurrency('USD')
                ->setQuantity($item_quantity)
                ->setPrice($item_price);
            $item_prepare_list[] = $item;
        }

        $item_list = new ItemList();
        $item_list->setItems($item_prepare_list);

        /*
        // Add Shipping Address
        $ship_country_code = $inputs['ship_country'];
        $ship_state_code = $inputs['ship_state'];
        $ship_city_code = $inputs['ship_city'];
        $ship_addr1 = $inputs['ship_addr1'];
        $ship_addr2 = $inputs['ship_addr2'];
        $ship_zip_code = $inputs['ship_zipcode'];

        $shippingAddress = new ShippingAddress();
        $shippingAddress->setLine2($ship_addr2)
            ->setLine1($ship_addr1)
            ->setCity($ship_city_code)
            ->setState($ship_state_code)
            ->setPostalCode($ship_zip_code)
            ->setCountryCode($ship_country_code);

        $item_list->setShippingAddress($shippingAddress);*/


        //Set Payment Details and Amount
        $total_price = $checkout_data['total_price'];
        $order_tax = $checkout_data['tax_price'];
        $shipping_price = $checkout_data['shipping_price'];
        $sub_total = $checkout_data['subtotal_price'];


        $details = new Details();
        $details->setShipping($shipping_price)
            ->setTax($order_tax)
            ->setSubtotal($sub_total);


        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($total_price)
            ->setDetails($details);

        //Set Transaction
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Living Lectionary Product Purchase')
            ->setInvoiceNumber(uniqid());


        //Set Redirect URLs
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('get_payment_status'))
            ->setCancelUrl(URL::route('get_payment_status'));

        //Set Payment
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        /**dd($payment->create($this->_api_context));exit;**/

        try {
            $payment->create($this->_api_context);

        } catch (\PayPal\Exception\PPConnectionException $ex) {

            if (\Config::get('app.debug')) {

                \Session::put('checkout_error', 'Connection timeout');
                return Redirect::to('checkout');
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
                \Session::put('checkout_error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('checkout');
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());


        if (isset($redirect_url)) {
            return redirect()->away($redirect_url);
        }

        \Session::put('checkout_error', 'Unknown error occurred');
        return Redirect::to('checkout');
    }

    public function get_payment_status()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/


        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('checkout_error', 'Payment failed');
            return Redirect::to('checkout');
        }

        $payment = Payment::get($payment_id, $this->_api_context);
        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        /** dd($result);exit; /** DEBUG RESULT, remove it later **/
        if ($result->getState() == 'approved') {
            /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/
            \Session::put('checkout_success', 'Payment success');
            return Redirect::to('payment_success_from_customer');
        }
        \Session::put('checkout_error', 'Payment failed');
        return Redirect::to('checkout');
    }


    //when payment success from customer via paypal
    public function payment_success_from_customer()
    {
        /*
         *  Store paymentid, customer_buyer_list
         * */

        //get payment id
        $payment_id = Session::get('paypal_payment_id');
        //checkout data
        $checkout_data = Session::get('checkout_data');
        //ship data
        $ship_data = Session::get('order_ship');
        //now send the product link to customer mail box
        PaymentController::send_order_products_to_mailbox($ship_data, $checkout_data);

        /*
         * Store Payment History
         *
         *  Customer info($customer_id), Merchant info($merchant), Product info([$product_id, $product_qty, $product_price])
         *  Tax, Order Amount, Order Created date
         *  paymentid
        */

        //save order info
        $order_id = PaymentController::save_order_info($payment_id, $ship_data, $checkout_data);

        //save payout info
        PaymentController::save_payout_info($order_id, $checkout_data);

        //save order ship info
        PaymentController::save_order_ship_info($order_id, $checkout_data, $ship_data);

        Session::put('checkout_success', true);

        return Redirect::to('checkout_success');
    }

    public function send_order_products_to_mailbox($ship_data, $checkout_data)
    {

        $customer_name = $ship_data['ship_first_name'] . ' ' . $ship_data['ship_last_name'];
        $ship_email = $ship_data['ship_email'];

        //here, we should send email
        $cart_data = $checkout_data['cart_data'];

        if ($_SERVER['HTTP_HOST'] != 'localhost') {

            //Mail Send
            Mail::send('emails.order_products', array(
                'customer_name' => $customer_name,
                'order_products' => $cart_data,
            ), function ($message) use ($ship_email) {
                $message->to($ship_email)->subject('Your Living Lectionary Resources');
            });
        }

    }

    public function save_order_info($payment_id, $ship_data, $checkout_data)
    {

        $order_amount = $checkout_data['total_price'];
        $order_product_amount = $checkout_data['subtotal_price'];
        $order_ship_amount = $checkout_data['shipping_price'];
        $order_tax = $checkout_data['tax_price'];
        $payment_type = $ship_data['select_payment_type'];

        if ($order_amount > 0) {
            $order_type = $payment_type;
        } else {
            $order_type = Order::ORDER_TYPE_FREE;
        }

        if (Session::has('customerid')) {
            $order_cus_id = Session::get('customerid');
        } else {
            // Guest Checkout
            // Session::has('guest_checkout')
            $order_cus_id = "";
        }

        $order_cus_name = $ship_data['ship_first_name'] . ' ' . $ship_data['ship_last_name'];

        $order_cus_email = $ship_data['ship_email'];

        $order_entry = array(
            'order_cus_id' => $order_cus_id,
            'order_cus_name' => $order_cus_name,
            'order_cus_email' => $order_cus_email,
            'order_amount' => $order_amount,
            'order_product_amount' => $order_product_amount,
            'order_ship_amount' => $order_ship_amount,
            'order_tax' => $order_tax,
            'order_type' => $order_type,
            'payment_id' => $payment_id,
            'get_paid_status' => Order::ORDER_GET_PAID_SUCCESS_STATUS
        );

        $order = Order::create($order_entry);
        return $order->id;
    }

    public function save_payout_info($order_id, $checkout_data)
    {

        $cart_data = $checkout_data['cart_data'];

        $pro_mr_list = [];

        foreach ($cart_data as $product) {
            if ($product['pro_price'] > 0) {
                $mr_id = $product['pro_mr_id'];
                if (array_key_exists($mr_id, $pro_mr_list)) {
                    $pro_mr = $pro_mr_list[$mr_id];
                } else {
                    $pro_mr = array();
                }

                $pro_mr[] = $product;

                $pro_mr_list[$mr_id] = $pro_mr;
            }

        }

        foreach ($pro_mr_list as $mr_id => $pro_mr) {
            $merchant_id = $mr_id;

            $pay_amount = 0;

            foreach ($pro_mr as $product) {
                $pay_amount += round($product['pro_sub_total'] / 2 + $product['pro_ship_amount'], 2);
            }

            $payout_entry = array(
                'merchant_id' => $merchant_id,
                'order_id' => $order_id,
                'payout_amount' => $pay_amount
            );

            OrderPayout::create($payout_entry);
        }
    }

    public function save_order_ship_info($order_id, $checkout_data, $ship_data)
    {
        $cart_data = $checkout_data['cart_data'];


        $order = Order::find($order_id);

        //for each product, we should save ship info
        //even that product doesn't need the ship info, the product's delivery status : we should know about this.

        $non_ship_count = 0;

        if (Session::has('customerid')) {
            $customer_id = Session::get('customerid');
        } else {
            //include: guest checkout
            $customer_id = "";
        }

        foreach ($cart_data as $product) {
            $ship_type = $product['pro_content_kind'];
            if ($ship_type != Products::PRODUCT_TYPE_SHIP) {
                $ship_status = OrderShip::ORDERSHIP_STATUS_DELIVERED;
                $non_ship_count++;
            } else {
                $ship_status = OrderShip::ORDERSHIP_STATUS_NOT_DELIVERED;
            }

            $customer_email = $ship_data['ship_email'];

            $order_ship_entry = array(
                'order_id' => $order_id,
                'cus_id' => $customer_id,
                'order_cus_email' => $customer_email,
                'customer_name' => $ship_data['ship_first_name'] . ' ' . $ship_data['ship_last_name'],
                'ship_mer_id' => $product['pro_mr_id'],
                'product_id' => $product['pid'],
                'product_quantity' => $product['qty'],
                'product_subtotal' => $product['pro_sub_total'],
                'ship_amt' => $product['pro_ship_amount'],
                'ship_email' => $ship_data['ship_email'],
                'ship_country' => $ship_data['ship_country'],
                'ship_state' => $ship_data['ship_state'],
                'ship_city' => $ship_data['ship_city'],
                'ship_addr1' => $ship_data['ship_addr1'],
                'ship_addr2' => $ship_data['ship_addr2'],
                'ship_type' => $product['pro_content_kind'],
                'ship_status' => $ship_status,
            );

            OrderShip::create($order_ship_entry);
        }

        if ($non_ship_count == count($cart_data)) {
            //this is paid but all non-shipping products
            $order->update(
                array(
                    'ship_status' => OrderShip::ORDERSHIP_STATUS_DELIVERED,
                )
            );
        }

    }

    public function checkout_success()
    {
        Session::forget('paypal_payment_id');
        Session::forget('checkout_data');
        Session::forget('order_ship');
        unset($_SESSION['cart']);
        return Redirect::to('checkout_done');
    }

    //when payment is none and all products are free
    public function process_free_checkout()
    {
        //checkout data
        $checkout_data = Session::get('checkout_data');
        //ship data
        $ship_data = Session::get('order_ship');

        //send products via mail
        PaymentController::send_order_products_to_mailbox($ship_data, $checkout_data);

        //save order info
        $order_id = PaymentController::save_free_order_info($ship_data, $checkout_data);

        PaymentController::save_order_ship_info($order_id, $checkout_data, $ship_data);

        Session::put('checkout_success', true);

        return Redirect::to('checkout_success');
    }

    public function save_free_order_info($ship_data, $checkout_data)
    {
        if (Session::has('customerid'))
            $order_cus_id = Session::get('customerid');
        else {
            $order_cus_id = "";
        }

        $order_amount = $checkout_data['total_price'];
        $order_product_amount = $checkout_data['subtotal_price'];
        $order_ship_amount = $checkout_data['shipping_price'];
        $order_tax = $checkout_data['tax_price'];
        $order_type = Order::ORDER_TYPE_FREE;

        $order_cus_name = $ship_data['ship_first_name'] . ' ' . $ship_data['ship_last_name'];

        $order_entry = array(
            'order_cus_id' => $order_cus_id,
            'order_cus_email' => $ship_data['ship_email'],
            'order_cus_name' => $order_cus_name,
            'order_amount' => $order_amount,
            'order_product_amount' => $order_product_amount,
            'order_ship_amount' => $order_ship_amount,
            'order_tax' => $order_tax,
            'order_type' => $order_type,
            'get_paid_status' => Order::ORDER_GET_PAID_SUCCESS_STATUS,
            'order_shipping_status' => 1,
            'payout_to_merchant_status' => 1,
            'order_status' => 1,
        );

        $order = Order::create($order_entry);
        return $order->id;
    }

    public function checkout_done()
    {
        if (Session::has('checkout_success') || Session::has('checkout_error')) {
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

            $header = view('includes.header')->with('theme_list', $get_theme_list)->with('logodetails', $getlogodetails)
                ->with('inverse_logodetails', $getlogo2details)->with('country_details', $country_details)
                ->with('catg_list', $get_category_list)->with('menu_inverse', true);
            $footer = view('includes.footer')->with('cms_page_title', $cms_page_title)
                ->with('get_social_media_url', $get_social_media_url)
                ->with('get_contact_det', $get_contact_det)->with('getanl', $getanl);

            return view('checkout_done')->with('header', $header)->with('footer', $footer)
                ->with('metadetails', $get_meta_details);
        } else {
            return Redirect::to('checkout');
        }
    }

    public function process_money_checkout_via_other()
    {
    }

    //temp
    public function pay_from_customer()
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();
        $item_1->setName('Item 1')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice(20);

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal(20);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('get_payment_status_test'))
            ->setCancelUrl(URL::route('get_payment_status_test'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('checkout_error', 'Connection timeout');
                return Redirect::to('checkout');
            } else {
                \Session::put('checkout_error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('checkout');
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            return Redirect::away($redirect_url);
        }
        \Session::put('checkout_error', 'Unknown error occurred');
        return Redirect::to('checkout');
    }

    public function get_payment_status_test()
    {
        $payment_id = Session::get('paypal_payment_id');
        Session::forget('paypal_payment_id');

        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error', 'Payment failed');
            return Redirect::to('checkout');
        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') {
            \Session::put('success', 'Payment success');
            return Redirect::to('checkout');
        }
        \Session::put('error', 'Payment failed');
        return Redirect::to('checkout');
    }


    //Merchant withdraw
    public function merchant_withdraw_submit()
    {
        $merchant_id = Input::get('merchant_id');
        $available = Input::get('available');
        $least = Input::get('least');
        $pay_kind = Input::get('pay_kind');
        $request = Input::get('pay_amt');

        if ($pay_kind == 2) {
            //partial pay: avail > request
        } else {
            $request = $available;
        }
        $merchant = Merchant::find($merchant_id);
        $merchant_email = $merchant->mer_pay_email;

        Withdraw::create(['merchant_id' => $merchant_id, 'amount' => $request, 'status' => Withdraw::WITHDRAW_STATUS_REQUEST]);

        return Redirect::to('withdraw_request')->with('success', 'Request was made successfully.');
    }

    public function allow_withdraw($withdraw_id)
    {
        $withdraw = Withdraw::find($withdraw_id);
        $merchant_id = $withdraw->merchant_id;

        $merchant = Merchant::find($merchant_id);
        $merchant_email = $merchant->mer_pay_email;
        $amount = $withdraw->amount;
        $available = $merchant->avail_withdraw_amount + $merchant->mer_rest_amt;

        $withdraw_status = PaymentController::payout_to_merchant($merchant_id, $merchant_email, $amount, $available, $withdraw_id);

        if($withdraw_status == "SUCCESS")
            return Redirect::to('success_withdraws')->with('message', "Allowed Withdraw");
        else
            return Redirect::to('failed_withdraws')->with('message', "Failed Withdraw");
    }

    public function payout_to_merchant($merchant_id, $merchant_email, $request, $available, $withdraw_id)
    {
        // Create a new instance of Payout object
        $payouts = new Payout();

        // This is how our body should look like:
        /*
         * {
                    "sender_batch_header":{
                        "sender_batch_id":"2014021801",
                        "email_subject":"You have a Payout!"
                    },
                    "items":[
                        {
                            "recipient_type":"EMAIL",
                            "amount":{
                                "value":"1.0",
                                "currency":"USD"
                            },
                            "note":"Thanks for your patronage!",
                            "sender_item_id":"2014031400023",
                            "receiver":"shirt-supplier-one@mail.com"
                        }
                    ]
                }
         */

        $senderBatchHeader = new PayoutSenderBatchHeader();
        $senderBatchHeader->setSenderBatchId(uniqid())
            ->setEmailSubject("You have a Payout!");

        $amount = New Currency();
        $amount->setValue($request)->setCurrency('USD');

        $senderItem = new PayoutItem();
        $senderItem->setRecipientType('Email')
            ->setNote('Thanks for your patronage!')
            ->setReceiver($merchant_email)
            ->setSenderItemId("2014031400023")
            ->setAmount($amount);

        $payouts->setSenderBatchHeader($senderBatchHeader)
            ->addItem($senderItem);

        try {

            $output = $payouts->createSynchronous($this->_api_context);

            $batch_id = $output->getBatchHeader()->getPayoutBatchId();
            $batch_status = $output->getBatchHeader()->getBatchStatus();

            PaymentController::save_payout_to_merchant_status($merchant_id, $batch_id, $request, $available, $batch_status, $withdraw_id);

            return $batch_status;

        } catch (Exception $ex) {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            return Redirect::to('withdraw_request')->withError('Withdraw Failed. Please try again later.');
        }
    }

    public function save_payout_to_merchant_status($merchant_id, $batch_id, $request_amount, $available, $status_msg, $withdraw_id)
    {
        if ($status_msg == "SUCCESS") {
            //set payout status
            $payouts = OrderPayout::where('merchant_id', $merchant_id)->where('pay_status', 0)->get();
            $order_ids = [];
            foreach ($payouts as $payout) {
                $payout->update(['pay_status' => 1]);
                $order_ids [] = $payout->order_id;
            }

            //decrease remain amount from merchant
            $merchant = Merchant::find($merchant_id);
            $merchant->mer_rest_amt = $available - $request_amount;
            $merchant->save();

            //change orders' status
            foreach ($order_ids as $order_id) {
                $order = Order::find($order_id);
                $order->check_order_status();
            }
        }

        //update withdraw
        $withdraw = Withdraw::find($withdraw_id);
        if($status_msg == "SUCCESS")
        {
            $withdraw->update(['payout_batch_id' => $batch_id, 'amount' => $request_amount, 'status'=> Withdraw::WITHDRAW_STATUS_SUCCESS, 'status_msg' => $status_msg]);
        }
        else
        {
            $withdraw->update(['payout_batch_id' => $batch_id, 'amount' => $request_amount, 'status'=> Withdraw::WITHDRAW_STATUS_FAILED, 'status_msg' => $status_msg]);
        }

        return;
    }


}