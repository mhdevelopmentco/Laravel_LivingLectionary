<?php
namespace App;
use DB;
use File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
class Category extends Model
{
    protected $guarded = array('id');
    protected $table = 'nm_maincategory';
    
    public static function save_category($sizes)
    {
        return DB::table('nm_maincategory')->insert($sizes);
    }
    
    public static function maincatg_list()
    {
        return DB::table('nm_maincategory')->get();
    }

    public static function maincatg_active_list()
    {
        return DB::table('nm_maincategory')->where('mc_status', 1)->get(array('mc_id', 'mc_name', 'mc_desc', 'mc_img', 'mc_img2'));
    }

    public static function selectedcatg_list($id)
    {
        return DB::table('nm_maincategory')->where('mc_id', '=', $id)->get();
    }

    public static function update_category_detail($entry, $id)
    {
        return DB::table('nm_maincategory')->where('mc_id', '=', $id)->update($entry);
    }

    public static function status_category_submit($id, $status)
    {
        return DB::table('nm_maincategory')->where('mc_id', '=', $id)->update(array('mc_status' => $status));
    }

    // public static function delete_category($id)
    // {
    //     return DB::table('nm_maincategory')->where('mc_id', '=', $id)->delete();
    // }
    public static function delete_category($id)
    {
        
        // To start Image delete from folder 09/11/ 
        $filename = DB::table('nm_maincategory')->where('mc_id', '=', $id)->first();
        $getimagename= $filename->mc_img;
        $getimagename2= $filename->mc_img2;

        $getextension=explode("/**/",$getimagename);
        $getextension2=explode("/**/",$getimagename2);

        foreach($getextension as $imgremove)
        {
            File::delete(base_path('assets/images/category/').$imgremove);
        }

        foreach($getextension2 as $imgremove2)
        {
            File::delete(base_path('assets/images/category/').$imgremove2);
        }
        // To End
        //delete all sub categories of this main category
        DB::table('nm_secsubcategory')->where('mc_id', '=', $id)->delete();
        DB::table('nm_subcategory')->where('mc_id', '=', $id)->delete();
        DB::table('nm_secmaincategory')->where('smc_mc_id', '=', $id)->delete();
        DB::table('nm_maincategory')->where('mc_id', '=', $id)->delete();

        return;
        
    }
    public static function save_main_category($sizes)
    {
        return DB::table('nm_secmaincategory')->insert($sizes);
    }
    
    public static function maincatg_sub_list($catg_list)
    {
        foreach ($catg_list as $catg) {
            $catg_result          = DB::table('nm_secmaincategory')->where('smc_mc_id', '=', $catg->mc_id)->get();
            $result[$catg->mc_id] = count($catg_result);
        }

        if (isset($result)) {
            return $result;
        }
    }

    public static function sub_maincatg_list($catg_id)
    {
        return DB::table('nm_secmaincategory')->where('smc_mc_id', '=', $catg_id)->LeftJoin('nm_maincategory', 'nm_maincategory.mc_id', '=', 'nm_secmaincategory.smc_mc_id')->get();
    }
    
    public static function add_sub_catg_details($catg_id)
    {
        return DB::table('nm_secmaincategory')->where('smc_id', '=', $catg_id)->LeftJoin('nm_maincategory', 'nm_maincategory.mc_id', '=', 'nm_secmaincategory.smc_mc_id')->get();
    }

    public static function save_sub_category($sizes)
    {
        return DB::table('nm_subcategory')->insert($sizes);
    }

    public static function subcatg_count_list($catg_list)
    {
        foreach ($catg_list as $catg) {
            $catg_result = DB::table('nm_subcategory')->where('sb_smc_id', '=', $catg->smc_id)->where('mc_id', '=', $catg->smc_mc_id)->get();
            if ($catg_result) {
                $result[$catg->smc_id] = count($catg_result);
            } else {
                $result[$catg->smc_id] = 0;
            }
        }
        return $result;
    }

    public static function sub_catg_list($catg_id)
    {
        return DB::table('nm_subcategory')->where('sb_smc_id', '=', $catg_id)->LeftJoin('nm_maincategory', 'nm_maincategory.mc_id', '=', 'nm_subcategory.mc_id')->LeftJoin('nm_secmaincategory', 'nm_secmaincategory.smc_id', '=', 'nm_subcategory.sb_smc_id')->get();
    }
    
