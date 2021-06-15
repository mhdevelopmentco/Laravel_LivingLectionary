<?php
namespace App;
use DB;
use File;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Session;

class Products extends Model
{
    protected $primaryKey = 'pro_id';
    protected $table = 'nm_product';

    const PRODUCT_STATUS_NOT_APPROVED = 0;
    const PRODUCT_STATUS_APPROVED = 1;
    const PRODUCT_STATUS_PENDING = -1;

    const PRODUCT_STATUS_BLOCKED = 0;
    const PRODUCT_STATUS_ACTIVATED = 1;


    public $timestamps = false;

    protected $appends = ['store_name', 'product_type'];

    const PRODUCT_TYPE_SHIP = 1;
    const PRODUCT_TYPE_DOWNLOAD = 2;
    const PRODUCT_TYPE_LINK = 3;

    public function getProductTypeAttribute()
    {
        switch ($this->pro_content_kind) {
            case Products::PRODUCT_TYPE_SHIP:
                return "Tangible";
            case Products::PRODUCT_TYPE_DOWNLOAD:
                return "Download";
            case Products::PRODUCT_TYPE_LINK:
                return "Link";
            default:
                return "Tangible";
        }
    }

    public function getStoreNameAttribute()
    {
        $store_name = "";

        $store_id = $this->pro_sh_id;
        $store = DB::table('nm_store')->where('stor_id', $store_id)->get();
        if (count($store) > 0) {
            $store_name = $store[0]->stor_name;
        }
        return $store_name;
    }

    public function add_theme_id($theme_id)
    {
        if (!$this->has_theme_id($theme_id)) {
            $pro_theme_ids = $this->pro_theme_ids;
            if ($pro_theme_ids) {
                $pro_theme_ids .= ":" . $theme_id;
            } else {
                $pro_theme_ids = $theme_id;
            }

            $this->pro_theme_ids = $pro_theme_ids;
            $this->save();
        }
    }

    public function remove_theme_id($theme_id)
    {
        if ($this->has_theme_id($theme_id)) {
            $pro_theme_ids = $this->pro_theme_ids;
            $pro_theme_idsa = explode(':', $pro_theme_ids);
            $index = array_search($theme_id, $pro_theme_idsa);
            unset($pro_theme_idsa[$index]);
            $pro_theme_ids = implode(':', $pro_theme_idsa);
            $this->pro_theme_ids = $pro_theme_ids;
            $this->save();
        }
    }

    public function has_theme_id($theme_id)
    {
        $pro_theme_ids = $this->pro_theme_ids;
        $pro_theme_idsa = explode(':', $pro_theme_ids);
        if (in_array($theme_id, $pro_theme_idsa)) {
            return true;
        } else {
            return false;
        }
    }

    public static function insert_product($entry)
    {
        $check_insert = DB::table('nm_product')->insert($entry);

        if ($check_insert) {
            return DB::getPdo()->lastInsertId();
        } else {
            return 0;
        }

    }

    public static function get_chart_details()
    {
        $chart_count = "";
        for ($i = 1; $i <= 12; $i++) {
            $results = DB::select(DB::raw("SELECT count(*) as count FROM nm_order WHERE MONTH( `order_date` ) = " . $i));
            $chart_count .= $results[0]->count . ",";
        }
        $chart_count1 = trim($chart_count, ",");
        return $chart_count1;
    }

    public static function get_qtycod_details()
    {
        return DB::table('nm_ordercod')->where('cod_status', '=', 2)->sum('cod_qty');

    }

    public static function get_amtcod_details()
    {
        return DB::table('nm_ordercod')->where('cod_status', '=', 2)->sum('cod_amt');

    }

    public static function get_cod_details()
    {
        return DB::table('nm_ordercod')->leftjoin('nm_product', 'nm_ordercod.cod_pro_id', '=', 'nm_product.pro_id')->leftjoin('nm_member', 'nm_ordercod.cod_cus_id', '=', 'nm_member.mem_id')->leftjoin('nm_shipping', 'nm_ordercod.cod_id', '=', 'nm_shipping.ship_order_id')->leftjoin('nm_colorfixed', 'nm_ordercod.cod_pro_color', '=', 'nm_colorfixed.cf_id')->leftjoin('nm_size', 'nm_ordercod.cod_pro_size', '=', 'nm_size.si_id')->orderby('cod_date', 'desc')->get();
    }

