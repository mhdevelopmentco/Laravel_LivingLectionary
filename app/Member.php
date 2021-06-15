<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use App\OrderShip;

class Member extends Model
{
    protected $primaryKey = 'mem_id';
    protected $table = 'nm_member';

    const MEMBER_LOGIN_ADMIN = 1;
    const MEMBER_LOGIN_CUSTOMER = 2;
    const MEMBER_LOGIN_MERCHANT = 3;

    const MEMBER_PAYMENT_PAYPAL = 1;
    const MEMBER_PAYMENT_OTHER = 2;
    const MEMBER_PAYMENT_LATER = 3;
    const MEMBER_PAYMENT_NONEED = 4;

    protected $fillable = [
        'mem_fname',
        'mem_lname',
        'mem_email',
        'mem_password',
        'mem_userid',
        'mem_phone',
        'mem_country',
        'mem_state',
        'mem_city',
        'mem_address1',
        'mem_address2',
        'mem_zipcode',
        'mem_secq',
        'mem_seca',
        'mem_logintype',
        'mem_newsget',
        'mem_facebookid',
        'mem_status',
        'mem_confirmed',
        'mem_con_chargeflag',
        'mem_con_org',
        'mem_con_orgtitle',
        'mem_con_orgdesc',
        'mem_con_webaddress',
        'mem_con_displayname',
        'mem_fb_login',
        'mer_rest_amt',
        'mer_minimum_amt',
        'mer_pay_email'
    ];

    protected $appends = [
        'name'
    ];


    public function getNameAttribute()
    {
        return $this->mem_fname . ' ' . $this->mem_lname;
    }


    //GET
    public static function get_member_details()
    {
        return DB::table('nm_review')->LeftJoin('nm_member', 'nm_review.customer_id', '=', 'nm_member.mem_id')->get();
    }

    public static function get_member($id)
    {
        return DB::table('nm_member')->where('mem_id', '=', $id)
            ->Leftjoin('nm_city', 'nm_member.mem_city', '=', 'nm_city.ci_id')
            ->Leftjoin('nm_state', 'nm_member.mem_state', '=', 'nm_state.st_id')
            ->Leftjoin('nm_country', 'nm_member.mem_country', '=', 'nm_country.co_id')->get();
    }

    public static function get_member_with_email($email)
    {
        return DB::table('nm_member')->where('mem_email', '=', $email)->get();
    }

    public static function get_member_list()
    {
        return DB::table('nm_member')->where('mem_logintype', Member::MEMBER_LOGIN_CUSTOMER)
            ->Leftjoin('nm_city', 'nm_member.mem_city', '=', 'nm_city.ci_id')
            ->Leftjoin('nm_state', 'nm_member.mem_state', '=', 'nm_state.st_id')
            ->Leftjoin('nm_country', 'nm_member.mem_country', '=', 'nm_country.co_id')
            ->orderBy('nm_member.created_at', 'desc')->get();
    }


    public static function get_admin_users()
    {
        return DB::table('nm_member')->where('mem_logintype', '=', 1)->where('mem_status', '=', 1)->count();
    }

    public static function get_website_users()
    {
        return DB::table('nm_member')->where('mem_logintype', '=', 2)->where('mem_status', '=', 1)->count();
    }

    public static function get_website_contributors()
    {
        return DB::table('nm_member')->where('mem_logintype', '=', 3)->where('mem_status', '=', 1)->count();
    }

    public static function get_fb_users()
    {
        return DB::table('nm_member')->where('mem_logintype', '=', 4)->where('mem_status', '=', 1)->count();
    }

    public static function get_chart_detailsnew()
    {
        $chart_count = "";
        for ($i = 1; $i <= 12; $i++) {
            $results = DB::select(DB::raw("SELECT count(*) as count FROM nm_member WHERE  mem_logintype=2 and  MONTH( `created_at` ) = " . $i));
            $chart_count .= $results[0]->count . ",";
        }
        $chart_count1 = trim($chart_count, ",");
        return $chart_count1;
    }

    public static function get_inquiry_details_email($id)
    {
        return DB::table('nm_inquiries')->where('iq_id', '=', $id)->get();
    }


