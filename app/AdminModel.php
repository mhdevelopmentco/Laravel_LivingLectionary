<?php

namespace App;
use DB;
use File;
use Session;
use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    protected $guarded = array('id');
    protected $table = 'nm_admin';
    
    public static function get_admin_details()
    {
        return DB::table('nm_admin')->where('adm_id', '=', 1)->LeftJoin('nm_city', 'nm_city.ci_id', '=', 'nm_admin.adm_ci_id')->LeftJoin('nm_country', 'nm_country.co_id', '=', 'nm_admin.adm_co_id')->get();
    }
    
    public static function update_admin_details($entry)
    {
        return DB::table('nm_admin')->where('adm_id', '=', 1)->update($entry);
    }
    
    public static function get_chart_details()
    {
        $chart_count = "";
        for ($i = 1; $i <= 12; $i++) {
            $results = DB::select(DB::raw("SELECT count(*) as count FROM nm_deals WHERE MONTH( `deal_posted_date` ) = " . $i));
            $chart_count .= $results[0]->count . ",";
            
        }
        $chart_count1 = trim($chart_count, ",");
        return $chart_count1;
        
    }
}

?>