    public static function get_qty_details()
    {
        return DB::table('nm_order')->where('order_status', '=', 2)->sum('order_qty');

    }

    public static function get_amt_details()
    {

        return DB::table('nm_order')->where('order_status', '=', 2)->sum('order_amt');

    }

    public static function get_shipping_details()
    {
        return DB::table('nm_order')->orderBy('order_date', 'desc')->leftjoin('nm_product', 'nm_order.order_pro_id', '=', 'nm_product.pro_id')->leftjoin('nm_member', 'nm_order.order_cus_id', '=', 'nm_member.mem_id')->leftjoin('nm_shipping', 'nm_order.order_id', '=', 'nm_shipping.ship_order_id')->leftjoin('nm_colorfixed', 'nm_order.order_pro_color', '=', 'nm_colorfixed.cf_id')->leftjoin('nm_size', 'nm_order.order_pro_size', '=', 'nm_size.si_id')->get();
    }

    public static function insert_product_color_details($entry)
    {
        return DB::table('nm_procolor')->insert($entry);
    }

    public static function insert_product_specification_details($entry)
    {
        return DB::table('nm_prospec')->insert($entry);
    }

    public static function insert_product_size_details($productsizeentry)
    {
        return DB::table('nm_prosize')->insert($productsizeentry);
    }

    public static function get_product($id)
    {
        return DB::table('nm_product')->where('pro_id', '=', $id)->get();
    }

    public static function get_product_specification()
    {
        return DB::table('nm_specification')->get();
    }


    public static function get_sizename_ajax($sizeid)
    {
        return DB::table('nm_size')->where('si_id', '=', $sizeid)->get();

    }

    public static function get_product_category()
    {
        return DB::table('nm_maincategory')->where('mc_status', '=', 1)->get();
    }

    public static function load_maincategory_ajax($id)
    {
        return DB::table('nm_secmaincategory')->where('smc_mc_id', '=', $id)->where('smc_status', '=', 1)->get();
    }

    public static function load_subcategory_ajax($id)
    {

        return DB::table('nm_subcategory')->where('sb_smc_id', '=', $id)->where('sb_status', '=', 1)->get();
    }

    public static function get_second_sub_category_ajax($id)
    {
        return DB::table('nm_secsubcategory')->where('ssb_sb_id', '=', $id)->where('ssb_status', '=', 1)->get();
    }

    public static function get_colorname_ajax($colorid)
    {
        return DB::table('nm_color')->where('co_id', '=', $colorid)->get();
    }

    public static function get_main_category_ajax_edit($id)
    {
        return DB::table('nm_secmaincategory')->where('smc_id', '=', $id)->get();
    }

    public static function get_sub_category_ajax_edit($id)
    {
        return DB::table('nm_subcategory')->where('sb_id', '=', $id)->get();
    }

    public static function get_second_sub_category_ajax_edit($id)
    {
        return DB::table('nm_secsubcategory')->where('ssb_id', '=', $id)->get();
    }

    public static function get_product_details()
    {
        return DB::table('nm_product')->get();
    }

    public static function block_product_status($id, $status)
    {
        return DB::table('nm_product')->where('pro_id', '=', $id)->update($status);
    }

    public static function set_product_status($id, $status)
    {
        return DB::table('nm_product')->where('pro_id', '=', $id)->update($status);
    }

    public static function get_product_view($id)
    {
        return DB::table('nm_product')->where('pro_id', '=', $id)
            ->LeftJoin('nm_store', 'nm_product.pro_sh_id', '=', 'nm_store.stor_id')
            ->LeftJoin('nm_member', 'nm_product.pro_mr_id', '=', 'nm_member.mem_id')
            ->Leftjoin('nm_maincategory', 'nm_product.pro_mc_id', '=', 'nm_maincategory.mc_id')
            ->Leftjoin('nm_secmaincategory', 'nm_product.pro_smc_id', '=', 'nm_secmaincategory.smc_id')
            ->Leftjoin('nm_subcategory', 'nm_product.pro_sb_id', '=', 'nm_subcategory.sb_id')
            ->Leftjoin('nm_secsubcategory', 'nm_product.pro_ssb_id', '=', 'nm_secsubcategory.ssb_id')
            ->get();
    }

