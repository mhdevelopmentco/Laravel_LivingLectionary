<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
class MerchantTransactions extends Model
{
    protected $guarded = array('id');
    protected $table = 'nm_order_auction';
    
    public static function getproduct_all_orders($productlist)
    {
        return DB::table('nm_order')->orderBy('order_date', 'desc')->leftjoin('nm_member', 'nm_order.order_cus_id', '=', 'nm_member.mem_id')->leftjoin('nm_product', 'nm_order.order_pro_id', '=', 'nm_product.pro_id')->where('nm_order.order_type', '=', 1)->whereIn('nm_order.order_pro_id', array(
            $productlist
        ))->get();
        
    }

    public static function getproduct_success_orders($productlist)
    {
        return DB::table('nm_order')->orderBy('order_date', 'desc')->leftjoin('nm_member', 'nm_order.order_cus_id', '=', 'nm_member.mem_id')->leftjoin('nm_product', 'nm_order.order_pro_id', '=', 'nm_product.pro_id')->where('nm_order.order_status', '=', 1)->where('nm_order.order_type', '=', 1)->whereIn('nm_order.order_pro_id', array(
            $productlist
        ))->get();
        
    }

    public static function getproduct_completed_orders($productlist)
    {
        return DB::table('nm_order')->orderBy('order_date', 'desc')->leftjoin('nm_member', 'nm_order.order_cus_id', '=', 'nm_member.mem_id')->leftjoin('nm_product', 'nm_order.order_pro_id', '=', 'nm_product.pro_id')->where('nm_order.order_status', '=', 2)->where('nm_order.order_type', '=', 1)->whereIn('nm_order.order_pro_id', array(
            $productlist
        ))->get();
        
    }

    public static function getproduct_hold_orders($productlist)
    {
        return DB::table('nm_order')->orderBy('order_date', 'desc')->leftjoin('nm_member', 'nm_order.order_cus_id', '=', 'nm_member.mem_id')->leftjoin('nm_product', 'nm_order.order_pro_id', '=', 'nm_product.pro_id')->where('nm_order.order_status', '=', 3)->where('nm_order.order_type', '=', 1)->whereIn('nm_order.order_pro_id', array(
            $productlist
        ))->get();
        
    }
    

    public static function get_producttransaction()
    {
        return DB::table('nm_order')->where('order_type', '=', 1)->count();
        
    }


    public static function get_producttoday_order()
    {
        return DB::select(DB::raw("SELECT count(order_id) as count,sum(order_amt) as amt  from nm_order where order_type=1 and DATEDIFF(DATE(order_date),DATE(NOW()))=0"));
        
    }

    public static function get_product7days_order()
    {
        return DB::select(DB::raw("select count(order_id) as count,sum(order_amt) as amt from nm_order WHERE order_type=1 and (DATE(order_date) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY))"));
    }

    public static function get_product30days_order()
    {
        return DB::select(DB::raw("select  count(order_id) as count,sum(order_amt) as amt from nm_order WHERE order_type=1 and (DATE(order_date) >= DATE_SUB(CURDATE(), INTERVAL 30 DAY))"));
    }

    public static function get_chart_product_details($productlist)
    {
        $chart_count = "";
        for ($i = 1; $i <= 12; $i++) {
            $results = DB::select(DB::raw("SELECT count(*) as count FROM nm_order WHERE order_pro_id in($productlist) and order_type=1 and MONTH( `order_date` ) = " . $i));
            $chart_count .= $results[0]->count . ",";
        }
        $chart_count1 = trim($chart_count, ",");
        return $chart_count1;
    }