    public static function get_member_country($id)
    {
        return DB::table('nm_country')->where('co_id', '=', $id)->where('co_status', '=', 0)->get();
    }

    public static function get_member_city($id)
    {
        return DB::table('nm_city')->where('ci_id', '=', $id)->where('ci_status', '=', 1)->get();
    }


    public static function get_memberreports($from_date, $to_date)
    {
        if ($from_date != '' && $to_date == '') {
            return DB::table('nm_member')->Leftjoin('nm_city', 'nm_member.mem_city', '=', 'nm_city.ci_id')->where('nm_member.created_at', $from_date)->where('nm_member.mem_status', '=', 1)->orderBy('nm_member.mem_id', 'DESC')->get();

        } elseif ($from_date != '' && $to_date != '') {
            return DB::table('nm_member')->Leftjoin('nm_city', 'nm_member.mem_city', '=', 'nm_city.ci_id')->whereBetween('nm_member.created_at', array(
                $from_date,
                $to_date
            ))->where('nm_member.mem_status', '=', 1)->orderBy('nm_member.mem_id', 'DESC')->get();
        } else {

        }

    }


    public static function get_store_count($merchant_return)
    {
        $result = [];

        foreach ($merchant_return as $store_cnt) {
            $catg_result = DB::table('nm_store')->where('stor_merchant_id', '=', $store_cnt->mem_id)->get();
            if ($catg_result) {
                $result[$store_cnt->mem_id] = count($catg_result);
            } else {
                $result[$store_cnt->mem_id] = 0;
            }
        }
        return $result;
    }


    //Update

    public static function update_member($id, $entry)
    {
        return DB::table('nm_member')->where('mem_id', '=', $id)->update($entry);
    }

    public static function update_status_of_member($id, $status)
    {
        return DB::table('nm_member')->where('mem_id', '=', $id)->update(array('mem_status' => $status));
    }

    public static function update_member_to_contributor($mem_id)
    {
        return DB::table('nm_member')->where('mem_id', '=', $mem_id)->update(array('mem_logintype' => Member::MEMBER_LOGIN_MERCHANT));
    }

    //Insert

    public static function insert_member($entry)
    {
        $check_insert = DB::table('nm_member')->insert($entry);
        if ($check_insert) {
            return DB::getPdo()->lastInsertId();
        } else {
            return 0;
        }
    }

    public static function insert_store($entry)
    {
        return DB::table('nm_store')->insert($entry);
    }

    public static function update_store_by_merchant_store($merchant_id, $store_id, $entry)
    {
        return DB::table('nm_store')->where('stor_merchant_id', $merchant_id)->where('stor_id', $store_id)->update($entry);
    }


    public static function update_store($store_id, $entry)
    {
        return DB::table('nm_store')->where('stor_id', $store_id)->update($entry);
    }


    // Check Exist

    public static function check_emailaddress($emailaddr)
    {
        return DB::table('nm_member')->where('mem_email', '=', $emailaddr)->get();
    }

    public static function check_memberid($userid)
    {
        $count = count(DB::table('nm_member')->where('mem_userid', $userid)->get());
        if ($count > 0)
            return true;
        else
            return false;
    }

    public static function check_emailaddress_edit($emailaddr, $cusid)
    {
        return DB::table('nm_member')->where('mem_email', '=', $emailaddr)->where('mem_id', '!=', $cusid)->get();
    }

    public static function check_memberid_edit($userid, $cusid)
    {
        return DB::table('nm_member')->where('mem_userid', '=', $userid)->where('mem_id', '!=', $cusid)->get();
    }

    //Delete
    public static function delete_member($id)
    {
        DB::table('nm_member')->where('mem_id', '=', $id)->delete();

        return;
    }


    /*Subscriber*/

    public static function subscriber_list()
    {
        return DB::table('nm_newsletter_subscribers')->OrderBy('id', 'desc')->get();
    }


    public static function update_subscriber_msgstatus()
    {
        return DB::table('nm_newsletter_subscribers')->update(array('status' => 1));
    }


    public static function delete_news_subscriber($id)
    {
        return DB::table('nm_newsletter_subscribers')->where('id', '=', $id)->delete();
    }