    public static function delete_product_color($proid)
    {
        return DB::table('nm_procolor')->where('pc_pro_id', '=', $proid)->delete();
    }

    public static function delete_product_size($proid)
    {
        return DB::table('nm_prosize')->where('ps_pro_id', '=', $proid)->delete();
    }

    public static function delete_product_spec($proid)
    {
        return DB::table('nm_prospec')->where('spc_pro_id', '=', $proid)->delete();
    }

    public static function get_product_exist_specification($id)
    {
        return DB::table('nm_prospec')->where('spc_pro_id', '=', $id)->get();
    }

    public static function get_product_exist_color($id)
    {
        return DB::table('nm_procolor')->join('nm_color', 'nm_procolor.pc_co_id', '=', 'nm_color.co_id')->where('pc_pro_id', '=', $id)->get();
    }

    public static function get_product_exist_size($id)
    {
        return DB::table('nm_prosize')->where('ps_pro_id', '=', $id)->join('nm_size', 'nm_prosize.ps_si_id', '=', 'nm_size.si_id')->get();
    }

    public static function get_product_details_manage()
    {
        return DB::table('nm_product')->Leftjoin('nm_store', 'nm_product.pro_sh_id', '=', 'nm_store.stor_id')->Leftjoin('nm_city', 'nm_store.stor_city', '=', 'nm_city.ci_id')->orderby('pro_id', 'desc')->get();
    }

    public static function edit_product($entry, $id)
    {
        return DB::table('nm_product')->where('pro_id', '=', $id)->update($entry);
    }

    public static function get_merchant_details()
    {
        return DB::table('nm_member')->where('mem_logintype', Member::MEMBER_LOGIN_MERCHANT)->get();
    }

    public static function get_product_details_formerchant($merid)
    {
        return DB::table('nm_product')->where('pro_mr_id', '=', $merid)->where('pro_status', '=', 1)->get();
    }

    public static function get_active_products()
    {
        return DB::table('nm_product')->where('pro_status', '=', 1)->count();
    }

    public static function get_sold_products()
    {
        return DB::table('nm_product')->get();
    }

    public static function get_block_products()
    {
        return DB::table('nm_product')->where('pro_status', '=', 0)->count();
    }

    public static function get_today_product()
    {
        return DB::select(DB::raw("SELECT count(*) as count,sum(order_amt) as amt  from nm_order where DATEDIFF(DATE(order_date),DATE(NOW()))=0 and order_status=1"));
    }

    public static function get_7days_product()
    {
        return DB::select(DB::raw("select count(*) as count,sum(order_amt) as amt from nm_order WHERE (DATE(order_date) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)) and order_status=1"));
    }

    public static function get_30days_product()
    {
        return DB::select(DB::raw("select  count(*) as count,sum(order_amt) as amt from nm_order WHERE (DATE(order_date) >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)) and order_status=1"));
    }

    public static function get_12mnth_product()
    {
        return DB::select(DB::raw("select count(*) as count,sum(order_amt) as amt from nm_order where order_date >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH) and order_status=1"));
    }

    public static function get_zipcode()
    {
        return DB::table('nm_estimate_zipcode')->get();
    }

    public static function save_zip_code($entry)
    {
        return DB::table('nm_estimate_zipcode')->insert($entry);
    }

    public static function check_zip_code($from)
    {
        return $get_result_code = DB::table('nm_estimate_zipcode')->where('ez_code_series', '<=', $from)->where('ez_code_series_end', '>=', $from)->get();
    }

    public static function check_zip_code_range($from, $to)
    {
        return $get_result_code = DB::table('nm_estimate_zipcode')->where('ez_code_series', '>=', $from)->where('ez_code_series_end', '<=', $to)->get();

    }

    public static function edit_zip_code($id)
    {
        return DB::table('nm_estimate_zipcode')->where('ez_id', '=', $id)->get();
    }

    public static function update_zip_code($entry, $id)
    {
        return DB::table('nm_estimate_zipcode')->where('ez_id', '=', $id)->update($entry);
    }

    public static function check_zip_code_edit($id, $from)
    {
        return DB::table('nm_estimate_zipcode')->where('ez_code_series', '<=', $from)->where('ez_code_series_end', '>=', $from)->where('ez_id', '!=', $id)->get();

    }

