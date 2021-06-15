<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class PaymentInfo extends Model
{
    protected $table = 'nm_payment_info';
    protected $timestamp = false;

    public static function insert_payment_info($entry)
    {
        return DB::table('nm_payment_info')->insert($entry);
    }

    public static function update_payment_info($id, $entry)
    {
        return DB::table('nm_payment_info')->where('id', $id)->update($entry);
    }

    public static function get_payment_info($id)
    {
        return DB::table('nm_payment_info')->where('id', $id)->get();
    }

    public static function get_payment_info_with_memberid($mem_id)
    {
        return DB::table('nm_payment_info')->where('member_id', $mem_id)->get();
    }

}

?>