    public static function edit_news_subscriber_status($id, $status)
    {
        return DB::table('nm_newsletter_subscribers')->where('id', $id)->update(array('status' => $status));
    }

    public static function update_member_password($mem_email, $pwd)
    {
        return DB::table('nm_member')->where('mem_email', '=', $mem_email)->update(array(
            'mem_password' => $pwd
        ));
    }


    /*Store*/

    public static function get_merchant_list()
    {
        return DB::table('nm_member')->where('mem_logintype', Member::MEMBER_LOGIN_MERCHANT)
            ->Leftjoin('nm_store', 'nm_store.stor_merchant_id', '=', 'nm_member.mem_id')
            ->Leftjoin('nm_city', 'nm_member.mem_city', '=', 'nm_city.ci_id')
            ->Leftjoin('nm_state', 'nm_member.mem_state', '=', 'nm_state.st_id')
            ->Leftjoin('nm_country', 'nm_member.mem_country', '=', 'nm_country.co_id')
            ->groupBy('nm_member.mem_id')
            ->orderBy('nm_member.created_at', 'desc')->get();
    }


    public static function get_store_detail($id)
    {
        return DB::table('nm_store')->where('stor_id', '=', $id)
            ->Leftjoin('nm_city', 'nm_city.ci_id', '=', 'nm_store.stor_city')
            ->Leftjoin('nm_state', 'nm_state.st_id', '=', 'nm_store.stor_state')
            ->Leftjoin('nm_country', 'nm_country.co_id', '=', 'nm_store.stor_country')
            ->get();
    }

    public static function get_store_from_merchant($id)
    {
        return DB::table('nm_store')->where('stor_merchant_id', '=', $id)
            ->Leftjoin('nm_city', 'nm_city.ci_id', '=', 'nm_store.stor_city')
            ->Leftjoin('nm_state', 'nm_state.st_id', '=', 'nm_store.stor_state')
            ->Leftjoin('nm_country', 'nm_country.co_id', '=', 'nm_store.stor_country')
            ->get();
    }

    public static function get_store_from_id_and_merchant($id, $merid)
    {
        return DB::table('nm_store')->where('stor_merchant_id', '=', $merid)->where('stor_id', '=', $id)->get();
    }

    public static function edit_store($id, $entry)
    {
        return DB::table('nm_store')->where('stor_id', '=', $id)->update($entry);
    }

    public static function block_store_status($id, $entry)
    {
        return DB::table('nm_store')->where('stor_id', '=', $id)->update($entry);
    }

    public static function get_store_cnt()
    {
        return DB::table('nm_store')->where('stor_status', '=', 1)->count();
    }

    public static function get_admin_stores()
    {
        return DB::table('nm_store')->where('stor_addedby', '=', 1)->where('stor_status', '=', 1)->count();
    }

    public static function get_merchant_stores()
    {
        return DB::table('nm_store')->where('stor_addedby', '=', 2)->where('stor_status', '=', 1)->count();
    }


    public static function store_is_or_not_in_product($query)
    {
        foreach ($query as $store) {
            $check = DB::table('nm_product')->where('pro_sh_id', '=', $store->stor_id)->count();
            $result[$store->stor_id] = $check;
            return $result;
        }
        return 0;
    }


    public static function merchant_is_or_not_in_product($query)
    {
        foreach ($query as $store) {
            $check = DB::table('nm_product')->where('pro_mr_id', '=', $store->mem_id)->count();
            $result[$store->mem_id] = $check;
            return $result;
        }
        return 0;
    }

    public static function get_merchantreports($from_date, $to_date)
    {

        if ($from_date != '' && $to_date == '') {
            return DB::table('nm_member')->join('nm_store', 'nm_store.stor_merchant_id', '=', 'nm_member.mem_id')->join('nm_city', 'nm_city.ci_id', '=', 'nm_member.mem_city')->where('nm_member.created_at', $from_date)->where('nm_member.mem_status', '=', 1)->orderBy('nm_member.mem_id', 'DESC')->groupBy('nm_member.mem_id')->get();

        } elseif ($from_date != '' && $to_date != '') {
            return DB::table('nm_member')->join('nm_store', 'nm_store.stor_merchant_id', '=', 'nm_member.mem_id')->join('nm_city', 'nm_city.ci_id', '=', 'nm_member.mem_city')->whereBetween('nm_member.created_at', array(
                $from_date,
                $to_date
            ))->where('nm_member.mem_status', '=', 1)->orderBy('nm_member.mem_id', 'DESC')->groupBy('nm_member.mem_id')->get();
        } else {

        }

    }