    public static function check_zip_code_edit_range($id, $from, $to)
    {
        return $get_result_code = DB::table('nm_estimate_zipcode')->where('ez_code_series', '>=', $from)->where('ez_code_series_end', '<=', $to)->where('ez_id', '!=', $id)->get();

    }

    public static function block_zip_code($id, $status)
    {
        return DB::table('nm_estimate_zipcode')->where('ez_id', '=', $id)->update(array(
            'ez_status' => $status
        ));
    }

    public static function remove_zip_code($id)
    {
        return DB::table('nm_estimate_zipcode')->where('ez_id', '=', $id)->delete();
    }

    public static function get_induvidual_product_detail_merchant($id, $merid)
    {

        return DB::table('nm_product')->where('pro_mr_id', '=', $merid)->where('pro_id', '=', $id)->get();
    }

    public static function pending_approved_products_by_period($from_date, $to_date)
    {

        if ($from_date != '' && $to_date == '') {

            $from_date = (new DateTime($from_date))->modify('+1 day')->format('Y-m-d');

            return DB::table('nm_product')
                ->where('nm_product.created_date', '>', $from_date)
                ->where('pro_approved_status', '!=', Products::PRODUCT_STATUS_NOT_APPROVED)
                ->Leftjoin('nm_store', 'nm_product.pro_sh_id', '=', 'nm_store.stor_id')
                ->Leftjoin('nm_city', 'nm_store.stor_city', '=', 'nm_city.ci_id')
                ->orderBy('nm_product.pro_id', 'DESC')->get();

        } elseif ($from_date != '' && $to_date != '') {

            $from_date = (new DateTime($from_date))->modify('+1 day')->format('Y-m-d');
            $to_date = (new DateTime($to_date))->modify('+1 day')->format('Y-m-d');


            return DB::table('nm_product')
                ->where('pro_approved_status', '!=', Products::PRODUCT_STATUS_NOT_APPROVED)
                ->Leftjoin('nm_store', 'nm_product.pro_sh_id', '=', 'nm_store.stor_id')
                ->Leftjoin('nm_city', 'nm_store.stor_city', '=', 'nm_city.ci_id')
                ->whereBetween('nm_product.created_date', array($from_date, $to_date))
                ->orderBy('nm_product.pro_id', 'DESC')->get();
        } else {
            $to_date = (new DateTime($to_date))->modify('+1 day')->format('Y-m-d');

            //to_data exist
            return DB::table('nm_product')
                ->where('nm_product.created_date', '<', $to_date)
                ->where('pro_approved_status', '!=', Products::PRODUCT_STATUS_NOT_APPROVED)
                ->Leftjoin('nm_store', 'nm_product.pro_sh_id', '=', 'nm_store.stor_id')
                ->Leftjoin('nm_city', 'nm_store.stor_city', '=', 'nm_city.ci_id')
                ->orderBy('nm_product.pro_id', 'DESC')->get();
        }
    }

    public static function disapproved_products_by_period($from_date, $to_date)
    {

        if ($from_date != '' && $to_date == '') {

            $from_date = (new DateTime($from_date))->modify('+1 day')->format('Y-m-d');

            return DB::table('nm_product')
                ->where('pro_approved_status', Products::PRODUCT_STATUS_NOT_APPROVED)
                ->where('nm_product.created_date', '>', $from_date)
                ->Leftjoin('nm_store', 'nm_product.pro_sh_id', '=', 'nm_store.stor_id')
                ->Leftjoin('nm_city', 'nm_store.stor_city', '=', 'nm_city.ci_id')
                ->orderBy('nm_product.pro_id', 'DESC')->get();

        } elseif ($from_date != '' && $to_date != '') {

            $from_date = (new DateTime($from_date))->modify('+1 day')->format('Y-m-d');
            $to_date = (new DateTime($to_date))->modify('+1 day')->format('Y-m-d');

            return DB::table('nm_product')
                ->where('pro_approved_status', Products::PRODUCT_STATUS_NOT_APPROVED)
                ->Leftjoin('nm_store', 'nm_product.pro_sh_id', '=', 'nm_store.stor_id')
                ->Leftjoin('nm_city', 'nm_store.stor_city', '=', 'nm_city.ci_id')
                ->whereBetween('nm_product.created_date', array($from_date, $to_date))
                ->orderBy('nm_product.pro_id', 'DESC')->get();
        } else {

            $to_date = (new DateTime($to_date))->modify('+1 day')->format('Y-m-d');

            //to_data exist
            return DB::table('nm_product')
                ->where('nm_product.created_date', '<', $to_date)
                ->where('pro_approved_status', Products::PRODUCT_STATUS_NOT_APPROVED)
                ->Leftjoin('nm_store', 'nm_product.pro_sh_id', '=', 'nm_store.stor_id')
                ->Leftjoin('nm_city', 'nm_store.stor_city', '=', 'nm_city.ci_id')
                ->orderBy('nm_product.pro_id', 'DESC')->get();
        }
    }

