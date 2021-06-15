<?php
namespace App;
use DB;
use Session;
use File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class Admodel extends Model
{
    protected $guarded = array('id');
    protected $table = 'nm_add';
    
    public static function save_ad($entry)
    {
        return DB::table('nm_add')->insert($entry);
    }
    
    public static function update_ad_msgstatus()
    {
        return DB::table('nm_add')->update(array(
            'ad_read_status' => 1
        ));
    }

    public static function get_msgcount()
    {
        return DB::table('nm_add')->where('ad_read_status', '=', 0)->count();
    }

    public static function check_exist_ad_title($adtitle)
    {
        return DB::table('nm_add')->where('ad_name', '=', $adtitle)->get();
    }

    public static function check_exist_ad_title_update($adtitle, $id)
    {
        return DB::table('nm_add')->where('ad_name', '=', $adtitle)->where('ad_id', '!=', $id)->get();
    }

    public static function view_ad_list()
    {
        return DB::table('nm_add')->get();
    }

    public static function ad_detail($id)
    {
        return DB::table('nm_add')->where('ad_id', '=', $id)->get();
    }

    // public static function delete_ad($id)
    // {
    //     return DB::table('nm_add')->where('ad_id', '=', $id)->delete();
    // }

    public static function delete_ad($id)
    {
        
        // To start Image delete from folder 09/11/ 
        $filename = DB::table('nm_add')->where('ad_id', '=', $id)->first();
        $getimagename= $filename->ad_image;
        $getextension=explode("/**/",$getimagename);
        foreach($getextension as $imgremove)
        {
            File::delete(base_path('assets/adimage/').$imgremove);
        } 
        // To End 
        return DB::table('nm_add')->where('ad_id', '=', $id)->delete();
        
    }
    
    public static function update_ad_detail($entry, $id)
    {
        return DB::table('nm_add')->where('ad_id', '=', $id)->update($entry);
        
    }

    public static function status_ad($id, $status)
    {
        return DB::table('nm_add')->where('ad_id', '=', $id)->update(array(
            'ad_status' => $status
        ));
        
    }
}

?>
