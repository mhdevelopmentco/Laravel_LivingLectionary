<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
class State extends Model
{
    protected $guarded = array('id');
    protected $table = 'nm_state';
    protected $primaryKey ='st_id';

    public static function view_state_detail()
    {
        return DB::table('nm_state')->leftJoin('nm_country', 'nm_country.co_id', '=', 'nm_state.st_con_id')->OrderBy('st_con_id')->get();
    }

    public static function view_country_details()
    {
        return DB::table('nm_country')->get();
    }

    public static function show_state_detail($id)
    {
        return DB::table('nm_state')->where('st_id', '=', $id)->get();
    }

    public static function delete_state_detail($id)
    {
        return DB::table('nm_state')->where('st_id', '=', $id)->delete();
    }

    public static function update_state_detail($id, $entry)
    {
        return DB::table('nm_state')->where('st_id', '=', $id)->update($entry);
    }
    
    public static function save_state_detail($entry)
    {
        return DB::table('nm_state')->insert($entry);
    }

    public static function status_state($id, $status)
    {
        return DB::table('nm_state')->where('st_id', '=', $id)->update(array('st_status' => $status));
        
    }

    public static  function select_states_by_country($co_id)
    {
        return DB::table('nm_state')->where('st_con_id', '=', $co_id)->where('st_status', 1)->get();
    }

    public static function check_exist_state_name($name, $ccode)
    {
        return DB::table('nm_state')->where('st_con_id', '=', $ccode)->where('st_name', '=', $name)->get();
        
    }

    public static function update_default_state_submit($id, $entry)
    {
        return DB::table('nm_state')->where('st_id', '=', $id)->update($entry);
        
    }

    public static function update_default_state_submit1($entry)
    {
        return DB::table('nm_state')->update($entry);
        
    }
}

?>