    public static function pending_approved_products()
    {
        return DB::table('nm_product')->where('pro_approved_status', '!=', Products::PRODUCT_STATUS_NOT_APPROVED)
            ->Leftjoin('nm_store', 'nm_product.pro_sh_id', '=', 'nm_store.stor_id')->Leftjoin('nm_city', 'nm_store.stor_city', '=', 'nm_city.ci_id')
            ->orderBy('nm_product.pro_id', 'DESC')
            ->get();
    }

    public static function disapproved_products()
    {
        return DB::table('nm_product')->where('pro_approved_status', Products::PRODUCT_STATUS_NOT_APPROVED)
            ->Leftjoin('nm_store', 'nm_product.pro_sh_id', '=', 'nm_store.stor_id')->Leftjoin('nm_city', 'nm_store.stor_city', '=', 'nm_city.ci_id')
            ->orderBy('nm_product.pro_id', 'DESC')
            ->get();
    }


    public static function get_merchant_pending_approved_products($merchant_id)
    {
        return DB::table('nm_product')
            ->where('pro_approved_status', '!=', Products::PRODUCT_STATUS_NOT_APPROVED)
            ->where('pro_mr_id', $merchant_id)
            ->Leftjoin('nm_store', 'nm_product.pro_sh_id', '=', 'nm_store.stor_id')
            ->Leftjoin('nm_city', 'nm_store.stor_city', '=', 'nm_city.ci_id')
            ->orderBy('nm_product.pro_id', 'DESC')
            ->get();
    }

    public static function get_merchant_disapproved_products($merchant_id)
    {
        return DB::table('nm_product')
            ->where('pro_approved_status', Products::PRODUCT_STATUS_NOT_APPROVED)
            ->where('pro_mr_id', $merchant_id)
            ->Leftjoin('nm_store', 'nm_product.pro_sh_id', '=', 'nm_store.stor_id')
            ->Leftjoin('nm_city', 'nm_store.stor_city', '=', 'nm_city.ci_id')
            ->orderBy('nm_product.pro_id', 'DESC')
            ->get();
    }

    public static function get_merchant_pending_approved_products_by_period($from_date, $to_date, $merchant_id)
    {

        if ($from_date != '' && $to_date == '') {

            $from_date = (new DateTime($from_date))->modify('+1 day')->format('Y-m-d');

            return DB::table('nm_product')
                ->where('nm_product.pro_mr_id', '=', $merchant_id)
                ->where('nm_product.created_date', '>', $from_date)
                ->where('pro_approved_status', '!=', Products::PRODUCT_STATUS_NOT_APPROVED)
                ->LeftJoin('nm_store', 'nm_store.stor_id', '=', 'nm_product.pro_sh_id')
                ->LeftJoin('nm_city', 'nm_city.ci_id', '=', 'nm_store.stor_city')
                ->orderBy('nm_product.pro_id', 'DESC')
                ->get();
        } else if ($from_date != '' && $to_date != '') {

            $from_date = (new DateTime($from_date))->modify('+1 day')->format('Y-m-d');
            $to_date = (new DateTime($to_date))->modify('+1 day')->format('Y-m-d');

            return DB::table('nm_product')
                ->where('nm_product.pro_mr_id', '=', $merchant_id)
                ->whereBetween('nm_product.created_date', array($from_date, $to_date))
                ->where('pro_approved_status', '!=', Products::PRODUCT_STATUS_NOT_APPROVED)
                ->LeftJoin('nm_store', 'nm_store.stor_id', '=', 'nm_product.pro_sh_id')
                ->LeftJoin('nm_city', 'nm_city.ci_id', '=', 'nm_store.stor_city')
                ->orderBy('nm_product.pro_id', 'DESC')
                ->get();
        } else {
            $to_date = (new DateTime($to_date))->modify('+1 day')->format('Y-m-d');

            return DB::table('nm_product')
                ->where('nm_product.pro_mr_id', '=', $merchant_id)
                ->where('nm_product.created_date', '<', $to_date)
                ->where('pro_approved_status', '!=', Products::PRODUCT_STATUS_NOT_APPROVED)
                ->LeftJoin('nm_store', 'nm_store.stor_id', '=', 'nm_product.pro_sh_id')
                ->LeftJoin('nm_city', 'nm_city.ci_id', '=', 'nm_store.stor_city')
                ->orderBy('nm_product.pro_id', 'DESC')
                ->get();
        }
    }

