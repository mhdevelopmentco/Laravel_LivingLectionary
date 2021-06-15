<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
class Faqmodel extends Model
{
    protected $guarded = array('id');
    protected $table = 'nm_faq';
    
    public static function view_faq_detail()
    {
        return DB::table('nm_faq')->get();
        
    }
    
    public static function showindividual_faq_detail($id)
    {
        return DB::table('nm_faq')->where('faq_id', '=', $id)->get();
    }

    public static function delete_faq_detail($id)
    {
        return DB::table('nm_faq')->where('faq_id', '=', $id)->delete();
    }

    public static function update_faq_detail($id, $entry)
    {
        return DB::table('nm_faq')->where('faq_id', '=', $id)->update($entry);
    }
    
    public static function save_faq_detail($entry)
    {
        return DB::table('nm_faq')->insert($entry);
    }

    public static function update_status_faq($id, $status)
    {
        return DB::table('nm_faq')->where('faq_id', '=', $id)->update(array('faq_status' => $status));
        
    }
    
}

?>
