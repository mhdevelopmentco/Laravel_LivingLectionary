<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
class Cms extends Model
{
    
    protected $guarded = array('id');
    protected $table = 'nm_cms_pages';
    
    public static function add_cms_page($entry)
    {
        return DB::table('nm_cms_pages')->insert($entry);
    }

    public static function check_cms_page($title)
    {
        return DB::table('nm_cms_pages')->where('cp_title', '=', $title)->get();
    }
    
    public static function get_cms_page()
    {
        return DB::table('nm_cms_pages')->orderBy('cp_title', 'asc')->get();
    }
    
    public static function getsingle_cms_page($id)
    {
        return DB::table('nm_cms_pages')->where('cp_id', '=', $id)->get();
    }
    
    
    public static function update_cms_page($id, $entry)
    {
        return DB::table('nm_cms_pages')->where('cp_id', '=', $id)->update($entry);
    }
    
    public static function check_cms_page_update($id, $title)
    {
        return DB::table('nm_cms_pages')->where('cp_title', '=', $title)->where('cp_id', '!=', $id)->get();
        
    }
    
    public static function block_cms_page($id, $status)
    {
        return DB::table('nm_cms_pages')->where('cp_id', '=', $id)->update($status);
    }
    
    public static function delete_cms_page($id)
    {
        return DB::table('nm_cms_pages')->where('cp_id', '=', $id)->delete();
    }

    public static function get_aboutus_page()
    {
        return DB::table('nm_aboutus')->where('ap_id', '=', 1)->get();
    }

    public static function get_terms_page()
    {
        return DB::table('nm_terms')->where('tr_id', '=', 1)->get();
    }

    public static function get_privacy_page()
    {
        return DB::table('nm_privacy')->where('id', '=', 1)->get();
    }
    
    public static function update_aboutus_page($update)
    {
        $count = count(DB::table('nm_aboutus')->where('ap_id', 1)->get());
        if($count == 0)
            DB::table('nm_aboutus')->insert($update);
        else
            DB::table('nm_aboutus')->where('ap_id', 1)->update($update);
    }

    public static function update_terms_page($update)
    {
        DB::table('nm_terms')->where('tr_id', 1)->update($update);
    }

    public static function update_privacy_page($update)
    {
        DB::table('nm_privacy')->where('id', 1)->update($update);
    }
    
}

?>
