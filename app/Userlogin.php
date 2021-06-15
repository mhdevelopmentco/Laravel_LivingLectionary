<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
class Userlogin extends Model
{
    protected $guarded = array('id');
    protected $table = 'nm_member';
    
    public static function check_user($pwd, $email)
    {
        return DB::table('nm_member')->where(function($query) use ($email) {
            $query->where('mem_email', '=', $email);
            $query->orwhere('mem_userid', '=', $email);
        })->where('mem_password', '=', $pwd)->where('mem_status', '=', 1)->get();
    }

    public static function forgot_check_details_user($email)
    {
        return DB::table('nm_member')->where('mem_email', '=', $email)->get();
    }

    public static function checkvalidemail($email)
    {
        return DB::table('nm_member')->where('mem_email', '=', $email)->get();
    }

    public static function save_log($entry)
    {
        return DB::table('nm_login')->insert($entry);
    }

    public static function get_member_details($customer_decode_email)
    {
        return DB::table('nm_member')->where('mem_email', '=', $customer_decode_email)->get();
    }
    
}

?>