    public static function alltrans_reports($from_date, $to_date, $productlist)
    {
        
        if ($from_date != '' && $to_date == '') {
            
            return DB::table('nm_order')->orderBy('order_date', 'desc')->leftjoin('nm_member', 'nm_order.order_cus_id', '=', 'nm_member.mem_id')->leftjoin('nm_product', 'nm_order.order_pro_id', '=', 'nm_product.pro_id')->where('nm_order.order_type', '=', 1)->whereIn('nm_order.order_pro_id', array(
                $productlist
            ))->where('nm_order.created_date', $from_date)->get();
            
        }
        
        elseif ($from_date != '' && $to_date != '') {
            return DB::table('nm_order')->orderBy('order_date', 'desc')->leftjoin('nm_member', 'nm_order.order_cus_id', '=', 'nm_member.mem_id')->leftjoin('nm_product', 'nm_order.order_pro_id', '=', 'nm_product.pro_id')->where('nm_order.order_type', '=', 1)->whereIn('nm_order.order_pro_id', array(
                $productlist
            ))->whereBetween('nm_order.created_date', array(
                $from_date,
                $to_date
            ))->get();
        } else {
            
        }
        
    }
    
    
    public static function allsucessprod_reports($from_date, $to_date, $productlist)
    {
        
        if ($from_date != '' && $to_date == '') {
            
            return DB::table('nm_order')->orderBy('order_date', 'desc')->leftjoin('nm_member', 'nm_order.order_cus_id', '=', 'nm_member.mem_id')->leftjoin('nm_product', 'nm_order.order_pro_id', '=', 'nm_product.pro_id')->where('nm_order.order_status', '=', 1)->where('nm_order.order_type', '=', 1)->where('nm_order.created_date', $from_date)->whereIn('nm_order.order_pro_id', array(
                $productlist
            ))->get();
            
        }
        
        elseif ($from_date != '' && $to_date != '') {
            
            return DB::table('nm_order')->orderBy('order_date', 'desc')->leftjoin('nm_member', 'nm_order.order_cus_id', '=', 'nm_member.mem_id')->leftjoin('nm_product', 'nm_order.order_pro_id', '=', 'nm_product.pro_id')->where('nm_order.order_status', '=', 1)->where('nm_order.order_type', '=', 1)->whereBetween('nm_order.created_date', array(
                $from_date,
                $to_date
            ))->whereIn('nm_order.order_pro_id', array(
                $productlist
            ))->get();
            
            
        } else {
            
        }
        
    }
    
    public static function allcompletedprod_reports($from_date, $to_date, $productlist)
    {
        
        if ($from_date != '' && $to_date == '') {
            
            return DB::table('nm_order')->orderBy('order_date', 'desc')->leftjoin('nm_member', 'nm_order.order_cus_id', '=', 'nm_member.mem_id')->leftjoin('nm_product', 'nm_order.order_pro_id', '=', 'nm_product.pro_id')->where('nm_order.order_status', '=', 2)->where('nm_order.order_type', '=', 1)->where('nm_order.created_date', $from_date)->whereIn('nm_order.order_pro_id', array(
                $productlist
            ))->get();
            
        }
        
        elseif ($from_date != '' && $to_date != '') {
            
            return DB::table('nm_order')->orderBy('order_date', 'desc')->leftjoin('nm_member', 'nm_order.order_cus_id', '=', 'nm_member.mem_id')->leftjoin('nm_product', 'nm_order.order_pro_id', '=', 'nm_product.pro_id')->where('nm_order.order_status', '=', 2)->where('nm_order.order_type', '=', 1)->whereBetween('nm_order.created_date', array(
                $from_date,
                $to_date
            ))->whereIn('nm_order.order_pro_id', array(
                $productlist
            ))->get();
            
        } else {
            
        }
        
    }
    
    
    public static function allholdprod_reports($from_date, $to_date, $productlist)
    {
        
        if ($from_date != '' && $to_date == '') {
            
            
            return DB::table('nm_order')->orderBy('order_date', 'desc')->leftjoin('nm_member', 'nm_order.order_cus_id', '=', 'nm_member.mem_id')->leftjoin('nm_product', 'nm_order.order_pro_id', '=', 'nm_product.pro_id')->where('nm_order.order_status', '=', 3)->where('nm_order.order_type', '=', 1)->where('nm_order.created_date', $from_date)->whereIn('nm_order.order_pro_id', array(
                $productlist
            ))->get();
            
            
        }
        
        elseif ($from_date != '' && $to_date != '') {
            
            return DB::table('nm_order')->orderBy('order_date', 'desc')->leftjoin('nm_member', 'nm_order.order_cus_id', '=', 'nm_member.mem_id')->leftjoin('nm_product', 'nm_order.order_pro_id', '=', 'nm_product.pro_id')->where('nm_order.order_status', '=', 3)->where('nm_order.order_type', '=', 1)->whereBetween('nm_order.created_date', array(
                $from_date,
                $to_date
            ))->whereIn('nm_order.order_pro_id', array(
                $productlist
            ))->get();
            
        } else {
            
        }
        
    }
    
