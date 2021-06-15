<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
class Fund extends Model
{
    protected $guarded = array('id');
    protected $table = 'nm_deals';
    
    public static function deal_no_count($id)
    {
        return DB::table('nm_deals')->where('deal_merchant_id', '=', $id)->sum('deal_no_of_purchase');
    }
    
    public static function deal_discount_count($id)
    {
        return DB::table('nm_deals')->where('deal_merchant_id', '=', $id)->sum('deal_discount_price');
    }
    
    public static function product_no_count($id)
    {
        return DB::table('nm_product')->where('pro_mr_id', '=', $id)->sum('pro_no_of_purchase');
    }
    
    public static function product_discount_count($id)
    {
        return DB::table('nm_product')->where('pro_mr_id', '=', $id)->sum('pro_price');
    }

    public static function commison_amt($id)
    {
        return DB::table('nm_member')->where('mem_id', '=', $id)->get();
    }

    public static function check_withdraw($id)
    {
        return DB::table('nm_withdraw_request')->where('wd_mem_id', '=', $id)->get();
    }

    public static function save_withdraw($entry)
    {
        return DB::table('nm_withdraw_request')->insert($entry);
    }

    public static function update_withdraw($entry, $id)
    {
        return DB::table('nm_withdraw_request')->where('wd_mem_id', $id)->update($entry);
    }

    public static function paid_amt($merid)
    {
        return DB::select(DB::raw("SELECT sum(wr_paid_amount) as paid_amt FROM `nm_withdraw_request_paypal` WHERE wr_mem_id=$merid"));
    }

    public static function get_fund_transaction_details($merid)
    {
        return DB::table('nm_withdraw_request_paypal')->where('wr_mem_id', $merid)->get();
    }
}

?>