    public static function get_shopreports($from_date, $to_date, $id)
    {
        if ($from_date != '' && $to_date == '') {

            return DB::table('nm_store')->join('nm_city', 'nm_city.ci_id', '=', 'nm_store.stor_city')->where('nm_store.stor_merchant_id', '=', $id)->where('nm_store.created_date', $from_date)->orderBy('nm_store.stor_id', 'DESC')->get();

        } elseif ($from_date != '' && $to_date != '') {

            return DB::table('nm_store')->join('nm_city', 'nm_city.ci_id', '=', 'nm_store.stor_city')->where('nm_store.stor_merchant_id', '=', $id)->whereBetween('nm_store.created_date', array(
                $from_date,
                $to_date
            ))->orderBy('nm_store.stor_id', 'DESC')->get();
        } else {

        }

    }

    public static function delete_merchant($id)
    {
        //first delete payment info
        DB::table('nm_payment_info')->where('member_id', $id)->delete();

        //second delete store
        DB::table('nm_store')->where('stor_merchant_id', '=', $id)->delete();

        //delete member account itself
        DB::table('nm_member')->where('mem_id', '=', $id)->delete();
        return;
    }

    public static function delete_store($id, $mem_id)
    {
        return DB::table('nm_store')->where('stor_merchant_id', '=', $mem_id)->where('stor_id', '=', $id)->delete();
    }


    public static function randomPassword()
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public static function get_logintoday_users()
    {
        return DB::select(DB::raw("SELECT count(DISTINCT mem_id) as count  from nm_login where DATEDIFF(DATE(log_date),DATE(NOW()))=0"));
    }

    public static function get_login7days_users()
    {
        return DB::select(DB::raw("select count(DISTINCT mem_id) as count from nm_login WHERE (DATE(log_date) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY))"));
    }

    public static function get_login30days_users()
    {
        return DB::select(DB::raw("select  count(DISTINCT mem_id) as count from nm_login WHERE (DATE(log_date) >= DATE_SUB(CURDATE(), INTERVAL 30 DAY))"));
    }

    public static function get_login12mnth_users()
    {
        return DB::select(DB::raw("select count(DISTINCT mem_id) as count from nm_login where log_date >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH)"));
    }


    /*Member Profile*/
    public static function get_member_shipping_details($customerid)
    {
        return DB::table('nm_shipping')->where('ship_cus_id', '=', $customerid)->get();

    }

    public static function get_order_products_list($customerid)
    {
        return OrderShip::where('cus_id', $customerid)->get();
    }


    public static function getproductordersdetails($customerid)
    {
        return DB::table('nm_order')->join('nm_product', 'nm_order.order_pro_id', '=', 'nm_product.pro_id')->join('nm_shipping', 'nm_order.order_cus_id', '=', 'nm_shipping.ship_cus_id')->groupBy('nm_order.order_pro_id')->orderBy('nm_order.order_date', 'desc')->where('order_cus_id', '=', $customerid)->get();

    }

    public static function getproductordersdetailss($customerid)
    {
        return DB::table('nm_ordercod')->join('nm_product', 'nm_ordercod.cod_pro_id', '=', 'nm_product.pro_id')->join('nm_shipping', 'nm_ordercod.cod_cus_id', '=', 'nm_shipping.ship_cus_id')->groupBy('nm_ordercod.cod_pro_id')->orderBy('nm_ordercod.cod_date', 'desc')->where('cod_cus_id', '=', $customerid)->get();

    }

    public static function get_shipinfo_details($customerid)
    {
        return DB::table('nm_shipinfo')->where('ship_mem_id', '=', $customerid)
            ->Leftjoin('nm_city', 'nm_shipinfo.ship_city', '=', 'nm_city.ci_id')
            ->Leftjoin('nm_state', 'nm_shipinfo.ship_state', '=', 'nm_state.st_id')
            ->Leftjoin('nm_country', 'nm_shipinfo.ship_country', '=', 'nm_country.co_id')
            ->get();

    }