    public static function allfailedprod_reports($from_date, $to_date, $productlist)
    {
        
        if ($from_date != '' && $to_date == '') {
            return DB::table('nm_order')->orderBy('order_date', 'desc')->leftjoin('nm_member', 'nm_order.order_cus_id', '=', 'nm_member.mem_id')->leftjoin('nm_product', 'nm_order.order_pro_id', '=', 'nm_product.pro_id')->where('nm_order.order_status', '=', 4)->where('nm_order.order_type', '=', 1)->where('nm_order.created_date', $from_date)->whereIn('nm_order.order_pro_id', array(
                $productlist
            ))->get();
            
        }
        
        elseif ($from_date != '' && $to_date != '') {
            
            
            return DB::table('nm_order')->orderBy('order_date', 'desc')->leftjoin('nm_member', 'nm_order.order_cus_id', '=', 'nm_member.mem_id')->leftjoin('nm_product', 'nm_order.order_pro_id', '=', 'nm_product.pro_id')->where('nm_order.order_status', '=', 4)->where('nm_order.order_type', '=', 1)->whereBetween('nm_order.created_date', array(
                $from_date,
                $to_date
            ))->whereIn('nm_order.order_pro_id', array(
                $productlist
            ))->get();
            
        } else {
            
        }
        
    }
    
    public static function allpro_codcompleted_reports($from_date, $to_date, $productlist)
    {
        
        if ($from_date != '' && $to_date == '') {
            
            return DB::table('nm_ordercod')->orderBy('cod_date', 'desc')->leftjoin('nm_member', 'nm_ordercod.cod_cus_id', '=', 'nm_member.mem_id')->leftjoin('nm_product', 'nm_ordercod.cod_pro_id', '=', 'nm_product.pro_id')->where('nm_ordercod.cod_status', '=', 2)->where('nm_ordercod.cod_order_type', '=', 1)->where('nm_ordercod.created_date', $from_date)->whereIn('nm_ordercod.cod_pro_id', array(
                $productlist
            ))->get();
            
        }
        
        elseif ($from_date != '' && $to_date != '') {
            
            return DB::table('nm_ordercod')->orderBy('cod_date', 'desc')->leftjoin('nm_member', 'nm_ordercod.cod_cus_id', '=', 'nm_member.mem_id')->leftjoin('nm_product', 'nm_ordercod.cod_pro_id', '=', 'nm_product.pro_id')->where('nm_ordercod.cod_status', '=', 2)->where('nm_ordercod.cod_order_type', '=', 1)->whereBetween('nm_ordercod.created_date', array(
                $from_date,
                $to_date
            ))->whereIn('nm_ordercod.cod_pro_id', array(
                $productlist
            ))->get();
            
            
        } else {
            
        }
        
    }
    
