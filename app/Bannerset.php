<?php
namespace App;
use DB;
use File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
class Bannerset extends Model
{
    protected $guarded = array('id');
    protected $table = 'nm_banner';
    
    public static function save_banner($sizes)
    {
        return DB::table('nm_banner')->insert($sizes);
    }

    public static function view_banner_list()
    {
        return DB::table('nm_banner')->get();
    }

    public static function banner_detail($id)
    {
        return DB::table('nm_banner')->where('bn_id', '=', $id)->get();
    }

    // public static function delete_banner($id)
    // {
    //     return DB::table('nm_banner')->where('bn_id', '=', $id)->delete();
    // }
    public static function delete_banner($id)
    {
        
        // To start Image delete from folder 09/11/ 
        $filename = DB::table('nm_banner')->where('bn_id', '=', $id)->first();
        $getimagename= $filename->bn_img;
        $getextension=explode("/**/",$getimagename);
        foreach($getextension as $imgremove)
        {
            File::delete(base_path('assets/bannerimage/').$imgremove);
        } 
        // To End  
        return DB::table('nm_banner')->where('bn_id', '=', $id)->delete();
        
    }
    
    public static function update_banner_detail($entry, $id)
    {
        return DB::table('nm_banner')->where('bn_id', '=', $id)->update($entry);
    }

    public static function status_banner($id, $status)
    {
        return DB::table('nm_banner')->where('bn_id', '=', $id)->update(array(
            'bn_status' => $status
        ));
        
    }

}
?>