    public static function get_shipping_details($customerid)
    {
        return DB::table('nm_shipping')->where('ship_cus_id', '=', $customerid)->get();

    }

    public static function update_member_userid($uid, $cusid)
    {
        return DB::table('nm_member')->where('mem_id', '=', $cusid)->update(array('mem_userid' => $uid));
    }


    public static function update_member_name($fname, $lname, $cusid)
    {
        return DB::table('nm_member')->where('mem_id', '=', $cusid)->update(array('mem_fname' => $fname, 'mem_lname' => $lname));
    }

    public static function update_address1($addr1, $cusid)
    {
        return DB::table('nm_member')->where('mem_id', '=', $cusid)->update(array('mem_address1' => $addr1));

    }

    public static function update_address2($addr2, $cusid)
    {
        return DB::table('nm_member')->where('mem_id', '=', $cusid)->update(array('mem_address2' => $addr2));

    }

    public static function update_city($city, $country, $cusid)
    {
        return DB::table('nm_member')->where('mem_id', '=', $cusid)->update(array(
            'mem_city' => $city,
            'mem_country' => $country
        ));

    }

    public static function check_oldpwd($cusid, $oldpwd)
    {
        return DB::table('nm_member')->where('mem_id', '=', $cusid)->where('mem_password', '=', $oldpwd)->get();

    }


    public static function insert_shipinfo($entry)
    {
        return DB::table('nm_shipinfo')->insert($entry);
    }

    public static function update_shipinfo($cus_id, $entry)
    {
        return DB::table('nm_shipinfo')->where('ship_mem_id', $cus_id)->update($entry);
    }


    public static function insert_shipping($shipcus, $shipaddr1, $shipaddr2, $shipcusmobile, $shipcusemail, $shippingstate, $zipcode, $cityid, $countryid, $customerid)
    {
        return DB::table('nm_shipping')->insert(array(
            'ship_name' => $shipcus,
            'ship_address1' => $shipaddr1,
            'ship_address2' => $shipaddr2,
            'ship_ci_id' => $cityid,
            'ship_state' => $shippingstate,
            'ship_country' => $countryid,
            'ship_postalcode' => $zipcode,
            'ship_phone' => $shipcusmobile,
            'ship_email' => $shipcusemail,
            'ship_cus_id',
            '=',
            $customerid
        ));
    }

    public static function update_shipping($shipcus, $shipaddr1, $shipaddr2, $shipcusmobile, $shipcusemail, $shippingstate, $zipcode, $cityid, $countryid, $customerid)
    {
        return DB::table('nm_shipping')->where('ship_cus_id', '=', $customerid)->update(array(
            'ship_name' => $shipcus,
            'ship_address1' => $shipaddr1,
            'ship_address2' => $shipaddr2,
            'ship_ci_id' => $cityid,
            'ship_state' => $shippingstate,
            'ship_country' => $countryid,
            'ship_postalcode' => $zipcode,
            'ship_phone' => $shipcusmobile,
            'ship_email' => $shipcusemail
        ));

    }

    public static function update_profileimage($customerid, $filename)
    {

        return DB::table('nm_member')->where('mem_id', '=', $customerid)->update(array(
            'mem_pic' => $filename
        ));
    }

    public static function get_wishlistdetails($customerid)
    {
        return DB::table('nm_wishlist')->join('nm_product', 'nm_wishlist.ws_pro_id', '=', 'nm_product.pro_id')
            ->where('ws_mem_id', '=', $customerid)->get();

    }

    public static function get_wishlistdetailscnt($customerid)
    {
        return DB::table('nm_wishlist')->where('ws_mem_id', '=', $customerid)->count();

    }

    public static function get_general_settings()
    {
        return DB::table('nm_generalsetting')->get();

    }

    public static function insert_wish($entry)
    {
        return DB::table('nm_wishlist')->insert($entry);
    }

    public static function remove_wish($wishlist_id)
    {
        return DB::table('nm_wishlist')->where('ws_id', $wishlist_id)->delete();
    }

}

?>