    public static function secsubcatg_count_list($catg_list)
    {
        foreach ($catg_list as $catg) {
            $catg_result = DB::table('nm_secsubcategory')->where('ssb_sb_id', '=', $catg->sb_id)->where('ssb_smc_id', '=', $catg->mc_id)->get();
            if ($catg_result) {
                $result[$catg->sb_id] = count($catg_result);
            } else {
                $result[$catg->sb_id] = 0;
            }
            
        }
        return $result;
        
    }

    public static function edit_main_catg_details($catg_id)
    {
        return DB::table('nm_secmaincategory')->where('smc_id', '=', $catg_id)->leftJoin('nm_maincategory', 'nm_maincategory.mc_id', '=', 'nm_secmaincategory.smc_mc_id')->get();
    }

    public static function save_edit_main_category($sizes, $id)
    {
        return DB::table('nm_secmaincategory')->where('smc_id', '=', $id)->update($sizes);
    }

    public static function status_main_category_submit($id, $status)
    {
        return DB::table('nm_secmaincategory')->where('smc_id', '=', $id)->update(array('smc_status' => $status));
    }

    public static function delete_main_category($id)
    {
        DB::table('nm_secsubcategory')->where('ssb_smc_id', '=', $id)->delete();
        DB::table('nm_subcategory')->where('sb_smc_id', '=', $id)->delete();
        DB::table('nm_secmaincategory')->where('smc_id', '=', $id)->delete();
        return;
    }

    public static function add_secsub_main_category($catg_id)
    {
        return DB::table('nm_subcategory')->where('sb_id', '=', $catg_id)->LeftJoin('nm_maincategory', 'nm_maincategory.mc_id', '=', 'nm_subcategory.mc_id')->LeftJoin('nm_secmaincategory', 'nm_secmaincategory.smc_id', '=', 'nm_subcategory.sb_smc_id')->get();
    }

    public static function save_secsub_category($sizes)
    {
        return DB::table('nm_secsubcategory')->insert($sizes);
    }

    public static function edit_secsub_catg_details($catg_id)
    {
        return DB::table('nm_subcategory')->where('sb_id', '=', $catg_id)
            ->LeftJoin('nm_maincategory', 'nm_maincategory.mc_id', '=', 'nm_subcategory.mc_id')
            ->LeftJoin('nm_secmaincategory', 'nm_secmaincategory.smc_id', '=', 'nm_subcategory.sb_smc_id')
            ->get();

    }

    public static function save_editsecsub_main_category($sizes, $id)
    {
        return DB::table('nm_subcategory')->where('sb_id', '=', $id)->update($sizes);
    }

    public static function status_subsec_category_submit($id, $status)
    {
        return DB::table('nm_subcategory')->where('sb_id', '=', $id)->update(array('sb_status' => $status));
    }

    public static function delete_subsec_category($id)
    {
        DB::table('nm_secsubcategory')->where('ssb_sb_id', '=', $id)->delete();
        DB::table('nm_subcategory')->where('sb_id', '=', $id)->delete();
        return;
    }

    public static function  secsub_catg_list($catg_id)
    {
        return DB::table('nm_secsubcategory')->where('ssb_sb_id', '=', $catg_id)
            ->LeftJoin('nm_maincategory', 'nm_maincategory.mc_id', '=', 'nm_secsubcategory.mc_id')
            ->LeftJoin('nm_secmaincategory', 'nm_secmaincategory.smc_id', '=', 'nm_secsubcategory.ssb_smc_id')
            ->LeftJoin('nm_subcategory', 'nm_subcategory.sb_id', '=', 'nm_secsubcategory.ssb_sb_id')->get();
    }

    public static function status_secsub_category_submit($id, $status)
    {
        return DB::table('nm_secsubcategory')->where('ssb_id', '=', $id)->update(array('ssb_status' => $status));
    }

    public static function delete_secsub_category($id)
    {
        return DB::table('nm_secsubcategory')->where('ssb_id', '=', $id)->delete();
    }

    public static function edit_sec1sub_catg_details($catg_id)
    {
        return DB::table('nm_secsubcategory')->where('ssb_id', '=', $catg_id)->LeftJoin('nm_maincategory', 'nm_maincategory.mc_id', '=', 'nm_secsubcategory.mc_id')->LeftJoin('nm_secmaincategory', 'nm_secmaincategory.smc_id', '=', 'nm_secsubcategory.ssb_smc_id')->LeftJoin('nm_subcategory', 'nm_subcategory.sb_id', '=', 'nm_secsubcategory.ssb_sb_id')->get();
    }

    public static function save_editsec1sub_main_category($sizes, $id)
    {
        return DB::table('nm_secsubcategory')->where('ssb_id', '=', $id)->update($sizes);
    }

}

?>