    public static function get_merchant_disapproved_products_by_period($from_date, $to_date, $merchant_id)
    {
        if ($from_date != '' && $to_date == '') {
            $from_date = (new DateTime($from_date))->modify('+1 day')->format('Y-m-d');

            return DB::table('nm_product')
                ->where('nm_product.pro_mr_id', '=', $merchant_id)
                ->where('nm_product.created_date', '>', $from_date)
                ->where('pro_approved_status', Products::PRODUCT_STATUS_NOT_APPROVED)
                ->LeftJoin('nm_store', 'nm_store.stor_id', '=', 'nm_product.pro_sh_id')
                ->LeftJoin('nm_city', 'nm_city.ci_id', '=', 'nm_store.stor_city')
                ->orderBy('nm_product.pro_id', 'DESC')
                ->get();
        } else if ($from_date != '' && $to_date != '') {
            $from_date = (new DateTime($from_date))->modify('+1 day')->format('Y-m-d');
            $to_date = (new DateTime($to_date))->modify('+1 day')->format('Y-m-d');

            return DB::table('nm_product')
                ->where('nm_product.pro_mr_id', '=', $merchant_id)
                ->whereBetween('nm_product.created_date', array($from_date, $to_date))
                ->where('pro_approved_status', Products::PRODUCT_STATUS_NOT_APPROVED)
                ->LeftJoin('nm_store', 'nm_store.stor_id', '=', 'nm_product.pro_sh_id')
                ->LeftJoin('nm_city', 'nm_city.ci_id', '=', 'nm_store.stor_city')
                ->orderBy('nm_product.pro_id', 'DESC')
                ->get();
        } else {
            $to_date = (new DateTime($to_date))->modify('+1 day')->format('Y-m-d');

            return DB::table('nm_product')
                ->where('nm_product.pro_mr_id', '=', $merchant_id)
                ->where('nm_product.created_date', '<', $to_date)
                ->where('pro_approved_status', Products::PRODUCT_STATUS_NOT_APPROVED)
                ->LeftJoin('nm_store', 'nm_store.stor_id', '=', 'nm_product.pro_sh_id')
                ->LeftJoin('nm_city', 'nm_city.ci_id', '=', 'nm_store.stor_city')
                ->orderBy('nm_product.pro_id', 'DESC')
                ->get();
        }
    }


    public static function get_soldrep($from_date, $to_date)
    {

        if ($from_date != '' && $to_date == '') {

            return DB::table('nm_product')->where('created_date', '>', $from_date)->orderBy('pro_id', 'DESC')->get();

        } elseif ($from_date != '' && $to_date != '') {
            return DB::table('nm_product')->whereBetween('created_date', array(
                $from_date,
                $to_date
            ))->orderBy('pro_id', 'DESC')->get();
        } elseif ($from_date == '' && $to_date != '') {
            return DB::table('nm_product')->where('created_date', '<', $to_date)->orderBy('pro_id', 'DESC')->get();
        } else {
            return DB::table('nm_product')->orderBy('pro_id', 'DESC')->get();
        }
    }

    public static function check_store($Product_Title, $Select_Shop)
    {
        return DB::table('nm_product')->where('pro_title', '=', $Product_Title)->where('pro_sh_id', '=', $Select_Shop)->get();
    }

