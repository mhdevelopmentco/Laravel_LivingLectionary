<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class Attributes extends Model
{
    protected $guarded = array('id');
    protected $table = 'nm_size';
    
    public static function save_size($sizes)
    {
        return DB::table('nm_size')->insert($sizes);
    }
    
    public static function get_size()
    {
        return DB::table('nm_size')->get();
    }
    
    public static function delete_size($id)
    {
        return DB::table('nm_size')->where('si_id', '=', $id)->delete();
    }
    
    public static function edit_size($id)
    {
        return DB::table('nm_size')->where('si_id', '=', $id)->get();
    }
    
    public static function update_size($id, $entry)
    {
        return DB::table('nm_size')->where('si_id', '=', $id)->update($entry);
    }
    
    public static function check_size($name)
    {
        return DB::table('nm_size')->where('si_name', '=', $name)->get();
    }
    public static function add_color($sizes)
    {
        return DB::table('nm_color')->insert($sizes);
    }
    
    public static function color_list()
    {
        return DB::table('nm_colorfixed')->get();
    }

    public static function color_added_list()
    {
        return DB::table('nm_color')->get();
    }

    public static function edit_color($id)
    {
        return DB::table('nm_color')->where('co_id', '=', $id)->get();
    }

    public static function update_color($id, $entry)
    {
        return DB::table('nm_color')->where('co_id', '=', $id)->update($entry);
    }

    public static function deletecolor_submit($id)
    {
        return DB::table('nm_color')->where('co_id', '=', $id)->delete();
    }

    public static function selected_color_list($id)
    {
        return DB::table('nm_colorfixed')->where('cf_code', '=', $id)->get();
    }

}
?>