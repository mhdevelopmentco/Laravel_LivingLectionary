<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
class Specification extends Model
{
    protected $guarded = array('id');
    protected $table = 'nm_specification';
    
    public static function viewjoin_specification_detail()
    {
        return DB::table('nm_specification')->join('nm_spgroup', 'nm_specification.sp_spg_id', '=', 'nm_spgroup.spg_id')->orderBy('nm_specification.sp_order', 'asc')->get();
    }

    public static function view_specification_detail()
    {
        return DB::table('nm_specification')->get();
    }

    public static function showindividual_specification_detail($id)
    {
        return DB::table('nm_specification')->where('sp_id', '=', $id)->get();
    }

    public static function delete_specification_detail($id)
    {
        return DB::table('nm_specification')->where('sp_id', '=', $id)->delete();
    }

    public static function update_specification_detail($id, $entry)
    {
        return DB::table('nm_specification')->where('sp_id', '=', $id)->update($entry);
    }
    
    public static function save_specification_detail($entry)
    {
        return DB::table('nm_specification')->insert($entry);
    }
    
    public static function save_specification_group($entry)
    {
        return DB::table('nm_spgroup')->insert($entry);
    }
    
    public static function check_exist_individual($name, $groupid)
    {
        return DB::table('nm_specification')->where('sp_name', '=', $name)->where('sp_spg_id', '=', $groupid)->get();
    }

    public static function check_exist_update($name, $groupid, $id)
    {
        return DB::table('nm_specification')->where('sp_name', '=', $name)->where('sp_spg_id', '=', $groupid)->where('sp_id', '!=', $id)->get();
    }

    public static function check_exist_individualorder($order, $groupid)
    {
        return DB::table('nm_specification')->where('sp_order', '=', $order)->where('sp_spg_id', '=', $groupid)->get();
    }

    public static function check_exist_individualorder_update($order, $groupid, $id)
    {
        return DB::table('nm_specification')->where('sp_order', '=', $order)->where('sp_spg_id', '=', $groupid)->where('sp_id', '!=', $id)->get();
    }

    public static function check_exist_group($name)
    {
        return DB::table('nm_spgroup')->where('spg_name', '=', $name)->get();
    }
    
    public static function check_exist_order($order)
    {
        return DB::table('nm_spgroup')->where('spg_order', '=', $order)->get();
    }
    
    public static function check_exist_group_update($name, $id)
    {
        return DB::table('nm_spgroup')->where('spg_name', '=', $name)->where('spg_id', '!=', $id)->get();
    }
    
    public static function check_exist_order_update($order, $id)
    {
        return DB::table('nm_spgroup')->where('spg_order', '=', $order)->where('spg_id', '!=', $id)->get();
    }
    
    public static function get_specification_group()
    {
        return DB::table('nm_spgroup')->orderBy('spg_order', 'asc')->get();
    }

    public static function showindividual_specification_group_detail($id)
    {
        return DB::table('nm_spgroup')->where('spg_id', '=', $id)->get();
    }
    
    public static function update_specification_group($id, $entry)
    {
        return DB::table('nm_spgroup')->where('spg_id', '=', $id)->update($entry);
    }
    
    public static function delete_specification_group_detail($id)
    {
        return DB::table('nm_spgroup')->where('spg_id', '=', $id)->delete();
    }
}
?>