    public static function get_order_details()
    {
        return DB::table('nm_order')->where('order_type', '=', 1)->get();
    }

    // public static function delete_product($id)
    // {
    //     return DB::table('nm_product')->where('pro_id', '=', $id)->delete();
    // }

    public static function delete_product($id)
    {

        // To start Image delete from folder 09/11/ 
        $filename = DB::table('nm_product')->where('pro_id', $id)->first();
        $getimagename = $filename->pro_Img;
        $getextension = explode("/**/", $getimagename);
        foreach ($getextension as $imgremove) {
            File::delete(base_path('public/assets/images/product') . $imgremove);
        }
        // To End 
        return DB::table('nm_product')->where('pro_id', '=', $id)->delete();

    }


    //Product Review manage

    public static function get_customer_comment_review($product_id)
    {
        return DB::table('nm_review')->where('product_id', $product_id)->Leftjoin('nm_product', 'nm_review.product_id', '=', 'nm_product.pro_id')->Leftjoin('nm_member', 'nm_review.customer_id', '=', 'nm_member.mem_id')->get();
    }

    public static function get_product_review()
    {
        return DB::table('nm_review')->Leftjoin('nm_product', 'nm_review.product_id', '=', 'nm_product.pro_id')->Leftjoin('nm_member', 'nm_review.customer_id', '=', 'nm_member.mem_id')->where('nm_review.product_id', '!=', 'NULL')->get();
    }

    public static function edit_review($id)
    {
        return DB::table('nm_review')->where('comment_id', '=', $id)->get();
    }

    public static function update_review($entry, $id)
    {
        return DB::table('nm_review')->where('comment_id', '=', $id)->update($entry);
    }

    public static function delete_review($id)
    {
        return DB::table('nm_review')->where('comment_id', '=', $id)->delete();
    }

    public static function block_review_status($id, $status)
    {
        return DB::table('nm_review')->where('comment_id', '=', $id)->update($status);
    }

    public static function used_theme($id)
    {
        $current_theme = DB::table('nm_product')->where('pro_id', '=', $id)->get(array('pro_theme_ids'));
        $pro_theme_ids = $current_theme[0]->pro_theme_ids; //null or string
        if ($pro_theme_ids) {
            $ptids = explode(':', $pro_theme_ids);

            $pts = DB::table('nm_theme')->whereIn('theme_id', $ptids)->where('theme_status', '=', 1)->get(array('theme_id', 'theme_name', 'theme_banner_img', 'parent_theme'));

            return $pts;

        } else {
            return null;
        }

    }


    public static function not_used_theme($id)
    {
        $current_theme = DB::table('nm_product')->where('pro_id', '=', $id)->get(array('pro_theme_ids'));
        $pro_theme_ids = $current_theme[0]->pro_theme_ids; //null or string
        if ($pro_theme_ids) {
            $ptids = explode(':', $pro_theme_ids);

            $pts = DB::table('nm_theme')->whereNotIn('theme_id', $ptids)->where('theme_status', '=', 1)->get(array('theme_id', 'theme_name'));

            return $pts;

        } else {
            //all theme is not used
            return DB::table('nm_theme')->where('theme_status', '=', 1)->get(array('theme_id', 'theme_name'));
        }

    }

    public static function check_exist_in_cart($cart_id)
    {
        $max = count($_SESSION['cart']);
        for ($i = 0; $i < $max; $i++) {
            if ($cart_id == $_SESSION['cart'][$i]['productid']) {
                return 1;
            }
        }
        return 0;
    }


    public static function increase_product_quantity_in_cart($cart_id, $cart_qty)
    {
        $max = count($_SESSION['cart']);
        for ($i = 0; $i < $max; $i++) {
            if ($cart_id == $_SESSION['cart'][$i]['productid']) {
                $_SESSION['cart'][$i]['qty'] = $_SESSION['cart'][$i]['qty'] + $cart_qty;
                break;
            }
        }
        return;
    }

    public static function get_present_products()
    {
        return DB::table('nm_product')->where('pro_status', Products::PRODUCT_STATUS_ACTIVATED)
            ->where('pro_approved_status', Products::PRODUCT_STATUS_APPROVED)
            ->where('pro_present', 1)->limit(2)->get();
    }
}

?>
