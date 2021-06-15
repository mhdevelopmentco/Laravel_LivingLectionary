<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
class Country extends Model
{
    protected $guarded = array('id');
    protected $table = 'nm_country';
    protected  $primaryKey = 'co_id';

    public static function get_country_list()
    {
        return DB::table('nm_country')->where('co_status', '=', '1')->get();
    }
    
    public static function view_country_detail()
    {
        return DB::table('nm_country')->get();
    }

    public static function check_exist_country_name($countryname)
    {
        return DB::table('nm_country')->where('co_name', '=', $countryname)->get();
    }

    public static function check_exist_country_code($countrycode)
    {
        return DB::table('nm_country')->where('co_code', '=', $countrycode)->get();
    }

    public static function check_exist_country_name_update($countryname, $id)
    {
        return DB::table('nm_country')->where('co_name', '=', $countryname)->where('co_id', '!=', $id)->get();
    }

    public static function check_exist_country_code_update($countrycode, $id)
    {
        return DB::table('nm_country')->where('co_code', '=', $countrycode)->where('co_id', '!=', $id)->get();
    }

    public static function showindividual_country_detail($id)
    {
        return DB::table('nm_country')->where('co_id', '=', $id)->get();
    }

    public static function delete_country_detail($id)
    {
        return DB::table('nm_country')->where('co_id', '=', $id)->delete();
    }

    public static function update_country_detail($id, $entry)
    {
        return DB::table('nm_country')->where('co_id', '=', $id)->update($entry);
    }
    
    public static function save_country_detail($entry)
    {
        return DB::table('nm_country')->insert($entry);
    }

    public static function update_status_country($id, $status)
    {
        return DB::table('nm_country')->where('co_id', '=', $id)->update(array('co_status' => $status));
    }

    public static function update_default_country($id, $entry)
    {
        return DB::table('nm_country')->where('co_id', '=', $id)->update($entry);
    }

    public static function update_default_country_before($entry)
    {
        return DB::table('nm_country')->where('co_id', '>', 0)->update($entry);
    }

}

?>
