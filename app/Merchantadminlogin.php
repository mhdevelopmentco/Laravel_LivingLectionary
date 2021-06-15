<?php
namespace App;
use DB;
use Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class Merchantadminlogin extends Model
{
    protected $guarded = array('id');
    protected $table = 'nm_admin';
    
    public static function login_check($uname, $password)
    {
        $check = DB::table('nm_admin')->where('adm_fname', '=', $uname)->where('adm_password', '=', $password)->get();
        if ($check) {
            Session::put('userid', $check[0]->adm_id);
            Session::put('username', $check[0]->adm_fname);
            return 1;
            
        } else {
            return 0;
        }
    }

    public static function forgot_check($email)
    {
        $check = DB::table('nm_admin')->where('adm_email', '=', $email)->get();
        if ($check) {
            return 1;
            
        } else {
            return 0;
        }
    }

    public static function forgot_check_details($email)
    {
        return DB::table('nm_admin')->where('adm_email', '=', $email)->get();
        
    }

    public static function forgot_check_details_merchant($email)
    {
        return DB::table('nm_member')->where('mem_email', '=', $email)->get();
        
    }

    public static function checkmerchantlogin($uname, $pwd)
    {
        $check = DB::table('nm_member')
            ->where(function($query) use ($uname){
                $query->where('mem_email', '=', $uname);
                $query->orwhere('mem_userid', '=', $uname);
            }) ->where('mem_password', '=', $pwd)
            ->where('mem_logintype', Member::MEMBER_LOGIN_MERCHANT)->where('mem_status', 1)->get();

        if (count($check)>0) {
            $merchant = $check[0];
            Session::put('merchantid', $merchant->mem_id);
            Session::put('merchantname', $merchant->mem_fname.' '.$merchant->mem_lname);
            return 1;
        } else {
            return 0;
        }
    }

    public static function checkvalidemail($email)
    {
        return DB::table('nm_member')->where('mem_email', '=', $email)->get();
        
    }
    
    public static function get_merchant_details($merchat_decode_email)
    {
        
        return DB::table('nm_member')->where('mem_email', '=', $merchat_decode_email)->get();
    }
    
    public static function update_newpwd($mem_id, $confirmpwd)
    {
        return DB::table('nm_member')->where('mem_id', '=', $mem_id)->update(array(
            'mem_password' => $confirmpwd
        ));
        
    }
    
}

?>