    public static function allprod_codreports($from_date, $to_date, $productlist)
    {
        
        if ($from_date != '' && $to_date == '') {
            
            
            return DB::table('nm_ordercod')->orderBy('cod_date', 'desc')->leftjoin('nm_member', 'nm_ordercod.cod_cus_id', '=', 'nm_member.mem_id')->leftjoin('nm_product', 'nm_ordercod.cod_pro_id', '=', 'nm_product.pro_id')->where('nm_ordercod.cod_order_type', '=', 1)->where('nm_ordercod.created_date', $from_date)->whereIn('nm_ordercod.cod_pro_id', array(
                $productlist
            ))->get();
            
            
        }
        
        elseif ($from_date != '' && $to_date != '') {
            
            return DB::table('nm_ordercod')->orderBy('cod_date', 'desc')->leftjoin('nm_member', 'nm_ordercod.cod_cus_id', '=', 'nm_member.mem_id')->leftjoin('nm_product', 'nm_ordercod.cod_pro_id', '=', 'nm_product.pro_id')->where('nm_ordercod.cod_order_type', '=', 1)->whereBetween('nm_ordercod.created_date', array(
                $from_date,
                $to_date
            ))->whereIn('nm_ordercod.cod_pro_id', array(
                $productlist
            ))->get();
            
            
        } else {
            
        }
        
    }

    public static function allprod_holdreports($from_date, $to_date, $productlist)
    {
        
        if ($from_date != '' && $to_date == '') {
            
            return DB::table('nm_ordercod')->orderBy('cod_date', 'desc')->leftjoin('nm_member', 'nm_ordercod.cod_cus_id', '=', 'nm_member.mem_id')->leftjoin('nm_product', 'nm_ordercod.cod_pro_id', '=', 'nm_product.pro_id')->where('nm_ordercod.cod_status', '=', 3)->where('nm_ordercod.cod_order_type', '=', 1)->where('nm_ordercod.created_date', $from_date)->whereIn('nm_ordercod.cod_pro_id', array(
                $productlist
            ))->get();
            
        }
        
        elseif ($from_date != '' && $to_date != '') {
         
            return DB::table('nm_ordercod')->orderBy('cod_date', 'desc')->leftjoin('nm_member', 'nm_ordercod.cod_cus_id', '=', 'nm_member.mem_id')->leftjoin('nm_product', 'nm_ordercod.cod_pro_id', '=', 'nm_product.pro_id')->where('nm_ordercod.cod_status', '=', 3)->where('nm_ordercod.cod_order_type', '=', 1)->whereBetween('nm_ordercod.created_date', array(
                $from_date,
                $to_date
            ))->whereIn('nm_ordercod.cod_pro_id', array(
                $productlist
            ))->get();
            
            
        } else {
            
        }
        
    }
    
    
    public static function allprod_failedreports($from_date, $to_date, $productlist)
    {
        
        if ($from_date != '' && $to_date == '') {
            
            
            return DB::table('nm_ordercod')->orderBy('cod_date', 'desc')->leftjoin('nm_member', 'nm_ordercod.cod_cus_id', '=', 'nm_member.mem_id')->leftjoin('nm_product', 'nm_ordercod.cod_pro_id', '=', 'nm_product.pro_id')->where('nm_ordercod.cod_status', '=', 4)->where('nm_ordercod.cod_order_type', '=', 1)->where('nm_ordercod.created_date', $from_date)->whereIn('nm_ordercod.cod_pro_id', array(
                $productlist
            ))->get();
        }
        
        elseif ($from_date != '' && $to_date != '') {
            
            return DB::table('nm_ordercod')->orderBy('cod_date', 'desc')->leftjoin('nm_member', 'nm_ordercod.cod_cus_id', '=', 'nm_member.mem_id')->leftjoin('nm_product', 'nm_ordercod.cod_pro_id', '=', 'nm_product.pro_id')->where('nm_ordercod.cod_status', '=', 4)->where('nm_ordercod.cod_order_type', '=', 1)->whereBetween('nm_ordercod.created_date', array(
                $from_date,
                $to_date
            ))->whereIn('nm_ordercod.cod_pro_id', array(
                $productlist
            ))->get();
            
        } else {
            
        }
        
    }
}

?>
